<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Assesment extends MX_Controller {
	public $table 			= 't_assesment';
	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
		$this->page->use_directory();
		$this->load->model('model_assesment');        		
	}
                
	public function index() {
		$this->page->view('assesment_index', array (
			'add'		=> site_url('assesment/assesment/add'),
            'request_number_written'        => $this->input->post('request_number_written'),
            'personnel_number_written'      => $this->input->post('personnel_number_written'),
            'status_assesment_written'      => $this->input->post('status_assesment_written'),
            'date_assesment_written'        => $this->input->post('date_assesment_written'),
            'id_written_sesi'               => $this->input->post('id_written_sesi'),
            'id_written_room'               => $this->input->post('id_written_room'),              
            'score_written'                 => $this->input->post('score_written'),
            'result_written'                => $this->input->post('result_written'),            
            'request_number_oral'           => $this->input->post('request_number_oral'),
            'personnel_number_oral'         => $this->input->post('personnel_number_oral'),
            'status_assesment_oral'         => $this->input->post('status_assesment_oral'),
            'date_assesment_oral'           => $this->input->post('date_assesment_oral'),
            'id_oral_sesi'                  => $this->input->post('id_oral_sesi'),
            'id_oral_room'                  => $this->input->post('id_oral_room'),              
            'score_oral'                    => $this->input->post('score_oral'),
            'result_oral'                   => $this->input->post('result_oral'),
		));
	}
	
	public function ajax_get_written_assesment(){
		$list = $this->model_assesment->get_value_assesment();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $rc) {			
			$no++;
			$row = array();
			$row[] = $no;
            $row[] = date('d-M-Y',strtotime(@$rc->date_written_assesment));
            $row[] = @$rc->request_number_fk;
            $row[] = @$rc->personnel_number_fk;			
			$row[] = @$rc->name;
            $row[] = @$rc->name_sesi;
            $row[] = @$rc->name_room;            
            $row[] = @$rc->name_t;
			$row[] = @$rc->score;
            $row[] = @$rc->result;             			
			$row[] = '<a href="'.site_url('/assesment/assesment/edit/'.@$rc->request_number_fk.'/'.@$rc->personnel_number_fk.'/'.@$rc->id_assesment_scope_fk).'" title="Edit Data"><button class="btn btn-info btn-sm">Update</button></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_assesment->count_all(),
			"recordsFiltered" 	=> $this->model_assesment->count_filtered(),
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}
    
    
   	public function ajax_get_oral_assesment(){
		$list = $this->model_assesment->get_oral_assesment();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $rc) {			
			$no++;
			$row = array();
            $row[] = $no;            
			$row[] = date('d-M-Y',strtotime(@$rc->date_written_assesment));
            $row[] = @$rc->request_number_fk;
            $row[] = @$rc->personnel_number_fk;			
			$row[] = @$rc->name;
            $row[] = @$rc->name_sesi;
            $row[] = @$rc->name_room;            
            $row[] = @$rc->name_t;
			$row[] = @$rc->score_oral;
            $row[] = @$rc->result_oral;         			
			$row[] = '<a href="'.site_url('/assesment/assesment/edit_oral/'.@$rc->request_number_fk.'/'.@$rc->personnel_number_fk.'/'.@$rc->id_assesment_scope_fk).'" title="Edit Data"><button class="btn btn-info btn-sm">Update</button></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_assesment->count_all(),
			"recordsFiltered" 	=> $this->model_assesment->count_filtered(),
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}

	
	private function form($action = 'insert', $id = '', $personnel_number = '', $id_assesment_scope=''){
		if ($this->agent->referrer() == '') redirect($this->page->base_url());
		
		$title = '';
		if($this->uri->segment(3) == 'add'){ 
			$title = 'Add';
		} else if($this->uri->segment(3) == 'edit'){
			$title = 'Edit Written Assesment';
		} else if($this->uri->segment(3) == 'edit_oral'){
			$title = 'Edit Oral Assesment';
		}
		
		$this->page->view('assesment_form', array (
			'ttl'		      => $title,
			'back'		      => $this->agent->referrer(),
			'action'	      => $this->page->base_url("/{$action}/{$id}/{$personnel_number}/{$id_assesment_scope}"),
			'data_assesment'  => $this->model_assesment->by_request_number($id, $id_assesment_scope),
			'aksi'		      => $action,
		));
	}
	
	public function add(){
		$this->form();
	}
	
	public function edit($id, $personnel_number, $id_scope){
		$this->form('update', $id, $personnel_number, $id_scope);
	}
    
    public function edit_oral($id, $personnel_number, $id_scope){
		$this->form('update_oral', $id, $personnel_number, $id_scope);
	}
	
	public function get_tab_search($param){		
    	$data['p_search'] = $param;
        $this->load->view('assesment/tab_search/search',$data);
        return true;
	}
	
	public function update($id, $personnel_number, $id_scope){		
		if ( ! $this->input->post()) show_404(); 
	
		$request_number_fk      = $this->input->post('request_number');			
		$assesment_scope 		= $this->input->post('id_assesment_scope');        
		$data = array(									
			'score'	   	             => $this->input->post('score_assesment'),
            'result'	   	         => $this->input->post('result_assesment'),
		);
        //print_r($data);
//        die();
        $this->db->where('request_number_fk', $request_number_fk);
        $this->db->where('id_assesment_scope_fk', $assesment_scope);
		$this->db->update('t_assesment', $data);
		
		redirect($this->page->base_url());
	}
    
   	public function update_oral($id, $personnel_number, $id_scope){		
		if ( ! $this->input->post()) show_404(); 
	
		$request_number_fk      = $this->input->post('request_number');			
		$assesment_scope 		= $this->input->post('id_assesment_scope');        
		$data = array(									
			'score_oral'	   	             => $this->input->post('score_oral'),
            'result_oral'	   	         => $this->input->post('result_oral'),
		);
        //print_r($data);
//        die();
        $this->db->where('request_number_fk', $request_number_fk);
        $this->db->where('id_assesment_scope_fk', $assesment_scope);
		$this->db->update('t_assesment', $data);
		
		redirect($this->page->base_url());
	}


	
	public function delete($id){
		if ($this->agent->referrer() == '') show_404();
		
		$this->db->delete('users', array('id_users' => $id));
		redirect($this->agent->referrer());
	}
    
    public function option_request_number_fk(){
		$t_assesment = $this->db->get('t_assesment');
		return options($t_assesment, 'request_number_fk', 'request_number_fk');
	}  
 
    
    public function option_assesment_scope(){
        $t_assesment = $this->db->get('t_assesment');
        return options($t_assesment, 'id_assesment_scope_fk', 'id_assesment_scope_fk');
	}                

}

/* End of file Users.php */
/* Location: ./application/modules/master/controllers/Users.php */  