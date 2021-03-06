<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_customer_authorization_license extends CI_Model
{
    private $table_customer_authorization_license          = 'db_license.dbo.tbl_authl AS GMF';
    private $column_order_customer_authorization_license   = array('GMF.empl_id');            
    private $order_customer_authorization_license          = array('GMF.empl_id' => 'desc');    


    public function _get_query_customer_authorization_license()
    {   
        $this->db->distinct();     
        $this->db->select('GMF.empl_id, TSH.name, TSH.departement, GMF.lic_no, GMF.lic_status, GMF.stamp_no, GMF.valid_from, GMF.valid_until');
        $this->db->from($this->table_customer_authorization_license);
        $this->db->join('UNION_EMP AS TSH','CONVERT(VARCHAR(20),GMF.empl_id) = CONVERT(VARCHAR(20),TSH.personnel_number)');
        $this->db->join('db_license.dbo.tbl_authl_scope AS TALS','TALS.lic_no = GMF.lic_no');
        $this->db->join('db_license.dbo.tbl_master_scopes AS TMS','TMS.scp_code = TALS.scp_code');
        $this->db->like('stamp_no','GMF');
        
        if (isset($_POST['order_customer_authorization_license'])) {
            $this->db->order_by($this->column_order_customer_authorization_license[$_POST['order_customer_authorization_license']['0']['column']],
                $_POST['order_customer_authorization_license']['0']['dir']);
        } else
            if (isset($this->order_customer_authorization_license)) {
                $order_customer_authorization_license = $this->order_customer_authorization_license;
                $this->db->order_by(key($order_customer_authorization_license), $order_customer_authorization_license[key($order_customer_authorization_license)]);
            }
    }

    public function get_customer_authorization_license()
    {        
        $this->_get_query_customer_authorization_license();        
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_customer_authorization_license()
    {
        $this->_get_query_customer_authorization_license();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_customer_authorization_license()
    {
        $this->db->from($this->table_customer_authorization_license);
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
