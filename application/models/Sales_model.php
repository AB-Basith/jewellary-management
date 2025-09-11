<?php
class Sales_model extends CI_Model {
    
    public function get_all_sales() {
        $this->db->select('s.*, st.product_name');
        $this->db->from('sales s');
        $this->db->join('stock st', 's.product_id = st.id', 'left');
        $this->db->order_by('s.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_sale_by_id($id) {
        $this->db->select('s.*, st.product_name');
        $this->db->from('sales s');
        $this->db->join('stock st', 's.product_id = st.id', 'left');
        $this->db->where('s.id', $id);
        return $this->db->get()->row();
    }
    
    public function add_sale($data) {
        return $this->db->insert('sales', $data);
    }

    public function get_sale($id)
    {
        return $this->db->where('id', $id)->get('sales')->row_array();
    }

    public function update_sale($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('sales', $data);
    }

    public function delete_sale($id) {
        return $this->db->delete('sales', array('id' => $id));
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