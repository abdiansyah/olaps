<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_content_email extends CI_Model {

	private $table 			= 'm_content_approved AS mca';
	private $column_order 	= array(null);  
	private $column_search 	= array('subject','title');  
	private $order 			= array('subject' => 'asc'); 
		
	
	private function _get_query() {
		$this->db->select('mca.id, mca.subject, mca.title, mca.content, mca.footer');
		$this->db->from($this->table);		
        //$this->db->join('UNION_EMP AS TSH', 'TSH.personnel_number = megr.personnel_number_fk', 'left');		

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
	
	public function get_content_email() {
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
	
	public function by_id($id){
		$datasrc = $this->db->select('mca.id, mca.subject, mca.title, mca.content, mca.footer')
		->from($this->table)		
        //->join('UNION_EMP AS TSH', 'TSH.personnel_number = megr.personnel_number_fk', 'left')
        ->where('id',$id)->get();

		return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
	}
	
}
/* End of file Model_content_email.php */
/* Location: ./application/modules/models/Model_content_email.php */