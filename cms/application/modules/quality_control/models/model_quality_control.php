<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_quality_control extends CI_Model
{

    private $table = 't_apply_license';        
    private $column_order = array('request_number','name','personnel_number');                
    private $order = array('t_apply_license.request_number' => 'desc');    
    private $order_list_assesment = array('TSH.name' => 'asc');
    private function _get_query()
    {
        $subQuery_name_disposition = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.id_disposition_user_fk')->
            get_compiled_select();

        $subQuery_name_location = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.id_location_user_fk')->
            get_compiled_select(); 
                   
        $this->db->select("(CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),105)) AS date_request, t_apply_license.request_number, TSH.name, TSH.personnel_number, 
                        (" . $subQuery_name_disposition . ") AS name_disposition, (" . $subQuery_name_location . ") AS name_location,
                        (CASE WHEN t_apply_license.finished = '1' AND t_apply_license.status_approved_quality = '1' THEN 'Success'
                            WHEN t_apply_license.finished = '1' AND t_apply_license.status_approved_quality = '2' THEN 'Failed'
                        WHEN t_apply_license.take_authorization = '1' THEN 'Take Authorization'
                        WHEN t_apply_license.referral_authorization = '1' THEN 'Referral Authorization'                        
                        WHEN t_apply_license.status_issue_authorization = '2' THEN 'Issue Authorization Finished'
                        WHEN t_apply_license.status_issue_authorization = '1' THEN 'Issue Authorization Process'
                        WHEN t_apply_license.status_assesment = '2' THEN 'Assesment Process Closed' 
                        WHEN t_apply_license.status_assesment = '1' THEN 'Assesment Process' 
                        WHEN t_apply_license.status_approved_quality = '1' THEN 'Data Validated' 
                        WHEN t_apply_license.status_approved_quality = '2' THEN 'Data Rejected'
                        WHEN t_apply_license.status_approved_superior = '2' THEN 'Rejected Superior'
                        WHEN t_apply_license.status_approved_superior = '1' THEN 'Approved Superior' 
                        WHEN t_apply_license.status_submit = '1' THEN 'Data Submited'
                        END) as current_status,
                        (CASE WHEN t_apply_license.status_approved_superior IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),105))                                                 
                        WHEN t_apply_license.status_approved_quality IS NULL then                         
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_superior,120),105))                             
                        WHEN t_apply_license.status_assesment IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_quality,120),105))                 
                        WHEN t_apply_license.date_status_assesment IS NULL then
                        (SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, TA.date_assesment,120),105)) FROM t_assesment AS TA WHERE (TA.request_number_fk=t_apply_license.request_number))
                        WHEN t_apply_license.status_issue_authorization IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),105))
                        WHEN t_apply_license.take_authorization IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),105))
                        WHEN t_apply_license.finished IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),105))
                        WHEN t_apply_license.finished IS NOT NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),105))
                        END) as last_update,
                        (CASE WHEN t_apply_license.status_approved_superior IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),108))                                                 
                        WHEN t_apply_license.status_approved_quality IS NULL then                         
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_superior,120),108))                             
                        WHEN t_apply_license.status_assesment IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_quality,120),108))                 
                        WHEN t_apply_license.status_issue_authorization IS NULL then
                        (SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, TA.date_assesment,120),108)) FROM t_assesment AS TA WHERE (TA.request_number_fk = t_apply_license.request_number))
                        WHEN t_apply_license.status_issue_authorization IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),108))
                        WHEN t_apply_license.take_authorization IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),108))
                        WHEN t_apply_license.finished IS NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),108))
                        WHEN t_apply_license.finished IS NOT NULL then
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),108))
                        END) as time,
                        t_apply_license.priority,
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.datetime_priority,120),105)) as date_priority,
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.datetime_priority,120),108)) as time_priority,
                        (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),105)) as date_finish,
                        remark");        
        $this->db->from($this->table);
        $this->db->join('UNION_EMP AS TSH','t_apply_license.personnel_number = TSH.personnel_number', 'left');
                 

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else
            if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
    }
    

    public function get_quality_control_high()
    {        
        $personnel_number 	         = $this->input->post('personnel_number');
        $request_number 	         = $this->input->post('request_number');
        $code_unit 	                 = $this->input->post('code_unit');
        $reason_apply_license 	     = $this->input->post('reason_apply_license');
        $priority 	                 = $this->input->post('priority');
        $datetime_priority 	         = $this->input->post('datetime_priority');
        $personnel_number_superior 	 = $this->input->post('personnel_number_superior');
        $personnel_number_quality 	 = $this->input->post('personnel_number_quality');
        $id_disposition_user_fk 	 = $this->input->post('id_disposition_user_fk');
        $id_location_user_fk 	     = $this->input->post('id_location_user_fk');
        $date_request 	             = $this->input->post('date_request');
        $date_approved_superior 	 = $this->input->post('date_approved_superior');
        $date_approved_quality 	     = $this->input->post('date_approved_quality');
        $date_referral_authorization = $this->input->post('date_referral_authorization');
        $date_take_authorization 	 = $this->input->post('date_take_authorization');
        $status_submit    	         = $this->input->post('status_submit');                
        $status_approved_superior 	 = $this->input->post('status_approved_superior');
        $status_approved_quality 	 = $this->input->post('status_approved_quality');
        $status_assesment 	         = $this->input->post('status_assesment');
        $referral_authorization 	 = $this->input->post('referral_authorization');
        $take_authorization 	     = $this->input->post('take_authorization');    
        $this->_get_query();
        if(!empty($personnel_number)){
           $this->db->where('personnel_number', $personnel_number);    
        }
                
        if(!empty($request_number)){
           $this->db->where('t_apply_license.request_number', $request_number);    
        }
        
        if(!empty($code_unit)){
           $this->db->where('t_apply_license.code_unit', $code_unit);    
        }
         
        if(!empty($reason_apply_license)){
           $this->db->where('t_apply_license.reason_apply_license', $reason_apply_license);    
        }
                
        if(!empty($priority)){
           $this->db->where('t_apply_license.priority', $priority);    
        }
        
        if(!empty($datetime_priority)){
           $this->db->LIKE('t_apply_license.datetime_priority', date('Y-m-d',strtotime($datetime_priority)));    
        }
        
        if(!empty($personnel_number_superior)){
           $this->db->where('t_apply_license.personnel_number_superior', $personnel_number_superior);    
        }
        
        
        if(!empty($personnel_number_quality)){
           $this->db->where('t_apply_license.personnel_number_quality', $personnel_number_quality);    
        }        
        
        if(!empty($id_disposition_user_fk)){
           $this->db->where('t_apply_license.id_disposition_user_fk', $id_disposition_user_fk);    
        }
        
        if(!empty($id_location_user_fk)){
           $this->db->where('t_apply_license.id_location_user_fk', $id_location_user_fk);    
        }
        
        if(!empty($date_request)){
           $this->db->LIKE('t_apply_license.date_request', date('Y-m-d',strtotime($date_request)));    
        }
        
        if(!empty($date_approved_superior)){
           $this->db->LIKE('t_apply_license.date_approved_superior', $date_approved_superior);    
        }
                
        if(!empty($date_approved_quality)){
           $this->db->LIKE('t_apply_license.date_approved_quality', $date_approved_quality);    
        }
        
        if(!empty($date_referral_authorization)){
           $this->db->LIKE('t_apply_license.date_refferal_authorization', $date_referral_authorization);    
        }
        
        if(!empty($date_take_authorization)){
           $this->db->LIKE('t_apply_license.date_take_authorization', $date_take_authorization);    
        }
        
        if(!empty($status_submit)){
            $this->db->where('t_apply_license.status_approved_quality', null);
            $this->db->where('t_apply_license.status_approved_superior', null);           
            $this->db->where('t_apply_license.status_submit', $status_submit);
        }
                        
        if(!empty($status_approved_superior)){
           $this->db->where('t_apply_license.status_approved_superior', $status_approved_superior);    
        }
                
        if(!empty($status_approved_quality)){
           $this->db->where('t_apply_license.status_approved_quality', $status_approved_quality);    
        }
        
        if(!empty($status_assesment)){
           $this->db->where('t_apply_license.status_assesment', $status_assesment);    
        }
        
        if(!empty($referral_authorization)){
           $this->db->where('t_apply_license.referral_authorization', $referral_authorization);    
        }
        
        if(!empty($take_authorization)){
           $this->db->where('t_apply_license.take_authorization', $take_authorization);    
        }
        $this->db->where('t_apply_license.finished', null);                                                                              
        $this->db->where('t_apply_license.priority', 'High');        
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query_normal = $this->db->get();

        return $query_normal->result();        
    }
    
        public function get_quality_control_normal()
        {        
        $personnel_number 	         = $this->input->post('personnel_number');
        $request_number 	         = $this->input->post('request_number');
        $code_unit 	                 = $this->input->post('code_unit');
        $reason_apply_license 	     = $this->input->post('reason_apply_license');
        $priority 	                 = $this->input->post('priority');
        $datetime_priority 	         = $this->input->post('datetime_priority');
        $personnel_number_superior 	 = $this->input->post('personnel_number_superior');
        $personnel_number_quality 	 = $this->input->post('personnel_number_quality');
        $id_disposition_user_fk 	 = $this->input->post('id_disposition_user_fk');
        $id_location_user_fk 	     = $this->input->post('id_location_user_fk');
        $date_request 	             = $this->input->post('date_request');
        $date_approved_superior 	 = $this->input->post('date_approved_superior');
        $date_approved_quality 	     = $this->input->post('date_approved_quality');
        $date_referral_authorization = $this->input->post('date_referral_authorization');
        $date_take_authorization 	 = $this->input->post('date_take_authorization');
        $status_submit    	         = $this->input->post('status_submit');        
        $status_approved_superior 	 = $this->input->post('status_approved_superior');
        $status_approved_quality 	 = $this->input->post('status_approved_quality');
        $status_assesment 	         = $this->input->post('status_assesment');
        $referral_authorization 	 = $this->input->post('referral_authorization');
        $take_authorization 	     = $this->input->post('take_authorization');    
        $this->_get_query();
        if(!empty($personnel_number)){
           $this->db->where('personnel_number', $personnel_number);    
        }
                
        if(!empty($request_number)){
           $this->db->where('t_apply_license.request_number', $request_number);    
        }
        
        if(!empty($code_unit)){
           $this->db->where('t_apply_license.code_unit', $code_unit);    
        }
         
        if(!empty($reason_apply_license)){
           $this->db->where('t_apply_license.reason_apply_license', $reason_apply_license);    
        }
                
        if(!empty($priority)){
           $this->db->where('t_apply_license.priority', $priority);    
        }
        
        if(!empty($datetime_priority)){
           $this->db->LIKE('t_apply_license.datetime_priority', date('Y-m-d',strtotime($datetime_priority)));    
        }
        
        if(!empty($personnel_number_superior)){
           $this->db->where('t_apply_license.personnel_number_superior', $personnel_number_superior);    
        }
        
        
        if(!empty($personnel_number_quality)){
           $this->db->where('t_apply_license.personnel_number_quality', $personnel_number_quality);    
        }        
        
        if(!empty($id_disposition_user_fk)){
           $this->db->where('t_apply_license.id_disposition_user_fk', $id_disposition_user_fk);    
        }
        
        if(!empty($id_location_user_fk)){
           $this->db->where('t_apply_license.id_location_user_fk', $id_location_user_fk);    
        }
        
        if(!empty($date_request)){
           $this->db->LIKE('t_apply_license.date_request', date('Y-m-d',strtotime($date_request)));   
        }
        
        if(!empty($date_approved_superior)){
           $this->db->LIKE('t_apply_license.date_approved_superior', $date_approved_superior);    
        }
                
        if(!empty($date_approved_quality)){
           $this->db->LIKE('t_apply_license.date_approved_quality', $date_approved_quality);    
        }
        
        if(!empty($date_referral_authorization)){
           $this->db->LIKE('t_apply_license.date_refferal_authorization', $date_referral_authorization);    
        }
        
        if(!empty($date_take_authorization)){
           $this->db->LIKE('t_apply_license.date_take_authorization', $date_take_authorization);    
        }
        
        if(!empty($status_submit)){
            $this->db->where('t_apply_license.status_approved_quality', null);
            $this->db->where('t_apply_license.status_approved_superior', null);
            $this->db->where('t_apply_license.status_submit', $status_submit);                      
        }        
        
        if(!empty($status_approved_superior)){
           $this->db->where('t_apply_license.status_approved_superior', $status_approved_superior);    
        }
                
        if(!empty($status_approved_quality)){
           $this->db->where('t_apply_license.status_approved_quality', $status_approved_quality);    
        }
        
        if(!empty($status_assesment)){
           $this->db->where('t_apply_license.status_assesment', $status_assesment);    
        }
        
        if(!empty($referral_authorization)){
           $this->db->where('t_apply_license.referral_authorization', $referral_authorization);    
        }
        
        if(!empty($take_authorization)){
           $this->db->where('t_apply_license.take_authorization', $take_authorization);    
        }
        
        $this->db->where('t_apply_license.finished', null);                                                         
        $this->db->where('t_apply_license.priority', 'Normal');        
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query_normal = $this->db->get();

        return $query_normal->result();        
    }
    

   public function get_quality_control_finish()
    {        
    
        $personnel_number           = $this->input->post('personnel_number');
        $request_number              = $this->input->post('request_number');
        $code_unit                   = $this->input->post('code_unit');
        $reason_apply_license        = $this->input->post('reason_apply_license');
        $priority                    = $this->input->post('priority');
        $datetime_priority           = $this->input->post('datetime_priority');
        $personnel_number_superior   = $this->input->post('personnel_number_superior');
        $personnel_number_quality    = $this->input->post('personnel_number_quality');
        $id_disposition_user_fk      = $this->input->post('id_disposition_user_fk');
        $id_location_user_fk         = $this->input->post('id_location_user_fk');
        $date_request                = $this->input->post('date_request');
        $date_approved_superior      = $this->input->post('date_approved_superior');
        $date_approved_quality       = $this->input->post('date_approved_quality');
        $date_referral_authorization = $this->input->post('date_referral_authorization');
        $date_take_authorization     = $this->input->post('date_take_authorization');
        $status_submit               = $this->input->post('status_submit');        
        $status_approved_superior    = $this->input->post('status_approved_superior');
        $status_approved_quality     = $this->input->post('status_approved_quality');
        $status_assesment            = $this->input->post('status_assesment');
        $referral_authorization      = $this->input->post('referral_authorization');
        $take_authorization          = $this->input->post('take_authorization');    
        $this->_get_query();
        if(!empty($personnel_number)){
           $this->db->where('personnel_number', $personnel_number);    
        }
                
        if(!empty($request_number)){
           $this->db->where('t_apply_license.request_number', $request_number);    
        }
        
        if(!empty($code_unit)){
           $this->db->where('t_apply_license.code_unit', $code_unit);    
        }
         
        if(!empty($reason_apply_license)){
           $this->db->where('t_apply_license.reason_apply_license', $reason_apply_license);    
        }
                
        if(!empty($priority)){
           $this->db->where('t_apply_license.priority', $priority);    
        }
        
        if(!empty($datetime_priority)){
           $this->db->LIKE('t_apply_license.datetime_priority', date('Y-m-d',strtotime($datetime_priority)));    
        }
        
        if(!empty($personnel_number_superior)){
           $this->db->where('t_apply_license.personnel_number_superior', $personnel_number_superior);    
        }
        
        
        if(!empty($personnel_number_quality)){
           $this->db->where('t_apply_license.personnel_number_quality', $personnel_number_quality);    
        }        
        
        if(!empty($id_disposition_user_fk)){
           $this->db->where('t_apply_license.id_disposition_user_fk', $id_disposition_user_fk);    
        }
        
        if(!empty($id_location_user_fk)){
           $this->db->where('t_apply_license.id_location_user_fk', $id_location_user_fk);    
        }
        
        if(!empty($date_request)){
           $this->db->LIKE('t_apply_license.date_request', date('Y-m-d',strtotime($date_request)));   
        }
        
        if(!empty($date_approved_superior)){
           $this->db->LIKE('t_apply_license.date_approved_superior', $date_approved_superior);    
        }
                
        if(!empty($date_approved_quality)){
           $this->db->LIKE('t_apply_license.date_approved_quality', $date_approved_quality);    
        }
        
        if(!empty($date_referral_authorization)){
           $this->db->LIKE('t_apply_license.date_refferal_authorization', $date_referral_authorization);    
        }
        
        if(!empty($date_take_authorization)){
           $this->db->LIKE('t_apply_license.date_take_authorization', $date_take_authorization);    
        }
        
        if(!empty($status_submit)){
            $this->db->where('t_apply_license.status_approved_quality', null);
            $this->db->where('t_apply_license.status_approved_superior', null);
            $this->db->where('t_apply_license.status_submit', $status_submit);                      
        }        
        
        if(!empty($status_approved_superior)){
           $this->db->where('t_apply_license.status_approved_superior', $status_approved_superior);    
        }
                
        if(!empty($status_approved_quality)){
           $this->db->where('t_apply_license.status_approved_quality', $status_approved_quality);    
        }
        
        if(!empty($status_assesment)){
           $this->db->where('t_apply_license.status_assesment', $status_assesment);    
        }
        
        if(!empty($referral_authorization)){
           $this->db->where('t_apply_license.referral_authorization', $referral_authorization);    
        }
        
        if(!empty($take_authorization)){
           $this->db->where('t_apply_license.take_authorization', $take_authorization);    
        }

        $this->db->where('t_apply_license.finished', '1');        
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query_finish = $this->db->get();

        return $query_finish->result();        
    }
    

   
    public function count_filtered_high()
    {
        $this->_get_query();
        $this->db->where('t_apply_license.priority', 'High');
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_filtered()
    {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_filtered_finish()
    {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    
    public function count_all_high()
    {
        $this->db->from($this->table);
        $this->db->where('t_apply_license.priority', 'High');
        return $this->db->count_all_results();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function count_all_finish()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    public function by_id_menu_management($id)
    {        
        $datasrc = $this->db->get_where('menu', array('id_menu' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }

    public function by_request_number($id)
    {
        $subQuery_name_disposition = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.id_disposition_user_fk')->
            get_compiled_select();

        $subQuery_name_location = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.id_location_user_fk')->
            get_compiled_select();

        $subQuery_name_quality = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.personnel_number_quality')->
            get_compiled_select();

        $subQuery_name_assesment = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.personnel_number_assesment')->
            get_compiled_select();

        $subQuery_name_issue_authorization = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.personnel_number_issue_authorization')->
            get_compiled_select();

        $subQuery_name_ref_auth = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.personnel_number_ref_auth')->
            get_compiled_select();

        $subQuery_name_take_auth = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.personnel_number_take_auth')->
            get_compiled_select();

        $subQuery_name_finish = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->
            where('TSH.personnel_number = t_apply_license.personnel_number_finish')->
            get_compiled_select();
            
        if(!empty($id)) {
            $where = "CONVERT(VARCHAR(20),t_apply_license.request_number) = '$id'";
        };
        
        $datasrc = $this->db->query("SELECT TOP 1  TSH.name, TSH.personnel_number, TSH.departement, TSH.presenttitle, TSH.mobilephone, TSH.businessphone, t_apply_license.request_number,
                    t_apply_license.id_disposition_user_fk, t_apply_license.id_location_user_fk, t_apply_license.priority,t_apply_license.datetime_priority, t_apply_license.status_assesment AS check_assesment,
                    (" . $subQuery_name_disposition . ") AS name_disposition, (" . $subQuery_name_location . ") AS name_location,
                    (" . $subQuery_name_quality . ") AS name_quality,
                    (" . $subQuery_name_assesment . ") AS name_assesment, (" . $subQuery_name_issue_authorization . ") AS name_issue_authorization,     
                    (" . $subQuery_name_ref_auth . ") AS name_ref_auth, (" . $subQuery_name_take_auth . ") AS name_take_auth,     
                    (" . $subQuery_name_finish . ") AS name_finish,
                    t_apply_license.remark,
                    (CASE WHEN t_apply_license.finished = '1' THEN 'Success'
                    WHEN t_apply_license.take_authorization = '1' THEN 'Take Authorization'
                    WHEN t_apply_license.referral_authorization = '1' THEN 'Referral Authorization'                        
                    WHEN t_apply_license.status_issue_authorization = '2' THEN 'Issue Authorization Finished'
                    WHEN t_apply_license.status_issue_authorization = '1' THEN 'Issue Authorization Process'
                    WHEN t_apply_license.status_assesment = '2' THEN 'Assesment Process Closed' 
                    WHEN t_apply_license.status_assesment = '1' THEN 'Assesment Process' 
                    WHEN t_apply_license.status_approved_quality = '1' THEN 'Data Validated' 
                    WHEN t_apply_license.status_approved_quality = '2' THEN 'Data Rejected'
                    WHEN t_apply_license.status_approved_superior = '2' THEN 'Rejected Superior'
                    WHEN t_apply_license.status_approved_superior = '1' THEN 'Approved Superior' 
                    WHEN t_apply_license.status_submit = '1' THEN 'Data Submited'
                    END) as current_status,
                    (CASE WHEN t_apply_license.status_approved_superior IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),105))                                                 
                    WHEN t_apply_license.status_approved_quality IS NULL then                         
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_superior,120),105))                             
                    WHEN t_apply_license.status_assesment IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_quality,120),105))                 
                    WHEN t_apply_license.date_status_assesment IS NULL then
                    (SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, TA.date_assesment,120),105)) FROM t_assesment AS TA WHERE (TA.request_number_fk=t_apply_license.request_number))
                    WHEN t_apply_license.status_issue_authorization IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),105))
                    WHEN t_apply_license.take_authorization IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),105))
                    WHEN t_apply_license.finished IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),105))
                    WHEN t_apply_license.finished IS NOT NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),105))
                    END) as last_update,
                    (CASE WHEN t_apply_license.status_approved_superior IS NULL then 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),108))                               
                    WHEN t_apply_license.status_approved_quality IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_superior,120),108))                               
                    WHEN t_apply_license.status_assesment IS NULL then 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_quality,120),108))
                    WHEN t_apply_license.status_issue_authorization IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),108))       WHEN t_apply_license.referral_authorization IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),108))
                    WHEN t_apply_license.take_authorization IS NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_referral_authorization,120),108))
                    WHEN t_apply_license.take_authorization IS NOT NULL then
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),108)) END) as time,
                    (CASE t_apply_license.status_submit WHEN '1' THEN 'Data Submited' END) AS submited, 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),105)) AS date_submited,
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),108)) AS time_submited, 
                    (CASE t_apply_license.status_approved_superior WHEN '1' THEN 'Approved Superior' WHEN '2' THEN 'Rejected Superior' END) AS approved_superior,
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_superior,120),105)) AS date_approved_superior, 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_superior,120),108)) AS time_approved_superior, 
                    (CASE t_apply_license.status_approved_quality WHEN '1' THEN 'Data Validated' WHEN '2' THEN 'Data Not Valid' END) AS approved_quality, 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_quality,120),105)) AS date_approved_quality, 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_quality,120),108)) AS time_approved_quality,
                    (CASE t_apply_license.status_assesment WHEN '1' THEN 'Assesment Process' WHEN '2' THEN 'Assesment Process Closed' END) AS status_assesment,
                    (SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, TA.date_assesment,120),105)) FROM t_assesment AS TA 
                    WHERE (TA.request_number_fk='$id' OR TA.request_number_fk = '$id')) AS date_assesment,
                    (SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, TA.date_assesment,120),108)) FROM t_assesment AS TA WHERE (TA.request_number_fk='$id' OR TA.request_number_fk = '$id')) AS time_assesment,
                    (CASE (SELECT TOP 1 TA.status_assesment FROM t_assesment AS TA WHERE (TA.request_number_fk='$id' OR TA.request_number_fk = '$id')) WHEN '1' THEN 'Lulus' WHEN '2' THEN 'Tidak Lulus' END) AS verification_assesment,
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),105)) AS date_verification_assesment,
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),108)) AS time_verification_assesment,  

                    
                    (SELECT 'GMF Authorization Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '1' AND TIA.request_number_fk = '$id') AS desc_gmf_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '1' AND TIA.request_number_fk = '$id') AS date_gmf_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '1' AND TIA.request_number_fk = '$id') AS time_gmf_issue_authorization,
                    (SELECT 'C of C and/or Stamp Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '2' AND TIA.request_number_fk = '$id') AS desc_coc_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '2' AND TIA.request_number_fk = '$id') AS date_coc_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '2' AND TIA.request_number_fk = '$id') AS time_coc_issue_authorization,
                    (SELECT 'EASA Authorization Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '3' AND TIA.request_number_fk = '$id') AS desc_easa_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '3' AND TIA.request_number_fk = '$id') AS date_easa_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '3' AND TIA.request_number_fk = '$id') AS time_easa_issue_authorization,
                    (SELECT 'GA Authorization Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '4' AND TIA.request_number_fk = '$id') AS desc_ga_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '4' AND TIA.request_number_fk = '$id') AS date_ga_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '4' AND TIA.request_number_fk = '$id') AS time_ga_issue_authorization,
                    (SELECT 'Citilink Authorization Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '5' AND TIA.request_number_fk = '$id') AS desc_clink_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA  WHERE TIA.id_issue_fk = '5' AND TIA.request_number_fk = '$id') AS date_clink_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '5' AND TIA.request_number_fk = '$id') AS time_clink_issue_authorization,
                    (SELECT 'Sriwijaya Authorization Issued' FROM t_issue_authorization AS TIA  WHERE TIA.id_issue_fk = '6' AND TIA.request_number_fk = '$id') AS desc_srwj_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '6' AND TIA.request_number_fk = '$id') AS date_srwj_issue_authorization,
                    (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '6' AND TIA.request_number_fk = '$id') AS time_srwj_issue_authorization,
                                        
                    (CASE t_apply_license.status_issue_authorization WHEN '2' THEN 'Issue Authorization Finished' END) AS status_issue_authorization,
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),105)) AS date_stts_issue_authorization, 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),108)) AS time_stts_issue_authorization,
                    
                    (CASE t_apply_license.referral_authorization WHEN '1' THEN 'Referral Authorization' END) AS status_referral_authorization,
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_referral_authorization,120),105)) AS date_referral_authorization, 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_referral_authorization,120),108)) AS time_referral_authorization,
                                                            
                    (CASE t_apply_license.take_authorization WHEN '1' THEN 'Personnel Record Completed' END) AS status_take_authorization,
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),105)) AS date_take_authorization, 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),108)) AS time_take_authorization,
                    
                    (CASE t_apply_license.finished WHEN '1' THEN 'Success' END) AS status_finish,
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),105)) AS date_finish, 
                    (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),108)) AS time_finish                    
                    FROM t_apply_license 
                    LEFT JOIN (SELECT personnel_number, name,  presenttitle, departement, email, dateofbirth, dateofemployee, mobilephone, businessphone FROM m_employee                
                    UNION
                    SELECT (CONVERT(varchar(10),TSH.PERNR)) AS personnel_number, (TSH.EMPLNAME) AS name, (TSH.JOBTITLE) AS presenttitle, (TSH.UNIT) AS departement, (TSH.EMAIL) AS email, (TSH.BORNDATE) AS dateofbirth, (TSH.EMPLODATE) AS dateofemployee, (SELECT mobilephone FROM m_contact_employee AS mce WHERE mce.personnel_number_fk = (CONVERT(varchar(10),TSH.PERNR))) AS mobilephone, (SELECT businessphone FROM m_contact_employee AS mce WHERE mce.personnel_number_fk = (CONVERT(varchar(10),TSH.PERNR))) AS businessphone FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH) AS TSH 
                    ON t_apply_license.personnel_number = TSH.personnel_number                                     								                 
                    WHERE " . $where ." ORDER BY date_submited, date_approved_superior DESC");
        return $datasrc->num_rows() > 0 ? $datasrc->result() : $this;
    }
    
    public function get_data_row_personnel_by($personnel_number){    
        $querydatarowemp = "SELECT (personnel_number) AS PERNR , (name) AS EMPLNAME, (email) AS EMAIL, (presenttitle) AS JOBTITLE, (departement) AS UNIT, (formaleducation) AS LASTEDUCLEVEL,
                            (CONVERT(varchar(10), CONVERT(datetime, validitycontract,120),105)) AS WORKUNTILDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, dateofbirth,120),105)) AS BORNDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, dateofemployee,120),105)) AS EMPLODATE,
                            (report_to) AS REPORT_TO
                            FROM m_employee
                            WHERE personnel_number='$personnel_number'
                            UNION        
                            SELECT TSH.PERNR, TSH.EMPLNAME, TSH.EMAIL, TSH.JOBTITLE, TSH.UNIT, TSH.LASTEDUCLEVEL,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.WORKUNTILDATE,120),105)) AS WORKUNTILDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.BORNDATE,120),105)) AS BORNDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.EMPLODATE,120),105)) AS EMPLODATE,
                            TSH.REPORT_TO FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH
                            WHERE TSH.PERNR = '$personnel_number'";                                                                        
        return $this->db->query($querydatarowemp)->row_array();     
    }

    public function get_gm_personnel_by($personnel_number)
    {
        $query   = "SELECT email FROM UNION_EMP WHERE presenttitle LIKE 'GM%' AND departement = (SELECT SUBSTRING(departement,1,3) FROM UNION_EMP WHERE personnel_number = '$personnel_number')";
        return $this->db->query($query);
    }
    
    public function cek_summary($request_number){                          
    $cek_query_validate = "SELECT mal.name_t AS name_license, tal.reason_apply_license AS reason_apply_license, tal.personnel_number, tal.request_number AS request_number, mat.name_t AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope, tal.date_request FROM t_apply_license tal
                         LEFT JOIN t_apply_license_dtl AS tald ON tal.request_number = tald.request_number_fk
                         LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id  
                         LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id 
                         LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
                         LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
                         LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id                                                
                         WHERE tal.request_number = '$request_number'"; 
     return $this->db->query($cek_query_validate)->result();
    }
    
    public function get_data_requirement($personnel_number){
    $query = "SELECT (tfr.name_file) AS name_file_ftp, tfr.personnel_number_fk, tfr.code_file, (m_req.name_t) AS name_file, tfr.id_auth_license_fk, tfr.id_auth_type_fk, tfr.date_training, tfr.expiration_date, tfr.status_valid, tfr.reason FROM t_file_requirement AS tfr
            LEFT JOIN UNION_REQUIREMENT AS m_req ON tfr.code_file = m_req.code_t            
            WHERE tfr.personnel_number_fk = '$personnel_number' AND tfr.update_by = ''";
    return $this->db->query($query)->result();
    } 

    public function get_data_requirement_revision($personnel_number){
    $query = "SELECT (tfr.name_file) AS name_file_ftp, tfr.personnel_number_fk, tfr.code_file, (maarg.name_t) AS name_file, tfr.id_auth_license_fk, tfr.id_auth_type_fk, tfr.date_training, tfr.expiration_date, tfr.status_valid, tfr.reason FROM t_file_requirement AS tfr
            LEFT JOIN m_auth_additional_req_general AS maarg ON tfr.code_file = maarg.code_t            
            WHERE tfr.personnel_number_fk = '$personnel_number' AND tfr.update_by != ''";
    return $this->db->query($query)->result();
    } 
    
    public function cek_data_document($personnel_number){
    $query = "SELECT (tfr.name_file) AS name_file_ftp, tfr.code_file, (maadrg.name_t) AS name_file, tfr.id_auth_license_fk, tfr.id_auth_type_fk, tfr.date_training, tfr.expiration_date, tfr.status_valid, tfr.reason FROM t_file_requirement AS tfr
            LEFT JOIN UNION_REQUIREMENT AS maadrg ON tfr.code_file = maadrg.code_t
            WHERE tfr.personnel_number_fk = '$personnel_number' AND tfr.status_valid = '2'";
            // status_valid 2 (not_valid)
    return $this->db->query($query)->result();    
    }
    
    public function get_emp_assesment($request_number){
        $query = "SELECT tal.request_number from t_apply_license AS tal
                WHERE tal.request_number='$request_number'";
        return $this->db->query($query)->row_array();
    }
    
    public function get_emp_for_assesment($personnel_number){
        $querydataapplyemp = "SELECT (TSH.PERNR) AS personnel_number, (TSH.EMPLNAME) AS name , (TSH.EMAIL) AS email, (TSH.JOBTITLE) AS presenttitle, (TSH.UNIT) AS departement  FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH
                            WHERE TSH.PERNR = '$personnel_number'
                            UNION 
                            SELECT personnel_number, name, email, presenttitle,departement
                            FROM m_employee WHERE personnel_number = '$personnel_number'"; 
        return $this->db->query($querydataapplyemp)->row_array();
    }
    
    public function get_data_assesment($personnel_number,$request_number)
    {
        $query = "SELECT tal.reason_apply_license, masc.id, masc.name_t, tal.date_request, tald.status_oral_assesment,(mal.name_t) AS name_license, (mat.name_t) AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope,
                (mal.id) AS id_license, (mat.id) AS id_type, (masp.id) AS id_spect, (mas.id) AS id_scope, (mac.id) AS id_category, tald.is_etops
                FROM t_apply_license AS tal 
                LEFT JOIN t_apply_license_dtl tald ON tald.request_number_fk = tal.request_number
                LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id                                                 
                LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id                                                 
                LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
                LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
                LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id 
                LEFT JOIN m_assesment_scope AS masc ON tald.id_assesment_scope_fk = masc.id                                
                WHERE tald.request_number_fk = '$request_number' AND tal.personnel_number ='$personnel_number'  AND CONVERT(VARCHAR(10),tald.status_written_assesment) = '0'";                                 
        return $this->db->query($query)->result();
        
    }
    
    public function get_data_assesment_oral($personnel_number,$request_number)
    {
        $query = "SELECT tal.reason_apply_license, masc.id, masc.name_t, tal.date_request, tald.status_oral_assesment,(mal.name_t) AS name_license, (mat.name_t) AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope,
                (mal.id) AS id_license, (mat.id) AS id_type, (masp.id) AS id_spect, (mas.id) AS id_scope, (mac.id) AS id_category, tald.is_etops
                FROM t_apply_license AS tal 
                LEFT JOIN t_apply_license_dtl tald ON tald.request_number_fk = tal.request_number
                LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id
                LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id
                LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
                LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
                LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id 
                LEFT JOIN m_assesment_scope AS masc ON tald.id_assesment_scope_fk = masc.id                 
                WHERE tald.request_number_fk = '$request_number' AND tal.personnel_number ='$personnel_number' AND CONVERT(VARCHAR(10),tald.status_oral_assesment) = '0'";                                 
        return $this->db->query($query)->result();
        
    }

    public function get_data_assesment_oral_by($personnel_number,$request_number) {
        $query = "SELECT tal.reason_apply_license, TAS.date_oral_assesment, mr.name_room, (masses.name_t) AS name_sesi, tald.status_oral_assesment, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope,
        (mal.id) AS id_license, (mat.id) AS id_type, (masp.id) AS id_spect, (mas.id) AS id_scope, (mac.id) AS id_category, tald.is_etops
        FROM t_apply_license AS tal 
        LEFT JOIN t_apply_license_dtl tald ON tald.request_number_fk = tal.request_number
        LEFT JOIN t_assesment AS TAS ON tal.request_number = TAS.request_number_fk
        LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id                        
        LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id 
        LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
        LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
        LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id 
        LEFT JOIN m_assesment_session AS masses ON TAS.id_oral_sesi = masses.id
        LEFT JOIN m_room AS mr ON TAS.id_oral_room_fk = mr.id_room               
        WHERE tald.request_number_fk = '$request_number' AND tal.personnel_number ='$personnel_number' AND CONVERT(VARCHAR(10),tald.status_oral_assesment) = '1'";                                 
        return $this->db->query($query)->result();
    }

    public function get_general_document_quality($request_number){
        $query = "SELECT DISTINCT maarg.name_t, maarg.code_t, mglrg.category_continous, 
                mglrg.category_admin,mglrg.age_requirement FROM m_group_license_req_general AS mglrg 
                LEFT JOIN m_auth_additional_req_general AS maarg ON mglrg.id_auth_additional_req_general_fk = maarg.id
                LEFT JOIN m_auth_license AS mal ON mglrg.id_auth_license_fk = mal.id 
                LEFT JOIN m_auth_type AS mat ON mglrg.id_auth_type_fk = mat.id 
                LEFT JOIN t_apply_license_dtl AS tald ON tald.id_auth_license_fk = mglrg.id_auth_license_fk
                AND tald.id_auth_type_fk = mglrg.id_auth_type_fk
                WHERE mglrg.category_admin = 'Quality' AND tald.request_number_fk = '$request_number'";
        return $this->db->query($query)->result();
    } 

    public function get_spec_document_quality($request_number){
        $query = "SELECT DISTINCT maars.name_t AS name_t, maars.code_t, mgsc.category_continous,mgsc.category_admin, mgsc.age_requirement FROM m_group_scope_category mgsc
                LEFT JOIN m_auth_additional_req_spec AS maars ON mgsc.id_auth_additional_req_spec_fk = maars.id
                LEFT JOIN m_auth_license AS mal ON mgsc.id_auth_license_fk = mal.id
                LEFT JOIN t_apply_license_dtl AS tald ON tald.id_auth_license_fk = mgsc.id_auth_license_fk 
                AND tald.id_auth_type_fk = mgsc.id_auth_type_fk
                AND tald.id_auth_spect_fk = mgsc.id_auth_spect_fk
                AND tald.id_auth_category_fk = mgsc.id_auth_category_fk
                AND tald.id_auth_scope_fk = mgsc.id_auth_scope_fk
                WHERE mgsc.category_admin = 'Quality' AND tald.request_number_fk = '$request_number'";        
        return $this->db->query($query)->result();
    } 
    
        
    public function get_room(){
        $query = "SELECT TOP 1 mr.id_room AS ir, mr.name_room AS nr            
                FROM m_room AS mr";
        $data_room = $this->db->query($query)->row();
        $data_room_json = json_encode($data_room);
        die($data_room_json);                
    }

     public function get_room_oral($id_room){
        $query = "SELECT mr.id_room AS ir, mr.name_room AS nr            
                FROM m_room AS mr WHERE mr.id_room = '$id_room'";
        $data_room = $this->db->query($query)->row();
        $data_room_json = json_encode($data_room);
        die($data_room_json);                
    }
    
    public function get_room_by($id_sesi){
        $query = "SELECT DISTINCT tasm.id, mr.quota, tasm.date_written_assesment, mr.id_room AS ir, mr.name_room AS nr            
                FROM t_assesment AS tasm
                LEFT JOIN t_apply_license_dtl AS tald ON tald.request_number_fk = tasm.request_number_fk
                LEFT JOIN t_apply_license AS tal ON tal.request_number = tald.request_number_fk
                LEFT JOIN m_assesment_scope AS masmc ON tald.id_assesment_scope_fk = masmc.id
                LEFT JOIN m_room AS mr ON tasm.id_written_room_fk = mr.id_room
                WHERE tasm.id_written_sesi = '$id_sesi'";
        $data_room = $this->db->query($query)->row();
        $data_room_json = json_encode($data_room);
        die($data_room_json);                
    }

    public function get_room_oral_by($date_oral_assesment, $id_sesi, $id_room){
        $date_oral_assesment = date('Y-m-d',strtotime($date_oral_assesment));
        $query = "SELECT DISTINCT COUNT(tasm.id) AS kuota         
                FROM t_assesment AS tasm                
                LEFT JOIN m_room AS mr ON tasm.id_oral_room_fk = mr.id_room
                WHERE tasm.id_oral_sesi = '$id_sesi' AND tasm.date_oral_assesment = '$date_oral_assesment'
                AND tasm.id_oral_room_fk = '$id_room'
                ";
        $data_room = $this->db->query($query)->row();
        $data_room_json = json_encode($data_room);
        die($data_room_json);                
    }

    public function get_room_written_by($date_written_assesment, $id_sesi, $id_room){
        $date_written_assesment = date('Y-m-d',strtotime($date_written_assesment));
        $query = "SELECT DISTINCT COUNT(tasm.id) AS kuota         
                FROM t_assesment AS tasm                
                LEFT JOIN m_room AS mr ON tasm.id_written_room_fk = mr.id_room
                WHERE tasm.id_written_sesi = '$id_sesi' AND tasm.date_written_assesment = '$date_written_assesment'
                AND tasm.id_written_room_fk = '$id_room'
                ";
        $data_room = $this->db->query($query)->row();
        $data_room_json = json_encode($data_room);
        die($data_room_json);                
    }
    
    public function cek_assesment($request_number, $personnel_number, $id_license, $id_type, $id_spect, $id_category, $id_scope){
        $query = "SELECT * FROM t_assesment WHERE
                request_number_fk = '$request_number' AND 
                personnel_number_fk = '$personnel_number' AND 
                id_auth_license_fk = '$id_license' AND
                id_auth_type_fk = '$id_type' AND
                id_auth_spec_fk = '$id_spect' AND
                id_auth_category_fk = '$id_category' AND
                id_auth_scope_fk = '$id_scope'";
        return $this->db->query($query);
    }

    public function get_code_file_by($code=''){
        $querycode = "SELECT mdr.name FROM m_dir_requirement AS mdr
                        LEFT JOIN UNION_REQUIREMENT AS UR ON mdr.code = UR.code_folder
                        WHERE code_t = '$code'"; 
        return $this->db->query($querycode)->row();          
    } 
    


}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
