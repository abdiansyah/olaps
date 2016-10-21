<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_information extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_category_information');
	}
	
	public function index() {
		$this->page->view('category_information_index', array (
			'add'		=> $this->page->base_url('/add')
		));
	}
	
	public function ajax_get_cat_inf(){
		$list = $this->model_category_information->get_category_information();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();
			
			$row[] = $grid->name_cat;
			$row[] = $grid->change_date.'-'.$grid->change_time;
			$row[] = $grid->name_users;
			$row[] = '<a href="'.site_url('/configure_cms/category_information/edit/'.$grid->id_category_inf).'" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a class="red" href="'.site_url('/configure_cms/category_information/delete/'.$grid->id_category_inf).'" onclick="return del_confirm(\''.$grid->name_cat.'\')" title="Delete Data"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
																												
			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_category_information->count_all(),
			"recordsFiltered" 	=> $this->model_category_information->count_filtered(),
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

		$this->page->view('category_information_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_category_information->by_id_category_information($id),
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
			'name_cat' 			=> $this->input->post('name_cat'),
			'change_date' 	   	=> date('Y-m-d'),
			'change_time'	 	=> date('H:i:s'),
			'id_users_fk'		=> $this->session->userdata('users_quality')->id_users,
		);
		$this->db->insert('category_information', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		$data = array(
			'name_cat' 			=> $this->input->post('name_cat'),
			'change_date' 	   	=> date('Y-m-d'),
			'change_time'	 	=> date('H:i:s'),
			'id_users_fk'		=> $this->session->userdata('users_quality')->id_users,
		);		
		$this->db->where('id_category_inf', $id);
		$this->db->update('category_information', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();
		
		$data = array ('flag' => '0');
		$this->db->where('id_category_inf', $id);
		$this->db->update('category_information', $data);
		
		redirect($this->agent->referrer());
	}
	
	public function options_category_information(){
		$category_information = $this->db->get('category_information');
		return options($category_information, 'id_category_inf', 'name_cat');
	}

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */