<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_authorization extends CI_Model
{
    private $table_authorization = 'm_auth_license';
    private $column_order_authorization = array('m_auth_license.name_t');            
    private $order_authorization = array('m_auth_license.id' => 'desc');    


    public function _get_query_authorization()
    {
        $this->db->select('id, name_t, desc_t');
        $this->db->from($this->table_authorization);
        if (isset($_POST['order_authorization'])) {
            $this->db->order_by($this->column_order_authorization[$_POST['order_authorization']['0']['column']],
                $_POST['order_authorization']['0']['dir']);
        } else
            if (isset($this->order_authorization)) {
                $order_authorization = $this->order_authorization;
                $this->db->order_by(key($order_authorization), $order_authorization[key($order_authorization)]);
            }
    }

    public function get_authorization()
    {
        $this->_get_query_authorization();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_authorization()
    {
        $this->_get_query_authorization();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_authorization()
    {
        $this->db->from($this->table_authorization);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('m_auth_license', array('id' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
