<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_news_information extends CI_Model {
	
	private $table 			= 'news_information';
	private $column_order 	= array('name_cat','author','title','change_date','change_time','name_users');
	private $column_search 	= array('name_cat','author','title','change_date','change_time','name_users');  
	private $order 			= array('news_information.id_information' => 'desc'); 
	
	public	$name_cat 			= '';
	public	$id_category_inf_fk	= '';
	public	$author				= '';
	public 	$title				= '';
	public 	$description		= '';
	public	$change_date  		= '';
	public	$change_time  		= '';
	public	$name_users  		= '';
	
	private function _get_query() {
		$this->db->from($this->table);
        $this->db->join('category_information', 'category_information.id_category_inf = news_information.id_category_inf_fk', 'left');
		$this->db->join('users', 'news_information.id_users_fk = users.id_users', 'left');
		$this->db->where('news_information.flag','1');

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
	
	public function get_news_information() {
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
	
	public function by_id_news_information($id){
		$datasrc = $this->db->query("
			SELECT ni.*,
				ci.name_cat,
				u.id_users,
				u.name_users
			FROM (
				SELECT *
				FROM news_information
				WHERE id_information = '{$id}'
			) AS ni
			LEFT JOIN category_information AS ci
				ON ni.id_category_inf_fk = ci.id_category_inf
			LEFT JOIN users AS u
				ON ni.id_users_fk = u.id_users
		");
		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}
	
}

/* End of file Model_news_information.php */
/* Location: ./application/modules/back_office/models/Model_news_information.php */