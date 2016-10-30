<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Certifying_staff_license extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_certifying_staff_license');
	}
	
	public function index() {
		$this->page->view('certifying_staff_license_index', array (
			'add'				=> $this->page->base_url('/add'),
			'unit'				=> $this->input->post('unit'),
			'spect'				=> $this->input->post('spect'),
			'status_license' 	=> $this->input->post('status_license'),
		
		));
	}
	
    public function ajax_certifying_staff_license(){		    
		$list = $this->model_certifying_staff_license->get_certifying_staff_license();
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
			"recordsTotal" 		=> $this->model_certifying_staff_license->count_all_certifying_staff_license(),
            "recordsFiltered" 	=> $this->model_certifying_staff_license->count_filtered_certifying_staff_license(),			
			"data" 				=> $data,            
		);
		
		//output to json format
		echo json_encode($output);
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