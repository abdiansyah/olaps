<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_type extends CI_Model
{
    private $table_type = 'm_auth_type';
    private $column_order_type = array('m_auth_type.name_t');            
    private $order_type = array('m_auth_type.id' => 'desc');    


    public function _get_query_type()
    {
        $this->db->select('id, name_t, desc_t');
        $this->db->from($this->table_type);
        if (isset($_POST['order_type'])) {
            $this->db->order_by($this->column_order_type[$_POST['order_type']['0']['column']],
                $_POST['order_type']['0']['dir']);
        } else
            if (isset($this->order_type)) {
                $order_type = $this->order_type;
                $this->db->order_by(key($order_type), $order_type[key($order_type)]);
            }
    }

    public function get_type()
    {
        $this->_get_query_type();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_type()
    {
        $this->_get_query_type();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_type()
    {
        $this->db->from($this->table_type);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('m_auth_type', array('id' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
