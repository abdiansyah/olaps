<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {

	private $table 			= 'm_employee_group AS megr';
	private $column_order 	= array(null);  
	private $column_search 	= array('name','name_group');  
	private $order 			= array('name' => 'asc'); 
		
	
	private function _get_query() {
		$this->db->select('TSH.name, mgr.name_group, mgr.id_group, TSH.personnel_number');
		$this->db->from($this->table);
		$this->db->join('m_group AS mgr', 'mgr.id_group = megr.id_group_fk', 'left');
        $this->db->join('UNION_EMP AS TSH', 'TSH.personnel_number = megr.personnel_number_fk', 'left');		

		$i = 0;
		foreach ($this->column_search as $item) {
			if($_POST['search']['value']) {
				if($i===0){ 
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				
				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order'])){
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	public function get_users() {
		$this->_get_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		
		return $query->result();
	}

	public function count_filtered() {
		$this->_get_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	public function by_id_users($id){
		$datasrc = $this->db->select('TSH.name, mgr.name_group, mgr.id_group, TSH.personnel_number')
		->from($this->table)
		->join('m_group AS mgr', 'mgr.id_group = megr.id_group_fk', 'left')
        ->join('UNION_EMP AS TSH', 'TSH.personnel_number = megr.personnel_number_fk', 'left')
        ->where('personnel_number_fk',$id)->get();

		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}
	
	public function get_users_group(){
		$query = "SELECT *
			FROM m_group
			ORDER BY id_group ASC";
		return $this->db->query($query)->result();
	}
	
	public function by_id_users_group($id){
		$datasrc = $this->db->get_where('m_group', array('id_group' => $id));
		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}
		public function get_menu($id = '') {
		$query = "
			SELECT m.*, 
				ma.id_menu_akses 
			FROM menu AS m 
			LEFT JOIN (SELECT * FROM menu_akses WHERE id_group_fk = '{$id}') AS ma  
				ON ma.id_menu_fk = m.id_menu 
			WHERE m.id_menu_induk = 0
			ORDER BY m.id_menu			
		";
		return $this->db->query($query);
	}
	
	public function get_submenu($id = '') {
		$query = "
			SELECT m.*, 
				ma.id_menu_akses 
			FROM menu AS m 
			LEFT JOIN (SELECT * FROM menu_akses WHERE id_group_fk = '{$id}') AS ma 
				ON ma.id_menu_fk = m.id_menu 
			WHERE m.id_menu_induk > 0 
			ORDER BY m.id_menu		
		";
		return $this->db->query($query);
	}

}
/* End of file Model_users.php */
/* Location: ./application/modules/back_office/models/Model_users.php */