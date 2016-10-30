<?php 
if(@$data_history[0]!=''){
?>
<div class="row">
<div class="col-md-10 col-md-offset-1 col-center-block table-responsive">
<div class="box box-info box-center" id="halaman5">    
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <div class="box-body">
            <div class="col-md-12">
            <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">            
                    <?php
                    if(!empty($data_history[0]->submited)){
                    $class_submited = "active";
                    }else{
                    $class_submited = "disabled";    
                    }
                    ?> 
                    <li role="presentation" class="<?php echo $class_submited; ?>">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">                            
                            <img id="status" src="<?php echo base_url('assets/images/property/data-submited.png'); ?>">                                                       
                        </a> 
                               
                        <a id="head_nav">Date Submited</a>                                       
                    </li>                    
                    <?php
                    if(!empty($data_history[0]->approved_superior)){
                    $class_approved_superior = "active";
                    }else{
                    $class_approved_superior = "disabled";    
                    }
                    ?>
                    <li role="presentation" class="<?php echo $class_approved_superior; ?>">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">                            
                                <img id="status" src="<?php echo base_url('assets/images/property/approved.png'); ?>">                            
                        </a>
                        <a id="head_nav">Superior Approval</a> 
                    </li>
                    <?php
                    if(!empty($data_history[0]->approved_quality)){
                    $class_approved_quality = "active";
                    }else{
                    $class_approved_quality = "disabled";    
                    }
                    ?>
                    <li role="presentation" class="<?php echo $class_approved_quality; ?>">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <img id="status" src="<?php echo base_url('assets/images/property/qc-approved.png'); ?>">
                        </a>
                        <a id="head_nav">Data Validated</a>
                    </li>
                    <?php
                    if($data_history[0]->check_assesment == '2'){
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
                    if((!empty($data_history[0]->desc_gmf_issue_authorization)) || (!empty($data_history[0]->desc_coc_issue_authorization)) || (!empty($data_history[0]->desc_easa_issue_authorization)) || (!empty($data_history[0]->desc_ga_issue_authorization)) || (!empty($data_history[0]->desc_citilink_issue_authorization)) || (!empty($data_history[0]->desc_sriwijaya_issue_authorization)) ){
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
                    if(!empty($data_history[0]->status_take_authorization)){
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
                    if(!empty($data_history[0]->status_finish)){
                    $class_status_finish = "active";
                    }else{
                    $class_status_finish = "disabled";    
                    }
                    ?>
                    <li role="presentation" class="<?php echo $class_status_finish?>">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <img id="status" src="<?php echo base_url('assets/images/property/finish.png'); ?>">
                        </a>
                        <a id="head_nav">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Success</a>
                    </li>
                </ul>
            </div>
            </div>
            </div>  
            <div class="col-md-9">           
                <div class="box-body table-responsive no-padding"> 
                    <br/>
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
                        <td><input type="hidden" name="name_applicant" value="<?php echo @$data_history[0]->name;?>"/><?php echo @$data_history[0]->name;?></td>                                                                                        
                        <td><input type="hidden" name="personnel_number_applicant" value="<?php echo @$data_history[0]->personnel_number;?>"/><?php echo @$data_history[0]->personnel_number;?></td>                                                                               
                        <td><?php echo @$data_history[0]->departement;?></td>                                                     
                        <td><?php echo @$data_history[0]->presenttitle;?></td>                                              
                        <td><input type="hidden" name="request_number_applicant" value="
                        <?php 
                        $request_number = @$data_history[0]->request_number; 
                        echo @$request_number?>"/><?php echo @$request_number;?>
                        </td>                                                                   
                        <td class="col-md-10">: <?php echo date('d-M-Y',strtotime(@$data_history[0]->date_submited));?></td>                                                
                    </tr>                                                                                               
                    </tbody>                     
                    </table>
                    <br/>
                </div>
            </div>
            <div class="col-md-3">
                    <div class="panel panel-info"> <!-- div type panel -->
                       <div class="panel-heading text-center"> <!-- div head panel -->
                       <h4>Number of Days Since Receive Data</h4>
                       </div> <!-- end div head panel -->                  
                      <div class="panel-body"> <!-- div body panel -->
                            <div class="col-md-12"> <!-- div content panel -->                               
                            <font size="40">
                            <p align="center">
                            <?php                                                                
                            @$date_submited = $data_history[0]->date_submited;
                            @$date_finish = $data_history[0]->date_finish;
                            if($date_finish != ''){
                                @$date_until = $data_history[0]->date_finish;
                            };
                            if($date_finish == '' || $date_finish == 'Null'){  
                                @$date_until = date('d-m-Y'); 
                            }                                                                                                             
                            echo round(abs(strtotime($date_until)-strtotime($date_submited))/86400);                    
                            ?>
                            </p>
                            </font>
                            </div>  <!-- end div content panel -->
                        </div>  <!-- end div body panel -->                                                                                      
                   </div> <!-- end div type panel -->       
            </div>
            <div class="col-md-12">           
        <div class="box-body table-responsive no-padding">
        <br/>
        <h4><b>License information</b> :</h4>        
        <?php $status = @$cek_data_summary[0]->reason_apply_license;
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
        <b><font size="3">Reason of request : <?php echo @$reason_apply_license; ?></font></b>
        <br/>
        <br/>
        <table class="table">
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
         foreach($cek_data_summary as $row) {
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
                    <h4><b>Application Status</b> :</h4>                                      
                    <table id="" class="table table-bordered">                    
                    <thead>
                    <tr>                        
                        <th>No</th>                        
                        <th>Date</th>                        
                        <th>Time</th>
                        <th>Activity</th>                        
                    </tr>    
                    </thead>
                    <tbody>                    
                    <?php
                    foreach ($data_history as $value):
                    $no=1;
                    ?> 
                    <tr>
                        <?php if(@$value->submited != '' AND $value->submited != '0'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $value->date_submited ?></td>
                        <td><?php echo $value->time_submited ?></td>                        
                        <td>Data Submited</td>
                        <?php endif;?>
                    </tr> 
                    <tr>
                        <?php if(@$value->approved_superior != '' AND $value->approved_superior != '0'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_approved_superior; ?></td>
                        <td><?php echo @$value->time_approved_superior; ?></td>                       
                        <td><?php echo @$value->approved_superior; ?></td>
                        <?php endif;?>
                    </tr>  
                    <tr>
                        <?php if(@$value->approved_quality != '' AND $value->approved_quality != '0'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_approved_quality; ?></td>
                        <td><?php echo @$value->time_approved_quality; ?></td>                       
                        <td><?php echo @$value->approved_quality; ?></td>
                        <?php endif;?>                        
                    </tr>
                    <tr>
                        <?php if(@$value->status_assesment != '' AND ($value->status_assesment == 'Assesment Process' || $value->status_assesment == 'Assesment Process Closed')):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_assesment ?></td>
                        <td><?php echo @$value->time_assesment ?></td>                       
                        <td><?php echo 'Assesment Process'; ?></td>
                        <?php endif;?>                        
                    </tr> 
                    <tr>
                        <?php if(@$value->status_assesment != '' AND $value->status_assesment == 'Assesment Process Closed'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_verification_assesment ?></td>
                        <td><?php echo @$value->time_verification_assesment ?></td>                       
                        <td><?php echo @$value->status_assesment ?></td>
                        <?php endif;?>                          
                    </tr>
                    <tr>
                        <?php if(@$value->desc_gmf_issue_authorization == 'GMF Authorization Issued'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_gmf_issue_authorization ?></td>
                        <td><?php echo @$value->time_gmf_issue_authorization ?></td>                       
                        <td><?php echo @$value->desc_gmf_issue_authorization ?></td>
                        <?php endif;?>                        
                    </tr> 
                    <tr>
                        <?php if(@$value->desc_coc_issue_authorization == 'C of C and/or Stamp Issued'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_coc_issue_authorization ?></td>
                        <td><?php echo @$value->time_coc_issue_authorization ?></td>                       
                        <td><?php echo @$value->desc_coc_issue_authorization ?></td>
                        <?php endif;?>                        
                    </tr>
                    <tr>
                        <?php if(@$value->desc_easa_issue_authorization == 'EASA Authorization Issued'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_easa_issue_authorization ?></td>
                        <td><?php echo @$value->time_easa_issue_authorization ?></td>                       
                        <td><?php echo @$value->desc_easa_issue_authorization ?></td>
                        <?php endif;?>                        
                    </tr> 
                    <tr>
                        <?php if(@$value->desc_ga_issue_authorization == 'GA Authorization Issued'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_ga_issue_authorization ?></td>
                        <td><?php echo @$value->time_ga_issue_authorization ?></td>                       
                        <td><?php echo @$value->desc_ga_issue_authorization ?></td>
                        <?php endif;?>                        
                    </tr>
                    <tr>
                        <?php if(@$value->desc_clink_issue_authorization == 'Citilink Authorization Issued'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_clink_issue_authorization ?></td>
                        <td><?php echo @$value->time_clink_issue_authorization ?></td>                       
                        <td><?php echo @$value->desc_clink_issue_authorization ?></td>
                        <?php endif;?>                        
                    </tr>  
                    <tr>
                        <?php if(@$value->desc_srwj_issue_authorization == 'Sriwijaya Authorization Issued'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_srwj_issue_authorization ?></td>
                        <td><?php echo @$value->time_srwj_issue_authorization ?></td>                       
                        <td><?php echo @$value->desc_srwj_issue_authorization ?></td>
                        <?php endif;?>                        
                    </tr> 
                    <tr>
                        <?php if(@$value->status_issue_authorization == 'Issue Authorization Finished'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_stts_issue_authorization; ?></td>
                        <td><?php echo @$value->time_stts_issue_authorization; ?></td>                       
                        <td><?php echo @$value->status_issue_authorization; ?></td>
                        <?php endif;?>                        
                    </tr> 
                    <tr>
                        <?php if(@$value->status_referral_authorization == 'Referral Authorization'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_referral_authorization ?></td>
                        <td><?php echo @$value->time_referral_authorization ?></td>                       
                        <td><?php echo @$value->status_referral_authorization ?></td>
                        <?php endif;?>                        
                    </tr>             
                    <tr>
                        <?php if(@$value->status_take_authorization == 'Personnel Record Completed'):?>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo @$value->date_take_authorization ?></td>
                        <td><?php echo @$value->time_take_authorization ?></td>                       
                        <td><?php echo @$value->status_take_authorization ?></td>
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
                        <?php endif;?>                        
                    </tr>                                     
                    <?php
                    endforeach;
                    ?>                                                                           
                    </tbody>                     
                    </table>
                    <br />
                </div>
                <div>
                <a href="<?php echo $back; ?>"><button type="button" class="btn btn-info pull-right close2 btn-sm"  name="previous"><b>PREVIOUS</b></button><a>
                </div> 
            </div>
            <div class="col-md-12" id="statement_atasan">           
            <div class="box-body table-responsive no-padding">                
                <table class="table" id="tbl_dtl_statement_atasan">
                    <thead>                    
                    </thead>
                    <tbody>                                                                                                                                                                                                         
                    </tbody>                                                        
               </table>
            </div>
            </div>                      
    </div>     
</div>
</div>
</div>
<?php
}else{
    redirect(base_url());
}
?> 
<script type="text/javascript">  
  $('[name=submitapproved]').attr('disabled',true);
  $('[name=submitdisapproved]').attr('disabled',true);
  $('[name=check_agree_atasan]').on('change',function(){
    if(this.checked){
    $('[name=submitapproved]').attr('disabled',false);
    $('[name=submitdisapproved]').attr('disabled',false);      
    }else
    {
    $('[name=submitapproved]').attr('disabled',true);
    $('[name=submitdisapproved]').attr('disabled',true);        
    }
  });  
</script>   
            