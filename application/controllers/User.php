<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        // * CHECK SESSION
        parent::__construct();

        // ? function helper for check login session
        is_check_login();

        // * load 
        $this->load->model('User_model', 'users');

        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'My Profile';

        // ? ambil data user berdasarkan session email yang disimpan
        $email_session = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email_session])->row_array();

        // * load view and template
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function account()
    {
        $data['title'] = 'Account';

        // ? ambil data user berdasarkan session email yang disimpan
        $email_session = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email_session])->row_array();

        $image = $data['user']['image'];

        $id = $data['user']['id'];

        // * rules form_validation
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            // * load view and template
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/account', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $this->users->editAccount($image, $id);

            $this->session->set_flashdata('message', 'Your Profile has been updated!');

            redirect('user');
        }
    }
    public function security()
    {
        $data['title'] = 'Security';

        // ? ambil data user berdasarkan session email yang disimpan
        $email_session = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email_session])->row_array();

        $this->form_validation->set_rules('currentpassword', 'current password', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules(
            'newpassword',
            'new password',
            'required|alpha_numeric_spaces|min_length[8]|matches[repeatpassword]',
            [
                'matches' => 'Password is not match!'
            ]
        );
        $this->form_validation->set_rules(
            'repeatpassword',
            'repeat password',
            'required|alpha_numeric_spaces|min_length[8]|matches[newpassword]',
            [
                'matches' => 'Password is not match!'
            ]
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/security', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->users->changePassword($email_session);

            $this->session->set_flashdata('message', 'Your Password has been updated!');

            redirect('user');
        }
    }
}
