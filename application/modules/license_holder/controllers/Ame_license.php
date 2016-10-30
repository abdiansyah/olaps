<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ame_license extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_ame_license');
	}
	
	public function index() {
		$this->page->view('ame_license_index', array (
			'add'		=> $this->page->base_url('/add'),
			'unit'		=> $this->input->post('unit'),
			'spect'		=> $this->input->post('spect'),
			'status_license' => $this->input->post('status_license'),
		
		));
	}
	
    public function ajax_ame_license(){		    
		$list = $this->model_ame_license->get_ame_license();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array(); 			
			if(date('Y-m-d',strtotime($grid->valid_until)) > date('Y-m-d')){ 			
			            $row[] = $grid->empl_id.'/ '.$grid->name;
			            $row[] = $grid->departement;
			            $row[] = $grid->lic_no;
			            $row[] = $grid->stamp_no;
			            $row[] = date('d-M-Y',strtotime($grid->valid_from));            
			            $row[] = date('d-M-Y',strtotime($grid->valid_until));                                          
			            $data[] = $row;            
			        }		                                          						          																											
			           
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_ame_license->count_all_ame_license(),
            "recordsFiltered" 	=> $this->model_ame_license->count_filtered_ame_license(),			
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
		$m_unit = $this->db->query("SELECT scp_spec_type
										FROM db_license.dbo.tbl_master_scopes
										WHERE scp_indent = 'AMEL' AND scp_spec_type != 'Engine'
										GROUP BY scp_spec_type
										ORDER BY scp_spec_type");
		return options($m_unit, 'scp_spec_type', 'scp_spec_type');
	}
		

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */