<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MX_Controller {
	
		var $gallerypath;
		var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_slider');
		
		$this->gallerypath = realpath(APPPATH . '../assets');
		$this->gallery_path_url = base_url().'assets/';
		//$this->gallery_path = realpath(APPPATH. '..assets/img');
		//$this->gallery_path_url = base_url = base_url(). 'images');
	}
	
	public function index() {
		$this->page->view('slider_index', array (
			'add'		=> $this->page->base_url('/add')
		));
	}
	
	public function ajax_get_slider(){
		$list = $this->model_slider->get_slider();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();
			
			$row[] = $grid->title;
			
			$row[] = date('d-m-Y H:i:s', strtotime($grid->create_datetime));
			
			$row[] = $grid->name;
			$row[] = '<a href="'.site_url('/configure_cms/slider/edit/'.$grid->id_slider).'" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a class="red" href="'.site_url('/configure_cms/slider/delete/'.$grid->id_slider).'" onclick="return del_confirm(\''.$grid->title.'\')" title="Delete Data"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
																												
			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_slider->count_all(),
			"recordsFiltered" 	=> $this->model_slider->count_filtered(),
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

		$this->page->view('slider_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_slider->by_id_slider($id),
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
		if ( ! $this->input->post()) show_404(); 
		$config['upload_path']          = $this->gallerypath;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;		

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('image'))
		{                        
		    // redirect($this->page->base_url());
		    die('gagal upload');
		}
		else
		{
			$data = array(
				'title' 				=> $this->input->post('title'),
				'images'	   			=> $_FILES['images']['name'],			
				'create_datetime' 	   	=> date('Y-m-d H:i:s'),			
				'personnel_number_fk'	=> $this->session->userdata('users_quality')->PERNR,
				'flag'					=> '1'
			);        

			$this->db->insert('slider', $data);						
			redirect($this->page->base_url());
		}        

	}

	public function update($id){		
		$data = array(
			'title' 			=> $this->input->post('title'),
			//'images'			=> $this->input->post('images'),
			'change_datetime' 	=> date('Y-m-d H:i:s'),			
			'id_users_fk'		=> $this->session->userdata('users_quality')->id_users,
		);		
		$this->db->where('id_slider', $id);
		$this->db->update('slider', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();
		
		$data = array ('flag' => '0');
		$this->db->where('id_slider', $id);
		$this->db->update('slider', $data);
		
		redirect($this->agent->referrer());
	}
	
	public function options_category_information($id){
		$category_information = $this->db->get_where('category_information', array('id_category_inf' => $id));
		return options($category_information, 'id_category_inf', $id, 'name_cat');
	}

}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */