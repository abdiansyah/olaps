<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_assesment extends CI_Model {
    function __construct()
    {        
        parent::__construct();        
    }         
    public function get_data_assesment($personnel_number,$request_number)
    {
        $query = "SELECT tal.reason_apply_license, tald.is_etops, masc.id, masc.name_t, tal.date_request, 
                (SELECT TOP 1 ta.date_written_assesment FROM t_assesment AS ta WHERE ta.request_number_fk = tal.request_number AND ta.id_assesment_scope_fk = tald.id_assesment_scope_fk AND tald.id_auth_license_fk = ta.id_auth_license_fk AND tald.id_auth_type_fk = ta.id_auth_type_fk AND tald.id_auth_spect_fk = ta.id_auth_spec_fk AND tald.id_auth_category_fk = ta.id_auth_category_fk AND tald.id_auth_scope_fk = ta.id_auth_scope_fk) AS date_written_assesment,
                (SELECT TOP 1 ta.id_written_sesi FROM t_assesment AS ta WHERE ta.request_number_fk = tal.request_number AND ta.id_assesment_scope_fk = tald.id_assesment_scope_fk AND tald.id_auth_license_fk = ta.id_auth_license_fk AND tald.id_auth_type_fk = ta.id_auth_type_fk AND tald.id_auth_spect_fk = ta.id_auth_spec_fk AND tald.id_auth_category_fk = ta.id_auth_category_fk AND tald.id_auth_scope_fk = ta.id_auth_scope_fk) AS id_sesi_written_assesment,
                (CASE (SELECT TOP 1 ta.id_written_sesi FROM t_assesment AS ta WHERE ta.request_number_fk = tal.request_number AND ta.id_assesment_scope_fk = tald.id_assesment_scope_fk AND tald.id_auth_license_fk = ta.id_auth_license_fk AND tald.id_auth_type_fk = ta.id_auth_type_fk AND tald.id_auth_spect_fk = ta.id_auth_spec_fk AND tald.id_auth_category_fk = ta.id_auth_category_fk AND tald.id_auth_scope_fk = ta.id_auth_scope_fk) WHEN '1' THEN '09:00 - 11:00' WHEN '2' THEN '13:00 - 15:00' END) AS sesi_written_assesment,
                (SELECT TOP 1 mr.id_room FROM t_assesment AS ta 
                LEFT JOIN m_room AS mr ON ta.id_written_room_fk = mr.id_room WHERE ta.request_number_fk = tal.request_number AND ta.id_assesment_scope_fk = tald.id_assesment_scope_fk AND tald.id_auth_license_fk = ta.id_auth_license_fk AND tald.id_auth_type_fk = ta.id_auth_type_fk AND tald.id_auth_spect_fk = ta.id_auth_spec_fk AND tald.id_auth_category_fk = ta.id_auth_category_fk AND tald.id_auth_scope_fk = ta.id_auth_scope_fk) AS id_room_written_assesment,
                (SELECT TOP 1 mr.name_room FROM t_assesment AS ta 
                LEFT JOIN m_room AS mr ON ta.id_written_room_fk = mr.id_room WHERE ta.request_number_fk = tal.request_number AND ta.id_assesment_scope_fk = tald.id_assesment_scope_fk AND tald.id_auth_license_fk = ta.id_auth_license_fk AND tald.id_auth_type_fk = ta.id_auth_type_fk AND tald.id_auth_spect_fk = ta.id_auth_spec_fk AND tald.id_auth_category_fk = ta.id_auth_category_fk AND tald.id_auth_scope_fk = ta.id_auth_scope_fk) AS room_written_assesment,        
                tald.status_oral_assesment,(mal.name_t) AS name_license, (mat.name_t) AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope,
                (mal.id) AS id_license, (mat.id) AS id_type, (masp.id) AS id_spect, (mas.id) AS id_scope, (mac.id) AS id_category
                FROM t_apply_license AS tal 
                LEFT JOIN t_apply_license_dtl AS tald ON tald.request_number_fk = tal.request_number
                LEFT JOIN t_assesment AS ta ON tald.request_number_fk = ta.request_number_fk
                LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id
                LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id                              
                LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
                LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
                LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id 
                LEFT JOIN m_assesment_scope AS masc ON tald.id_assesment_scope_fk = masc.id
                WHERE tald.request_number_fk = '$request_number' AND tal.personnel_number ='$personnel_number' AND tald.id_auth_license_fk = ta.id_auth_license_fk AND tald.id_auth_type_fk = ta.id_auth_type_fk AND tald.id_auth_spect_fk = ta.id_auth_spec_fk AND tald.id_auth_category_fk = ta.id_auth_category_fk AND tald.id_auth_scope_fk = ta.id_auth_scope_fk AND tald.status_written_assesment = '1'";
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
            
    public function get_room_by($id_sesi){
        $query = "SELECT DISTINCT tasm.id, mr.quota, tasm.date_written_assesment, mr.id_room AS ir, mr.name_room AS nr            
                FROM t_assesment AS tasm
                LEFT JOIN t_apply_license_dtl AS tald ON tald.request_number_fk = tasm.request_number_fk
                LEFT JOIN t_apply_license AS tal ON tal.request_number = tald.request_number_fk
                LEFT JOIN m_assesment_scope AS masmc ON tald.id_assesment_scope_fk = masmc.id
                LEFT JOIN m_room AS mr ON tasm.id_room_fk = mr.id_room
                WHERE tasm.id_sesi = '$id_sesi'";
        $data_room = $this->db->query($query)->row();
        $data_room_json = json_encode($data_room);
        die($data_room_json);                
    }
    
    public function get_room(){
        $query = "SELECT TOP 1 mr.id_room AS ir, mr.name_room AS nr            
                FROM m_room AS mr";
        $data_room = $this->db->query($query)->row();
        $data_room_json = json_encode($data_room);
        die($data_room_json);                
    }    
    
    public function get_room_kuota($date_written_assesment, $id_sesi, $id_room){
        $query = "SELECT COUNT(tasm.id_sesi) AS jumlah_sesi FROM t_assesment tasm                                                 
                WHERE tasm.id_sesi = '$id_sesi' AND tasm.date_written_assesment = '$date_written_assesment' AND tasm.id_room_fk = '$id_room'";
        $data_kuota = $this->db->query($query)->row();
        $data_kuota_json = json_encode($data_kuota);
        die($data_kuota_json);                
    }
    
    public function get_summary_assesment($sesi, $assesment, $room, $date_written_assesment){
    $query = "SELECT masc.name_t AS name_assesment_scope, mr.name_room, mases.name_t AS sesi, '$date_written_assesment' AS date_written_assesment FROM m_assesment_scope masc
            LEFT JOIN m_room mr ON mr.id_room = '$room'
            LEFT JOIN m_assesment_session mases ON mases.id = '$sesi' 
            WHERE masc.id ='$assesment'";    
    $data['data_sum_assesment'] = $this->db->query($query)->result();    
    $this->load->view('assesment/tab_sum_assesment', $data);                              
    }
    
    
}