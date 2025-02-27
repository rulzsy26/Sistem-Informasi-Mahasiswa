<?php
class Pengumuman_model extends CI_Model
{

    public function get_all_pengumuman()
    {
        return $this->db->get('pengumuman')->result_array();
    }

    public function get_pengumuman_by_id($id)
    {
        return $this->db->get_where('pengumuman', ['id' => $id])->row_array();
    }
}
?>