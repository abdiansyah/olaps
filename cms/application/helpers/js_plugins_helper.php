<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function jquery_select2(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/select2/select2.min.css').'" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/select2/select2.full.min.js').'"></script>'."\n";
}

/* End of file js_plugins_helper.php */
/* Location: ./application/helpers/js_plugins_helper.php */