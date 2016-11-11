<?php
if(!isset($data_authorization_request['submitauthorizationrequest'])) {
        redirect('apply_license/index');
    } else {
?>
<div class="row">
<div class="col-md-12 col-center-block table-responsive">
<div class="box box-info box-center" id="halaman3">
    <div class="progress">
        <div id="progress-step" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
            <label>60% Completed</label>
        </div>
    </div>
    <div class="box-header with-border">
        <h3 class="box-title">COMPLETING DATA</h3>
    </div>
    <div class="box-body">
            <div id="warning" class="modal fade" role="dialog">
              <div class="modal-dialog">      
                <div class="modal-content">
                  <div class="modal-header">        
                  <h4 class="modal-title">Information</h4>
                  </div>
                  <div class="modal-body">
                  <h4><img src="<?php echo base_url('/assets/images/property/cross_check.png');?>" height="30"/> 
                  &nbsp;&nbsp;Your License/Training Certificate Will Expired In Less Than 90 Days, You Need To Put a New Certificate/License.</h4>        
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                  </div>
                </div>
              </div>
            </div>      
            <div class="col-md-12" id="tab_completing_data">
            <form action="<?php echo site_url('apply_license/completing_data');?>" method="POST" enctype="multipart/form-data" name="form_competing_data" id="form_competing_data">
                <div class="box-body table-responsive no-padding">
                    <div class="box-header">
                    <tr>                        
                        <td colspan="4"><h4><b>Document</b></h4></td>                        
                    </tr>
                    </div>
                    <table id="table_requirement_document" class="table table-bordered">                    
                    <tr>                        
                        <th>No</th>                        
                        <th>Document</th>                                                
                        <th>Expiration Date</th>                         
                        <th>Upload Document</th>
                        <th>Progress</th>
                        <th>Status</th>
                    </tr>                    
                    <tbody class="body_general_requirement" id="content_general_requirement" >  
                    <?php 
                    $i=1;
                        if (is_array(@$additional_general_document) || is_object(@$additional_general_document))
                        { 
                            foreach($additional_general_document as $row): 
                            ?>
                            <tr>                                        
                            <td align="center"><?php echo $i;?></td>                                               
                            <td><?php echo $row->name_t;?><input type="hidden" class="no_row_general_document" value="<?php echo $i;?>"/></td>
                            <?php if($row->category_continous == '-' || $row->category_continous =='New') { ?>
                                        <td><input type="hidden" class="type_continous_general_document" value="<?php echo $row->category_continous; ?>" /></td>
                                        <td><input type="hidden" id="code_req_general_document_<?php echo $row->code_t;?>" name="code_req_general_document[]" value="<?php echo $row->code_t; ?>" />
                                        <input type="file" id="file_req_document_general_<?php echo $i;?>_<?php echo $row->code_t;?>" class="file_req_document_general" name="file_req_document_general[]"/>
                                        </td>                                   
                            <?php } ?>                                                            
                            <td width="20%">
                            <div class="progressbox"><div id="progressbar_document_general_<?php echo $i;?>" class="progress"></div>
                            <div id="statustxt_document_general_<?php echo $i;?>" class="statustxt_document_general">0%</div ></div>    
                            </td>
                            <td><img class="status_file_document_general" id="status_file_document_general_<?php echo $i;?>" height="30"/> &nbsp; <img class="empty_file_document_general" id="empty_file_document_general_<?php echo $i;?>_<?php echo $row->code_t; ?>" height="30"/> </td>              
                            </tr>
                        <?php
                            $i++;                     
                            endforeach;
                        }
                    ?>                                     
                    </tbody>                    
                    </table>
                    <br/>
                    <div class="box-header">
                    <tr>                        
                        <td colspan="4"><h4><b>Training Certificate</b></h4></td>                        
                    </tr>
                    </div>
                    <table id="table_requirement_certificate" class="table table-bordered">                                                         
                    <tr>                        
                        <th>No</th>                        
                        <th>Copy Certificate</th>                        
                        <th>Date Training</th>  
                        <th>Expiration Date</th>                          
                        <th>Upload Document</th>
                        <th>Progress</th>
                        <th>Status</th>                        
                    </tr>
                    <tbody class="body_specification_requirement" id="content_specification_requirement">   
                    <?php 
                        echo @$data_general_certificate;
                        echo @$data_req_specific;
                        echo @$data_req_specific_license_garuda;
                        echo @$data_req_specific_license_citilink;
                        echo @$data_req_specific_license_sriwijaya;                             
                        echo @$data_req_specific_easa;                     
                        echo @$data_req_specific_special;                    
                        echo @$data_req_specific_garuda;                    
                        echo @$data_req_specific_citilink;                    
                        echo @$data_req_specific_sriwijaya;
                        echo @$data_req_specific_cofc;
                    ?>                                     
                    </tbody>                     
                    </table>
                </div>
            </div>      
    </div>
    <div class="box-footer">        
        <button type="submit" class="btn btn-info pull-right open3 btn-sm" name="submitcompletingdata" id="submitcompletingdata"><b>NEXT</b></button>
        <a href="<?php echo base_url();?>index.php/apply_license/index"><button type="button" class="btn btn-info pull-right close2 btn-sm" name="previous"><b>PREVIOUS</b></button></a>
        <button type="submit" class="btn btn-warning pull-right btn-sm" name="savecompletingdata"><b>SAVE</b></button>
    </div>
    </form>
</div>
</div>
</div>
<?php 
};
echo bootstrap_datepicker(); 
?>
<script type="text/javascript">    
$(document).ready(function () {
    var seen = {};
    $('.body_specification_requirement label.label_req_spec').each(function() {
        var txt = $(this).text();        
        if (seen[txt])
            $(this).closest('tr').remove();            
        else
            seen[txt] = true;
    }); 
    
    $('[name=submitcompletingdata],.body_specification_requirement').keypress(function(event){
    if (event.keyCode === 10 || event.keyCode === 13) 
        event.preventDefault();
    });  
    
    // 26-09-2016    
   $('.body_general_requirement').on('change', '.file_req_document_general', function(e){           
    var file_req_document_general_003     = $('#file_req_document_general_1_ARG_0003').val();
    var file_req_document_general_004     = $('#file_req_document_general_2_ARG_0004').val();
    var file_req_document_general_005     = $('#file_req_document_general_3_ARG_0005').val();
    var file_req_document_general_006     = $('#file_req_document_general_4_ARG_0006').val();
    var file_req_document_general_007     = $('#file_req_document_general_5_ARG_0007').val();
    if(file_req_document_general_003 !='' || file_req_document_general_004 !=''){
        $('#file_req_document_general_2_ARG_0004').attr('required',true);
        $('#file_req_document_general_1_ARG_0003').attr('required',true);
    };  
    if(file_req_document_general_005 !='' || file_req_document_general_006 !='' || file_req_document_general_007 !=''){
        $('#file_req_document_general_3_ARG_0005').attr('required',true);
        $('#file_req_document_general_4_ARG_0006').attr('required',true);
        $('#file_req_document_general_5_ARG_0007').attr('required',true);
    };                    
                      
});
    
    $('[name=submitcompletingdata]').click(function(){
        $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_no_required_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',false);
        $('.file_req_document_certificate,.file_req_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('required',true); 
        $('.file_req_no_required_document_certificate,.file_req_no_required_spec_certificate').attr('required',false);       
    });
    
    $('[name=submitcompletingdata]').mouseout(function(){
        $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_no_required_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',true);           
    });    
    
    
    $('.expiration_date_req_general,.date_training_req_general_certificate,.date_training_req_spec_certificate,.date_training_req_spec_certificate_easa,.date_training_req_spec_certificate_special,.date_training_req_spec_certificate_garuda,.date_training_req_spec_certificate_citilink,.date_training_req_spec_certificate_sriwijaya,.date_training_req_spec_certificate_license_garuda,.date_training_req_spec_certificate_license_citilink,.date_training_req_spec_certificate_license_sriwijaya,.expiration_date_req_spec_certificate_special,.expiration_date_req_spec_certificate_garuda,.expiration_date_req_spec_certificate_citilink,.expiration_date_req_spec_certificate_sriwijaya').datepicker(         
        {format: 'dd-mm-yyyy',
        orientation: 'top auto',
        autoclose : 'true',
        clearBtn : 'true',}           
    );  
    // Disabled input file     
    $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_no_required_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',true);
    
    $('[name=savecompletingdata]').click(function(){
    $('.file_req_document_certificate,.file_req_no_required_document_certificate,.file_req_spec_certificate,.file_req_no_required_spec_certificate,.file_req_spec_certificate_license_garuda,.file_req_spec_certificate_license_citilink,.file_req_spec_certificate_license_sriwijaya,.file_req_spec_certificate_easa,.file_req_spec_certificate_special,.file_req_spec_certificate_garuda,.file_req_spec_certificate_citilink,.file_req_spec_certificate_sriwijaya').attr('disabled',false);
    });
    
    // Progressbar upload file           
    $('.body_general_requirement').on('change', '.file_req_document_general', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];
        var code_1 = data_row_id[5];
        var code_2 = data_row_id[6];                         
                      
        var progressbar     = $('#progressbar_document_general_'+row_id);
        var statustxt       = $('#statustxt_document_general_'+row_id);                      
        var status_file     = $('#status_file_document_general_'+ row_id);
        var empty_file     = $('#empty_file_document_general_'+ row_id+'_'+ code_1+'_'+ code_2);            
        
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
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    }); 
    
    $('.body_general_requirement').on('click', '.empty_file_document_general', function(e){

        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];
        var code_1 = data_row_id[5];
        var code_2 = data_row_id[6];
        var file_req_document_general_003     = $('#file_req_document_general_1_ARG_0003').val();
        var file_req_document_general_004     = $('#file_req_document_general_2_ARG_0004').val();
        var file_req_document_general_005     = $('#file_req_document_general_3_ARG_0005').val();
        var file_req_document_general_006     = $('#file_req_document_general_4_ARG_0006').val();
        var file_req_document_general_007     = $('#file_req_document_general_5_ARG_0007').val();        
        var file_req_document_general = $('#file_req_document_general_'+row_id+'_'+code_1+'_'+code_2);
        
        var empty_file     = $('#empty_file_document_general_'+ row_id+'_'+code_1+'_'+code_2);
        var progressbar     = $('#progressbar_document_general_'+row_id); 
        var status_file     = $('#status_file_document_general_'+ row_id);       
        var statustxt       = $('#statustxt_document_general_'+row_id);             
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide(); 
        file_req_document_general.replaceWith( file_req_document_general.val('').clone( true ) );        
        
        if(file_req_document_general_003 =='' || file_req_document_general_004 ==''){
            $('#file_req_document_general_1_ARG_0003').attr('required',false);
            $('#file_req_document_general_2_ARG_0004').attr('required',false);            
        };  
        if(file_req_document_general_005 == '' || file_req_document_general_006 =='' || file_req_document_general_007 ==''){
            $('#file_req_document_general_3_ARG_0005').attr('required',false);
            $('#file_req_document_general_4_ARG_0006').attr('required',false);
            $('#file_req_document_general_5_ARG_0007').attr('required',false);
        }; 
    }); 
    
    
    $('.body_specification_requirement').on('change', '.file_req_document_certificate', function(e){
        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];                              
                      
        var progressbar     = $('#progressbar_document_certificate_'+ row_id);
        
        var statustxt       = $('#statustxt_document_certificate_'+ row_id);                      
        var status_file     = $('#status_file_document_certificate_'+ row_id); 
        var empty_file     = $('#empty_file_document_certificate_'+ row_id);           
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    }); 
    
    
    $('.body_specification_requirement').on('click', '.empty_file_document_certificate', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];        
                                                                           
        var progressbar     = $('#progressbar_document_certificate_'+ row_id);        
        var statustxt       = $('#statustxt_document_certificate_'+ row_id);                      
        var status_file     = $('#status_file_document_certificate_'+ row_id); 
        var empty_file     = $('#empty_file_document_certificate_'+ row_id);
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_document_certificate_'+row_id).val('');                                                                                                                                                                                   
    });     
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate, .file_general_spec_certificate', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];                              
                      
        var progressbar     = $('#progressbar_req_certificate_'+ row_id);        
        var statustxt       = $('#statustxt_req_certificate_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_'+ row_id);
        var empty_file     = $('#empty_file_req_certificate_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_req_certificate', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];        
        
        var progressbar     = $('#progressbar_req_certificate_'+ row_id);
        var statustxt       = $('#statustxt_req_certificate_'+ row_id);                      
        var status_file     = $('#status_file_req_certificate_'+ row_id);
        var empty_file     = $('#empty_file_req_certificate_'+ row_id);
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_'+row_id).val('');                                                                                                                                                                                   
    });
     
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_garuda, .file_req_general_certificate_license_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                                    
                      
        var progressbar     = $('#progressbar_certificate_license_garuda_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_garuda_'+ row_id);  
        var statustxt       = $('#statustxt_certificate_license_garuda_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_garuda_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    });
    
     $('.body_specification_requirement').on('click', '.empty_file_certificate_license_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        
        
        var progressbar     = $('#progressbar_certificate_license_garuda_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_garuda_'+ row_id);  
        var statustxt       = $('#statustxt_certificate_license_garuda_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_garuda_'+ row_id);            

                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_license_garuda_'+row_id).val('');                                                                                                                                                                                   
    });
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_citilink,.file_req_general_certificate_license_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                                    
                      
        var progressbar     = $('#progressbar_certificate_license_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_license_citilink_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_citilink_'+ row_id);            
        var empty_file     = $('#empty_file_certificate_license_citilink_'+ row_id);
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_license_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        
        
        var progressbar     = $('#progressbar_certificate_license_citilink_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_citilink_'+ row_id);  
        var statustxt       = $('#statustxt_certificate_license_citilink_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_citilink_'+ row_id);            

                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_license_citilink_'+row_id).val('');                                                                                                                                                                                   
    });
      
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_license_sriwijaya,.file_req_general_certificate_license_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[6];                                    
                      
        var progressbar     = $('#progressbar_certificate_license_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_license_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_sriwijaya_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_sriwijaya_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_license_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];        
        
        var progressbar     = $('#progressbar_certificate_license_sriwijaya_'+ row_id);
        var empty_file     = $('#empty_file_certificate_license_sriwijaya_'+ row_id);  
        var statustxt       = $('#statustxt_certificate_license_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_certificate_license_sriwijaya_'+ row_id);            

                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_license_sriwijaya_'+row_id).val('');                                                                                                                                                                                   
    }); 
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_easa,.file_req_general_certificate_easa', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_easa_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_easa_'+ row_id);                      
        var status_file     = $('#status_file_certificate_easa_'+ row_id);
        var empty_file     = $('#empty_file_certificate_easa_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_easa', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];       
        
        var progressbar     = $('#progressbar_certificate_easa_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_easa_'+ row_id);                      
        var status_file     = $('#status_file_certificate_easa_'+ row_id);
        var empty_file     = $('#empty_file_certificate_easa_'+ row_id);
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_easa_'+row_id).val('');                                                                                                                                                                                   
    }); 
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_special,.file_req_general_certificate_special', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_special_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_special_'+ row_id);                      
        var status_file     = $('#status_file_certificate_special_'+ row_id);
        var empty_file     = $('#empty_file_certificate_special_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_special', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];       
        
        var progressbar     = $('#progressbar_certificate_special_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_special_'+ row_id);                      
        var status_file     = $('#status_file_certificate_special_'+ row_id);
        var empty_file      = $('#empty_file_certificate_special_'+ row_id);            
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_special_'+row_id).val('');                                                                                                                                                                                   
    });  
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_garuda,.file_req_general_certificate_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_garuda_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_garuda_'+ row_id);                      
        var status_file     = $('#status_file_certificate_garuda_'+ row_id);
        var empty_file     = $('#empty_file_certificate_garuda_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_garuda', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];       
        
        var progressbar     = $('#progressbar_certificate_garuda_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_garuda_'+ row_id);                      
        var status_file     = $('#status_file_certificate_garuda_'+ row_id);
        var empty_file     = $('#empty_file_certificate_garuda_'+ row_id);            
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_garuda_'+row_id).val('');                                                                                                                                                                                   
    });  
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_citilink,.file_req_general_certificate_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_citilink_'+ row_id);                      
        var status_file     = $('#status_file_certificate_citilink_'+ row_id);
        var empty_file     = $('#empty_file_certificate_citilink_'+ row_id);            
        
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
            // max reached?
            if (ctr==max){
            status_file.show(); 
            empty_file.show(); 
            clearInterval(timerId);
            status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
            empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
            }            
        }, 300);  
    });
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_citilink', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];    
        
        
        var progressbar     = $('#progressbar_certificate_citilink_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_citilink_'+ row_id);                      
        var status_file     = $('#status_file_certificate_citilink_'+ row_id);
        var empty_file     = $('#empty_file_certificate_citilink_'+ row_id);            
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_citilink_'+row_id).val('');                                                                                                                                                                                   
    });   
    
    $('.body_specification_requirement').on('change', '.file_req_spec_certificate_sriwijaya,.file_req_general_certificate_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[5];                                    
                      
        var progressbar     = $('#progressbar_certificate_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_certificate_sriwijaya_'+ row_id);
        var empty_file     = $('#empty_file_certificate_sriwijaya_'+ row_id);            
        
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
        // max reached?
        if (ctr==max){
        status_file.show(); 
        empty_file.show(); 
        clearInterval(timerId);
        status_file.attr('src','<?php echo base_url('/assets/images/property/check.png'); ?>');
        empty_file.attr('src','<?php echo base_url('/assets/images/property/cross_check.png'); ?>');
        }            
    }, 300);  
    }); 
    
    $('.body_specification_requirement').on('click', '.empty_file_certificate_sriwijaya', function(e){        
        var id = this.id;
        var data_row_id = id.split("_"); 
        var row_id = data_row_id[4];       
        
        var progressbar     = $('#progressbar_certificate_sriwijaya_'+ row_id);        
        var statustxt       = $('#statustxt_certificate_sriwijaya_'+ row_id);                      
        var status_file     = $('#status_file_certificate_sriwijaya_'+ row_id);
        var empty_file     = $('#empty_file_certificate_sriwijaya_'+ row_id);          
                     
        $(progressbar).attr("style","width:0%");
        progressbar.css('background','white');
        statustxt.html("0%"); 
        statustxt.css('color','#000');  
        status_file.hide(); 
        empty_file.hide();  
                                  
        $('#file_req_spec_certificate_sriwijaya_'+row_id).val('');
    });  
    
    //cofc                                                                            
           
    if($('.date_training').val('')){
       $('.training_certificate_req').attr('disabled',true);
       var date_training = new Date();
       var day = ("0" + date_training.getDate()).slice(-2);
       var month = ("0" + (date_training.getMonth() + 1)).slice(-2);       
       $('.date_training').val((day)+'-'+(month)+'-'+date_training.getFullYear());            
    };
        $('.body_general_requirement').on('.focusout', '.expiration_date_req_general_document', function(e){
            var row_id = this.id;
            if($('.expiration_date_req_general_document').val != ''){        
            $('#file_req_document_general_' + row_id).attr('disabled',false);
            }else{
            $('#file_req_document_general_' + row_id).attr('disabled',true);
            };

        }); 
        
        $('.date_training_req_general_certificate').datepicker().on('click', function(e){
            var row_id = this.id;                                      
            $('#result_expiration_date_req_general_certificate_'+row_id).val('');
            $('#save_result_expiration_date_req_general_certificate_'+row_id).val(''); 
            $('#label_result_expiration_date_req_general_certificate_'+row_id).val('');
        });                
        
        $('.date_training_req_general_certificate').datepicker().on('changeDate', function(){
            var row_id = this.id;      
            var d = new Date();
            var day_now = d.getDate();
            var month_date_now = d.getMonth();
            var thn_date_now = d.getFullYear();
          if($('.date_training_req_general_certificate#'+row_id).val() != '') {
            var id_thn = $('.date_training_req_general_certificate#' + row_id).val();
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1];
            var thn = data_thn_id[2];
            var age = $('#expiration_date_req_general_certificate_'+ row_id).val();
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age));
            if(rs_exp_date == null) {
              $('#file_req_document_certificate_' + row_id).attr('disabled',false);
            }
            else if(isNaN(thn + age)) {
              $('#file_req_document_certificate_' + row_id).attr('disabled',false);
            }
            else {
              var data_thn_exp_id = rs_exp_date.split("-");
              var month_exp = data_thn_exp_id[1];
              var thn_exp = data_thn_exp_id[2];
              var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
              var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
              // alert(date_now);
              // alert(date_exp);
              //                                                                                                  
              $('#save_result_expiration_date_req_general_certificate_'+row_id).val(rs_exp_date);
              $('#label_result_expiration_date_req_general_certificate_'+row_id).val(rs_exp_date);
              if(date_exp > date_now){
                $('#file_req_document_certificate_' + row_id).attr('disabled',false);            
              }
              else{
                $('#warning').modal({
                  backdrop: 'static', keyboard: false }
                                   );
                $('#file_req_document_certificate_' + row_id).attr('disabled',true);
              };
            };
          }
          else if($('.date_training_req_general_certificate#'+row_id).val().length == 0){
            $('#file_req_document_certificate_' + row_id).attr('disabled',true);
          };
          $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate').datepicker().on('changeDate', function(e){
            var row_id = this.id;                                      
            $('#result_expiration_date_req_spec_certificate_'+row_id).val('');
            $('#save_result_expiration_date_req_spec_certificate_'+row_id).val(''); 
            $('#label_result_expiration_date_req_spec_certificate_'+row_id).val('');
        });              
        
        $('.date_training_req_spec_certificate').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate#' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)) 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_' + row_id).attr('disabled',false);    
                }
                else{ 
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                      
                $('#result_expiration_date_req_spec_certificate_'+row_id).val(rs_exp_date);                                                        
                $('#save_result_expiration_date_req_spec_certificate_'+row_id).val(rs_exp_date);
                $('#label_result_expiration_date_req_spec_certificate_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate#'+row_id).val().length == 0){
            $('#file_req_spec_certificate_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        // License Garuda
        $('.date_training_req_spec_certificate_license_garuda').datepicker().on('changeDate', function(e){
            var row_id = this.id;                                      
            $('#result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val('');
            $('#save_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(''); 
            $('#label_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val('');
        });
        
        $('.date_training_req_spec_certificate_license_garuda').datepicker().on('changeDate', function(e){                 
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_license_garuda#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate_license_garuda#' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_license_garuda_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',false);    
                }
                else {                                                                                                                
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);  
                                                                        
                $('#result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(rs_exp_date);
                $('#save_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(rs_exp_date);                                                        
                $('#label_result_expiration_date_req_spec_certificate_license_garuda_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_license_garuda#'+row_id).val().length == 0){
                $('#file_req_spec_certificate_license_garuda_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });

        // License Citilink
        $('.date_training_req_spec_certificate_license_citilink').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_license_citilink#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate_license_citilink#' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_license_citilink_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',false);    
                }
                else {
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                           
                $('#result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val(rs_exp_date);
                $('#save_result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val(rs_exp_date);                                                        
                $('#label_result_expiration_date_req_spec_certificate_license_citilink_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_license_citilink#'+row_id).val().length == 0){
            $('#file_req_spec_certificate_license_citilink_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        // License Sriwijaya
        $('.date_training_req_spec_certificate_license_sriwijaya').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_license_sriwijaya#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate_license_sriwijaya#' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_license_sriwijaya_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',false);    
                }
                else { 
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                       
                $('#result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val(rs_exp_date);                                                        
                $('#save_result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val(rs_exp_date);
                $('#label_result_expiration_date_req_spec_certificate_license_sriwijaya_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_license_sriwijaya#'+row_id).val().length == 0){
            $('#file_req_spec_certificate_license_sriwijaya_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_easa').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_easa#'+row_id).val().length != 0){
                var id_thn = $('.date_training_req_spec_certificate_easa#' + row_id).val(); 
                var data_thn_id = id_thn.split("-");
                var day = data_thn_id[0];
                var month = data_thn_id[1]; 
                var thn = data_thn_id[2];             
                var age = $('#expiration_date_req_spec_certificate_easa_'+ row_id).val(); 
                var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null) {
                    $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',false);    
                } else {                                                                                                                
                var data_thn_exp_id = rs_exp_date.split("-");            
                var month_exp = data_thn_exp_id[1];
                var thn_exp = data_thn_exp_id[2]; 
                var d = new Date();
                var day_now = d.getDate();
                var month_date_now = d.getMonth();
                var thn_date_now = d.getFullYear();                                                                             
                var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                
                
                $('#result_expiration_date_req_spec_certificate_easa_'+row_id).val(rs_exp_date);
                $('#save_result_expiration_date_req_spec_certificate_easa_'+row_id).val(rs_exp_date);                                                        
                $('#label_result_expiration_date_req_spec_certificate_easa_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_easa#'+row_id).val().length == 0){
                $('#file_req_spec_certificate_easa_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        
        $('.date_training_req_spec_certificate_special').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_special#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_special#' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_special_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
            if(rs_exp_date == null){
                    $('#file_req_spec_certificate_special_' + row_id).attr('disabled',false);    
                } else if(isNaN(thn + age)) {
                    $('#file_req_spec_certificate_special_' + row_id).attr('disabled',false);    
                }
                else{
                    var data_thn_exp_id = rs_exp_date.split("-");            
                    var month_exp = data_thn_exp_id[1];
                    var thn_exp = data_thn_exp_id[2]; 
                    var d = new Date();
                    var day_now = d.getDate();
                    var month_date_now = d.getMonth();
                    var thn_date_now = d.getFullYear();                                                                             
                    var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                    var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                    
                    $('#result_expiration_date_req_spec_certificate_special_'+row_id).val(rs_exp_date);
                    $('#save_result_expiration_date_req_spec_certificate_special_'+row_id).val(rs_exp_date);                                                        
                    $('#label_result_expiration_date_req_spec_certificate_special_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_special_' + row_id).attr('disabled',false); 
                        }else{
                            $('#warning').modal({ backdrop: 'static', keyboard: false });
                            $('#file_req_spec_certificate_special_' + row_id).attr('disabled',true);                 
                        };                                                                                
                    }                                  
            } else if($('.date_training_req_spec_certificate_special#'+row_id).val().length == 0) {
                $('#file_req_spec_certificate_special_' + row_id).attr('disabled',true);
                };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_garuda').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_garuda#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_garuda#' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_garuda_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                        $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',false);    
                    } else if(isNaN(thn + age)) {
                        $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',false);    
                    }
                    else {           
                    var data_thn_exp_id = rs_exp_date.split("-");            
                    var month_exp = data_thn_exp_id[1];
                    var thn_exp = data_thn_exp_id[2]; 
                    var d = new Date();
                    var day_now = d.getDate();
                    var month_date_now = d.getMonth();
                    var thn_date_now = d.getFullYear();                                                                             
                    var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                    var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                                
                    $('#result_expiration_date_req_spec_certificate_garuda_'+row_id).val(rs_exp_date);
                    $('#result_expiration_date_req_spec_certificate_garuda_'+row_id).val(rs_exp_date);                                                        
                    $('#label_result_expiration_date_req_spec_certificate_garuda_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            } else if($('.date_training_req_spec_certificate_garuda#'+row_id).val().length == 0) {
                    $('#file_req_spec_certificate_garuda_' + row_id).attr('disabled',true);
                };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_citilink').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_citilink#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_citilink#' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_citilink_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                        $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',false);    
                    } else if(isNaN(thn + age)) {
                        $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',false);    
                    } else {
                    var data_thn_exp_id = rs_exp_date.split("-");            
                    var month_exp = data_thn_exp_id[1];
                    var thn_exp = data_thn_exp_id[2]; 
                    var d = new Date();
                    var day_now = d.getDate();
                    var month_date_now = d.getMonth();
                    var thn_date_now = d.getFullYear();                                                                             
                    var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                    var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                    
                    $('#result_expiration_date_req_spec_certificate_citilink_'+row_id).val(rs_exp_date);
                    $('#save_result_expiration_date_req_spec_certificate_citilink_'+row_id).val(rs_exp_date);                                                        
                    $('#label_result_expiration_date_req_spec_certificate_citilink_'+row_id).val(rs_exp_date);
                    if(date_exp > date_now){
                        $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',false); 
                    }else{
                        $('#warning').modal({ backdrop: 'static', keyboard: false });
                        $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',true);                 
                    };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_citilink#'+row_id).val().length == 0){
                    $('#file_req_spec_certificate_citilink_' + row_id).attr('disabled',true);
                };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_sriwijaya').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_sriwijaya#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_sriwijaya#' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_sriwijaya_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                    $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',false);    
                    } else if(isNaN(thn + age)) {
                        $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',false);    
                    } else {
                        var data_thn_exp_id = rs_exp_date.split("-");            
                        var month_exp = data_thn_exp_id[1];
                        var thn_exp = data_thn_exp_id[2]; 
                        var d = new Date();
                        var day_now = d.getDate();
                        var month_date_now = d.getMonth();
                        var thn_date_now = d.getFullYear();                                                                             
                        var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                        var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                                    
                        $('#result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val(rs_exp_date);
                        $('#save_result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val(rs_exp_date);                                                        
                        $('#label_result_expiration_date_req_spec_certificate_sriwijaya_'+row_id).val(rs_exp_date);
                        if(date_exp > date_now){
                            $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',false); 
                        }else{
                            $('#warning').modal({ backdrop: 'static', keyboard: false });
                            $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',true);                 
                        };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_sriwijaya#'+row_id).val().length == 0){
                $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        $('.date_training_req_spec_certificate_cofc').datepicker().on('changeDate', function(e){        
            var row_id = this.id;
            if($('.date_training_req_spec_certificate_cofc#'+row_id).val().length != 0){
            var id_thn = $('.date_training_req_spec_certificate_cofc#' + row_id).val(); 
            var data_thn_id = id_thn.split("-");
            var day = data_thn_id[0];
            var month = data_thn_id[1]; 
            var thn = data_thn_id[2];             
            var age = $('#expiration_date_req_spec_certificate_cofc_'+ row_id).val(); 
            var rs_exp_date = day + "-" + month + "-" + (parseInt(thn) + parseInt(age)); 
                if(rs_exp_date == null){
                        $('#file_req_spec_certificate_cofc_' + row_id).attr('disabled',false);    
                    } else if(isNaN(thn + age)) {
                        $('#file_req_spec_certificate_sriwijaya_' + row_id).attr('disabled',false);    
                    } else {
                        var data_thn_exp_id = rs_exp_date.split("-");            
                        var month_exp = data_thn_exp_id[1];
                        var thn_exp = data_thn_exp_id[2]; 
                        var d = new Date();
                        var day_now = d.getDate();
                        var month_date_now = d.getMonth();
                        var thn_date_now = d.getFullYear();                                                                             
                        var date_exp = new Date(data_thn_exp_id[2], parseInt(data_thn_exp_id[1])+2, data_thn_exp_id[0]);
                        var date_now = new Date(thn_date_now, parseInt(month_date_now)+6, day_now);
                                                                                    
                        $('#result_expiration_date_req_spec_certificate_cofc_'+row_id).val(rs_exp_date);
                        $('#save_result_expiration_date_req_spec_certificate_cofc_'+row_id).val(rs_exp_date);                                                        
                        $('#label_result_expiration_date_req_spec_certificate_cofc_'+row_id).val(rs_exp_date);
                        if(date_exp > date_now){
                            $('#file_req_spec_certificate_cofc_' + row_id).attr('disabled',false); 
                        }else{
                            $('#file_req_spec_certificate_cofc_' + row_id).attr('disabled',true);                 
                        };                                                                                
                }                                  
            }else if($('.date_training_req_spec_certificate_cofc#'+row_id).val().length == 0){
            $('#file_req_spec_certificate_cofc_' + row_id).attr('disabled',true);
            };
            $(this).datepicker('hide');
        });
        
        
        });
</script>       
            