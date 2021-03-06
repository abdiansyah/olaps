<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_apply_license extends CI_Model {
    
    public function get_all_data_personnel($personnel_number='')
    {
        $name_superior = $this->db->select('TSHS.EMPLNAME')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSH.REPORT_TO = TSHS.PERNR')->get_compiled_select();
        $email_superior = $this->db->select('TSHS.EMAIL')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSH.REPORT_TO = TSHS.PERNR')->get_compiled_select();
        
        $name_superior_for_non_gmf = $this->db->select('TSHS.EMPLNAME')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSHS.PERNR = REPORT_TO')->get_compiled_select();
        $email_superior_for_non_gmf = $this->db->select('TSHS.EMAIL')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSHS.PERNR = REPORT_TO')->get_compiled_select();                
          
        $querydataallemp = "SELECT (personnel_number) AS PERNR , (name) AS EMPLNAME, (email) AS EMAIL, (presenttitle) AS JOBTITLE, (departement) AS UNIT, (formaleducation) AS LASTEDUCLEVEL,
                            (CONVERT(varchar(10), CONVERT(datetime, validitycontract,120),105)) AS WORKUNTILDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, dateofbirth,120),105)) AS BORNDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, dateofemployee,120),105)) AS EMPLODATE,
                            (report_to) AS REPORT_TO, (". $name_superior_for_non_gmf .") AS NAME_SUPERIOR, (". $email_superior_for_non_gmf .") AS EMAIL_SUPERIOR
                            FROM m_employee
                            WHERE personnel_number='$personnel_number'
                            UNION
                            SELECT TSH.PERNR, TSH.EMPLNAME, TSH.EMAIL, TSH.JOBTITLE, TSH.UNIT, TSH.LASTEDUCLEVEL,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.WORKUNTILDATE,120),105)) AS WORKUNTILDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.BORNDATE,120),105)) AS BORNDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.EMPLODATE,120),105)) AS EMPLODATE,
                            TSH.REPORT_TO, (". $name_superior .") AS NAME_SUPERIOR, (". $email_superior .") AS EMAIL_SUPERIOR FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH
                            WHERE TSH.PERNR = '$personnel_number'";                         
        return $this->db->query($querydataallemp)->num_rows();          
    }   
    
    public function get_all_data_personnel_non($personnel_number)
    {         
        $querydataallemp = "SELECT m_emp.*,(SELECT THS.EMPLNAME FROM db_hrm.dbo.TBL_SOE_HEAD AS THS WHERE m_emp.report_to = THS.PERNR) AS name_superior,
                            (SELECT THS.JOBTITLE FROM db_hrm.dbo.TBL_SOE_HEAD AS THS WHERE m_emp.report_to = THS.PERNR)AS presenttitle_superior, 
                            (SELECT THS.EMAIL FROM db_hrm.dbo.TBL_SOE_HEAD AS THS WHERE m_emp.report_to = THS.PERNR)AS email_superior 
                            FROM m_employee AS m_emp WHERE m_emp.personnel_number = '$personnel_number'";                                                            
        return $this->db->query($querydataallemp)->num_rows();
          
    }
    
    public function get_all_data_contact_personnel($personnel_number=''){
        $query = "SELECT me.personnel_number FROM m_employee AS me
                LEFT JOIN m_contact_employee AS mce ON me.personnel_number = mce.personnel_number_fk
                WHERE mce.personnel_number_fk = '$personnel_number'
                UNION
                SELECT TSH.PERNR FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH
                LEFT JOIN m_contact_employee AS mce ON TSH.PERNR = mce.personnel_number_fk
                WHERE mce.personnel_number_fk = '$personnel_number'";                         
        return $this->db->query($query)->num_rows(); 
    }
        
    public function get_data_personnel_by_gmf($personnel_number){
        $name_superior_for_non_gmf = $this->db->select('TSHS.EMPLNAME')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('m_employee.report_to = TSHS.PERNR')->get_compiled_select();
        $email_superior_for_non_gmf = $this->db->select('TSHS.EMAIL')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('m_employee.report_to = TSHS.PERNR')->get_compiled_select(); 
        
        $name_superior = $this->db->select('TSHS.EMPLNAME')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSH.REPORT_TO = TSHS.PERNR')->get_compiled_select();
        $email_superior = $this->db->select('TSHS.EMAIL')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSH.REPORT_TO = TSHS.PERNR')->get_compiled_select();                                                            
                                    
        $querydataemp = "SELECT TSH.PERNR, TSH.EMPLNAME, TSH.EMAIL, TSH.JOBTITLE, TSH.UNIT, te.pendidikan, te.jurusan,
                        (CONVERT(varchar(10), CONVERT(datetime, TSH.WORKUNTILDATE,120),105)) AS WORKUNTILDATE,
                        (CONVERT(varchar(10), CONVERT(datetime, TSH.BORNDATE,120),105)) AS BORNDATE,
                        (CONVERT(varchar(10), CONVERT(datetime, TSH.EMPLODATE,120),105)) AS EMPLODATE,
                        TSH.REPORT_TO, (". $name_superior .") AS NAME_SUPERIOR, (". $email_superior .") AS EMAIL_SUPERIOR,
                        mce.mobilephone, mce.businessphone
                        FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH
                        LEFT JOIN m_contact_employee AS mce ON mce.personnel_number_fk = TSH.PERNR                        
                        LEFT JOIN db_hrm.dbo.tbl_employee AS te ON TSH.PERNR = te.nopeg
                        WHERE TSH.PERNR = '$personnel_number'"; 
        $data_personnel = $this->db->query($querydataemp)->row();        
        $data_personnel_json = json_encode($data_personnel);                
        die($data_personnel_json);
    }
        
    public function get_data_personnel_by_non_gmf($personnel_number){
        $name_superior_for_non_gmf = $this->db->select('TSHS.EMPLNAME')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('m_employee.report_to = TSHS.PERNR')->get_compiled_select();
        $email_superior_for_non_gmf = $this->db->select('TSHS.EMAIL')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('m_employee.report_to = TSHS.PERNR')->get_compiled_select(); 
        
        $name_superior = $this->db->select('TSHS.EMPLNAME')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSH.REPORT_TO = TSHS.PERNR')->get_compiled_select();
        $email_superior = $this->db->select('TSHS.EMAIL')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSH.REPORT_TO = TSHS.PERNR')->get_compiled_select();                                                            
                                    
        $querydataemp = "SELECT (personnel_number) AS PERNR , (name) AS EMPLNAME, (email) AS EMAIL, (presenttitle) AS JOBTITLE, (departement) AS UNIT, (formaleducation) AS LASTEDUCDESC,
                        (CONVERT(varchar(10), CONVERT(datetime, validitycontract,120),105)) AS WORKUNTILDATE,
                        (CONVERT(varchar(10), CONVERT(datetime, dateofbirth,120),105)) AS BORNDATE,
                        (CONVERT(varchar(10), CONVERT(datetime, dateofemployee,120),105)) AS EMPLODATE,
                        (report_to) AS REPORT_TO, (". $name_superior_for_non_gmf .") AS NAME_SUPERIOR, (". $email_superior_for_non_gmf .") AS EMAIL_SUPERIOR,
                        mce.mobilephone, mce.businessphone
                        FROM m_employee
                        LEFT JOIN m_contact_employee AS mce ON mce.personnel_number_fk = m_employee.personnel_number
                        WHERE personnel_number='$personnel_number'"; 
        $data_personnel = $this->db->query($querydataemp)->row();        
        $data_personnel_json = json_encode($data_personnel);                
        die($data_personnel_json);
    }
    
    public function get_data_row_personnel_by($personnel_number){
        $name_superior = $this->db->select('TSHS.EMPLNAME')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSH.REPORT_TO = TSHS.PERNR')->get_compiled_select();
        $email_superior = $this->db->select('TSHS.EMAIL')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('TSH.REPORT_TO = TSHS.PERNR')->get_compiled_select();  
                        
        $name_superior_for_non_gmf = $this->db->select('TSHS.EMPLNAME')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('m_employee.report_to = TSHS.PERNR')->get_compiled_select();
        $email_superior_for_non_gmf = $this->db->select('TSHS.EMAIL')->from('db_hrm.dbo.TBL_SOE_HEAD AS TSHS')->
                        where('m_employee.report_to = TSHS.PERNR')->get_compiled_select();                         
                        
        $querydatarowemp = "SELECT (personnel_number) AS PERNR , (name) AS EMPLNAME, (email) AS EMAIL, (presenttitle) AS JOBTITLE, (departement) AS UNIT, (formaleducation) AS LASTEDUCLEVEL,
                            (CONVERT(varchar(10), CONVERT(datetime, validitycontract,120),105)) AS WORKUNTILDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, dateofbirth,120),105)) AS BORNDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, dateofemployee,120),105)) AS EMPLODATE,
                            (report_to) AS REPORT_TO, (". $name_superior_for_non_gmf .") AS NAME_SUPERIOR, (". $email_superior_for_non_gmf .") AS EMAIL_SUPERIOR
                            FROM m_employee
                            WHERE personnel_number='$personnel_number'
                            UNION        
                            SELECT TSH.PERNR, TSH.EMPLNAME, TSH.EMAIL, TSH.JOBTITLE, TSH.UNIT, TSH.LASTEDUCLEVEL,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.WORKUNTILDATE,120),105)) AS WORKUNTILDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.BORNDATE,120),105)) AS BORNDATE,
                            (CONVERT(varchar(10), CONVERT(datetime, TSH.EMPLODATE,120),105)) AS EMPLODATE,
                            TSH.REPORT_TO, (". $name_superior .") AS NAME_SUPERIOR, (". $email_superior .") AS EMAIL_SUPERIOR FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH
                            WHERE TSH.PERNR = '$personnel_number'";                                                                        
        return $this->db->query($querydatarowemp)->row_array();     
    }

    public function get_gm_personnel_by($personnel_number)
    {
        $query   = "SELECT personnel_number, email FROM UNION_EMP WHERE presenttitle LIKE 'GM%' AND departement = (SELECT SUBSTRING(departement,1,3) FROM UNION_EMP WHERE personnel_number = '$personnel_number')";
        return $this->db->query($query);
    }
    
    public function get_data_apply_personnel_by($personnel_number){        
      $querydataapplyemp = "SELECT TSH.personnel_number, TSH.name, TSH.email, TSH.presenttitle, TSH.departement,
                            TAL.request_number, TAL.reason_apply_license, TAL.date_request
                            FROM 
                            (SELECT personnel_number, name,  email, presenttitle, departement FROM m_employee
                            WHERE personnel_number='$personnel_number'
                            UNION       
                            SELECT (TSH.PERNR) AS personnel_number, (TSH.EMPLNAME) AS name , (TSH.EMAIL) AS email, (TSH.JOBTITLE) AS presenttitle, (TSH.UNIT) AS departement                            
                            FROM 
                            db_hrm.dbo.TBL_SOE_HEAD AS TSH
                            WHERE TSH.PERNR = '$personnel_number'
                            )AS TSH
                            LEFT JOIN t_apply_license AS TAL ON TAL.personnel_number = TSH.personnel_number 
                            WHERE
                            TSH.personnel_number= '$personnel_number'";                                                                                                             
        return $this->db->query($querydataapplyemp)->row_array();                           
    } 
    
    public function get_request_apply_personnel_by($cek_validate_req_number,$personnel_number){
        $queryreqapplyemp = "SELECT TAL.request_number, TAL.reason_apply_license, TAL.date_request from
                            t_apply_license AS TAL WHERE TAL.personnel_number = '$personnel_number' AND TAL.request_number = '$cek_validate_req_number'";                                                               
        return $this->db->query($queryreqapplyemp)->row_array();  
    }    
    
    public function get_emp_data_superior_by($personnel_number_superior){
        $querydataapplyemp = "SELECT (TSH.PERNR) AS personnel_number, (TSH.EMPLNAME) AS name , (TSH.EMAIL) AS email, (TSH.JOBTITLE) AS presenttitle, (TSH.UNIT) AS departement  FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH
                            WHERE TSH.PERNR = '$personnel_number_superior'"; 
        return $this->db->query($querydataapplyemp)->row_array();             
    }
    
    public function get_type($param){
        $query ="SELECT b.name_t, b.id, b.etops FROM m_group_spect_type a
                LEFT JOIN m_auth_spect b ON a.id_auth_spect_fk = b.id
                WHERE a.id_auth_type_fk = '$param'";                     
    return $this->db->query($query)->result();
    } 
    
    public function get_spec($p_id_spect, $p_id_license, $p_id_type){
        $query ="SELECT DISTINCT b.id, b.name_t FROM m_group_category_spect a
                LEFT JOIN m_group_type_license c ON c.id_auth_license_fk = a.id_auth_license_fk
                LEFT JOIN m_auth_category b ON a.id_auth_category = b.id
                WHERE a.id_auth_license_fk = '$p_id_license'
                AND a.id_auth_type_fk = '$p_id_type'
                AND a.id_auth_spect_fk= '$p_id_spect'";            
        return $this->db->query($query)->result();          
    }
    
    public function get_category($p_category, $p_spect, $p_type, $p_license){
        $query ="SELECT DISTINCT b.id, b.name_t FROM m_group_scope_category a
                LEFT JOIN m_auth_scope b ON a.id_auth_scope_fk = b.id
                WHERE a.id_auth_category_fk = '$p_category'
                AND a.id_auth_spect_fk = '$p_spect'
                AND a.id_auth_type_fk = '$p_type'
                AND a.id_auth_license_fk = '$p_license'";                        
        return $this->db->query($query)->result();
    }
    
    public function get_scope($p_scope, $p_category, $p_spect, $p_type, $p_license){
        $query ="SELECT DISTINCT b.id, b.name_t FROM m_group_scope_category a
                LEFT JOIN m_assesment_scope b ON a.id_assesment_scope_fk = b.id                                                             
                WHERE a.id_auth_scope_fk = '$p_scope'
                AND a.id_auth_category_fk = '$p_category'
                AND a.id_auth_spect_fk = '$p_spect'
                AND a.id_auth_type_fk = '$p_type'
                AND a.id_auth_license_fk = '$p_license'";                        
        return $this->db->query($query)->row_array();
    }
    
    public function query_general_document($personnel_number, $license='',$type='',$type_check_23='',$type_check_24='',$type_check_25='',$check_easa='',$type_easa='',$check_special=''){        
    $cek_file_general_document = "AND mglrg.category_admin = 'User' AND (mglrg.category_continous = '-' OR mglrg.category_continous = 'New')";    
    $query_general_document = "SELECT DISTINCT maarg.name_t, maarg.code_t, mglrg.category_continous, 
                        mglrg.category_admin,mglrg.age_requirement, tfr.code_file, tfr.expiration_date FROM m_group_license_req_general AS mglrg 
                        LEFT JOIN m_auth_additional_req_general AS maarg ON mglrg.id_auth_additional_req_general_fk = maarg.id
                        LEFT JOIN m_auth_license AS mal ON mglrg.id_auth_license_fk = mal.id 
                        LEFT JOIN m_auth_type AS mat ON mglrg.id_auth_type_fk = mat.id
                        LEFT JOIN t_file_requirement AS tfr ON maarg.code_t = tfr.code_file AND tfr.personnel_number_fk = '$personnel_number' 
                        WHERE mal.id = '$license' AND (mat.id = '$type' OR mat.id = '$type_check_23' OR mat.id = '$type_check_24' OR mat.id = '$type_check_25') ".$cek_file_general_document."
                        OR (mal.id = '$check_easa'
                        AND mat.id = '$type_easa' ".$cek_file_general_document.") OR (mal.id = '$license' AND mat.id = '$check_special' ".$cek_file_general_document.")";
    return $this->db->query($query_general_document);                        
    }

    public function cek_date_current($personnel_number='', $code_current='' ) {
        $query  = "SELECT TOP 1 tfr.id, REPLACE(tfr.date_upload,'-','') AS date_upload, SUBSTRING(REPLACE(tfr.time_upload,':',''),1,2) AS 
                time_upload  FROM t_file_requirement AS tfr
                WHERE tfr.personnel_number_fk = '$personnel_number' AND tfr.code_file = '$code_current'
                ORDER BY tfr.date_upload DESC";
        return $this->db->query($query)->row_array();
    }

    public function cek_time_current($personnel_number, $code_current) {
        $query  = "SELECT TOP 1 tfr.id, REPLACE(tfr.date_upload,'-','') AS date_upload, SUBSTRING(REPLACE(tfr.time_upload,':',''),1,2) AS 
                time_upload  FROM t_file_requirement AS tfr
                WHERE tfr.personnel_number_fk = '$personnel_number' AND tfr.code_file = '$code_current'
                ORDER BY tfr.date_upload DESC";
        return $this->db->query($query)->row_array();
    }

    public function cek_expiration_current($personnel_number, $code_current) {
        $query  = "SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, tfr.expiration_date,120),105)) AS expiration_date, tfr.date_upload, tfr.time_upload FROM t_file_requirement AS tfr
                    WHERE tfr.personnel_number_fk = '$personnel_number' AND tfr.code_file = '$code_current'
                    ORDER BY tfr.date_upload, tfr.time_upload DESC";
        return $this->db->query($query)->row_array();
    }
        
    public function query_general_certificate($personnel_number, $license='',$type='',$type_check_23='',$type_check_24='',$type_check_25='',$check_easa='',$type_easa='',$check_special=''){
    $cek_file_general_certificate = "AND mglrg.category_admin = 'User' AND (mglrg.category_continous = 'Non Recurrent' OR mglrg.category_continous = 'Recurrent')";    
    $query_general_certificate = "SELECT DISTINCT maarg.name_t, maarg.code_t, mglrg.category_continous,
                        mglrg.category_admin,mglrg.age_requirement, tfr.code_file, MAX((CONVERT(varchar(10), CONVERT(datetime, tfr.date_training,120),105))) AS date_training, MAX((CONVERT(varchar(10), CONVERT(datetime, tfr.expiration_date,120),105))) AS expiration_date
                        FROM m_group_license_req_general mglrg 
                        LEFT JOIN m_auth_additional_req_general maarg ON mglrg.id_auth_additional_req_general_fk = maarg.id
                        LEFT JOIN m_auth_license mal ON mglrg.id_auth_license_fk = mal.id 
                        LEFT JOIN m_auth_type mat ON mglrg.id_auth_type_fk = mat.id
                        LEFT JOIN t_file_requirement AS tfr ON maarg.code_t = tfr.code_file AND tfr.personnel_number_fk = '$personnel_number'
                        WHERE mal.id = '$license' AND (mat.id = '$type' OR mat.id = '$type_check_23' OR mat.id = '$type_check_24' OR mat.id = '$type_check_25') ".$cek_file_general_certificate."  
                        OR (mal.id = '$check_easa'
                        AND mat.id = '$type_easa' ".$cek_file_general_certificate.") OR (mal.id = '$license' AND mat.id = '$check_special' ".$cek_file_general_certificate.") GROUP BY maarg.name_t, maarg.code_t, mglrg.category_continous,
                        mglrg.category_admin,mglrg.age_requirement, tfr.code_file
                        ";
    return $this->db->query($query_general_certificate); 
    }
    
    public function query_specification_document($personnel_number, $license='',$type='',$tab_spec='',$tab_category='',$tab_scope='',$field=''){    
    $query_specification = "SELECT DISTINCT maars.name_t AS name_t, maars.code_t, mgsc.category_continous, tfr.code_file, 
                            mgsc.category_admin, mgsc.age_requirement,  MAX((CONVERT(varchar(10), CONVERT(datetime, tfr.date_training,120),105))) AS date_training, MAX((CONVERT(varchar(10), CONVERT(datetime, tfr.expiration_date,120),105))) AS expiration_date FROM m_group_scope_category mgsc
                            LEFT JOIN m_auth_additional_req_spec maars ON mgsc.id_auth_additional_req_spec_fk = maars.id
                            LEFT JOIN  m_auth_license mal ON mgsc.id_auth_license_fk = mal.id
                            LEFT JOIN t_file_requirement AS tfr ON maars.code_t = tfr.code_file AND tfr.personnel_number_fk = '$personnel_number'
                            WHERE mgsc.id_auth_license_fk = '$license'                    
                            AND mgsc.id_auth_type_fk = '$type'                    
                            AND mgsc.id_auth_spect_fk = '$tab_spec'
                            AND mgsc.id_auth_category_fk = '$tab_category'
                            AND mgsc.id_auth_scope_fk = '$tab_scope'
                            AND mgsc.category_admin = 'User'
                            AND (mgsc.category_continous = '-' OR  mgsc.category_continous = 'New')                            
                            GROUP BY maars.name_t, maars.code_t, mgsc.category_continous, tfr.code_file, 
                            mgsc.category_admin, mgsc.age_requirement";
    return $this->db->query($query_specification);
    }
      
    public function query_specification($personnel_number, $license='',$type='',$tab_spec='',$tab_category='',$tab_scope='',$field=''){    
    $query_specification = "SELECT DISTINCT maars.name_t AS name_t, maars.code_t, mgsc.category_continous, tfr.code_file, 
                            mgsc.category_admin, mgsc.age_requirement,  MAX((CONVERT(varchar(10), CONVERT(datetime, tfr.date_training,120),105))) AS date_training, MAX((CONVERT(varchar(10), CONVERT(datetime, tfr.expiration_date,120),105))) AS expiration_date FROM m_group_scope_category mgsc
                            LEFT JOIN m_auth_additional_req_spec maars ON mgsc.id_auth_additional_req_spec_fk = maars.id
                            LEFT JOIN  m_auth_license mal ON mgsc.id_auth_license_fk = mal.id
                            LEFT JOIN t_file_requirement AS tfr ON maars.code_t = tfr.code_file AND tfr.personnel_number_fk = '$personnel_number'
                            WHERE mgsc.id_auth_license_fk = '$license'                    
                            AND mgsc.id_auth_type_fk = '$type'                    
                            AND mgsc.id_auth_spect_fk = '$tab_spec'
                            AND mgsc.id_auth_category_fk = '$tab_category'
                            AND mgsc.id_auth_scope_fk = '$tab_scope'
                            AND mgsc.category_admin = 'User'
                            AND (mgsc.category_continous = 'Recurrent' OR  mgsc.category_continous = 'Non Recurrent')                            
                            GROUP BY maars.name_t, maars.code_t, mgsc.category_continous, tfr.code_file, 
                            mgsc.category_admin, mgsc.age_requirement";
    return $this->db->query($query_specification);
    }
    
    public function query_license($license='',$type='',$tab_spec='',$tab_category='',$tab_scope='', $etops = ''){        
    $query_license = "SELECT DISTINCT b.name_t AS name_t, b.id, d.name_t AS name_type, f.name_t AS name_spect, e.name_t AS name_category, c.name_t AS name_scope, (CASE '$etops' WHEN '1' THEN ' + ETOPS ' ELSE ' ' END) AS status_etops FROM m_group_scope_category a
                    LEFT JOIN m_auth_license b ON a.id_auth_license_fk = b.id 
                    LEFT JOIN m_auth_scope c ON c.id = a.id_auth_scope_fk  
                    LEFT JOIN m_auth_type d ON d.id = a.id_auth_type_fk             
                    LEFT JOIN m_auth_category e ON e.id = a.id_auth_category_fk 
                    LEFT JOIN m_auth_spect f ON f.id = a.id_auth_spect_fk
                    WHERE a.id_auth_license_fk='$license' AND a.id_auth_type_fk = '$type' AND a.id_auth_spect_fk = '$tab_spec' AND a.id_auth_category_fk = '$tab_category' AND c.id = '$tab_scope'";
    return $this->db->query($query_license);
    }
    
    public function query_license_special($check_special='',$tab_spec_special='',$tab_category_special='',$tab_scope_special=''){
    $query_license_special = "SELECT DISTINCT d.name_t AS name_type, c.id, f.name_t AS name_spect, e.name_t AS name_category, c.name_t AS name_scope FROM m_group_scope_category a         
                    LEFT JOIN m_auth_scope c ON c.id = a.id_auth_scope_fk
                    LEFT JOIN m_auth_category e ON e.id = a.id_auth_category_fk
                    LEFT JOIN m_auth_spect f ON f.id = a.id_auth_spect_fk
                    LEFT JOIN m_auth_type d ON a.id_auth_type_fk= d.id WHERE a.id_auth_type_fk = '$check_special' AND a.id_auth_spect_fk = '$tab_spec_special' AND a.id_auth_category_fk = '$tab_category_special' AND a.id_auth_scope_fk = '$tab_scope_special'";
    return $this->db->query($query_license_special);
    }    

    public function cek_approved_atasan($cek_validate_req_number, $personnel_number){                          
        $cek_query_validate = "SELECT mal.name_t AS name_license, tal.reason_apply_license AS reason_apply_license, tal.personnel_number, tal.request_number AS request_number, mat.name_t AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope, tal.date_request, tald.is_etops FROM t_apply_license tal
                             LEFT JOIN t_apply_license_dtl AS tald ON tal.request_number = tald.request_number_fk
                             LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id  
                             LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id 
                             LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
                             LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
                             LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id                                                
                             WHERE tal.request_number = '$cek_validate_req_number' AND tal.personnel_number = '$personnel_number' AND tal.send_email = '0'"; 
         return $this->db->query($cek_query_validate)->result();
    } 
    
    public function cek_data_summary($requset_number,$post_request_number,$personnel_number,$post_personnel_number){                          
        $cek_query_validate = "SELECT mal.name_t AS name_license, tal.reason_apply_license AS reason_apply_license, tal.personnel_number, tal.request_number AS request_number, mat.name_t AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope, tal.date_request, tald.is_etops FROM t_apply_license tal
                             LEFT JOIN t_apply_license_dtl AS tald ON tal.request_number = tald.request_number_fk
                             LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id  
                             LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id 
                             LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
                             LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
                             LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id                                                
                             WHERE (tal.request_number = '$requset_number' OR tal.request_number = '$post_request_number' ) AND (tal.personnel_number = '$post_personnel_number' OR tal.personnel_number = '$personnel_number')"; 
         return $this->db->query($cek_query_validate)->result();
    }       
    
    public function get_data_assesment($personnel_number,$request_number){
        $query = "SELECT tal.request_number, tal.reason_apply_license, tal.date_request, me.personnel_number, me.type_emp, me.name, me.email, me.presenttitle, me.departement FROM m_employee me
                 LEFT JOIN t_apply_license tal ON me.personnel_number = tal.personnel_number 
                 WHERE me.personnel_number = '$personnel_number' AND tal.request_number = '$request_number'";
        return $this->db->query($query)->row_array();
    }    
    
    public function cek_akses($personnel_number) {
    $querycekakses = "SELECT * FROM m_employee_group
                    WHERE personnel_number_fk = '$personnel_number'"; 
    return $this->db->query($querycekakses)->row();     
    }         

    public function get_code_file(){
        $querycodefile = "SELECT * FROM m_dir_requirement"; 
        return $this->db->query($querycodefile)->result();       
    }  

    public function get_code_file_by($code='') {
        $querycode = "SELECT mdr.name FROM m_dir_requirement AS mdr
                        LEFT JOIN UNION_REQUIREMENT AS UR ON mdr.code = UR.code_folder
                        WHERE code_t = '$code'"; 
        return $this->db->query($querycode)->row();          
    }

    public function get_check_etops($id_spect) {
        $querycode = "SELECT * FROM m_auth_spect AS mas                        
                        WHERE id = '$id_spect' AND etops!=''"; 
        return $this->db->query($querycode)->row(); 
    }

    // 

    private $table_basic        = 'db_license.dbo.vw_BasicLic';
    private $table_ame          = 'db_license.dbo.vw_amel';
    private $table_auth         = 'db_license.dbo.vw_authl';
    private $table_easa         = 'db_license.dbo.tbl_easa_authl';
    private $table_license      = 'db_license.dbo.vw_license';
    
            
            
    public function _get_query_basic() {                              
        $this->db->select("*");
        $this->db->from($this->table_basic);                              
    }

    public function get_data_basic_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('empl_id',$personnel_number);
        $this->_get_query_basic();        
        $query = $this->db->get();        
        return $query->result();
    }        
            
    public function _get_query_ame() {                              
        $this->db->select("*");
        $this->db->from($this->table_ame);                              
    }

    public function get_data_ame_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('empl_id',$personnel_number);
        $this->_get_query_ame();        
        $query = $this->db->get();        
        return $query->result();
    }

    public function _get_query_cs() {                              
        $this->db->select("*");
        $this->db->where('lic_type','CS');
        $this->db->from($this->table_auth);                              
    }

    public function get_data_cs_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('empl_id',$personnel_number);
        $this->_get_query_cs();        
        $query = $this->db->get();        
        return $query->result();
    }

    public function _get_query_gmf() {                              
        $this->db->select("*");
        $this->db->where('lic_type','GMF');
        $this->db->from($this->table_auth);                              
    }

    public function get_data_gmf_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('empl_id',$personnel_number);
        $this->_get_query_gmf();        
        $query = $this->db->get();        
        return $query->result();
    }

    public function _get_query_ga() {                              
        $this->db->select("*");
        $this->db->where('scp_indent','GASW');
        $this->db->from($this->table_auth);                              
    }

    public function get_data_ga_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('empl_id',$personnel_number);
        $this->_get_query_ga();        
        $query = $this->db->get();        
        return $query->result();
    }

    public function _get_query_citilink() {                              
        $this->db->select("*");
        $this->db->where('scp_indent','CTSW');
        $this->db->from($this->table_auth);                              
    }

    public function get_data_citilink_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('empl_id',$personnel_number);
        $this->_get_query_citilink();        
        $query = $this->db->get();        
        return $query->result();
    }

    public function _get_query_sriwijaya() {                              
        $this->db->select("*");
        $this->db->where('scp_indent','SJSW');
        $this->db->from($this->table_auth);                              
    }

    public function get_data_sriwijaya_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('empl_id',$personnel_number);
        $this->_get_query_sriwijaya();        
        $query = $this->db->get();        
        return $query->result();
    }

    public function _get_query_easa() {                              
        $this->db->select("*");        
        $this->db->from($this->table_easa);                              
        $this->db->join('db_license.dbo.tbl_easa_category','db_license.dbo.tbl_easa_authl.easa_cat = db_license.dbo.tbl_easa_category.easa_cat','LEFT');
    }

    public function get_data_easa_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('empl_id',$personnel_number);
        $this->_get_query_easa();        
        $query = $this->db->get();        
        return $query->result();
    }

    public function _get_query_cofc() {                              
        $this->db->select('db_license.dbo.vw_license.empl_id, db_license.dbo.vw_license.stamp_no, db_license.dbo.vw_license.issued_on, db_license.dbo.vw_license.valid_until, db_license.dbo.tbl_cofc_ec.ecno, db_license.dbo.tbl_cofc_ec.ecdesc,db_license.dbo.tbl_cofc_ec.ecrating');        
        $this->db->from('db_license.dbo.vw_license');                                      
        $this->db->join('db_license.dbo.tbl_cofc_ec','db_license.dbo.vw_license.empl_id = db_license.dbo.tbl_cofc_ec.empl_id','LEFT');        
    }

    public function get_data_cofc_license() {        
        $personnel_number = $this->input->post('personnel_number');
        $this->db->where('db_license.dbo.vw_license.LIC-TYPE','COC');
        $this->db->where('db_license.dbo.vw_license.empl_id',$personnel_number);
        $this->_get_query_cofc();        
        $query = $this->db->get();        
        return $query->result();
    }

    public function get_content_msg_apply($id) {
        $this->db->select("subject, title, content, footer");
        $this->db->from("m_content_approved");
        $this->db->where('id',$id);
        $query = $this->db->get()->row_array();                
        return $query;
    }

}
    

/* End of file m_apply_license.php */
/* Location: ./application/modules/apply_license/models/m_apply_license.php */