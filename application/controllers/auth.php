<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mhs');
        $this->load->library('form_validation');
    }

    public function login()
    {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Cek apakah user valid
            $user = $this->M_mhs->cek_login($username, $password);

            if ($user) {
                // Set session setelah login berhasil
                $this->session->set_userdata([
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'foto' => $user['foto'] ?? 'default.png', // Tambahkan foto profil (default jika tidak ada)
                    'role' => $user['role'], // Optional, jika ada
                    'logged_in' => true
                ]);

                // Redirect berdasarkan role
                if ($user['role'] === 'admin') {
                    redirect('mainpage'); // Arahkan admin ke halaman utama admin
                } elseif ($user['role'] === 'user') {
                    redirect('mainpguser'); // Arahkan user ke halaman utama user
                } else {
                    // Jika role tidak dikenali, logout dan tampilkan pesan error
                    $this->session->set_flashdata('error', 'Role tidak dikenali!');
                    redirect('auth/login');
                }
            } else {
                // Jika login gagal, tampilkan pesan error
                $this->session->set_flashdata('error', 'Username atau Password salah!');
                redirect('auth/login'); // Kembali ke halaman login
            }
        } else {
            $this->load->view('auth/login');
        }
    }

    public function logout()
    {
        // Hapus session ketika logout
        $this->session->sess_destroy();
        redirect('auth/login'); // Kembali ke halaman login setelah logout
    }

    public function register()
    {
        if ($_POST) {
            $username = $this->input->post('username', TRUE);
            $password = md5($this->input->post('password', TRUE));
            $role = $this->input->post('role', TRUE);
            $nama_mhs = $this->input->post('nama_mhs', TRUE);

            // Cek apakah username sudah terdaftar
            $this->db->where('username', $username);
            $query = $this->db->get('tb_users');
            if ($query->num_rows() > 0) {
                // Jika username sudah terdaftar, tampilkan error
                $this->session->set_flashdata('error', 'Akun dengan username ini sudah terdaftar.');
                redirect('auth/register');
            }

            // Validasi wajib jika role adalah user
            if ($role === 'user' && empty($nama_mhs)) {
                $this->session->set_flashdata('error', 'Nama Mahasiswa wajib diisi untuk role User.');
                redirect('auth/register');
            }

            // Jika role adalah 'user', cek nama mahasiswa di tb_mhs
            if ($role === 'user') {
                // Cek apakah ada mahasiswa dengan nama yang sama di tb_mhs
                $this->db->where('nama_mhs', $nama_mhs);
                $query = $this->db->get('tb_mhs');

                if ($query->num_rows() == 0) {
                    // Jika nama mahasiswa tidak ditemukan, tampilkan error dan redirect kembali
                    $this->session->set_flashdata('error', 'Nama Mahasiswa tidak ditemukan. Anda tidak dapat mendaftar.');
                    redirect('auth/register');
                }
            }

            // Data untuk tb_users
            $data_user = [
                'username' => $username,
                'password' => $password,
                'role' => $role,
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Simpan ke tb_users
            $this->db->insert('tb_users', $data_user);
            $id_user = $this->db->insert_id(); // Ambil id_user yang baru saja dibuat

            // Jika role adalah user, ambil data mahasiswa dan sambungkan dengan user
            if ($role === 'user') {
                // Cari mahasiswa berdasarkan nama
                $this->db->where('nama_mhs', $nama_mhs);
                $query = $this->db->get('tb_mhs');
                $data_mhs = $query->row_array();

                // Periksa apakah data mahasiswa ditemukan
                if ($data_mhs) {
                    // Jika ditemukan, update id_user mahasiswa
                    $data_mhs_update = [
                        'id_user' => $id_user
                    ];
                    $this->db->where('id_mhs', $data_mhs['id_mhs']);
                    $this->db->update('tb_mhs', $data_mhs_update);
                } else {
                    // Jika tidak ada, buat data mahasiswa baru
                    $data_mhs = [
                        'id_user' => $id_user,
                        'nama_mhs' => $nama_mhs,
                        // Isi data lainnya sesuai kebutuhan
                    ];
                    $this->db->insert('tb_mhs', $data_mhs);
                }
            }

            $this->session->set_flashdata('success', 'Pendaftaran berhasil! Silahkan login.');
            redirect('auth/login');
        } else {
            $this->load->view('auth/register');
        }
    }


    public function forgot_password()
    {
        if ($this->input->post()) {
            // Mendapatkan data dari form
            $username = $this->input->post('username');
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');

            // Cek apakah username ada di database
            $user = $this->M_mhs->get_user_by_username($username);

            if ($user) {
                // Cek apakah password lama benar
                if (md5($old_password) === $user['password']) {
                    // Hash password baru
                    $new_password_hash = md5($new_password);

                    // Panggil model untuk update password
                    $update = $this->M_mhs->update_password($username, $new_password_hash);

                    if ($update) {
                        // Berhasil reset password
                        $this->session->set_flashdata('success', 'Kata kunci berhasil direset.');
                        redirect('auth/login');
                    } else {
                        // Gagal update password
                        $this->session->set_flashdata('error', 'Gagal memperbarui kata kunci.');
                        redirect('auth/forgot_password');
                    }
                } else {
                    // Set flashdata jika password lama salah
                    $this->session->set_flashdata('error', 'Kata kunci lama salah.');
                    redirect('auth/forgot_password');
                }
            } else {
                // Set flashdata jika username tidak ditemukan
                $this->session->set_flashdata('error', 'Username tidak ditemukan.');
                redirect('auth/forgot_password');
            }
        } else {
            // Jika tidak ada post data, tampilkan halaman forgot password
            $this->load->view('auth/forgot_password');
        }
    }
}
?>