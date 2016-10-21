<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_authorization_group extends CI_Model
{
    private $table_license_type = 'm_group_type_license';
    private $table_type_spect = 'm_group_spect_type';
    
    private $column_license_type = array('mal.name_t');
    private $column_type_spect = array('mat.name_t');    
        
    private $order_license_type = array('mal.name_t' => 'desc');
    private $order_type_spect = array('mat.name_t' => 'desc');    


    public function _get_query_license_type()
    {
        $this->db->select('mgtl.id AS id_license_type, mal.name_t AS name_license, mat.name_t AS name_type');
        $this->db->from('m_group_type_license AS mgtl');
        $this->db->join('m_auth_license AS mal','mgtl.id_auth_license_fk = mal.id','left');
        $this->db->join('m_auth_type AS mat','mgtl.id_auth_type_fk = mat.id','left');        
        if (isset($_POST['order_license_type'])) {
            $this->db->order_by($this->column_license_type[$_POST['order_license_type']['0']['column']],
                $_POST['order_license_type']['0']['dir']);
        } else
            if (isset($this->order_license_type)) {
                $order_license_type = $this->order_license_type;
                $this->db->order_by(key($order_license_type), $order_license_type[key($order_license_type)]);
            }
    }

    public function get_license_type()
    {
        $this->_get_query_license_type();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_license_type()
    {
        $this->_get_query_license_type();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_license_type()
    {
        $this->db->from($this->table_license_type);
        return $this->db->count_all_results();
    }
    
    public function _get_query_type_spect()
    {
        $this->db->select('mgst.id AS id_type_spect, mat.id AS id_type, mat.name_t AS name_type, masp.id AS id_spect, masp.name_t AS name_spect');
        $this->db->from('m_group_spect_type AS mgst');        
        $this->db->join('m_auth_type AS mat','mgst.id_auth_type_fk = mat.id','left');
        $this->db->join('m_auth_spect AS masp','mgst.id_auth_spect_fk = masp.id','left'); 
        if (isset($_POST['order_type_spect'])) {
            $this->db->order_by($this->column_type_spect[$_POST['order_type_spect']['0']['column']],
                $_POST['order_type_spect']['0']['dir']);
        } else
            if (isset($this->order_type_spect)) {
                $order_type_spect = $this->order_type_spect;
                $this->db->order_by(key($order_type_spect), $order_type_spect[key($order_type_spect)]);
            }
    }
    
    public function get_type_spect()
    {
        $this->_get_query_type_spect();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    
    public function count_filtered_type_spect()
    {
        $this->_get_query_type_spect();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_type_spect()
    {
        $this->db->from($this->table_type_spect);
        return $this->db->count_all_results();
    }
            
    public function by_license_type_id($id)
    {                
        $this->db->select('mgtl.id AS id_license_type, mal.name_t AS name_license, mat.name_t AS name_type');
        $this->db->from('m_group_type_license AS mgtl');
        $this->db->join('m_auth_license AS mal','mgtl.id_auth_license_fk = mal.id','left');
        $this->db->join('m_auth_type AS mat','mgtl.id_auth_type_fk = mat.id','left');        
        $this->db->where('mgtl.id', $id);
        $datasrc = $this->db->get();         
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
    
    public function by_type_spect_id($id)
    {                
        $this->db->select('mgst.id AS id_type_spect, mat.id AS id_type, mat.name_t AS name_type, masp.id AS id_spect, masp.name_t AS name_spect');
        $this->db->from('m_group_spect_type AS mgst');        
        $this->db->join('m_auth_type AS mat','mgst.id_auth_type_fk = mat.id','left');
        $this->db->join('m_auth_spect AS masp','mgst.id_auth_spect_fk = masp.id','left');            
        $this->db->where('mgst.id', $id);
        $datasrc = $this->db->get();         
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }

    public function show_ajax_type($id_license){
        $query = "
            SELECT mgtl.id_auth_type_fk, mat.name_t FROM m_group_type_license AS mgtl
            LEFT JOIN m_auth_type AS mat ON mgtl.id_auth_type_fk = mat.id
            WHERE mgtl.id_auth_license_fk = '{$id_license}'
        ";
        return $this->db->query($query);
    }
       

}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
