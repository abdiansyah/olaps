<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_management extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_menu_management');
	}
	
	public function index() {
		$this->page->view('menu_management_index', array (
			'add'		=> site_url('setting/menu_management/add'),
		));
	}
	
	public function ajax_get_menu(){
		$list = $this->model_menu_management->get_menu_management();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();
			
			$row[] = $grid->nama;
			$row[] = $grid->uri;
			$row[] = $grid->id_menu_induk;
			$row[] = $grid->change_date.'-'.$grid->change_time;
			$row[] = $grid->EMPLNAME;
			$row[] = '<a href="'.site_url('setting/menu_management/edit/'.$grid->id_menu).'" title="Edit Data"><button class="btn btn-info btn-sm">Update</button></a>
					<a class="red" href="'.site_url('setting/menu_management/delete/'.$grid->id_menu).'" onclick="return del_confirm(\''.$grid->nama.'\')" title="Delete Data"><button class="btn btn-warning btn-sm">Delete</button></a>';
																												
			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_menu_management->count_all(),
			"recordsFiltered" 	=> $this->model_menu_management->count_filtered(),
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

		$this->page->view('menu_management_form', array (
			'ttl'		=> $title,			
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_menu_management->by_id_menu_management($id),
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
			'nama' 					=> $this->input->post('nama'),
			'uri' 	   				=> $this->input->post('uri'),
			'id_menu_induk' 		=> $this->input->post('id_menu_induk'),
			'change_date' 	   		=> date('Y-m-d'),
			'change_time'	 		=> date('H:i:s'),
			'personnel_number_fk'	=> $this->session->userdata('users_quality')->PERNR,
			'flag'					=> '1'
		);
		// print_r($data);
		// die();
		$this->db->insert('menu', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		$data = array(
			'nama' 					=> $this->input->post('nama'),
			'uri' 	   				=> $this->input->post('uri'),
			'id_menu_induk' 		=> $this->input->post('id_menu_induk'),
			'change_date' 	   		=> date('Y-m-d'),
			'change_time'	 		=> date('H:i:s'),
			'personnel_number_fk'	=> $this->session->userdata('users_quality')->PERNR
		);		
		$this->db->where('id_menu', $id);
		$this->db->update('menu', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){				
		$data = array ('flag' => '0');
		$this->db->where('id_menu', $id);
		$this->db->update('menu', $data);
		redirect($this->page->base_url());
	}
	
	public function options_menu_management(){
		$menu_management = $this->db->get_where('menu', array('id_menu_induk' => 0));
		return options($menu_management, 'id_menu', 'nama');
	}

}

/* End of file menu_management.php */
/* Location: ./application/modules/master/controllers/menu_management.php */