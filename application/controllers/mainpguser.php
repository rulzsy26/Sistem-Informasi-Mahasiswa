<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mainpguser extends CI_Controller
{

    public function index()
    {
        // Kirim data ke view
        $data['judul'] = "Mainpage User"; // Judul halaman

        $this->load->model('Pengumuman_model');
        $data['pengumuman'] = $this->Pengumuman_model->get_all_pengumuman();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('mainpguser', $data);
        $this->load->view('template/footer');

    }
}
