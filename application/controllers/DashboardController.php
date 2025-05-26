<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper(array('form', 'url', 'string', 'download'));		
	}	
	
	public function DashboardIndex(){		
		//$this->load->view('login_view.php');
		$this->load->view('AdminDashboard.php');
		//$this->load->view('footer.php');
	}
	
}