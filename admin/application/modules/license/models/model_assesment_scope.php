<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_assesment_scope extends CI_Model
{
    private $table_assesment_scope = 'm_assesment_scope';
    
    private $column_order_assesment_scope = array('m_assesment_scope.id');    
        
    private $order_assesment_scope = array('m_assesment_scope.name_t' => 'desc');    

    private $column_search  = array('code_t', 'name_t'); 


    public function _get_query_assesment_scope()
    {
        $this->db->select('id, code_t, name_t');
        $this->db->from($this->table_assesment_scope);
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
        if (isset($_POST['order_assesment_scope'])) {
            $this->db->order_by($this->column_order_assesment_scope[$_POST['order_assesment_scope']['0']['column']],
                $_POST['order_assesment_scope']['0']['dir']);
        } else
            if (isset($this->table_assesment_scope)) {
                $order_assesment_scope = $this->order_assesment_scope;
                $this->db->order_by(key($order_assesment_scope), $order_assesment_scope[key($order_assesment_scope)]);
            }
    }

    public function get_assesment_scope()
    {
        $this->_get_query_assesment_scope();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_assesment_scope()
    {
        $this->_get_query_assesment_scope();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_assesment_scope()
    {
        $this->db->from($this->table_assesment_scope);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('m_assesment_scope', array('id' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
