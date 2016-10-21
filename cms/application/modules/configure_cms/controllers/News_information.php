<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class news_information extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_news_information');
	}
	
	public function index() {
		$this->page->view('news_information_index', array (
			'add'		=> $this->page->base_url('/add')
		));
	}
	
	public function ajax_get_news_inf(){
		$list = $this->model_news_information->get_news_information();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $grid) {			
			$row = array();
			
			$row[] = $grid->name_cat;
			$row[] = $grid->author;
			$row[] = $grid->title;
			$row[] = $grid->change_date.'-'.$grid->change_time;
			$row[] = $grid->name_users;
			$row[] = '<a href="'.site_url('/configure_cms/news_information/edit/'.$grid->id_information).'" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a class="red" href="'.site_url('/configure_cms/news_information/delete/'.$grid->id_information).'" onclick="return del_confirm(\''.$grid->author.'\')" title="Delete Data"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
																												
			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_news_information->count_all(),
			"recordsFiltered" 	=> $this->model_news_information->count_filtered(),
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

		$this->page->view('news_information_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'action'	=> $this->page->base_url("/{$action}/{$id}"),
			'rc' 		=> $this->model_news_information->by_id_news_information($id),
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
			'id_category_inf_fk' 			=> $this->input->post('id_category_inf_fk'),
            'author' 			            => $this->input->post('author'),
            'title' 			            => $this->input->post('title'),
            'description' 			        => $this->input->post('description'),
			'create_date' 	   	            => date('Y-m-d'),
			'create_hours'	 	            => date('H:i:s'),
			'flag'		                    => '1',
            'id_users_fk'		            => $this->session->userdata('users_quality')->id_users,
		);
		$this->db->insert('news_information', $data);
		
		redirect($this->page->base_url());
	}
	
	public function update($id){		
		$data = array(
			'name_cat' 			=> $this->input->post('name_cat'),
			'change_date' 	   	=> date('Y-m-d'),
			'change_time'	 	=> date('H:i:s'),
			'id_users_fk'		=> $this->session->userdata('users_quality')->id_users,
		);		
		$this->db->where('news_information.id_category_inf_fk', $id);
		$this->db->update('news_information', $data);
		
		redirect($this->page->base_url());
	}
	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();
		
		$data = array ('flag' => '0');
		$this->db->where('id_information', $id);
		$this->db->update('news_information', $data);
		
		redirect($this->agent->referrer());
	}
	
	public function options_news_information($id){
		$news_information = $this->db->get_where('menu', array('id_menu_induk' => 0));
		return options($news_information, 'id_menu', $id, 'nama');
	}

}

/* End of file News_information.php */
/* Location: ./application/modules/configure_cms/controllers/News_information.php */

