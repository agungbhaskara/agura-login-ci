<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['title'] = 'Dashboard';

        // ? ambil data user berdasarkan session email yang disimpan
        $email_session = $this->session->userdata('email');

        // ? mencari data user berdasarkan email session 
        $data['user'] = $this->db->get_where('user', ['email' => $email_session])->row_array();

        $data['num_users'] = $this->db->get_where('user', ['is_active' => 1])->num_rows();

        $data['num_menu'] = $this->db->get('user_menu')->num_rows();

        $data['num_sub_menu'] = $this->db->get('user_sub_menu')->num_rows();

        // * load view and template
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';

        // ? ambil data user berdasarkan session email yang disimpan
        $email_session = $this->session->userdata('email');

        // ? mencari data user berdasarkan email session 
        $data['user'] = $this->db->get_where('user', ['email' => $email_session])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        // * load view and template
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';

        // ? ambil data user berdasarkan session email yang disimpan
        $email_session = $this->session->userdata('email');

        // ? mencari data user berdasarkan email session 
        $data['user'] = $this->db->get_where('user', ['email' => $email_session])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id!=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // * load view and template
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        // ? ambil data dari ajax 
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'menu_id' => $menu_id,
            'role_id' => $role_id
        ];

        //  ? query data access berdasarkan menu dan role id
        $result = $this->db->get_where('user_access_menu', $data)->num_rows();

        //  ? buat kondisi result tidak ada isinya ( lebih dari 1(admin_access) ) (checkbox nya di centang)
        if ($result < 1) {

            // ? tambahkan access baru pada role tersebut
            $this->db->insert('user_access_menu', $data);
        }

        //  ? jika result ada isinya maka hapus access pada role nya (checkboxnya centangnya di matikan)
        else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <strong>Access</strong> Changed!
                    </div>');
    }
}
