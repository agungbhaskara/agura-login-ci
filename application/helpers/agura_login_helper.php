<?php

// * function for check login access
function is_check_login()
{
    // TODO  instasiasi codeigniter (panggil librarynya)
    $ci = get_instance();

    // ? jika tidak ada session
    if (!$ci->session->userdata('email')) {

        // TODO  kirim flashdata untuk memberikan notifikasi pesan
        $ci->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You Need <strong>Login</strong> First For Access !
        </div>');

        // ? lemparkan dia ke halaman login
        redirect('auth');
    }
    // ? jika session ada dan mengecek role_id untuk mengatur batas akses role member ke halaman admin
    else {

        // ? cek role id untuk mengambil role user
        $role_id = $ci->session->userdata('role_id');

        // ? cek menu akses dengan mengambil url (controllernya)
        $menu = $ci->uri->segment(1);

        // TODO QUERY menu access panggil data table user_menu dengan where menu valuenya berdasarkan url yang diambil
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

        // ? lalu ambil data id nya
        $menu_id = $queryMenu['id'];

        // TODO  query user access untuk menentukan batas akses setiap user yg login
        $userAccess = $ci->db->get_where(
            'user_access_menu',
            [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ]
        );

        // ? jika barisnya keluar lebih dari satu (jika member mau mengakses halaman admin)
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

//? function for checked access role 
function check_access($role_id, $menu_id)
{
    // TODO  instasiasi library codeigniter
    $ci = get_instance();

    // TODO  cari data user_access_menu berdasarkan role_id dan menu_id
    $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id])->num_rows();

    // ? cek jika result ada barisnya
    if ($result > 0) {

        // ? lalu checkbox centang
        return "checked";
    }
}
