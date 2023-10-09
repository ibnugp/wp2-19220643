<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['judul'] = 'Halaman depan';
        $this->load->view('web/v_header', $data);
        $this->load->view('web/v_index', $data);
        $this->load->view('web/v_footer', $data);
    }

    public function about()
    {
        $data['judul'] = 'Halaman About';
        $this->load->view('web/v_header', $data);
        $this->load->view('web/v_about', $data);
        $this->load->view('web/v_footer', $data);
    }
}
