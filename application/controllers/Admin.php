<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('Pustaka');
        $this->load->library('session');
        $this->load->database(); // Memuat library database
        cek_login();
    }
    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['user'] = $this->User_model->cekData(['Email' => $this->session->userdata('Email')])->row_array();
        $data['anggota'] = $this->User_model->getUserLimit()->result_array();
        $data['buku'] = $this->Buku_model->getBuku()->result_array();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/templates/footer');
    }
}
