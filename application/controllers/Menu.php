<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        // * CHECK SESSION
        parent::__construct();

        // ? function helper for check login session
        is_check_login();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';

        // ? ambil data user berdasarkan session email yang disimpan
        $email_session = $this->session->userdata('email');

        // ? mencari data user berdasarkan email session 
        $data['user'] = $this->db->get_where('user', ['email' => $email_session])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required|is_unique[user_menu.menu]');

        if ($this->form_validation->run() == false) {
            // * load view and template
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $menu = htmlspecialchars($this->input->post('menu', true));

            $this->db->insert('user_menu', ['menu' => $menu]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New <strong>Menu</strong> Added!
                    </div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';

        // * LOAD
        $this->load->model('Menu_model', 'menu');

        // ? ambil data user berdasarkan session email yang disimpan
        $email_session = $this->session->userdata('email');

        // ? mencari data user berdasarkan email session 
        $data['user'] = $this->db->get_where('user', ['email' => $email_session])->row_array();

        // * QUERY TABLE
        $data['sub_menu'] = $this->menu->getSubMenu();

        // * QUERY SELECT FORM
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // * QUERY TOTAL ROWS TABLE
        $data['menu_row'] = $this->db->get('user_sub_menu')->num_rows();

        // * FORM VALIDATION
        $this->form_validation->set_rules('title', 'Title', 'required|is_unique[user_sub_menu.title]');
        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required|is_unique[user_sub_menu.url]');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {

            // * QUERY INSERT DATA
            $data = [
                "title" => $this->input->post('title', true),
                "menu_id" => $this->input->post('menu_id', true),
                "url" => $this->input->post('url', true),
                "icon" => $this->input->post('icon', true),
                "is_active" => $this->input->post('is_active')
            ];

            if ($data['is_active'] == null) {
                $data['is_active'] = 0;
            }

            $this->db->insert('user_sub_menu', $data);

            $this->session->set_flashdata('message', 'Added!');

            redirect('menu/submenu');
        }
    }

    public function deleteSubMenu($id)
    {
        if ($id > 0) {
            $this->db->delete('user_sub_menu', ['id' => $id]);
            $this->session->set_flashdata('message', 'Deleted!');

            redirect('menu/submenu');
        }
    }
}
