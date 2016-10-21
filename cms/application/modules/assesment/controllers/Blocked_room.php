<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Blocked_room extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_blocked_room');
	}
	
	public function index() {
		$this->page->view('blocked_room_index', array (
			'add'		=> $this->page->base_url('/add')
		));
	}
	
    public function ajax_blocked_room(){		    
		$list = $this->model_blocked_room->get_blocked_room();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();
            $row[] = $grid->name_room;   			
            $row[] = $grid->date_from;
            $row[] = $grid->date_until;
            $row[] = $grid->total_days;
            $row[] = $grid->reason;	
            $row[] = '<a href="'.site_url('/assesment/blocked_room/edit/'.$grid->id).'" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a> &nbsp; &nbsp; <a href="'.site_url('/assesment/blocked_room/delete/'.$grid->id).'" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Delete</a>';		                                                                                						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_blocked_room->count_all_blocked_room(),
            "recordsFiltered" 	=> $this->model_blocked_room->count_filtered_blocked_room(),			
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

		$this->page->view('blocked_room_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_blocked_room->by_id($id),
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
            'id_room_fk'	        => $this->input->post('id_room'),
			'date_from' 			=> date('Y-m-d',strtotime($this->input->post('date_from'))),
			'date_until' 	        => date('Y-m-d',strtotime($this->input->post('date_until'))),
			'reason'	        	=> $this->input->post('reason'),			
		);
		$this->db->insert('t_blocked_room', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		$data = array(
            'id_room_fk'	        => $this->input->post('id_room'),
			'date_from' 			=> date('Y-m-d',strtotime($this->input->post('date_from'))),
			'date_until' 	        => date('Y-m-d',strtotime($this->input->post('date_until'))),
			'reason'	        	=> $this->input->post('reason'),			
		);	
		$this->db->where('id', $id);
		$this->db->update('t_blocked_room', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();						
		$this->db->delete('t_blocked_room',array('id_room_fk'=>$id));		
		redirect($this->agent->referrer());
	}
	
	public function options_room(){
		$category_information = $this->db->get('m_room');
		return options($category_information, 'id_room', 'name_room');
	}
        

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */