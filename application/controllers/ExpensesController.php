<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExpensesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string', 'download'));
        $this->load->library('form_validation');
		$this->load->database();
        $this->load->model('ExpensesModel');
    }

    public function ExpensesIndex() {
        $this->load->view('ExpensesView');
    }

    public function GetAllExpensesRecords() {
        $data = $this->ExpensesModel->GetRecords();
		echo json_encode($data);
    }

    public function AddExpensesData() {
        $id = $this->input->post('id');
        
        $description = $this->input->post('description');
        $amount = $this->input->post('amount');
        $created_at = date('Y-m-d H:i:s');
        
        if ($id) {
            $data = array(
                'description' => $description,
                'amount' => $amount,
                'created_at' => $created_at
            );
            
            $this->db->where('id', $id);
            $this->db->update('expenses', $data);
        } else {
            $data = array(
                'description' => $description,
                'amount' => $amount,
            );
            
            $this->db->insert('expenses', $data); 
        }
        redirect(base_url('ExpensesIndex'));
    }

    public function DeleteExpensesData() {
        $id = $this->input->post('id');
    
        $this->db->where('id', $id);
        $delete = $this->db->delete('expenses');
    
        if ($delete) {
            echo json_encode(['status' => 'success', 'message' => 'Expenses deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete Expenses']);
        }
    }
    
}
