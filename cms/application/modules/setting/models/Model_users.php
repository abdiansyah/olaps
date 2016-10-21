<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {

	private $table 			= 'm_employee_group';
	private $column_order 	= array(null,'name_group');
	private $column_search 	= array('name_group');  
	private $order 			= array('id_group' => 'asc'); 
	
	public	$username  	  	= '';
	public	$password  	  	= '';
	public	$name_users	  	= '';
	public	$photo 	  	  	= '';
	public	$blockage 	  	= '';
	public  $id_group	    = '';
	public  $name_group		= '';
	
	private function _get_query() {
		$this->db->from($this->table);
		$this->db->join('m_group', 'm_group.id_group = m_employee_group.id_group_fk', 'left');
        $this->db->join('UNION_EMP', 'UNION_EMP.personnel_number = m_employee_group.personnel_number_fk', 'left');		

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
		$datasrc = $this->db->get_where('UNION_EMP', array('(CONVERT(VARCHAR(10),personnel_number))' => $id));
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
	
	public function update_pwd($current, $new, $retype){
		if ($new != $retype) return 'unmatch';
		
		$users = $this->session->userdata('users_quality');
		if (password($current) != $users->password) return 'wrong';
		
		$this->db->update('users', array('password' => password($new)), array('id' => $users->id));
		return 'ok';
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