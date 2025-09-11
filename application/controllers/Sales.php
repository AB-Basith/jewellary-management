<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sales_model');
        $this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper(array('form', 'url', 'string', 'download'));
    }

    public function index() {
        $data['title'] = 'Sales Management';
        $data['sales'] = $this->Sales_model->get_all_sales();
        
        $this->load->view('templates/header', $data);
        $this->load->view('sales/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['title'] = 'Add Sale';
        $data['products'] = $this->Sales_model->get_products_for_select();
        
        if ($this->input->post()) {
            $quantity = $this->input->post('quantity_sold');
            $unit_price = $this->input->post('unit_price');
            
            $sale_data = array(
                'product_id' => $this->input->post('product_id'),
                'customer_name' => $this->input->post('customer_name'),
                'quantity_sold' => $quantity,
                'unit_price' => $unit_price,
                'total_amount' => $quantity * $unit_price,
                'sale_date' => $this->input->post('sale_date')
            );
            
            if ($this->Sales_model->add_sale($sale_data)) {
                $this->session->set_flashdata('success', 'Sale added successfully!');
                redirect('sales');
            } else {
                $this->session->set_flashdata('error', 'Failed to add sale.');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('sales/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id){
        $data['title'] = 'Edit Sale';

        $data['sale'] = $this->Sales_model->get_sale($id);
        $data['products'] = $this->Sales_model->get_products_for_select();

        if (!$data['sale']) {
            show_404();
        }

        if ($this->input->post()) {
            $quantity = $this->input->post('quantity_sold');
            $unit_price = $this->input->post('unit_price');
            
            $updateData = array(
                'product_id' => $this->input->post('product_id'),
                'customer_name' => $this->input->post('customer_name'),
                'quantity_sold' => $quantity,
                'unit_price' => $unit_price,
                'total_amount' => $quantity * $unit_price,
                'sale_date' => $this->input->post('sale_date')
            );

            $this->Sales_model->update_sale($id, $updateData);
            $this->session->set_flashdata('success', 'Sale updated successfully!');
            redirect('sales');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('sales/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        if ($this->Sales_model->delete_sale($id)) {
            $this->session->set_flashdata('success', 'Sale deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Unable to delete sale.');
        }
        redirect('sales');
    }


}
?>