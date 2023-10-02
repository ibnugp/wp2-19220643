<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Controller Matakuliah
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @param     ...
 * @return    ...
 *
 */

class Matakuliah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('matakuliah/view-form-matakuliah');
    }

    public function cetak()
    {
        $data = [
            'kode' => $this->input->post('kode'),
            'nama' => $this->input->post('nama'),
            'sks' => $this->input->post('sks'),
        ];

        $this->load->view('matakuliah/view-data-matakuliah', $data);
    }
}
