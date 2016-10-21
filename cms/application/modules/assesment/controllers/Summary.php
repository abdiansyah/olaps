<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_summary');        		
	}
	
	public function index() {
		$this->page->view('assesment_summary_index', array (
			'add'		=> site_url('assesment/summary/add'),
		));
	}
	
	public function ajax_get_history_inf_assesment_summary(){		    
		$list = $this->model_summary->get_quality_control_assesment_summary();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->date_written_assesment;
            $row[] = $grid->name_t;
            $row[] = $grid->count_employee;
			$row[] = $grid->name_room;   
            $row[] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.site_url('quality_control/view/'.$grid->date_written_assesment).'" title="Edit Data"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;View</a>';                                                                 						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_summary->count_all_assesment(),
			"recordsFiltered" 	=> $this->model_summary->count_filtered_assesment(),
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
		
		$this->page->view('assesment_summary_form', array (
			'ttl'		      => $title,
			'back'		      => $this->agent->referrer(),
			'action'	      => $this->page->base_url("/{$action}/{$id}"),
			'rc'              => $this->model_summary->by_request_number($id),
			'aksi'		      => $action,
		));
	}
	
	public function add(){
		$this->form();
	}
	
	public function edit($id){
		$this->form('update', $id);
	}
	
	public function insert(){		
		if ( ! $this->input->post()) show_404(); 	
		
        $request_number_fk      = $this->input->post('request_number');			
		$assesment_scope 		= $this->input->post('assesment_scope');        
		$data = array(
			'request_number_fk'      => $this->input->post('request_number'),						
			'value'	   	             => $this->input->post('value_assesment')
		);
        $this->db->where('request_number_fk', $request_number_fk);
        $this->db->where('id_assesment_scope_fk', $assesment_scope);
		$this->db->update('t_assesment', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		if (! $this->input->post()) show_404(); 
	
		$request_number_fk      = $this->input->post('request_number');			
		$assesment_scope 		= $this->input->post('assesment_scope');        
		$data = array(
			'request_number_fk'      => $this->input->post('request_number'),						
			'value'	   	             => $this->input->post('value_assesment'),
		);
        $this->db->where('request_number_fk', $request_number_fk);
        $this->db->where('id_assesment_scope_fk', $assesment_scope);
		$this->db->update('t_assesment', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();
		
		$this->db->delete('users', array('id_users' => $id));
		redirect($this->agent->referrer());
	}
    
    public function option_request_number_fk(){
		$t_assesment = $this->db->get('t_assesment');
		return options($t_assesment, 'request_number_fk', 'request_number_fk');
	}  
    
    public function option_assesment_scope(){
        $t_assesment = $this->db->get('t_assesment');
		return options($t_assesment, 'id_assesment_scope_fk', 'id_assesment_scope_fk');
		
        //$menu_management = $this->db->get_where('menu', array('id_menu_induk' => 0));
//		return options($menu_management, 'id_menu', $id, 'nama');
	}                  

}

/* End of file Users.php */
/* Location: ./application/modules/master/controllers/Users.php */