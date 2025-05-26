<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductionController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string', 'download'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('image_lib');
		$this->load->database();
        $this->load->model('ProductionModel');
        $this->load->model('StockModel');
    }
    
    public function ProductionIndex($id = null) {
        $data['category_name'] = $this->StockModel->get_all_categories();        

        if ($id) {
           $data['id'] = $this->StockModel->get_categories_by_id($id);
        } else {
            $data['production'] = [];
        }
        
        $this->load->view('ProductionView', $data);
        //$this->load->view('ProductionView');
    }


    public function GetAllProductionRecords() {
        $data = $this->ProductionModel->GetRecords();
		echo json_encode($data);
    }

    public function AddProductionData(){

        $id = $this->input->post('id');
        $product_name = $this->input->post('product_name');
        $description = $this->input->post('description');
        $category_id = $this->input->post('category_id');
        $price = $this->input->post('price');        

        $image = null;

        if (!empty($_FILES['image']['name'])) {
            // Image upload config
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $image = $uploadData['file_name'];

                // Resize image
                $resize_config['image_library'] = 'gd2';
                $resize_config['source_image'] = $uploadData['full_path'];
                $resize_config['maintain_ratio'] = TRUE;
                $resize_config['width'] = 500;
                $resize_config['height'] = 500;

                $this->image_lib->initialize($resize_config);
                $this->image_lib->resize();
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('ProductionIndex'); // Stop execution if upload fails
                return;
            }
        }
        // else{
        //     print_r('  jhdg dmsfbdah '); //exit;
        // }

        $data = array(
            'product_name' => $product_name,
            'description' => $description,
            'category_id' => $category_id,
            'price' => $price
        );

        // Only set image if a new image was uploaded
        if ($image) {
            $data['image'] = $image;
        }

        //print_r('   hjhgfgh'); exit;

        if ($id) {
            $created_at = date('Y-m-d H:i:s');
            $data['created_at'] = $created_at;
            $this->db->where('id', $id);
            $this->db->update('production', $data);
        } else {
            $created_at = $this->input->post('created_at');
            $data['created_at'] = $created_at;
            $this->db->insert('production', $data);
        }

        redirect(base_url('ProductionIndex'));
    }


    public function DeleteProductionData() {
        $id = $this->input->post('id');
    
        $this->db->where('id', $id);
        $delete = $this->db->delete('production');
    
        if ($delete) {
            echo json_encode(['status' => 'success', 'message' => 'Production deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete Production']);
        }
    }
}
