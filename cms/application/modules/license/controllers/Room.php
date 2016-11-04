<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_room');
	}
	
	public function index() {
		$this->page->view('room_index', array (
			'add'		=> $this->page->base_url('/add')
		
		));
	}
	
    public function ajax_room(){		    
		$list = $this->model_room->get_room();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->name_room;
            $row[] = $grid->quota;
            $row[] = '<a href="'.site_url('license/room/edit/'.$grid->id_room).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/room/delete/'.$grid->id_room).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';		                                                                                						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_room->count_all_room(),
            "recordsFiltered" 	=> $this->model_room->count_filtered_room(),			
			"data" 				=> $data,            
		);
		
		//output to json format
		echo json_encode($output);
	}
    
	
	private function form($action = 'insert', $id = ''){
		if ($this->agent->referrer() == '') redirect($this->page->base_url());
		
		$title = '';
		if($this->uri->segment(3) == 'add'){ 
			$title = 'Add';
		} else {
			$title = 'Edit';
		}

		$this->page->view('room_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_room->by_id($id),
			'aksi'		=> $action,
		));
	}
	
	public function add(){
		$this->form();
	}
	
	public function edit($id){
		$this->form('update', $id);
	}
	
	public function insert(){		
		$data = array(
			'name_room' 			=> $this->input->post('name_room'),
			'quota' 	        	=> $this->input->post('quota')
		
		);
		$this->db->insert('m_room', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		$data = array(
			'name_room' 			=> $this->input->post('name_room'),
			'quota' 	        	=> $this->input->post('quota')			
		);	
		$this->db->where('id_room', $id);
		$this->db->update('m_room', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();						
		$this->db->delete('m_room',array('id_room'=>$id));		
		redirect($this->agent->referrer());
	}
	

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */