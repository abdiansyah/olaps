<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_assesment extends CI_Model {

    private $table          = 't_assesment';
    private $column_order   = array('name','request_number_fk','personnel_number_fk','date_written_assesment','name_sesi','name_room');   
    private $order          = array('personnel_number' => 'asc'); 
            
    public function _get_query() {
        $subQuery_pic_written = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->where('TSH.personnel_number = TAS.pic_written')->get_compiled_select();

        $subQuery_pic_oral = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->where('TSH.personnel_number = TAS.pic_oral')->get_compiled_select();
      $this->db->select("TSH.name, TAS.id_assesment_scope_fk, TAS.personnel_number_fk, masc.name_t, TAS.date_written_assesment, TAS.date_oral_assesment, TAS.request_number_fk, (masses.name_t) AS name_sesi, mr.name_room, TAS.score_written, TAS.result_written, TAS.score_oral, TAS.result_oral, note_oral, note_written, (" . $subQuery_pic_written . ") AS pic_written, (" . $subQuery_pic_oral . ") AS pic_oral");           
        $this->db->from('t_assesment AS TAS ');                
        $this->db->join('UNION_EMP AS TSH', 'TSH.personnel_number = TAS.personnel_number_fk', 'left');
        $this->db->join('m_assesment_scope AS masc','TAS.id_assesment_scope_fk = masc.id','left');
        $this->db->join('m_room AS mr','mr.id_room = TAS.id_written_room_fk ','left');
        $this->db->join('m_assesment_session AS masses','masses.id = TAS.id_written_sesi ','left');                        
        
        if(isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    public function get_written_assesment() {       
        $request_number_written        = $this->input->post('request_number_written');                
        $personnel_number_written      = $this->input->post('personnel_number_written');
        $status_assesment_written      = $this->input->post('status_assesment_written');
        $date_assesment_written        = $this->input->post('date_assesment_written');
        $id_written_sesi               = $this->input->post('id_written_sesi');
        $id_written_room               = $this->input->post('id_written_room');              
        $score_written                 = $this->input->post('score_written');
        $result_written                = $this->input->post('result_written'); 
             
        $this->_get_query();
        if(!empty($request_number_written)){
           $this->db->where('request_number_fk', $request_number_written);    
        }
        
        if(!empty($personnel_number_written)){
           $this->db->where('personnel_number_fk', $personnel_number_written);    
        }
                
        if(!empty($status_assesment_written)){
           $this->db->where('status_assesment', $status_assesment_written);    
        }
                
        if(!empty($date_assesment_written)){
           $this->db->where('date_assesment', $date_assesment_written);    
        }
                
        if(!empty($id_written_sesi)){
           $this->db->where('id_written_sesi', $id_written_sesi);    
        }
        
        if(!empty($id_written_room)){
           $this->db->where('id_written_room_fk', $id_written_room);    
        }
        
        if(!empty($score_written)){
           $this->db->where('score_written', $score_written);    
        }
        
        if(!empty($result_written)){
           $this->db->where('result_written', $result_written);    
        }
        
        $this->db->where('id_written_sesi!=',null);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
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
    
    // Oral assesment
        public function get_oral_assesment() {
        $request_number_oral        = $this->input->post('request_number_oral');                
        $personnel_number_oral      = $this->input->post('personnel_number_oral');
        $status_assesment_oral      = $this->input->post('status_assesment_oral');
        $date_assesment_oral        = $this->input->post('date_assesment_oral');
        $id_oral_sesi               = $this->input->post('id_oral_sesi');
        $id_oral_room               = $this->input->post('id_oral_room');              
        $score_oral                 = $this->input->post('score_oral');
        $result_oral                = $this->input->post('result_oral'); 
             
        $this->_get_query();
        if(!empty($request_number_oral)){
           $this->db->where('request_number_fk', $request_number_oral);    
        }
        
        if(!empty($personnel_number_oral)){
           $this->db->where('personnel_number_fk', $personnel_number_oral);    
        }
                
        if(!empty($status_assesment_oral)){
           $this->db->where('status_assesment', $status_assesment_oral);    
        }
                
        if(!empty($date_assesment_oral)){
           $this->db->where('date_assesment', $date_assesment_oral);    
        }
                
        if(!empty($id_oral_sesi)){
           $this->db->where('id_oral_sesi', $id_oral_sesi);    
        }
        
        if(!empty($id_oral_room)){
           $this->db->where('id_oral_room_fk', $id_oral_room);    
        }
        
        if(!empty($score_oral)){
           $this->db->where('score_oral', $score_oral);    
        }
        
        if(!empty($result_oral)){
           $this->db->where('result_oral', $result_oral);    
        }
        $this->db->where('id_oral_sesi !=',null);       
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function count_filtered_oral_assesment() {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_oral_assesment() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }        
    
    
    public function by_id_users($id){
        $datasrc = $this->db->get_where('users', array('id_users' => $id));
        return $datasrc->num_rows() > 0 ? $datasrc->row() : $this;
    }
    
    public function by_request_number($id='', $id_scope=''){
        $subQuery_pic_written = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->where('TSH.personnel_number = TAS.pic_written')->get_compiled_select();

        $datasrc = "SELECT TAS.request_number_fk, TAS.personnel_number_fk, TSH.name, TAS.id_assesment_scope_fk, masc.name_t, TAS.pic_written, TAS.score_written, TAS.result_written, TAS.score_oral, TAS.result_oral, (" . $subQuery_pic_written . ") AS name_pic_written FROM t_assesment AS TAS
                    LEFT JOIN UNION_EMP AS TSH ON TSH.personnel_number = TAS.personnel_number_fk
                    LEFT JOIN m_assesment_scope AS masc ON TAS.id_assesment_scope_fk = masc.id WHERE request_number_fk = '$id' AND id_assesment_scope_fk = '$id_scope'";
        return $this->db->query($datasrc)->num_rows() > 0 ? $this->db->query($datasrc)->row() : $this;
    }

    public function by_request_number_oral($id='', $id_scope=''){
        $subQuery_pic_oral = $this->db->select('TSH.name')->from('UNION_EMP AS TSH')->where('TSH.personnel_number = TAS.pic_oral')->get_compiled_select();
        $datasrc = "SELECT TAS.request_number_fk, TAS.personnel_number_fk, TSH.name, TAS.id_assesment_scope_fk, masc.name_t, TAS.pic_oral, TAS.score_oral, TAS.result_oral, (" . $subQuery_pic_oral . ") AS name_pic_oral FROM t_assesment AS TAS
                    LEFT JOIN UNION_EMP AS TSH ON TSH.personnel_number = TAS.personnel_number_fk
                    LEFT JOIN m_assesment_scope AS masc ON TAS.id_assesment_scope_fk = masc.id WHERE request_number_fk = '$id' AND id_assesment_scope_fk = '$id_scope'";
        return $this->db->query($datasrc)->num_rows() > 0 ? $this->db->query($datasrc)->row() : $this;
    }

    public function get_result_oral ($request_number = '', $personnel_number = '') {
        $query = "SELECT TA.request_number_fk, personnel_number_fk, (mal.name_t) AS name_license, (mat.name_t) AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope, (CASE tald.is_etops WHEN '1' THEN '+ ETOPS' END) AS status_etops, pic_oral, date_result_oral, score_oral, result_oral, note_oral, 
            (mal.id) AS id_license, (mat.id) AS id_type, (masp.id) AS id_spect, (mac.id) AS id_category, (mas.id) AS id_scope FROM t_assesment AS TA
            LEFT JOIN t_apply_license_dtl AS tald ON TA.request_number_fk = tald.request_number_fk 
            AND tald.id_auth_license_fk = TA.id_auth_license_fk
            AND tald.id_auth_type_fk = TA.id_auth_type_fk
            AND tald.id_auth_spect_fk = TA.id_auth_spec_fk
            AND tald.id_auth_category_fk = TA.id_auth_category_fk
            AND tald.id_auth_scope_fk = TA.id_auth_scope_fk
            LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id
            LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id                              
            LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
            LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
            LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id 
            WHERE TA.request_number_fk = '$request_number' AND personnel_number_fk = '$personnel_number'";
        return $this->db->query($query)->result();
    }
    
    public function get_result_written ($request_number = '', $personnel_number = '') {
        $query = "SELECT TA.request_number_fk, personnel_number_fk, (mal.name_t) AS name_license, (mat.name_t) AS name_type, masp.name_t AS name_spect, mac.name_t AS name_category, mas.name_t AS name_scope, (CASE tald.is_etops WHEN '1' THEN '+ ETOPS' END) AS status_etops, pic_written, date_result_written, score_written, result_written, note_written, 
        (mal.id) AS id_license, (mat.id) AS id_type, (masp.id) AS id_spect, (mac.id) AS id_category, (mas.id) AS id_scope FROM t_assesment AS TA
        LEFT JOIN t_apply_license_dtl AS tald ON TA.request_number_fk = tald.request_number_fk 
        AND tald.id_auth_license_fk = TA.id_auth_license_fk
        AND tald.id_auth_type_fk = TA.id_auth_type_fk
        AND tald.id_auth_spect_fk = TA.id_auth_spec_fk
        AND tald.id_auth_category_fk = TA.id_auth_category_fk
        AND tald.id_auth_scope_fk = TA.id_auth_scope_fk
        LEFT JOIN m_auth_license AS mal ON tald.id_auth_license_fk = mal.id
        LEFT JOIN m_auth_type AS mat ON tald.id_auth_type_fk = mat.id                              
        LEFT JOIN m_auth_spect AS masp ON tald.id_auth_spect_fk = masp.id
        LEFT JOIN m_auth_category AS mac ON tald.id_auth_category_fk = mac.id                              
        LEFT JOIN m_auth_scope AS mas ON tald.id_auth_scope_fk = mas.id 
        WHERE TA.request_number_fk = '$request_number' AND personnel_number_fk = '$personnel_number'";
        return $this->db->query($query)->result();
    }

    public function get_data_row_personnel_by($personnel_number) {        
        $query = "SELECT EMP.name, EMP.personnel_number, EMP.email, (SELECT email FROM UNION_EMP WHERE personnel_number = EMP.report_to) AS email_superior FROM UNION_EMP AS EMP WHERE personnel_number = '$personnel_number'";
        return $this->db->query($query)->row_array();
    }

    public function get_gm_personnel_by($personnel_number)
    {
        $query   = "SELECT email FROM UNION_EMP WHERE presenttitle LIKE 'GM%' AND departement = (SELECT SUBSTRING(departement,1,3) FROM UNION_EMP WHERE personnel_number = '$personnel_number')";
        return $this->db->query($query);
    }


    public function show_ajax_scope_assesment($personnel_number) {
        $query = "SELECT personnel_number_fk,
                id_assesment_scope_fk
                FROM t_assesment
                WHERE 
                AND personnel_number_fk = '{$personnel_number}'";
        return $this->db->query($query);
    }       
}
/* End of file Model_users.php */
/* Location: ./application/modules/back_office/models/Model_users.php */