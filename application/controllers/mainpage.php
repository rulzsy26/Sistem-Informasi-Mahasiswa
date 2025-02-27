<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mainpage extends CI_Controller
{

    public function index()
    {
        // Load models untuk mengambil data
        $this->load->model('M_mhs');  // Load the model for mahasiswa
        $this->load->model('M_dosen');  // Load the model for dosen
        $this->load->model('M_matkul');  // Load the model for mata kuliah

        // Ambil jumlah data dari tabel-tabel yang diperlukan
        $data['jumlah_mhs'] = $this->M_mhs->get_count('tb_mhs');
        $data['jumlah_dosen'] = $this->M_dosen->get_count('tb_dosen');
        $data['jumlah_matkul'] = $this->M_matkul->get_count('tb_matkul');

        // Kirim data ke view
        $data['judul'] = "Mainpage"; // Judul halaman

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('mainpage', $data);
        $this->load->view('template/footer');
    }
}
