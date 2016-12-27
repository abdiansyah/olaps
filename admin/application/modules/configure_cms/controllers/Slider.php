<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MX_Controller {
	
		var $gallery_path;
		var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_slider');
		$this->load->helper('file');
		
		$this->gallery_path = '../assets/images/slide';		
		$this->gallery_path_url = '../assets/images/slide';		
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
			$row[] = $grid->images;			
			$row[] = date('d-m-Y H:i:s', strtotime($grid->create_datetime));			
			$row[] = $grid->name;
			if ($grid->flag == 1) {
				$row[] = 'Enabled';	
			} else {
				$row[] = 'Disabled';	
			}
			
			$row[] = '<a href="'.site_url('/configure_cms/slider/edit/'.$grid->id_slider).'" title="Edit Data"><button class="btn btn-info btn-sm">Update</button></a> &nbsp;&nbsp;&nbsp;
					<a class="red" href="'.site_url('/configure_cms/slider/disabled/'.$grid->id_slider).'" title="Disabled Image"><button class="btn btn-warning btn-sm">Disabled</button></a> &nbsp;&nbsp;&nbsp;<a class="red" href="'.site_url('/configure_cms/slider/delete/'.$grid->id_slider.'/'.$grid->images).'" title="Delete Image"><button class="btn btn-danger btn-sm">Delete</button></a>';
																												
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
		$config = array(
                         'allowed_types' => 'jpg|jpeg|gif|png',
                         'upload_path' => $this->gallery_path,
                         'max_size' => 2000,
                         'file_name' => url_title($this->input->post('image'))
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload();
		
		if ( ! $this->upload->do_upload('image'))
		{                        
		    redirect($this->page->base_url());		    
		}
		else
		{			
            $image = $this->upload->file_name;

			$data = array(
				'title' 				=> $this->input->post('title'),
				'images'	   			=> $image,			
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
			'create_datetime' 	=> date('Y-m-d H:i:s'),			
			'personnel_number_fk'		=> $this->session->userdata('users_quality')->PERNR,
			'flag'				=> $this->input->post('status')
		);		
		$this->db->where('id_slider', $id);
		$this->db->update('slider', $data);
		
		redirect($this->page->base_url());
	}
	
	public function disabled($id){				
		$data = array ('flag' => '0');
		$this->db->where('id_slider', $id);
		$this->db->update('slider', $data);
		redirect($this->page->base_url());	
	}

	public function delete($id='',$name_file=''){						
		$this->db->where('id_slider', $id);
		$this->db->delete('slider');		
		unlink('../assets/images/slide/'.$name_file);
		redirect($this->page->base_url());	
	}
	
}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */