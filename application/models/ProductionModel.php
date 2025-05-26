<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductionModel extends CI_Model {
 	function __construct(){
        parent::__construct();
		$this->production = 'production';
		$this->stock = 'stock';
	}

    public function GetRecords() {
        $this->db->select('*');
        $this->db->from('production');
        $query = $this->db->get();         
		$result = $query->result_array();
		//print_r($result);exit;
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {	
			$id = $row['id'];
			$category_id = $row['category_id'];
			$product_name = $row['product_name'];
			$description = $row['description'];
			$image = $row['image'];
			$price = $row['price'];
			$dateTime = $row['created_at'];
			$created_date = date("d-m-Y", strtotime($dateTime));

			$EditLink = '<a href="" 
				data-id="' . $id . '" 
				data-category_id="' . $category_id . '" 
				data-bs-toggle="modal" 
				data-bs-target="#editProductionModal" 
				class="btn btn-sm btn-warning editProduction">
				<i class="fas fa-edit"></i> Edit
			</a>';

			$DeleteLink = '<button class="btn btn-sm btn-danger deleteProduction" 
                data-id="' . $id . '">
                <i class="fas fa-trash"></i> Delete
            </button>';

			$Action = $EditLink . ' ' . $DeleteLink;

			
			$row = array();
			$row[] = $id;
			$row[] = $product_name;
			$row[] = $description; 
			$row[] = $image; 
			$row[] = $price; 
			$row[] = $created_date;			
			$row[] = $category_id; 
			$row[] = $Action;
			$data1[] = $row;
			$i++;
		}
		$output = array("data" => $data1);
        //print_r($output);exit;
		return $output;		
	}
}
