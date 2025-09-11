<?php
class Invoices_model extends CI_Model {
    
    public function get_all_invoices() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('invoices')->result();
    }
    
    public function get_invoice_by_id($id) {
        return $this->db->get_where('invoices', array('id' => $id))->row();
    }
    
    public function add_invoice($data) {
        return $this->db->insert('invoices', $data);
    }
    
    public function update_invoice($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('invoices', $data);
    }
    
    public function delete_invoice($id) {
        return $this->db->delete('invoices', array('id' => $id));
    }
    
    public function get_invoice_stats() {
        $stats = array();
        
        // Total invoices
        $stats['total_invoices'] = $this->db->count_all('invoices');
        
        // By status
        $this->db->select('status, COUNT(*) as count, SUM(total_amount) as total');
        $this->db->group_by('status');
        $query = $this->db->get('invoices');
        $stats['by_status'] = $query->result();
        
        // Overdue invoices
        $this->db->where('status', 'sent');
        $this->db->where('due_date <', date('Y-m-d'));
        $stats['overdue_count'] = $this->db->count_all_results('invoices');
        
        return $stats;
    }
    
    public function generate_invoice_number() {
        $this->db->select('invoice_number');
        $this->db->like('invoice_number', 'INV-'.date('Y'));
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('invoices');
        
        if ($query->num_rows() > 0) {
            $last_invoice = $query->row();
            $last_number = (int)substr($last_invoice->invoice_number, -3);
            $new_number = str_pad($last_number + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $new_number = '001';
        }
        
        return 'INV-'.date('Y').'-'.$new_number;
    }
}
?>