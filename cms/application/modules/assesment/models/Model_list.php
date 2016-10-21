<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_list extends CI_Model {

	private $table_assesment	= 't_assesment';
    private $column_order_assesment = array('t_assesment.date_written_test');
    private $column_order_list_assesment = array('TSH.EMPLNAME');
    private $order_assesment = array('t_assesment.date_written_test' => 'asc');	
	private $order 			= array('PERNR' => 'asc'); 
			
	 private function _get_query_list_assesment()
    {        
        $this->db->select('TSH.name, TSH.personnel_number, TSH.departement, TA.reason_apply_license');
        $this->db->from($this->table_assesment);
        $this->db->join('UNION_EMP AS TSH', 'TSH.personnel_number = t_assesment.personnel_number_fk', 'left');
        $this->db->join('t_apply_license_dtl AS TAL', 't_assesment.request_number_fk = TAL.request_number_fk AND t_assesment.id_assesment_scope_fk = TAL.id_assesment_scope_fk', 'left');
        $this->db->join('t_apply_license AS TA', 'TA.request_number = TAL.request_number_fk', 'left');
        if (isset($_POST['order_list_assesment'])) {
            $this->db->order_by($this->column_order_list_assesment[$_POST['order_list_assesment']['0']['column']],
                $_POST['order_list_assesment']['0']['dir']);
        } else
            if (isset($this->order_list_assesment)) {
                $order_list_assesment = $this->order_list_assesment;
                $this->db->order_by(key($order_list_assesment), $order_list_assesment[key($order_list_assesment)]);
            }
    }
	
	public function get_quality_control_list_assesment(){
        $this->_get_query_list_assesment();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }

    public function count_filtered_list_assesment()
    {
        $this->_get_query_list_assesment();
        $query = $this->db->get();
        return $query->num_rows();
    }
   
    public function count_all_list_assesment()
    {
        $this->db->from($this->table_assesment);
        return $this->db->count_all_results();
    }
    
   
	
	public function by_id_users($id){
		$datasrc = $this->db->get_where('users', array('id_users' => $id));
		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}
    
    public function by_request_number($id){
		$datasrc = $this->db->get_where('t_assesment', array('request_number_fk' => $id));
		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}			
	
	
}
/* End of file Model_users.php */
/* Location: ./application/modules/back_office/models/Model_users.php */