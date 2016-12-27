<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_authorization');
	}
	
	public function index() {
		$this->page->view('authorization_index', array (
			'add'		=> $this->page->base_url('/add')
		
		));
	}
	
    public function ajax_authorization(){		    
		$list = $this->model_authorization->get_authorization();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
            $row[] = $grid->name_t;
            $row[] = $grid->desc_t;
            $row[] = '<a href="'.site_url('license/authorization/edit/'.$grid->id).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('license/authorization/delete/'.$grid->id).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';		                                                                                						          																												
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_authorization->count_all_authorization(),
            "recordsFiltered" 	=> $this->model_authorization->count_filtered_authorization(),			
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

		$this->page->view('authorization_form', array (
			'ttl'		=> $title,			
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_authorization->by_id($id),
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
			'name_t' 			=> $this->input->post('name_t'),
			'desc_t' 	        => $this->input->post('desc_t')
		
		);
		$this->db->insert('m_auth_license', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		$data = array(
			'name_t' 			=> $this->input->post('name_t'),
			'desc_t' 	        => $this->input->post('desc_t')			
		);	
		$this->db->where('id', $id);
		$this->db->update('m_auth_license', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){	
		$this->db->delete('m_auth_license',array('id'=>$id));		
		 redirect($this->page->base_url());
	}
	

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */