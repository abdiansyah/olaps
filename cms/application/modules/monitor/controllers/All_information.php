<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_information extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->page->use_directory();
        $this->load->model('model_monitor');                
    }
    
    public function index()
    {
        // $data['report']=$this->model_monitor->report();
        $this->page->view('index');
    }
    
}

/* End of file Category_information.php */
/* Location: ./application/modules/configure_cms/controllers/Category_information.php */