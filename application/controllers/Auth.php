<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $table = "user";

    // * method construct for load module CodeIgniter
    public function __construct()
    {
        parent::__construct();

        // * LOAD module
        $this->load->model('Auth_model');
    }

    // * method for login page
    public function index()
    {
        // ? check session ketika user sudah login (jika session masih ada)
        if ($this->session->userdata('email')) {

            // ? lemparkan ke halaman user
            redirect('user');
        }

        // * send data to view
        $data['title'] = 'Login';

        // * FORM VALIDATION
        $validation = $this->Auth_model->validation();

        $this->form_validation->set_rules($validation['login_form']);

        if ($this->form_validation->run() == FALSE) {
            // * load template and page
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // * ketika validasi nya sukses
            $this->_login();
        }
    }

    // * method for registration
    public function registration()
    {
        // ? check session ketika user sudah login (jika session masih ada)
        if ($this->session->userdata('email')) {

            // ? lemparkan ke halaman user
            redirect('user');
        }

        // * send data to view
        $data['title'] = 'User Registration';

        // * FORM_VALIDATION
        $validation = $this->Auth_model->validation();
        $this->form_validation->set_rules($validation['registration_form']);

        if ($this->form_validation->run() == FALSE) {
            // * load template and page
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {

            $this->Auth_model->registration();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! your account has been created. Please Check Your Email For Activation Your Account 
            </div>');
            redirect('auth');
        }
    }

    // * method for verity account
    public function verify()
    {
        // TODO ambil email dan token dari url
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // TODO query data user untuk memastikan user sudah ada
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // ? cek jika user ada
        if ($user) {

            //  TODO query data user_token untuk mengecek token di database
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            // ? cek jika token ada
            if ($user_token) {

                //  TODO cek waktu validasi token untuk durasi lamanya token 
                // ? waktu saat ini dikurangin waktu user token dibuat kurang dari 24 jam
                // ? jika verifikasi akun kurang dari 24 jam 
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

                    // ? aktifkan akunya
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    // ? dan hapus data tokenya
                    $this->db->delete('user_token', ['token' => $token]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    ' . $email . ' has been activated! Please login.
                    </div>');
                    redirect('auth');
                }

                // ? jika waktunya lebih dari 24 jam tidak mengatifkan akun
                else {

                    // TODO hapus data user dan table
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['token' => $token]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Account Activation failed! Token Expired 
                    </div>');
                    redirect('auth');
                }
            }

            //  ? jika token tidak ada
            else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Account Activation failed! Token Not Invalid 
                </div>');
                redirect('auth');
            }
        }
        // ? jika tidak ada usernya tampilkan user
        else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account Activation failed! Email Not Found 
            </div>');
            redirect('auth');
        }
    }

    // * method for send email forgot password
    public function forgotPassword()
    {
        $data['title'] = "Forgot Password";

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            // * load template and page
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgotpassword');
            $this->load->view('templates/auth_footer');
        }
        //  * jika berhasil jalankan fungsinya
        else {

            $email = $this->input->post('email');

            // TODO cek email diuser untuk pengecekan adanya user dan akun user yang sudah aktif
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            // ? kondisi jika ada user
            if ($user) {

                // TODO buat token dan akun token beserta waktu data dibuat
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                //  TODO insert ke user_token
                $this->db->insert('user_token', $user_token);

                // TODO send ke email 
                $this->Auth_model->sendEmail($token, 'forgot');

                // TODO tampilkan pesan
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <strong>Please Check Your Email For Reset Password !</strong>
                </div>');
                redirect('auth/forgotpassword');
            }
            // ? jika user tidak ada atau user account belum aktif
            else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your email is not <strong>Registered or Activeted !</strong>
                </div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    // * method for system reset password configuration
    public function resetpassword()
    {
        // ? ambil token dan email dari url
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // ? cek data user
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // TODO jika ada user dari email
        if ($user) {

            // ? cek data token 
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            // TODO cek jika ada token dari user_token
            if ($user_token) {

                // TODO cek jika token kurang dari hari belum dipakai
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

                    // TODO buat session untuk menyimpan data user reset
                    $this->session->set_userdata('reset_user', $email);
                    $this->session->set_userdata('token_session', $token);

                    // TODO tampilkan halaman reset password
                    $this->changePassword();
                }
                //  TODO jika token sudah lebih dari sehari dipakai maka
                else {

                    // ? hapus token nya
                    $this->db->delete('user_token', ['token' => $token]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Reset password failed <strong>Token Has Been Expired !</strong>
                    </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Reset password failed <strong>Token Not Found !</strong>
                </div>');
                redirect('auth');
            }
        }
        // ? jika tidak ada
        else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password failed <strong>Email not found !</strong>
            </div>');
            redirect('auth');
        }
    }

    // * method for change password for forgot password
    public function changePassword()
    {
        // ? jika session data reset tidak ada
        if (!$this->session->userdata('reset_user')) {
            redirect('auth');
        }

        $data['title'] = "Change Password";

        $this->form_validation->set_rules('new_password', 'Password', 'required|min_length[8]|matches[repeat_password]');
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|min_length[8]|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            // * load template and page
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {

            // TODO enkripsi password & ambil data session email
            $password = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_user');
            $token = $this->session->userdata('token_session');

            $data = [
                'password' => $password
            ];

            // TODO update data user
            $this->db->update('user', $data, ['email' => $email]);

            // TODO hapus sessionya
            $this->session->unset_userdata('reset_email');

            // TODO hapus data token
            $this->db->delete('user_token', ['token' => $token]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password has been change! <strong>Please Login</strong>
                    </div>');
            redirect('auth');
        }
    }

    // * method for login system
    private function _login()
    {
        // TODO ambil data dari input form
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember_me = $this->input->post('remember_me');

        // TODO cari data user berdasarkan gmail lalu ambil satu baris dengan mengembalikan datanya sebagai array
        $user = $this->db->get_where($this->table, ['email' => $email])->row_array();
        // ? PENJELASAN : SELECT * FROM user WHERE email = $email

        // TODO jika user ada berdasarkan email
        if ($user) {
            // TODO jika user aktif berdasarkan is_active table database
            if ($user['is_active'] == 1) {

                // TODO cek password = jika password yg dinput sama dengan di dalam table
                // ? parameter pertama = input password dan parameter kedua = password dari table user
                if (password_verify($password, $user['password'])) {

                    // TODO siapkan data dalam array
                    $data = [
                        'email' => $email,
                        'role_id' => $user['role_id']
                    ];

                    // TODO simpan data ke dalam session
                    $this->session->set_userdata($data);

                    // TODO jika role_id == 1 (admin)
                    if ($user['role_id'] == 1) {
                        // TODO pindah ke controller admin (halaman admin)
                        redirect('admin');
                    }
                    // TODO jika role_id selain 1 maka login ke halaman user
                    else {
                        // TODO pindah ke controller user (halaman user)
                        redirect('user');
                    }
                }
                // TODO jika password tidak sesuai
                else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <strong>The password</strong> entered is incorrect!
                    </div>');
                    redirect('auth');
                }
            }
            // TODO jika user tidak aktif
            else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <strong>Email</strong> has not been activated!
                </div>');
                redirect('auth');
            }
        }
        // TODO jika user tidak ada
        else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <strong>Email</strong> is not Registered!
            </div>');
            redirect('auth');
        }
    }

    // * method for logout 
    public function logout()
    {
        // TODO hapus data dari session untuk membersihkan session
        $this->session->sess_destroy();
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You Have Been <strong>Logout!</strong>
        </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
