<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExpensesModel extends CI_Model {

    public function GetRecords() {
        $this->db->select('*');
        $this->db->from('expenses');
        $query = $this->db->get();         
		$result = $query->result_array();
		//print_r($result);exit;
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {		
			$iId = $i; 
			$id = $row['id'];
			$description = $row['description'];
			$amount = $row['amount'];
			$dateTime = $row['created_at'];
			$created_date = date("d-m-Y", strtotime($dateTime));

			$EditLink = '<a href="" data-bs-toggle="modal" data-bs-target="#editExpensesModal" class="btn btn-sm btn-warning editExpenses">
                <i class="fas fa-edit"></i> Edit
            </a>';

			$DeleteLink = '<button class="btn btn-sm btn-danger deleteExpenses" 
                data-id="' . $id . '">
                <i class="fas fa-trash"></i> Delete
            </button>';

			$Action = $EditLink . ' ' . $DeleteLink;

			
			$row = array();
			$row[] = $iId;
			$row[] = $description;
			$row[] = $amount; 
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
