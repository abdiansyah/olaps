<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_email extends MX_Controller {
		
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');	
		$this->load->model('model_content_email');
	}
	
	public function index() {
		$this->page->view('content_email_index', array (
			'add'		=> site_url('setting/content_email/add'),
		));
	}
	
	public function ajax_get_content_email(){
		$list = $this->model_content_email->get_content_email();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $rc) {			
			$no++;
			$row = array();
			$row[] = @$no;									
			$row[] = @$rc->subject;            			
            $row[] = @$rc->title;            			
            $row[] = @$rc->content;
            $row[] = @$rc->footer;            			
            $row[] = '<a href="'.site_url('/setting/content_email/edit/'.$rc->id).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('/setting/content_email/delete/'.$rc->id).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';			

			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_content_email->count_all(),
			"recordsFiltered" 	=> $this->model_content_email->count_filtered(),
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}
	
	private function form($action = 'insert', $id = ''){
		if ($this->agent->referrer() == '') redirect(site_url('setting/content_email'));
		
		$title = '';
		if($this->uri->segment(3) == 'add'){ 
			$title = 'Add';
		} else {
			$title = 'Edit';
		}
		
		$this->page->view('content_email_form', array (
			'ttl'				=> $title,
			'back'				=> $this->agent->referrer(),
			'action'			=> $this->page->base_url("/content_email/{$action}/{$id}"),
			'content_email'		=> $this->model_content_email->by_id($id),
			'aksi'				=> $action,
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
			'id'  		=> $this->input->post('id'),				
			'subject'  	=> $this->input->post('subject'),
			'title'   	=> $this->input->post('title'),
			'content'  	=> $this->input->post('content'),
			'footer'  	=> $this->input->post('footer'),
		);
		$this->db->insert('m_content_approved', $data);
		redirect(site_url('setting/content_email'));
	}
	
	public function update($id=''){	
		$data = array(			
			'subject'  	=> $this->input->post('subject'),
			'title'   	=> $this->input->post('title'),
			'content'  	=> stripslashes($this->input->post('content')),
			'footer'  	=> stripslashes($this->input->post('footer')),
		);		
		
		$this->db->where('id', $id);
		$this->db->update('m_content_approved', $data);								
		redirect(site_url('setting/content_email'));	
	}
	
	public function delete($id=''){
		if (!empty($id)){		
			$this->db->delete('m_content_approved', array('id' => $id));
			redirect(site_url('setting/content_email'));
		}else{
			redirect(site_url('setting/content_email'));
		};
	}

	public function preview_by($id) {
		$query = "Select * FROM m_content_approved WHERE id = '$id'";		
		$data = $this->db->query($query)->row();
		die(json_encode($data));
	}

}

/* End of file Content email.php */
/* Location: ./application/modules/master/controllers/Content email.php */