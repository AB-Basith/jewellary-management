<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoicesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string', 'download'));
        $this->load->library('form_validation');
		$this->load->database();
        $this->load->model('InvoicesModel');
    }
   
    public function InvoicesIndex() {
        $this->load->view('InvoicesView');
    }

    public function GetAllInvoicesRecords() {
        $data = $this->InvoicesModel->GetRecords();
		echo json_encode($data);
    }

    public function AddInvoicesData() {
        $id = $this->input->post('id');
        
        $invoice_number = $this->input->post('invoice_number');
        $customer_name = $this->input->post('customer_name');
        $total_amount = $this->input->post('total_amount');
        $created_at = date('Y-m-d H:i:s');
        
        if ($id) {
            $data = array(
                'invoice_number' => $invoice_number,
                'customer_name' => $customer_name,
                'total_amount' => $total_amount,
                'created_at' => $created_at
            );
            
            $this->db->where('id', $id);
            $this->db->update('invoices', $data);
        } else {
            $data = array(
                'invoice_number' => $invoice_number,
                'customer_name' => $customer_name,
                'total_amount' => $total_amount
            );
            
            $this->db->insert('invoices', $data); 
        }
        redirect(base_url('InvoicesIndex'));
    }

    public function DeleteInvoicesData() {
        $id = $this->input->post('id');
    
        $this->db->where('id', $id);
        $delete = $this->db->delete('invoices');
    
        if ($delete) {
            echo json_encode(['status' => 'success', 'message' => 'Invoices deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete Invoices']);
        }
    }
}
