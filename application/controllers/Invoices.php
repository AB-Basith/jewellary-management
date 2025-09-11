<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Invoices_model');
        $this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper(array('form', 'url', 'string', 'download'));
    }

    public function index() {
        $data['title'] = 'Invoices Management';
        $data['invoices'] = $this->Invoices_model->get_all_invoices();
        $data['stats'] = $this->Invoices_model->get_invoice_stats();
        
        $this->load->view('templates/header', $data);
        $this->load->view('invoices/index', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $data['title'] = 'Create Invoice';
        
        if ($this->input->post()) {
            $total_amount = $this->input->post('total_amount');
            $tax_amount = $this->input->post('tax_amount');
            $discount_amount = $this->input->post('discount_amount');
            
            $invoice_data = array(
                'invoice_number' => $this->Invoices_model->generate_invoice_number(),
                'customer_name' => $this->input->post('customer_name'),
                'customer_email' => $this->input->post('customer_email'),
                'total_amount' => $total_amount + $tax_amount - $discount_amount,
                'tax_amount' => $tax_amount,
                'discount_amount' => $discount_amount,
                'status' => $this->input->post('status'),
                'invoice_date' => $this->input->post('invoice_date'),
                'due_date' => $this->input->post('due_date')
            );

            // $this->billing($invoice_data);
            
            if ($this->Invoices_model->add_invoice($invoice_data)) {
                $this->session->set_flashdata('success', 'Invoice created successfully!');
                redirect('invoices');
            } else {
                $this->session->set_flashdata('error', 'Failed to create invoice.');
            }
        }

       
        
        $this->load->view('templates/header', $data);
        $this->load->view('invoices/add', $data);
        $this->load->view('templates/footer');
    }

    public function view($id) {
        $data['title'] = 'View Invoice';
        $data['invoice'] = $this->Invoices_model->get_invoice_by_id($id);
        
        if (!$data['invoice']) {
            show_404();
        }
        
        if ($this->input->post()) {
            $total_amount = $this->input->post('total_amount');
            $tax_amount = $this->input->post('tax_amount');
            $discount_amount = $this->input->post('discount_amount');
            
            $invoice_data = array(
                'customer_name' => $this->input->post('customer_name'),
                'customer_email' => $this->input->post('customer_email'),
                'total_amount' => $total_amount + $tax_amount - $discount_amount,
                'tax_amount' => $tax_amount,
                'discount_amount' => $discount_amount,
                'status' => $this->input->post('status'),
                'invoice_date' => $this->input->post('invoice_date'),
                'due_date' => $this->input->post('due_date')
            );
            
            // $this->billing($invoice_data);

            if ($this->Invoices_model->update_invoice($id, $invoice_data)) {
                $this->session->set_flashdata('success', 'Invoice updated successfully!');
                redirect('invoices');
            } else {
                $this->session->set_flashdata('error', 'Failed to update invoice.');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('invoices/view', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id) {
        if ($this->Invoices_model->delete_invoice($id)) {
            $this->session->set_flashdata('success', 'Invoice deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete invoice.');
        }
        redirect('invoices');
    }

    //public function billing($invoice_data) {
    public function billing() {

        //$this->billing();
        // $data['title'] = 'View Invoice';
        // $data['invoice'] = $this->Invoices_model->get_invoice_by_id($id);

        // if (!$data['invoice']) {
        //     show_404();
        // }

        // $this->load->view('templates/header', $data);
        // $this->load->view('invoices/view_billing', $data);
        // $this->load->view('templates/footer');
        
        $pdf = new FPDF();
        $pdf->AddPage();

        // Invoice Header        
        $pdf->Image(base_url('assets/img/AGH_logo.jpeg'),5,5,45); 
        $pdf->SetFont('Courier','B',65);
        $pdf->Cell(160,18,'AYISHA',0,1,'C');
        $pdf->SetFont('Arial','B',25);
        $pdf->Cell(160,12,'Gold House ',0,1,'C');
        $pdf->Line(10, 45, 200, 45); // Vertical line

        $pdf->Line(140, 5, 140, 40); // Horizontal line
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(147, 10);
        $pdf->MultiCell(60, 6, "# 17 B,School Street, \nOpposite Jinnah Thidal, \nMelapalayam - 627 005.\nTel: 97915 78185 \n       98946 60593", 0, 'L');

        // ========= CUSTOMER DETAILS ==========
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(10, 50);
        $pdf->Cell(20,8,"To.",0,0);

        $pdf->SetXY(140, 50);
        $pdf->Cell(20,8,"Sl. No. :",0,1);

        $pdf->SetXY(140, 57);
        $pdf->Cell(20,8,"Date :",0,1);

        $pdf->SetXY(140, 64);
        $pdf->Cell(20,8,"GST :",0,1);

        $pdf->Line(10, 77, 200, 77);

        // ========= TABLE HEADER ==========
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(10, 82);
        $pdf->Cell(20,10,"S.No",1,0,'C');
        $pdf->Cell(80,10,"Description",1,0,'C');
        $pdf->Cell(30,10,"Weight (g)",1,0,'C');
        $pdf->Cell(30,10,"Rate",1,0,'C');
        $pdf->Cell(30,10,"Amount (Rs.)",1,1,'C');

                
        // ========= TOTAL SECTION ==========
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(160,8,"Amount",1,0,'R');
        $pdf->Cell(30,8,"",1,1,'C');

        $pdf->Cell(160,8,"CGST",1,0,'R');
        $pdf->Cell(30,8,"",1,1,'C');

        $pdf->Cell(160,8,"SGST",1,0,'R');
        $pdf->Cell(30,8,"",1,1,'C');

        $pdf->Cell(160,8,"Round Off",1,0,'R');
        $pdf->Cell(30,8,"",1,1,'C');

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(160,10,"TOTAL",1,0,'R');
        $pdf->Cell(30,10,"",1,1,'C');

        // ========= DECLARATION ==========
        $pdf->SetFont('Arial','I',8);
        $pdf->SetXY(10, 190);
        $pdf->MultiCell(120,4,"Declaration:\nWe declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.\nE & OE Goods once sold will not be taken back.");

        // ========= SIGNATURE ==========
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(140, 190);
        $pdf->Cell(60,10,"For AYISHA GOLD HOUSE",0,1,'C');

        $pdf->SetXY(10, 260);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(60,8,"Receiver's Sign ___________________",0,0);

        $pdf->Output();

// // ========= TABLE ROWS (dummy rows) ==========
// $pdf->SetFont('Arial','',11);
// for($i=1; $i<=5; $i++){
//     $pdf->Cell(20,10,$i,1,0,'C');
//     $pdf->Cell(80,10,"Item $i",1,0);
//     $pdf->Cell(30,10,"",1,0,'C');
//     $pdf->Cell(30,10,"",1,0,'C');
//     $pdf->Cell(30,10,"",1,1,'C');
// }
        
    }
}


?>