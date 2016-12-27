<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_monitor extends CI_Model
{
    public function __construct(){
        parent:: __construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function report(){
        $query = $this->db->query("SELECT COUNT(*) AS total_applicant, ('Open') AS status
                            from t_apply_license WHERE  status_submit = '1' AND status_approved_superior IS NULL
                            GROUP BY status_submit
                            UNION
                            SELECT COUNT(*) AS total_applicant, ('Progress') AS status
                            from t_apply_license WHERE status_submit = '1' AND status_approved_superior = '1' AND status_approved_quality IS NULL
                            GROUP BY status_approved_superior
                            UNION
                            SELECT COUNT(*) AS total_applicant, ('Verifikasi') AS status
                            from t_apply_license WHERE status_submit = '1' AND status_approved_superior = '1' AND status_approved_quality = '1' 
                            GROUP BY status_approved_quality 
        ");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
}

/* End of file model_category_information.php */
/* Location: ./application/modules/back_office/models/model_category_information.php */
