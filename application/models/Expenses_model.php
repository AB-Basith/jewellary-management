<?php
class Expenses_model extends CI_Model {
    
    public function get_all_expenses() {
        $this->db->order_by('expense_date', 'DESC');
        return $this->db->get('expenses')->result();
    }
    
    public function get_expense_by_id($id) {
        return $this->db->get_where('expenses', array('id' => $id))->row();
    }
    
    public function add_expense($data) {
        return $this->db->insert('expenses', $data);
    }
    
    public function update_expense($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('expenses', $data);
    }
    
    public function delete_expense($id) {
        return $this->db->delete('expenses', array('id' => $id));
    }
    
    public function get_expense_stats() {
        $stats = array();
        
        // Monthly expenses
        $this->db->select('SUM(amount) as monthly_total');
        $this->db->where('MONTH(expense_date)', date('m'));
        $this->db->where('YEAR(expense_date)', date('Y'));
        $query = $this->db->get('expenses');
        $stats['monthly_total'] = $query->row()->monthly_total ?? 0;
        
        // Expenses by category
        $this->db->select('category, SUM(amount) as total');
        $this->db->where('MONTH(expense_date)', date('m'));
        $this->db->where('YEAR(expense_date)', date('Y'));
        $this->db->group_by('category');
        $query = $this->db->get('expenses');
        $stats['by_category'] = $query->result();
        
        return $stats;
    }
}
?>