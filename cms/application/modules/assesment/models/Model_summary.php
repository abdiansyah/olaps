<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_summary extends CI_Model {

	private $table_assesment	= 't_assesment';
    private $column_order_assesment = array('t_assesment.date_written_assesment');
    private $column_order_list_assesment = array('TSH.EMPLNAME');
    private $order_assesment = array('t_assesment.date_written_assesment' => 'asc');	
	private $order 			= array('PERNR' => 'asc'); 
			
	private function _get_query_assesment_summary()
    {        
        $this->db->select('(CONVERT(varchar(10), CONVERT(datetime, t_assesment.date_written_assesment, 120),105)) as date_written_assesment, 
                        (select count(TA.personnel_number_fk) from t_assesment AS TA WHERE TA.date_written_assesment = t_assesment.date_written_assesment AND TA.id_written_sesi = t_assesment.id_written_sesi) as count_employee, 
                        m_assesment_session.name_t, m_room.name_room');
        $this->db->from($this->table_assesment);
        $this->db->join('m_room', 't_assesment.id_written_room_fk = m_room.id_room', 'left');
        $this->db->join('m_assesment_session',
                        't_assesment.id_written_sesi = m_assesment_session.id', 'left');                
        if (isset($_POST['order_assesment'])) {
            $this->db->order_by($this->column_order_assesment[$_POST['order_assesment']['0']['column']],
                $_POST['order_assesment']['0']['dir']);
        } else
            if (isset($this->order_assesment)) {
                $order_assesment = $this->order_assesment;
                $this->db->order_by(key($order_assesment), $order_assesment[key($order_assesment)]);
            }
    }
	
	public function get_quality_control_assesment_summary()
    {
        $this->_get_query_assesment_summary();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();        
    }

	public function count_filtered_assesment()
    {
        $this->_get_query_assesment_summary();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
   
    public function count_all_assesment()
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