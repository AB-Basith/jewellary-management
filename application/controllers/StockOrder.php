<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockOrder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        $this->load->library('session');
        $this->load->library('form_validation');		
        $this->load->database();
        $this->load->helper(array('form', 'url', 'string', 'download'));
    }

    // List all stock
    public function index() {
        $data['title'] = 'Order Stock';
        $data['stocks'] = $this->Stock_model->get_all_stock();
        $data['low_stock'] = $this->Stock_model->get_low_stock();

        $this->load->view('templates/header', $data);
        $this->load->view('stock/order/index', $data);
        $this->load->view('templates/footer');
    }

    // // Add stock
    // public function add() {
    //     $data['title'] = 'Add Stock';

    //     if ($this->input->post()) {
    //         $stock_data = array(
    //             'product_name' => $this->input->post('product_name'),
    //             'ornaments'     => $this->input->post('ornaments'),
    //             'gram'     => $this->input->post('gram'),
    //             'gram_rate'   => $this->input->post('gram_rate'),
    //             'wastage_percent'   => $this->input->post('wastage_percent'),
    //             'supplier'     => $this->input->post('supplier')
    //         );
            
    //         if ($this->Stock_model->add_stock($stock_data)) {
    //             $this->session->set_flashdata('success', 'Stock added successfully!');
    //             redirect('stock');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to add stock.');
    //         }
    //     }
        
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('stock/add', $data);
    //     $this->load->view('templates/footer');
    // }

    // // Edit stock
    // public function edit($id) {
    //     $data['title'] = 'Edit Stock';
    //     $data['stock'] = $this->Stock_model->get_stock_by_id($id);

    //     if (!$data['stock']) {
    //         show_404();
    //     }

    //     if ($this->input->post()) {
    //         $stock_data = array(
    //             'product_name' => $this->input->post('product_name'),
    //             'ornaments'     => $this->input->post('ornaments'),
    //             'gram'     => $this->input->post('gram'),
    //             'gram_rate'   => $this->input->post('gram_rate'),
    //             'wastage_percent'   => $this->input->post('wastage_percent'),
    //             'supplier'     => $this->input->post('supplier')
    //         );

    //         if ($this->Stock_model->update_stock($id, $stock_data)) {
    //             $this->session->set_flashdata('success', 'Stock updated successfully!');
    //             redirect('stock');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to update stock.');
    //         }
    //     }

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('stock/edit', $data);
    //     $this->load->view('templates/footer');
    // }

    // // Delete stock
    // public function delete($id) {
    //     if ($this->Stock_model->delete_stock($id)) {
    //         $this->session->set_flashdata('success', 'Stock deleted successfully!');
    //     } else {
    //         $this->session->set_flashdata('error', 'Failed to delete stock.');
    //     }
    //     redirect('stock');
    // }

}
?>
