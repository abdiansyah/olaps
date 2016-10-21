<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_cofc_license extends CI_Model
{
    private $table_cofc_license          = 'db_license.dbo.tbl_cofc AS COFC';
    private $column_order_cofc_license   = array('COFC.empl_id');            
    private $order_cofc_license          = array('COFC.empl_id' => 'desc');    


    public function _get_query_cofc_license()
    {   
        $this->db->distinct();     
        $this->db->select('COFC.empl_id, TSH.name, TSH.departement, COFC.stamp_no, COFC.valid_until');
        $this->db->from($this->table_cofc_license);
        $this->db->join('UNION_EMP AS TSH','CONVERT(VARCHAR(20),COFC.empl_id) = CONVERT(VARCHAR(20),TSH.personnel_number)');                            
        if (isset($_POST['order_cofc_license'])) {
            $this->db->order_by($this->column_order_cofc_license[$_POST['order_cofc_license']['0']['column']],
                $_POST['order_cofc_license']['0']['dir']);
        } else
            if (isset($this->order_cofc_license)) {
                $order_cofc_license = $this->order_cofc_license;
                $this->db->order_by(key($order_cofc_license), $order_cofc_license[key($order_cofc_license)]);
            }
    }

    public function get_cofc_license()
    {        
        $this->_get_query_cofc_license();        
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_cofc_license()
    {
        $this->_get_query_cofc_license();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_cofc_license()
    {
        $this->db->from($this->table_cofc_license);
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
