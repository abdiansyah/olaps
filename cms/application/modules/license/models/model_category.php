<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_category extends CI_Model
{
    private $table_category = 'm_auth_category';
    private $column_order_category = array('m_auth_category.name_t');            
    private $order_category = array('m_auth_category.id' => 'desc');    


    public function _get_query_category()
    {
        $this->db->select('id, name_t, desc_t');
        $this->db->from($this->table_category);
        if (isset($_POST['order_category'])) {
            $this->db->order_by($this->column_order_category[$_POST['order_category']['0']['column']],
                $_POST['order_category']['0']['dir']);
        } else
            if (isset($this->order_category)) {
                $order_category = $this->order_category;
                $this->db->order_by(key($order_category), $order_category[key($order_category)]);
            }
    }

    public function get_category()
    {
        $this->_get_query_category();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_category()
    {
        $this->_get_query_category();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_category()
    {
        $this->db->from($this->table_category);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('m_auth_category', array('id' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
