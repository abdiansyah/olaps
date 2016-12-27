<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_requirement_management extends CI_Model
{
    private $table_specific = 'm_auth_additional_req_spec AS maars';    
    private $table_general = 'm_auth_additional_req_general AS maarg';
    
    private $column_req_specific = array('maars.name_t');
    private $column_req_general = array('maarg.name_t');    
        
    private $order_req_specific = array('maars.name_t' => 'desc');
    private $order_req_general = array('maarg.name_t' => 'desc');    

    private $column_req_search_specific  = array('maars.name_t');  
    private $column_req_search_general  = array('maarg.name_t');  


    public function _get_query_req_specific()
    {
        $this->db->select('maars.id, maars.name_t, mdr.name');        
        $this->db->join('m_dir_requirement AS mdr','mdr.code = maars.code_folder','left');
        $this->db->from($this->table_specific);
        $i = 0;
        foreach ($this->column_req_search_specific as $item) {
            if($_POST['search']['value']) {
                if($i===0){ 
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                
                if(count($this->column_req_search_specific) - 1 == $i) 
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order_req_specific'])) {
            $this->db->order_by($this->column_req_specific[$_POST['order_req_specific']['0']['column']],
                $_POST['order_req_specific']['0']['dir']);
        } else
            if (isset($this->order_req_specific)) {
                $order_req_specific = $this->order_req_specific;
                $this->db->order_by(key($order_req_specific), $order_req_specific[key($order_req_specific)]);
            }
    }

    public function get_req_specific()
    {
        $this->_get_query_req_specific();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_req_specific()
    {
        $this->_get_query_req_specific();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_req_specific()
    {
        $this->db->from($this->table_specific);
        return $this->db->count_all_results();
    }
    
    public function _get_query_req_general()
    {
        $this->db->select('maarg.id, maarg.name_t, mdr.name');        
        $this->db->join('m_dir_requirement AS mdr','mdr.code = maarg.code_folder','left');
        $this->db->from($this->table_general);
        $i = 0;
        foreach ($this->column_req_search_general as $item) {
            if($_POST['search']['value']) {
                if($i===0){ 
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                
                if(count($this->column_req_search_general) - 1 == $i) 
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order_req_general'])) {
            $this->db->order_by($this->column_req_general[$_POST['order_req_general']['0']['column']],
                $_POST['order_req_general']['0']['dir']);
        } else
            if (isset($this->order_req_general)) {
                $order_req_general = $this->order_req_general;
                $this->db->order_by(key($order_req_general), $order_req_general[key($order_req_general)]);
            }
    }
    
    public function get_req_general()
    {
        $this->_get_query_req_general();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_req_general()
    {
        $this->_get_query_req_general();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_req_general()
    {
        $this->db->from($this->table_general);
        return $this->db->count_all_results();
    }
            
    public function by_req_specific_id($id)
    {                
        $this->db->select('maars.id, (maars.code_t) AS code_req_spec, (maars.name_t) AS name_req_spec, (maars.code_folder) AS code_folder_spec, (mdr.name) AS name_folder_spec');        
        $this->db->from('m_auth_additional_req_spec AS maars');        
        $this->db->join('m_dir_requirement AS mdr','mdr.code = maars.code_folder');
        $this->db->where('maars.id', $id);
        $datasrc = $this->db->get();         
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
    
    public function by_req_general_id($id)
    {                
        $this->db->select('maarg.id, (maarg.code_t) AS code_req_general, (maarg.name_t) AS name_req_general, (maarg.code_folder) AS code_folder_general,(mdr.name) AS name_folder_general');
        $this->db->from('m_auth_additional_req_general AS maarg');        
        $this->db->join('m_dir_requirement AS mdr','mdr.code = maarg.code_folder');
        $this->db->where('maarg.id', $id);
        $datasrc = $this->db->get();         
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
