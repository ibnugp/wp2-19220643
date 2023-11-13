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
            redirect('admin');
        }
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
            'required' => 'Email Harus diisi!!',
            'valid_email' => 'Email Tidak Benar!!',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Harus diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $data['user'] = '';
            // Kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
            $this->load->view('auth/templates/aute_header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/templates/aute_footer');
        } else {
            $this->_login();
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        } else {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
                'required' => 'Nama Belum diis!!',
            ]);
            $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', [
                'valid_email' => 'Email Tidak Benar!!',
                'required' => 'Email Belum diisi!!',
                'is_unique' => 'Email Sudah Terdaftar!',
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password Tidak Sama!!',
                'min_length' => 'Password Terlalu Pendek',
            ]);
            $this->form_validation->set_rules('password2', 'RepeatPassword', 'required|trim|matches[password1]');

            if ($this->form_validation->run() == false) {
                $data['judul'] = 'Registrasi Member';
                $this->load->view('auth/templates/aute_header', $data);
                $this->load->view('auth/registration');
                $this->load->view('auth/templates/aute_footer');
            } else {
                $email = $this->input->post('email', true);
                $data = [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'email' => htmlspecialchars($email),
                    'image' => 'default.jpg',
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'role_id' => 2,
                    'is_active' => 0,
                    'tanggal_input' => time(),
                ];
                $this->User_model->simpanData($data); //menggunakan model
                $this->session->set_flashdata(
                    'pesan',
                    '<div
class="alert alert-success alert-message" role="alert">Selamat!!
akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>',
                );
                redirect('authentication');
            }
        }
    }

    public function blok()
    {
        $this->load->view('auth/blok');
    }
    public function gagal()
    {
        $this->load->view('auth/gagal');
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->User_model->cekData(['email' => $email])->row_array();

        // Jika usernya ada
        if ($user) {
            // Jika user sudah aktif
            if ($user['Is_active'] == 1) {
                // Cek password
                if (password_verify($password, $user['Password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>');
                        }
                        redirect('admin');
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
