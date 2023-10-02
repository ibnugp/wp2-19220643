<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_latihan1 extends CI_Model
{
    public $nilai1, $nilai2, $hasil;

    public function jumlah($n1 = null, $n2 = null){
        $this->nilai1 = $n1;
        $this->nilai2 = $n2;
        $this->hasil = $this->nilai1 + $this->nilai2;
        return $this->hasil;
    }
}

/* End of file Model_latihan1.php */
