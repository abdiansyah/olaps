<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_requirement extends CI_Model
{
    private $table_specific = 'm_group_scope_category';
    private $table_general = 'm_group_license_req_general';
    
    private $column_specific = array('mal.name_t');
    private $column_general = array('mal.name_t');    
        
    private $order_specific = array('mal.name_t' => 'desc');
    private $order_general = array('mal.name_t' => 'desc');    


    public function _get_query_specific()
    {
        $this->db->select('mgsc.id AS id_req_spec, mal.name_t AS name_license, mat.name_t AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope, maars.name_t AS name_requirement');
        $this->db->from('m_group_scope_category AS mgsc');
        $this->db->join('m_auth_license AS mal','mgsc.id_auth_license_fk = mal.id','left');
        $this->db->join('m_auth_type AS mat','mgsc.id_auth_type_fk = mat.id','left');
        $this->db->join('m_auth_spect AS masp','mgsc.id_auth_license_fk = masp.id','left');
        $this->db->join('m_auth_category AS mac','mgsc.id_auth_category_fk = mac.id','left');
        $this->db->join('m_auth_scope AS mas','mgsc.id_auth_scope_fk = mas.id','left');
        $this->db->join('m_auth_additional_req_spec AS maars','mgsc.id_auth_additional_req_spec_fk = maars.id','left');
        if (isset($_POST['order_specific'])) {
            $this->db->order_by($this->column_specific[$_POST['order_specific']['0']['column']],
                $_POST['order_specific']['0']['dir']);
        } else
            if (isset($this->order_specific)) {
                $order_specific = $this->order_specific;
                $this->db->order_by(key($order_specific), $order_specific[key($order_specific)]);
            }
    }

    public function get_specific()
    {
        $this->_get_query_specific();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_specific()
    {
        $this->_get_query_specific();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_specific()
    {
        $this->db->from($this->table_specific);
        return $this->db->count_all_results();
    }
    
    public function _get_query_general()
    {
        $this->db->select('mglrg.id AS id_req_general, mal.name_t AS name_license, mat.name_t AS name_type, masp.name_t AS name_spect, maarg.name_t AS name_requirement');
        $this->db->from('m_group_license_req_general AS mglrg');
        $this->db->join('m_auth_license AS mal','mglrg.id_auth_license_fk = mal.id','left');
        $this->db->join('m_auth_type AS mat','mglrg.id_auth_type_fk = mat.id','left');
        $this->db->join('m_auth_spect AS masp','mglrg.id_auth_spect_fk = masp.id','left');        
        $this->db->join('m_auth_additional_req_general AS maarg','mglrg.id_auth_additional_req_general_fk = maarg.id','left');
        if (isset($_POST['order_general'])) {
            $this->db->order_by($this->column_general[$_POST['order_general']['0']['column']],
                $_POST['order_general']['0']['dir']);
        } else
            if (isset($this->order_general)) {
                $order_general = $this->order_general;
                $this->db->order_by(key($order_general), $order_general[key($order_general)]);
            }
    }
    
    public function get_general()
    {
        $this->_get_query_general();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_general()
    {
        $this->_get_query_general();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_general()
    {
        $this->db->from($this->table_general);
        return $this->db->count_all_results();
    }
            
    public function by_specific_id($id)
    {                
        $this->db->select('mgsc.id AS id_req_spec, mal.id AS id_license, mal.name_t AS name_license, mat.id AS id_type, mat.name_t AS name_type, masp.id AS id_spect, masp.name_t AS name_spect, mac.id AS id_category, mac.name_t AS name_category, mas.id AS id_scope, mas.name_t AS name_scope, masc.id AS id_assesment_scope, masc.name_t AS name_assesment_scope, maars.id AS id_requirement, maars.name_t AS name_requirement, mgsc.new_auth, mgsc.renewal, mgsc.additional, mgsc.ratting_change, mgsc.category_continous, mgsc.age_requirement, mgsc.category_admin, mgsc.scope_code');
        $this->db->from('m_group_scope_category AS mgsc');
        $this->db->join('m_auth_license AS mal','mgsc.id_auth_license_fk = mal.id','left');
        $this->db->join('m_auth_type AS mat','mgsc.id_auth_type_fk = mat.id','left');
        $this->db->join('m_auth_spect AS masp','mgsc.id_auth_license_fk = masp.id','left');
        $this->db->join('m_auth_category AS mac','mgsc.id_auth_category_fk = mac.id','left');
        $this->db->join('m_auth_scope AS mas','mgsc.id_auth_scope_fk = mas.id','left');
        $this->db->join('m_assesment_scope AS masc','mgsc.id_assesment_scope_fk = masc.id','left');
        $this->db->join('m_auth_additional_req_spec AS maars','mgsc.id_auth_additional_req_spec_fk = maars.id','left');
        $this->db->where('mgsc.id', $id);
        $datasrc = $this->db->get();         
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
    
    public function by_general_id($id)
    {                
        $this->db->select('mglrg.id AS id_req_general, mal.id AS id_license, mal.name_t AS name_license, mat.id AS id_type, mat.name_t AS name_type, masp.id AS id_spect, masp.name_t AS name_spect, maarg.id AS id_requirement, maarg.name_t AS name_requirement, mglrg.category_continous, mglrg.age_requirement, mglrg.category_admin');
        $this->db->from('m_group_license_req_general AS mglrg');
        $this->db->join('m_auth_license AS mal','mglrg.id_auth_license_fk = mal.id','left');
        $this->db->join('m_auth_type AS mat','mglrg.id_auth_type_fk = mat.id','left');
        $this->db->join('m_auth_spect AS masp','mglrg.id_auth_license_fk = masp.id','left');        
        $this->db->join('m_auth_additional_req_general AS maarg','mglrg.id_auth_additional_req_general_fk = maarg.id','left');
        $this->db->where('mglrg.id', $id);
        $datasrc = $this->db->get();         
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
