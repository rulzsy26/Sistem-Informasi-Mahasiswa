<?php
class M_dosen extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('tb_dosen')->result_array(); // Pastikan tabel adalah tabel dosen
    }

    public function add_data($data)
    {
        if ($this->db->insert('tb_dosen', $data)) {
            return true;
        } else {
            log_message('error', 'Gagal menambahkan data dosen: ' . print_r($this->db->error(), true));
            return false;
        }
    }

    public function detail_data($id_dosen)
    {
        $this->db->where('id_dosen', $id_dosen);  // Pastikan mencocokkan dengan field yang digunakan
        $query = $this->db->get('tb_dosen');  // Nama tabel dosen sesuai dengan yang ada di database

        if ($query->num_rows() > 0) {
            return $query->row();  // Mengembalikan satu baris data dosen
        } else {
            return NULL;  // Jika data tidak ditemukan
        }
    }

    public function hapus_data($id_dosen)
    {
        $this->db->where('id_dosen', $id_dosen);
        return $this->db->delete('tb_dosen');
    }
    public function get_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('tb_dosen');

        $this->db->group_start();
        $this->db->like('nama_dosen', $keyword);
        $this->db->or_like('nik_nidn', $keyword);
        $this->db->or_like('prodi', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('no_telp', $keyword);
        $this->db->group_end();

        // Use result() to return an array of objects
        return $this->db->get()->result();
    }

    public function edit_data($id)
    {
        return $this->db->get_where('tb_dosen', ['id_dosen' => $id])->row_array();
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_dosen', $id);
        return $this->db->update('tb_dosen', $data);
    }

    public function fetch_dosen_data()
    {
        $this->db->select("nama_dosen, nik_nidn, prodi, email, no_telp");
        $this->db->from('tb_dosen');
        return $this->db->get();
    }

    public function get_list($columns = [])
    {
        // Jika kolom kosong, tampilkan semua kolom
        if (empty($columns)) {
            $columns = ['nama_dosen', 'nik_nidn', 'prodi', 'email', 'no_telp'];
        }

        // Menarik data berdasarkan kolom yang dipilih
        $this->db->select(implode(',', $columns)); // Menggabungkan kolom yang dipilih
        $this->db->from('tb_dosen');
        return $this->db->get();
    }

    public function get_count($table)
    {
        // Replace with the actual logic to count rows from the given table
        return $this->db->count_all($table);
    }
}

