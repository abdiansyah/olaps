<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function jquery_select2(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/select2/select2.min.css').'" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/select2/select2.full.min.js').'"></script>'."\n";
}

function jquery_zebra_datepicker(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/zebra_datepicker/css/zebra_datepicker.css').'" type="text/css" />'."\n".
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/zebra_datepicker/css/zebra_datepicker.ext.css').'" type="text/css" />'."\n".
		'<script type="text/javascript" src="'.base_url('assets/plugins/zebra_datepicker/js/zebra_datepicker.js').'"></script>'."\n";
}

function multi_file(){
	return
		'<script type="text/javascript" src="'.base_url('assets/plugins/multifile_master/jQuery.MultiFile.min.js').'"></script>'."\n";
}

/* End of file js_plugins_helper.php */
/* Location: ./application/helpers/js_plugins_helper.php */