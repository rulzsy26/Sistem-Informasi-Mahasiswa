<?php
class User_model extends CI_Model
{
    public function get_user_by_id($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_users');
        return $query->row();
    }

    public function update_user($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->update('tb_users', $data);
    }

    public function save_image($image_data)
    {
        return $this->db->insert('tb_users', $image_data);
    }

    public function login($id_mhs, $password)
    {
        $this->db->select('id_user, username, password, role');
        $this->db->from('tb_users');
        $this->db->join('tb_mhs', 'tb_users.id_user = tb_mhs.id_user', 'inner');
        $this->db->where('tb_mhs.id_mhs', $id_mhs);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Verifikasi password
            if (password_verify($password, $user->password)) {
                return $user;
            } else {
                return false; // Password salah
            }
        } else {
            return false; // id_mhs tidak ditemukan
        }
    }
}

