<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_certifying_staff_license extends CI_Model
{
    private $table_certifying_staff_license          = 'db_license.dbo.tbl_authl AS CS';
    private $column_order_certifying_staff_license   = array('CS.empl_id');            
    private $order_certifying_staff_license          = array('CS.empl_id' => 'desc');    


    public function _get_query_certifying_staff_license()
    {   
        $this->db->distinct();     
        $this->db->select('CS.empl_id, CS.lic_no, CS.stamp_no, CS.valid_from, CS.valid_until, tms.scp_skill, CS.lic_status, CS.lic_type, TSH.personnel_number, TSH.name, TSH.departement');
        $this->db->from($this->table_certifying_staff_license);
        $this->db->join('db_license.dbo.tbl_authl_scope AS tas','CS.lic_no = tas.lic_no');
        $this->db->join('db_license.dbo.tbl_master_scopes AS tms','tas.scp_code = tms.scp_code');
        $this->db->join('UNION_EMP AS TSH','CS.empl_id = TSH.personnel_number');
        $this->db->join('db_license.dbo.tbl_authl_cust AS tac','CS.lic_no = tac.lic_no');
        $this->db->where('tms.scp_skill','CS');
        $this->db->where('CS.valid_until >=',date('Y-m-d'));
        
        if (isset($_POST['order_certifying_staff_license'])) {
            $this->db->order_by($this->column_order_certifying_staff_license[$_POST['order_certifying_staff_license']['0']['column']],
                $_POST['order_certifying_staff_license']['0']['dir']);
        } else
            if (isset($this->order_certifying_staff_license)) {
                $order_certifying_staff_license = $this->order_certifying_staff_license;
                $this->db->order_by(key($order_certifying_staff_license), $order_certifying_staff_license[key($order_certifying_staff_license)]);
            }
    }

    public function get_certifying_staff_license()
    {   
        @$unit = $this->input->post('unit');        
        @$status_license = $this->input->post('status_license');

        if(!empty($unit)){                        
            $this->db->like('departement', $unit);            
        };

        if(!empty($status_license)){            
            $this->db->where('CS.lic_status', $status_license);
        };

        $this->db->where('TSH.validitycontract','9999-12-31');
        $this->db->or_where('TSH.validitycontract >=',date('Y-m-d'));
        
        if(!empty($unit)){                        
            $this->db->like('departement', $unit);            
        };

        if(!empty($status_license)){            
            $this->db->where('CS.lic_status', $status_license);
        };
     
        $this->_get_query_certifying_staff_license();        
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_certifying_staff_license()
    {
        $this->_get_query_certifying_staff_license();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_certifying_staff_license()
    {
        $this->db->from($this->table_certifying_staff_license);
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
