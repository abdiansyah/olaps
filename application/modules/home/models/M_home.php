<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_home extends CI_Model {
   	private $table 			= 't_apply_license';
	private $column_order 	= array('date_request');	  
	private $order 			= array('date_request' => 'desc');
            
			
	private function _get_query() {                      
       
        $this->db->select("TSH.name, TSH.personnel_number, TSH.departement, TSH.presenttitle, TSH.report_to, t_apply_license.request_number, 
                            (CASE t_apply_license.status_submit WHEN '1' THEN 'Data Submited' END) AS submited, (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),105)) AS date_request,
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
                            (SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, TA.date_assesment,120),105)) FROM t_assesment AS TA WHERE (TA.request_number_fk = t_apply_license.request_number))
                            WHEN t_apply_license.status_issue_authorization IS NULL then
                            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),105))
                            WHEN t_apply_license.take_authorization IS NULL then
                            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),105))
                            WHEN t_apply_license.finished IS NULL then
                            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),105))
                            WHEN t_apply_license.finished IS NOT NULL then
                            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),105))
                            END) as last_update");
		$this->db->from($this->table);               
		$this->db->join('UNION_EMP AS TSH', 't_apply_license.personnel_number = TSH.personnel_number', 'left');        
		
		if(isset($_POST['order'])){
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	public function get_value_home() {
        @$personnel_number 	        = $this->input->post('personnel_number');
        $request_number_user        = $this->input->post('request_number_user');
        $date_request               = $this->input->post('date_request');
        $employee_personnel_number  = $this->input->post('employee_personnel_number');
        $name_personnel             = $this->input->post('name_personnel');
        $status                     = $this->input->post('status');
        $this->db->where('CONVERT(VARCHAR(20),TSH.personnel_number)',@$personnel_number);
        if($request_number_user!=''){
            $this->db->where('t_apply_license.request_number',$request_number_user);
        };
        if($date_request!=''){
            $this->db->like('(CONVERT(VARCHAR(10), CONVERT(datetime, t_apply_license.date_request,120),105))',$date_request);
        };
        
        if($status=='11'){
            $this->db->where('t_apply_license.finished','1');            
        };
        if($status=='10'){
            $this->db->where('t_apply_license.take_authorization','1');
            $this->db->where('t_apply_license.finished','1');            
        };
        if($status=='9'){
            $this->db->where('t_apply_license.referral_authorization','1');  
            $this->db->where('t_apply_license.finished',null);             
        };
        if($status=='8'){
            $this->db->where('t_apply_license.status_issue_authorization','2');
            $this->db->where('t_apply_license.referral_authorization',null);            
        };
        if($status=='7'){
            $this->db->where('t_apply_license.status_assesment','2'); 
            $this->db->where('t_apply_license.status_issue_authorization',null);           
        };
        if($status=='6'){
            $this->db->where('t_apply_license.status_assesment','1'); 
            $this->db->where('t_apply_license.status_issue_authorization',null);             
        };
        if($status=='5'){
            $this->db->where('t_apply_license.status_approved_quality','2'); 
            $this->db->where('t_apply_license.status_assesment',null);           
        };
        if($status=='4'){
            $this->db->where('t_apply_license.status_approved_quality','1'); 
            $this->db->where('t_apply_license.status_assesment',null);         
        };
        if($status=='3'){
            $this->db->where('t_apply_license.status_approved_superior','2'); 
            $this->db->where('t_apply_license.status_approved_quality',null);          
        };
        if($status=='2'){
            $this->db->where('t_apply_license.status_approved_superior','1'); 
            $this->db->where('t_apply_license.status_approved_quality',null);           
        };
        if($status=='1'){
            $this->db->where('t_apply_license.status_approved_superior',null);
            $this->db->where('t_apply_license.status_submit','1');                       
        };
        
        $this->db->or_where('CONVERT(VARCHAR(20),TSH.report_to)',@$personnel_number); 
        if($request_number_user!=''){
            $this->db->where('t_apply_license.request_number',$request_number_user);
        };              
        
        if($date_request!=''){
            $this->db->like('(CONVERT(VARCHAR(10), CONVERT(datetime, t_apply_license.date_request,120),105))',$date_request);
        };  
        if($employee_personnel_number!=''){
            $this->db->where('TSH.personnel_number',$employee_personnel_number);
        };                
                       
        if($name_personnel!=''){
            $this->db->like('TSH.name',$name_personnel);
        };
        
        if($status=='11'){
            $this->db->where('t_apply_license.finished','1');            
        };
        if($status=='10'){
            $this->db->where('t_apply_license.take_authorization','1');
            $this->db->where('t_apply_license.finished','1');            
        };
        if($status=='9'){
            $this->db->where('t_apply_license.referral_authorization','1');  
            $this->db->where('t_apply_license.finished',null);             
        };
        if($status=='8'){
            $this->db->where('t_apply_license.status_issue_authorization','2');
            $this->db->where('t_apply_license.referral_authorization',null);            
        };
        if($status=='7'){
            $this->db->where('t_apply_license.status_assesment','2'); 
            $this->db->where('t_apply_license.status_issue_authorization',null);           
        };
        if($status=='6'){
            $this->db->where('t_apply_license.status_assesment','1'); 
            $this->db->where('t_apply_license.status_issue_authorization',null);             
        };
        if($status=='5'){
            $this->db->where('t_apply_license.status_approved_quality','2'); 
            $this->db->where('t_apply_license.status_assesment',null);           
        };
        if($status=='4'){
            $this->db->where('t_apply_license.status_approved_quality','1'); 
            $this->db->where('t_apply_license.status_assesment',null);         
        };
        if($status=='3'){
            $this->db->where('t_apply_license.status_approved_superior','2'); 
            $this->db->where('t_apply_license.status_approved_quality',null);          
        };
        if($status=='2'){
            $this->db->where('t_apply_license.status_approved_superior','1'); 
            $this->db->where('t_apply_license.status_approved_quality',null);           
        };
        if($status=='1'){
            $this->db->where('t_apply_license.status_approved_superior',null);
            $this->db->where('t_apply_license.status_submit','1');                       
        };
            
		$this->_get_query();
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);                        
		$query = $this->db->get();
		
		return $query->result();
	}

	public function count_filtered() {
		$this->_get_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
    
    public function cek_superior($personnel_number='')
	{        
	    $query = "SELECT TOP 1 * FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH 
                WHERE TSH.REPORT_TO = '$personnel_number'";
        return $this->db->query($query)->num_rows();                  
	}
    
    
}
	

/* End of file m_home.php */
/* Location: ./application/modules/apply_license/models/m_home.php */