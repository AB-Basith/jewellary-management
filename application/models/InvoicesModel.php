<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoicesModel extends CI_Model {

    public function GetRecords() {
        $this->db->select('*');
        $this->db->from('invoices');
        $query = $this->db->get();         
		$result = $query->result_array();
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {		
			$iId = $i; 
			$id = $row['id'];
			$invoice_number = $row['invoice_number'];
			$customer_name = $row['customer_name'];
			$total_amount = $row['total_amount'];
			$dateTime = $row['created_at'];
			$created_date = date("d-m-Y", strtotime($dateTime));

			$EditLink = '<a href="" data-bs-toggle="modal" data-bs-target="#editInvoicesModal" class="btn btn-sm btn-warning editInvoices">
                <i class="fas fa-edit"></i> Edit
            </a>';

			$DeleteLink = '<button class="btn btn-sm btn-danger deleteInvoices" 
                data-id="' . $id . '">
                <i class="fas fa-trash"></i> Delete
            </button>';

			$Action = $EditLink . ' ' . $DeleteLink;

			
			$row = array();
			$row[] = $iId;
			$row[] = $invoice_number;
			$row[] = $customer_name;
			$row[] = $total_amount; 
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
