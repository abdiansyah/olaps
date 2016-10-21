<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_authorization_license extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_customer_authorization_license');
	}
	
	public function index() {
		$this->page->view('customer_authorization_license_index', array (
			'add'		=> $this->page->base_url('/add')
		
		));
	}
	
    public function ajax_customer_authorization_license(){		    
		$list = $this->model_customer_authorization_license->get_customer_authorization_license();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();   			
			$row[] = $grid->empl_id.'/ '.$grid->name;
			$row[] = $grid->departement;
			$row[] = $grid->lic_no;
			$row[] = $grid->stamp_no;
			$row[] = date('d-M-Y',strtotime($grid->valid_from));            
			$row[] = date('d-M-Y',strtotime($grid->valid_until));                                          
			                                                                                  						          																											
			$data[] = $row;            
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_customer_authorization_license->count_all_customer_authorization_license(),
            "recordsFiltered" 	=> $this->model_customer_authorization_license->count_filtered_customer_authorization_license(),			
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
			'back'		=> $this->agent->referrer(),
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
		if ($this->agent->referrer() == '') show_404();						
		$this->db->delete('m_auth_license',array('id'=>$id));		
		redirect($this->agent->referrer());
	}

	public function option_unit_gmf(){
		$m_unit = $this->db->query("SELECT DISTINCT UNIT FROM db_hrm.dbo.TBL_SOE_HEAD");
		return options($m_unit, 'UNIT', 'UNIT');
	}

	public function option_ac_type(){
		$m_unit = $this->db->query("SELECT DISTINCT scp_spec_type FROM db_license.dbo.vw_amel");
		return options($m_unit, 'scp_spec_type', 'scp_spec_type');
	}
	

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */