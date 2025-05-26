<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesModel extends CI_Model {


    public function GetRecords() {
        $this->db->select('*');
        $this->db->from('sales');
        $query = $this->db->get();         
		$result = $query->result_array();
		//print_r($result);exit;
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {		
			$iId = $i; 
			$id = $row['id'];
			$product_name = $row['product_name'];
			$total_price = $row['total_price'];
			$quantity = $row['quantity'];
			$dateTime = $row['created_at'];
			$created_date = date("d-m-Y", strtotime($dateTime));

			$EditLink = '<a href="" data-bs-toggle="modal" data-bs-target="#editSalesModal" class="btn btn-sm btn-warning editSales">
                <i class="fas fa-edit"></i> Edit
            </a>';

			$DeleteLink = '<button class="btn btn-sm btn-danger deleteSales" 
                data-id="' . $id . '">
                <i class="fas fa-trash"></i> Delete
            </button>';

			$Action = $EditLink . ' ' . $DeleteLink;

			
			$row = array();
			$row[] = $iId;
			$row[] = $product_name;
			$row[] = $total_price; 
			$row[] = $quantity; 
			$row[] = $created_date; 
			$row[] = $Action;
			$data1[] = $row;
			$i++;
		}
		$output = array("data" => $data1);
        //print_r($output);exit;
		return $output;		
	}

}
