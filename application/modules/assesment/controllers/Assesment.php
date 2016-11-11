<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');    

// -- Class Name : Apply_license
// -- Purpose : 
// -- Created On : 
    class Assesment extends MX_Controller {
        

// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
        function __construct(){
            parent::__construct();
            date_default_timezone_set('Asia/Jakarta');
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->helper('form');
            $this->load->model('m_assesment');
            $this->load->model('apply_license/m_apply_license');            
        }

        public
// -- Function Name : schedule_event
// -- Params : $request_number_approved,$personnel_number_superior
// -- Purpose :
       function schedule_event($request_number_approved='',$personnel_number=''){ 
        $user_data              = $this->session->userdata('users_applicant');
        $sess_personnel         = $user_data->PERNR;
        $sess_report_to         = $this->m_apply_license->get_data_row_personnel_by($personnel_number);
        $sess_data_gm           = $this->m_apply_license->get_gm_personnel_by($personnel_number)->row_array();
        $report_to              = $sess_report_to['REPORT_TO'];
        $report_gm              = $sess_data_gm['personnel_number'];
        
            if ($sess_personnel == $personnel_number || $sess_personnel == $report_to || $sess_personnel == $report_gm) {

                $data['get_data_apply_personnel_by']    = $this->m_assesment->get_emp_assesment($request_number_approved);
                $data['get_data_emp_personnel_by']      = $this->m_assesment->get_emp_for_assesment($personnel_number);            
                $data['data_assesment']                 = $this->m_assesment->get_data_assesment($personnel_number,$request_number_approved);            
                $this->page->view('schedule_assesment',$data);
            } else {
                $this->session->set_flashdata('content_not_valid', 'Have not Assesment Schedule.');
                redirect(base_url('home/index'));
            }
        }

        public function get_all_room(){
            $m_room = $this->db->query("SELECT id_room, name_room FROM m_room");
            return options($m_room, 'id_room', 'name_room');
        }
        
        public
// -- Function Name : assesment_event
// -- Params : $request_number_approved,$personnel_number_superior
// -- Purpose :
        function cek_room($date_assesment, $id_sesi, $id_room){             
            $this->m_assesment->get_room_by($date_assesment, $id_sesi, $id_room);                                                                     
        } 

        public 
        
        function cek_one_room(){
            $this->m_assesment->get_room();                        
        }

        public
// -- Function Name : assesment_event
// -- Params : $request_number_approved,$personnel_number_superior
// -- Purpose :
        function get_room_kuota($date_written_assesment, $id_sesi, $id_room){             
            $this->m_assesment->get_room_kuota($date_written_assesment, $id_sesi, $id_room);
        }
        
        public
// -- Function Name : assesment_event
// -- Params : $request_number_approved,$personnel_number_superior
// -- Purpose :
        function get_summary_assesment($sesi='', $assesment='', $room='', $date_written_assesment ='',$summary_name='') {             
            $this->m_assesment->get_summary_assesment($sesi, $assesment, $room, $date_written_assesment, $summary_name);                                               
        }
        
        public
// -- Function Name : assesment_event
// -- Params : $request_number_approved,$personnel_number_superior
// -- Purpose :
        function save_assesment(){            
            if(isset($_POST['submitassesmentevent'])){ 
                $request_number             = $this->input->post('request_number');
                $check_assesment            = $this->input->post('check_assesment');              
                $personnel_number           = $this->input->post('personnel_number');
                $id_assesment               = $this->input->post('id_assesment');
                $date_written_assesment     = $this->input->post('date_written_assesment');
                $id_sesi                    = $this->input->post('id_sesi');
                $id_room                    = $this->input->post('id_room');
                $id_license                 = $this->input->post('id_license');
                $id_type                    = $this->input->post('id_type');
                $id_spect                   = $this->input->post('id_spect');
                $id_category                = $this->input->post('id_category');
                $id_scope                   = $this->input->post('id_scope');                                       
                foreach($id_assesment as $key => $value){            
                    @$data_assesment = array(            
                    'date_written_assesment'    => date('Y-m-d',strtotime($date_written_assesment[$key])),
                    'id_written_sesi'           => $id_sesi[$key],
                    'id_written_room_fk'        => $id_room[$key],                                    
                    ); 

                    $this->db->where('id_auth_license_fk',$id_license[$key]);
                    $this->db->where('id_auth_type_fk',$id_type[$key]);
                    $this->db->where('id_auth_spec_fk',$id_spect[$key]);
                    $this->db->where('id_auth_category_fk',$id_category[$key]);
                    $this->db->where('id_auth_scope_fk',$id_scope[$key]);
                    $this->db->update('t_assesment',@$data_assesment);
                     
                    
                    $this->db->query("UPDATE t_apply_license_dtl SET status_written_assesment = '2' WHERE 
                    request_number_fk = '$request_number' AND
                    id_auth_license_fk = '$id_license[$key]' AND
                    id_auth_type_fk = '$id_type[$key]' AND
                    id_auth_spect_fk = '$id_spect[$key]' AND
                    id_auth_category_fk = '$id_category[$key]' AND
                    id_auth_scope_fk = '$id_scope[$key]' AND
                    id_assesment_scope_fk = '$id_assesment[$key]'");  
                }            
            $this->db->query("UPDATE t_apply_license SET status_assesment = '1' where request_number = '$request_number'");                                                
            } 
            redirect('home/index');                                                                                                          
        }
      
}

?>