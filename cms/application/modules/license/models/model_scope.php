<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_scope extends CI_Model
{
    private $table_scope = 'm_auth_scope';
    private $column_order_scope = array('m_auth_scope.name_t');            
    private $order_scope = array('m_auth_scope.id' => 'desc');    
    private $column_search  = array('name_t','desc_t'); 

    public function _get_query_scope()
    {
        $this->db->select('id, name_t, desc_t');
        $this->db->from($this->table_scope);
        $i = 0;
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {
                if($i===0){ 
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order_scope'])) {
            $this->db->order_by($this->column_order_scope[$_POST['order_scope']['0']['column']],
                $_POST['order_scope']['0']['dir']);
        } else
            if (isset($this->order_scope)) {
                $order_scope = $this->order_scope;
                $this->db->order_by(key($order_scope), $order_scope[key($order_scope)]);
            }
    }

    public function get_scope()
    {
        $this->_get_query_scope();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_scope()
    {
        $this->_get_query_scope();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_scope()
    {
        $this->db->from($this->table_scope);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('m_auth_scope', array('id' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_scope_information.php */
/* Location: ./application/modules/back_office/models/model_scope_information.php */
