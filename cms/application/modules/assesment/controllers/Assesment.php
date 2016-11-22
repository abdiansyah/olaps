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
            'request_number_practical'      => $this->input->post('request_number_practical'),
            'personnel_number_practical'    => $this->input->post('personnel_number_practical'),
            'status_assesment_practical'    => $this->input->post('status_assesment_practical'),
            'date_assesment_practical'      => $this->input->post('date_assesment_practical'),
            'id_oral_practical'             => $this->input->post('id_practical_sesi'),            
            'score_practical'               => $this->input->post('score_practical'),
            'result_practical'              => $this->input->post('result_practical'),
		));
	}
	
	public function ajax_get_written_assesment(){
		$list = $this->model_assesment->get_written_assesment();
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
            $row[] = @$rc->sesi_written;
            $row[] = @$rc->room_written;            
            $row[] = @$rc->name_t;
            $row[] = @$rc->pic_written;
			$row[] = @$rc->score_written;
            $row[] = @$rc->result_written;             			
            $row[] = @$rc->note_written; 
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
			$row[] = date('d-M-Y',strtotime(@$rc->date_oral_assesment));
            $row[] = @$rc->request_number_fk;
            $row[] = @$rc->personnel_number_fk;			
			$row[] = @$rc->name;
            $row[] = @$rc->sesi_oral;
            $row[] = @$rc->room_oral;            
            $row[] = @$rc->name_t;
            $row[] = @$rc->pic_oral;
			$row[] = @$rc->score_oral;			
            $row[] = @$rc->result_oral;         			
            $row[] = @$rc->note_oral;                     
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

    public function ajax_get_practical_assesment(){
        $list = $this->model_assesment->get_practical_assesment();
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = date('d-M-Y',strtotime(@$rc->date_practical_assesment));
            $row[] = @$rc->request_number_fk;
            $row[] = @$rc->personnel_number_fk;         
            $row[] = @$rc->name;
            $row[] = @$rc->sesi_practical;                    
            $row[] = @$rc->name_t;
            $row[] = @$rc->pic_practical;
            $row[] = @$rc->score_practical;          
            $row[] = @$rc->result_practical;                     
            $row[] = @$rc->note_practical;                     
            $row[] = '<a href="'.site_url('/assesment/assesment/edit_practical/'.@$rc->request_number_fk.'/'.@$rc->personnel_number_fk.'/'.@$rc->id_assesment_scope_fk).'" title="Edit Data"><button class="btn btn-info btn-sm">Update</button></a>';

            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->model_assesment->count_all(),
            "recordsFiltered"   => $this->model_assesment->count_filtered(),
            "data"              => $data,
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
		} else if($this->uri->segment(3) == 'edit_practical'){
            $title = 'Edit Practical Assesment';
        }
		
		$this->page->view('assesment_form', array (
			'ttl'		      		     => $title,
			'back'		      		     => $this->agent->referrer(),
			'action'	      		     => $this->page->base_url("/{$action}/{$id}/{$personnel_number}/{$id_assesment_scope}"),
			'data_assesment'  		     => $this->model_assesment->by_request_number($id, $id_assesment_scope),
			'data_assesment_oral'  	     => $this->model_assesment->by_request_number_oral($id, $id_assesment_scope),
            'data_assesment_practical'   => $this->model_assesment->by_request_number_practical($id, $id_assesment_scope),
			'aksi'		      		     => $action,
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

    public function edit_practical($id, $personnel_number, $id_scope){
        $this->form('update_practical', $id, $personnel_number, $id_scope);
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
		$pic_written 			= $this->input->post('pic_written'); 
	    $data_applicant   		= $this->model_assesment->get_data_row_personnel_by($personnel_number);
	    $sess_data_gm           = $this->model_assesment->get_gm_personnel_by($personnel_number)->row_array();
	    $name_applicant   		= $data_applicant['name'];
        $email_applicant   		= $data_applicant['email'];
        $email_superior  		= $data_applicant['email_superior'];  
        $email_gm               = $sess_data_gm['email'];           
        $config         = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.gmf-aeroasia.co.id',
            'smtp_port' => 25,
            'smtp_user' => 'app.notif',
            'smtp_pass' => 'app.notif',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('mail.gmf-aeroasia.co.id');
        $this->email->to($email_applicant);
        // $this->email->to($email_superior);
        // $this->email->to($email_gm);
        // $this->email->to('list-tqd@gmf-aeroasia.co.id');
        $this->email->subject('Result written assesment');

		$data = array(									
			'score_written'	   	             => $this->input->post('score_written'),
            'result_written'	   	         => $this->input->post('result_written'),
            'note_written'                   => $this->input->post('note_written'),
            'date_result_written'			 => date('Y-m-d'),
            'pic_written'					 => $pic_written,
		);
       //  print_r($data);
       // die();
        $this->db->where('request_number_fk', $request_number_fk);
        $this->db->where('id_assesment_scope_fk', $assesment_scope);
		$this->db->update('t_assesment', $data);
			$cek_result_written  = $this->model_assesment->get_result_written($request_number_fk, $personnel_number);
			$pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
                </head></body>';                
                $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
                $pesan .= '<p>Your result written assesment : </p>';
                $pesan .= '<table border="1">
                        <tr>
                        <td> No </td>
                        <td> Authorization scope </td>                                
                        <td> Score </td>                        
                        <td> Result </td>                                               
                        <td> Note </td>                                               
                        </tr>';
                $no = 1;
                    foreach ($cek_result_written as $row) {                                
                        $pesan .= '<tr>                        
                                <td> ' . $no++ . ' </td>
                                <td> ' . $row->name_spect . ' '. $row->name_category . ' ' . $row->name_scope.' '. $row->status_etops.'</td>
                                <td> ' . $row->score_written . ' </td>                               
                                <td> ' . $row->result_written . ' </td>
                                <td> ' . $row->note_written . ' </td>
                                </tr>';
                    }
                $pesan .= '</table>';                        
                $pesan .= '<p>Best Regards</p>';
                $pesan .= '<b>Personnel Qualification & Quality System Documentation /TQD</b>';
                $pesan .= '<p>PT GMF AeroAsia</p>';
                $pesan .= '<p>Phone: Phone: +62-21-550 8732</p>';
                $pesan .= '<p>Fax: +62-21-550 1257</p>';
                $this->email->message($pesan);                    
                if ($this->email->send()) {
                        $this->session->set_flashdata('msg_assesment', 'Sending result writen assesment successfull.');
                        redirect(base_url('index.php/assesment/index'));                                
                    } else {
                    	$this->session->set_flashdata('msg_assesment', 'Sending result written assesment failed.');
                        redirect(base_url('index.php/assesment/index'));                                
                }   		
	}
    
   	public function update_oral($id, $personnel_number, $id_scope){		
		if ( ! $this->input->post()) show_404(); 
	
		$request_number_fk      = $this->input->post('request_number');			
		$assesment_scope 		= $this->input->post('id_assesment_scope');        
		$pic_oral 				= $this->input->post('pic_oral');        

		$data_applicant   		= $this->model_assesment->get_data_row_personnel_by($personnel_number);
	    $sess_data_gm           = $this->model_assesment->get_gm_personnel_by($personnel_number)->row_array();
	    $name_applicant   		= $data_applicant['name'];
        $email_applicant   		= $data_applicant['email'];
        $email_superior  		= $data_applicant['email_superior'];  
        $email_gm               = $sess_data_gm['email'];           
        $config         = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.gmf-aeroasia.co.id',
            'smtp_port' => 25,
            'smtp_user' => 'app.notif',
            'smtp_pass' => 'app.notif',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('mail.gmf-aeroasia.co.id');
        $this->email->to($email_applicant);
        // $this->email->to($email_superior);
        // $this->email->to($email_gm);
        // $this->email->to('list-tqd@gmf-aeroasia.co.id');
        $this->email->subject('Result oral assesment');

		$data = array(									
			'score_oral'	   	             => $this->input->post('score_oral'),
            'result_oral'	   	         	 => $this->input->post('result_oral'),
            'note_oral'                      => $this->input->post('note_oral'),
            'date_result_oral'			     => date('Y-m-d'),
            'pic_oral'					 	 => $pic_oral,
		);
        
        $this->db->where('request_number_fk', $request_number_fk);
        $this->db->where('id_assesment_scope_fk', $assesment_scope);
		$this->db->update('t_assesment', $data);
		
		$cek_result_oral  = $this->model_assesment->get_result_oral($request_number_fk, $personnel_number);
			$pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
                </head></body>';                
                $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
                $pesan .= '<p>Your result oral assesment : </p>';
                $pesan .= '<table border="1">
                        <tr>
                        <td> No </td>
                        <td> Authorization scope </td>                                
                        <td> Score </td>                        
                        <td> Result </td>                                               
                        <td> Note </td>                                               
                        </tr>';
                $no = 1;
                    foreach ($cek_result_oral as $row) {                                
                        $pesan .= '<tr>                        
                                <td> ' . $no++ . ' </td>
                                <td> ' . $row->name_spect . ' '. $row->name_category . ' ' . $row->name_scope.' '. $row->status_etops.'</td>
                                <td> ' . $row->score_oral . ' </td>                               
                                <td> ' . $row->result_oral . ' </td>
                                <td> ' . $row->note_oral . ' </td>
                                </tr>';
                    }
                $pesan .= '</table>';                        
                $pesan .= '<p>Best Regards</p>';
                $pesan .= '<b>Personnel Qualification & Quality System Documentation /TQD</b>';
                $pesan .= '<p>PT GMF AeroAsia</p>';
                $pesan .= '<p>Phone: Phone: +62-21-550 8732</p>';
                $pesan .= '<p>Fax: +62-21-550 1257</p>';
                $this->email->message($pesan);                 
                if ($this->email->send()) {
                        $this->session->set_flashdata('msg', 'Sending result oral assesment successfull.');
                        redirect(base_url('index.php/assesment/index'));                                
                    } else {
                    	$this->session->set_flashdata('msg', 'Sending result oral assesment failed.');
                        redirect(base_url('index.php/assesment/index'));                                
                }  
	}

    public function update_practical($id, $personnel_number, $id_scope){     
        if ( ! $this->input->post()) show_404();     
        $request_number_fk      = $this->input->post('request_number');         
        $assesment_scope        = $this->input->post('id_assesment_scope');        
        $pic_practical          = $this->input->post('pic_practical');        

        $data_applicant         = $this->model_assesment->get_data_row_personnel_by($personnel_number);
        $sess_data_gm           = $this->model_assesment->get_gm_personnel_by($personnel_number)->row_array();
        $name_applicant         = $data_applicant['name'];
        $email_applicant        = $data_applicant['email'];
        $email_superior         = $data_applicant['email_superior'];  
        $email_gm               = $sess_data_gm['email'];           
        $config         = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.gmf-aeroasia.co.id',
            'smtp_port' => 25,
            'smtp_user' => 'app.notif',
            'smtp_pass' => 'app.notif',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('mail.gmf-aeroasia.co.id');
        $this->email->to($email_applicant);
        // $this->email->to($email_superior);
        // $this->email->to($email_gm);
        // $this->email->to('list-tqd@gmf-aeroasia.co.id');
        $this->email->subject('Result oral assesment');

        $data = array(                                  
            'score_practical'           => $this->input->post('score_practical'),
            'result_practical'          => $this->input->post('result_practical'),
            'note_practical'            => $this->input->post('note_practical'),
            'date_result_practical'     => date('Y-m-d'),
            'pic_practical'             => $pic_practical,
        );
        
        $this->db->where('request_number_fk', $request_number_fk);
        $this->db->where('id_assesment_scope_fk', $assesment_scope);
        $this->db->update('t_assesment', $data);
        
        $cek_result_practical  = $this->model_assesment->get_result_practical($request_number_fk, $personnel_number);
        $pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
        "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
        <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
        </head></body>';                
        $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
        $pesan .= '<p>Your result oral assesment : </p>';
        $pesan .= '<table border="1">
                <tr>
                <td> No </td>
                <td> Authorization scope </td>                                
                <td> Score </td>                        
                <td> Result </td>                                               
                <td> Note </td>                                               
                </tr>';
        $no = 1;
            foreach ($cek_result_practical as $row) {                                
                $pesan .= '<tr>                        
                        <td> ' . $no++ . ' </td>
                        <td> ' . $row->name_spect . ' '. $row->name_category . ' ' . $row->name_scope.' '. $row->status_etops.'</td>
                        <td> ' . $row->score_practical . ' </td>                               
                        <td> ' . $row->result_practical . ' </td>
                        <td> ' . $row->note_practical . ' </td>
                        </tr>';
            }
        $pesan .= '</table>';                        
        $pesan .= '<p>Best Regards</p>';
        $pesan .= '<b>Personnel Qualification & Quality System Documentation /TQD</b>';
        $pesan .= '<p>PT GMF AeroAsia</p>';
        $pesan .= '<p>Phone: Phone: +62-21-550 8732</p>';
        $pesan .= '<p>Fax: +62-21-550 1257</p>';

        $this->email->message($pesan);                 
        if ($this->email->send()) {
                $this->session->set_flashdata('msg_assesment', 'Sending result practical assesment successfull.');
                redirect(base_url('index.php/assesment/index'));                                
            } else {
                $this->session->set_flashdata('msg_assesment', 'Sending result practical assesment failed.');
                redirect(base_url('index.php/assesment/index'));                                
        }  
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

	public function option_employee_tqd()
    {
        $m_employee = $this->db->query("SELECT personnel_number, name FROM UNION_EMP WHERE departement LIKE 'TQD%'");
        return options($m_employee, 'personnel_number', 'name');
    }                

}

/* End of file Users.php */
/* Location: ./application/modules/master/controllers/Users.php */  