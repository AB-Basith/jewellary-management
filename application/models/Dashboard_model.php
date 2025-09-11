<?php
class Dashboard_model extends CI_Model {
    
    public function get_overview_stats() {
        $stats = array();
        
        // Total stock value
        $this->db->select('SUM(quantity * unit_price) as total_stock_value');
        $stock_query = $this->db->get('stock');
        $stats['total_stock_value'] = $stock_query->row()->total_stock_value ?? 0;
        
        // Total sales this month
        $this->db->select('SUM(total_amount) as monthly_sales');
        $this->db->where('MONTH(sale_date)', date('m'));
        $this->db->where('YEAR(sale_date)', date('Y'));
        $sales_query = $this->db->get('sales');
        $stats['monthly_sales'] = $sales_query->row()->monthly_sales ?? 0;
        
        // Total expenses this month
        $this->db->select('SUM(amount) as monthly_expenses');
        $this->db->where('MONTH(expense_date)', date('m'));
        $this->db->where('YEAR(expense_date)', date('Y'));
        $expense_query = $this->db->get('expenses');
        $stats['monthly_expenses'] = $expense_query->row()->monthly_expenses ?? 0;
        
        // Pending invoices
        $this->db->where('status', 'sent');
        $stats['pending_invoices'] = $this->db->count_all_results('invoices');
        
        return $stats;
    }
    
    public function get_recent_sales($limit = 5) {
        $this->db->select('s.*, st.product_name');
        $this->db->from('sales s');
        $this->db->join('stock st', 's.product_id = st.id', 'left');
        $this->db->order_by('s.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
}
?>