<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string', 'download'));
        $this->load->library('form_validation');
		$this->load->database();
        $this->load->model('SalesModel');
    }

    public function SalesIndex() {
        $this->load->view('SalesView');
    }

    public function GetAllSalesRecords() {
        $data = $this->SalesModel->GetRecords();
		echo json_encode($data);
    }
    
    public function AddSalesData() {
        $id = $this->input->post('id');
        
        $product_name = $this->input->post('product_name');
        $quantity = $this->input->post('quantity');
        $total_price = $this->input->post('total_price');
        $created_at = date('Y-m-d H:i:s');
        
        if ($id) {
            $data = array(
                'product_name' => $product_name,
                'quantity' => $quantity,
                'total_price' => $total_price,
                'created_at' => $created_at
            );
            
            $this->db->where('id', $id);
            $this->db->update('sales', $data);
        } else {
            $data = array(
                'product_name' => $product_name,
                'quantity' => $quantity,
                'total_price' => $total_price
            );
            
            $this->db->insert('sales', $data); 
        }
        redirect(base_url('SalesIndex'));

    }

    public function DeleteSalesData() {
        $id = $this->input->post('id');
    
        $this->db->where('id', $id);
        $delete = $this->db->delete('sales');
    
        if ($delete) {
            echo json_encode(['status' => 'success', 'message' => 'Sales deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete Sales']);
        }
    }
    
}
