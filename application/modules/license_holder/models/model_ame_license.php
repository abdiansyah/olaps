<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_ame_license extends CI_Model
{
    private $table_ame_license          = 'db_license.dbo.tbl_amel AS AME';
    private $column_order_ame_license   = array('AME.empl_id');            
    private $order_ame_license          = array('AME.empl_id' => 'desc');    


    public function _get_query_ame_license()
    {        
        $this->db->select('AME.empl_id, TSH.name, TSH.departement, AME.lic_no, AME.lic_status, AME.stamp_no, AME.valid_from, AME.valid_until');
        $this->db->from($this->table_ame_license);
        $this->db->join('UNION_EMP AS TSH','CONVERT(VARCHAR(20),AME.empl_id) = CONVERT(VARCHAR(20),TSH.personnel_number)');
        $this->db->join('db_license.dbo.tbl_amel_scope AS TAMS','TAMS.lic_no = AME.lic_no');
        $this->db->join('db_license.dbo.tbl_master_scopes AS TMS','TMS.scp_code = TAMS.scp_code');

        if (isset($_POST['order_ame_license'])) {
            $this->db->order_by($this->column_order_ame_license[$_POST['order_ame_license']['0']['column']],
                $_POST['order_ame_license']['0']['dir']);
        } else
            if (isset($this->order_ame_license)) {
                $order_ame_license = $this->order_ame_license;
                $this->db->order_by(key($order_ame_license), $order_ame_license[key($order_ame_license)]);
            }
    }

    public function get_ame_license()
    {
        @$unit = $this->input->post('unit');
        @$spect = $this->input->post('spect');            
        @$status_license = $this->input->post('status_license');

        if(!empty($unit)){                        
            $this->db->like('departement', $unit);            
        };
        if(!empty($spect)){                    
            $this->db->where('scp_spec_type', $spect);
        };

        if(!empty($status_license)){            
            $this->db->where('AME.lic_status', $status_license);
        };

        $this->db->where('TSH.validitycontract','9999-12-31');
        $this->db->or_where('TSH.validitycontract >=',date('Y-m-d'));
        
        if(!empty($unit)){                        
            $this->db->like('departement', $unit);            
        };
        if(!empty($spect)){                    
            $this->db->where('scp_spec_type', $spect);
        };

        if(!empty($status_license)){            
            $this->db->where('AME.lic_status', $status_license);
        };
        $this->db->order_by('AME.valid_until','ASC');
        $this->_get_query_ame_license();                        
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->distinct();        
        $query = $this->db->get();
        return $query->result();
    }

    
    public function count_filtered_ame_license()
    {
        $this->_get_query_ame_license();
        $query = $this->db->get();
        return $query->num_rows();
    }

   
    public function count_all_ame_license()
    {
        $this->db->from($this->table_ame_license);
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
