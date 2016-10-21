<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_easa_license extends CI_Model
{
    private $table_gmf_authorization_license          = 'db_license.dbo.vw_amel AS AME';
    private $column_order_gmf_authorization_license   = array('AME.empl_id');            
    private $order_gmf_authorization_license          = array('AME.empl_id' => 'desc');    


    public function _get_query_easa_license()
    {
        $this->db->distinct();
        $this->db->select('AME.empl_id');
        $this->db->from($this->table_ame_license);
        if (isset($_POST['order_ame_license'])) {
            $this->db->order_by($this->column_order_ame_license[$_POST['order_ame_license']['0']['column']],
                $_POST['order_ame_license']['0']['dir']);
        } else
            if (isset($this->order_ame_license)) {
                $order_ame_license = $this->order_ame_license;
                $this->db->order_by(key($order_ame_license), $order_ame_license[key($order_ame_license)]);
            }
    }

    public function get_easa_license()
    {
        $this->_get_query_easa_license();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_easa_license()
    {
        $this->_get_query_easa_license();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_easa_license()
    {
        $this->db->from($this->table_easa_license);
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
