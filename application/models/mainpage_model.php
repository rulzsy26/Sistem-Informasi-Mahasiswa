<?php
// Model (Mainpage_model.php)
class Mainpage_model extends CI_Model
{

    // Fungsi untuk menghitung jumlah baris di suatu tabel
    public function get_count($table)
    {
        // Replace with the actual logic to count rows from the given table
        return $this->db->count_all($table);
    }
}
