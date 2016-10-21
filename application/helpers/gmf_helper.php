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
	$query_data_emp ="SELECT TSH.PERNR,  TSH.UNIT FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH 
                  WHERE TSH.PERNR = '$personnel_number'";
                
    $data = $CI->db->query($query_data_emp)->row_array();
    $data_personnel = $data['PERNR'];
    $data_departement = $unit;           
    $date_time = new DateTime();        
    $date_now = $date_time->format('dmY');
    
    $query_date_apply = "SELECT request_number FROM t_apply_license";
    $data_apply = $CI->db->query($query_date_apply)->row_array();
    $request_number = $data_apply['request_number'];
   	//$kode = $data_departement.$data_personnel.$date_now;
    $kode = $data_departement;
                            
	$query      ="SELECT MAX(request_number) AS kode 
                  FROM t_apply_license";
                  
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

function kode_auto_deduction(){
	$CI =& get_instance();
	
	$query = "
		SELECT 
		MAX(id_deduction) AS kode 
		FROM deduction
	";
	$row = $CI->db->query($query)->row_array();
	$id = $row['kode'];
	$max_id = substr($id, 1,3);
	$plus = $max_id+1;
	if($plus<10){
		$kode = "D00".$plus;
	}
	else{
		$kode = "D0".$plus;
	}	
	
	return $kode;
}

function employee_number_auto(){
	$CI 	=& get_instance();			
	$reg 	= "";
	
	$CI->db->select('employee_number');
	$CI->db->from('employee');
	$CI->db->order_by('employee_number', 'desc');
	$CI->db->limit(1);
	$query = $CI->db->get();
	
	if ($query->num_rows()>0) {
		$rows = $query->row();
		$row_id = $rows->employee_number;
		$id_row = substr($row_id,8);
		$reg = $id_row+1;
		
		if (strlen($reg)==1){$reg='000'.$reg;} 
		elseif(strlen($reg)==2){$reg='00'.$reg;}
		elseif(strlen($reg)==3){$reg='0'.$reg;}
		else {$reg=$reg;}
		
		$reg=date("y").date("m").date("d").$reg;
	} 
	else{
		$reg=date("y").date("m").date("d").'0001';
	}
	return $reg;
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