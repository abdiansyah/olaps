<?php
// if (@$data_file_requirement[0] != '') {
?>
<br/>
<ul class="nav nav-pills">
    &nbsp;&nbsp;<li><a name="applicant" class="btn btn-info">Document By Applicant</a></li>
    <li><a name="quality" class="btn btn-info">Document By Quality</a></li>  
</ul> 
<div class="col-md-12" id="applicant">
<h3>Document Validation</h3>     

<div id="FormSearch" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Search</h4>
      </div>
      <form method="POST" action="<?php echo site_url('quality_control/view_document_by');?>">      
      <div>                          
            <div class="form-group col-sm-12">
                <br/>
                <input type="hidden" value="<?php echo @$this->session->userdata('request_number');?>" name="request_number"/>        
                <input type="hidden" value="<?php echo @$this->session->userdata('personnel_number');?>" name="personnel_number"/>
                <select class="form-control" name="id_authorization">         
                    <option value="">--- Choose Authorization ---</option>                                
                    <?php echo modules::run('quality_control/quality_control/option_authorization');?>
                </select>
                <br/>
                <select class="form-control" name="id_type">         
                   
                </select>                  
            </div>                  
      </div>                                     
      <div class="modal-footer">                                            
      <button type="button" class="btn btn-flat btn-danger color-palette btn-sm" data-dismiss="modal"><span class="fa fa-sign-out"></span> &nbsp;Cancel</button>      
      <button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="view_document_by"><span class="fa fa-search"></span> &nbsp;Find </button>     
      </div>
      </form>
    </div>
  </div>
</div> 
<button type="button" class="btn btn-flat bg-light-blue color-palette btn-sm" data-toggle="modal" data-target="#FormSearch">Search</button>
<br/>
<br/>
    <div class="box-body table-responsive no-padding">                                                
    <form action="<?php echo site_url('quality_control/action_document');?>" method="POST" enctype="multipart/form-data" name="form_competing_data" id="form_competing_data"> 
        <table id="table_requirement_document" class="table table-bordered">                    
        <tr>
            <th width="3%">No.</th>
            <th width="20%">Document</th>                                                
            <th width="10%">Date Training</th>  
            <th width="10%">Expiration Date</th>                         
            <th width="5%">Upload Document</th>            
            <th width="5%">Action</th>
            <th width="5%">Status</th>            
            <th width="10%">Remarks</th>                        
        </tr>                                    
    <tbody class="body_data_requirement" id="body_data_requirement" >           
        <?php
    $i = 1;
    if (is_array(@$data_file_requirement) || is_object(@$data_file_requirement)) {
        foreach ($data_file_requirement as $row):?>        
        <tr>                                                                                                        
        <td width="3%" align="center">
            <?php echo $i; ?>
        </td>
        <td width="20%">
            <label class="label_data_document">
                <?php echo @$row->name_file;?>                
            </label>
            <input type="hidden" class="no_row_data_document" value="<?php
            echo $i;?>"/>            
        </td>                                                                                                                           
        <td width="10%">
            <input type="text" class="date_training_data_requirement" id="date_training_data_requirement_<?php
            echo $i;?>" value="<?php if (@$row->date_training != NULL ) {echo date('d-m-Y',strtotime(@$row->date_training));}?>" />                                 
        </td>        
        <td width="10%">
            <input type="text" class="save_result_expiration_date_data_requirement" id="save_result_expiration_date_data_requirement_<?php
            echo $i;?>"  value="<?php if (@$row->expiration_date != NULL ) {echo date('d-m-Y',strtotime(@$row->expiration_date));}?>"/>
        </td>        
        <td width="5%">
            <input type="hidden" id="code_data_requirement_<?php echo $i;?>" value="<?php echo $row->code_file;?>" />        
            <input type="file" id="file_data_requirement_<?php echo $i;?>" class="file_data_requirement"/>    
            <b id="msg_data_requirement_<?php echo $i;?>"></b>                           
        </td>                                                                                                            
        <form action="<?php echo site_url('quality_control/action_document');?>" method="POST" enctype="multipart/form-data" name="form_competing_data" id="form_competing_data">                    
            <td width="5%">
                <input type="hidden" value="<?php echo @$this->session->userdata('request_number');?>" name="request_number"/>        
                <input type="hidden" value="<?php echo @$this->session->userdata('personnel_number');?>" id="personnel_number_<?php echo $i;?>" name="personnel_number"/>
                <input type="hidden" name="code_file" id="code_data_requirement_<?php echo $i;?>" value="<?php echo $row->code_file;?>" />        
                <input type="hidden" value="<?php echo @$row->name_file;?>" name="name_file"/>
                <input type="hidden" name="date_upload" id="date_data_requirement_<?php echo $i;?>" />        
                <input type="hidden" name="time_upload" id="time_data_requirement_<?php echo $i;?>" />          
                <input type="hidden" value="<?php echo @$row->name_file_ftp;?>" name="name_file_ftp"/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="action_view_document btn btn-success btn-sm" name="action_view_document" id="<?php echo $i; ?>">View</button><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loadingmessage_<?php echo $i; ?>" src="<?php echo base_url('/assets/images/property/squares.gif');?>"/>
            </td> 
        </form>       
        <td width="5%">        
        &nbsp;
        &nbsp;
        &nbsp;        
        <?php
            if (@$row->status_valid == '1'):?>
        <img src="<?php
                echo base_url('/assets/images/property/check.png');?>" height="30"/>
        <?php
            endif;
            if (@$row->status_valid == '2'):?>
        <img src="<?php
                echo base_url('/assets/images/property/cross_check.png');?>" height="30">
        <?php
            endif;?>        
        </td>                
        <td width="10%">        
        <textarea name="remarks[]" disabled><?php
            echo @$row->reason;?></textarea>
        </td>              
        </tr>
        <?php
            $i++;
        endforeach;
    }
?>                                     
        </tbody>                
        </table>                
        <button type="submit" class="btn btn-info pull-right btn-sm" name="save_validation_document"><strong>Verify & Send</strong></button>
        </form>                 
        <a class="btn btn-info pull-right btn-sm" href="<?php echo site_url('quality_control/index');?>">Back</a>        
        <br/>        
        <br/>
            
        </div>
    </div>                
    <div class="col-md-12" id="quality">        
    <h3>Additional Document (Completed by TQD)</h3>        
        <div class="box-body table-responsive no-padding">                                                
            <form action="<?php echo site_url('quality_control/action_document');?>" method="POST" enctype="multipart/form-data">                  
                    <table id="table_requirement_document" class="table table-bordered">                    
        <tr>
            <th width="3%">No.</th>
            <th width="20%">Document</th>                                                
            <th width="10%">Date Training</th>  
            <th width="10%">Expiration Date</th>                         
            <th width="5%">Upload Document</th>            
            <th width="5%">Action</th>
            <th width="5%">Status</th>            
            <th width="10%">Remarks</th>                        
        </tr>                                    
    <tbody class="body_data_requirement" id="body_data_requirement" >           
        <?php
    $i = 1;
    if (is_array(@$data_file_spec_document_quality) || is_object(@$data_file_spec_document_quality)) {
        foreach ($data_file_spec_document_quality as $row):?>        
        <tr>                                                                                                        
        <td width="3%" align="center">
            <?php echo $i; ?>
        </td>
        <td width="20%">
            <label class="label_data_document">
                <?php echo @$row->name_file;?>                
            </label>
            <input type="hidden" class="no_row_data_document_tqd_" value="<?php
            echo $i;?>"/>            
        </td>                                                                                                                           
        <td width="10%">
            <input type="text" class="date_training_data_requirement_tqd" id="date_training_data_requirement_tqd_<?php
            echo $i;?>" value="<?php if (@$row->date_training != NULL ) {echo date('d-m-Y',strtotime(@$row->date_training));}?>" />                                 
        </td>        
        <td width="10%">
            <input type="text" class="save_result_expiration_date_data_requirement_tqd" id="save_result_expiration_date_data_requirement_tqd_<?php
            echo $i;?>"  value="<?php if (@$row->expiration_date != NULL ) {echo date('d-m-Y',strtotime(@$row->expiration_date));}?>"/>
        </td>        
        <td width="5%">
            <input type="hidden" id="code_data_requirement_tqd_<?php echo $i;?>" value="<?php echo $row->code_file;?>" />        
            <input type="file" id="file_data_requirement_tqd_<?php echo $i;?>" class="file_data_requirement_tqd"/>    
            <b id="msg_data_requirement_tqd_<?php echo $i;?>"></b>                           
        </td>                                                                                                            
        <form action="<?php echo site_url('quality_control/action_document');?>" method="POST" enctype="multipart/form-data" name="form_competing_data" id="form_competing_data">                    
            <td width="5%">
                <input type="hidden" value="<?php echo @$this->session->userdata('request_number');?>" name="request_number_tqd"/>        
                <input type="hidden" value="<?php echo @$this->session->userdata('personnel_number');?>" id="personnel_number_tqd_<?php echo $i;?>" name="personnel_number_tqd"/>
                <input type="hidden" name="code_file" id="code_data_requirement_tqd_<?php echo $i;?>" value="<?php echo $row->code_file;?>" />        
                <input type="hidden" value="<?php echo @$row->name_file;?>" name="name_file"/>
                <input type="hidden" name="date_upload" id="date_data_requirement_tqd_<?php echo $i;?>" />        
                <input type="hidden" name="time_upload" id="time_data_requirement_tqd_<?php echo $i;?>" />          
                <input type="hidden" value="<?php echo @$row->name_file_ftp;?>" name="name_file_ftp_tqd"/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--button type="submit" class="action_view_document btn btn-success btn-sm" name="action_view_document" id="<?php echo $i; ?>">View</button><br/-->
                <img style="display:none" id="loadingmessage_tqd_<?php echo $i; ?>" src="<?php echo base_url('/assets/images/property/squares.gif');?>"/>
            </td> 
        </form>       
        <td width="5%">        
        &nbsp;
        &nbsp;
        &nbsp;        
        <?php
            if (@$row->status_valid == '1'):?>
        <img src="<?php
                echo base_url('/assets/images/property/check.png');?>" height="30"/>
        <?php
            endif;
            if (@$row->status_valid == '2'):?>
        <img src="<?php
                echo base_url('/assets/images/property/cross_check.png');?>" height="30">
        <?php
            endif;?>        
        </td>                
        <td width="10%">        
            <textarea name="remarks_tqd[]" disabled>
                <?php echo @$row->reason;?>        
            </textarea>
        </td>              
        </tr>
        <?php
            $i++;
        endforeach;
    }
?>                                     
        </tbody>                
        </table> 
            <div class="col-md-12">
            <br />
            <button type="submit" class="btn btn-info pull-right btn-sm" name="save_req_document_tqd"><strong>Save</strong></button>
            </form> 
            <a class="btn btn-info pull-right btn-sm" href="<?php echo site_url('quality_control/index');?>">BACK</a>        
            </div> 
        </div>
    </div>    
    <!--- File Quality -->        
<?php
// } else {
//     redirect('quality_control/index');
// }
echo bootstrap_datepicker();
?> 
<script type="text/javascript">
    var cek_date_file_current               = "<?php echo site_url().'/quality_control/cek_date_file_current/';?>",
        cek_time_file_current               = "<?php echo site_url().'/quality_control/cek_time_file_current/';?>",
        cek_expiration_file_current         = "<?php echo site_url().'/quality_control/cek_expiration_file_current/';?>",
        cek_authorization                   = "<?php echo site_url().'/quality_control/cek_authorization/';?>",
        upload_file_data_requirement        = "<?php echo site_url().'/quality_control/upload_file_data_requirement/';?>",
        upload_file_data_requirement_tqd    = "<?php echo site_url().'/quality_control/upload_file_data_requirement_tqd/';?>";      
</script>
<script src="<?php echo base_url('assets/plugins/js/form_data_requirement.js');?>" type="text/javascript"></script>
