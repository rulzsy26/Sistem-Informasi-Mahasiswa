<?php
class bio_mhs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mhs');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login'); // Jika belum login, arahkan ke halaman login
        }
    }

    public function index()
    {
        // Ambil data user dari session
        $id_user = $this->session->userdata('id_user');
        $data['mahasiswa'] = $this->M_mhs->get_mahasiswa_by_user($id_user);

        // Tampilkan view dengan data mahasiswa
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('biodata_mhs', $data);
        $this->load->view('template/footer');
    }
}
