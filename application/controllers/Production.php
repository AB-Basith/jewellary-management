<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Production_model');
        $this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper(array('form', 'url', 'string', 'download'));
    }

    public function index() {
        $data['title'] = 'Production Tracking';
        $data['productions'] = $this->Production_model->get_all_production();
        $data['stats'] = $this->Production_model->get_production_stats();
        
        $this->load->view('templates/header', $data);
        $this->load->view('production/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['title'] = 'Add Production';
        $data['products'] = $this->Production_model->get_products_for_select();
        
        if ($this->input->post()) {
            $production_data = array(
                'product_id' => $this->input->post('product_id'),
                'production_date' => $this->input->post('production_date'),
                'quantity_produced' => $this->input->post('quantity_produced'),
                'production_cost' => $this->input->post('production_cost'),
                'status' => $this->input->post('status')
            );
            
            if ($this->Production_model->add_production($production_data)) {
                $this->session->set_flashdata('success', 'Production record added successfully!');
                redirect('production');
            } else {
                $this->session->set_flashdata('error', 'Failed to add production record.');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('production/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Production';
        $data['production'] = $this->Production_model->get_production_by_id($id);
        $data['products'] = $this->Production_model->get_products_for_select();
        
        if (!$data['production']) {
            show_404();
        }
        
        if ($this->input->post()) {
            $production_data = array(
                'product_id' => $this->input->post('product_id'),
                'production_date' => $this->input->post('production_date'),
                'quantity_produced' => $this->input->post('quantity_produced'),
                'production_cost' => $this->input->post('production_cost'),
                'status' => $this->input->post('status')
            );
            
            if ($this->Production_model->update_production($id, $production_data)) {
                $this->session->set_flashdata('success', 'Production record updated successfully!');
                redirect('production');
            } else {
                $this->session->set_flashdata('error', 'Failed to update production record.');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('production/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        if ($this->Production_model->delete_production($id)) {
            $this->session->set_flashdata('success', 'Production record deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete production record.');
        }
        redirect('production');
    }
}
?>