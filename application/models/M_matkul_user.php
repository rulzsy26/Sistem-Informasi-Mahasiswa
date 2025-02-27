<?php
class M_matkul_user extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('tb_matkul')->result_array(); // Pastikan tabel adalah tabel dosen
    }

    public function get_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('tb_matkul');

        $this->db->group_start();
        $this->db->like('kode_matkul', $keyword);
        $this->db->or_like('nama_matkul', $keyword);
        $this->db->or_like('sks', $keyword);
        $this->db->or_like('semester', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->group_end();

        // Use result() to return an array of objects
        return $this->db->get()->result();
    }

    public function fetch_matkul_data()
    {
        return $this->db->get('tb_matkul');
    }

    public function edit_data($id)
    {
        return $this->db->get_where('tb_matkul', ['id_matkul' => $id])->row_array();
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_matkul', $id);
        return $this->db->update('tb_matkul', $data);
    }

    public function hapus_data($id_matkul)
    {
        $this->db->where('id_matkul', $id_matkul);
        return $this->db->delete('tb_matkul');
    }

    public function get_count($table)
    {
        // Replace with the actual logic to count rows from the given table
        return $this->db->count_all($table);
    }

}