<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "user";

    public function editAccount($image, $id)
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $upload_profile = $_FILES['image']['name'];

        // ? jika form upload tidak kosong maka kirimkan data file barunya
        if (!empty($upload_profile)) {
            $upload_profile = $this->UploadImage($image, $id);
        }
        // ? jika form upload kosong maka kirimkan data file lamanya
        else {
            $upload_profile = $image;
        }

        $data = [
            'name' => $name,
            'image' => $upload_profile
        ];

        return $this->db->update($this->_table, $data, ['email' => $email]);
    }

    public function changePassword($session)
    {
        $user = $this->db->get_where('user', ['email' => $session])->row_array();

        $current_password = $this->input->post('currentpassword');
        $new_password = $this->input->post('newpassword');

        // TODO cek current password
        // ? jika current password dengan password user tidak sama
        if (!password_verify($current_password, $user['password'])) {

            // ? maka tampilkan pesan
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password ! </div>');

            redirect('user/security');
        }

        // ? jika current password benar
        else {

            // TODO cek new password dengan current password
            // ? jika password user sama dengan password baru
            if ($current_password == $new_password) {

                // ? maka tampilkan pesan
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password Cannot Be The Same As Current Password ! </div>');

                redirect('user/security');
            }
            // ? jika password sudah ok
            else {
                // TODO enkripsi password nya
                $password = password_hash($new_password, PASSWORD_DEFAULT);

                $data = ['password' => $password];

                return $this->db->update($this->_table, $data, ['email' => $session]);
            }
        }
    }

    private function UploadImage($image, $id)
    {
        // TODO configurasion file
        $config['allowed_types'] = 'gif|jpg|png';
        $config['upload_path'] = './assets/img/profile/';
        $config['max_size'] = 2048;
        $config['file_name'] = $id;

        // * load 
        $this->load->library('upload', $config);

        // ? jika upload berhasil dari input image
        if ($this->upload->do_upload('image')) {

            $old_image = $image;

            //  ? jika gambar lama bukan default maka hapus dari folder
            if ($old_image != 'default.jpg') {
                unlink(FCPATH . 'assets/img/profile/' . $old_image);
            }

            // ? kembalikan nilai upload data barunya
            return $this->upload->data('file_name');
        } else {
            // ? tampilkan pesan
            $this->session->set_flashdata('message', '<div class="alert alert-danger pb-0" role="alert">' . $this->upload->display_errors() . '</div>');

            redirect('user/account');
        }
    }
}
