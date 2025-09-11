<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper(array('form', 'url', 'string', 'download'));
    }
    
    public function signin()
    {
        // If user is already logged in, redirect to dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $data['title'] = 'Sign In';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            
            if ($this->form_validation->run()) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                
                $user = $this->User_model->login($email, $password);
                
                if ($user) {
                    $this->session->set_userdata([
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                        'logged_in' => TRUE
                    ]);
                    
                    $this->session->set_flashdata('success', 'Login successful!');
                    redirect('dashboard');
                } else {
                    $data['error'] = 'Invalid email or password';
                }
            }
        }
        
        $this->load->view('auth/signin', $data);
    }

    public function signup()
    {
        // If user is already logged in, redirect to dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $data['title'] = 'Sign Up';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Full Name', 'required|min_length[2]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            
            if ($this->form_validation->run()) {
                $user_data = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                if ($this->User_model->create_user($user_data)) {
                    $this->session->set_flashdata('success', 'Account created successfully! Please sign in.');
                    redirect('auth/signin');
                } else {
                    $data['error'] = 'Something went wrong. Please try again.';
                }
            }
        }
        
        $this->load->view('auth/signup', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'email', 'name', 'logged_in']);
        $this->session->set_flashdata('success', 'You have been logged out successfully.');
        redirect('auth/signin');
    }
}