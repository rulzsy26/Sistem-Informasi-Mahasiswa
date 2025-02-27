<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        // Pastikan model User_model sudah terload
        $this->load->model('User_model');

        // Ambil data pengguna berdasarkan ID
        $user = $this->User_model->get_user_by_id($id_user);

        // Kirim data pengguna ke view
        $data['user'] = $user;

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('profile_view', $data);  // Pastikan nama view sesuai
        $this->load->view('template/footer');
    }

    public function update()
    {
        $user_id = $this->session->userdata('id_user');

        // Validasi input username
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke halaman profil
            $this->index();
        } else {
            $data = [
                'username' => $this->input->post('username'),
            ];

            // Proses upload foto jika ada
            if ($_FILES['foto']['name']) {
                // Konfigurasi upload
                $config['upload_path'] = './assets/Gambar/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // Maksimum ukuran file dalam KB
                $config['file_name'] = 'user_' . $user_id . '_' . time();
                $this->upload->initialize($config);
                // Load library upload dan inisialisasi konfigurasi
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    // Jika upload berhasil, simpan nama file ke database
                    $upload_data = $this->upload->data();
                    $data['foto'] = $upload_data['file_name'];
                } else {
                    // Jika upload gagal, set flashdata untuk notifikasi error
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('profile');
                }
            }

            // Update data di database
            if ($this->User_model->update_user($user_id, $data)) {
                // Set flashdata untuk notifikasi berhasil
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
            }

            redirect('profile');
        }
    }

}
