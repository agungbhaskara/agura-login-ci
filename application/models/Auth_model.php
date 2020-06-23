<?php

class Auth_model extends CI_Model
{
    private $table = "user";

    // * method validation for making rules
    public function validation()
    {
        return [
            "registration_form" => [
                [
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'required|trim|min_length[4]',
                    'errors' => [
                        'min_length' => 'Username too short!'
                    ]
                ],
                [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'is_unique' => 'This email has already registered!'
                    ]
                ],
                [
                    'field' => 'password1',
                    'label' => 'Password',
                    'rules' => 'required|trim|min_length[3]|matches[password2]',
                    'errors' => [
                        'matches' => 'Password dont match!',
                        'min_length' => 'Password too short!'
                    ]
                ],
                [
                    'field' => 'password2',
                    'label' => 'Password',
                    'rules' => 'required|trim|min_length[3]|matches[password1]'
                ]
            ],
            "login_form" => [
                [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|trim|valid_email'
                ],
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|trim'
                ]
            ]
        ];
    }

    // * method for registration data
    public function registration()
    {
        // * ambil data dari input form
        $name = htmlspecialchars($this->input->post('name', true));
        $email = htmlspecialchars($this->input->post('email', true));
        $image = "default.jpg";
        $password = $this->input->post('password1');

        // * konfigurasi form tampung ke array
        $data = [
            'name' => $name,
            'email' => $email,
            'image' => $image,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role_id' => 2, //? di isi 2 berarti termasuk akun member
            'is_active' => 0, //? 1 sebagai user active
            'date_created' => time() //? memberikan data kapan dibuat dengan waktu detik
        ];

        //  TODO siapkan token dengan isi data random untuk mengaktifkan akun
        // ? random_btyes = untuk memberikan data random
        // ? base64_encode = untuk menerjemahkan data randomnya
        $token = base64_encode(random_bytes(32));

        //  * tampung data user token ke array
        $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' => time()
        ];

        // * lalu query insert database
        $this->db->insert($this->table, $data);
        $this->db->insert('user_token', $user_token);

        // TODO email sending dan kirim tokennya ke email
        $this->sendEmail($token, 'verity');
    }

    // * method for email function 
    // ? parameter mengirimkan token dan tipe email verifikasi atau forgot password
    public function sendEmail($token, $type)
    {
        $email = $this->input->post('email');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // TODO konfigurasi email 
        $config = [
            "protocol" => 'smtp',
            "smtp_host" => 'ssl://smtp.googlemail.com', // ? memakai email google 
            "smtp_user" => 'lazyweekend24@gmail.com', //?  email  dipakai
            "smtp_pass" => 'Lazyweekend__24', //? password email
            "smtp_port" => 465,
            "mailtype" => 'html', //? tipe email
            "charset" => 'utf-8', //? tipe karakter
            "newline" => "\r\n"
        ];

        // TODO load library dan masukan konfigurasinya  
        $this->load->library('email');

        // TODO instasiasi konfigurasinya
        $this->email->initialize($config);

        // ? buat email dari siapa beserta nama aliasnya
        $this->email->from('lazyweekend24@gmail.com', 'adminAgura');

        // ? email yang dikirim ambil email dari form email
        $this->email->to($email);

        // ? jika tipe email verity 
        if ($type == "verity") {

            // ? subject emailnya
            $this->email->subject('Account Verification');

            // ? isi body emailnya
            $this->email->message('
            Welcome User, Click This link to verify your account : <a href = "' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate Account</a>
            ');
        } else if ($type == "forgot") {
            // ? subject emailnya
            $this->email->subject('Reset Password');

            // ? pasang data formulir pesan
            $data = [
                "title" => "Reset Password",
                "name" => $user['name'],
                "token" => urlencode($token),
                "message" => "Click this link to reset your password for your account"
            ];

            // ? isi body emailnya
            $this->email->message('
            Hi <b>' . $data['name'] . '</b>,' . $data['message'] . ' <a href = "' . base_url() . 'auth/resetpassword?email=' . $email . '&token=' . $data['token'] . '">' . $data['title'] . '</a>
            ');
        }

        // TODO kirim gmailnya 

        // ? jika email terkirim
        if ($this->email->send()) {
            return true;
        }
        // ? jika gagal tampilkan pesan error
        else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
