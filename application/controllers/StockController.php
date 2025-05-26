<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string', 'download'));
        $this->load->library('form_validation');
		$this->load->database();
        $this->load->model('StockModel');
    }

    public function StockIndex() {
        $this->load->view('StockView.php');
    }

    public function GetAllStockRecords() {
        $data = $this->StockModel->GetRecords();
		echo json_encode($data);
    }

    public function AddStockData() {
        $id = $this->input->post('id');
        
        $category_name = $this->input->post('category_name');
        $created_at = date('Y-m-d H:i:s'); 
        
        if ($id) {
            $data = array(
                'category_name' => $category_name,
                'created_at' => $created_at
            );
            
            $this->db->where('id', $id);
            $this->db->update('stock', $data);
        } else {
            $data = array(
                'category_name' => $category_name,
            );
            
            $this->db->insert('stock', $data); 
        }
        redirect(base_url('StockIndex'));
    }

    public function DeleteStockData() {
        $id = $this->input->post('id');
    
        $this->db->where('id', $id);
        $delete = $this->db->delete('stock');
    
        if ($delete) {
            echo json_encode(['status' => 'success', 'message' => 'Stock deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete stock']);
        }
    }
    
}
