<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
 	function __construct(){
        parent::__construct();
		$this->user = 'user';
	}

    public function GetUser($password, $username) {
        $this->db->where('user_id', $username);
        $query = $this->db->get('users');
        return $query->result_array(); // returns an array of results
    }



}