<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){        
		$this->page->view('contact/contact_index');
	}   

	public 
    // -- Function Name : summary
        
    // -- Params : 
        
    // -- Purpose : 
    function send_email()
    {
        if (isset($_POST['send'])) {            
            $config        = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'mail.gmf-aeroasia.co.id',
                'smtp_port' => 25,
                'smtp_user' => 'app.notif',
                'smtp_pass' => 'app.notif',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );    
            $name                  	= $this->input->post('name');
            $email                  = $this->input->post('email');
            $subject				= $this->input->post('subject');
            $pesan					= $this->input->post('message');            
                 
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($name);
            $this->email->to('list-TQD@gmf-aeroasia.co.id');                                    
            $this->email->subject($subject);                          
            $this->email->message($pesan);
            if ($this->email->send()) {  
                $this->session->set_flashdata('content_not_valid', 'Send email successfull.');      
                redirect(site_url('home/index'));
            } else {                
                $this->session->set_flashdata('content_not_valid', 'Send email failed.');      
                redirect(site_url('home/index'));
            }
        } else {
            $this->session->set_flashdata('content_not_valid', 'Please click button "Send".');      
            redirect(site_url('home/index'));
        }
    } 
}
?>