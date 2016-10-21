<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_profile');
	}
	
	public function index() {
		$this->page->view('profile_index', array (
			'add'		=> $this->page->base_url('/add')
		));
	}
	
	public function ajax_get_profile(){
		$list = $this->model_profile->get_profile();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();
			
			$row[] = $grid->name_prof;
			$row[] = $grid->description;
			$row[] = $grid->change_date.'-'.$grid->change_time;
			$row[] = $grid->name_users;
			$row[] = '<a href="'.site_url('/configure_cms/profile/edit/'.$grid->id_profile).'" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a class="red" href="'.site_url('/configure_cms/profile/delete/'.$grid->id_profile).'" onclick="return del_confirm(\''.$grid->name_prof.'\')" title="Delete Data"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
																												
			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_profile->count_all(),
			"recordsFiltered" 	=> $this->model_profile->count_filtered(),
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

		$this->page->view('profile_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_profile->by_id_profile($id),
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
			'name_prof' 		=> $this->input->post('name_prof'),
			'description'		=> $this->input->post('description'),
			'change_date' 	   	=> date('Y-m-d'),
			'change_time'	 	=> date('H:i:s'),
			//'images'			=> $this->input->post('images'),
			'id_users_fk'		=> $this->session->userdata('users_quality')->id_users,
		);
		$this->db->insert('profile_web', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		$data = array(
			'name_prof' 		=> $this->input->post('name_prof'),
			'description' 		=> $this->input->post('description'),
			'change_date' 	   	=> date('Y-m-d'),
			'change_time'	 	=> date('H:i:s'),
			//'images'			=> $this->input->post('images'),
			'id_users_fk'		=> $this->session->userdata('users_quality')->id_users,
		);		
		$this->db->where('id_profile', $id);
		$this->db->update('profile_web', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();
		
		$data = array ('flag' => '0');
		$this->db->where('id_profile', $id);
		$this->db->update('profile_web', $data);
		
		redirect($this->agent->referrer());
	}
	
	public function options_category_information($id){
		$category_information = $this->db->get_where('category_information', array('id_category_inf' => $id));
		return options($category_information, 'id_category_inf', $id, 'name_cat');
	}

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */