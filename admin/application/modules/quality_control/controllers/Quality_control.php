<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quality_control extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->page->use_directory();
        $this->load->model('model_quality_control');
        $this->load->helper('url');
        $this->load->helper('email');
    }
    
    public function index()
    {
        $this->page->view('quality_change_index', array(
            'search'                        => site_url('quality_control/quality_control/form_list_search'),
            'request_number'                => $this->input->post('request_number'),
            'personnel_number'              => $this->input->post('personnel_number'),
            'reason_apply_license'          => $this->input->post('reason_apply_license'),
            'code_unit'                     => $this->input->post('code_unit'),
            'priority'                      => $this->input->post('priority'),
            'datetime_priority'             => $this->input->post('datetime_priority'),
            'personnel_number_superior'     => $this->input->post('personnel_number_superior'),
            'personnel_number_quality'      => $this->input->post('personnel_number_quality'),
            'id_disposition_user_fk'        => $this->input->post('id_disposition_user_fk'),
            'id_location_user_fk'           => $this->input->post('id_location_user_fk'),
            'date_request'                  => $this->input->post('date_request'),
            'date_approved_superior'        => $this->input->post('date_approved_superior'),
            'date_approved_quality'         => $this->input->post('date_approved_quality'),
            'date_referral_authorization'   => $this->input->post('date_referral_authorization'),
            'date_take_authorization'       => $this->input->post('date_take_authorization'),
            'status_submit'                 => $this->input->post('status_submit'),
            'status_approved_superior'      => $this->input->post('status_approved_superior'),
            'status_approved_quality'       => $this->input->post('status_approved_quality'),
            'status_assesment'              => $this->input->post('status_assesment'),
            'status_issue_authorization'    => $this->input->post('status_issue_authorization'),
            'referral_authorization'        => $this->input->post('referral_authorization'),
            'take_authorization'            => $this->input->post('take_authorization')
        ));
    }
    
    public function ajax_get_history_inf()
    {
        $list = $this->model_quality_control->get_quality_control_high();
        $data = array();
        $no   = $_POST['start'];
        
        foreach ($list as $grid) {
            $row   = array();
            $row[] = $grid->date_request;
            $row[] = $grid->priority;
            $row[] = $grid->request_number;
            $row[] = $grid->name;
            $row[] = $grid->personnel_number;
            $row[] = $grid->name_disposition;
            $row[] = $grid->name_location;
            $row[] = $grid->current_status;
            $row[] = $grid->last_update;
            $row[] = $grid->time;
            @$date_submited = $grid->date_request;
            if ($grid->date_finish != null) {
                @$date_until = $grid->date_finish;
                };
            if ($grid->date_finish == null) {
                @$date_until = date('d-m-Y');
                };
            $row[]  = round(abs(strtotime($date_until) - strtotime($date_submited)) / 86400);
            $row[]  = $grid->date_priority;
            $row[]  = $grid->time_priority;
            $row[]  = $grid->remark;
            $row[]  = '<a href="' . site_url('quality_control/view/' . $grid->request_number) . '" title="Edit Data"><button class="btn-info btn-sm btn-flat">View</button></a>';
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_quality_control->count_all_high(),
            "recordsFiltered" => $this->model_quality_control->count_filtered_high(),
            "data" => $data
        );
        
        //output to json format
        echo json_encode($output);
    }
    
    public function ajax_get_history_inf_normal()
    {
        $list = $this->model_quality_control->get_quality_control_normal();
        $data = array();
        $no   = $_POST['start'];
        
        foreach ($list as $grid) {
            $row   = array();
            $row[] = $grid->date_request;
            $row[] = $grid->request_number;
            $row[] = $grid->name;
            $row[] = $grid->personnel_number;
            $row[] = $grid->name_disposition;
            $row[] = $grid->name_location;
            $row[] = $grid->current_status;
            $row[] = $grid->last_update;
            $row[] = $grid->time;
            @$date_submited = $grid->date_request;
            if ($grid->date_finish != null) {
                @$date_until = $grid->date_finish;
                };
            if ($grid->date_finish == null) {
                @$date_until = date('d-m-Y');
                };
            $row[]  = round(abs(strtotime($date_until) - strtotime($date_submited)) / 86400);
            $row[]  = $grid->remark;
            $row[]  = '<a href="' . site_url('quality_control/view/' . $grid->request_number) . '" title="Edit Data"><button class="btn-info btn-sm btn-flat">View</button></a>';
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_quality_control->count_all(),
            "recordsFiltered" => $this->model_quality_control->count_filtered(),
            "data" => $data
        );
        
        //output to json format
        echo json_encode($output);
    }

    public function ajax_get_history_inf_finish()
    {
        $list = $this->model_quality_control->get_quality_control_finish();
        $data = array();
        $no   = $_POST['start'];
        
        foreach ($list as $grid) {
            $row   = array();
            $row[] = $grid->date_request;
            $row[] = $grid->request_number;
            $row[] = $grid->name;
            $row[] = $grid->personnel_number;
            $row[] = $grid->name_disposition;
            $row[] = $grid->name_location;
            $row[] = $grid->current_status;
            $row[] = $grid->last_update;
            $row[] = $grid->time;
            @$date_submited = $grid->date_request;
            if ($grid->date_finish != null) {
                @$date_until = $grid->date_finish;
                };
            if ($grid->date_finish == null) {
                @$date_until = date('d-m-Y');
                };
            $row[]  = round(abs(strtotime($date_until) - strtotime($date_submited)) / 86400);
            $row[]  = $grid->remark;
            $row[]  = '<a href="' . site_url('quality_control/view/' . $grid->request_number) . '" title="Edit Data"><button class="btn-info btn-sm btn-flat">View</button></a>';
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_quality_control->count_all_finish(),
            "recordsFiltered" => $this->model_quality_control->count_filtered_finish(),
            "data" => $data
        );
        
        //output to json format
        echo json_encode($output);
    }
    
    private function form($action = '', $id = '')
    {
        if ($this->agent->referrer() == '')
            redirect(site_url('quality_control'));
        $title = '';
        if ($this->uri->segment(3) == 'view') {
            $title = 'View';
            };
        if ($this->uri->segment(3) == 'edit') {
            $title = 'Edit';
            };
        if ($this->uri->segment(3) == 'add') {
            $title = 'Add';
            };
        
        $this->page->view('quality_change_form', array(
            'ttl'           => $title,            
            'back_home_quality' => site_url('quality_control/index'),
            'action'        => site_url('quality_control/quality_control/' . $action . '/' . $id . ''),
            'rc'            => $this->model_quality_control->by_request_number($id),
            'rc_assesment_history' => $this->model_quality_control->get_assesment_history($id),
            'rc_license'    => $this->model_quality_control->cek_summary($id),
            'aksi'          => $action
        ));
    }
    
    public function add($id)
    {
        $this->form('add', $id);
        $sess_personnel_number = $this->session->userdata('users_quality')->PERNR;
        $cek_server = $this->input->server('SERVER_NAME');
        // content approved quality     = 5
        $cek_content_approved           =  $this->model_quality_control->get_content_msg_quality('5');
        // content disapproved quality  = 6
        $cek_content_disapproved        =  $this->model_quality_control->get_content_msg_quality('6');
        // content oral assesment       = 7
        $cek_content_oral               =  $this->model_quality_control->get_content_msg_quality('7');
        // content written assesment    = 8            
        $cek_content_written            =  $this->model_quality_control->get_content_msg_quality('8');
        // content practical assesment  = 9            
        $cek_content_practical          =  $this->model_quality_control->get_content_msg_quality('9');        

        $url_apply_license     = $cek_server.'/app_olds/';        
        if (isset($_POST['simpan_detail_history'])) {
            $request_number    = $this->input->post('request_number');
            $personnel_number  = $this->input->post('personnel_number');
            $name_disposition  = $this->input->post('name_disposition');
            $name_location     = $this->input->post('name_location');
            $current_status    = $this->input->post('current_status');
            $m_sub_status      = $this->input->post('sub_status');
            $priority          = $this->input->post('priority');
            $datetime_priority = $this->input->post('datetime_priority');
            $remark            = $this->input->post('remark');
            $data_applicant    = $this->model_quality_control->get_data_row_personnel_by($personnel_number);
            
            $name_applicant    = $data_applicant['EMPLNAME'];
            $email_applicant   = $data_applicant['EMAIL'];
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'devlicensetq@gmail.com',
            'smtp_pass' => 'Bismillah1995', 
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE);
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('mail.gmf-aeroasia.co.id');
            $this->email->to($email_applicant);
            $this->email->subject('APPLY LICENSE');
            
            
            if (@$priority == 'Normal') {
                $data = array(
                    'priority' => $priority,                    
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }

            if (@$priority == 'High' && @$datetime_priority != '') {
                $data = array(
                    'priority' => $priority,
                    'datetime_priority' => $datetime_priority
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($name_disposition != '' || $name_location != '') {
                $data = array(
                    'id_disposition_user_fk' => $name_disposition,
                    'id_location_user_fk' => $name_location
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($remark != '' || $remark == '') {
                $data = array(
                    'remark' => $remark
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($m_sub_status == '3') {
                $this->email->subject(@$cek_content_approved['subject']);
                $pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                             "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                             <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/></head></body>';
                $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
                $pesan .= '<p>'. @$cek_content_approved['title'] .'<b>Request Number</b> : ' . $request_number . '</p>';
                $pesan .= @$cek_content_approved['content'];
                $pesan .= @$cek_content_approved['footer'];
                //die($pesan);
                $this->email->message($pesan);                
                if ($this->email->send()) {
                    $data = array(
                        'status_approved_quality' => '1',
                        'date_approved_quality' => date('Y-m-d H:i:s'),
                        'personnel_number_quality' => $sess_personnel_number,
                        'finished' => NULL,
                        'date_finish' => NULL
                    );
                    $this->db->where('request_number', $request_number);
                    $this->db->update('t_apply_license', $data);
                    $this->session->set_flashdata('msg', 'Document '.$request_number.' is Validated');
                    redirect(site_url('quality_control'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed send email');
                    redirect(site_url('quality_control'));
                } 

            };
            if ($m_sub_status == '4') {
                $this->email->subject(@$cek_content_disapproved['subject']);
                $pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                             "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                             <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/></head></body>';
                $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
                $pesan .= '<p>'. @$cek_content_disapproved['title'] .'</p>';
                $pesan .= '<p><b>Request Number</b> : ' . $request_number . '</p>';                
                $pesan .= @$cek_content_disapproved['content'];
                $pesan .= @$cek_content_disapproved['footer'];
                //die($pesan);
                $this->email->message($pesan);
                if ($this->email->send()) {
                    $data = array(
                        'status_approved_quality' => '2',
                        'date_approved_quality' => date('Y-m-d H:i:s'),
                        'personnel_number_quality' => $sess_personnel_number,
                        'finished' => '1',
                        'date_finish' => date('Y-m-d H:i:s')
                    );
                    $this->db->where('request_number', $request_number);
                    $this->db->update('t_apply_license', $data);
                    $this->session->set_flashdata('msg', 'Send email successfull.');
                    redirect(site_url('quality_control'));
                } else {
                    $this->session->set_flashdata('msg', 'Failed send email.');
                    redirect(site_url('quality_control'));
                }  
            };
            
            // Assesment           
            
            if ($m_sub_status == '6') {
                $data = array(
                    'date_status_assesment'         => date('Y-m-d H:i:s'),
                    'personnel_number_assesment'    => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($m_sub_status == '7') {
                $data = array(
                    'status_assesment' => '2',
                    'date_status_assesment' => date('Y-m-d H:i:s'),                    
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            // Issue Authorization
            
            if ($m_sub_status == '8') {
                $data_authorization = array(
                    'request_number_fk' => $request_number,
                    'id_issue_fk' => '1',
                    'date_issue' => date('Y-m-d H:i:s')
                );
                $this->db->insert('t_issue_authorization', $data_authorization);
                
                $data = array(
                    'status_issue_authorization' => '1',
                    'date_status_issue_authorization' => date('Y-m-d H:i:s'),
                    'personnel_number_issue_authorization' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($m_sub_status == '9') {
                $data_authorization = array(
                    'request_number_fk' => $request_number,
                    'id_issue_fk' => '2',
                    'date_issue' => date('Y-m-d H:i:s')
                );
                $this->db->insert('t_issue_authorization', $data_authorization);
                
                $data = array(
                    'status_issue_authorization' => '1',
                    'date_status_issue_authorization' => date('Y-m-d H:i:s'),
                    'personnel_number_issue_authorization' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($m_sub_status == '10') {
                $data_authorization = array(
                    'request_number_fk' => $request_number,
                    'id_issue_fk' => '3',
                    'date_issue' => date('Y-m-d H:i:s')
                );
                $this->db->insert('t_issue_authorization', $data_authorization);
                
                $data = array(
                    'status_issue_authorization' => '1',
                    'date_status_issue_authorization' => date('Y-m-d H:i:s'),
                    'personnel_number_issue_authorization' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($m_sub_status == '11') {
                $data_authorization = array(
                    'request_number_fk' => $request_number,
                    'id_issue_fk' => '4',
                    'date_issue' => date('Y-m-d H:i:s')
                );
                $this->db->insert('t_issue_authorization', $data_authorization);
                
                $data = array(
                    'status_issue_authorization' => '1',
                    'date_status_issue_authorization' => date('Y-m-d H:i:s'),
                    'personnel_number_issue_authorization' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($m_sub_status == '12') {
                $data_authorization = array(
                    'request_number_fk' => $request_number,
                    'id_issue_fk' => '5',
                    'date_issue' => date('Y-m-d H:i:s')
                );
                $this->db->insert('t_issue_authorization', $data_authorization);
                
                $data = array(
                    'status_issue_authorization' => '1',
                    'personnel_number_issue_authorization' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($m_sub_status == '13') {
                $data_authorization = array(
                    'request_number_fk' => $request_number,
                    'id_issue_fk' => '6',
                    'date_issue' => date('Y-m-d H:i:s')
                );
                $this->db->insert('t_issue_authorization', $data_authorization);
                
                $data = array(
                    'status_issue_authorization' => '1',
                    'date_status_issue_authorization' => date('Y-m-d H:i:s'),
                    'personnel_number_issue_authorization' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            if ($m_sub_status == '14') {
                $data = array(
                    'status_issue_authorization' => '2',
                    'date_status_issue_authorization' => date('Y-m-d H:i:s'),
                    'personnel_number_issue_authorization' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            // Referral Authorization
            if ($m_sub_status == '18') {
                $data = array(
                    'referral_authorization' => '1',
                    'date_referral_authorization' => date('Y-m-d H:i:s'),
                    'personnel_number_ref_auth' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }
            
            // Take Authorization
            if ($m_sub_status == '15') {
                $data = array(
                    'take_authorization' => '1',
                    'date_take_authorization' => date('Y-m-d H:i:s'),
                    'personnel_number_take_auth' => $sess_personnel_number,
                    'finished' => '1',
                    'date_finish' => date('Y-m-d H:i:s'),
                    'personnel_number_finish' => $sess_personnel_number
                );
                $this->db->where('request_number', $request_number);
                $this->db->update('t_apply_license', $data);
            }            
             $this->session->set_flashdata('msg', 'Update current status successfull.');
            redirect(site_url('quality_control'));
        }
        if (isset($_POST['saveoralassesment'])) {
            $request_number               = $this->input->post('request_number');
            $check_assesment              = $this->input->post('check_assesment');
            $personnel_number             = $this->input->post('personnel_number');
            $id_assesment                 = $this->input->post('id_assesment');
            $date_oral_assesment          = $this->input->post('date_oral_assesment');
            $id_oral_sesi                 = $this->input->post('id_oral_sesi');
            $id_oral_room                 = $this->input->post('id_oral_room');
            $id_license                   = $this->input->post('id_license');
            $id_type                      = $this->input->post('id_type');
            $id_spect                     = $this->input->post('id_spect');
            $id_category                  = $this->input->post('id_category');
            $id_scope                     = $this->input->post('id_scope');
            
            $data_applicant   = $this->model_quality_control->get_data_row_personnel_by($personnel_number);
            $name_applicant   = $data_applicant['EMPLNAME'];
            $email_applicant  = $data_applicant['EMAIL'];            
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'devlicensetq@gmail.com',
            'smtp_pass' => 'Bismillah1995', 
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE);
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('mail.gmf-aeroasia.co.id');
            $this->email->to($email_applicant);
            // $this->email->to('list-tqd@gmf-aeroasia.co.id');
            $this->email->subject(@$cek_content_oral['subject']);

            $data_update_status_assesment = array(
                'status_assesment' => '1',
                'date_status_assesment' => date('Y-m-d H:i:s'),
                'personnel_number_assesment'    => $sess_personnel_number
            );
            $this->db->where('request_number', $request_number);
            $this->db->update('t_apply_license', $data_update_status_assesment);
            if (@$check_assesment != '') {
                foreach ($check_assesment as $key => $value) {
                    $cek_oral_assesment = $this->model_quality_control->cek_assesment($request_number, $personnel_number, $id_license[$key], $id_type[$key], $id_spect[$key], $id_category[$key], $id_scope[$key]);
                    if ($cek_oral_assesment->num_rows() > 0) {
                            $data_oral_assesment = array(
                                'date_oral_assesment'   => date('Y-m-d', strtotime($date_oral_assesment[$key])),
                                'id_oral_sesi'          => $id_oral_sesi[$key],
                                'id_oral_room_fk'       => $id_oral_room[$key]
                            );
                        $this->db->where('request_number_fk', $request_number);
                        $this->db->where('personnel_number_fk', $personnel_number);
                        $this->db->where('id_auth_license_fk', $id_license[$key]);
                        $this->db->where('id_auth_type_fk', $id_type[$key]);
                        $this->db->where('id_auth_spec_fk', $id_spect[$key]);
                        $this->db->where('id_auth_category_fk', $id_category[$key]);
                        $this->db->where('id_auth_scope_fk', $id_scope[$key]);
                        $this->db->where('id_assesment_scope_fk', $id_assesment[$key]);
                        $this->db->update('t_assesment', $data_oral_assesment);                        
                    } else {
                        $data_assesment = array(
                            'request_number_fk'     => $request_number,
                            'personnel_number_fk'   => $personnel_number,
                            'status_assesment'      => '1', //send by quality            
                            'id_assesment_scope_fk' => $id_assesment[$key],
                            'date_oral_assesment'   => date('Y-m-d', strtotime($date_oral_assesment[$key])),
                            'id_oral_sesi'          => $id_oral_sesi[$key],
                            'id_oral_room_fk'       => $id_oral_room[$key],
                            'id_auth_license_fk'    => $id_license[$key],
                            'id_auth_type_fk'       => $id_type[$key],
                            'id_auth_spec_fk'       => $id_spect[$key],
                            'id_auth_category_fk'   => $id_category[$key],
                            'id_auth_scope_fk'      => $id_scope[$key],
                            'date_assesment'        => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('t_assesment', $data_assesment);
                    }
                    $this->db->query("UPDATE t_apply_license_dtl SET status_oral_assesment = '1' WHERE 
                                request_number_fk = '$request_number' AND
                                id_auth_license_fk = '$id_license[$key]' AND
                                id_auth_type_fk = '$id_type[$key]' AND
                                id_auth_spect_fk = '$id_spect[$key]' AND
                                id_auth_category_fk = '$id_category[$key]' AND
                                id_auth_scope_fk = '$id_scope[$key]' AND
                                id_assesment_scope_fk = '$id_assesment[$key]'");
                }
                    $cekdataoral  = $this->model_quality_control->get_data_assesment_oral_by($personnel_number, $request_number);                    
                    $pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                        "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                        <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
                        </head></body>';
                        $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
                        $pesan .= '<p>'. @$cek_content_oral['title'] .'</p>';
                        $pesan .= '<table border="1">
                                <tr>
                                <td> No </td>
                                <td> Authorization scope </td>                                
                                <td> Room </td>                        
                                <td> Date </td>                        
                                <td> Sesi  </td>                        
                                </tr>';
                        $no = 1;
                            foreach ($cekdataoral as $row) {                                

                                $is_etops = $row->is_etops;                                
                                        switch ($is_etops) {
                                            case 0:
                                                $status_etops = '';
                                                break;
                                            case 1:
                                                $status_etops = '+ ETOPS';
                                                break;
                                            }
                                $pesan .= '<tr>                        
                                        <td> ' . $no++ . ' </td>
                                        <td> ' . $row->name_spect . ' '. $row->name_category . ' ' . $row->name_scope.' '. $status_etops.'</td>
                                        <td> ' . $row->name_room . ' </td>
                                        <td> ' . date('d-m-Y',strtotime($row->date_oral_assesment)) . ' </td>
                                        <td> ' . $row->name_sesi . ' </td>
                                        </tr>';
                            }
                        $pesan .= '</table>';                        
                        $pesan .= @$cek_content_oral['content'];                        
                        $pesan .= @$cek_content_oral['footer'];                        
                        //die($pesan);
                        $this->email->message($pesan);                    
                        if ($this->email->send()) {
                                $this->session->set_flashdata('msg', 'Sending schedule oral assesment successfully.');
                                redirect(site_url('quality_control'));                                
                            } else {
                                $this->session->set_flashdata('msg', 'Sending schedule oral assesment failed.');
                                redirect(site_url('quality_control'));
                        }                
                    }            
            }
        if (isset($_POST['savewrittenassesment'])) {
            $personnel_number = $this->input->post('personnel_number');
            $data_applicant   = $this->model_quality_control->get_data_row_personnel_by($personnel_number);
            $name_applicant   = $data_applicant['EMPLNAME'];
            $email_applicant  = $data_applicant['EMAIL'];
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'devlicensetq@gmail.com',
            'smtp_pass' => 'Bismillah1995', 
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE);
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('mail.gmf-aeroasia.co.id');
            $this->email->to($email_applicant);
            // $this->email->to('list-tqd@gmf-aeroasia.co.id');
            $this->email->subject(@$cek_content_written['subject']);
            
            
            $request_number               = $this->input->post('request_number');
            $personnel_number             = $this->input->post('personnel_number');
            $check_assesment              = $this->input->post('check_assesment');
            $id_assesment                 = $this->input->post('id_assesment');
            $date_written_assesment       = $this->input->post('date_written_assesment');
            $id_written_sesi              = $this->input->post('id_written_sesi');
            $id_written_room              = $this->input->post('id_written_room');
            $id_license                   = $this->input->post('id_license');
            $id_type                      = $this->input->post('id_type');
            $id_spect                     = $this->input->post('id_spect');
            $id_category                  = $this->input->post('id_category');
            $id_scope                     = $this->input->post('id_scope');
            $data_update_status_assesment = array(
                'status_assesment' => '1',
                'date_status_assesment' => date('Y-m-d H:i:s'),
                'personnel_number_assesment'    => $sess_personnel_number
            );
            $this->db->where('request_number', $request_number);
            $this->db->update('t_apply_license', $data_update_status_assesment);
            if (@$check_assesment != '') {
                foreach ($check_assesment as $key => $value) {
                    $cek_written_assesment = $this->model_quality_control->cek_assesment($request_number, $personnel_number, $id_license[$key], $id_type[$key], $id_spect[$key], $id_category[$key], $id_scope[$key]);
                    //print_r($cek_written_assesment->num_rows());
                    //            die();
                    if ($cek_written_assesment->num_rows() > 0) {
                        //die('data udah ada tinggal update');
                        $data_written_assesment = array(
                            'date_written_assesment' => date('Y-m-d', strtotime($date_written_assesment[$key])),
                            'id_written_sesi' => $id_written_sesi[$key],
                            'id_written_room_fk' => $id_written_room[$key]
                        );
                        $this->db->where('request_number_fk', $request_number);
                        $this->db->where('personnel_number_fk', $personnel_number);
                        $this->db->where('id_auth_license_fk', $id_license[$key]);
                        $this->db->where('id_auth_type_fk', $id_type[$key]);
                        $this->db->where('id_auth_spec_fk', $id_spect[$key]);
                        $this->db->where('id_auth_category_fk', $id_category[$key]);
                        $this->db->where('id_auth_scope_fk', $id_scope[$key]);
                        $this->db->where('id_assesment_scope_fk', $id_assesment[$key]);
                        $this->db->update('t_assesment', $data_written_assesment);                        
                    } else {
                        //die('input baru');
                        $data_assesment = array(
                            'request_number_fk' => $request_number,
                            'personnel_number_fk' => $personnel_number,
                            'status_assesment' => '1', //send by quality            
                            'id_assesment_scope_fk' => $id_assesment[$key],
                            'date_written_assesment' => date('Y-m-d', strtotime($date_written_assesment[$key])),
                            'id_written_sesi' => $id_written_sesi[$key],
                            'id_written_room_fk' => $id_written_room[$key],
                            'id_auth_license_fk' => $id_license[$key],
                            'id_auth_type_fk' => $id_type[$key],
                            'id_auth_spec_fk' => $id_spect[$key],
                            'id_auth_category_fk' => $id_category[$key],
                            'id_auth_scope_fk' => $id_scope[$key],
                            'date_assesment' => date('Y-m-d H:i:s')
                        );
                        //print_r($data_assesment);
                        //            die();             
                        $this->db->insert('t_assesment', $data_assesment);
                    }
                    $this->db->query("UPDATE t_apply_license_dtl SET status_written_assesment = '1' WHERE 
                                    request_number_fk = '$request_number' AND
                                    id_auth_license_fk = '$id_license[$key]' AND
                                    id_auth_type_fk = '$id_type[$key]' AND
                                    id_auth_spect_fk = '$id_spect[$key]' AND
                                    id_auth_category_fk = '$id_category[$key]' AND
                                    id_auth_scope_fk = '$id_scope[$key]' AND
                                    id_assesment_scope_fk = '$id_assesment[$key]'");
                }
            }
            
            $pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                 "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                 <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/></head></body>';
            $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
            $pesan .= '<p>'. @$cek_content_written['title'] .'</p>';
            $pesan .= '<p><b>Request Number</b> : ' . $request_number . '</p>';
            
            $pesan .= @$cek_content_written['content'];
            $pesan .= '<p><a href=' . $url_apply_license . 'index.php/assesment/schedule_event/' . $request_number . '/' . $personnel_number . '> ' . $url_apply_license . 'index.php/assesment/schedule_event/' . $request_number . '/' . $personnel_number . '</a></p>';
            $pesan .= @$cek_content_written['footer'];
            //die($pesan);        
            $this->email->message($pesan);
            if ($this->email->send()) {
                    $this->session->set_flashdata('msg', 'Sending schedule written assesment successfully.');
                    redirect(site_url('quality_control'));
                } else {
                    $this->session->set_flashdata('msg', 'Sending schedule written assesment failed.');
                    redirect(site_url('quality_control'));
                }            
        }

                // Practical Assesment
        if (isset($_POST['savepracticalassesment'])) {
            $request_number               = $this->input->post('request_number');
            $check_assesment              = $this->input->post('check_assesment');
            $personnel_number             = $this->input->post('personnel_number');
            $id_assesment                 = $this->input->post('id_assesment');
            $date_practical_assesment     = $this->input->post('date_practical_assesment');
            $id_practical_sesi            = $this->input->post('id_practical_sesi');            
            $id_license                   = $this->input->post('id_license');
            $id_type                      = $this->input->post('id_type');
            $id_spect                     = $this->input->post('id_spect');
            $id_category                  = $this->input->post('id_category');
            $id_scope                     = $this->input->post('id_scope');
            
            $data_applicant               = $this->model_quality_control->get_data_row_personnel_by($personnel_number);
            $name_applicant               = $data_applicant['EMPLNAME'];
            $email_applicant              = $data_applicant['EMAIL'];            
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'devlicensetq@gmail.com',
            'smtp_pass' => 'Bismillah1995', 
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE);

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('mail.gmf-aeroasia.co.id');
            $this->email->to($email_applicant);
            // $this->email->to('list-tqd@gmf-aeroasia.co.id');
            $this->email->subject(@$cek_content_practical['subject']);

            $data_update_status_assesment = array(
                'status_assesment'              => '1',
                'date_status_assesment'         => date('Y-m-d H:i:s'),
                'personnel_number_assesment'    => $sess_personnel_number
            );
            
            $this->db->where('request_number', $request_number);
            $this->db->update('t_apply_license', $data_update_status_assesment);
            if (@$check_assesment != '') {
                foreach ($check_assesment as $key => $value) {
                    $cek_practical_assesment = $this->model_quality_control->cek_assesment($request_number, $personnel_number, $id_license[$key], $id_type[$key], $id_spect[$key], $id_category[$key], $id_scope[$key]);
                    if ($cek_practical_assesment->num_rows() > 0) {
                            $data_practical_assesment = array(
                                'date_practical_assesment'      => date('Y-m-d', strtotime($date_practical_assesment[$key])),
                                'id_practical_sesi'             => $id_practical_sesi[$key],                                
                            );
                        $this->db->where('request_number_fk', $request_number);
                        $this->db->where('personnel_number_fk', $personnel_number);
                        $this->db->where('id_auth_license_fk', $id_license[$key]);
                        $this->db->where('id_auth_type_fk', $id_type[$key]);
                        $this->db->where('id_auth_spec_fk', $id_spect[$key]);
                        $this->db->where('id_auth_category_fk', $id_category[$key]);
                        $this->db->where('id_auth_scope_fk', $id_scope[$key]);
                        $this->db->where('id_assesment_scope_fk', $id_assesment[$key]);
                        $this->db->update('t_assesment', $data_practical_assesment);                        
                    } else {
                        $data_practical_assesment = array(
                            'request_number_fk'         => $request_number,
                            'personnel_number_fk'       => $personnel_number,
                            'status_assesment'          => '1', //send by quality            
                            'id_assesment_scope_fk'     => $id_assesment[$key],
                            'date_practical_assesment'  => date('Y-m-d', strtotime($date_practical_assesment[$key])),
                            'id_practical_sesi'         => $id_practical_sesi[$key],                            
                            'id_auth_license_fk'        => $id_license[$key],
                            'id_auth_type_fk'           => $id_type[$key],
                            'id_auth_spec_fk'           => $id_spect[$key],
                            'id_auth_category_fk'       => $id_category[$key],
                            'id_auth_scope_fk'          => $id_scope[$key],
                            'date_assesment'            => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('t_assesment', $data_practical_assesment);
                    }
                    $this->db->query("UPDATE t_apply_license_dtl SET status_practical_assesment = '1' WHERE 
                                request_number_fk = '$request_number' AND
                                id_auth_license_fk = '$id_license[$key]' AND
                                id_auth_type_fk = '$id_type[$key]' AND
                                id_auth_spect_fk = '$id_spect[$key]' AND
                                id_auth_category_fk = '$id_category[$key]' AND
                                id_auth_scope_fk = '$id_scope[$key]' AND
                                id_assesment_scope_fk = '$id_assesment[$key]'");
                    }
                        $cekdatapractical  = $this->model_quality_control->get_data_assesment_practical_by($personnel_number, $request_number);                    
                        $pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                        "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                        <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
                        </head></body>';
                        $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>'; 
                        $pesan .= '<p>'. @$cek_content_practical['title'] .'</p>';
                        $pesan .= '<table border="1">
                                <tr>
                                <td> No </td>
                                <td> Authorization scope </td>                                
                                <td> Date </td>                        
                                <td> Sesi  </td>                        
                                </tr>';
                        $no = 1;
                            foreach ($cekdatapractical as $row) {                                

                                $is_etops = $row->is_etops;                                
                                        switch ($is_etops) {
                                            case 0:
                                                $status_etops = '';
                                                break;
                                            case 1:
                                                $status_etops = '+ ETOPS';
                                                break;
                                            }
                                $pesan .= '<tr>                        
                                        <td> ' . $no++ . ' </td>
                                        <td> ' . $row->name_spect . ' '. $row->name_category . ' ' . $row->name_scope.' '. $status_etops.'</td>
                                        <td> ' . date('d-m-Y',strtotime($row->date_practical_assesment)) . ' </td>
                                        <td> ' . $row->name_sesi . ' </td>
                                        </tr>';
                            }
                        $pesan .= '</table>';                        
                        $pesan .= @$cek_content_practical['content'];
                        $pesan .= @$cek_content_practical['footer'];
                        //die($pesan);    
                        $this->email->message($pesan);                    
                        if ($this->email->send()) {                                
                                $this->session->set_flashdata('msg', 'Sending schedule practical assesment successfully.');
                                redirect(site_url('quality_control'));                                
                            } else {                                
                                $this->session->set_flashdata('msg', 'Sending schedule practical assesment failed.');
                                redirect(site_url('quality_control'));
                            }                
                    }            
            }
    }    
    
    public function view($id)
    {
        $this->form('view', $id);
    }
    
    public function view_document()
    {
        if (isset($_POST['view_document'])) {
            $personnel_number                           = $this->input->post('personnel_number');
            $request_number                             = $this->input->post('request_number');
            $this->session->set_userdata('request_number', $request_number);
            $this->session->set_userdata('personnel_number', $personnel_number);
            $data['data_file_requirement']              = $this->model_quality_control->get_data_requirement($request_number, $personnel_number);
            $data['data_file_requirement_revision']     = $this->model_quality_control->get_data_requirement_revision($personnel_number);
            $data['request_number']                     = $request_number;
            $data['personnel_number']                   = $personnel_number;
            $data['data_file_general_document_quality'] = $this->model_quality_control->get_general_document_quality($request_number, $personnel_number);
            $data['data_file_spec_document_quality']    = $this->model_quality_control->get_spec_document_quality($request_number);
            $this->page->view('quality_control/form_data_requirement', $data);
        }
    }

    public function view_document_by()
    {
        if (isset($_POST['view_document_by'])) {
            $personnel_number       = $this->input->post('personnel_number');
            $request_number         = $this->input->post('request_number');
            $id_authorization       = $this->input->post('id_authorization');
            $id_type                = $this->input->post('id_type');
            if ($id_authorization != '') {
                $this->session->set_userdata('request_number', $request_number);
                $this->session->set_userdata('personnel_number', $personnel_number);
                $data['data_file_requirement']  = $this->model_quality_control->get_data_requirement($request_number, $personnel_number, $id_authorization, $id_type);            
                $data['request_number']       = $request_number;
                $data['personnel_number']     = $personnel_number;            
                $this->page->view('quality_control/form_data_requirement', $data);
            } else {
                $data['data_file_requirement']              = $this->model_quality_control->get_data_requirement($request_number, $personnel_number);
                $data['data_file_general_document_quality'] = $this->model_quality_control->get_general_document_quality($request_number, $personnel_number);
                $this->page->view('quality_control/form_data_requirement', $data);

            }
        }
    }

    public function cek_date_file_current() {
        $personnel_number       = $this->input->post('personnel_number'); 
        $code_current           = $this->input->post('code_data_requirement'); 
        $date_current           = $this->model_quality_control->cek_date_current($personnel_number, $code_current);
        echo $date_current['date_upload'];
    }

    public function cek_time_file_current() {
        $personnel_number       = $this->input->post('personnel_number'); 
        $code_current           = $this->input->post('code_data_requirement'); 
        $time_current           = $this->model_quality_control->cek_time_current($personnel_number, $code_current);
        echo $time_current['time_upload'];
    }

    public function cek_expiration_file_current() {
        $personnel_number       = $this->input->post('personnel_number'); 
        $code_current           = $this->input->post('code_req_document_certificate'); 
        $expiration_current     = $this->model_quality_control->cek_expiration_current($personnel_number, $code_current);
        echo $expiration_current['expiration_date'];
    }
    
    public function action_document()
    {
        $cek_content_approved           =  $this->model_quality_control->get_content_msg_quality('5');
        // content disapproved quality  = 6
        $cek_content_disapproved        =  $this->model_quality_control->get_content_msg_quality('6');
        if (isset($_POST['action_view_document'])) {
            $personnel_number = $this->input->post('personnel_number');
            $request_number   = $this->session->userdata('request_number');
            $name_file        = $this->input->post('name_file');                                        
            $code_file        = $this->input->post('code_file');
            $date_upload      = $this->input->post('date_upload');
            $time_upload      = $this->input->post('time_upload');            
            @$cd_folder_by    = $this->model_quality_control->get_code_file_by($code_file); 
            $name_file_ftp    = $this->input->post('name_file_ftp');
            @$code_folder     = $cd_folder_by->name;
            
            $data = array(
                'request_number'    => $request_number,
                'personnel_number'  => $personnel_number,
                'name_file'         => $name_file,
                'name_file_ftp'     => $name_file_ftp,
                'code_folder'       => $code_folder,
                'code_file'         => $code_file,
                'ttl'               => 'View requirement'
            );
            $this->page->view('quality_control/form_view_requirement', $data);
        };

        if (isset($_POST['save_req_document_tqd'])) {              
                $this->session->set_flashdata('msg', 'Save document by TQD successfull.');
                redirect(site_url('quality_control/index'));
            }               
        
        if (isset($_POST['save_validation_document'])) {              
            $personnel_number        = $this->input->post('personnel_number');
            $request_number          = $this->input->post('request_number');
            $sess_personnel_number   = $this->session->userdata('users_quality')->PERNR;                                                            
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'devlicensetq@gmail.com',
            'smtp_pass' => 'Bismillah1995', 
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE);
            $email               = 'mail.gmf-aeroasia.co.id';
            $sess_data_personnel = $this->model_quality_control->get_data_row_personnel_by($personnel_number);
            @$personnel_number = $sess_data_personnel['PERNR'];
            @$name_personnel = $sess_data_personnel['EMPLNAME'];
            @$unit = $sess_data_personnel['UNIT'];
            @$presenttitle = $sess_data_personnel['JOBTITLE'];
            @$email_personnel = $sess_data_personnel['EMAIL'];
            @$personnel_number_superior = $sess_data_personnel['REPORT_TO'];
            $sess_data_personnel_superior = $this->model_quality_control->get_data_row_personnel_by($personnel_number_superior);
            @$email_superior = $sess_data_personnel_superior['EMAIL'];
            $sess_data_gm            = $this->model_quality_control->get_gm_personnel_by($personnel_number)->row_array();
            $email_gm                = $sess_data_gm['email'];
            $url               = $_SERVER['HTTP_REFERER'];
            $cek_data_document = $this->model_quality_control->cek_data_document($personnel_number);
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($email);
            $this->email->to($email_personnel);
            // $this->email->to($email_superior);
            // $this->email->to($email_gm);
            // $this->email->to('list-tqd@gmf-aeroasia.co.id');
            // Disapproved Quality
            $pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                 "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                 <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
                 </head></body>';
            $pesan .= '<p>Dear Mr/Mrs ' . $name_personnel . '</p>';
            $pesan .= '<p>1. <b>' . $name_personnel . '</b>/<b>' . $unit . '</b>/<b>' . $personnel_number . ' Jobtitle : (' . $presenttitle . ')</b></p>';
            $pesan .= '<p>'. @$cek_content_disapproved['title'] .'</p>';
            $pesan .= '<p>as detailed below : </p>';
            $pesan .= '<table border="1">
                 <tr>
                     <td> No </td>
                     <td> Document </td>
                     <td> Status </td>
                     <td> Reason </td>                                                                    
                     </tr>';
            $no = 1;
            foreach ($cek_data_document as $row) {
                $pesan .= '<tr>                        
                         <td> ' . $no++ . ' </td>
                         <td> ' . $row->name_file . ' </td>';
                $status = $row->status_valid;
                switch ($status) {
                    case 2:
                        $reason_apply_license = 'Not Validated';
                        break;
                }
                
                $pesan .= '                    
                         <td> ' . $reason_apply_license . ' </td>                                                                           
                         <td> ' . $row->reason . ' </td>                                                
                         </tr>';
            }
            
            $pesan .= '</table>';
            $pesan .= @$cek_content_disapproved['content'];
            $pesan .= @$cek_content_disapproved['footer'];          
            // Content approved quality            
            $pesan_approved = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                         "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                         <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/></head></body>';
            $pesan_approved .= '<p>Dear Mr/Mrs ' . $name_personnel . '</p>';
            $pesan_approved .= '<p>'. @$cek_content_approved['title'] .'<b>Request Number</b> : ' . $request_number . '</p>';
            $pesan_approved .= @$cek_content_approved['content'];
            $pesan_approved .= @$cek_content_approved['footer'];

            if(!empty($cek_data_document)){ 
                    $this->email->subject(@$cek_content_disapproved['subject']);
                    $this->email->message($pesan);
                    //die($pesan);
                    $this->email->send();  
                    $data = array(
                        'status_approved_quality' => '2',
                        'date_approved_quality' => date('Y-m-d H:i:s'),
                        'personnel_number_quality' => $sess_personnel_number,
                        'finished' => '1',
                        'date_finish' => date('Y-m-d H:i:s')
                    );
                    $this->db->where('request_number', $request_number);
                    $this->db->update('t_apply_license', $data);                                             
                    $this->session->set_flashdata('msg', 'Email validation berkas sudah terkirim ke applicant');
                    redirect(site_url('quality_control/index'));                    
                } else {
                    $this->email->subject(@$cek_content_approved['subject']);
                    $this->email->message($pesan_approved);
                    // die($pesan_approved);
                    $this->email->send(); 
                    $data = array(
                        'status_approved_quality' => '1',
                        'date_approved_quality' => date('Y-m-d H:i:s'),
                        'personnel_number_quality' => $sess_personnel_number,
                        'finished' => NULL,
                        'date_finish' => NULL
                    );
                    $this->db->where('request_number', $request_number);
                    $this->db->update('t_apply_license', $data);
                    $this->session->set_flashdata('msg', 'Document '.$request_number.' is Validated');
                    redirect(site_url('quality_control/index'));
                 }
             }        
}
    function upload_file_data_requirement() {
        $this->load->library('ftp');                            
        $this->load->library('upload');                                                         
        $mainfolder             = 'TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS';                
        $sess_personnel_number  = $this->session->userdata('users_quality')->PERNR;
        $personnel_number       = $this->input->post('personnel_number');
        $subfolder              = $this->input->post('personnel_number');                    
        $ftp_config['hostname'] = '127.0.0.1'; 
        $ftp_config['username'] = 'yayas';
        $ftp_config['password'] = 'Bismillah';
        $ftp_config['debug']    = TRUE;    
        $this->ftp->connect($ftp_config);     
        $code_data_requirement                          = $this->input->post('code_data_requirement');                    
        $date_training_data_requirement                 = $this->input->post('date_training_data_requirement');            
        $save_result_expiration_date_data_requirement   = $this->input->post('save_result_expiration_date_data_requirement');            
        $no_upload                                      = no_upload($personnel_number,$code_data_requirement);
        if(isset($_FILES['file_data_requirement']['name'])) {
            if ($_FILES['file_data_requirement']['size'] > 5120000) {  
                echo 'File too large, max 5mb.';
            } else {                
                $cd_folder_by       = $this->model_quality_control->get_code_file_by($code_data_requirement);                                      
                $this->ftp->changedir('/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name);                              
                $fileNameOld        = $_FILES['file_data_requirement']['name'];                                                    
                @$ext               = end(explode('.',$_FILES['file_data_requirement']['name']));                          
                if ($ext == 'pdf') {
                    $fileNameNew        = $personnel_number . '_' . $code_data_requirement . '_' . date('YmdH') . '.' . $ext;
                    $sourceFileName     = $_FILES['file_data_requirement']['tmp_name'];                  
                    $destination        = $fileNameOld;                                      
                    $destinationnew     = $fileNameNew;

                    if(!empty($date_training_data_requirement)) {
                        $date_training  = date('Y-m-d', strtotime($date_training_data_requirement));
                    } else {
                        $date_training  = null;
                    };

                    if (!empty($save_result_expiration_date_data_requirement)) {
                        $date_expiration = date('Y-m-d', strtotime($save_result_expiration_date_data_requirement));
                    } else {
                        $date_expiration = null;
                    };  

                    $file_exists = $this->ftp->list_files(str_replace('%20',' ','/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name . '/' . $destinationnew));
                    if(!$file_exists) {  
                        $send               = $this->ftp->upload($sourceFileName,$destination);                               
                        $rename             = $this->ftp->rename($destination,$destinationnew);
                        $data_general_certificate = array(
                            'personnel_number_fk'  => $personnel_number,                
                            'date_training'        => $date_training,
                            'expiration_date'      => $date_expiration,
                            'code_file'            => $code_data_requirement,                
                            'name_file'            => $fileNameNew,                            
                            'date_upload'          => date('Y-m-d'),
                            'time_upload'          => date('H:i:s'),
                            'no_upload'            => $no_upload,
                        );
                                               
                        $this->db->insert('t_file_requirement',$data_general_certificate);                                                                  
                        echo 'Save successfull.';                                                                     
                    } else {
                        echo 'File is exists.';                         
                    }
                } else {
                    echo 'File type not suport, please atach file pdf.';                
                }
            }    
        } else {
            echo 'Please choose file.';
        }
        $this->ftp->close();                               
    }

    function upload_file_data_requirement_tqd() {
        $this->load->library('ftp');                            
        $this->load->library('upload');                                                         
        $mainfolder             = 'TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS';                
        $sess_personnel_number  = $this->session->userdata('users_quality')->PERNR;
        $personnel_number       = $this->input->post('personnel_number');
        $subfolder              = $this->input->post('personnel_number');                    
        $ftp_config['hostname'] = '127.0.0.1'; 
        $ftp_config['username'] = 'yayas';
        $ftp_config['password'] = 'Bismillah';
        $ftp_config['debug']    = TRUE;        
        $this->ftp->connect($ftp_config);     
        $code_data_requirement                          = $this->input->post('code_data_requirement_tqd');                            
        $date_training_data_requirement                 = $this->input->post('date_training_data_requirement_tqd');            
        $save_result_expiration_date_data_requirement   = $this->input->post('save_result_expiration_date_data_requirement_tqd');            
        $no_upload                                      = no_upload($personnel_number,$code_data_requirement);
        if(isset($_FILES['file_data_requirement_tqd']['name'])) {
            if ($_FILES['file_data_requirement_tqd']['size'] > 5120000) {  
                echo 'File too large, max 5mb.';
            } else {                
                $cd_folder_by       = $this->model_quality_control->get_code_file_by($code_data_requirement);                                      
                $this->ftp->changedir('/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name);                              
                $fileNameOld        = $_FILES['file_data_requirement_tqd']['name'];                                                    
                @$ext               = end(explode('.',$_FILES['file_data_requirement_tqd']['name']));                          
                if ($ext == 'pdf') {
                    $fileNameNew        = $personnel_number . '_' . $code_data_requirement . '_' . date('YmdH') . '.' . $ext;
                    $sourceFileName     = $_FILES['file_data_requirement_tqd']['tmp_name'];                  
                    $destination        = $fileNameOld;                                      
                    $destinationnew     = $fileNameNew;

                    if(!empty($date_training_data_requirement)) {
                        $date_training  = date('Y-m-d', strtotime($date_training_data_requirement));
                    } else {
                        $date_training  = null;
                    };

                    if (!empty($save_result_expiration_date_data_requirement)) {
                        $date_expiration = date('Y-m-d', strtotime($save_result_expiration_date_data_requirement));
                    } else {
                        $date_expiration = null;
                    };  

                    $file_exists = $this->ftp->list_files(str_replace('%20',' ','/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name . '/' . $destinationnew));
                    if(!$file_exists) {  
                        $send               = $this->ftp->upload($sourceFileName,$destination);                               
                        $rename             = $this->ftp->rename($destination,$destinationnew);
                        $data_general_certificate = array(
                            'personnel_number_fk'  => $personnel_number,                
                            'date_training'        => $date_training,
                            'expiration_date'      => $date_expiration,
                            'code_file'            => $code_data_requirement,                
                            'name_file'            => $fileNameNew,                            
                            'date_upload'          => date('Y-m-d'),
                            'time_upload'          => date('H:i:s'),
                            'no_upload'            => $no_upload,
                        );
                                               
                        $this->db->insert('t_file_requirement',$data_general_certificate);                                                                  
                        echo 'Save successfull.';                                                                     
                    } else {
                        echo 'File is exists.';                         
                    }
                } else {
                    echo 'File type not suport, please atach file pdf.';                
                }
            }    
        } else {
            echo 'Please choose file.';
        }
        $this->ftp->close();                               
    }


    
     public function process_document()
    {
        $request_number   = $this->input->post('request_number');
        $personnel_number = $this->input->post('personnel_number');
        $code_file        = $this->input->post('code_file');
        $reason           = $this->input->post('reason');
        
        if (isset($_POST['valid'])) {
            if ($reason == '') {
                $data = array(
                    'status_valid' => '1',
                    'reason' => ''
                );
            };
            
            $this->db->where('personnel_number_fk', $personnel_number);
            $this->db->where('code_file', $code_file);
            $this->db->update('t_file_requirement', $data);
        }
            
        if (isset($_POST['not_valid'])) {
            if ($reason != '') {
                $data = array(
                    'status_valid' => '2',
                    'reason' => $reason
                );
            };
        
            $this->db->where('personnel_number_fk', $personnel_number);
            $this->db->where('code_file', $code_file);
            $this->db->update('t_file_requirement', $data);
        }
        
        $data['data_file_requirement']              = $this->model_quality_control->get_data_requirement($request_number, $personnel_number);
        $data['data_file_general_document_quality'] = $this->model_quality_control->get_general_document_quality($request_number);
        $data['data_file_spec_document_quality']    = $this->model_quality_control->get_spec_document_quality($request_number, $personnel_number);
        $this->page->view('quality_control/form_data_requirement', $data);
    }
    
    
    
    public function update($id)
    {
        $data = array(
            'name_cat' => $this->input->post('name_cat'),
            'change_date' => date('Y-m-d'),
            'change_time' => date('H:i:s'),
            'id_users_fk' => $this->session->userdata('users_quality')->id_users
        );
        $this->db->where('id_category_inf', $id);
        $this->db->update('category_information', $data);
        
        redirect($this->page->base_url());
    }
    
    function get_tab_search_high($param)
    {
        $data['p_search_high'] = $param;
        $this->load->view('quality_control/tab_search/search_high', $data);
        return true;
    }
    
    function get_tab_option_sub_status($param, $request_number)
    {
        $data['p_sub_status'] = $param;
        $data['validaty_status'] = $this->model_quality_control->get_validation_status($request_number)->row();
        $this->load->view('quality_control/tab_search/option_sub_status', $data);
        return true;
    }
    
    function get_type_assesment($p_type_assesment, $request_number, $personnel_number)
    {
        $data['p_type_assesment']               = $p_type_assesment;
        $data['get_data_apply_personnel_by']    = $this->model_quality_control->get_emp_assesment($request_number);
        $data['get_data_emp_personnel_by']      = $this->model_quality_control->get_emp_for_assesment($personnel_number);
        $data['data_assesment']                 = $this->model_quality_control->get_data_assesment($personnel_number, $request_number);
        $data['data_assesment_oral']            = $this->model_quality_control->get_data_assesment_oral($personnel_number, $request_number);
        $data['data_assesment_practical']       = $this->model_quality_control->get_data_assesment_practical($personnel_number, $request_number);
        $this->load->view('quality_control/tab_search/body_type_assesment', $data);
        return true;
    }
    
    public function option_employee_tqd()
    {
        $m_employee = $this->db->query("SELECT personnel_number, name FROM UNION_EMP WHERE departement LIKE 'TQD%'");
        return options($m_employee, 'personnel_number', 'name');
    }
    public function option_unit_gmf()
    {
        $m_unit = $this->db->query("SELECT DISTINCT UNIT FROM db_hrm.dbo.TBL_SOE_HEAD");
        return options($m_unit, 'UNIT', 'UNIT');
    }
    
    public function cek_room($date_written_assesment, $id_sesi, $id_room){
        $this->model_quality_control->get_room_by($date_written_assesment,$id_sesi,$id_room);
        return true;
    }
    
    public function cek_room_oral($date_oral_assesment, $id_sesi, $id_room){
        $this->model_quality_control->get_room_oral_by($date_oral_assesment,$id_sesi,$id_room);
    }

    public function get_all_room(){
        $m_room = $this->db->query("SELECT id_room, name_room FROM m_room");
        return options($m_room, 'id_room', 'name_room');
    }

    public function option_authorization()
    {
        $m_auth = $this->db->query("SELECT * FROM m_auth_license");
        return options($m_auth, 'id', 'name_t');
    }

    public function option_type()
    {
        $m_type = $this->db->query("SELECT * FROM m_auth_type");
        return options($m_type, 'id', 'name_t');
    }

    function cek_authorization($id_auth)
    {
        $data['type_auth'] = $this->model_quality_control->get_type($id_auth);
        $this->load->view('quality_control/tab_search/view_tab_type', $data);
        return true;
    }
}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */