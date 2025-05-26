<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockModel extends CI_Model {

    function __construct(){
        parent::__construct();
		$this->stock = 'stock';
	}

    public function GetRecords() {
        $this->db->select('*');
        $this->db->from($this->stock);
        $query = $this->db->get();         
		$result = $query->result_array();
		//print_r($result);exit;
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {		
			$iId = $i; 
			$id = $row['id'];
			$category_name = $row['category_name'];
			$dateTime = $row['created_at'];
			$created_date = date("d-m-Y", strtotime($dateTime));

			$EditLink = '<a href="" data-bs-toggle="modal" data-bs-target="#editStockModal" class="btn btn-sm btn-warning editStock">
                <i class="fas fa-edit"></i> Edit
            </a>';

			$DeleteLink = '<button class="btn btn-sm btn-danger deleteStock" 
                data-id="' . $id . '">
                <i class="fas fa-trash"></i> Delete
            </button>';

			$Action = $EditLink . ' ' . $DeleteLink;
			
			$row = array();
			$row[] = $iId;
			$row[] = $category_name;
			$row[] = $created_date; 
			$row[] = $Action;
			$data1[] = $row;
			$i++;
		}
		$output = array("data" => $data1);
		return $output;		
	}

	
	//get category details
	public function get_all_categories(){
		 $this->db->select('*');
        $this->db->from($this->stock);
        $query = $this->db->get();         
		$result = $query->result_array();   
		return $result; 
    }

	public function get_categories_by_id($id)
	{
		return $this->db->get_where('stock', ['id' => $id])->row_array();
	}

	
}
