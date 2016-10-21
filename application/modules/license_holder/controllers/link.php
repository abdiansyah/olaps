<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}
	
	public function index() {
		$src = '';
		$title = '';
		$link_report = $this->uri->segment(3);
		
		if($link_report == 'basic_license_holder'){
			$src = 'http://intra.gmf-aeroasia.co.id/audit/develop/index.php';
			$title = 'Basic License Holder';
		}
		else if($link_report == 'weekly_reliability_report'){
			$src = 'http://192.168.40.101/reliability/TLPreport/weekly-real.php';
			$title = 'AMEL License Holder';
		}
		else if($link_report == 'monthly_reliability_report'){
			$src = 'http://192.168.40.101/reliability/TLPreport/index3.php';
			$title = 'Company Authorization Holder';
		}
		else if($link_report == 'cabin_reliability_report'){
			$src = 'http://192.168.40.101/reliability/Cabin/bin/Cabin.html';
			$title = 'EASA Authorization Holder';
		}
		else if($link_report == 'aircraft_maintenance_status'){
			$src = 'http://intra.gmf-aeroasia.co.id/ams_sda/';
			$title = 'Customer Authorization Holder';
		}
		else if($link_report == 'hil_report'){
			$src = 'http://intra-02.gmf-aeroasia.co.id/App_Realmon/frame.php?uname=dc.setyadi';
			$title = 'Stamp & C Holder';
		}
        else if($link_report == 'hil_report'){
			$src = 'http://intra-02.gmf-aeroasia.co.id/App_Realmon/frame.php?uname=dc.setyadi';
			$title = 'Find Stamp/ License Holder';
		}
		
		$this->page->view('link_index', array(
			'src'	=> $src,
			'ttl'	=> $title
		));
	}
	
	public function basic_license_holder(){
		$this->index();
	}

	public function weekly_reliability_report(){
		$this->index();
	}
	
	public function monthly_reliability_report(){
		$this->index();
	}
	
	public function cabin_reliability_report(){
		$this->index();
	}
	
	public function aircraft_maintenance_status(){
		$this->index();
	}
	
	public function aircraft_engine_ad_report(){
		$this->index();
	}	
	
	public function aircraft_engine_sb_report(){
		$this->index();
	}
	
	public function hil_report(){
		$this->index();
	}
	
}

/* End of file link_report.php */
/* Location: ./application/modules/master/controllers/link_report.php */