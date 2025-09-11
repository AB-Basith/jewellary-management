<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Expenses_model');
        $this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper(array('form', 'url', 'string', 'download'));
    }

    public function index() {
        $data['title'] = 'Expenses Management';
        $data['expenses'] = $this->Expenses_model->get_all_expenses();
        $data['stats'] = $this->Expenses_model->get_expense_stats();
        
        $this->load->view('templates/header', $data);
        $this->load->view('expenses/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['title'] = 'Add Expense';
        
        if ($this->input->post()) {
            $expense_data = array(
                'category' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'amount' => $this->input->post('amount'),
                'expense_date' => $this->input->post('expense_date'),
                'payment_method' => $this->input->post('payment_method')
            );
            
            if ($this->Expenses_model->add_expense($expense_data)) {
                $this->session->set_flashdata('success', 'Expense added successfully!');
                redirect('expenses');
            } else {
                $this->session->set_flashdata('error', 'Failed to add expense.');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('expenses/add', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Expense';
        $data['expense'] = $this->Expenses_model->get_expense_by_id($id);
        
        if (!$data['expense']) {
            show_404();
        }
        
        if ($this->input->post()) {
            $expense_data = array(
                'category' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'amount' => $this->input->post('amount'),
                'expense_date' => $this->input->post('expense_date'),
                'payment_method' => $this->input->post('payment_method')
            );
            
            if ($this->Expenses_model->update_expense($id, $expense_data)) {
                $this->session->set_flashdata('success', 'Expense updated successfully!');
                redirect('expenses');
            } else {
                $this->session->set_flashdata('error', 'Failed to update expense.');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('expenses/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        if ($this->Expenses_model->delete_expense($id)) {
            $this->session->set_flashdata('success', 'Expense deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete expense.');
        }
        redirect('expenses');
    }
}
?>