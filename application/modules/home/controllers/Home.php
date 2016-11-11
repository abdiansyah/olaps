<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('m_home');
    }

    public function index()
    {
        $user_data                          = $this->session->userdata('users_applicant'); 
        $personnel_number                   = $user_data->PERNR;       
        $unit                               = $user_data->UNIT;  
        $presenttitle                       = SUBSTR($user_data->JOBTITLE,0,2); 
        $date_request                       = $this->input->post('date_request');
        @$id_users_group                    = $user_data->id_users_group;                    
        $data['personnel_number']           = $this->input->post($personnel_number);      
        $data['request_number_user']        = $this->input->post('request_number_user');
        $data['date_request']               = $this->input->post('date_request');
        $data['employee_personnel_number']  = $this->input->post('employee_personnel_number');
        $data['name_personnel']             = $this->input->post('name_personnel');
        $data['status']                     = $this->input->post('status');
        $data['unit']                       = $this->input->post($unit);
        $data['presenttitle']               = $this->input->post($presenttitle);
        $this->page->view('home/home_index',$data);
    }
    
    public function get_ajax_home(){
        $user_data = $this->session->userdata('users_applicant');
        $sess_personnel_number  = $user_data->PERNR;                                                                          
        $sess_employee_group = $user_data->id_employee_group;
        $cek_superior = $this->m_home->cek_superior($sess_personnel_number);

        $list = $this->m_home->get_value_home();                
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;
            if(@$cek_superior == '1'){            
                $row[] = @$rc->name;
                $row[] = @$rc->personnel_number;
            };            
            $row[] = '<a href="'.site_url('/apply_license/apply_license/history_request_number/'.$rc->request_number).'/'.$rc->personnel_number.'" title="Edit Data">'.@$rc->request_number.'</a>';
            $row[] = @$rc->last_update;
            if(@$rc->current_status == 'Success'){                        
                $row[] = '<a href="'.site_url('/apply_license/apply_license/history_request_number/'.$rc->request_number).'/'.$rc->personnel_number.'" class="btn btn-success btn-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.@$rc->current_status.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
            }else{
                $row[] = '<a href="'.site_url('/apply_license/apply_license/history_request_number/'.$rc->request_number).'/'.$rc->personnel_number.'" class="btn btn-warning btn-sm">&nbsp;&nbsp;&nbsp;<b>'.@$rc->current_status.'</b>&nbsp;&nbsp;&nbsp;</a>';
            }
            if(@$cek_superior == '1'){
                if(@$rc->current_status == 'Data Submited'){             
                    $row[] = '<a href="'.site_url('/apply_license/apply_license/cek_approved_atasan/'.$rc->request_number).'/'.$rc->personnel_number.'" class="btn btn-warning btn-sm">&nbsp;&nbsp;&nbsp;<b>Superior Approval</b>&nbsp;&nbsp;&nbsp;</a>';
                }else{
                    $row[] = '';
                }
            }   
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->m_home->count_all(),
            "recordsFiltered"   => $this->m_home->count_filtered(),
            "data"              => $data,
        );
        
        //output to json format
        echo json_encode($output);
            
    }        
    
    

}
?>