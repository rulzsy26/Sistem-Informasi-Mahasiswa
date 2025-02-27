<?php
class Pengumuman extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengumuman_model');
    }

    // Fungsi untuk menampilkan halaman pengumuman
    public function index()
    {
        $data['pengumuman'] = $this->Pengumuman_model->get_all_pengumuman();
        $this->load->view('mainpguser', $data);
    }

}
?>