<?php echo jquery_select2();
$users = $this->session->userdata('users_quality');
$cek_user_akses = $users->PERNR;
$cek_name_user_akses = $users->EMPLNAME;
?>
<script type="text/javascript">
$().ready(function(){
    $('[name=name_location],[name=name_disposition]').select2({width : '100%'});
});
</script>
<section class="content-header">
    <h1>History Applicant</h1>    
</section>
    <div class="box-body">
            <?php             
            if($aksi == "view"){?>
            <div class="col-md-12">
            <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">            
                    <?php                    
                    if(!empty($rc[0]->submited)){
                    @$class_submited = "active";
                    }else{
                    @$class_submited = "disabled";    
                    }
                    ?> 
                    <li role="presentation" class="<?php echo @$class_submited; ?>">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">                            
                            <img id="status" src="<?php echo base_url('assets/images/property/data-submited.png'); ?>">                                                       
                        </a> 
                               
                        <a id="head_nav">Date Submited</a>                                       
                    </li>                    
                    <?php
                    if(!empty($rc[0]->approved_superior)){
                    @$class_approved_superior = "active";
                    }else{
                    @$class_approved_superior = "disabled";    
                    }
                    ?>
                    <li role="presentation" class="<?php echo @$class_approved_superior; ?>">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">                            
                                <img id="status" src="<?php echo base_url('assets/images/property/approved.png'); ?>">                            
                        </a>
                        <a id="head_nav">Superior Approval</a> 
                    </li>
                    <?php
                    if(!empty($rc[0]->approved_quality)){
                    @$class_approved_quality = "active";
                    }else{
                    @$class_approved_quality = "disabled";    
                    }
                    ?>
                    <li role="presentation" class="<?php echo @$class_approved_quality; ?>">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <img id="status" src="<?php echo base_url('assets/images/property/qc-approved.png'); ?>">
                        </a>
                        <a id="head_nav">Data Validated</a>
                    </li>
                    <?php
                    if($rc[0]->check_assesment == '2'){
                    $class_approved_assesment = "active";
                    }else{
                    $class_approved_assesment = "disabled";    
                    }
                    ?>                    
                    <li role="presentation" class="<?php echo $class_approved_assesment;?>">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <img id="status" src="<?php echo base_url('assets/images/property/assesment.png'); ?>">
                        </a>
                        <a id="head_nav">Assessment Process</a>
                    </li>
                    <?php
                    if(!empty($rc[0]->status_issue_authorization)){
                    $class_issue_authorization = "active";
                    }else{
                    $class_issue_authorization = "disabled";    
                    }
                    ?> 
                    <li role="presentation" class="<?php echo $class_issue_authorization?>">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <img id="status" src="<?php echo base_url('assets/images/property/issue-authorization.png'); ?>">
                        </a>
                        <a id="head_nav">Issue Authorization</a>
                    </li>
                    <?php
                    if(!empty($rc[0]->status_take_authorization)){
                    $class_take_authorization = "active";
                    }else{
                    $class_take_authorization = "disabled";    
                    }
                    ?>
                    <li role="presentation" class="<?php echo $class_take_authorization; ?>">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                           <img id="status" src="<?php echo base_url('assets/images/property/take-authorization.png'); ?>">
                        </a>
                        <a id="head_nav">Take Authorization</a>
                    </li>
                    <?php
                    if(!empty($rc[0]->status_finish)){
                    $class_take_authorization = "active";
                    }else{
                    $class_take_authorization = "disabled";    
                    }
                    ?>
                    <li role="presentation" class="<?php echo $class_take_authorization?>">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <img id="status" src="<?php echo base_url('assets/images/property/finish.png'); ?>">
                        </a>
                       <a id="head_nav">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($rc[0]->approved_superior != null && $rc[0]->approved_superior != 'Approved Superior' || $rc[0]->approved_quality != null && $rc[0]->approved_quality != 'Data Validated' ) { echo 'Failed'; } else { echo 'Success';}; ?></a>
                    </li>
                    </ul>
            </div>
            </div>
            </div>  
            <div class="col-md-9">           
                <div class="box-body table-responsive no-padding">
                    <h4><b>Personnel information</b> :</h4>                    
                    <table id="" class="table table_bootstrap">   
                    <tr> 
                    <th width="20%"> Name </th>
                    <th width="10%%"> ID number </th>            
                    <th width="10%%"> Unit </th>
                    <th width="20%"> Jobtitle </th>
                    <th width="20%"> Request number </th>
                    <th width="20%"> Date request </th>                                                                 
                    </tr>
                    <tbody>                     
                    <tr>                                                                        
                        <td><input type="hidden" name="name_applicant" value="<?php echo @$rc[0]->name;?>"/><?php echo @$rc[0]->name;?></td>                                                                                        
                        <td><input type="hidden" name="personnel_number_applicant" value="<?php echo @$rc[0]->personnel_number;?>"/><?php echo @$rc[0]->personnel_number;?></td>                                                                               
                        <td><?php echo @$rc[0]->departement;?></td>                                                   
                        <td><?php echo @$rc[0]->presenttitle;?></td>                                                
                        <td><input type="hidden" name="request_number_applicant" value="
                        <?php 
                        $request_number = @$rc[0]->request_number; 
                        echo @$request_number?>"/><?php echo @$request_number;?>
                        </td>                                                                   
                        <td class="col-md-10"><?php echo date('d-M-Y',strtotime(@$rc[0]->date_submited));?></td>
                    </tr>
                    </tbody>                     
                    </table>
                    <br/>
                </div>
            </div>
            <div class="col-md-3">
                    <div class="panel panel-info"> <!-- div type panel -->
                       <div class="panel-heading text-center"> <!-- div head panel -->
                       <h4>Number of Days Since Recieve Data</h4>
                       </div> <!-- end div head panel -->                  
                      <div class="panel-body"> <!-- div body panel -->
                            <div class="col-md-12"> <!-- div content panel -->                               
                        <h1 align="center">
                       <?php                                                                
                            @$date_submited = $rc[0]->date_submited;
                            @$date_finish = $rc[0]->date_finish;
                            if($date_finish != ''){
                                @$date_until = $rc[0]->date_finish;
                            };
                            if($date_finish == '' || $date_finish == 'Null'){  
                                @$date_until = date('d-m-Y'); 
                            }                                                                                                             
                            echo round(abs(strtotime($date_until)-strtotime($date_submited))/86400);                    
                        ?>
                        </h1>
                        </div>  <!-- end div content panel -->
                    </div>  <!-- end div body panel -->                                                                                      
               </div> <!-- end div type panel -->       
        </div>
        <div class="col-md-9">           
        <div class="box-body table-responsive no-padding">
        <br/>
        <h4><b>License information</b> :</h4>
        <?php $status = $rc_license[0]->reason_apply_license;
            switch ($status){
            case 1 :
                $reason_apply_license = 'New Authorization';
                break;
            case 2 :
                $reason_apply_license = 'Renewal';
                break;
            case 3 :
                $reason_apply_license = 'Additional';
                break;
            case 4 :
                $reason_apply_license = 'Rating Change/ Upgrade';
                break;
            }
        ?>
        <h4>Reason of request : <?php echo @$reason_apply_license; ?></h4>        
        <table class="table table-bootstrap">
        <tr> 
            <th> No </th>
            <th> Authorization </th>            
            <th> Authorization Type </th>
            <th> Rating/ Spec </th>
            <th> Category </th>           
            <th> Scope </th>                                   
        </tr>
         <?php
         $no=1;
         foreach($rc_license as $row) {
         ?>
         <tr>                        
            <td width="3%"><?php echo $no++ ?> </td>
            <td><?php echo $row->name_license; ?> </td>                      
            <td><?php echo $row->name_type; ?> </td>                                                        
            <td><?php echo $row->name_spect; ?> </td>                             
            <td><?php echo $row->name_category; ?> </td> 
            <td><?php echo $row->name_scope; ?></td>                                                     
         </tr>        
         <?php
         }        
         ?>
        </table>
        </div>
        </div>                  
        <div class="col-md-12" id="dtl_to_atasan">           
            <div class="box-body table-responsive no-padding">
                <br/>                
                <h4><b>Applicant Status</b> :</h4>                                                         
                <table id="" class="table table-bootstrap">                    
                <thead>
                <tr>                        
                    <th width="5%">No</th>                        
                    <th width="10%">Date</th>                        
                    <th width="10%">Time</th>
                    <th width="20%">Activity</th>
                    <th width="20%">Disposition</th>
                    <th width="20%">Location</th>
                    <th width="20%">Update By</th>                           
                </tr>    
                </thead>
                <tbody>                    
                <?php
                foreach ($rc as $value):                    
                @$no=1;
                ?> 
                <tr>
                    <?php if(@$value->submited != '' AND @$value->submited != '0'):?>
                    <td><?php echo @$no++ ?></td>
                    <td><?php echo @$value->date_submited; ?></td>
                    <td><?php echo @$value->time_submited; ?></td>                        
                    <td>Data Submited</td>
                    <td></td>
                    <td></td>
                    <td></td>                   
                    <?php endif;?>
                </tr> 
                <tr>
                    <?php if(@$value->approved_superior != '' AND @$value->approved_superior != '0'):?>
                    <td><?php echo @$no++ ?></td>
                    <td><?php echo @$value->date_approved_superior; ?></td>
                    <td><?php echo @$value->time_approved_superior; ?></td>                       
                    <td><?php echo @$value->approved_superior; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php endif;?>
                </tr>  
                <tr>
                    <?php if(@$value->approved_quality != '' AND @$value->approved_quality != '0'):?>
                    <td><?php echo @$no++ ?></td>
                    <td><?php echo @$value->date_approved_quality; ?></td>
                    <td><?php echo @$value->time_approved_quality; ?></td>                       
                    <td><?php echo @$value->approved_quality; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_quality; ?></td>
                    <?php endif;?>                        
                </tr>
                <tr>
                    <?php if(@$value->status_assesment != '' AND ($value->status_assesment == 'Assesment Process' || $value->status_assesment == 'Assesment Process Closed')):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_assesment; ?></td>
                    <td><?php echo @$value->time_assesment; ?></td>                       
                    <td><?php echo 'Assesment Process'; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_assesment; ?></td>
                    <?php endif;?>                        
                </tr> 
                <tr>
                    <?php if(@$value->status_assesment != '' AND $value->status_assesment == 'Assesment Process Closed'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_verification_assesment; ?></td>
                    <td><?php echo @$value->time_verification_assesment; ?></td>                       
                    <td><?php echo @$value->status_assesment; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_assesment; ?></td>
                    <?php endif;?>                          
                </tr>
                <tr>
                    <?php if(@$value->desc_gmf_issue_authorization == 'GMF Authorization Issued'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_gmf_issue_authorization; ?></td>
                    <td><?php echo @$value->time_gmf_issue_authorization; ?></td>                       
                    <td><?php echo @$value->desc_gmf_issue_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_issue_authorization; ?></td>
                    <?php endif;?>                        
                </tr> 
                <tr>
                    <?php if(@$value->desc_coc_issue_authorization == 'C of C and/or Stamp Issued'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_coc_issue_authorization; ?></td>
                    <td><?php echo @$value->time_coc_issue_authorization; ?></td>                       
                    <td><?php echo @$value->desc_coc_issue_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_issue_authorization; ?></td>
                    <?php endif;?>                        
                </tr>
                <tr>
                    <?php if(@$value->desc_easa_issue_authorization == 'EASA Authorization Issued'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_easa_issue_authorization; ?></td>
                    <td><?php echo @$value->time_easa_issue_authorization; ?></td>                       
                    <td><?php echo @$value->desc_easa_issue_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_issue_authorization; ?></td>
                    <?php endif;?>                        
                </tr> 
                <tr>
                    <?php if(@$value->desc_ga_issue_authorization == 'GA Authorization Issued'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_ga_issue_authorization; ?></td>
                    <td><?php echo @$value->time_ga_issue_authorization; ?></td>                       
                    <td><?php echo @$value->desc_ga_issue_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_issue_authorization; ?></td>
                    <?php endif;?>                        
                </tr>
                <tr>
                    <?php if(@$value->desc_clink_issue_authorization == 'Citilink Authorization Issued'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_clink_issue_authorization; ?></td>
                    <td><?php echo @$value->time_clink_issue_authorization; ?></td>                       
                    <td><?php echo @$value->desc_clink_issue_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_issue_authorization; ?></td>
                    <?php endif;?>                        
                </tr>  
                <tr>
                    <?php if(@$value->desc_srwj_issue_authorization == 'Sriwijaya Authorization Issued'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_srwj_issue_authorization; ?></td>
                    <td><?php echo @$value->time_srwj_issue_authorization; ?></td>                       
                    <td><?php echo @$value->desc_srwj_issue_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_issue_authorization; ?></td>
                    <?php endif;?>                        
                </tr> 
                <tr>
                    <?php if(@$value->status_issue_authorization == 'Issue Authorization Finished'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_stts_issue_authorization; ?></td>
                    <td><?php echo @$value->time_stts_issue_authorization; ?></td>                       
                    <td><?php echo @$value->status_issue_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_issue_authorization; ?></td>
                    <?php endif;?>                        
                </tr>
                <tr>
                    <?php if(@$value->status_referral_authorization == 'Referral Authorization'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_referral_authorization; ?></td>
                    <td><?php echo @$value->time_referral_authorization; ?></td>                       
                    <td><?php echo @$value->status_referral_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_ref_auth; ?></td>
                    <?php endif;?>                        
                </tr> 
                <tr>
                    <?php if(@$value->status_take_authorization == 'Personnel Record Completed'):?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo @$value->date_take_authorization; ?></td>
                    <td><?php echo @$value->time_take_authorization; ?></td>                       
                    <td><?php echo @$value->status_take_authorization; ?></td>
                    <td><?php echo @$value->name_disposition; ?></td>
                    <td><?php echo @$value->name_location; ?></td>
                    <td><?php echo @$value->name_take_auth; ?></td>
                    <?php endif;?>                        
                </tr> 
                <tr>
                    <?php if(@$value->status_finish == 'Success'):?>
                    <td><?php echo $no++ ?></td>                    
                    <td><?php echo @$value->date_finish ?></td>
                    <td><?php echo @$value->time_finish ?></td>                       
                    <?php 
                    if(@$value->approved_quality =='Data Not Valid'){
                    ?>
                        <td>Failed</td>
                    <?php
                    }else{
                    ?>
                        <td><?php echo @$value->status_finish ?></td>
                    <?php
                    }
                    ?>                    
                    <td></td>
                    <td></td>
                    <td></td>   
                    <?php endif;?>                        
                </tr>                                   
                <?php
                endforeach;
                ?>                                                                           
                </tbody>                     
                </table>
            </div>
            <br/>
            <a href="<?php echo site_url('quality_control/add/'.$rc[0]->request_number);?>"><button class="btn btn-info">Update Current Status</button></a>&nbsp;&nbsp;
            <a href="<?php echo $back_home_quality; ?>"><button class="btn btn-warning">Back</button></a>
                                                        
        </div>                                                      
        <?php } else if($aksi == "add") {?>
            <form action="<?php echo base_url();?>index.php/quality_control/view_document" method="POST">
            <input class="form-control input-md" type="hidden" name="personnel_number" value="<?php echo @$rc[0]->personnel_number; ?>"/>
            <input class="form-control input-md" type="hidden" name="request_number" value="<?php echo $rc[0]->request_number; ?>" />              
            <button type="submit" class="col-md-2 btn btn-primary btn-md" name="view_document"><span class="fa fa-file-archive-o"></span> &nbsp;View Document </button>
            </form>                                    
            <br/>          
            <br/>
            <br/>
            <?php echo form_open($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>     
            <div class="form-group">            
            <label class="col-md-2 control-label input-md">Request Number</label>
            <div class="col-md-4">              
              <input class="form-control input-md" type="text" name="req_num" value="<?php echo $rc[0]->request_number; ?>" disabled />
              <input class="form-control input-md" type="hidden" name="personnel_number" value="<?php echo $rc[0]->personnel_number; ?>"/>
              <input class="form-control input-md" type="hidden" name="request_number" value="<?php echo $rc[0]->request_number; ?>" />              
            </div>            
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label ">Name</label>
            <div class="col-sm-4">
              <input class="form-control " type="text" name="name" value="<?php echo $rc[0]->name; ?>" disabled/>
              <input class="form-control " type="hidden" name="personnel_number" value="<?php echo $rc[0]->personnel_number; ?>"/>
            </div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label ">Disposition</label>
            <div class="col-sm-4">                                                                            
                <?php if(@$rc[0]->current_status == 'Data Submited'):?>
                <select name="name_disposition" disabled>
                <option value="">--- Choose Employee ---</option>                
                </select> 
                <?php 
                endif;
                if(@$rc[0]->current_status != 'Data Submited'):
                ?>
                <select name="name_disposition" >
                <?php if($rc[0]->id_disposition_user_fk == ''){ ?>
                <option value="">--- Choose Employee ---</option>
                <?php }else if($rc[0]->id_disposition_user_fk != ''){ ?>                
                <option value="<?php echo $rc[0]->id_disposition_user_fk;?>"><?php echo $rc[0]->name_disposition;?></option>
                <?php }; echo modules::run('quality_control/quality_control/option_employee_tqd'); ?>
                </select>
                <?php 
                endif;
                ?>                     
            </div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label ">Location</label>
            <div class="col-sm-4">
                <?php if(@$rc[0]->current_status == 'Data Submited'):?>
                <select name="name_disposition" disabled>
                <option value="">--- Choose Employee ---</option>                
                </select> 
                <?php 
                endif;
                if(@$rc[0]->current_status != 'Data Submited'):
                ?>
                <select name="name_location">
                <?php if($rc[0]->id_location_user_fk == ''){ ?>
                <option value="">--- Choose Employee ---</option>
                <?php }else if($rc[0]->id_location_user_fk != ''){ ?>                
                <option value="<?php echo @$rc[0]->id_location_user_fk;?>"><?php echo $rc[0]->name_location;?></option>                
                <?php }; echo modules::run('quality_control/quality_control/option_employee_tqd'); ?>
                </select> 
                <?php 
                endif;
                ?>                     
            </div>                    
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label ">Update By</label>
            <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cek_user_akses .' - '.$cek_name_user_akses;?></label>              
            </div>

            <div class="form-group">
            <label class="col-sm-2 control-label ">Current Status</label>
            <div class="col-sm-4">          
            <input type="text" class="form-control " value="<?php 
                          switch (@$rc[0]->current_status){
                            case @$rc[0]->current_status == 'Date Submited':
                                $id_status = '1';
                                break;
                            case @$rc[0]->current_status == 'Superior Approval':
                                $id_status = '2';
                                break;
                            case @$rc[0]->current_status == 'Quality Approval':
                                $id_status = '3';
                                break;
                            case @$rc[0]->current_status == 'Assesment Process':
                                $id_status = '4';
                                break;
                            case @$rc[0]->current_status == 'Issue Authorization':
                                $id_status = '5';
                                break;
                            case @$rc[0]->current_status == 'Take Authorization':
                                $id_status = '6';
                                break;                          
                            }
                            echo @$rc[0]->current_status;
                          ?>" disabled>                        
            </div>                    
            </div>                                                              
            <div class="form-group">
            <label class="col-sm-2 control-label ">Update Current Status</label>
            <div class="col-sm-2">
                <?php if(@$rc[0]->current_status == 'Data Submited'):?>
                 <select class="form-control " type="text" name="current_status" id="current_status" disabled>                              
                  <option>Choose Status</option>              
                </select>
                <?php 
                endif;
                if(@$rc[0]->current_status != 'Data Submited'):
                ?>
                <select class="form-control " type="text" name="current_status" id="current_status">                              
                  <option value="1">Date Submited</option>
                  <option value="2">Superior Approval</option>
                  <option value="3">Quality Approval</option>
                  <option value="4">Assesment Process</option>
                  <option value="5">Issue Authorization</option>
                  <option value="6">Take Authorization</option>                  
                </select>
                <?php 
                endif;
                ?>
            </div>                    
            </div>   
            <div class="form-group">
            <label class="col-sm-2 control-label ">Sub Status</label>
            <div class="col-sm-2">
                <?php if(@$rc[0]->current_status == 'Data Submited'):?>
                    <select class="form-control " type="text" name="sub_status" id="sub_status" disabled>                              
                        <option>Choose Sub Status</option>              
                    </select>
                <?php 
                endif;
                if(@$rc[0]->current_status != 'Data Submited'):
                ?>
                <select class="form-control " type="text" name="sub_status" id="sub_status">
                                    
                </select>
                <?php
                endif; 
                ?>
            </div>                    
            </div>
            <div id="type_assesment_schedule">
            
            </div>
            <div id="oral_assesment_schedule">
            
            </div>                          
            <div class="form-group">
            <label class="col-sm-2 control-label ">Last Update</label>
            <div class="col-sm-2">              
               <input class="form-control " type="text" name="last_update" value="<?php echo @$rc[0]->last_update .'&nbsp;'.@$rc[0]->time; ?>" disabled/>
            </div>                                        
            </div>
            <?php 
            if($cek_user_akses=='526922'||$cek_user_akses=='580435'):
            ?>                              
            <div class="form-group">
            <label class="col-sm-2 control-label ">Priority</label>
            <div class="col-sm-2">
            <select class="form-control " type="text" name="priority">
              <option value="<?php echo @$rc[0]->priority;?>">--- <?php echo @$rc[0]->priority;?> ---</option>  
              <option>Normal</option>
              <option>High</option>
            </select>
            </div>                                        
            </div>             
            <div class="form-group">
            <label class="col-sm-2 control-label ">Due Date</label>
            <div class="col-sm-2"> 
                <input class="form-control " type="text" name="datetime_priority"/>            
            </div>                                        
            </div>
            <?php 
            endif;
            ?>            
            <div class="form-group">
            <label class="col-sm-2 control-label ">Remark</label>
            <div class="col-sm-2">
              <textarea cols="55" rows="5" name="remark"><?php echo @$rc[0]->remark;?></textarea>
            </div>                                        
            </div>                                       
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="simpan_detail_history"><span class="fa fa-save"></span> &nbsp;Save </button>              
                <a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
            </div>
            </div>
            <?php echo form_close(); ?>                    
        <?php } ?>                                                                         
</div>
<?php
echo bootstrap_datepicker();
echo bootstrap_datetimepicker();
?>     
<script type="text/javascript">
function check_uncheck_checkbox(isChecked) {
    if (isChecked) {
        $('.check_assesment').each(function() {
            this.checked = true;
        });
    } else {
        $('.check_assesment').each(function() {
            this.checked = false;
        });
    }
}

$('[name=datetime_priority]').datetimepicker({
    format:'yyyy-mm-dd hh:ii:ss',
    daysOfWeekDisabled: [0,6],
    autoclose: true,
});


$('#current_status').change(function(){            
    var current_status = $(this).val();                             
    $.get("<?php echo base_url();?>index.php/quality_control/get_tab_option_sub_status/" + current_status , function(data, status){                 
        $("#sub_status").html(data);
    });
    //alert(current_status);
    if (current_status =='4'){
    var sub_status = $('#sub_status').val();        
    var request_number = $('[name=request_number]').val();
    var personnel_number =  $('[name=personnel_number]').val();    
    $.get("<?php echo base_url();?>index.php/quality_control/get_type_assesment/5/" + request_number + "/" + personnel_number, function(data, status){                 
        $("#type_assesment_schedule").html(data);
        $("#type_assesment_schedule").show();
    });           
    }else if (current_status =='1' || current_status =='2' || current_status =='3' || current_status =='5' || current_status =='6' || current_status =='7'){
        $("#type_assesment_schedule").hide();
    }
     
});

$('#sub_status').change(function(){ 
    var sub_status = $(this).val();
    var request_number = $('[name=request_number]').val();
    var personnel_number =  $('[name=personnel_number]').val();    
    $.get("<?php echo base_url();?>index.php/quality_control/get_type_assesment/" + sub_status + "/" + request_number + "/" + personnel_number, function(data, status){                 
        $("#type_assesment_schedule").html(data);
    });
});
</script>
