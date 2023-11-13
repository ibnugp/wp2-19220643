<?php
defined('BASEPATH') or exit('No direct script access allowed');

// ------------------------------------------------------------------------

if (!function_exists('test')) {
    /**
     * Test
     *
     * This test helpers
     *
     * @param   ...
     * @return  ...
     */
    function test()
    {
        //
    }

    function cek_login()
    {
        $ci = get_instance();
        if (!$ci->session->userdata('Email')) {
            print_r($ci->session->userdata('Email'));
//             $ci->session->set_flashdata(
//                 'pesan',
//                 '<div class="alert
// alert-danger" role="alert">Akses ditolak. Anda belum login!!
// </div>',
//             );
//             redirect('authentication');
        } else {
            $role_id = $ci->session->userdata('Role_id');
        }
    }
}

// ------------------------------------------------------------------------

/* End of file Pustaka_helper.php */
/* Location: ./application/helpers/Pustaka_helper.php */
