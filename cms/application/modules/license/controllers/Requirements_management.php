<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Requirements_management extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_requirement');
	}
	
	public function index() {
		$this->page->view('requirement_index', array (
			'add_specific'		=> $this->page->base_url('/add_specific'),
            'add_general'		=> $this->page->base_url('/add_general')
            
		));
	}
	
    public function ajax_specific(){		    
		$list = $this->model_requirement->get_specific();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->name_license;
            $row[] = $grid->name_type;
            $row[] = $grid->name_spect;
            $row[] = $grid->name_category;
            $row[] = $grid->name_scope;
            $row[] = $grid->name_requirement;	
            $row[] = '<a href="'.site_url('license/requirement/edit_specific/'.$grid->id_req_spec).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/requirement/delete_specific/'.$grid->id_req_spec).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';		                                                                                						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_requirement->count_all_specific(),
            "recordsFiltered" 	=> $this->model_requirement->count_filtered_specific(),			
			"data" 				=> $data,            
		);
		
		//output to json format
		echo json_encode($output);
	}
    
    public function ajax_general(){		    
		$list = $this->model_requirement->get_general();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->name_license;
            $row[] = $grid->name_type;
            $row[] = $grid->name_spect;            
            $row[] = $grid->name_requirement;	
            $row[] = '<a href="'.site_url('license/requirement/edit_general/'.@$grid->id_req_general).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/requirement/delete_general/'.@$grid->id_req_general).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';		                                                                                						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_requirement->count_all_general(),
            "recordsFiltered" 	=> $this->model_requirement->count_filtered_general(),			
			"data" 				=> $data,            
		);
		
		//output to json format
		echo json_encode($output);
	}
    
	
	private function form($action = 'insert', $id = ''){
		if ($this->agent->referrer() == '') redirect($this->page->base_url());
		
		$title = '';
		if($this->uri->segment(3) == 'add_specific'){ 
			$title = 'Add Requirement Specific';
            $action = 'insert_specific';
        } else if($this->uri->segment(3) == 'add_general'){
			$title = 'Add Requirement General';
            $action = 'insert_general';
		} else if($this->uri->segment(3) == 'edit_specific'){
			$title = 'Edit Requirement Specific';
            $action = 'update_specific';
        } else if($this->uri->segment(3) == 'edit_general'){
			$title = 'Edit Requirement General';
            $action = 'update_general';
		}

		$this->page->view('requirement_form', array (
			'ttl'				=> $title,
			'back'				=> $this->agent->referrer(),
			'action'			=> $this->page->base_url("/{$action}/{$id}"),
			'rc_specific' 		=> $this->model_requirement->by_specific_id($id),
            'rc_general' 		=> $this->model_requirement->by_general_id($id),
			'aksi'				=> $action,
		));
	}
	
	public function add_specific(){
		$this->form();
	}
    
   	public function add_general(){
		$this->form();
	}
	
	public function edit_specific($id){
		$this->form('update_specific', $id);
	}

	public function edit_general($id){
		$this->form('update_general', $id);
	}
	
	public function insert_specific(){
        $new_auth       = $this->input->post('new_auth');
        $renewal        = $this->input->post('renewal');
        $additional     = $this->input->post('additional');
        $ratting_change = $this->input->post('ratting_change');
                
        if(empty($new_auth)){
            $new_auth ='0';  
        };
        
        if(empty($renewal)){
            $renewal = '0';
        };
        
        if(empty($additional)){
            $additional = '0';
        };
        
        if(empty($ratting_change)){
            $ratting_change = '0';
        };
        
		$data = array(
            'id'                             => $this->input->post('id_tbl_spec'),
			'id_auth_license_fk'             => $this->input->post('id_license'),
			'id_auth_type_fk'                => $this->input->post('id_type'),
			'id_auth_spect_fk'	        	 => $this->input->post('id_spect'),
            'id_auth_category_fk'	         => $this->input->post('id_category'),
            'id_auth_scope_fk'	        	 => $this->input->post('id_scope'),
            'id_assesment_scope_fk'	         => $this->input->post('id_assesment_scope'),
            'id_auth_additional_req_spec_fk' => $this->input->post('id_req_spec'),
            'new_auth'                       => $new_auth,
            'renewal'                        => $renewal,
            'additional'                     => $additional,
            'ratting_change'                 => $ratting_change,
            'category_continous'			 => $this->input->post('category_continous'),
            'age_requirement'			     => $this->input->post('age_requirement'),
            'category_admin'			     => $this->input->post('category_admin'),
            'scope_code'                     => $this->input->post('scope_code'),
		);
        
		$this->db->insert('m_group_scope_category', $data);		
		redirect(site_url('license/requirement'));
	}
    
    public function insert_general(){
        $data = array(            
			'id_auth_license_fk'                => $this->input->post('id_license'),
			'id_auth_type_fk'                   => $this->input->post('id_type'),
			'id_auth_spect_fk'	        	    => $this->input->post('id_spect'),            
            'id_auth_additional_req_general_fk' => $this->input->post('id_req_general'),  
            'category_continous'			    => $this->input->post('category_continous'),
            'age_requirement'			        => $this->input->post('age_requirement'),
            'category_admin'			        => $this->input->post('category_admin'),            
		);
		$this->db->insert('m_group_license_req_general', $data);		
		redirect(site_url('license/requirement'));
	}
	
	public function update_specific($id){
		$new_auth	        				= $this->input->post('new_auth');
		$renewal	        				= $this->input->post('renewal');
		$additional	        				= $this->input->post('additional');
		$ratting_change	        			= $this->input->post('ratting_change');

		if(empty($new_auth)){
            $new_auth ='0';  
        };
        
        if(empty($renewal)){
            $renewal = '0';
        };
        
        if(empty($additional)){
            $additional = '0';
        };
        
        if(empty($ratting_change)){
            $ratting_change = '0';
        };		
		$data = array(
			'id_assesment_scope_fk' 			=> $this->input->post('id_assesment_scope'),			
			'id_auth_additional_req_spec_fk' 	=> $this->input->post('id_req_spec'),			
			'id_auth_scope_fk'	        		=> $this->input->post('id_scope'),			
			'id_auth_category_fk'	        	=> $this->input->post('id_category'),
			'id_auth_spect_fk'	        		=> $this->input->post('id_spect'),
			'id_auth_type_fk'	        		=> $this->input->post('id_type'),
			'id_auth_license_fk'	        	=> $this->input->post('id_license'),
			'new_auth'                       	=> $new_auth,
            'renewal'                        	=> $renewal,
            'additional'                     	=> $additional,
            'ratting_change'                 	=> $ratting_change,
			'category_continous'	        	=> $this->input->post('category_continous'),
			'age_requirement'	        		=> $this->input->post('age_requirement'),
			'category_admin'	        		=> $this->input->post('category_admin'),
			'scope_code'	        			=> $this->input->post('scope_code'),
		);	
		$this->db->where('id', $id);
		$this->db->update('m_group_scope_category', $data);
		
		redirect(site_url('license/requirement'));
	}
	
	public function delete_specific($id){
		if ($this->agent->referrer() == '') show_404();						
		$this->db->delete('m_group_scope_category',array('id'=>$id));		
		redirect($this->agent->referrer());
	}

	public function update_general($id){		
		$data = array(			
			'id_auth_additional_req_general_fk' 	=> $this->input->post('id_req_spec'),						
			'id_auth_spect_fk'	        			=> $this->input->post('id_spect'),
			'id_auth_type_fk'	        			=> $this->input->post('id_type'),
			'id_auth_license_fk'	        		=> $this->input->post('id_license'),			
			'category_continous'	        		=> $this->input->post('category_continous'),
			'age_requirement'	        			=> $this->input->post('age_requirement'),
			'category_admin'	        			=> $this->input->post('category_admin'),			
		);	
		$this->db->where('id', $id);
		$this->db->update('m_group_license_req_general', $data);
		
		redirect(site_url('license/requirement'));
	}
	
	public function delete_general($id){
		if ($this->agent->referrer() == '') show_404();						
		$this->db->delete('m_group_license_req_general',array('id'=>$id));		
		redirect($this->agent->referrer());
	}
	
	public function options_category_information(){
		$category_information = $this->db->get('category_information');
		return options($category_information, 'id_category_inf', 'name_cat');
	}
    
	public function option_authorization(){
		$m_license = $this->db->query("SELECT id , name_t AS name_license FROM m_auth_license ORDER BY name_license");
		return options($m_license, 'id', 'name_license');
	}
	public function option_type(){
		$m_type = $this->db->query("SELECT id , name_t AS name_type FROM m_auth_type ORDER BY name_type");
		return options($m_type, 'id', 'name_type');
	}
	public function option_spect(){
		$m_spect = $this->db->query("SELECT id , name_t AS name_spect FROM m_auth_spect ORDER BY name_spect");
		return options($m_spect, 'id', 'name_spect');
	}
	public function option_category(){
		$m_category = $this->db->query("SELECT id , name_t AS name_category FROM m_auth_category ORDER BY name_category");
		return options($m_category, 'id', 'name_category');
	}
    
	public function option_scope(){
		$m_scope = $this->db->query("SELECT id , name_t AS name_scope FROM m_auth_scope ORDER BY name_scope");
		return options($m_scope, 'id', 'name_scope');
	}
    
    public function option_assesment_scope(){
		$m_assesment_scope = $this->db->query("SELECT id , name_t AS name_assesment_scope FROM m_assesment_scope ");
		return options($m_assesment_scope, 'id', 'name_assesment_scope');
	} 
    
   	public function option_req_spec(){
		$m_req_spec = $this->db->query("SELECT id , name_t AS name_req_spec FROM m_auth_additional_req_spec ORDER BY name_req_spec");
		return options($m_req_spec, 'id', 'name_req_spec');
	}
    
    public function option_req_general(){
		$m_req_general = $this->db->query("SELECT id , name_t AS name_req_general FROM m_auth_additional_req_general ORDER BY name_req_general");
		return options($m_req_general, 'id', 'name_req_general');
	}

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */