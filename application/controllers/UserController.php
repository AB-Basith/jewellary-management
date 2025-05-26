<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
        $this->load->model('UserModel');
		$this->load->helper(array('form', 'url', 'string', 'download'));		
	}	
	
	public function index(){        
        $this->load->view('login_view');
    }

    public function login() {
		$this->form_validation->set_rules('username', 'user_id', 'required', array('required' => 'User Id is required.'));
		$this->form_validation->set_rules('password', 'password', 'required', array('required' => 'Password is required.'));
			
		if($this->form_validation->run() == false){
			$this->load->view('login_view'); 
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$userData = $this->UserModel->GetUser($password, $username);	
			
			if (!empty($userData)) {
				$firstElement = $userData[0];
				$Chk_user_id = $firstElement['user_id'];
				$Chk_pwd = $firstElement['password'];
				
				if ($Chk_user_id == $username && $Chk_pwd == $password) {
					$userData = array(
						'user_id' => $Chk_user_id,
						'password' => $Chk_pwd
					);
					$this->session->set_userdata('user_data', $userData);
					redirect('DashboardIndex');
				} else {
					$this->session->set_flashdata('error', 'Invalid login. Please check the User Id and Password.');
					redirect('login');
				}
				
			} else {
				// No user found in DB
				$this->session->set_flashdata('error', 'Invalid login. User not found.');
				redirect('login');
			}
			
		}		
	}
	
	public function logout() {
		$this->session->unset_userdata('username');
        $this->load->view('login_view');
    }

	
}