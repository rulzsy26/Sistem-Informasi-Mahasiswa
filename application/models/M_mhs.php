<?php
class M_mhs extends CI_Model
{
  // Mendapatkan semua data mahasiswa
  // Count all the records
  public function count_all()
  {
    return $this->db->count_all('tb_mhs');  // Replace 'tb_mhs' with your actual table name
  }

  // Fetch data for pagination
  public function get_data_pagination($limit, $start)
  {
    $this->db->limit($limit, $start);
    $query = $this->db->get('tb_mhs');  // Replace 'tb_mhs' with your actual table name
    return $query->result_array();
  }

  public function get_data()
  {
    return $this->db->get('tb_mhs')->result_array();
  }

  // Menambahkan data mahasiswa
  public function add_data($data)
  {
    if ($this->db->insert('tb_mhs', $data)) {
      return true;
    } else {
      log_message('error', 'Gagal menambahkan data mahasiswa: ' . print_r($this->db->error(), true));
      return false;
    }
  }

  // Memperbarui data mahasiswa berdasarkan ID
  public function update_data($id, $data)
  {
    $this->db->where('id_mhs', $id);
    return $this->db->update('tb_mhs', $data);
  }

  // Menghapus data mahasiswa berdasarkan ID
  public function hapus_data($id)
  {
    $this->db->where('id_mhs', $id);
    return $this->db->delete('tb_mhs');
  }

  // Mengambil data mahasiswa berdasarkan ID untuk diedit
  public function edit_data($id)
  {
    return $this->db->get_where('tb_mhs', ['id_mhs' => $id])->row_array();
  }

  // Mengambil detail data mahasiswa berdasarkan ID
  public function detail_data($id = NULL)
  {
    return $this->db->get_where('tb_mhs', array('id_mhs' => $id))->row();
  }

  // Mencari mahasiswa berdasarkan kata kunci
  public function get_keyword($keyword)
  {
    $this->db->select('*');
    $this->db->from('tb_mhs');

    $this->db->group_start();
    $this->db->like('nama_mhs', $keyword);
    $this->db->or_like('nim', $keyword);
    $this->db->or_like('tgl_lahir', $keyword);
    $this->db->or_like('jurusan', $keyword);
    $this->db->or_like('alamat', $keyword);
    $this->db->or_like('email', $keyword);
    $this->db->or_like('no_telp', $keyword);
    $this->db->group_end();

    return $this->db->get()->result_array();
  }

  public function get_all_mahasiswa()
  {
    return $this->db->get('tb_mhs')->result();
  }

  public function tampil_data($table)
  {
    return $this->db->get($table)->result();
  }

  public function jumlah_mahasiswa_perjurusan()
  {
    $this->db->group_by('jurusan'); // Grup berdasarkan jurusan
    $this->db->select('jurusan'); // Pilih kolom jurusan
    $this->db->select('COUNT(*) as total'); // Hitung jumlah mahasiswa per jurusan
    return $this->db->from('tb_mhs')->get()->result(); // Ambil hasil
  }

  public function tampil_dosen()
  {
    return $this->db->get('tb_dosen');
  }

  public function cek_login($username, $password)
  {
    $this->db->where('username', $username);
    $this->db->where('password', md5($password)); // Sesuaikan hashing password jika berbeda
    $query = $this->db->get('tb_users');

    if ($query->num_rows() > 0) {
      return $query->row_array(); // Kembalikan semua data user sebagai array
    }
    return false;
  }


  public function insert_user($data)
  {
    return $this->db->insert('tb_users', $data);
  }

  public function count_dosen()
  {
    return $this->db->count_all('tb_dosen'); // Replace 'dosen' with your actual table name
  }

  public function count_all_dosen()
  {
    return $this->db->count_all('dosen');  // Count total records in the 'dosen' table
  }

  public function get_data_pagination_dosen($limit, $start)
  {
    return $this->db->get('dosen', $limit, $start)->result();  // Fetch "dosen" data
  }

  public function fetch_mahasiswa_data()
  {
    $this->db->select("nama_mhs, nim, alamat, tgl_lahir, jurusan, email, no_telp");
    $this->db->from('tb_mhs');
    return $this->db->get();
  }

  public function get_user_by_username($username)
  {
    return $this->db->get_where('tb_users', ['username' => $username])->row_array();
  }

  // Fungsi untuk update password
  public function update_password($username, $new_password_hash)
  {
    // Update password di database
    $this->db->set('password', $new_password_hash);
    $this->db->where('username', $username);

    // Eksekusi query update
    $this->db->update('tb_users');

    // Mengembalikan apakah update berhasil atau tidak
    if ($this->db->affected_rows() > 0) {
      // Berhasil mengupdate password
      return true;
    } else {
      // Jika tidak ada perubahan pada database
      return false;
    }
  }

  public function get_count($table)
  {
    // Replace with the actual logic to count rows from the given table
    return $this->db->count_all($table);
  }

  public function create_user_with_role($data)
  {
    // Insert ke tabel users
    $this->db->insert('users', [
      'username' => $data['username'],
      'password' => $data['password'],
      'role' => $data['role'],
      'created_at' => $data['created_at']
    ]);

    // Jika role adalah 'user', simpan nama mahasiswa ke tb_mhs
    if ($data['role'] === 'user' && !empty($data['nama_mhs'])) {
      $this->db->insert('tb_mhs', [
        'nama_mhs' => $data['nama_mhs'],
        'username' => $data['username'] // Hubungkan dengan username
      ]);
    }

    // Return true jika data berhasil diinsert
    return $this->db->affected_rows() > 0;
  }

  public function get_mahasiswa_by_user($id_user)
  {
    $this->db->select('*');
    $this->db->from('tb_mhs');
    $this->db->where('id_user', $id_user);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row_array(); // Mengembalikan satu baris data mahasiswa
    }
    return null; // Jika tidak ada data, mengembalikan null
  }


}
?>