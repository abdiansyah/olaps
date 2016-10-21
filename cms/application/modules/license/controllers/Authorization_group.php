<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization_group extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_authorization_group');
	}
	
	public function index() {
		$this->page->view('authorization_group_index', array (
			'add_license_type'			=> $this->page->base_url('/add_license_type'),
            'add_type_spect'			=> $this->page->base_url('/add_type_spect'),
            'add_spect_category'		=> $this->page->base_url('/add_spect_category'),
            'add_category_scope'		=> $this->page->base_url('/add_category_scope'),
            
		));
	}
	
    public function ajax_license_type(){		    
		$list = $this->model_authorization_group->get_license_type();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->name_license;
            $row[] = $grid->name_type;           
            $row[] = '<a href="'.site_url('license/authorization_group/edit_license_type/'.$grid->id_license_type).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/authorization_group/delete_license_type/'.$grid->id_license_type).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';		    		
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_authorization_group->count_all_license_type(),
            "recordsFiltered" 	=> $this->model_authorization_group->count_filtered_license_type(),			
			"data" 				=> $data,            
		);
		
		//output to json format
		echo json_encode($output);
	}
    
    public function ajax_type_spect(){		    
		$list = $this->model_authorization_group->get_type_spect();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			          
            $row[] = $grid->name_type;
            $row[] = $grid->name_spect;                        
            $row[] = '<a href="'.site_url('license/authorization_group/edit_type_spect/'.$grid->id_type_spect).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/authorization_group/delete_type_spect/'.$grid->id_type_spect).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';					
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_authorization_group->count_all_type_spect(),
            "recordsFiltered" 	=> $this->model_authorization_group->count_filtered_type_spect(),			
			"data" 				=> $data,            
		);
		
		//output to json format
		echo json_encode($output);
	}
    
	
	private function form($action = '', $id = ''){
		if ($this->agent->referrer() == '') redirect($this->page->base_url());
		
		$title = '';
		if($this->uri->segment(3) == 'add_license_type'){ 
			$title = 'Add License Type';
            $action = 'insert_license_type';
        } else if($this->uri->segment(3) == 'add_type_spect'){
			$title = 'Add Type Spect';
            $action = 'insert_type_spect';
		} else if($this->uri->segment(3) == 'add_spect_category'){
			$title = 'Add Spect Category';
            $action = 'insert_spect_category';		
		} else if($this->uri->segment(3) == 'edit_specific'){
			$title = 'Edit Requirement Specific';
            $action = 'update_specific';
        } else if($this->uri->segment(3) == 'edit_general'){
			$title = 'Edit Requirement General';
            $action = 'update_general';
		}

		$this->page->view('authorization_group_form', array (
			'ttl'				=> $title,
			'back'				=> $this->agent->referrer(),
			'action'			=> $this->page->base_url("/{$action}/{$id}"),
			'rc_license_type' 	=> $this->model_authorization_group->by_license_type_id($id),
            'rc_type_spect' 	=> $this->model_authorization_group->by_type_spect_id($id),
			'aksi'				=> $action,
		));
	}
	
	public function add_license_type(){
		$this->form();
	}
    
   	public function add_type_spect(){
		$this->form();
	}

	public function add_spect_category(){
		$this->form();
	}
	
	public function edit_specific($id){
		$this->form('update_specific', $id);
	}

	public function edit_general($id){
		$this->form('update_general', $id);
	}
	
	public function insert_license_type(){
        $id_license       			= $this->input->post('id_license');
        $id_type        			= $this->input->post('id_type');
        if($id_license!='' && $id_type!=''){
           	$data = array(            
    			'id_auth_license_fk'             => $id_license,
    			'id_auth_type_fk'                => $id_type,			
    		);   

    		$this->db->insert('m_group_type_license', $data);
    		$this->session->set_flashdata('msg_auth_group','Group license type, save completed.');
    		redirect(site_url('license/authorization_group'));
        }		
	}

	public function insert_type_spect(){
        $id_type       				= $this->input->post('id_type');
        $id_spect        			= $this->input->post('id_spect');
        if($id_type!='' && $id_spect!=''){
	       	$data = array(            
				'id_auth_type_fk'             => $this->input->post('id_type'),
				'id_auth_spect_fk'            => $this->input->post('id_spect'),			
			);			
			$this->db->insert('m_group_spect_type', $data);		
			$this->session->set_flashdata('msg_auth_group','Group type & ratting (spect), save completed.');        
			redirect(site_url('license/authorization_group'));
		}		
	}

	public function insert_spect_category(){
		$id_license       				= $this->input->post('id_license');
        $id_type        				= $this->input->post('id_type');
        $id_spect       				= $this->input->post('id_spect');
        $id_category        			= $this->input->post('id_category');
        if($id_license!='' && $id_type!='' && $id_spect!='' && $id_category!=''){
	       	$data = array(
	       		'id_auth_license_fk'          => $id_license,
    			'id_auth_type_fk'             => $id_type,            
				'id_auth_spect_fk'            => $id_spect,
				'id_auth_category_fk'         => $id_category,			
			);        
			$this->db->insert('m_group_category_spect', $data);		
		}
		redirect(site_url('license/authorization_group'));
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

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */