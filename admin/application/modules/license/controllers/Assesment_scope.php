<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class assesment_scope extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_assesment_scope');
	}
	
	public function index() {
		$this->page->view('assesment_scope_index', array (
			'add'		=> $this->page->base_url('/add')
		));
	}
	
    public function ajax_assesment_scope(){		    
		$list = $this->model_assesment_scope->get_assesment_scope();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->code_t;
            $row[] = $grid->name_t;	
            $row[] = '<a href="'.site_url('license/assesment_scope/edit/'.$grid->id).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/assesment_scope/delete/'.$grid->id).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';		                                                                                					          										
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_assesment_scope->count_all_assesment_scope(),
            "recordsFiltered" 	=> $this->model_assesment_scope->count_filtered_assesment_scope(),			
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

		$this->page->view('assesment_scope_form', array (
			'ttl'		=> $title,			
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_assesment_scope->by_id($id),
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
			'code_t'	        	=> $this->input->post('code_assesment_scope'),			
			'name_t'	        	=> $this->input->post('name_assesment_scope'),			
		);
		$this->db->insert('m_assesment_scope', $data);
		
		redirect(site_url('license/assesment_scope'));
	}
	
	public function update($id){		
		$data = array(					
			'name_t'	        	=> $this->input->post('name_assesment_scope'),			
		);	
		$this->db->where('id', $id);
		$this->db->update('m_assesment_scope', $data);
		
		redirect(site_url('license/assesment_scope'));
	}
	
	public function delete($id){		
		$this->db->delete('m_assesment_scope',array('id'=>$id));		
		redirect(site_url('license/assesment_scope'));
	}
	
	public function options_category_information(){
		$category_information = $this->db->get('category_information');
		return options($category_information, 'id_category_inf', 'name_cat');
	}

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */