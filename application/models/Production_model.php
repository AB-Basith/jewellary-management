<?php
class Production_model extends CI_Model {
    
    public function get_all_production() {
        $this->db->select('p.*, st.product_name');
        $this->db->from('production p');
        $this->db->join('stock st', 'p.product_id = st.id', 'left');
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_production_by_id($id) {
        $this->db->select('p.*, st.product_name');
        $this->db->from('production p');
        $this->db->join('stock st', 'p.product_id = st.id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row_array();
    }
    
    public function add_production($data) {
        return $this->db->insert('production', $data);
    }
    
    public function update_production($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('production', $data);
    }
    
    public function delete_production($id) {
        return $this->db->delete('production', array('id' => $id));
    }
    
    public function get_production_stats() {
        $stats = array();
        
        // Total production this month
        $this->db->select('SUM(quantity_produced) as monthly_production');
        $this->db->where('MONTH(production_date)', date('m'));
        $this->db->where('YEAR(production_date)', date('Y'));
        $query = $this->db->get('production');
        $stats['monthly_production'] = $query->row()->monthly_production ?? 0;
        
        // Production by status
        $this->db->select('status, COUNT(*) as count');
        $this->db->group_by('status');
        $query = $this->db->get('production');
        $stats['by_status'] = $query->result();
        
        return $stats;
    }
    
    public function get_products_for_select() {
        $this->db->select('id, product_name');
        $query = $this->db->get('stock');
        $products = array();
        foreach ($query->result() as $row) {
            $products[$row->id] = $row->product_name;
        }
        return $products;
    }
}
?>