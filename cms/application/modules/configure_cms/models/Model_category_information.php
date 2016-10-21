<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_category_information extends CI_Model {
	
	private $table 			= 'category_information';
	private $column_order 	= array('name_cat','change_date','change_time','name_users');
	private $column_search 	= array('name_cat','change_date','change_time','name_users');  
	private $order 			= array('id_category_inf' => 'desc'); 
	
	public	$name_cat 		= '';
	public	$change_date  	= '';
	public	$change_time  	= '';
	public	$name_users  	= '';
	
	private function _get_query() {
		$this->db->from($this->table);
		$this->db->join('users', 'category_information.id_users_fk = users.id_users', 'left');
		$this->db->where('flag','1');

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
	
	public function get_category_information() {
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
	
	public function by_id_menu_management($id){
		$datasrc = $this->db->get_where('menu', array('id_menu' => $id));
		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}
	
	public function by_id_category_information($id){
		$datasrc = $this->db->query("
			SELECT ci.*,
				u.id_users,
				u.name_users
			FROM (
				SELECT *
				FROM category_information
				WHERE id_category_inf= '{$id}'
			) AS ci
			LEFT JOIN users AS u
				ON ci.id_users_fk = u.id_users
		");
		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}
	
}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */