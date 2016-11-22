<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function angka($number){
	if ($number == '') $number = 0;
	return number_format($number, 0, ',', '.');
}

function my_number_format($number){
	if ($number == '') $number = 0;
	return number_format($number, 0, ',', '.');
}

function my_number_format_comma($number){
	if ($number == '') $number = 0;
	return number_format($number, 2, '.', ',');
}

function my_number_format_dot($number){
	if ($number == '') $number = 0;
	return number_format($number, 2, ',', '.');
}

function excel_header($filename){
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$filename");
	header("Pragma: no-cache");
	header("Expires: 0");
}

function connection_ftp() {
	$CI =& get_instance();
	$CI->load->library('ftp');                
	$ftp_config['hostname'] = '127.0.0.1'; 
	$ftp_config['username'] = 'yayas';
	$ftp_config['password'] = 'Bismillah';
	$ftp_config['debug']    = TRUE;    
	$CI->ftp->connect($ftp_config);  
}

function destroy_all_session_applicant () {
	$CI =& get_instance();
    $CI->session->unset_userdata('sess_data_personnel');
    $CI->session->unset_userdata('sess_license');
    $CI->session->unset_userdata('sess_license_garuda');
    $CI->session->unset_userdata('sess_license_citilink');
    $CI->session->unset_userdata('sess_license_sriwijaya');
    $CI->session->unset_userdata('sess_license_easa');
    $CI->session->unset_userdata('sess_license_special');
    $CI->session->unset_userdata('sess_with_garuda');
    $CI->session->unset_userdata('sess_with_citilink');
    $CI->session->unset_userdata('sess_with_sriwijaya');
}

function destroy_all_session_authorization_applicant () {
	$CI =& get_instance();    
    $CI->session->unset_userdata('sess_license');
    $CI->session->unset_userdata('sess_license_garuda');
    $CI->session->unset_userdata('sess_license_citilink');
    $CI->session->unset_userdata('sess_license_sriwijaya');
    $CI->session->unset_userdata('sess_license_easa');
    $CI->session->unset_userdata('sess_license_special');
    $CI->session->unset_userdata('sess_with_garuda');
    $CI->session->unset_userdata('sess_with_citilink');
    $CI->session->unset_userdata('sess_with_sriwijaya');
}

function form_data($names){
	$CI =& get_instance();

	foreach ($names as $name) {
		$prefix = substr($name, 0, 3);
	
		if ($prefix == 'num') {
			$name = substr($name, 4);
			$data[$name] = str_replace('.', '', $CI->input->post($name));
		}
		else {
			$data[$name] = $CI->input->post($name);
		}
	}
	
	return $data;
}

function newline(){
	echo "<br />";
}

function options($src, $id, $text_field){
	$options = '';
	foreach ($src->result() as $row) {
		$opt_value	= $row->$id;
		$text_value	= $row->$text_field;
		
		if ($row->$id == $ref_val) {
			$options .= '<option value="'.$opt_value.'" selected>'.$text_value.'</option>';
		}
		else {
			$options .= '<option value="'.$opt_value.'">'.$text_value.'</option>';
		}
	}
	return $options;
}

function password($raw_password) {
	return MD5('*123#'.$raw_password);
}

function anti_xss($source)
{
    $f=stripslashes(strip_tags(htmlspecialchars ($source,ENT_QUOTES)));
    return $f;
}

function result_to_arr($datasrc, $field) {
	$return_arr = array();
	foreach ($datasrc->result() as $row) {
		$return_arr[] = $row->$field;
	}
	return $return_arr;
}

function strip_comma($text) {
	return str_replace(',', '', $text);
}

function strip_dot($text) {
	return str_replace('.', '', $text);
}

function nama_format($text) {
    $nama = explode(' ',$text);
    if(!isset($nama[1])){
        return $nama[0];
    }else{
        return $nama[0].' '.$nama[1];
    }	
}

function tab(){
	echo "\t";
}

function terbilang($n) {
	$dasar = array(1 => 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam','Tujuh', 'Delapan', 'Sembilan');
	$angka = array(1000000000, 1000000, 1000, 100, 10, 1);
	$satuan = array('Milyar', 'Juta', 'Ribu', 'Ratus', 'Puluh', '');
	$str = '';
	$i = 0;

	if ($n == 0) {
		$str = 'Nol';
	}
	else {
		while ($n != 0) {
			$count = (int)($n / $angka[$i]);
			if ($count >= 10) {
				$str .= terbilang($count).' '.$satuan[$i].' ';
			}
			else if ($count > 0 AND $count < 10) {
				$str .= $dasar[$count].' '.$satuan[$i].' ';
			}
			$n -= $angka[$i] * $count;
			$i++;
		}
		$str = preg_replace("/Satu Puluh (\w+)/i", "\\1 belas", $str);
		$str = preg_replace("/Satu (Ribu|Ratus|Puluh|belas)/i", "se\\1", $str);
	}
	return $str;
}

function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);

	return $tanggal.' '.$bulan.' '.$tahun;		 
}	

function getBulan($bln){
	switch ($bln){
		case 1: return "Januari"; break;
		case 2:	return "Februari"; break;
		case 3:	return "Maret";	break;
		case 4:	return "April";	break;
		case 5:	return "Mei"; break;
		case 6:	return "Juni"; break;
		case 7:	return "Juli"; break;
		case 8:	return "Agustus"; break;
		case 9:	return "September";	break;
		case 10: return "Oktober"; break;
		case 11: return "November";	break;
		case 12: return "Desember";	break;
	}
}

function tgl_str($date){
	$exp = explode('-',$date);
	if(count($exp) == 3) {
		$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
	}
	return $date;
}

function tgl_sql($date){
	$exp = explode('-',$date);
	if(count($exp) == 3) {
		$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
	}
	return $date;
}

function kode_auto_apply($personnel_number='', $unit=''){
	$CI 	=& get_instance();    	
    $kode 	= $unit;
                            
	$query 	= "SELECT MAX(request_number) AS kode 
                  FROM t_apply_license WHERE code_unit = '$unit'";
                  
	$row = $CI->db->query($query)->row_array();
    //   
	$id     = $row['kode'];            
	$max_id = substr($id,-6);
	$plus = $max_id+1;           
    	if($plus<10){                
    		$kode = $kode."00000".$plus;
    	}else if($plus<100){                
    		$kode = $kode."0000".$plus;
    	}else if($plus<1000){                
    		$kode = $kode."000".$plus;
    	}else if($plus<10000){                
    		$kode = $kode."00".$plus;
    	}else if($plus<100000){                
    		$kode = $kode."0".$plus;
    	}else if($plus<1000000){                
    		$kode = $kode.$plus;
    	}	    
	return $kode;
}

function no_upload($personnel_number='', $code_file=''){
	$CI 		=& get_instance();        
                            
	$query      ="SELECT MAX(no_upload) AS no_upload 
                  FROM t_file_requirement WHERE personnel_number_fk = '$personnel_number' AND code_file = '$code_file'";
                  
	$row = $CI->db->query($query)->row_array();
    //   
	$id     = $row['no_upload'];            
	$max_id = substr($id,-6);
	$plus = $max_id+1;           
    	if($plus<10){                
    		$kode = "00000".$plus;
    	}else if($plus<100){                
    		$kode = "0000".$plus;
    	}else if($plus<1000){                
    		$kode = "000".$plus;
    	}else if($plus<10000){                
    		$kode = "00".$plus;
    	}else if($plus<100000){                
    		$kode = "0".$plus;
    	}else if($plus<1000000){                
    		$kode = $plus;
    	}	    
	return $kode;
}

/************************************ call JS *************************************************/
function jquery_chosen(){
	return
		'<link href="'.base_url('/assets/plugins/chosen/css/chosen.css').'" rel="stylesheet" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/chosen/js/chosen.jquery.min.js').'"></script>'."\n";
}

function jquery_select2(){
	return
		'<link href="'.base_url('/assets/plugins/select2/select2.css').'" rel="stylesheet" />'."\n".
		'<link href="'.base_url('/assets/plugins/select2/select2.ext.css').'" rel="stylesheet" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/select2/select2.min.js').'"></script>'."\n";
}


function bootstrap_datepicker(){
	return
		'<link href="'.base_url('/assets/plugins/bootstrap/css/bootstrap-datepicker.css').'" rel="stylesheet" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/bootstrap/js/bootstrap-datepicker.js').'"></script>'."\n";
}

function bootstrap_datetimepicker(){
	return
		'<link href="'.base_url('/assets/plugins/bootstrap/css/bootstrap-datetimepicker.css').'" rel="stylesheet" />'."\n".
		'<link href="'.base_url('/assets/plugins/bootstrap/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/bootstrap/js/bootstrap-datetimepicker.min.js').'"></script>'."\n";
}

function jquery_zebra_datepicker(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/zebra_datepicker/css/zebra_datepicker.css').'" type="text/css" />'."\n".
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/zebra_datepicker/css/zebra_datepicker.ext.css').'" type="text/css" />'."\n".
		'<script type="text/javascript" src="'.base_url('assets/plugins/zebra_datepicker/js/zebra_datepicker.js').'"></script>'."\n";
}
function jquery_bootstrap_timepicker(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/bootstrap/css/bootstrap-timepicker.css').'" type="text/css" />'."\n".		
		'<script type="text/javascript" src="'.base_url('assets/plugins/bootstrap/js/bootstrap-timepicker.min.js').'"></script>'."\n";
}
/************************************ end call JS *************************************************/


/* End of file minda_erp_helper.php */
/* Location: ./application/helpers/minda_erp_helper.php */