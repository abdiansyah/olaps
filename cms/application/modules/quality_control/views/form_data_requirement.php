<?php
if (@$data_file_requirement[0] != '') {
?>
<br/>
<ul class="nav nav-pills">
    &nbsp;&nbsp;<li><a name="applicant" class="btn btn-info">Document By Applicant</a></li>
    <li><a name="quality" class="btn btn-info">Document By Quality</a></li>  
</ul> 

<div class="col-md-12" id="applicant">
<h3>Document Validation</h3>                           
    <div class="box-body table-responsive no-padding">                                                
    <form action="<?php echo site_url('quality_control/action_document');?>" method="POST" enctype="multipart/form-data" name="form_competing_data" id="form_competing_data"> 
        <table id="table_requirement_document" class="table table-bordered">                    
        <tr>                                                            
            <th width="30%">Document</th>                                                
            <th width="10%">Expiration Date</th>                         
            <th width="5%">Upload Document</th>
            <!--th width="10%">Progress</th-->
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
        <td width="15%"><label class="label_data_document"><?php
            echo @$row->name_file;?></label><input type="hidden" class="no_row_data_document" value="<?php
            echo $i;?>"/></td>                                                                                                                                                                                     
        <td width="10%"></td>        
        <td width="5%"><input type="hidden" id="code_data_requirement_<?php
            echo @$row->code_file;?>" name="code_data_requirement[]" value="<?php
            echo $row->code_file;?>" />        
        <input type="file" id="file_data_requirement_<?php
            echo @$row->code_file;?>" class="file_data_requirement" name="file_data_requirement[]"/>    
        </td>                                                                                                    
        <!--td width="10%">
        <div class="progressbox"><div id="progressbar_data_requirement_<?php
            echo $i;?>" class="progress"></div></div>                                                                                                             
        </td-->   
        <form action="<?php
            echo site_url('quality_control/action_document');?>" method="POST" enctype="multipart/form-data" name="form_competing_data" id="form_competing_data">                    
        <td width="5%">
        <input type="hidden" value="<?php
            echo @$this->session->userdata('request_number');?>" name="request_number"/>        
        <input type="hidden" value="<?php
            echo @$row->personnel_number_fk;?>" name="personnel_number"/>
        <input type="hidden" value="<?php
            echo @$row->code_file;?>" name="code_file"/>
        <input type="hidden" value="<?php
            echo @$row->name_file;?>" name="name_file"/>
        <input type="hidden" value="<?php
            echo @$row->name_file_ftp;?>" name="name_file_ftp"/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success btn-sm" name="action_view_document" <?php
            if(empty($row->name_file_ftp)){echo "disabled";};?>>View</button></td> 
        </form>       
        <td width="5%">        
        &nbsp;
        &nbsp;
        &nbsp;        
        <?php
            if ($row->status_valid == '1'):?>
        <img src="<?php
                echo base_url('/assets/images/property/check.png');?>" height="30"/>
        <?php
            endif;
            if ($row->status_valid == '2'):?>
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
        <button type="submit" class="btn btn-info pull-right btn-sm" name="save_validation_document"><strong>Save And Send</strong></button>
        </form>                 
        <a class="btn btn-info pull-right btn-sm" href="<?php echo site_url('quality_control/index');?>">BACK</a>        
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
            <th width="30%">Document</th>                                                
            <th width="10%">Expiration Date</th>                         
            <th width="5%">Upload Document</th>
            <!--th width="10%">Progress</th-->
            <th width="5%">Action</th>
            <th width="5%">Status</th>            
            <th width="10%">Remarks</th>                        
        </tr>        
        <tbody class="body_data_requirement_quality" id="body_data_requirement_quality" >   
        <!-- Documen specification quality -->                
        <?php
    $i = 1;
    if (is_array(@$data_file_spec_document_quality) || is_object(@$data_file_spec_document_quality)) {
        foreach ($data_file_spec_document_quality as $row):?>        
        <tr>                                                                                               
        <td width="15%"><label class="label_spec_document_quality"><?php
            echo @$row->name_t;?></label><input type="hidden" class="no_row_spec_document_quality" value="<?php
            echo $i;?>"/></td>                                                                                                                                                                             
        <td width="10%"><input type="text" class="form-control expiration_date_spec_quality" name="expiration_date_spec_quality[]"/></td>
        <td width="5%"><input type="hidden" id="code_req_spec_document_quality_<?php
            echo @$row->code_t;?>" name="code_req_spec_document_quality[]" value="<?php
            echo @$row->code_t;?>" />
        <input type="file" id="file_req_spec_document_quality_<?php
            echo @$row->code_t;?>" class="file_req_spec_document_quality" name="file_req_spec_document_quality[]"/>
        </td>                                                                                                 
        <!--td width="10%">
        <div class="progressbox"><div id="progressbar_req_document_quality_<?php
            echo $i;?>" class="progress"></div></div>                                                                                                             
        </td--> 
        <form action="<?php
            echo site_url('quality_control/action_document');?>" method="POST" enctype="multipart/form-data">               
        <td width="5%">
        <input type="hidden" value="<?php
            echo @$request_number;?>" name="request_number"/>
        <input type="hidden" value="<?php
            echo @$personnel_number;?>" name="personnel_number"/>
        <input type="hidden" value="<?php
            echo @$row->code_t;?>" name="code_file"/>
        <input type="hidden" value="<?php
            echo @$row->name_t;?>" name="name_file"/>
        <input type="hidden" value="<?php
            echo @$row->name_file_ftp;?>" name="name_file_ftp"/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success btn-sm" name="action_view_document" <?php
            if(empty($row->name_file_ftp)){echo "disabled";};?>>View</button></td>        
        <td width="5%">
        </form>
        <?php
            if (@$row->status_valid == '1'):
        ?>
        <img src="<?php
                echo base_url('/assets/images/property/check.png');?>" height="30"/>
        <?php
            endif;
            if (@$row->status_valid == '2'):
        ?>
        <img src="<?php
                echo base_url('/assets/images/property/cross_check.png');?>" height="30">
        <?php
            endif;
        ?>        
        </td>                
        <td width="10%"><textarea name="remarks" disabled><?php
            echo @$row->reason;
        ?></textarea></td>              
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
} else {
    redirect('quality_control/index');
}
echo bootstrap_datepicker();
?> 

<script type="text/javascript">
$('div[id=applicant').show();
$('div[id=quality').hide();
$('[name=applicant').on('click',function(){
    $('div[id=applicant').show();
    $('div[id=quality').hide();
});
$('[name=quality').on('click',function(){
    $('div[id=applicant').hide();
    $('div[id=quality').show();
});
$('.body_data_requirement_quality').on('change', '.file_req_document_general', function(e){        
    var id = this.id;
    var data_row_id = id.split("_"); 
    var row_id = data_row_id[4];
    var code_1 = data_row_id[5];
    var code_2 = data_row_id[6];                         
                  
    var progressbar     = $('#progressbar_document_general_'+row_id);
    var statustxt       = $('#statustxt_document_general_'+row_id);                      
    var status_file     = $('#status_file_document_general_'+ row_id);
    var empty_file      = $('#empty_file_document_general_'+ row_id+'_'+ code_1+'_'+ code_2);            
    
    var timerId = 0;
    var ctr=0;
    var max=10;

    timerId = setInterval(function () {    
    ctr++;
    $(progressbar).attr("style","width:" + ctr*max + "%");
    progressbar.css('background','blue');
    statustxt.html(ctr*max + "%"); 
    statustxt.css('color','#000'); 
    status_file.hide(); 
    empty_file.hide();                                 
    
    if (ctr==max){
    status_file.show(); 
    empty_file.show(); 
    clearInterval(timerId);
    status_file.attr('src','<?php
echo base_url('/assets/images/property/check.png');
?>');
    empty_file.attr('src','<?php
echo base_url('/assets/images/property/cross_check.png');
?>');
    }            
}, 300);  
}); 


$('.expiration_date,.expiration_date_quality').datepicker({
    format :'dd-mm-yyyy',
});
//var seen = {};
//$('.body_data_requirement label.label_data_document').each(function() {
//    var txt = $(this).text();        
//    if (seen[txt])
//        $(this).closest('tr').remove();            
//    else
//        seen[txt] = true;
//});
//
 
</script>    