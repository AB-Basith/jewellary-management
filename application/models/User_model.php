<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function create_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function login($email, $password)
    {
        // Find user by email
        $query = $this->db->get_where('users', ['email' => $email, 'status' => 'active']);
        $user = $query->row();

        // Verify password
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }
    
    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }

    public function get_user_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('users')->row();
    }
}