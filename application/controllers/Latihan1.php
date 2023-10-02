<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latihan1 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		echo "<h1>Perkenalan</h1>";
        echo "Nama Saya Ibnu Gunawan, Saya Tinggal di daerah grogol , olahraga yang saya sukai adalah voli";
	}

    public function contoh()
	{
        $data['nama'] = "Ucup";
		$this->load->view('contoh1', $data);
	}

    public function penjumlahan(){
        $this->load->model('Model_latihan1');

        $n1 = $_GET['nilai1'] ?? 0;
        $n2 = $_GET['nilai2'] ?? 0;
        $hasil = $this->Model_latihan1->jumlah(intval($n1), intval($n2));
        $data['nilai1'] = $n1;
        $data['nilai2'] = $n2;
        $data['hasil'] = $hasil;

        $this->load->view('view-latihan1', $data);
    }
}
