<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Requirements_management extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_requirement_management');
	}
	
	public function index() {
		$this->page->view('requirement_management_index', array (
			'add_req_specific'		=> $this->page->base_url('/add_req_specific'),
            'add_req_general'		=> $this->page->base_url('/add_req_general')
            
		));
	}
	
    public function ajax_req_specific(){		    
		$list = $this->model_requirement_management->get_req_specific();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->name_t;
            $row[] = $grid->name;
            $row[] = '<a href="'.site_url('license/requirements_management/edit_req_specific/'.$grid->id).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/requirements_management/delete_req_specific/'.$grid->id).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';		                                                                                						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_requirement_management->count_all_req_specific(),
            "recordsFiltered" 	=> $this->model_requirement_management->count_filtered_req_specific(),			
			"data" 				=> $data,            
		);
		
		//output to json format
		echo json_encode($output);
	}
    
    public function ajax_req_general(){		    
		$list = $this->model_requirement_management->get_req_general();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->name_t;
            $row[] = $grid->name;
            $row[] = '<a href="'.site_url('license/requirements_management/edit_req_general/'.@$grid->id).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/requirements_management/delete_req_general/'.@$grid->id).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';		                                                                                						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_requirement_management->count_all_req_general(),
            "recordsFiltered" 	=> $this->model_requirement_management->count_filtered_req_general(),			
			"data" 				=> $data,            
		);
		
		//output to json format
		echo json_encode($output);
	}
    
	
	private function form($action = 'insert', $id = ''){
		if ($this->agent->referrer() == '') redirect(site_url('license/requirements_management'));
		
		$title = '';
		if($this->uri->segment(3) == 'add_req_specific'){ 
			$title = 'Add Requirement Specific';
            $action = 'insert_req_specific';
        } else if($this->uri->segment(3) == 'add_req_general'){
			$title = 'Add Requirement General';
            $action = 'insert_req_general';
		} else if($this->uri->segment(3) == 'edit_req_specific'){
			$title = 'Edit Requirement Specific';
            $action = 'update_req_specific';
        } else if($this->uri->segment(3) == 'edit_req_general'){
			$title = 'Edit Requirement General';
            $action = 'update_req_general';
		}

		$this->page->view('requirement_management_form', array (
			'ttl'				=> $title,
			'back_req'			=> $this->page->base_url(),
			'action'			=> $this->page->base_url("/{$action}/{$id}"),
			'rc_specific' 		=> $this->model_requirement_management->by_req_specific_id($id),
            'rc_general' 		=> $this->model_requirement_management->by_req_general_id($id),
			'aksi'				=> $action,
		));
	}
	
	public function add_req_specific(){
		$this->form();
	}
    
   	public function add_req_general(){
		$this->form();
	}
	
	public function edit_req_specific($id){
		$this->form('update_req_specific', $id);
	}

	public function edit_req_general($id){
		$this->form('update_req_general', $id);
	}
	
	public function insert_req_specific(){
        $code_req_spec     		= $this->input->post('code_req_spec');
        $name_req_spec      	= $this->input->post('name_req_spec');
        $code_folder_spec       = $this->input->post('code_folder_spec');
                
        if(!empty($name_req_spec) && !empty($code_folder_spec)){        
			$data = array(
	            'code_t'              	=> $code_req_spec,
				'name_t'             	=> $name_req_spec,		
				'code_folder'          	=> $code_folder_spec,		
			);
	        
			$this->db->insert('m_auth_additional_req_spec', $data);		
			redirect(site_url('license/requirements_management'));
		};
	}
    
    public function insert_req_general(){
        $code_req_general     	= $this->input->post('code_req_general');
        $name_req_general      	= $this->input->post('name_req_general');
        $code_folder_general    = $this->input->post('code_folder_general');
                
        if(!empty($name_req_general) && !empty($code_folder_general)){        
			$data = array(
	            'code_t'              	=> $code_req_general,
				'name_t'             	=> $name_req_general,		
				'code_folder'          	=> $code_folder_general,		
			);
	        
			$this->db->insert('m_auth_additional_req_general', $data);		
			redirect(site_url('license/requirements_management'));
		};
	}
	
	public function update_req_specific($id){		
        $name_req_spec      	= $this->input->post('name_req_spec');
        $code_folder_spec       = $this->input->post('code_folder_spec');
                
        if(!empty($name_req_spec) && !empty($code_folder_spec)){        
			$data = array(	            
				'name_t'             	=> $name_req_spec,		
				'code_folder'          	=> $code_folder_spec,		
			);
	        $this->db->where('id', $id);
			$this->db->update('m_auth_additional_req_spec', $data);		
			redirect(site_url('license/requirements_management'));
		};
	}
	
	public function delete_req_specific($id){
		if ($this->agent->referrer() == '') redirect(site_url('license/requirements_management'));
		$this->db->delete('m_auth_additional_req_spec',array('id'=>$id));		
		redirect(site_url('license/requirements_management'));
	}

	public function update_req_general($id){		
		$name_req_general      	= $this->input->post('name_req_general');
        $code_folder_general       = $this->input->post('code_folder_general');
                
        if(!empty($name_req_general) && !empty($code_folder_general)){        
			$data = array(	            
				'name_t'             	=> $name_req_general,		
				'code_folder'          	=> $code_folder_general,		
			);
	        $this->db->where('id', $id);
			$this->db->update('m_auth_additional_req_general', $data);		
			redirect(site_url('license/requirements_management'));
		};
	}
	
	public function delete_req_general($id){
		if ($this->agent->referrer() == '') redirect(site_url('license/requirements_management'));
		$this->db->delete('m_auth_additional_req_general',array('id'=>$id));		
		redirect(site_url('license/requirements_management'));
	}	
    
	public function option_dir(){
		$m_dir = $this->db->query("SELECT code , name from m_dir_requirement");
		return options($m_dir, 'code', 'name');
	}	

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */