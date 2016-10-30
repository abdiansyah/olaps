<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {
		
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');	
		$this->load->model('model_users');
	}
	
	public function index() {
		$this->page->view('users_index', array (
			'add'		=> site_url('setting/users/add'),
		));
	}
	
	public function ajax_get_users(){
		$list = $this->model_users->get_users();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $rc) {			
			$no++;
			$row = array();
			$row[] = $no;									
            $row[] = $rc->name;            			
            $row[] = $rc->name_group;
            $row[] = '<a href="'.site_url('/setting/users/edit/'.$rc->personnel_number).'" title="Edit Data"><button class="btn-info btn-sm btn-flat">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a> &nbsp; &nbsp; &nbsp; <a href="'.site_url('/setting/users/delete/'.$rc->personnel_number).'" title="Hapus Data"><button class="btn-warning btn-sm btn-flat">Hapus</button></a>';			

			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_users->count_all(),
			"recordsFiltered" 	=> $this->model_users->count_filtered(),
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}
	
	private function form($action = 'insert', $id = ''){
		if ($this->agent->referrer() == '') redirect(site_url('setting/users'));
		
		$title = '';
		if($this->uri->segment(3) == 'add'){ 
			$title = 'Add';
		} else {
			$title = 'Edit';
		}
		
		$this->page->view('users_form', array (
			'ttl'		=> $title,
			'back'		=> $this->agent->referrer(),
			'action'	=> $this->page->base_url("/users/{$action}/{$id}"),
			'users'		=> $this->model_users->by_id_users($id),
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
			'personnel_number_fk'  	=> $this->input->post('personnel_number'),				
			'id_group_fk'   		=> $this->input->post('group')
		);
		$this->db->insert('m_employee_group', $data);
		redirect(site_url('setting/users'));
	}
	
	public function update($id=''){
	
				$data = array(
					'id_group_fk'   		=> $this->input->post('group'),
				);		
				$this->db->where('personnel_number_fk', $id);
				$this->db->update('m_employee_group', $data);					
			redirect(site_url('setting/users'));	
	}
	
	public function delete($id=''){
		if (!empty($id)){		
			$this->db->delete('m_employee_group', array('personnel_number_fk' => $id));
			redirect(site_url('setting/users'));
		}else{
			redirect(site_url('setting/users'));
		};
	}

	public function option_group()
    {
        $m_unit = $this->db->query("SELECT * FROM m_group ORDER BY name_group");
        return options($m_unit, 'id_group', 'name_group');
    }

}

/* End of file Users.php */
/* Location: ./application/modules/master/controllers/Users.php */