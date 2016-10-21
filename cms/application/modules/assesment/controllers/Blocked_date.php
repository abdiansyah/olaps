<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Blocked_date extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_blocked_date');
	}
	
	public function index() {
		$this->page->view('blocked_date_index', array (
			'add'		=> $this->page->base_url('/add')
		));
	}
	
    public function ajax_blocked_date(){		    
		$list = $this->model_blocked_date->get_blocked_date();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->date_from;
            $row[] = $grid->date_until;
            $row[] = $grid->total_days;
            $row[] = $grid->reason;	
            $row[] = '<a href="'.site_url('/assesment/blocked_date/edit/'.$grid->id).'" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a> &nbsp; &nbsp; <a href="'.site_url('/assesment/blocked_date/delete/'.$grid->id).'" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Delete</a>';		                                                                                						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_blocked_date->count_all_blocked_date(),
            "recordsFiltered" 	=> $this->model_blocked_date->count_filtered_blocked_date(),			
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

		$this->page->view('blocked_date_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_blocked_date->by_id($id),
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
			'date_from' 			=> date('Y-m-d',strtotime($this->input->post('date_from'))),
			'date_until' 	        => date('Y-m-d',strtotime($this->input->post('date_until'))),
			'reason'	        	=> $this->input->post('reason'),			
		);
		$this->db->insert('t_blocked_date', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		$data = array(
			'date_from' 			=> date('Y-m-d',strtotime($this->input->post('date_from'))),
			'date_until' 	        => date('Y-m-d',strtotime($this->input->post('date_until'))),
			'reason'	        	=> $this->input->post('reason'),			
		);	
		$this->db->where('id', $id);
		$this->db->update('t_blocked_date', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();						
		$this->db->delete('t_blocked_date',array('id'=>$id));		
		redirect($this->agent->referrer());
	}
	
	public function options_category_information(){
		$category_information = $this->db->get('category_information');
		return options($category_information, 'id_category_inf', 'name_cat');
	}

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */