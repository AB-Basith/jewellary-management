<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper(array('form', 'url', 'string', 'download'));

        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/signin');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['user_name'] = $this->session->userdata('name');
        $data['user_email'] = $this->session->userdata('email');
        $data['stats'] = $this->Dashboard_model->get_overview_stats();
        $data['recent_sales'] = $this->Dashboard_model->get_recent_sales();
        
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
?>