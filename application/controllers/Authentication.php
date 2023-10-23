<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Authentication
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @param     ...
 * @return    ...
 *
 */

class Authentication extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->database(); // Memuat library database
  }

  public function index()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }
    $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
      'required' => 'Email Harus diisi!!',
      'valid_email' => 'Email Tidak Benar!!'
    ]);

    $this->form_validation->set_rules('password', 'Password', 'required|trim', [
      'required' => 'Password Harus diisi'
    ]);

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Login';
      $data['user'] = '';
      // Kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
      $this->load->view('templates/aute_header', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/aute_footer');
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $email = htmlspecialchars($this->input->post('email', true));
    $password = $this->input->post('password', true);
    $user = $this->User_model->cekData(['email' => $email])->row_array();

    // Jika usernya ada
    if ($user) {
      // Jika user sudah aktif
      if ($user['is_active'] == 1) {
        // Cek password
        if (password_verify($password, $user['password'])) {
          $data = [
            'email' => $user['email'],
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata($data);

          if ($user['role_id'] == 1) {
            redirect('admin');
          } else {
            if ($user['image'] == 'default.jpg') {
              $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>');
            }
            redirect('user');
          }
        } else {
          $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
          redirect('/');
        }
      } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>');
        redirect('/');
      }
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>');
      redirect('/');
    }
  }
}


/* End of file Authentication.php */
/* Location: ./application/controllers/Authentication.php */