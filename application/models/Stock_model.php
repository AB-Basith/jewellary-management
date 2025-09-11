<?php
class Stock_model extends CI_Model {
    
    public function get_all_stock() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('stock')->result();
    }
    
    public function get_stock_by_id($id) {
        return $this->db->get_where('stock', array('id' => $id))->row_array();
    }
    
    public function add_stock($data) {
        return $this->db->insert('stock', $data);
    }
    
    public function update_stock($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('stock', $data);
    }
    
    public function delete_stock($id) {
        return $this->db->delete('stock', array('id' => $id));
    }
    
    public function get_low_stock($threshold = 10) {
        $this->db->where('gram <', $threshold);
        return $this->db->get('stock')->result();
    }
}
?>