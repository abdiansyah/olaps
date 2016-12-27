<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Dashboard.php');
// -- Class Name : Apply_license
// -- Purpose : 
// -- Created On : 
class Apply_license extends CI_Controller
{
    // -- Function Name : __construct
    // -- Params : 
    // -- Purpose : 
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->model('m_apply_license');
        $this->load->model('home/m_home');
    }
    public 
    // -- Function Name : get_data_personnel_by
        
    // -- Params : $typeemp,$personnel_number
        
    // -- Purpose : 
    function get_data_personnel_by_gmf($personnel_number)
    {
        $this->m_apply_license->get_data_personnel_by_gmf($personnel_number);
    }

    function get_data_personnel_by_non_gmf($personnel_number)
    {
        $this->m_apply_license->get_data_personnel_by_non_gmf($personnel_number);
    }

    function cek_etops($id_spect)
    {
        $status = $this->m_apply_license->get_check_etops($id_spect);
        if($status != ''){
            die('1');
        }else{
            die('0');
        }
    }
    public 
    // -- Function Name : index
        
    // -- Params : 
        
    // -- Purpose : 
    function index()
    {
        $this->session->unset_userdata('sess_data_personnel');
        $this->session->unset_userdata('sess_license');
        $this->session->unset_userdata('sess_license_garuda');
        $this->session->unset_userdata('sess_license_citilink');
        $this->session->unset_userdata('sess_license_sriwijaya');
        $this->session->unset_userdata('sess_license_easa');
        $this->session->unset_userdata('sess_license_special');
        $this->session->unset_userdata('sess_with_garuda');
        $this->session->unset_userdata('sess_with_citilink');
        $this->session->unset_userdata('sess_with_sriwijaya');
        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('personnel_number', 'Personnel Number', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('name', 'Information', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('mobilephone', 'Mobile Phone', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('businessphone', 'Business Phone', 'required|trim|max_length[30]');
        if (isset($_POST['submitpersonnelinformation'])) {
            if ($this->form_validation->run() == false) {
                $data['user_data'] = $this->session->userdata('users_applicant');
                $this->page->view('personnel_information', $data);
            } else {
                $sess_data_personnel = array(
                    'submitpersonnelinformation' => $this->input->post('submitpersonnelinformation'),
                    'typeemp' => $this->input->post('typeemp'),
                    'personnel_number' => $this->input->post('personnel_number'),
                    'name' => $this->input->post('name'),
                    'presenttitle' => $this->input->post('presenttitle'),
                    'departement' => $this->input->post('departement'),
                    'email' => $this->input->post('email'),
                    'dateofbirth' => $this->input->post('dateofbirth'),
                    'dateofemployee' => $this->input->post('dateofemployee'),
                    'formaleducation' => $this->input->post('formaleducation'),
                    'mobilephone' => $this->input->post('mobilephone'),
                    'businessphone' => $this->input->post('businessphone'),
                    'validitycontract' => $this->input->post('validitycontract'),
                    'personnel_number_superior' => $this->input->post('personnel_number_superior')
                );
                $personnel_number    = $this->input->post('personnel_number');
                if ($this->m_apply_license->get_all_data_contact_personnel($personnel_number) == 0) {
                    $data_personnel_gmf = array(
                        'personnel_number_fk' => $this->input->post('personnel_number'),
                        'mobilephone' => $this->input->post('mobilephone'),
                        'businessphone' => $this->input->post('businessphone')
                    );
                    $this->db->insert('m_contact_employee', $data_personnel_gmf);
                }
                $this->session->set_userdata('sess_data_personnel', $sess_data_personnel);
                $data['data_personnel_information'] = $this->session->userdata('sess_data_personnel');
                $data['auth_license']               = $this->db->order_by('name_t', 'ASC')->get('m_auth_license')->result();
                $this->page->view('authorization_request', $data);
                return true;
            }
        } else {
            $data['user_data'] = $this->session->userdata('users_applicant');
            $this->page->view('personnel_information', $data);
        }
    }
    public 
    // -- Function Name : authorization_request
        
    // -- Params : 
        
    // -- Purpose : 
    function authorization_request()
    {
        $this->session->unset_userdata('sess_license');
        $this->session->unset_userdata('sess_license_garuda');
        $this->session->unset_userdata('sess_license_citilink');
        $this->session->unset_userdata('sess_license_sriwijaya');
        $this->session->unset_userdata('sess_license_easa');
        $this->session->unset_userdata('sess_license_special');
        $this->session->unset_userdata('sess_with_garuda');
        $this->session->unset_userdata('sess_with_citilink');
        $this->session->unset_userdata('sess_with_sriwijaya');
        $this->form_validation->set_error_delimiters('', '<br>');
        $this->form_validation->set_rules('status', 'Reason of apply', 'required|trim|min_length[1]');
        $this->form_validation->set_rules('license', 'Authorization', 'required|trim|min_length[1]');
        if (isset($_POST['submitauthorizationrequest'])) {
            if ($this->form_validation->run() == false) {
                $data['status_validation_authorization_request'] = validation_errors();
                $data['user_data']                               = $this->session->userdata('users_applicant');
                $this->page->view('personnel_information', $data);
            } else {
                $status_license                  = $this->input->post('status');
                $sess_data_authorization_request = array(
                    'submitauthorizationrequest' => $this->input->post('submitauthorizationrequest')
                );
                $this->session->set_userdata('sess_data_authorization_request', $sess_data_authorization_request);
                switch (@$status_license) {
                    case $status_license == 1:
                        $field = 'AND mgsc.new_auth = 1';
                        break;
                    case $status_license == 2:
                        $field = 'AND mgsc.renewal = 1';
                        break;
                    case $status_license == 3:
                        $field = 'AND mgsc.additional = 1';
                        break;
                    case $status_license == 4:
                        $field = 'AND mgsc.ratting_change = 1';
                        break;
                }
                $spect_general          = $this->input->post('tab_spect');
                // Session License Authorization
                $sess_license           = array(
                    'status_license'            => $this->input->post('status'),
                    'license'                   => $this->input->post('license'),
                    'type'                      => $this->input->post('type'),
                    'tab_spec_s'                => $this->input->post('tab-spec'),
                    'tab_category_s'            => $this->input->post('tab-category'),
                    'tab_scope_s'               => $this->input->post('tab-scope'),
                    'tab_scope_assesment_s'     => $this->input->post('tab-scope-assesment'),
                    'etops_s'                   => $this->input->post('etops'),
                    'no' => 1
                );
                $sess_license_garuda    = array(
                    'license'                           => $this->input->post('license'),
                    'type_check_23'                     => $this->input->post('type_check_23'),
                    'tab_spec_license_garuda_s'         => $this->input->post('tab-spec-license-garuda'),
                    'tab_category_license_garuda_s'     => $this->input->post('tab-category-license-garuda'),
                    'tab_scope_license_garuda_s'        => $this->input->post('tab-scope-license-garuda'),
                    'tab_scope_assesment_license_garuda_s' => $this->input->post('tab-scope-assesment-license-garuda'),
                    'etops_license_garuda_s'            => $this->input->post('etops-license-garuda'),
                );
                $sess_license_citilink  = array(
                    'license'                           => $this->input->post('license'),
                    'type_check_24'                     => $this->input->post('type_check_24'),
                    'tab_spec_license_citilink_s'       => $this->input->post('tab-spec-license-citilink'),
                    'tab_category_license_citilink_s'   => $this->input->post('tab-category-license-citilink'),
                    'tab_scope_license_citilink_s'      => $this->input->post('tab-scope-license-citilink'),
                    'tab_scope_assesment_license_citilink_s' => $this->input->post('tab-scope-assesment-license-citilink'),
                    'etops_license_citilink_s'          => $this->input->post('etops-license-citilink'),
                );
                $sess_license_sriwijaya = array(
                    'license'                           => $this->input->post('license'),
                    'type_check_25'                     => $this->input->post('type_check_25'),
                    'tab_spec_license_sriwijaya_s'      => $this->input->post('tab-spec-license-sriwijaya'),
                    'tab_category_license_sriwijaya_s'  => $this->input->post('tab-category-license-sriwijaya'),
                    'tab_scope_license_sriwijaya_s'     => $this->input->post('tab-scope-license-sriwijaya'),
                    'tab_scope_assesment_license_sriwijaya_s' => $this->input->post('tab-scope-assesment-license-sriwijaya'),
                    'etops_license_sriwijaya_s'         => $this->input->post('etops-license-sriwijaya'),
                );
                $this->session->set_userdata('sess_license', $sess_license);
                $this->session->set_userdata('sess_license_garuda', $sess_license_garuda);
                $this->session->set_userdata('sess_license_citilink', $sess_license_citilink);
                $this->session->set_userdata('sess_license_sriwijaya', $sess_license_sriwijaya);
                // License Authorization
                $personnel_number                 = $this->input->post('personnel_number');
                $license                          = $this->input->post('license');
                $type                             = $this->input->post('type');
                $type_check_23                    = $this->input->post('type_check_23');
                $type_check_24                    = $this->input->post('type_check_24');
                $type_check_25                    = $this->input->post('type_check_25');
                $check_easa                       = $this->input->post('check_easa');
                $type_easa                        = $this->input->post('type_easa');
                $check_special                    = $this->input->post('check_special');
                $tab_spec_s                       = $this->input->post('tab-spec');
                $tab_category_s                   = $this->input->post('tab-category');
                $tab_scope_s                      = $this->input->post('tab-scope');
                $tab_spec_license_garuda_s        = $this->input->post('tab-spec-license-garuda');
                $tab_spec_license_citilink_s      = $this->input->post('tab-spec-license-citilink');
                $tab_spec_license_sriwijaya_s     = $this->input->post('tab-spec-license-sriwijaya');
                $tab_category_license_garuda_s    = $this->input->post('tab-category-license-garuda');
                $tab_category_license_citilink_s  = $this->input->post('tab-category-license-citilink');
                $tab_category_license_sriwijaya_s = $this->input->post('tab-category-license-sriwijaya');
                $tab_scope_license_garuda_s       = $this->input->post('tab-scope-license-garuda');
                $tab_scope_license_citilink_s     = $this->input->post('tab-scope-license-citilink');
                $tab_scope_license_sriwijaya_s    = $this->input->post('tab-scope-license-sriwijaya');
                $no                               = 1;
                $additional_general_certificate   = $this->m_apply_license->query_general_certificate($personnel_number, $license, $type, $type_check_23, $type_check_24, $type_check_25, $check_easa, $type_easa, $check_special)->result();
                foreach ($additional_general_certificate as $row) {
                    @$data_general_certificate .= '<tr>
                    <td><label>' . $no . '</label></td>                        
                    <td>' . $row->name_t . '</td>';
                    if ($row->category_continous == 'Recurrent') {
                        @$data_general_certificate .= '<td><input type="text" class="date_training_req_general_certificate" id="date_training_req_general_certificate_' . $no . '" value = "' . @$row->date_training . '"/></td>
                        <td><input type="hidden" class="expiration_date_req_general_certificate" id="expiration_date_req_general_certificate_' . $no . '" value="' . $row->age_requirement . '"/>                                                                    
                        <input type="text" class="label_result_expiration_date_req_general_certificate" id="label_result_expiration_date_req_general_certificate_' . $no . '" value = "' . @$row->expiration_date . '" disabled/></td>';
                    } else if ($row->category_continous == 'Non Recurrent') {
                        @$data_general_certificate .= '<td><input type="text" class="date_training_req_general_certificate" id="date_training_req_general_certificate_' . $no . '" value = "' . @$row->date_training . '" />                        
                        </td>
                        <td>&nbsp;</td>';
                    }                       
                    @$data_general_certificate .= '<td><input type="hidden" id="code_req_document_certificate_' . $no . '" value="' . $row->code_t . '"/>
                        <input type="hidden" id="date_req_document_certificate_' . $no . '" />
                        <input type="hidden" id="time_req_document_certificate_' . $no . '" />
                        <input type="hidden" value = "' . @$row->expiration_date . '" class="save_result_expiration_date_req_general_certificate" id="save_result_expiration_date_req_general_certificate_' . $no . '"/>';

                        if (!empty($row->code_file)) {
                            $data_general_certificate .='<input type="file" class="file_req_document_certificate" id="file_req_document_certificate_' . $no . '"/> 
                            <b id="msg_document_certificate_' . $no . '"></b>                           
                            </b>';
                        } else {
                            $data_general_certificate .='<input type="file" class="file_req_document_certificate" id="file_req_document_certificate_' . $no . '"/>
                            <b id="msg_document_certificate_' . $no . '">
                            </b>';
                        }
                    $data_general_certificate .= '</td><td width="20%">';
                        if (!empty($row->code_file)) {
                            $data_general_certificate .= '<div class="progressbox"><div id="progressbar_document_certificate_' . $no . '" class="progress" style="background:blue"></div>100%</div ></div>
                                <input type="hidden" id="status_upload_'. $no .'" value="1">
                                </td>
                                <td><img class="status_file_document_certificate" id="status_file_document_certificate_' . $no . '" height="30" src = "'. base_url('/assets/images/property/check.png') .'"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_document_certificate" id="empty_file_document_certificate_' . $no . '" height="30"/>
                                <br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/></td> 
                                </tr>';                                            
                            } else {
                            $data_general_certificate .= '<div id="progressbar_document_certificate_' . $no . '" class="progress">
                                <div id="statustxt_document_certificate_' . $no . '" class="statustxt_document_certificate">0%</div ></div>
                                </td>
                                <td><img class="status_file_document_certificate" id="status_file_document_certificate_' . $no . '" height="30"/> &nbsp; <img class="empty_file_document_certificate" id="empty_file_document_certificate_' . $no . '" height="30"/>
                                <br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                </td> 
                                </tr>';
                            }                                                         
                    
                    $no++;
                }
                if (is_array($tab_scope_s) || is_object($tab_scope_s)) {
                    foreach ($tab_scope_s as $key => $value) {
                        $tab_category             = $tab_category_s[$key];
                        $tab_spec                 = $tab_spec_s[$key];
                        $tab_scope                = $value;
                        $additional_specification = $this->m_apply_license->query_specification($personnel_number, $license, $type, $tab_spec, $tab_category
                            , $tab_scope, $field)->result();
                        $additional_specification_document = $this->m_apply_license->query_specification_document($personnel_number, $license, $type, $tab_spec, $tab_category, $tab_scope, $field)->result();
                        foreach ($additional_specification as $value) {
                            @$data_req_specific .= '<tr>
                            <td><label>' . $no . '</label> </td>
                            <td  class="label_req_spec">' . $value->name_t . '</td>';
                                if ($value->category_continous == 'Recurrent') {
                                    @$data_req_specific .= '<td><input type="text" class="date_training_req_spec_certificate" id="date_training_req_spec_certificate_' . $no . '" value = "' . @$value->date_training . '"/></td>
                            <td><input type="hidden" class="expiration_date_req_spec_certificate" id="expiration_date_req_spec_certificate_' . $no . '"  value="' . $value->age_requirement . '"/>                        
                            <input type="text" value="' . $value->expiration_date . '" class="label_result_expiration_date_req_spec_certificate" id="label_result_expiration_date_req_spec_certificate_' . $no . '" disabled />
                            </td>
                            <td>';
                                if (!empty($value->code_file)) {
                                    $data_req_specific .= '<input type="file" class="file_req_spec_certificate" id="file_req_spec_certificate_' . $no . '"  disabled/>
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                        </td>';
                                    } else {
                                    $data_req_specific .= '<input type="file" class="file_req_spec_certificate" id="file_req_spec_certificate_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                    </td>';
                                    }

                            } else if ($value->category_continous == 'Non Recurrent') {
                                @$data_req_specific .= '<td><input type="text" class="date_training_req_spec_certificate" id="date_training_req_spec_certificate_' . $no . '" value = "' . @$value->date_training . '"/></td>
                                <td>&nbsp;</td>
                                <td>
                                <input type="file" class="file_req_spec_certificate" id="file_req_spec_certificate_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            } else if ($value->category_continous == 'New') {
                                @$data_req_specific .= '<td></td>
                                <td></td>
                                <td><input type="file"  class="file_general_spec_certificate" id="file_req_spec_certificate_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b></td>'; 
                            } else if ($value->category_continous == '-') {
                                @$data_req_specific .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_general_spec_certificate" id="file_req_spec_certificate_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b></td>';
                            };
                                @$data_req_specific .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_' . $no . '" value="' . $value->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate" id="save_result_expiration_date_req_spec_certificate_' . $no . '"  value="' . $value->expiration_date . '"/>';
                                if (!empty($value->code_file)) {
                                    $data_req_specific .= '<div class="progressbox"><div id="progressbar_req_certificate_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_' . $no . '" class="statustxt_req_certificate">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate" id="status_file_req_certificate_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate" id="empty_file_req_certificate_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific .= '<div class="progressbox"><div id="progressbar_req_certificate_' . $no . '" class="progress"></div><div id="statustxt_req_certificate_' . $no . '" class="statustxt_req_certificate">0%</div ></div></td>
                                    <td><img class="status_file_req_certificate" id="status_file_req_certificate_' . $no . '" height="30"/> &nbsp; <img class="empty_file_req_certificate" id="empty_file_req_certificate_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // License check garuda (no with)
                if (is_array($tab_scope_license_garuda_s) || is_object($tab_scope_license_garuda_s)) {
                    foreach ($tab_scope_license_garuda_s as $key => $value) {
                        $tab_category_license_garuda             = $tab_category_license_garuda_s[$key];
                        $tab_spec_license_garuda                 = $tab_spec_license_garuda_s[$key];
                        $tab_scope_license_garuda                = $value;
                        $additional_specification_license_garuda = $this->m_apply_license->query_specification($personnel_number, $license, $type_check_23, $tab_spec_license_garuda, $tab_category_license_garuda, $tab_scope_license_garuda, $field)->result();
                        $additional_specification_license_garuda_document = $this->m_apply_license->query_specification_document($personnel_number, $license, $type_check_23, $tab_spec_license_garuda, $tab_category_license_garuda, $tab_scope_license_garuda, $field)->result();
                        foreach ($additional_specification_license_garuda as $value) {
                            @$data_req_specific_license_garuda .= '<tr>
                        <td><label>' . $no . '</label> </td>
                        <td class="label_req_spec">' . $value->name_t . '</td>';
                            if ($value->category_continous == 'Non Recurrent') {
                                @$data_req_specific_license_garuda .= '
                                <td><input type="text" class="date_training_req_spec_certificate_license_garuda" id="date_training_req_spec_certificate_license_garuda_' . $no . '"  value = "' . @$value->date_training . '"/></td>
                                <td>&nbsp;</td>                            
                                <td>
                                <input type="file" class="file_req_spec_certificate_license_garuda" id="file_req_spec_certificate_license_garuda_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            } else if ($value->category_continous == 'Recurrent') {
                                @$data_req_specific_license_garuda .= '<td><input type="text" class="date_training_req_spec_certificate_license_garuda" id="date_training_req_spec_certificate_license_garuda_' . $no . '"  value = "' . @$value->date_training . '"/></td>
                            <td><input type="hidden" class="expiration_date_req_spec_certificate_license_garuda" id="expiration_date_req_spec_certificate_license_garuda_' . $no . '" value="' . $value->age_requirement . '"/>
                            <input type="hidden" class="result_expiration_date_req_spec_certificate_license_garuda" id="result_expiration_date_req_spec_certificate_license_garuda_' . $no . '" />
                            <input type="text" class="label_result_expiration_date_req_spec_certificate_license_garuda" id="label_result_expiration_date_req_spec_certificate_license_garuda_' . $no . '" value="' . $value->expiration_date . '" disabled/>
                            </td>
                            <td>
                            <input type="file" class="file_req_spec_certificate_license_garuda" id="file_req_spec_certificate_license_garuda_' . $no . '" />
                            <b id="msg_document_certificate_' . $no . '"></b>
                            </td>';
                            } else if ($value->category_continous == 'New') {
                                @$data_req_specific_license_garuda .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_license_garuda" id="file_req_spec_certificate_license_garuda_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>'; 
                            } else if ($value->category_continous == '-') {
                                @$data_req_specific_license_garuda .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_license_garuda" id="file_req_spec_certificate_license_garuda_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            };
                            @$data_req_specific_license_garuda .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_license_garuda_' . $no . '" value="' . $value->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_license_garuda_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_license_garuda_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_license_garuda" id="save_result_expiration_date_req_spec_certificate_license_garuda_' . $no . '" value="' . $value->expiration_date . '"/>';
                                if (!empty($value->code_file)) {
                                    $data_req_specific_license_garuda .= '<div class="progressbox"><div id="progressbar_req_certificate_license_garuda_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_license_garuda_' . $no . '" class="statustxt_req_certificate_license_garuda">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_license_garuda" id="status_file_req_certificate_license_garuda_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_license_garuda" id="empty_file_req_certificate_license_garuda_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_license_garuda .= '<div class="progressbox">
                                    <div id="progressbar_req_certificate_license_garuda_' . $no . '" class="progress"></div>
                                    <div id="statustxt_req_certificate_license_garuda_' . $no . '" class="statustxt_req_certificate_license_garuda">0%</div >
                                    </div></td>
                                    <td><img class="status_file_req_certificate_license_garuda" id="status_file_req_certificate_license_garuda_' . $no . '" height="30"/> &nbsp; 
                                    <img class="empty_file_req_certificate_license_garuda" id="empty_file_req_certificate_license_garuda_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // License check citilink (no with)    
                if (is_array($tab_scope_license_citilink_s) || is_object($tab_scope_license_citilink_s)) {
                    foreach ($tab_scope_license_citilink_s as $key => $value) {
                        $tab_category_license_citilink             = $tab_category_license_citilink_s[$key];
                        $tab_spec_license_citilink                 = $tab_spec_license_citilink_s[$key];
                        $tab_scope_license_citilink                = $value;
                        $additional_specification_license_citilink = $this->m_apply_license->query_specification($personnel_number, $license, $type_check_24, $tab_spec_license_citilink, $tab_category_license_citilink, $tab_scope_license_citilink, $field)->result();
                        foreach ($additional_specification_license_citilink as $value) {
                            @$data_req_specific_license_citilink .= '<tr>
                        <td><label>' . $no . '</label> </td>
                        <td class="label_req_spec">' . $value->name_t . '</td>';
                            if ($value->category_continous == 'Non Recurrent') {
                                @$data_req_specific_license_citilink .= '
                                <td><input type="text" class="date_training_req_spec_certificate_license_citilink" id="date_training_req_spec_certificate_license_citilink_' . $no . '" value = "' . @$value->date_training . '"/></td>
                                <td>&nbsp;</td>
                                <td><input type="file" class="file_req_spec_certificate_license_citilink" id="file_req_spec_certificate_license_citilink_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            } else if ($value->category_continous == 'Recurrent') {
                                @$data_req_specific_license_citilink .= '<td><input type="text" class="date_training_req_spec_certificate_license_citilink" id="date_training_req_spec_certificate_license_citilink_' . $no . '" value = "' . @$value->date_training . '" /></td>
                                <td><input type="hidden" class="expiration_date_req_spec_certificate_license_citilink" id="expiration_date_req_spec_certificate_license_citilink_' . $no . '" value="' . $value->age_requirement . '"/>
                                <input type="hidden" class="result_expiration_date_req_spec_certificate_license_citilink" id="result_expiration_date_req_spec_certificate_license_citilink_' . $no . '" />
                                <input type="text" class="label_result_expiration_date_req_spec_certificate_license_citilink" id="label_result_expiration_date_req_spec_certificate_license_citilink_' . $no . '" value="' . $value->expiration_date . '" disabled/>
                                </td>
                                <td>
                                <input type="file" class="file_req_spec_certificate_license_citilink" id="file_req_spec_certificate_license_citilink_' . $no . '"/>
                                <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            } else if ($value->category_continous == 'New') {
                                @$data_req_specific_license_citilink .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_license_citilink" id="file_req_spec_certificate_license_citilink_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>'; 
                            } else if ($value->category_continous == '-') {
                                @$data_req_specific_license_citilink .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_license_citilink" id="file_req_spec_certificate_license_citilink_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            };
                            @$data_req_specific_license_citilink .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_license_citilink_' . $no . '" value="' . $value->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_license_citilink_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_license_citilink_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_license_citilink" id="save_result_expiration_date_req_spec_certificate_license_citilink_' . $no . '" value="' . $value->expiration_date . '"/>';
                                if (!empty($value->code_file)) {
                                    $data_req_specific_license_citilink .= '<div class="progressbox"><div id="progressbar_req_certificate_license_citilink_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_license_citilink_' . $no . '" class="statustxt_req_certificate_license_citilink">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_license_citilink" id="status_file_req_certificate_license_citilink_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_license_citilink" id="empty_file_req_certificate_license_citilink_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_license_citilink .= '<div class="progressbox">
                                    <div id="progressbar_req_certificate_license_citilink_' . $no . '" class="progress"></div>
                                    <div id="statustxt_req_certificate_license_citilink_' . $no . '" class="statustxt_req_certificate_license_citilink">0%</div >
                                    </div></td>
                                    <td><img class="status_file_req_certificate_license_citilink" id="status_file_req_certificate_license_citilink_' . $no . '" height="30"/> &nbsp; 
                                    <img class="empty_file_req_certificate_license_citilink" id="empty_file_req_certificate_license_citilink_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // License check sriwijaya (no with)    
                if (is_array($tab_scope_license_sriwijaya_s) || is_object($tab_scope_license_sriwijaya_s)) {
                    foreach ($tab_scope_license_sriwijaya_s as $key => $value) {
                        $tab_category_license_sriwijaya             = $tab_category_license_sriwijaya_s[$key];
                        $tab_spec_license_sriwijaya                 = $tab_spec_license_sriwijaya_s[$key];
                        $tab_scope_license_sriwijaya                = $value;
                        $additional_specification_license_sriwijaya = $this->m_apply_license->query_specification($personnel_number, $license, $type_check_25, $tab_spec_license_sriwijaya, $tab_category_license_sriwijaya, $tab_scope_license_sriwijaya, $field)->result();
                        foreach ($additional_specification_license_sriwijaya as $value) {
                            @$data_req_specific_license_sriwijaya .= '<tr>
                            <td><label>' . $no . '</label> </td>
                            <td class="label_req_spec">' . $value->name_t . '</td>';
                            if ($value->category_continous == 'Non Recurrent') {
                                @$data_req_specific_license_sriwijaya .= '
                                <td><input type="text" class="date_training_req_spec_certificate_license_sriwijaya" id="date_training_req_spec_certificate_license_sriwijaya_' . $no . '" value = "' . @$value->date_training . '"/></td>
                                <td>&nbsp;</td>
                                <td><input type="file" class="file_req_spec_certificate_license_sriwijaya" id="file_req_spec_certificate_license_sriwijaya_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            } else if ($value->category_continous == 'Recurrent') {
                                @$data_req_specific_license_sriwijaya .= '<td><input type="text" class="date_training_req_spec_certificate_license_sriwijaya" id="date_training_req_spec_certificate_license_sriwijaya_' . $no . '" value = "' . @$value->date_training . '"/></td>
                            <td><input type="hidden" class="expiration_date_req_spec_certificate_license_sriwijaya" id="expiration_date_req_spec_certificate_license_sriwijaya_' . $no . '" value="' . $value->age_requirement . '"/>
                            <input type="hidden" class="result_expiration_date_req_spec_certificate_license_sriwijaya" id="result_expiration_date_req_spec_certificate_license_sriwijaya_' . $no . '" />
                            <input type="text" class="label_result_expiration_date_req_spec_certificate_license_sriwijaya" id="label_result_expiration_date_req_spec_certificate_license_sriwijaya_' . $no . '" value="' . $value->expiration_date . '" disabled/>
                            </td>
                            <td>
                            <input type="file" class="file_req_spec_certificate_license_sriwijaya" id="file_req_spec_certificate_license_sriwijaya_' . $no . '"/>
                            <b id="msg_document_certificate_' . $no . '"></b>
                            </td>';
                            } else if ($value->category_continous == 'New') {
                                @$data_req_specific_license_sriwijaya .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_license_sriwijaya" id="file_req_spec_certificate_license_sriwijaya_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>'; 
                            } else if ($value->category_continous == '-') {
                                @$data_req_specific_license_sriwijaya .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_license_sriwijaya" id="file_req_spec_certificate_license_sriwijaya_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            };
                            @$data_req_specific_license_sriwijaya .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_license_sriwijaya_' . $no . '" value="' . $value->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_license_sriwijaya_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_license_sriwijaya_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_license_sriwijaya" id="save_result_expiration_date_req_spec_certificate_license_sriwijaya_' . $no . '" value="' . $value->expiration_date . '"/>';
                                if (!empty($value->code_file)) {
                                    $data_req_specific_license_sriwijaya .= '<div class="progressbox"><div id="progressbar_req_certificate_license_sriwijaya_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_license_sriwijaya_' . $no . '" class="statustxt_req_certificate_license_sriwijaya">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_license_sriwijaya" id="status_file_req_certificate_license_sriwijaya_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_license_sriwijaya" id="empty_file_req_certificate_license_sriwijaya_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_license_sriwijaya .= '<div class="progressbox">
                                    <div id="progressbar_req_certificate_license_sriwijaya_' . $no . '" class="progress"></div>
                                    <div id="statustxt_req_certificate_license_sriwijaya_' . $no . '" class="statustxt_req_certificate_license_sriwijaya">0%</div >
                                    </div></td>
                                    <td><img class="status_file_req_certificate_license_sriwijaya" id="status_file_req_certificate_license_sriwijaya_' . $no . '" height="30"/> &nbsp; 
                                    <img class="empty_file_req_certificate_license_sriwijaya" id="empty_file_req_certificate_license_sriwijaya_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // With other license
                // Session License EASA 
                $sess_license_easa = array(
                    'check_easa' => $this->input->post('check_easa'),
                    'type_easa' => $this->input->post('type_easa'),
                    'tab_spec_easa_s' => $this->input->post('tab-spec-easa'),
                    'tab_category_easa_s' => $this->input->post('tab-category-easa'),
                    'tab_scope_easa_s' => $this->input->post('tab-scope-easa'),
                    'tab_scope_assesment_easa_s' => $this->input->post('tab-scope-assesment-easa'),
                    'etops_easa_s'                 => $this->input->post('etops-easa'),
                );
                $this->session->set_userdata('sess_license_easa', $sess_license_easa);
                // License with EASA
                $check_easa          = $this->input->post('check_easa');
                $type_easa           = $this->input->post('type_easa');
                $tab_spec_easa_s     = $this->input->post('tab-spec-easa');
                $tab_category_easa_s = $this->input->post('tab-category-easa');
                $tab_scope_easa_s    = $this->input->post('tab-scope-easa');
                if (is_array($tab_scope_easa_s) || is_object($tab_scope_easa_s)) {
                    foreach ($tab_scope_easa_s as $key_easa => $value_easa) {
                        $tab_category_easa             = $tab_category_easa_s[$key_easa];
                        $tab_spec_easa                 = $tab_spec_easa_s[$key_easa];
                        $tab_scope_easa                = $value_easa;
                        $additional_specification_easa = $this->m_apply_license->query_specification($personnel_number, $check_easa, $type_easa, $tab_spec_easa, $tab_category_easa, $tab_scope_easa, $field)->result();
                        foreach ($additional_specification_easa as $value_easa) {
                            @$data_req_specific_easa .= '<tr>
                        <td><label>' . $no . '</label></td>
                        <td class="label_req_spec">' . $value_easa->name_t . '</td>';
                            if ($value_easa->category_continous == 'Non Recurrent') {
                                @$data_req_specific_easa .= '
                                <td><input type="text" class="date_training_req_spec_certificate_easa" id="date_training_req_spec_certificate_easa_' . $no . '" value = "' . @$value_easa->date_training . '"/></td>
                                <td>&nbsp;</td>
                                <td>
                                <input type="file" class="file_req_spec_certificate_easa" id="file_req_spec_certificate_easa_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            } else if ($value_easa->category_continous == 'Recurrent') {
                                @$data_req_specific_easa .= '<td><input type="text" class="date_training_req_spec_certificate_easa" id="date_training_req_spec_certificate_easa_' . $no . '" value = "' . @$value_easa->date_training . '"/></td>
                        <td><input type="hidden" class="expiration_date_req_spec_certificate_easa" id="expiration_date_req_spec_certificate_easa_' . $no . '" value="' . $value_easa->age_requirement . '"/>
                        <input type="hidden" class="result_expiration_date_req_spec_certificate_easa" id="result_expiration_date_req_spec_certificate_easa_' . $no . '"/>
                        <input type="text" value="' . $value_easa->expiration_date . '" class="label_result_expiration_date_req_spec_certificate_easa" id="label_result_expiration_date_req_spec_certificate_easa_' . $no . '" disabled />
                        </td>
                        <td>
                        <input type="file" class="file_req_spec_certificate_easa" id="file_req_spec_certificate_easa_' . $no . '" />
                        <b id="msg_document_certificate_' . $no . '"></b>
                        </td>';
                            } else if ($value_easa->category_continous == 'New') {
                                @$data_req_specific_easa .= '<td></td>
                                <td></td>
                                <td>
                                <input type="file" class="file_req_general_certificate_easa" id="file_req_spec_certificate_easa_' . $no . '"/>
                                <b id="msg_document_certificate_' . $no . '"></b>
                                </td>'; 
                            } else if ($value_easa->category_continous == '-') {
                                @$data_req_specific_easa .= '<td></td>
                                <td></td>
                                <td>
                                <input type="file" class="file_req_general_certificate_easa" id="file_req_spec_certificate_easa_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            };
                           @$data_req_specific_easa .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_easa_' . $no . '" value="' . $value_easa->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_easa_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_easa_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_easa" id="save_result_expiration_date_req_spec_certificate_easa_' . $no . '" value="' . $value_easa->expiration_date . '"/>';
                                if (!empty($value_easa->code_file)) {
                                    $data_req_specific_easa .= '<div class="progressbox"><div id="progressbar_req_certificate_easa_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_easa_' . $no . '" class="statustxt_req_certificate_easa">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_easa" id="status_file_req_certificate_easa_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_easa" id="empty_file_req_certificate_easa_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_easa .= '<div class="progressbox"><div id="progressbar_req_certificate_easa_' . $no . '" class="progress"></div><div id="statustxt_req_certificate_easa_' . $no . '" class="statustxt_req_certificate_easa">0%</div ></div></td>
                                    <td><img class="status_file_req_certificate_easa" id="status_file_req_certificate_easa_' . $no . '" height="30"/> &nbsp; <img class="empty_file_req_certificate_easa" id="empty_file_req_certificate_easa_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // Session License Special
                $sess_license_special = array(
                    'license' => $this->input->post('license'),
                    'check_special' => $this->input->post('check_special'),
                    'tab_spec_special_s' => $this->input->post('tab-spec-special'),
                    'tab_category_special_s' => $this->input->post('tab-category-special'),
                    'tab_scope_special_s' => $this->input->post('tab-scope-special'),
                    'tab_scope_assesment_special_s' => $this->input->post('tab-scope-assesment-special'),
                    'etops_special_s'                 => $this->input->post('etops-special'),
                );
                $this->session->set_userdata('sess_license_special', $sess_license_special);
                // License with SPECIAL
                $license                = $this->input->post('license');
                $check_special          = $this->input->post('check_special');
                $tab_spec_special_s     = $this->input->post('tab-spec-special');
                $tab_category_special_s = $this->input->post('tab-category-special');
                $tab_scope_special_s    = $this->input->post('tab-scope-special');
                if (is_array($tab_scope_special_s) || is_object($tab_scope_special_s)) {
                    foreach ($tab_scope_special_s as $key_special => $value_special) {
                        $tab_category_special             = $tab_category_special_s[$key_special];
                        $tab_spec_special                 = $tab_spec_special_s[$key_special];
                        $tab_scope_special                = $value_special;
                        //$query_specification_special = array();                    
                        $additional_specification_special = $this->m_apply_license->query_specification($personnel_number, $license, $check_special, $tab_spec_special, $tab_category_special, $tab_scope_special, $field)->result();
                        foreach ($additional_specification_special as $value_special) {
                            @$data_req_specific_special .= '<tr><td><label>' . $no . '</label></td>                                                                                                
                            <td class="label_req_spec">' . $value_special->name_t . '</td>';
                            if ($value_special->category_continous == 'Non Recurrent') {
                                @$data_req_specific_special .= '<td><input type="text" class="date_training_req_spec_certificate_special" id="date_training_req_spec_certificate_special_' . $no . '" value = "' . @$value_special->date_training . '"/></td>
                            <td>&nbsp;</td>
                            <td>
                            <input type="file" class="file_req_spec_certificate_special" id="file_req_spec_certificate_special_' . $no . '"/>
                            <b id="msg_document_certificate_' . $no . '"> </b>
                            </td>';
                            } else if ($value_special->category_continous == 'Recurrent') {
                                @$data_req_specific_special .= '<td><input type="text" class="date_training_req_spec_certificate_special" id="date_training_req_spec_certificate_special_' . $no . '" value = "' . @$value_special->date_training . '"/></td>
                            <td><input type="hidden" class="expiration_date_req_spec_certificate_special" id="expiration_date_req_spec_certificate_special_' . $no . '" value="' . $value_special->age_requirement . '"/>
                            <input type="hidden" class="result_expiration_date_req_spec_certificate_special" id="result_expiration_date_req_spec_certificate_special_' . $no . '"/>
                            <input type="text" class="label_result_expiration_date_req_spec_certificate_special" id="label_result_expiration_date_req_spec_certificate_special_' . $no . '" value="' . $value_special->expiration_date . '" disabled/>
                            </td>
                            <td>
                            <input type="file" class="file_req_spec_certificate_special" id="file_req_spec_certificate_special_' . $no . '" />
                            <b id="msg_document_certificate_' . $no . '"> </b>
                            </td>';
                            } else if ($value_special->category_continous == 'New') {
                                @$data_req_specific_special .= '<td></td>
                                <td></td>
                                <td>
                                <input type="file" class="file_req_general_certificate_special" id="file_req_spec_certificate_special_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"> </b>
                                </td>'; 
                            } else if ($value_special->category_continous == '-') {
                                @$data_req_specific_special .= '<td></td>
                                <td></td>
                                <td>
                                <input type="file" class="file_req_general_certificate_special" id="file_req_spec_certificate_special_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"> </b>
                                </td>';
                            };
                            @$data_req_specific_special .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_special_' . $no . '" value="' . $value_special->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_special_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_special_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_special" id="save_result_expiration_date_req_spec_certificate_special_' . $no . '" value="' . $value_special->expiration_date . '"/>';
                                if (!empty($value_special->code_file)) {
                                    $data_req_specific_special .= '<div class="progressbox"><div id="progressbar_req_certificate_special_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_special_' . $no . '" class="statustxt_req_certificate_special">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_special" id="status_file_req_certificate_special_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_special" id="empty_file_req_certificate_special_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_special .= '<div class="progressbox"><div id="progressbar_req_certificate_special_' . $no . '" class="progress"></div><div id="statustxt_req_certificate_special_' . $no . '" class="statustxt_req_certificate_special">0%</div ></div></td>
                                    <td><img class="status_file_req_certificate_special" id="status_file_req_certificate_special_' . $no . '" height="30"/> &nbsp; <img class="empty_file_req_certificate_special" id="empty_file_req_certificate_special_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // Session License CUSTOMER Garuda
                $sess_with_garuda = array(
                    'check_customer_authorization'  => $this->input->post('check_customer_authorization'),
                    'type_customer'                 => '23',
                    'tab_spec_garuda_s'             => $this->input->post('tab-spec-garuda'),
                    'tab_category_garuda_s'         => $this->input->post('tab-category-garuda'),
                    'tab_scope_garuda_s'            => $this->input->post('tab-scope-garuda'),
                    'tab_scope_assesment_garuda_s'  => $this->input->post('tab-scope-assesment-garuda'),
                    'etops_garuda_s'                => $this->input->post('etops-garuda'),
                );
                $this->session->set_userdata('sess_with_garuda', $sess_with_garuda);
                // License with CUSTOMER Garuda
                $check_customer_authorization = $this->input->post('check_customer_authorization');
                $type_customer                = '23';
                $tab_spec_garuda_s            = $this->input->post('tab-spec-garuda');
                $tab_category_garuda_s        = $this->input->post('tab-category-garuda');
                $tab_scope_garuda_s           = $this->input->post('tab-scope-garuda');
                if (is_array($tab_scope_garuda_s) || is_object($tab_scope_garuda_s)) {
                    foreach ($tab_scope_garuda_s as $key_garuda => $value_garuda) {
                        $tab_category_garuda             = $tab_category_garuda_s[$key_garuda];
                        $tab_spec_garuda                 = $tab_spec_garuda_s[$key_garuda];
                        $tab_scope_garuda                = $value_garuda;
                        //$query_specification_garuda = array();                    
                        $additional_specification_garuda = $this->m_apply_license->query_specification($personnel_number, $check_customer_authorization, $type_customer, $tab_spec_garuda, $tab_category_garuda, $tab_scope_garuda, $field)->result();
                        foreach ($additional_specification_garuda as $value_garuda) {
                            @$data_req_specific_garuda .= '<tr>
                        <td><label>' . $no . '</label></td>                                                                                                
                        <td class="label_req_spec">' . $value_garuda->name_t . '</td>';
                            if ($value_garuda->category_continous == 'Non Recurrent') {
                                @$data_req_specific_garuda .= '<td>&nbsp;</td>
                                <td><input type="text" class="date_training_req_spec_certificate_garuda" id="date_training_req_spec_certificate_garuda_' . $no . '" value = "' . @$value_garuda->date_training . '"/></td>
                                <td>
                                <input type="file" class="file_req_spec_certificate_garuda" id="file_req_spec_certificate_garuda_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"> </b>
                                </td>';
                            } else if ($value_garuda->category_continous == 'Recurrent') {
                                @$data_req_specific_garuda .= '<td><input type="text" class="date_training_req_spec_certificate_garuda" id="date_training_req_spec_certificate_garuda_' . $no . '" value = "' . @$value_garuda->date_training . '"/></td>
                            <td><input type="hidden" class="expiration_date_req_spec_certificate_garuda" id="expiration_date_req_spec_certificate_garuda_' . $no . '" value="' . $value_garuda->age_requirement . '"/>
                            <input type="hidden" class="result_expiration_date_req_spec_certificate_garuda" id="result_expiration_date_req_spec_certificate_garuda_' . $no . '"/>
                            <input type="text" class="label_result_expiration_date_req_spec_certificate_garuda" id="label_result_expiration_date_req_spec_certificate_garuda_' . $no . '" value="' . $value_garuda->expiration_date . '" disabled/>
                            </td>
                            <td>
                            <input type="file" class="file_req_spec_certificate_garuda" id="file_req_spec_certificate_garuda_' . $no . '" />
                            <b id="msg_document_certificate_' . $no . '"> </b>
                            </td>';
                             } else if ($value_garuda->category_continous == 'New') {
                                @$data_req_specific_garuda .= '<td></td>
                                <td></td>
                                <td>
                                <input type="file" class="file_req_general_certificate_garuda" id="file_req_spec_certificate_garuda_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"> </b>
                                </td>'; 
                            } else if ($value_garuda->category_continous == '-') {
                                @$data_req_specific_garuda .= '<td></td>
                                <td></td>
                                <td>                                
                                <input type="file" class="file_req_general_certificate_garuda" id="file_req_spec_certificate_garuda_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"> </b>
                                </td>';
                            };
                            @$data_req_specific_garuda .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_garuda_' . $no . '" value="' . $value_garuda->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_garuda_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_garuda_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_garuda" id="save_result_expiration_date_req_spec_certificate_garuda_' . $no . '" value="' . $value_garuda->expiration_date . '"/>';
                                if (!empty($value_garuda->code_file)) {
                                    $data_req_specific_garuda .= '<div class="progressbox"><div id="progressbar_req_certificate_garuda_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_garuda_' . $no . '" class="statustxt_req_certificate_garuda">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_garuda" id="status_file_req_certificate_garuda_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_garuda" id="empty_file_req_certificate_garuda_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_garuda .= '<div class="progressbox">
                                    <div id="progressbar_req_certificate_garuda_' . $no . '" class="progress"></div>
                                    <div id="statustxt_req_certificate_garuda_' . $no . '" class="statustxt_req_certificate_garuda">0%</div >
                                    </div></td>
                                    <td><img class="status_file_req_certificate_garuda" id="status_file_req_certificate_garuda_' . $no . '" height="30"/> &nbsp; 
                                    <img class="empty_file_req_certificate_garuda" id="empty_file_req_certificate_garuda_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // Session License CUSTOMER Citilink
                $sess_with_citilink = array(
                    'check_customer_authorization' => $this->input->post('check_customer_authorization'),
                    'type_customer' => '24',
                    'tab_spec_citilink_s' => $this->input->post('tab-spec-citilink'),
                    'tab_category_citilink_s' => $this->input->post('tab-category-citilink'),
                    'tab_scope_citilink_s' => $this->input->post('tab-scope-citilink'),
                    'tab_scope_assesment_citilink_s' => $this->input->post('tab-scope-assesment-citilink'),
                    'etops_citilink_s'                 => $this->input->post('etops-citilink'),
                );
                $this->session->set_userdata('sess_with_citilink', $sess_with_citilink);
                // License with CUSTOMER Citilink
                $check_customer_authorization = $this->input->post('check_customer_authorization');
                $type_customer                = '24';
                $tab_spec_citilink_s          = $this->input->post('tab-spec-citilink');
                $tab_category_citilink_s      = $this->input->post('tab-category-citilink');
                $tab_scope_citilink_s         = $this->input->post('tab-scope-citilink');
                if (is_array($tab_scope_citilink_s) || is_object($tab_scope_citilink_s)) {
                    foreach ($tab_scope_citilink_s as $key_citilink => $value_citilink) {
                        $tab_category_citilink             = $tab_category_citilink_s[$key_citilink];
                        $tab_spec_citilink                 = $tab_spec_citilink_s[$key_citilink];
                        $tab_scope_citilink                = $value_citilink;
                        //$query_specification_citilink = array();
                        $additional_specification_citilink = $this->m_apply_license->query_specification($personnel_number, $check_customer_authorization, $type_customer, $tab_spec_citilink, $tab_category_citilink, $tab_scope_citilink, $field)->result();
                        foreach ($additional_specification_citilink as $value_citilink) {
                            @$data_req_specific_citilink .= '<tr>
                        <td><label>' . $no . '</label></td>                                                                                                
                        <td class="label_req_spec">' . $value_citilink->name_t . '</td>';
                            if ($value_citilink->category_continous == 'Non Recurrent') {
                                @$data_req_specific_citilink .= '
                                <td><input type="text" class="date_training_req_spec_certificate_citilink" id="date_training_req_spec_certificate_citilink_' . $no . '" value = "' . @$value_citilink->date_training . '"/></td>
                                <td>&nbsp;</td>                        
                                <td>
                                <input type="file" class="file_req_spec_certificate_citilink" id="file_req_spec_certificate_citilink_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"> </b>
                                </td>';
                            } else if ($value_citilink->category_continous == 'Recurrent') {
                                @$data_req_specific_citilink .= '<td><input type="text" class="date_training_req_spec_certificate_citilink" id="date_training_req_spec_certificate_citilink_' . $no . '" value = "' . @$value_citilink->date_training . '"/></td>
                            <td><input type="hidden" class="expiration_date_req_spec_certificate_citilink" id="expiration_date_req_spec_certificate_citilink_' . $no . '" value="' . $value_citilink->age_requirement . '"/>
                            <input type="hidden" class="result_expiration_date_req_spec_certificate_citilink" id="result_expiration_date_req_spec_certificate_citilink_' . $no . '"/>
                            <input type="text" class="label_result_expiration_date_req_spec_certificate_citilink" id="label_result_expiration_date_req_spec_certificate_citilink_' . $no . '" value = "' . @$value_citilink->expiration_date . '" disabled/>
                            </td>
                            <td>
                            <input type="file" class="file_req_spec_certificate_citilink" id="file_req_spec_certificate_citilink_' . $no . '" />
                            <b id="msg_document_certificate_' . $no . '"> </b>
                            </td>';
                            } else if ($value_citilink->category_continous == 'New') {
                                @$data_req_specific_citilink .= '<td></td>
                                <td></td>
                                <td>
                                <input type="file" class="file_req_general_certificate_citilink" id="file_req_spec_certificate_citilink_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"> </b>
                                </td>'; 
                            } else if ($value_citilink->category_continous == '-') {
                                @$data_req_specific_citilink .= '<td></td>
                                <td></td>
                                <td>
                                <input type="file" class="file_req_general_certificate_citilink" id="file_req_spec_certificate_citilink_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"> </b>
                                </td>';
                            };
                            @$data_req_specific_citilink .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_citilink_' . $no . '" value="' . $value_citilink->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_citilink_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_citilink_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_citilink" id="save_result_expiration_date_req_spec_certificate_citilink_' . $no . '" value="' . $value_citilink->expiration_date . '"/>';
                                if (!empty($value_citilink->code_file)) {
                                    $data_req_specific_citilink .= '<div class="progressbox"><div id="progressbar_req_certificate_citilink_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_citilink_' . $no . '" class="statustxt_req_certificate_citilink">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_citilink" id="status_file_req_certificate_citilink_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_citilink" id="empty_file_req_certificate_citilink_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_citilink .= '<div class="progressbox">
                                    <div id="progressbar_req_certificate_citilink_' . $no . '" class="progress"></div>
                                    <div id="statustxt_req_certificate_citilink_' . $no . '" class="statustxt_req_certificate_citilink">0%</div >
                                    </div></td>
                                    <td><img class="status_file_req_certificate_citilink" id="status_file_req_certificate_citilink_' . $no . '" height="30"/> &nbsp; 
                                    <img class="empty_file_req_certificate_citilink" id="empty_file_req_certificate_citilink_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // Session License CUSTOMER Sriwijaya
                $sess_with_sriwijaya = array(
                    'check_customer_authorization' => $this->input->post('check_customer_authorization'),
                    'type_customer' => '25',
                    'tab_spec_sriwijaya_s' => $this->input->post('tab-spec-sriwijaya'),
                    'tab_category_sriwijaya_s' => $this->input->post('tab-category-sriwijaya'),
                    'tab_scope_sriwijaya_s' => $this->input->post('tab-scope-sriwijaya'),
                    'tab_scope_assesment_sriwijaya_s' => $this->input->post('tab-scope-assesment-sriwijaya'),
                    'etops_sriwijaya_s'                 => $this->input->post('etops-sriwijaya'),
                );
                $this->session->set_userdata('sess_with_sriwijaya', $sess_with_sriwijaya);
                
                $check_customer_authorization = $this->input->post('check_customer_authorization');
                $type_customer                = '25';
                $tab_spec_sriwijaya_s         = $this->input->post('tab-spec-sriwijaya');
                $tab_category_sriwijaya_s     = $this->input->post('tab-category-sriwijaya');
                $tab_scope_sriwijaya_s        = $this->input->post('tab-scope-sriwijaya');
                if (is_array($tab_scope_sriwijaya_s) || is_object($tab_scope_sriwijaya_s)) {
                    foreach ($tab_scope_sriwijaya_s as $key_sriwijaya => $value_sriwijaya) {
                        $tab_category_sriwijaya             = $tab_category_sriwijaya_s[$key_sriwijaya];
                        $tab_spec_sriwijaya                 = $tab_spec_sriwijaya_s[$key_sriwijaya];
                        $tab_scope_sriwijaya                = $value_sriwijaya;                       
                        $additional_specification_sriwijaya = $this->m_apply_license->query_specification($personnel_number, $check_customer_authorization, $type_customer, $tab_spec_sriwijaya, $tab_category_sriwijaya, $tab_scope_sriwijaya, $field)->result();
                        foreach ($additional_specification_sriwijaya as $value_sriwijaya) {
                            @$data_req_specific_sriwijaya .= '<tr>
                            <td><label>' . $no . '</label></td>                                                                                                
                            <td class="label_req_spec">' . $value_sriwijaya->name_t . '</td>';
                            if ($value_sriwijaya->category_continous == 'Non Recurrent') {
                                @$data_req_specific_sriwijaya .= '
                                <td><input type="text" class="date_training_req_spec_certificate_sriwijaya" id="date_training_req_spec_certificate_sriwijaya_' . $no . '" value = "' . @$value_sriwijaya->date_training . '"/></td>
                                <td>&nbsp;</td>
                                <td><input type="file"  class="file_req_spec_certificate_sriwijaya" id="file_req_spec_certificate_sriwijaya_' . $no . '"/>
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>';
                            } else if ($value_sriwijaya->category_continous == 'Recurrent') {
                                @$data_req_specific_sriwijaya .= '<td><input type="text" class="date_training_req_spec_certificate_sriwijaya" id="date_training_req_spec_certificate_sriwijaya_' . $no . '" value = "' . @$value_sriwijaya->date_training . '"/></td>
                            <td><input type="hidden" class="expiration_date_req_spec_certificate_sriwijaya" id="expiration_date_req_spec_certificate_sriwijaya_' . $no . '" value="' . $value_sriwijaya->age_requirement . '"/>
                            <input type="hidden" class="result_expiration_date_req_spec_certificate_sriwijaya" id="result_expiration_date_req_spec_certificate_sriwijaya_' . $no . '" />
                            <input type="text" class="label_result_expiration_date_req_spec_certificate_sriwijaya" id="label_result_expiration_date_req_spec_certificate_sriwijaya_' . $no . '" value="' . $value_sriwijaya->expiration_date . '" disabled/>
                            </td>
                            <td><input type="file"  class="file_req_spec_certificate_sriwijaya" id="file_req_spec_certificate_sriwijaya_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b>
                            </td>';
                            } else if ($value_sriwijaya->category_continous == 'New') {
                                @$data_req_specific_sriwijaya .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_sriwijaya" id="file_req_spec_certificate_sriwijaya_' . $no . '" />
                                    <b id="msg_document_certificate_' . $no . '"></b>
                                </td>'; 
                            } else if ($value_sriwijaya->category_continous == '-') {
                                @$data_req_specific_sriwijaya .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_sriwijaya" id="file_req_spec_certificate_sriwijaya_' . $no . '" /></td>';
                            };
                            @$data_req_specific_sriwijaya .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_sriwijaya_' . $no . '" value="' . $value_sriwijaya->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_sriwijaya_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_sriwijaya_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_sriwijaya" id="save_result_expiration_date_req_spec_certificate_sriwijaya_' . $no . '" value="' . $value_sriwijaya->expiration_date . '"/>';
                                if (!empty($value_sriwijaya->code_file)) {
                                    $data_req_specific_sriwijaya .= '<div class="progressbox"><div id="progressbar_req_certificate_sriwijaya_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_sriwijaya_' . $no . '" class="statustxt_req_certificate_sriwijaya">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_sriwijaya" id="status_file_req_certificate_sriwijaya_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_sriwijaya" id="empty_file_req_certificate_sriwijaya_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_sriwijaya .= '<div class="progressbox">
                                    <div id="progressbar_req_certificate_sriwijaya_' . $no . '" class="progress"></div>
                                    <div id="statustxt_req_certificate_sriwijaya_' . $no . '" class="statustxt_req_certificate_sriwijaya">0%</div >
                                    </div></td>
                                    <td><img class="status_file_req_certificate_sriwijaya" id="status_file_req_certificate_sriwijaya_' . $no . '" height="30"/> &nbsp; 
                                    <img class="empty_file_req_certificate_sriwijaya" id="empty_file_req_certificate_sriwijaya_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                // COFC
                // License with COFC                
                $sess_with_cofc = array(
                    'check_cofc'                    => $this->input->post('check_c_of_c'),
                    'type_cofc'                     => $this->input->post('type_cofc'),
                    'tab_spec_cofc_s'               => $this->input->post('tab-spec-cofc'),
                    'tab_category_cofc_s'           => $this->input->post('tab-category-cofc'),
                    'tab_scope_cofc_s'              => $this->input->post('tab-scope-cofc'),
                    'tab_scope_assesment_cofc_s'    => $this->input->post('tab-scope-assesment-cofc'),                    
                );
                //print_r($sess_with_cofc);
                //            die();            
                $this->session->set_userdata('sess_with_cofc', $sess_with_cofc);

                // License with cofc
                $check_cofc          = $this->input->post('check_c_of_c');
                $type_cofc           = $this->input->post('type_cofc');
                $tab_spec_cofc_s     = $this->input->post('tab-spec-cofc');
                $tab_category_cofc_s = $this->input->post('tab-category-cofc');
                $tab_scope_cofc_s    = $this->input->post('tab-scope-cofc');
                if (is_array($tab_scope_cofc_s) || is_object($tab_scope_cofc_s)) {
                    foreach ($tab_scope_cofc_s as $key_cofc => $value_cofc) {
                        $tab_category_cofc             = $tab_category_cofc_s[$key_cofc];
                        $tab_spec_cofc                 = $tab_spec_cofc_s[$key_cofc];
                        $tab_scope_cofc                = $value_cofc;
                        //$query_specification_cofc = array();
                        $additional_specification_cofc = $this->m_apply_license->query_specification($personnel_number, $check_cofc, $type_cofc, $tab_spec_cofc, $tab_category_cofc, $tab_scope_cofc, $field)->result();
                        foreach ($additional_specification_cofc as $value_cofc) {
                            @$data_req_specific_cofc .= '<tr>
                            <td><label>' . $no . '</label></td>
                            <td class="label_req_spec">' . $value_cofc->name_t . '</td>';
                            if ($value_cofc->category_continous == 'Non Recurrent') {
                                @$data_req_specific_cofc .= '
                                <td><input type="text" class="date_training_req_spec_certificate_cofc" id="date_training_req_spec_certificate_cofc_' . $no . '" value = "' . @$value_cofc->date_training . '"/></td>
                                <td>&nbsp;</td>
                                <td><input type="file" class="file_req_spec_certificate_cofc" id="file_req_spec_certificate_cofc_' . $no . '"/>
                                <b id="msg_document_certificate_' . $no . '"></b></td>';
                            } else if ($value_cofc->category_continous == 'Recurrent') {
                            @$data_req_specific_cofc .= '<td><input type="text" class="date_training_req_spec_certificate_cofc" id="date_training_req_spec_certificate_cofc_' . $no . '" value = "' . @$value_cofc->date_training . '"/></td>
                            <td><input type="hidden" class="expiration_date_req_spec_certificate_cofc" id="expiration_date_req_spec_certificate_cofc_' . $no . '" value="' . $value_cofc->age_requirement . '"/>
                            <input type="hidden" class="result_expiration_date_req_spec_certificate_cofc" id="result_expiration_date_req_spec_certificate_cofc_' . $no . '" />
                            <input type="text" class="label_result_expiration_date_req_spec_certificate_cofc" id="label_result_expiration_date_req_spec_certificate_cofc_' . $no . '" value="' . $value_cofc->expiration_date . '" disabled/>
                            </td>
                            <td><input type="file" class="file_req_spec_certificate_cofc" id="file_req_spec_certificate_cofc_' . $no . '" />
                            <b id="msg_document_certificate_' . $no . '"></b></td>';
                            } else if ($value_cofc->category_continous == 'New') {
                                @$data_req_specific_cofc .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_cofc" id="file_req_spec_certificate_cofc_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b></td>'; 
                            } else if ($value_cofc->category_continous == '-') {
                                @$data_req_specific_cofc .= '<td></td>
                                <td></td>
                                <td><input type="file" class="file_req_general_certificate_cofc" id="file_req_spec_certificate_cofc_' . $no . '" />
                                <b id="msg_document_certificate_' . $no . '"></b></td>';
                            };
                            @$data_req_specific_cofc .= '<td width="20%">
                                <input type="hidden" id="code_req_spec_certificate_cofc_' . $no . '" value="' . $value_cofc->code_t . '"/>
                                <input type="hidden" id="date_req_spec_certificate_cofc_' . $no . '" />
                                <input type="hidden" id="time_req_spec_certificate_cofc_' . $no . '" />
                                <input type="hidden" class="save_result_expiration_date_req_spec_certificate_cofc" id="save_result_expiration_date_req_spec_certificate_cofc_' . $no . '" value="' . $value_cofc->expiration_date . '"/>';
                                if (!empty($value_cofc->code_file)) {
                                    $data_req_specific_cofc .= '<div class="progressbox"><div id="progressbar_req_certificate_cofc_' . $no . '" class="progress" style="background:blue"></div><div id="statustxt_req_certificate_cofc_' . $no . '" class="statustxt_req_certificate_cofc">100%</div ></div></td>
                                    <td><img src = "'. base_url('/assets/images/property/check.png') .'" class="status_file_req_certificate_cofc" id="status_file_req_certificate_cofc_' . $no . '" height="30"/> &nbsp; <img src = "'. base_url('/assets/images/property/cross_check.png') .'" class="empty_file_req_certificate_cofc" id="empty_file_req_certificate_cofc_' . $no . '" height="30"/>
                                    <br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_' . $no . '" src="'. base_url('/assets/images/property/squares.gif') .'"/>
                                        <input type="hidden" id="status_upload_'. $no .'" value="1">
                                    </td> 
                                    </tr>';
                                } else {
                                    $data_req_specific_cofc .= '<div class="progressbox">
                                    <div id="progressbar_req_certificate_cofc_' . $no . '" class="progress"></div>
                                    <div id="statustxt_req_certificate_cofc_' . $no . '" class="statustxt_req_certificate_cofc">0%</div >
                                    </div></td>
                                    <td><img class="status_file_req_certificate_cofc" id="status_file_req_certificatev_cofc_' . $no . '" height="30"/> &nbsp; 
                                    <img class="empty_file_req_certificate_cofc" id="empty_file_req_certificate_sriwijaya_' . $no . '" height="30"/></td> 
                                    </tr>';
                                }
                            $no++;
                        }
                    }
                }
                $data['data_authorization_request']          = $this->session->userdata('sess_data_authorization_request');
                $data['additional_document_general']         = $this->m_apply_license->query_general_document($personnel_number, $license, $type, $type_check_23, $type_check_24, $type_check_25, $check_easa, $type_easa, $check_special)->result();
                $data['data_general_certificate']            = @$data_general_certificate;
                $data['data_req_specific_document']          = @$additional_specification_document;            
                $data['data_req_specific']                   = @$data_req_specific;
                $data['data_req_specific_license_garuda']    = @$data_req_specific_license_garuda;
                $data['data_req_specific_license_citilink']  = @$data_req_specific_license_citilink;
                $data['data_req_specific_license_sriwijaya'] = @$data_req_specific_license_sriwijaya;
                $data['data_req_specific_easa']              = @$data_req_specific_easa;
                $data['data_req_specific_special']           = @$data_req_specific_special;
                $data['data_req_specific_garuda']            = @$data_req_specific_garuda;
                $data['data_req_specific_citilink']          = @$data_req_specific_citilink;
                $data['data_req_specific_sriwijaya']         = @$data_req_specific_sriwijaya;
                $data['data_req_specific_cofc']              = @$data_req_specific_cofc;
                $this->page->view('completing_data', $data);
            }
        } else {
            $data['user_data']    = $this->session->userdata('users_applicant');
            $data['auth_license'] = $this->db->order_by('id', 'ASC')->get('m_auth_license')->result();
            $this->page->view('authorization_request', $data);
        }
    }
    
        public function cek_date_file_current() {
        $sess_data_personnel    = $this->session->userdata('sess_data_personnel');        
        $personnel_number       = $sess_data_personnel['personnel_number'];                               
        $code_current           = $this->input->post('code_req_document_certificate'); 
        $date_current           = $this->m_apply_license->cek_date_current($personnel_number, $code_current);
        echo $date_current['date_upload'];
    }

    public function cek_time_file_current() {
        $sess_data_personnel    = $this->session->userdata('sess_data_personnel');        
        $personnel_number       = $sess_data_personnel['personnel_number'];                               
        $code_current           = $this->input->post('code_req_document_certificate'); 
        $time_current           = $this->m_apply_license->cek_time_current($personnel_number, $code_current);
        echo $time_current['time_upload'];
    }

    public function cek_expiration_file_current() {
        $sess_data_personnel    = $this->session->userdata('sess_data_personnel');        
        $personnel_number       = $sess_data_personnel['personnel_number'];                               
        $code_current           = $this->input->post('code_req_document_certificate'); 
        $expiration_current     = $this->m_apply_license->cek_expiration_current($personnel_number, $code_current);
        echo $expiration_current['expiration_date'];
    }

    public function upload_file_general() {
        $this->load->library('ftp');                
        $ftp_config['hostname'] = '127.0.0.1'; 
        $ftp_config['username'] = 'yayas';
        $ftp_config['password'] = 'Bismillah';
        $ftp_config['debug']    = TRUE;    
        $this->ftp->connect($ftp_config);                               
        $this->load->library('upload');                                                              
        $mainfolder = 'TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS';                
        $sess_data_personnel    = $this->session->userdata('sess_data_personnel');        
        $personnel_number       = $sess_data_personnel['personnel_number'];                               
        $subfolder              = $sess_data_personnel['personnel_number'];        
        $cd_folder = $this->m_apply_license->get_code_file();            
        if($this->ftp->list_files('/'.$mainfolder.'/'.$subfolder)==''){                
           $this->ftp->mkdir('/'.$mainfolder.'/'.$subfolder);                
            foreach($cd_folder as $code_file){  
                  if($this->ftp->list_files('/'.$mainfolder.'/'.$subfolder.'/'.$code_file->name)==''){              
                    $this->ftp->mkdir('/'.$mainfolder.'/'.$subfolder.'/'.$code_file->name);                
                  };     
              }
        };             
        $code_req_document_general      = $this->input->post('code_req_document_general');        
        $save_expiration_req_document_general = $this->input->post('save_expiration_req_document_general');
        if ($save_expiration_req_document_general) {
            $date_expiration = date('Y-m-d', strtotime($save_expiration_req_document_general));
        } else {
            $date_expiration = null;
        };        
        $no_upload                      = no_upload($personnel_number,$code_req_document_general);
        if(isset($_FILES['file_req_document_general']['name'])) {
            if ($_FILES['file_req_document_general']['size'] > 5120000) {  
                echo 'File too large, max 5mb.';
            } else {
            $cd_folder_by       = $this->m_apply_license->get_code_file_by($code_req_document_general);                       
            $this->ftp->changedir('/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name);                              
            $fileNameOld        = $_FILES['file_req_document_general']['name'];                                                    
            @$ext               = end(explode('.',$_FILES['file_req_document_general']['name']));                          
            if ($ext == 'pdf') {
                $fileNameNew        = $personnel_number.'_'.$code_req_document_general. '_' . date('YmdH') . '.' . $ext;
                $sourceFileName     = $_FILES['file_req_document_general']['tmp_name'];                  
                $destination        = $fileNameOld;                                      
                $destinationnew     = $fileNameNew;  
                $file_exists = $this->ftp->list_files(str_replace('%20',' ','/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name . '/' . $destinationnew));
                    if(!$file_exists) {              
                        $send               = $this->ftp->upload($sourceFileName,$destination);
                        $rename             = $this->ftp->rename($destination,$destinationnew);
                        $data_license = array(
                            'personnel_number_fk'   => $personnel_number,                
                            'name_file'             => $fileNameNew,
                            'code_file'             => $code_req_document_general,                            
                            'expiration_date'       => $date_expiration,
                            'date_upload'           => date('Y-m-d'),
                            'time_upload'           => date('H:i:s'),
                            'no_upload'             => $no_upload,
                        );                                                     
                        $this->db->insert('t_file_requirement',$data_license);                                          
                                            
                        echo 'Save successfull.';                         
                    } else {
                        echo 'File is exists.';                         
                    }                                    
            } else {
                echo 'File type not suport, please atach file pdf.';                
            }
        }
            
        } else {
            echo 'Please choose file.';
        }   
        $this->ftp->close(); 
    }

    public function delete_file_general() {
        $this->load->library('ftp');
        $ftp_config['hostname'] = '127.0.0.1'; 
        $ftp_config['username'] = 'yayas';
        $ftp_config['password'] = 'Bismillah';
        $ftp_config['debug']    = TRUE;    
        $this->ftp->connect($ftp_config);                               
        $this->load->library('upload');                                                              
        $mainfolder = 'TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS';                
        $sess_data_personnel    = $this->session->userdata('sess_data_personnel');        
        $personnel_number       = $sess_data_personnel['personnel_number'];                               
        $subfolder              = $sess_data_personnel['personnel_number'];                
        $code_file              = $this->input->post('code_req_document_general');                                                        
        $date_upload            = $this->input->post('date_req_document_general');                        
        $time_upload            = $this->input->post('time_req_document_general');                                
        $cd_folder_by                   = $this->m_apply_license->get_code_file_by($code_file);                       
        $this->ftp->changedir('/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name);                                              
        $fileNameNew                    = $personnel_number.'_'.$code_file.'_'.$date_upload.$time_upload.'.pdf';      
        if($fileNameNew) {              
            $this->ftp->delete_file($fileNameNew);
            $this->db->where('name_file',$fileNameNew);
            $this->db->delete('t_file_requirement');
            echo 'Delete successfull.';                         
        } else {
            echo 'Delete failed, please try again.';                         
        }
        $this->ftp->close();                                 
    }
    
    function upload_file_document_certificate() {
        $this->load->library('ftp');                                    
        $ftp_config['hostname'] = '127.0.0.1'; 
        $ftp_config['username'] = 'yayas';
        $ftp_config['password'] = 'Bismillah';
        $ftp_config['debug']    = TRUE;    
        $this->ftp->connect($ftp_config); 
        $this->load->library('upload');                                                            
        $mainfolder             = 'TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS';                
        $sess_data_personnel    = $this->session->userdata('sess_data_personnel');        
        $personnel_number       = $sess_data_personnel['personnel_number'];                               
        $subfolder              = $sess_data_personnel['personnel_number'];        
        $cd_folder              = $this->m_apply_license->get_code_file();            
        if($this->ftp->list_files('/'.$mainfolder.'/'.$subfolder)==''){                
           $this->ftp->mkdir('/'.$mainfolder.'/'.$subfolder);                
            foreach($cd_folder as $code_file){  
                  if($this->ftp->list_files('/'.$mainfolder.'/'.$subfolder.'/'.$code_file->name)==''){              
                    $this->ftp->mkdir('/'.$mainfolder.'/'.$subfolder.'/'.$code_file->name);                
                  };     
              }
        };             
        $code_req_document_certificate                          = $this->input->post('code_req_document_certificate');                    
        $date_training_req_general_certificate                  = $this->input->post('date_training_req_general_certificate');            
        $save_result_expiration_date_req_general_certificate    = $this->input->post('save_result_expiration_date_req_general_certificate');            
        $no_upload                                              = no_upload($personnel_number,$code_req_document_certificate);
        if(isset($_FILES['file_req_document_certificate']['name'])) {
            if ($_FILES['file_req_document_certificate']['size'] > 5120000) {  
                echo 'File too large, max 5mb.';
            } else {
                $cd_folder_by       = $this->m_apply_license->get_code_file_by($code_req_document_certificate);                       
                $this->ftp->changedir('/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name);                              
                $fileNameOld        = $_FILES['file_req_document_certificate']['name'];                                                    
                @$ext               = end(explode('.',$_FILES['file_req_document_certificate']['name']));                          
                if ($ext == 'pdf') {
                    $fileNameNew        = $personnel_number . '_' . $code_req_document_certificate . '_' . date('YmdH') . '.' . $ext;
                    $sourceFileName     = $_FILES['file_req_document_certificate']['tmp_name'];                  
                    $destination        = $fileNameOld;                                      
                    $destinationnew     = $fileNameNew;                  
                    if($date_training_req_general_certificate) {
                        $date_training  = date('Y-m-d', strtotime($date_training_req_general_certificate));
                    } else {
                        $date_training  = null;
                    };

                    if ($save_result_expiration_date_req_general_certificate) {
                        $date_expiration = date('Y-m-d', strtotime($save_result_expiration_date_req_general_certificate));
                    } else {
                        $date_expiration = null;
                    };

                    $file_exists = $this->ftp->list_files(str_replace('%20',' ','/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name . '/' . $destinationnew));
                    if(!$file_exists) {  
                        $send               = $this->ftp->upload($sourceFileName,$destination);
                        $rename             = $this->ftp->rename($destination,$destinationnew);
                        $data_general_certificate = array(
                            'personnel_number_fk'  => $personnel_number,                
                            'date_training'        => $date_training,
                            'expiration_date'      => $date_expiration,
                            'code_file'            => $code_req_document_certificate,                
                            'name_file'            => $fileNameNew,                                                                    
                            'date_upload'          => date('Y-m-d'),
                            'time_upload'          => date('H:i:s'),
                            'no_upload'            => $no_upload,
                        );
                                               
                        $this->db->insert('t_file_requirement',$data_general_certificate);                                          
                                                   
                        echo 'Save successfull.';                                                                     
                    } else {
                        echo 'File is exists.';                         
                    }
                } else {
                    echo 'File type not suport, please atach file pdf.';                
                }
            }    
        } else {
            echo 'Please choose file.';
        }
        $this->ftp->close();    
    }

    public function delete_file_document_certificate() {
        $this->load->library('ftp');
        $ftp_config['hostname'] = '127.0.0.1'; 
        $ftp_config['username'] = 'yayas';
        $ftp_config['password'] = 'Bismillah';
        $ftp_config['debug']    = TRUE;    
        $this->ftp->connect($ftp_config);                               
        $this->load->library('upload');                                                              
        $mainfolder = 'TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS';                
        $sess_data_personnel    = $this->session->userdata('sess_data_personnel');        
        $personnel_number       = $sess_data_personnel['personnel_number'];                               
        $subfolder              = $sess_data_personnel['personnel_number'];                
        $code_file              = $this->input->post('code_req_document_certificate');                                                        
        $date_upload            = $this->input->post('date_req_document_certificate');                        
        $time_upload            = $this->input->post('time_req_document_certificate');                                
        $cd_folder_by                   = $this->m_apply_license->get_code_file_by($code_file);                       
        $this->ftp->changedir('/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name);                                              
        $fileNameNew                    = $personnel_number.'_'.$code_file.'_'.$date_upload.$time_upload.'.pdf';      
        if($fileNameNew) {              
            $this->ftp->delete_file($fileNameNew);
            $this->db->where('name_file',$fileNameNew);
            $this->db->delete('t_file_requirement');
            echo 'Delete successfull.';                         
        } else {
            echo 'Delete failed, please try again.';                         
        }
        $this->ftp->close();                                 
    }


    function upload_file_spec_certificate() {
        $this->load->library('ftp');
        $ftp_config['hostname'] = '127.0.0.1'; 
        $ftp_config['username'] = 'yayas';
        $ftp_config['password'] = 'Bismillah';
        $ftp_config['debug']    = TRUE;    
        $this->ftp->connect($ftp_config);                                                           
        $this->load->library('upload');                                                         
        $mainfolder             = 'TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS';                
        $sess_data_personnel    = $this->session->userdata('sess_data_personnel');        
        $personnel_number       = $sess_data_personnel['personnel_number'];                               
        $subfolder              = $sess_data_personnel['personnel_number'];        
        $cd_folder              = $this->m_apply_license->get_code_file();                
        if($this->ftp->list_files('/'.$mainfolder.'/'.$subfolder)==''){                
           $this->ftp->mkdir('/'.$mainfolder.'/'.$subfolder);                
            foreach($cd_folder as $code_file){  
                  if($this->ftp->list_files('/'.$mainfolder.'/'.$subfolder.'/'.$code_file->name)==''){              
                    $this->ftp->mkdir('/'.$mainfolder.'/'.$subfolder.'/'.$code_file->name);                
                  };     
              }
        };             
        $code_req_spec_certificate                          = $this->input->post('code_req_spec_certificate');                    
        $date_training_req_spec_certificate                  = $this->input->post('date_training_req_spec_certificate');            
        $save_result_expiration_date_req_spec_certificate    = $this->input->post('save_result_expiration_date_req_spec_certificate');            
        $no_upload                                              = no_upload($personnel_number,$code_req_spec_certificate);
        if(isset($_FILES['file_req_spec_certificate']['name'])) {
            if ($_FILES['file_req_spec_certificate']['size'] > 5120000) {  
                echo 'File too large, max 5mb.';
            } else {
                $cd_folder_by       = $this->m_apply_license->get_code_file_by($code_req_spec_certificate);                       
                $this->ftp->changedir('/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name);                              
                $fileNameOld        = $_FILES['file_req_spec_certificate']['name'];                                                    
                @$ext               = end(explode('.',$_FILES['file_req_spec_certificate']['name']));                          
                if ($ext == 'pdf') {
                    $fileNameNew        = $personnel_number . '_' . $code_req_spec_certificate . '_' . date('YmdH') . '.' . $ext;
                    $sourceFileName     = $_FILES['file_req_spec_certificate']['tmp_name'];                  
                    $destination        = $fileNameOld;                                      
                    $destinationnew     = $fileNameNew;
                    
                    if($date_training_req_spec_certificate) {
                        $date_training  = date('Y-m-d', strtotime($date_training_req_spec_certificate));
                    } else {
                        $date_training  = null;
                    };

                    if ($save_result_expiration_date_req_spec_certificate) {
                        $date_expiration = date('Y-m-d', strtotime($save_result_expiration_date_req_spec_certificate));
                    } else {
                        $date_expiration = null;
                    };  

                    $file_exists = $this->ftp->list_files(str_replace('%20',' ','/'.$mainfolder.'/'.$subfolder.'/'.$cd_folder_by->name . '/' . $destinationnew));
                    if(!$file_exists) {  
                        $send               = $this->ftp->upload($sourceFileName,$destination);
                        $rename             = $this->ftp->rename($destination,$destinationnew);
                        $data_spec_certificate = array(
                            'personnel_number_fk'  => $personnel_number,                
                            'date_training'        => $date_training,
                            'expiration_date'      => $date_expiration,
                            'code_file'            => $code_req_spec_certificate,                
                            'name_file'            => $fileNameNew,                            
                            'date_upload'          => date('Y-m-d'),
                            'time_upload'          => date('H:i:s'),
                            'no_upload'            => $no_upload,
                        );
                                               
                        $this->db->insert('t_file_requirement',$data_spec_certificate);                                          
                                                  
                        echo 'Save successfull.';                                                                     
                    } else {
                        echo 'File is exists.';                         
                    }
                } else {
                    echo 'File type not suport, please atach file pdf.';                
                }
            }    
        } else {
            echo 'Please choose file.';
        }   
        $this->ftp->close(); 
    }

    public 
    // -- Function Name : completing_data
        
    // -- Params : 
        
    // -- Purpose : 
    function completing_data()
    {
    @$sess_license              = $this->session->userdata('sess_license');
    @$sess_license_garuda       = $this->session->userdata('sess_license_garuda');
    @$sess_license_citilink     = $this->session->userdata('sess_license_citilink');
    @$sess_license_sriwijaya    = $this->session->userdata('sess_license_sriwijaya');
    @$sess_license_easa         = $this->session->userdata('sess_license_easa');
    @$sess_license_special      = $this->session->userdata('sess_license_special');
    @$sess_with_garuda          = $this->session->userdata('sess_with_garuda');
    @$sess_with_citilink        = $this->session->userdata('sess_with_citilink');
    @$sess_with_sriwijaya       = $this->session->userdata('sess_with_sriwijaya');
    @$sess_with_cofc            = $this->session->userdata('sess_with_cofc');
    
        if(isset($_POST['savecompletingdata'])){
            $data['content'] = $this->session->set_flashdata('content_not_valid', 'Save successfull.');
            redirect(site_url('home/index'));
        };

        if (isset($_POST['submitcompletingdata'])) {
            $sess_completing_data = array(
                'submitcompletingdata' => $this->input->post('submitcompletingdata')
            );
            $this->session->set_userdata('sess_completing_data', $sess_completing_data);
            $sess_data_personnel = $this->session->userdata('sess_data_personnel');
            $personnel_number    = @$sess_data_personnel['personnel_number'];
            if ($this->m_apply_license->get_all_data_personnel($personnel_number) == 1) {
            } else if ($this->m_apply_license->get_all_data_personnel_non($personnel_number) == 0) {
                $data = array(
                    'personnel_number'      => $sess_data_personnel['personnel_number'],
                    'name'                  => $sess_data_personnel['name'],
                    'presenttitle'          => $sess_data_personnel['presenttitle'],
                    'departement'           => $sess_data_personnel['departement'],
                    'email'                 => $sess_data_personnel['email'],
                    'dateofbirth' => date('Y-m-d', strtotime($sess_data_personnel['dateofbirth'])),
                    'dateofemployee' => date('Y-m-d', strtotime($sess_data_personnel['dateofemployee'])),
                    'formaleducation' => $sess_data_personnel['formaleducation'],
                    'mobilephone' => $sess_data_personnel['mobilephone'],
                    'businessphone' => $sess_data_personnel['businessphone'],
                    'validitycontract' => date('Y-m-d', strtotime($sess_data_personnel['validitycontract'])),
                    'report_to' => $sess_data_personnel['personnel_number_superior']
                );
                $this->db->insert('m_employee', $data);
            }
            ;
            $personnel_number                 = $sess_data_personnel['personnel_number'];
            $code_req_general_document        = $this->input->post('code_req_general_document');
            $sess_license                     = $this->session->userdata('sess_license');
            $sess_license_garuda              = $this->session->userdata('sess_license_garuda');
            $sess_license_citilink            = $this->session->userdata('sess_license_citilink');
            $sess_license_sriwijaya           = $this->session->userdata('sess_license_sriwijaya');
            $no                               = $sess_license['no'];
            $license                          = $sess_license['license'];
            $type                             = $sess_license['type'];
            $tab_spec_s                       = $sess_license['tab_spec_s'];
            $tab_category_s                   = $sess_license['tab_category_s'];
            $tab_scope_s                      = $sess_license['tab_scope_s'];
            $etops_s                          = $sess_license['etops_s'];
            $type_check_23                    = $sess_license_garuda['type_check_23'];
            $tab_spec_license_garuda_s        = $sess_license_garuda['tab_spec_license_garuda_s'];
            $tab_category_license_garuda_s    = $sess_license_garuda['tab_category_license_garuda_s'];
            $tab_scope_license_garuda_s       = $sess_license_garuda['tab_scope_license_garuda_s'];
            $etops_license_garuda_s           = $sess_license_garuda['etops_license_garuda_s'];
            $type_check_24                    = $sess_license_citilink['type_check_24'];
            $tab_spec_license_citilink_s      = $sess_license_citilink['tab_spec_license_citilink_s'];
            $tab_category_license_citilink_s  = $sess_license_citilink['tab_category_license_citilink_s'];
            $tab_scope_license_citilink_s     = $sess_license_citilink['tab_scope_license_citilink_s'];
            $etops_license_citilink_s         = $sess_license_citilink['etops_license_citilink_s'];
            $type_check_25                    = $sess_license_sriwijaya['type_check_25'];
            $tab_spec_license_sriwijaya_s     = $sess_license_sriwijaya['tab_spec_license_sriwijaya_s'];
            $tab_category_license_sriwijaya_s = $sess_license_sriwijaya['tab_category_license_sriwijaya_s'];
            $tab_scope_license_sriwijaya_s    = $sess_license_sriwijaya['tab_scope_license_sriwijaya_s'];
            $etops_license_sriwijaya_s        = $sess_license_sriwijaya['etops_license_sriwijaya_s'];
            if (is_array(@$tab_scope_s) || is_object(@$tab_scope_s)) {
                foreach ($tab_scope_s as $key => $value) {
                    $tab_category   = $tab_category_s[$key];
                    $tab_spec       = $tab_spec_s[$key];
                    $tab_scope      = $value;
                    $etops          = $etops_s[$key];
                                        
                    $master_license = $this->m_apply_license->query_license($license, $type, $tab_spec, $tab_category, $tab_scope, $etops)->result();
                    foreach ($master_license as $value) {
                        @$data_license .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value->name_t . '</td>
                        <td>' . $value->name_type . '</td>
                        <td>' . $value->name_spect . '</td>
                        <td>' . $value->name_category . '</td>
                        <td>' . $value->name_scope . '</td>
                        <td>' . $value->status_etops . '</td>
                        </tr>';
                    }
                }
            }
            if (is_array($tab_scope_license_garuda_s) || is_object($tab_scope_license_garuda_s)) {
                foreach ($tab_scope_license_garuda_s as $key => $value) {
                    $tab_category_license_garuda = $tab_category_license_garuda_s[$key];
                    $tab_spec_license_garuda     = $tab_spec_license_garuda_s[$key];
                    $tab_scope_license_garuda    = $value;
                    $etops_license_garuda         = $etops_license_garuda_s[$key];
                    //$query_license=array();                        
                    $master_license_garuda       = $this->m_apply_license->query_license($license, $type_check_23, $tab_spec_license_garuda, $tab_category_license_garuda, $tab_scope_license_garuda, $etops_license_garuda)->result();
                    foreach ($master_license_garuda as $value) {
                        @$data_license_garuda .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value->name_t . '</td>
                        <td>' . $value->name_type . '</td>
                        <td>' . $value->name_spect . '</td>
                        <td>' . $value->name_category . '</td>
                        <td>' . $value->name_scope . '</td>
                        <td>' . $value->status_etops . '</td>
                        </tr>';
                    }
                }
            }
            if (is_array($tab_scope_license_citilink_s) || is_object($tab_scope_license_citilink_s)) {
                foreach ($tab_scope_license_citilink_s as $key => $value) {
                    $tab_category_license_citilink = $tab_category_license_citilink_s[$key];
                    $tab_spec_license_citilink     = $tab_spec_license_citilink_s[$key];
                    $tab_scope_license_citilink    = $value;
                    $etops_license_citilink         = $etops_license_citilink_s[$key];
                    //$query_license=array();                        
                    $master_license_citilink       = $this->m_apply_license->query_license($license, $type_check_24, $tab_spec_license_citilink, $tab_category_license_citilink, $tab_scope_license_citilink, $etops_license_citilink)->result();
                    foreach ($master_license_citilink as $value) {
                        @$data_license_citilink .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value->name_t . '</td>
                        <td>' . $value->name_type . '</td>
                        <td>' . $value->name_spect . '</td>
                        <td>' . $value->name_category . '</td>
                        <td>' . $value->name_scope . '</td>
                        <td>' . $value->status_etops . '</td>
                        </tr>';
                    }
                }
            }
            if (is_array($tab_scope_license_sriwijaya_s) || is_object($tab_scope_license_sriwijaya_s)) {
                foreach ($tab_scope_license_sriwijaya_s as $key => $value) {
                    $tab_category_license_sriwijaya = $tab_category_license_sriwijaya_s[$key];
                    $tab_spec_license_sriwijaya     = $tab_spec_license_sriwijaya_s[$key];
                    $tab_scope_license_sriwijaya    = $value;
                    $etops_license_sriwijaya         = $etops_license_sriwijaya_s[$key];
                    //$query_license=array();                        
                    $master_license_sriwijaya       = $this->m_apply_license->query_license($license, $type_check_25, $tab_spec_license_sriwijaya, $tab_category_license_sriwijaya, $tab_scope_license_sriwijaya, $etops_license_sriwijaya)->result();
                    foreach ($master_license_sriwijaya as $value) {
                        @$data_license_sriwijaya .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value->name_t . '</td>
                        <td>' . $value->name_type . '</td>
                        <td>' . $value->name_spect . '</td>
                        <td>' . $value->name_category . '</td>
                        <td>' . $value->name_scope . '</td>
                        <td>' . $value->status_etops . '</td>
                        </tr>';
                    }
                }
            }
            // Data Apply License EASA
            $sess_license_easa   = $this->session->userdata('sess_license_easa');
            $check_easa          = $sess_license_easa['check_easa'];
            $type_easa           = $sess_license_easa['type_easa'];
            $tab_spec_easa_s     = $sess_license_easa['tab_spec_easa_s'];
            $tab_category_easa_s = $sess_license_easa['tab_category_easa_s'];
            $tab_scope_easa_s    = $sess_license_easa['tab_scope_easa_s'];
            $etops_easa_s        = $sess_license_easa['etops_easa_s'];
            if (is_array($tab_scope_easa_s) || is_object($tab_scope_easa_s)) {
                foreach ($tab_scope_easa_s as $key => $value_easa) {
                    $tab_category_easa   = $tab_category_easa_s[$key];
                    $tab_spec_easa       = $tab_spec_easa_s[$key];
                    $tab_scope_easa      = $value_easa;
                    $etops_easa          = $etops_easa_s[$key];
                    //$query_license_easa=array();
                    $master_license_easa = $this->m_apply_license->query_license($check_easa, $type_easa, $tab_spec_easa, $tab_category_easa, $tab_scope_easa, $etops_easa)->result();
                    foreach ($master_license_easa as $value_easa) {
                        @$data_license_easa .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $value_easa->name_t . '</td>
                    <td>' . $value_easa->name_type . '</td>
                    <td>' . $value_easa->name_spect . '</td>
                    <td>' . $value_easa->name_category . '</td>
                    <td>' . $value_easa->name_scope . '</td>
                    <td>' . $value_easa->status_etops . '</td>
                    </tr>';
                    }
                }
            }
            // Data Apply License Special
            $sess_license_special   = $this->session->userdata('sess_license_special');
            //$license                          = $sess_license_special['license'];         
            $check_special          = $sess_license_special['check_special'];
            $tab_spec_special_s     = $sess_license_special['tab_spec_special_s'];
            $tab_category_special_s = $sess_license_special['tab_category_special_s'];
            $tab_scope_special_s    = $sess_license_special['tab_scope_special_s'];
            $etops_special_s        = $sess_license_special['etops_special_s'];
            if (is_array($tab_scope_special_s) || is_object($tab_scope_special_s)) {
                foreach ($tab_scope_special_s as $key => $value) {
                    $tab_category_special   = $tab_category_special_s[$key];
                    $tab_spec_special       = $tab_spec_special_s[$key];
                    $tab_scope_special      = $value;
                    $etops_special          = $etops_special_s[$key];
                    //$query_license_special=array();                        
                    $master_license_special = $this->m_apply_license->query_license_special($check_special, $tab_spec_special, $tab_category_special, $tab_scope_special, $etops_special)->result();
                    foreach ($master_license_special as $value_special) {
                        @$data_license_special .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value_special->name_type . '</td>
                        <td>' . $value_special->name_type . '</td>
                        <td>' . $value_special->name_spect . '</td>
                        <td>' . $value_special->name_category . '</td>
                        <td>' . $value_special->name_scope . '</td>
                        <td>' . $value_special->status_etops . '</td>
                        </tr>';
                    }
                }
            }
            // Data Apply License Garuda
            $sess_with_garuda             = $this->session->userdata('sess_with_garuda');
            $check_customer_authorization = $sess_with_garuda['check_customer_authorization'];
            $type_customer                = $sess_with_garuda['type_customer'];
            $tab_spec_garuda_s            = $sess_with_garuda['tab_spec_garuda_s'];
            $tab_category_garuda_s        = $sess_with_garuda['tab_category_garuda_s'];
            $tab_scope_garuda_s           = $sess_with_garuda['tab_scope_garuda_s'];
            $etops_garuda_s               = $sess_with_garuda['etops_garuda_s'];
            //print_r($sess_with_garuda);
            //                die();
            if (is_array($tab_scope_garuda_s) || is_object($tab_scope_garuda_s)) {
                foreach ($tab_scope_garuda_s as $key => $value_garuda) {
                    $tab_category_garuda = $tab_category_garuda_s[$key];
                    $tab_spec_garuda     = $tab_spec_garuda_s[$key];
                    $tab_scope_garuda    = $value_garuda;
                    $etops_garuda        = $etops_garuda_s[$key];
                    $master_garuda       = $this->m_apply_license->query_license($check_customer_authorization, $type_customer, $tab_spec_garuda, $tab_category_garuda, $tab_scope_garuda, $etops_garuda)->result();
                    foreach ($master_garuda as $value_garuda) {
                        @$data_with_garuda .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value_garuda->name_t . '</td>
                        <td>' . $value_garuda->name_type . '</td>
                        <td>' . $value_garuda->name_spect . '</td>
                        <td>' . $value_garuda->name_category . '</td>
                        <td>' . $value_garuda->name_scope . '</td>
                        <td>' . $value_garuda->status_etops . '</td>
                        </tr>';
                    }
                }
            }
            // Data Apply License Citilink
            $sess_with_citilink           = $this->session->userdata('sess_with_citilink');
            $check_customer_authorization = $sess_with_citilink['check_customer_authorization'];
            $type_customer                = $sess_with_citilink['type_customer'];
            $tab_spec_citilink_s          = $sess_with_citilink['tab_spec_citilink_s'];
            $tab_category_citilink_s      = $sess_with_citilink['tab_category_citilink_s'];
            $tab_scope_citilink_s         = $sess_with_citilink['tab_scope_citilink_s'];
            $etops_citilink_s             = $sess_with_citilink['etops_citilink_s'];
            if (is_array($tab_scope_citilink_s) || is_object($tab_scope_citilink_s)) {
                foreach ($tab_scope_citilink_s as $key => $value_citilink) {
                    $tab_category_citilink = $tab_category_citilink_s[$key];
                    $tab_spec_citilink     = $tab_spec_citilink_s[$key];
                    $tab_scope_citilink    = $value_citilink;
                    $etops_citilink        = $etops_citilink_s[$key];
                    $master_citilink       = $this->m_apply_license->query_license($check_customer_authorization, $type_customer, $tab_spec_citilink, $tab_category_citilink, $tab_scope_citilink,$etops_citilink)->result();
                    foreach ($master_citilink as $value_citilink) {
                        @$data_with_citilink .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value_citilink->name_t . '</td>
                        <td>' . $value_citilink->name_type . '</td>
                        <td>' . $value_citilink->name_spect . '</td>
                        <td>' . $value_citilink->name_category . '</td>
                        <td>' . $value_citilink->name_scope . '</td>
                        <td>' . $value_citilink->status_etops . '</td>
                        </tr>';
                    }
                }
            }
            // Data Apply License Sriwijaya
            $sess_with_sriwijaya          = $this->session->userdata('sess_with_sriwijaya');
            $check_customer_authorization = $sess_with_sriwijaya['check_customer_authorization'];
            $type_customer                = $sess_with_sriwijaya['type_customer'];
            $tab_spec_sriwijaya_s         = $sess_with_sriwijaya['tab_spec_sriwijaya_s'];
            $tab_category_sriwijaya_s     = $sess_with_sriwijaya['tab_category_sriwijaya_s'];
            $tab_scope_sriwijaya_s        = $sess_with_sriwijaya['tab_scope_sriwijaya_s'];
            $etops_sriwijaya_s            = $sess_with_sriwijaya['etops_sriwijaya_s'];
            if (is_array($tab_scope_sriwijaya_s) || is_object($tab_scope_sriwijaya_s)) {
                foreach ($tab_scope_sriwijaya_s as $key => $value_sriwijaya) {
                    $tab_category_sriwijaya = $tab_category_sriwijaya_s[$key];
                    $tab_spec_sriwijaya     = $tab_spec_sriwijaya_s[$key];
                    $tab_scope_sriwijaya    = $value_sriwijaya;
                    $etops_sriwijaya        = $etops_sriwijaya_s[$key];
                    $master_sriwijaya       = $this->m_apply_license->query_license($check_customer_authorization, $type_customer, $tab_spec_sriwijaya, $tab_category_sriwijaya, $tab_scope_sriwijaya,$etops_sriwijaya)->result();
                    foreach ($master_sriwijaya as $value_sriwijaya) {
                        @$data_with_sriwijaya .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value_sriwijaya->name_t . '</td>
                        <td>' . $value_sriwijaya->name_type . '</td>
                        <td>' . $value_sriwijaya->name_spect . '</td>
                        <td>' . $value_sriwijaya->name_category . '</td>
                        <td>' . $value_sriwijaya->name_scope . '</td>
                        <td>' . $value_sriwijaya->status_etops . '</td>
                        </tr>';
                    }
                }
            }
            // Data Apply License Cofc
            $sess_with_cofc      = $this->session->userdata('sess_with_cofc');
            $check_cofc          = $sess_with_cofc['check_cofc'];
            $type_cofc           = $sess_with_cofc['type_cofc'];
            $tab_spec_cofc_s     = $sess_with_cofc['tab_spec_cofc_s'];
            $tab_category_cofc_s = $sess_with_cofc['tab_category_cofc_s'];
            $tab_scope_cofc_s    = $sess_with_cofc['tab_scope_cofc_s'];
            if (is_array($tab_scope_cofc_s) || is_object($tab_scope_cofc_s)) {
                foreach ($tab_scope_cofc_s as $key => $value_cofc) {
                    $tab_category_cofc = $tab_category_cofc_s[$key];
                    $tab_spec_cofc     = $tab_spec_cofc_s[$key];
                    $tab_scope_cofc    = $value_cofc;
                    $master_cofc       = $this->m_apply_license->query_license($check_cofc, $type_cofc, $tab_spec_cofc, $tab_category_cofc, $tab_scope_cofc)->result();
                    foreach ($master_cofc as $value_cofc) {
                        @$data_with_cofc .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $value_cofc->name_t . '</td>
                        <td>' . $value_cofc->name_type . '</td>
                        <td>' . $value_cofc->name_spect . '</td>
                        <td>' . $value_cofc->name_category . '</td>
                        <td>' . $value_cofc->name_scope . '</td>
                        <td></td>
                        </tr>';
                    }
                }
            }
            $data['user_data']              = $this->session->userdata('users_applicant');
            $data['data_license']           = @$data_license;
            $data['data_license_garuda']    = @$data_license_garuda;
            $data['data_license_citilink']  = @$data_license_citilink;
            $data['data_license_sriwijaya'] = @$data_license_sriwijaya;
            $data['data_license_easa']      = @$data_license_easa;
            $data['data_license_special']   = @$data_license_special;
            $data['data_with_garuda']       = @$data_with_garuda;
            $data['data_with_citilink']     = @$data_with_citilink;
            $data['data_with_sriwijaya']    = @$data_with_sriwijaya;
            $data['data_with_cofc']         = @$data_with_cofc;
            $data['sess_data_personnel']    = $this->session->userdata('sess_data_personnel');
            $data['sess_license']           = $this->session->userdata('sess_license');
            $data['data_completing_data']   = $this->session->userdata('sess_completing_data');
            $this->page->view('summary', $data);
                                                   
        } else {
            redirect(site_url('apply_license/index'));
        }
    }
    public 
    // -- Function Name : summary
        
    // -- Params : 
        
    // -- Purpose : 
    function summary()
    {
        if (isset($_POST['submitsummary'])) {
            $sess_summary   = array(
                'submitsummary' => $this->input->post('submitsummary')
            );
            $date_time      = new DateTime();
            $date_now       = $date_time->format('d-m-Y H:i:s');
            $request_number = $this->input->post('sumrequestnumber');
            $sess_license   = $this->session->userdata('sess_license');            
            $data_apply     = array(
                'request_number'        => $this->input->post('sumrequestnumber'),
                'personnel_number'      => $this->input->post('sumpersonnelnumber'),
                'reason_apply_license'  => $sess_license['status_license'],
                'code_unit'             => $this->input->post('sumunit'),
                'status_submit'         => '1',
                'date_request'          => date('Y-m-d H:i:s'),
                'priority'              => 'Normal',
                'flag'                  => '1'
            );            
            $this->db->insert('t_apply_license', $data_apply);
            $tab_spec_s            = $sess_license['tab_spec_s'];
            $tab_category_s        = $sess_license['tab_category_s'];
            $tab_scope_s           = $sess_license['tab_scope_s'];
            $tab_scope_assesment_s = $sess_license['tab_scope_assesment_s'];
            $etops_s               = $sess_license['etops_s'];
            if (is_array($tab_scope_s) || is_object($tab_scope_s)) {
                foreach ($tab_scope_s as $key => $value) {
                    $data_license = array(
                        'request_number_fk'     => $request_number,
                        'id_auth_license_fk'    => $sess_license['license'],
                        'id_auth_type_fk'       => $sess_license['type'],
                        'id_auth_spect_fk'      => $tab_spec_s[$key],
                        'id_auth_category_fk'   => $tab_category_s[$key],
                        'id_auth_scope_fk'      => $tab_scope_s[$key],
                        'id_assesment_scope_fk' => $tab_scope_assesment_s[$key],
                        'is_etops'              => $etops_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_license);
                }
            }
            $sess_license_garuda                  = $this->session->userdata('sess_license_garuda');
            $tab_spec_license_garuda_s            = $sess_license_garuda['tab_spec_license_garuda_s'];
            $tab_category_license_garuda_s        = $sess_license_garuda['tab_category_license_garuda_s'];
            $tab_scope_license_garuda_s           = $sess_license_garuda['tab_scope_license_garuda_s'];
            $tab_scope_assesment_license_garuda_s = $sess_license_garuda['tab_scope_assesment_license_garuda_s'];
            $etops_license_garuda_s               = $sess_license_garuda['etops_license_garuda_s'];
            if (is_array($tab_scope_license_garuda_s) || is_object($tab_scope_license_garuda_s)) {
                foreach ($tab_scope_license_garuda_s as $key => $value_license_garuda) {
                    $data_license_garuda        = array(
                        'request_number_fk'     => $request_number,
                        'id_auth_license_fk'    => $sess_license_garuda['license'],
                        'id_auth_type_fk'       => $sess_license_garuda['type_check_23'],
                        'id_auth_spect_fk'      => $tab_spec_license_garuda_s[$key],
                        'id_auth_category_fk'   => $tab_category_license_garuda_s[$key],
                        'id_auth_scope_fk'      => $tab_scope_license_garuda_s[$key],
                        'id_assesment_scope_fk' => $tab_scope_assesment_license_garuda_s[$key],
                        'is_etops'              => $etops_license_garuda_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_license_garuda);
                }
            }
            $sess_license_citilink                  = $this->session->userdata('sess_license_citilink');
            $tab_spec_license_citilink_s            = $sess_license_citilink['tab_spec_license_citilink_s'];
            $tab_category_license_citilink_s        = $sess_license_citilink['tab_category_license_citilink_s'];
            $tab_scope_license_citilink_s           = $sess_license_citilink['tab_scope_license_citilink_s'];
            $tab_scope_assesment_license_citilink_s = $sess_license_citilink['tab_scope_assesment_license_citilink_s'];
            $etops_license_citilink_s             = $sess_license_citilink['etops_license_citilink_s'];
            if (is_array($tab_scope_license_citilink_s) || is_object($tab_scope_license_citilink_s)) {
                foreach ($tab_scope_license_citilink_s as $key => $value_license_citilink) {
                    $data_license_citilink = array(
                        'request_number_fk'         => $request_number,
                        'id_auth_license_fk'        => $sess_license_citilink['license'],
                        'id_auth_type_fk'           => $sess_license_citilink['type_check_24'],
                        'id_auth_spect_fk'          => $tab_spec_license_citilink_s[$key],
                        'id_auth_category_fk'       => $tab_category_license_citilink_s[$key],
                        'id_auth_scope_fk'          => $tab_scope_license_citilink_s[$key],
                        'id_assesment_scope_fk'     => $tab_scope_assesment_license_citilink_s[$key],
                        'is_etops'                  => $etops_license_citilink_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_license_citilink);
                }
            }
            $sess_license_sriwijaya                  = $this->session->userdata('sess_license_sriwijaya');
            $tab_spec_license_sriwijaya_s            = $sess_license_sriwijaya['tab_spec_license_sriwijaya_s'];
            $tab_category_license_sriwijaya_s        = $sess_license_sriwijaya['tab_category_license_sriwijaya_s'];
            $tab_scope_license_sriwijaya_s           = $sess_license_sriwijaya['tab_scope_license_sriwijaya_s'];
            $tab_scope_assesment_license_sriwijaya_s = $sess_license_sriwijaya['tab_scope_assesment_license_sriwijaya_s'];
            $etops_license_sriwijaya_s               = $sess_license_sriwijaya['etops_license_sriwijaya_s'];
            if (is_array($tab_scope_license_sriwijaya_s) || is_object($tab_scope_license_sriwijaya_s)) {
                foreach ($tab_scope_license_sriwijaya_s as $key => $value_sriwijaya) {
                    $data_license_sriwijaya = array(
                        'request_number_fk'         => $request_number,
                        'id_auth_license_fk'        => $sess_license_sriwijaya['license'],
                        'id_auth_type_fk'           => $sess_license_sriwijaya['type_check_25'],
                        'id_auth_spect_fk'          => $tab_spec_license_sriwijaya_s[$key],
                        'id_auth_category_fk'       => $tab_category_license_sriwijaya_s[$key],
                        'id_auth_scope_fk'          => $tab_scope_license_sriwijaya_s[$key],
                        'id_assesment_scope_fk'     => $tab_scope_assesment_license_sriwijaya_s[$key],
                        'is_etops'                  => $etops_license_sriwijaya_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_license_sriwijaya);
                }
            }
            $sess_license_easa          = $this->session->userdata('sess_license_easa');
            $tab_spec_easa_s            = $sess_license_easa['tab_spec_easa_s'];
            $tab_category_easa_s        = $sess_license_easa['tab_category_easa_s'];
            $tab_scope_easa_s           = $sess_license_easa['tab_scope_easa_s'];
            $tab_scope_assesment_easa_s = $sess_license_easa['tab_scope_assesment_easa_s'];
            $etops_easa_s             = $sess_license_easa['etops_easa_s'];
            if (is_array($tab_scope_easa_s) || is_object($tab_scope_easa_s)) {
                foreach ($tab_scope_easa_s as $key => $value_easa) {
                    $data_license_easa = array(
                        'request_number_fk'     => $request_number,
                        'id_auth_license_fk'    => $sess_license_easa['check_easa'],
                        'id_auth_type_fk'       => $sess_license_easa['type_easa'],
                        'id_auth_spect_fk'      => $tab_spec_easa_s[$key],
                        'id_auth_category_fk'   => $tab_category_easa_s[$key],
                        'id_auth_scope_fk'      => $tab_scope_easa_s[$key],
                        'id_assesment_scope_fk' => $tab_scope_assesment_easa_s[$key],
                        'is_etops'            => $etops_easa_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_license_easa);
                }
            }
            $sess_license_special          = $this->session->userdata('sess_license_special');
            $tab_spec_special_s            = $sess_license_special['tab_spec_special_s'];
            $tab_category_special_s        = $sess_license_special['tab_category_special_s'];
            $tab_scope_special_s           = $sess_license_special['tab_scope_special_s'];
            $tab_scope_assesment_special_s = $sess_license_special['tab_scope_assesment_special_s'];
            $etops_special_s               = $sess_license_special['etops_special_s'];
            if (is_array($tab_scope_special_s) || is_object($tab_scope_special_s)) {
                foreach ($tab_scope_special_s as $key => $value) {
                    $data_license_special = array(
                        'request_number_fk'     => $request_number,
                        'id_auth_license_fk'    => '2',
                        'id_auth_type_fk'       => $sess_license_special['check_special'],
                        'id_auth_spect_fk'      => $tab_spec_special_s[$key],
                        'id_auth_category_fk'   => $tab_category_special_s[$key],
                        'id_auth_scope_fk'      => $tab_scope_special_s[$key],
                        'id_assesment_scope_fk' => $tab_scope_assesment_special_s[$key],
                        'is_etops'            => $etops_special_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_license_special);
                }
            }
            $sess_with_garuda             = $this->session->userdata('sess_with_garuda');
            $tab_spec_garuda_s            = $sess_with_garuda['tab_spec_garuda_s'];
            $tab_category_garuda_s        = $sess_with_garuda['tab_category_garuda_s'];
            $tab_scope_garuda_s           = $sess_with_garuda['tab_scope_garuda_s'];
            $tab_scope_assesment_garuda_s = $sess_with_garuda['tab_scope_assesment_garuda_s'];
            $etops_garuda_s             = $sess_with_garuda['etops_garuda_s'];
            if (is_array($tab_scope_garuda_s) || is_object($tab_scope_garuda_s)) {
                foreach ($tab_scope_garuda_s as $key => $value_with_garuda) {
                    $data_with_garuda = array(
                        'request_number_fk'     => $request_number,
                        'id_auth_license_fk'    => $sess_with_garuda['check_customer_authorization'],
                        'id_auth_type_fk'       => $sess_with_garuda['type_customer'],
                        'id_auth_spect_fk'      => $tab_spec_garuda_s[$key],
                        'id_auth_category_fk'   => $tab_category_garuda_s[$key],
                        'id_auth_scope_fk'      => $tab_scope_garuda_s[$key],
                        'id_assesment_scope_fk' => $tab_scope_assesment_garuda_s[$key],
                        'is_etops'              => $etops_garuda_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_with_garuda);
                }
            }
            $sess_with_citilink             = $this->session->userdata('sess_with_citilink');
            $tab_spec_citilink_s            = $sess_with_citilink['tab_spec_citilink_s'];
            $tab_category_citilink_s        = $sess_with_citilink['tab_category_citilink_s'];
            $tab_scope_citilink_s           = $sess_with_citilink['tab_scope_citilink_s'];
            $tab_scope_assesment_citilink_s = $sess_with_citilink['tab_scope_assesment_citilink_s'];
            $etops_citilink_s             = $sess_with_citilink['etops_citilink_s'];
            if (is_array($tab_scope_citilink_s) || is_object($tab_scope_citilink_s)) {
                foreach ($tab_scope_citilink_s as $key => $value_with_citilink) {
                    $data_with_citilink = array(
                        'request_number_fk'     => $request_number,
                        'id_auth_license_fk'    => $sess_with_citilink['check_customer_authorization'],
                        'id_auth_type_fk'       => $sess_with_citilink['type_customer'],
                        'id_auth_spect_fk'      => $tab_spec_citilink_s[$key],
                        'id_auth_category_fk'   => $tab_category_citilink_s[$key],
                        'id_auth_scope_fk'      => $tab_scope_citilink_s[$key],
                        'id_assesment_scope_fk' => $tab_scope_assesment_citilink_s[$key],
                        'is_etops'            => $etops_citilink_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_with_citilink);
                }
            }
            $sess_with_sriwijaya             = $this->session->userdata('sess_with_sriwijaya');
            $tab_spec_sriwijaya_s            = $sess_with_sriwijaya['tab_spec_sriwijaya_s'];
            $tab_category_sriwijaya_s        = $sess_with_sriwijaya['tab_category_sriwijaya_s'];
            $tab_scope_sriwijaya_s           = $sess_with_sriwijaya['tab_scope_sriwijaya_s'];
            $tab_scope_assesment_sriwijaya_s = $sess_with_sriwijaya['tab_scope_assesment_sriwijaya_s'];
            $etops_sriwijaya_s             = $sess_with_sriwijaya['etops_sriwijaya_s'];
            if (is_array($tab_scope_sriwijaya_s) || is_object($tab_scope_sriwijaya_s)) {
                foreach ($tab_scope_sriwijaya_s as $key => $value_sriwijaya) {
                    $data_with_sriwijaya = array(
                        'request_number_fk'     => $request_number,
                        'id_auth_license_fk'    => $sess_with_sriwijaya['check_customer_authorization'],
                        'id_auth_type_fk'       => $sess_with_sriwijaya['type_customer'],
                        'id_auth_spect_fk'      => $tab_spec_sriwijaya_s[$key],
                        'id_auth_category_fk'   => $tab_category_sriwijaya_s[$key],
                        'id_auth_scope_fk'      => $tab_scope_sriwijaya_s[$key],
                        'id_assesment_scope_fk' => $tab_scope_assesment_sriwijaya_s[$key],
                        'is_etops'              => $etops_sriwijaya_s[$key],
                    );
                    $this->db->insert('t_apply_license_dtl', $data_with_sriwijaya);
                }
            }
            $sess_with_cofc             = $this->session->userdata('sess_with_cofc');
            $check_cofc                 = $sess_with_cofc['check_cofc'];
            $type_cofc                  = $sess_with_cofc['type_cofc'];
            $tab_spec_cofc_s            = $sess_with_cofc['tab_spec_cofc_s'];
            $tab_category_cofc_s        = $sess_with_cofc['tab_category_cofc_s'];
            $tab_scope_cofc_s           = $sess_with_cofc['tab_scope_cofc_s'];
            $tab_scope_assesment_cofc_s = $sess_with_cofc['tab_scope_assesment_cofc_s'];
            if (is_array($tab_scope_cofc_s) || is_object($tab_scope_cofc_s)) {
                foreach ($tab_scope_cofc_s as $key => $value_cofc) {
                    $data_with_cofc = array(
                        'request_number_fk'     => $request_number,
                        'id_auth_license_fk'    => $sess_with_cofc['check_cofc'],
                        'id_auth_type_fk'       => $sess_with_cofc['type_cofc'],
                        'id_auth_spect_fk'      => $tab_spec_cofc_s[$key],
                        'id_auth_category_fk'   => $tab_category_cofc_s[$key],
                        'id_auth_scope_fk'      => $tab_scope_cofc_s[$key],
                        'id_assesment_scope_fk' => $tab_scope_assesment_cofc_s[$key]
                    );
                    $this->db->insert('t_apply_license_dtl', $data_with_cofc);
                }
            }            
            $sess_data_personnel     = $this->session->userdata('sess_data_personnel');
            // Send Notification Email To Atasan  
            $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'devlicensetq@gmail.com',
            'smtp_pass' => 'Bismillah1995', 
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE);

            $email                   = 'mail.gmf-aeroasia.co.id';
            $name                    = $sess_data_personnel['name'];
            $personnel_number        = $sess_data_personnel['personnel_number'];
            $sess_data_superior      = $this->m_apply_license->get_data_row_personnel_by($personnel_number);
            $sess_data_gm            = $this->m_apply_license->get_gm_personnel_by($personnel_number)->row_array();
            $unit                    = $sess_data_personnel['departement'];
            $presenttitle            = $sess_data_personnel['presenttitle'];
            $email_superior          = $sess_data_superior['EMAIL_SUPERIOR'];
            $email_gm                = $sess_data_gm['email'];
            $cek_validate_req_number = $request_number;
            $url                     = $_SERVER['HTTP_REFERER'];
            $url_cek_approved_atasan = base_url() . 'index.php/apply_license/cek_approved_atasan/' . $cek_validate_req_number . '/' . $personnel_number;
                                                  
            $cekdataemail            = $this->m_apply_license->cek_approved_atasan($cek_validate_req_number, $personnel_number);
            $date_validity           = date('d-m-Y', strtotime('+30 days', strtotime($cekdataemail[0]->date_request)));
            $date_now                = date('d-m-Y');
      
            $cekdataemp              = $this->m_apply_license->get_data_row_personnel_by($personnel_number);
            $content_email_apply     = $this->m_apply_license->get_content_msg_apply('1');

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($email);
            $this->email->to($email_superior);                        
            // $this->email->to($email_gm);                       
            $this->email->subject(@$content_email_apply['subject']);
            $pesan = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
                    "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                    <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
                    </head></body>';
            $pesan .= '<p>Dear Mr/Mrs ' . $cekdataemp['NAME_SUPERIOR'] . '</p>';
            $pesan .= '<p>'. $content_email_apply['title'] .'</p>';
            $pesan .= '<p>1. <b>' . $cekdataemp['EMPLNAME'] . '</b>/<b>' . $cekdataemp['UNIT'] . '</b>/<b>' . $cekdataemp['PERNR'] . '     Jobtitle : (' . $cekdataemp['JOBTITLE'] . ')</b></p>';
            $pesan .= '<p>as detailed below : </p>';
            $pesan .= '<p><b>Request Number</b> : ' . $cek_validate_req_number . '</p>';
            $pesan .= '<p><b>Date of Request</b> : ' . date('Y-m-d H:i:s') . '</p>';
            $pesan .= '<table border="1">
                        <tr>
                        <td> No </td>
                        <td> Authorization </td>
                        <td> Authorization Type </td>
                        <td> Reason of Type </td>                        
                        <td> Scope of Authorization </td>                        
                        </tr>';
            $no = 1;
            foreach ($cekdataemail as $row) {
                $pesan .= '<tr>                        
                        <td> ' . $no++ . ' </td>
                        <td> ' . $row->name_license . ' </td>
                        <td> ' . $row->name_type . ' </td>';
                $status = $row->reason_apply_license;
                switch ($status) {
                    case 1:
                        $reason_apply_license = 'New Authorization';
                        break;
                    case 2:
                        $reason_apply_license = 'Renewal';
                        break;
                    case 3:
                        $reason_apply_license = 'Additional';
                        break;
                    case 4:
                        $reason_apply_license = 'Rating Change/ Upgrade';
                        break;
                }
                $c_etops = $row->is_etops;
                
                switch ($c_etops) {
                    case 0:
                        $etops = '';
                        break;
                    case 1:
                        $etops = '+ ETOPS';
                        break;
                    }
                $pesan .= '                    
                        <td> ' . $reason_apply_license . ' </td>                                                
                        <td> ' . $row->name_scope . ' ' . $etops .' </td>                                                
                        </tr>';
                    }
            $pesan .= '</table>';            
            $pesan .= $content_email_apply['content'];
            $pesan .= '<p>To APPROVE or DISAPPROVE the License application, please click the link below : </p>';
                if (date('Y-m-d', strtotime($date_validity)) >= date('Y-m-d', strtotime($date_now))) {
                    $pesan .= '<p><a href=' . $url_cek_approved_atasan . '> ' . $url_cek_approved_atasan . '</a></p>';
                } else if (date('Y-m-d', strtotime($date_validity)) < date('Y-m-d', strtotime($date_now))) {
                    $pesan .= '<p><a href="#">Link Not Valid</a></p>';
                };
            $pesan .= $content_email_apply['footer'];
            //        die($pesan);                
            $this->email->message($pesan);
            if ($this->email->send()) {                
                $this->session->set_flashdata('content_not_valid', 'Send successfull.');
                redirect(base_url());
                $this->session->unset_userdata('sess_license');
                $this->session->unset_userdata('sess_license_easa');
                $this->session->unset_userdata('sess_license_special');
                $this->session->unset_userdata('sess_license_garuda');
                $this->session->unset_userdata('sess_license_citilink');
                $this->session->unset_userdata('sess_license_sriwijaya');
            } else {                
                $this->session->set_flashdata('content_not_valid', 'Send failed.');
                redirect(base_url());
                $this->session->unset_userdata('sess_license');
                $this->session->unset_userdata('sess_license_easa');
                $this->session->unset_userdata('sess_license_special');
                $this->session->unset_userdata('sess_license_garuda');
                $this->session->unset_userdata('sess_license_citilink');
                $this->session->unset_userdata('sess_license_sriwijaya');
            }
        } else {
            redirect(site_url('apply_license/index'));
        }
    }
    public 
    // -- Function Name : cek_approved_atasan
        
    // -- Params : $cek_validate_req_number, $typeemp, $personnel_number
        
    // -- Purpose : 
   function cek_approved_atasan($cek_validate_req_number = '', $personnel_number = '')
    {
        $user_data              = $this->session->userdata('users_applicant');
        $sess_personnel         = $user_data->PERNR;
        $sess_report_to         = $this->m_apply_license->get_data_row_personnel_by($personnel_number);
        $sess_data_gm            = $this->m_apply_license->get_gm_personnel_by($personnel_number)->row_array();
        $report_to              = $sess_report_to['REPORT_TO'];
        $report_gm              = $sess_data_gm['personnel_number'];
        
        if ($sess_personnel == $report_to || $sess_personnel == $report_gm) {
            @$cek_content_approved  = "SELECT TOP 1 * FROM m_content_approved";
            @$cek_approved_atasan   = $this->m_apply_license->cek_approved_atasan($cek_validate_req_number, $personnel_number);
            @$date_validity         = date('d-m-Y', strtotime('+30 days', strtotime($cek_approved_atasan[0]->date_request)));            
            @$date_now              = date('d-m-Y');                
            if($cek_approved_atasan!='') {
                if (date('Y-m-d', strtotime($date_validity)) < date('Y-m-d', strtotime($date_now))) {
                    $data['content'] = $this->session->set_flashdata('content_not_valid', 'Link not valid, because superior already approval/ disapproval');
                    redirect(site_url('home'));
                } else {
                               
                                    $no = 1;
                                    foreach ($cek_approved_atasan as $value) {
                                        @$data_cek_approved_atasan .= '<tr>                        
                                        <td> ' . $no++ . ' </td>                                     
                                        <td> ' . $value->name_type . ' </td>';
                                        $status = $value->reason_apply_license;
                                        switch ($status) {
                                            case 1:
                                                $reason_apply_license = 'New Authorization';
                                                break;
                                            case 2:
                                                $reason_apply_license = 'Renewal';
                                                break;
                                            case 3:
                                                $reason_apply_license = 'Additional';
                                                break;
                                            case 4:
                                                $reason_apply_license = 'Rating Change/ Upgrade';
                                                break;
                                        };
                                        $is_etops = $value->is_etops;
                                        switch ($is_etops) {
                                            case 1 : 
                                                $status_etops = ' + ETOPS';
                                                break;
                                            case 0 :
                                                $status_etops = '';
                                                break;
                                        };
                                        @$data_cek_approved_atasan .= '<td> ' . $reason_apply_license . ' </td>                                     
                                        <td> ' . $value->name_spect . ' ' . $value->name_category . ' ' . $value->name_scope . ' '. $status_etops.' </td>                                              
                                        </tr>';
                                    }
                                
                            @$get_data_apply_personnel_by = $this->m_apply_license->get_data_apply_personnel_by($personnel_number);
                            @$get_request_apply_personnel_by = $this->m_apply_license->get_request_apply_personnel_by($cek_validate_req_number, $personnel_number);                                
                            $data['data_cek_approved_atasan']       = @$data_cek_approved_atasan;
                            $data['get_data_apply_personnel_by']    = @$get_data_apply_personnel_by;
                            $data['get_request_apply_personnel_by'] = @$get_request_apply_personnel_by;
                            $data['content_approved']               = @$this->m_apply_license->get_content_msg_apply('2');
                            $this->page->view('apply_license/approved_view', $data);
                        }
            } else {
                $this->session->set_flashdata('content_not_valid', 'Link not valid');
                redirect(site_url('home'));
            }
        } else {
                $this->session->set_flashdata('content_not_valid', 'Approval by superior or GM.');
                redirect(site_url('home'));
        }
    }

    public 
    // -- Function Name : approved_superior
        
    // -- Params : 
        
    // -- Purpose : 
    function approved_superior()
    {
        $user_data                  = $this->session->userdata('users_applicant');
        $sess_data_personnel        = $this->session->userdata('sess_data_personnel');
        $user_approved              = $user_data->PERNR;
        $request_number             = $this->input->post('request_number_applicant');
        $personnel_number_applicant = $this->input->post('personnel_number_applicant');
        $request_number_approved    = $this->input->post('request_number_applicant');
        $personnel_number_superior  = $sess_data_personnel['personnel_number'];
        $typeemp_superior           = $sess_data_personnel['typeemp'];
        $url                        = $_SERVER['HTTP_REFERER'];
        $query_cekemail_approved    = "SELECT a.date_approved_superior, c.name_t AS name_license, a.reason_apply_license AS reason_apply_license, a.request_number AS request_number, d.name_t AS name_type, g.name_t AS name_scope FROM t_apply_license a
            LEFT JOIN t_apply_license_dtl b ON a.request_number = b.request_number_fk
            LEFT JOIN m_auth_license c ON b.id_auth_license_fk = c.id  
            LEFT JOIN m_auth_type d ON b.id_auth_type_fk = d.id                               
            LEFT JOIN m_auth_scope g ON b.id_auth_scope_fk = g.id                                                  
            WHERE a.request_number = '$request_number_approved' AND a.personnel_number = '$personnel_number_superior'";
        $cekdataemailapproved       = $this->db->query($query_cekemail_approved)->result();
        $data_applicant             = $this->m_apply_license->get_data_row_personnel_by($personnel_number_applicant);
        $name_applicant             = $data_applicant['EMPLNAME'];
        $email_applicant            = $data_applicant['EMAIL'];
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'devlicensetq@gmail.com',
        'smtp_pass' => 'Bismillah1995', 
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE);
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('mail.gmf-aeroasia.co.id');
        $this->email->to($email_applicant);
        $this->email->subject('APPLY LICENSE');
        if (isset($_POST['submitapproved'])) {
            $cek_content_approved    =  $this->m_apply_license->get_content_msg_apply('3');
            $this->email->subject(@$cek_content_approved['subject']);                                    
            $cekdataempsup  = $this->m_apply_license->get_emp_data_superior_by($user_approved);
            // content approved superior = 3            
            $pesan          = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
            "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
            <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/></head></body>';
            $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
            $pesan .= '<p>'. $cek_content_approved['title'] .'</p>';
            $pesan .= '<p><b>Request Number</b> : ' . $request_number_approved . '</p>';
            $pesan .= '<p>Has been <b> APPROVED </b> by :</p>';
            $pesan .= '<p>Name : ' . $cekdataempsup['name'] . '</p>';
            $pesan .= '<p>ID Number : ' . $cekdataempsup['personnel_number'] . '</p>';
            $pesan .= '<p>Unit : ' . $cekdataempsup['departement'] . '</p>';
            $pesan .= '<p>Job Title : ' . $cekdataempsup['presenttitle'] . '</p>';
            $pesan .= $cek_content_approved['content'];
            $pesan .= $cek_content_approved['footer'];     
            $this->email->message($pesan);            
            $this->session->set_flashdata('content_not_valid', 'Approval successfull.');
            //Send Notification Email To Atasan                                 
            if ($this->email->send()) {
                $query_validate = "UPDATE t_apply_license SET status_approved_superior = '1', personnel_number_superior = '$user_approved', date_approved_superior = GETDATE() WHERE request_number = '$request_number' AND personnel_number = '$personnel_number_applicant'";
                $this->db->query($query_validate);
                $send_email=array(
                    'send_email' => 1,    
                    );
                $this->db->where('t_apply_license.request_number', $request_number);
                $this->db->update('t_apply_license',$send_email); 
                redirect(site_url('home/index'));
            } else {
                $this->session->set_flashdata('content_not_valid', 'Failed to Process approval/disapproval superior, please click "Superior Approval" again.');
                redirect(site_url('home/index'));
            }
        } else if (isset($_POST['submitdisapproved'])) {
           // content approved superior = 4   
            $cek_content_disapproved    =  $this->m_apply_license->get_content_msg_apply('4');                                                
            $cekdataempsup = $this->m_apply_license->get_emp_data_superior_by($user_approved);            
            $this->email->subject(@$cek_content_disapproved['subject']);
            $pesan         = '<!DOCTYPE html PUBLIC "-W3CDTD XHTML 1.0 StrictEN"
            "http:www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
            <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/></head></body>';
            $pesan .= '<p>Dear Mr/Mrs ' . $name_applicant . '</p>';
            $pesan .= '<p>'. $cek_content_disapproved['title'] .'</p>';
            $pesan .= '<p><b>Request Number</b> : ' . $request_number_approved . '</p>';
            $pesan .= '<p>Was <b> REJECTED</b> by :</p>';
            $pesan .= '<p>Name : ' . $cekdataempsup['name'] . '</p>';
            $pesan .= '<p>ID Number : ' . $cekdataempsup['personnel_number'] . '</p>';
            $pesan .= '<p>Unit : ' . $cekdataempsup['departement'] . '</p>';
            $pesan .= '<p>Job Title : ' . $cekdataempsup['presenttitle'] . '</p>';
            $pesan .= $cek_content_disapproved['content'];
            $pesan .= $cek_content_disapproved['footer'];             
            $this->email->message($pesan);
            $this->session->set_flashdata('content_not_valid', 'Disapproval successfull.');
            //Send Notification Email To Atasan                                 
            if ($this->email->send()) {
                $query_validate = "UPDATE t_apply_license SET status_approved_superior = '2', personnel_number_superior = '$user_approved', date_approved_superior = GETDATE(), date_finish = GETDATE(), personnel_number_finish = '$user_approved' WHERE request_number = '$request_number' AND personnel_number = '$personnel_number_applicant'";
                $this->db->query($query_validate);
                $send_email=array(
                    'send_email' => 1,    
                    );
                $this->db->where('t_apply_license.request_number', $request_number);
                $this->db->update('t_apply_license',$send_email); 
                redirect(site_url('home/index'));
            } else {
                $this->session->set_flashdata('content_not_valid', 'Failed to Process approval/disapproval superior, please click link email again.');
                redirect(site_url('home/index'));
            }
        }            
    }
    public 
    // -- Function Name : history_request_number
        
    // -- Params : 
        
    // -- Purpose : 
    function history_request_number($p_request_number = '', $personnel_number = '')
    {
        $user_data             = $this->session->userdata('users_applicant');
        $name_personnel        = str_replace("'", '', $this->input->post('name_personnel'));
        $request_number        = $this->input->post('request_number');
        $post_personnel_number = $this->input->post('personnel_number');
        $date_request          = $this->input->post('date_request');
        $status                = $this->input->post('status');
        $cekdatasummary        = $this->m_apply_license->cek_data_summary($p_request_number, $request_number, $personnel_number, $post_personnel_number);
        $where                      = "t_apply_license.flag='1'";        
        if (!empty($request_number)) {
            $where .= " AND t_apply_license.request_number='$request_number' ";            
        };
        if (!empty($p_request_number)) {
            $where .= " AND t_apply_license.request_number='$p_request_number' ";            
        };
        if (!empty($post_personnel_number)) {
            $where .= " AND (CONVERT(varchar(50),TSH.personnel_number) = '$post_personnel_number')";
        };
        if (!empty($date_request)) {
            $where .= " AND (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),105))='$date_request'";
        };
        if (!empty($name_personnel)) {
            $where .= " AND TSH.name LIKE '%$name_personnel%' ";
        };
        
        $data_query               = "SELECT TOP 1  TSH.name, TSH.personnel_number, TSH.departement, TSH.presenttitle, TSH.mobilephone, TSH.businessphone, t_apply_license.request_number, t_apply_license.status_assesment AS check_assesment,
            (CASE t_apply_license.status_submit WHEN '1' THEN 'Data Submited' END) AS submited, 
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),105)) AS date_submited,
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_request,120),108)) AS time_submited, 
            (CASE t_apply_license.status_approved_superior WHEN '1' THEN 'Approved Superior' WHEN '2' THEN 'Rejected Superior' END) AS approved_superior,
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_superior,120),105)) AS date_approved_superior, 
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_superior,120),108)) AS time_approved_superior, 
            (CASE t_apply_license.status_approved_quality WHEN '1' THEN 'Data Validated' WHEN '2' THEN 'Data Not Valid' END) AS approved_quality, 
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_quality,120),105)) AS date_approved_quality, 
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_approved_quality,120),108)) AS time_approved_quality,
            (CASE t_apply_license.status_assesment WHEN '1' THEN 'Assesment Process' WHEN '2' THEN 'Assesment Process Closed' END) AS status_assesment,
            (SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, TA.date_assesment,120),105)) FROM t_assesment AS TA 
            WHERE (TA.request_number_fk='$request_number' OR TA.request_number_fk = '$p_request_number')) AS date_assesment ,
            (SELECT TOP 1 (CONVERT(varchar(10), CONVERT(datetime, TA.date_assesment,120),108)) FROM t_assesment AS TA WHERE (TA.request_number_fk='$request_number' OR TA.request_number_fk = '$p_request_number')) AS time_assesment,
            (CASE (SELECT TOP 1 TA.status_assesment FROM t_assesment AS TA WHERE (TA.request_number_fk='$request_number' OR TA.request_number_fk = '$p_request_number')) WHEN '1' THEN 'Lulus' WHEN '2' THEN 'Tidak Lulus' END) AS verification_assesment,
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),105)) AS date_verification_assesment,
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_assesment,120),108)) AS time_verification_assesment,                            
            (SELECT 'GMF Authorization Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '1' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS desc_gmf_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '1' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS date_gmf_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '1' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS time_gmf_issue_authorization,
            (SELECT 'C of C and/or Stamp Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '2' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS desc_coc_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '2' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS date_coc_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '2' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS time_coc_issue_authorization,
            (SELECT 'EASA Authorization Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '3' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS desc_easa_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '3' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS date_easa_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '3' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS time_easa_issue_authorization,
            (SELECT 'GA Authorization Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '4' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS desc_ga_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '4' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS date_ga_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '4' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS time_ga_issue_authorization,
            (SELECT 'Citilink Authorization Issued' FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '5' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS desc_clink_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA  WHERE TIA.id_issue_fk = '5' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS date_clink_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '5' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS time_clink_issue_authorization,
            (SELECT 'Sriwijaya Authorization Issued' FROM t_issue_authorization AS TIA  WHERE TIA.id_issue_fk = '6' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS desc_srwj_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),105)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '6' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS date_srwj_issue_authorization,
            (SELECT (CONVERT(varchar(10), CONVERT(datetime, TIA.date_issue,120),108)) FROM t_issue_authorization AS TIA WHERE TIA.id_issue_fk = '6' AND (TIA.request_number_fk='$request_number' OR TIA.request_number_fk = '$p_request_number')) AS time_srwj_issue_authorization,
            (CASE t_apply_license.status_issue_authorization WHEN '2' THEN 'Issue Authorization Finished' END) AS status_issue_authorization,
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),105)) AS date_stts_issue_authorization, 
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_status_issue_authorization,120),108)) AS time_stts_issue_authorization,
            (CASE t_apply_license.referral_authorization WHEN '1' THEN 'Referral Authorization' END) AS status_referral_authorization,
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_referral_authorization,120),105)) AS date_referral_authorization, 
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_referral_authorization,120),108)) AS time_referral_authorization,
            (CASE t_apply_license.take_authorization WHEN '1' THEN 'Personnel Record Completed' END) AS status_take_authorization,
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),105)) AS date_take_authorization, 
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_take_authorization,120),108)) AS time_take_authorization,
            (CASE t_apply_license.finished WHEN '1' THEN 'Success' END) AS status_finish,
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),105)) AS date_finish, 
            (CONVERT(varchar(10), CONVERT(datetime, t_apply_license.date_finish,120),108)) AS time_finish                
            FROM t_apply_license 
            LEFT JOIN (SELECT personnel_number, name,  presenttitle, departement, email, dateofbirth, dateofemployee, mobilephone, businessphone FROM m_employee
            WHERE personnel_number='$personnel_number' OR personnel_number = '$post_personnel_number'
            UNION
            SELECT (CONVERT(varchar(10),TSH.PERNR)) AS personnel_number, (TSH.EMPLNAME) AS name, (TSH.JOBTITLE) AS presenttitle, (TSH.UNIT) AS departement, (TSH.EMAIL) AS email, (TSH.BORNDATE) AS dateofbirth, (TSH.EMPLODATE) AS dateofemployee, (SELECT mobilephone FROM m_contact_employee AS mce WHERE mce.personnel_number_fk =  (CONVERT(varchar(10),TSH.PERNR))) AS mobilephone, (SELECT businessphone FROM m_contact_employee AS mce WHERE mce.personnel_number_fk =  (CONVERT(varchar(10),TSH.PERNR))) AS businessphone FROM db_hrm.dbo.TBL_SOE_HEAD AS TSH
            WHERE (CONVERT(varchar(10),TSH.PERNR))='$personnel_number' OR (CONVERT(varchar(10),TSH.PERNR))='$post_personnel_number') AS TSH ON t_apply_license.personnel_number = TSH.personnel_number                                                               
            WHERE " . $where . " ORDER BY date_submited, date_approved_superior DESC";
        //die(print_r($data_query)); 

        $data_query_assesment_history = "SELECT 
                (CONVERT(varchar(10), CONVERT(datetime, TA.date_written_assesment,120),105)) AS date_written_assesment,
                (SELECT masses.name_t FROM m_assesment_session AS masses WHERE masses.id = TA.id_written_sesi) AS sesi_written_assesment,
                (CONVERT(varchar(10), CONVERT(datetime, TA.date_oral_assesment,120),105)) AS date_oral_assesment,
                (SELECT masses.name_t FROM m_assesment_session AS masses WHERE masses.id = TA.id_oral_sesi) AS sesi_oral_assesment,
                (CONVERT(varchar(10), CONVERT(datetime, TA.date_practical_assesment,120),105)) AS date_practical_assesment,
                (SELECT masses.name_t FROM m_assesment_session AS masses WHERE masses.id = TA.id_practical_sesi) AS sesi_practical_assesment
                FROM t_assesment AS TA
                WHERE TA.request_number_fk='$request_number' OR TA.request_number_fk = '$p_request_number'";

        $data['back']             = $this->agent->referrer();
        $data['cek_data_summary'] = $cekdatasummary;
        $data['data_history']     = $this->db->query($data_query)->result();
        $data['data_assesment_history']     = $this->db->query($data_query_assesment_history)->result();
        $this->page->view('history_apply_license', $data);
        return true;
    }
    // -- Function Name : get_license
    // -- Params : $param
    // -- Purpose :
    function get_license($param)
    {
        $query = "SELECT c.id, c.name_t FROM m_group_type_license a
            LEFT JOIN m_auth_license b ON a.id_auth_license_fk = b.id
            LEFT JOIN m_auth_type c ON a.id_auth_type_fk = c.id
            WHERE b.id='$param'";
        $data['license']   = $param;
        $data['auth_type'] = $this->db->query($query)->result();
        $this->load->view('apply_license/tab_authorization/view_tab_type', $data);
        return true;
    }
    // -- Function Name : get_type
    // -- Params : $param
    // -- Purpose : 
    function get_type($param)
    {
        $data['auth_spec'] = $this->m_apply_license->get_type($param);
        $this->load->view('apply_license/tab_authorization/view_tab_spec', $data);
        return true;
    }
    // -- Function Name : get_spec
    // -- Params : $p_id_spect, $p_id_license, $p_id_type
    // -- Purpose : 
    function get_spec($p_id_spect, $p_id_license, $p_id_type)
    {
        $data['type_license']  = $p_id_type;
        $data['auth_category'] = $this->m_apply_license->get_spec($p_id_spect, $p_id_license, $p_id_type);
        //die(print_r($data));              
        $this->load->view('apply_license/tab_authorization/view_tab_category', $data);
        return true;
    }
    // -- Function Name : get_category
    // -- Params : $p_category, $p_spect, $p_type, $p_license
    // -- Purpose : 
    function get_category($p_category, $p_spect, $p_type, $p_license)
    {
        $data['auth_scope'] = $this->m_apply_license->get_category($p_category, $p_spect, $p_type, $p_license);
        $this->load->view('apply_license/tab_authorization/view_tab_scope', $data);
        return true;
    }
    function get_scope($p_scope, $p_category, $p_spect, $p_type='', $p_license='')
    {
        if (!empty($p_scope)) {
            $data['auth_scope_assesment'] = $this->m_apply_license->get_scope($p_scope, $p_category, $p_spect, $p_type, $p_license);
            $this->load->view('apply_license/tab_authorization/view_tab_scope_assesment', $data);
            return true;
        }
    }
    // EASA ADD AUTHORIZATION    
    function get_license_easa($param, $p_type)
    {
        $query                  = "SELECT c.id, c.name_t FROM m_group_type_license a
            LEFT JOIN m_auth_license b ON a.id_auth_license_fk = b.id
            LEFT JOIN m_auth_type c ON a.id_auth_type_fk = c.id
            WHERE b.id='$param' and a.id_auth_type_fk = CASE '$p_type' WHEN '6' THEN '22' ELSE '$p_type' END";
        $data['auth_type_easa'] = $this->db->query($query)->result();
        $this->load->view('apply_license/tab_easa/view_tab_type_easa', $data);
        return true;
    }
    // -- Function Name : get_type_easa
    // -- Params : $param
    // -- Purpose : 
    function get_type_easa($param)
    {
        $data['auth_spec_easa'] = $this->m_apply_license->get_type($param);
        $this->load->view('apply_license/tab_easa/view_tab_spec_easa', $data);
        return true;
    }
    // -- Function Name : get_spec_easa
    // -- Params : $p_id_spect, $p_id_license, $p_id_type
    // -- Purpose : 
    function get_spec_easa($p_id_spect, $p_id_license, $p_id_type)
    {
        $data['auth_category_easa'] = $this->m_apply_license->get_spec($p_id_spect, $p_id_license, $p_id_type);
        $this->load->view('apply_license/tab_easa/view_tab_category_easa', $data);
        return true;
    }
    // -- Function Name : get_category_easa
    // -- Params : $p_category, $p_spect, $p_type, $p_license
    // -- Purpose : 
    function get_category_easa($p_category, $p_spect, $p_type, $p_license)
    {
        $data['auth_scope_easa'] = $this->m_apply_license->get_category($p_category, $p_spect, $p_type, $p_license);
        $this->load->view('apply_license/tab_easa/view_tab_scope_easa', $data);
        return true;
    }
    function get_scope_easa($p_scope, $p_category, $p_spect, $p_type, $p_license)
    {
        if (!empty($p_scope)) {
            @$data['auth_scope_assesment_easa'] = $this->m_apply_license->get_scope($p_scope, $p_category, $p_spect, $p_type, $p_license);
            $this->load->view('apply_license/tab_easa/view_tab_scope_assesment_easa', $data);
            return true;
        }
    }
    // SPECIAL ADD AUTHORIZATION        
    function get_type_special($param)
    {
        $data['auth_spec_special'] = $this->m_apply_license->get_type($param);
        $this->load->view('apply_license/tab_special/view_tab_spec_special', $data);
        return true;
    }
    // -- Function Name : get_spec_special
    // -- Params : $p_id_spect,$p_id_type
    // -- Purpose : 
    function get_spec_special($p_id_spect, $p_id_type)
    {
        $data['auth_category_special'] = $this->m_apply_license->get_spec($p_id_spect, '2', $p_id_type);
        $this->load->view('apply_license/tab_special/view_tab_category_special', $data);
        return true;
    }
    // -- Function Name : get_category_special
    // -- Params : $p_category, $p_spect, $p_type
    // -- Purpose : 
    function get_category_special($p_category, $p_spect, $p_type)
    {
        $data['auth_scope_special'] = $this->m_apply_license->get_category($p_category, $p_spect, $p_type, '2');
        $this->load->view('apply_license/tab_special/view_tab_scope_special', $data);
        return true;
    }
    // -- Function Name : get_category_special
    // -- Params : $p_category, $p_spect, $p_type
    // -- Purpose : 
    function get_scope_special($p_scope, $p_category, $p_spect, $p_type, $p_license)
    {
        if (!empty($p_scope)) {
            $data['auth_scope_assesment_special'] = $this->m_apply_license->get_scope($p_scope, $p_category, $p_spect, $p_type, $p_license);
            $this->load->view('apply_license/tab_special/view_tab_scope_assesment_special', $data);
            return true;
        }
    }
    // CUSTOMER ADD AUTHORIZATION    
    function get_license_customer($param)
    {
        $query                      = "SELECT c.id, c.name_t FROM m_group_type_license a
            LEFT JOIN m_auth_license b ON a.id_auth_license_fk = b.id
            LEFT JOIN m_auth_type c ON a.id_auth_type_fk = c.id
            WHERE b.id='$param'";
        $data['auth_type_customer'] = $this->db->query($query)->result();
        $this->load->view('apply_license/tab_customer/view_tab_type_customer', $data);
        return true;
    }
    // -- Function Name : get_type_customer
    // -- Params : $param
    // -- Purpose : 
    function get_type_customer($param)
    {
        $data['auth_spec_customer'] = $this->m_apply_license->get_type($param);
        $this->load->view('apply_license/tab_customer/view_tab_spec_customer', $data);
        return true;
    }
    // -- Function Name : get_spec_customer
    // -- Params : $p_id_spect, $p_id_license, $p_id_type
    // -- Purpose : 
    function get_spec_customer($p_id_spect, $p_id_license, $p_id_type)
    {
        $data['auth_category_customer'] = $this->m_apply_license->get_spec($p_id_spect, $p_id_license, $p_id_type);
        $this->load->view('apply_license/tab_customer/view_tab_category_customer', $data);
        return true;
    }
    // -- Function Name : get_category_customer
    // -- Params : $p_category, $p_spect, $p_type, $p_license
    // -- Purpose : 
    function get_category_customer($p_category, $p_spect, $p_type, $p_license)
    {
        $data['auth_scope_customer'] = $this->m_apply_license->get_category($p_category, $p_spect, $p_type, $p_license);
        $this->load->view('apply_license/tab_customer/view_tab_scope_customer', $data);
        return true;
    }
    function get_scope_customer_garuda($p_scope, $p_category, $p_spect='', $p_type='', $p_license='')
    {
        $data['auth_scope_assesment_customer_garuda'] = $this->m_apply_license->get_scope($p_scope, $p_category, $p_spect, $p_type, $p_license);
        $this->load->view('apply_license/tab_customer/view_tab_scope_assesment_customer_garuda', $data);
        return true;
    }
    function get_scope_customer_citilink($p_scope, $p_category, $p_spect='', $p_type='', $p_license='')
    {
        $data['auth_scope_assesment_customer_citilink'] = $this->m_apply_license->get_scope($p_scope, $p_category, $p_spect, $p_type, $p_license);
        $this->load->view('apply_license/tab_customer/view_tab_scope_assesment_customer_citilink', $data);
        return true;
    }
    function get_scope_customer_sriwijaya($p_scope, $p_category, $p_spect='', $p_type='', $p_license='')
    {
        $data['auth_scope_assesment_customer_sriwijaya'] = $this->m_apply_license->get_scope($p_scope, $p_category, $p_spect, $p_type, $p_license);
        $this->load->view('apply_license/tab_customer/view_tab_scope_assesment_customer_sriwijaya', $data);
        return true;
    }
    // COFC ADD AUTHORIZATION    
    function get_license_cofc($param)
    {
        $query                  = "SELECT c.id, c.name_t FROM m_group_type_license a
        LEFT JOIN m_auth_license b ON a.id_auth_license_fk = b.id
        LEFT JOIN m_auth_type c ON a.id_auth_type_fk = c.id
        WHERE b.id='$param'";
        $data['auth_type_cofc'] = $this->db->query($query)->result();
        $this->load->view('apply_license/tab_cofc/view_tab_type_cofc', $data);
        return true;
    }
    function get_type_cofc($param)
    {
        $data['auth_spec_cofc'] = $this->m_apply_license->get_type($param);
        $this->load->view('apply_license/tab_cofc/view_tab_spec_cofc', $data);
        return true;
    }
    // -- Function Name : get_spec
    // -- Params : $p_id_spect, $p_id_license, $p_id_type
    // -- Purpose : 
    function get_spec_cofc($p_id_spect, $p_id_license, $p_id_type)
    {
        $data['auth_category_cofc'] = $this->m_apply_license->get_spec($p_id_spect, $p_id_license, $p_id_type);
        //die(print_r($data));              
        $this->load->view('apply_license/tab_cofc/view_tab_category_cofc', $data);
        return true;
    }
    // -- Function Name : get_category
    // -- Params : $p_category, $p_spect, $p_type, $p_license
    // -- Purpose : 
    function get_category_cofc($p_category, $p_spect, $p_type, $p_license)
    {
        $data['auth_scope_cofc'] = $this->m_apply_license->get_category($p_category, $p_spect, $p_type, $p_license);
        $this->load->view('apply_license/tab_cofc/view_tab_scope_cofc', $data);
        return true;
    }

    function get_scope_cofc($p_scope, $p_category, $p_spect, $p_type, $p_license)
    {
        $data['auth_scope_assesment_cofc'] = $this->m_apply_license->get_scope($p_scope, $p_category, $p_spect, $p_type, $p_license);
        $this->load->view('apply_license/tab_cofc/view_tab_scope_assesment_cofc', $data);
        return true;
    }

    public function get_data_basic_license(){                
        $list   = $this->m_apply_license->get_data_basic_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $rc->GENLIC;
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],            
            "data"              => $data,
        );

        echo json_encode($output);            
    }        

    public function get_data_ame_license(){                
        $list   = $this->m_apply_license->get_data_ame_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $rc->scp_descrip;
            $row[] = date('d-m-Y',strtotime($rc->valid_until));           
            $row[] = date('d-m-Y'); 
            $row[] = $rc->lic_no;          
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],                    
            "data"              => $data,
        );

        echo json_encode($output);            
    }   

    public function get_data_cs_license(){                
        $list   = $this->m_apply_license->get_data_cs_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $rc->scp_descrip;
            $row[] = date('d-m-Y',strtotime($rc->valid_until));           
            $row[] = $rc->lic_no;
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],                    
            "data"              => $data,
        );

        echo json_encode($output);            
    }             

    public function get_data_gmf_license(){                
        $list   = $this->m_apply_license->get_data_gmf_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $rc->scp_descrip;
            $row[] = date('d-m-Y',strtotime($rc->valid_until));           
            $row[] = $rc->lic_no;
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],                    
            "data"              => $data,
        );

        echo json_encode($output);            
    }   

    public function get_data_ga_license(){                
        $list   = $this->m_apply_license->get_data_ga_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $rc->scp_descrip;
            $row[] = date('d-m-Y',strtotime($rc->valid_until));           
            $row[] = $rc->lic_no;
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],                    
            "data"              => $data,
        );

        echo json_encode($output);            
    }           

    public function get_data_citilink_license(){                
        $list   = $this->m_apply_license->get_data_citilink_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $rc->scp_descrip;
            $row[] = date('d-m-Y',strtotime($rc->valid_until));           
            $row[] = $rc->lic_no;
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],                    
            "data"              => $data,
        );

        echo json_encode($output);            
    }   

    public function get_data_sriwijaya_license(){                
        $list   = $this->m_apply_license->get_data_sriwijaya_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $rc->scp_descrip;
            $row[] = date('d-m-Y',strtotime($rc->valid_until));           
            $row[] = $rc->lic_no;
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],                    
            "data"              => $data,
        );

        echo json_encode($output);            
    }        

    public function get_data_easa_license(){                
        $list   = $this->m_apply_license->get_data_easa_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $rc->scopes;
            $row[] = date('d-m-Y',strtotime($rc->valid_until));           
            $row[] = $rc->auth_no;
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],                    
            "data"              => $data,
        );

        echo json_encode($output);            
    } 

    public function get_data_cofc_license(){                
        $list   = $this->m_apply_license->get_data_cofc_license();                
        $data   = array();
        $no     = $_POST['start'];
        
        foreach ($list as $rc) {            
            $no++;
            $row = array();            
            $row[] = $rc->ecno;
            $row[] = $rc->ecdesc;
            $row[] = $rc->ecrating;
            $row[] = date('d-m-Y',strtotime($rc->valid_until));           
            $row[] = $rc->stamp_no;
            $data[] = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],                                
            "data"              => $data,
        );

        echo json_encode($output);            
    }          
          
}
?>
