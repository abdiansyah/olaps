<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_spect extends CI_Model
{
    private $table_spect = 'm_auth_spect';
    private $column_order_spect = array('m_auth_spect.name_t');            
    private $order_spect = array('m_auth_spect.id' => 'desc');    
    private $column_search  = array('name_t','desc_t'); 


    public function _get_query_spect()
    {
        $this->db->select('id, name_t, desc_t');
        $this->db->from($this->table_spect);
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
        if (isset($_POST['order_spect'])) {
            $this->db->order_by($this->column_order_spect[$_POST['order_spect']['0']['column']],
                $_POST['order_spect']['0']['dir']);
        } else
            if (isset($this->order_spect)) {
                $order_spect = $this->order_spect;
                $this->db->order_by(key($order_spect), $order_spect[key($order_spect)]);
            }
    }

    public function get_spect()
    {
        $this->_get_query_spect();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_spect()
    {
        $this->_get_query_spect();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_spect()
    {
        $this->db->from($this->table_spect);
        return $this->db->count_all_results();
    }
    
    public function by_id($id)
    {        
        $datasrc = $this->db->get_where('m_auth_spect', array('id' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_spect_information.php */
/* Location: ./application/modules/back_office/models/model_spect_information.php */
