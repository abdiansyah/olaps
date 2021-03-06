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
                        if (is_array(@$additional_document_general) || is_object(@$additional_document_general))
                        { 
                            foreach($additional_document_general as $row): 
                            ?>
                            <tr>                                        
                            <td align="center"><?php echo $i;?></td>                                               
                            <td><?php echo $row->name_t;?></td>
                            <?php 
                            if($row->category_continous == '-') { ?>
                                <td>
                                <input type="hidden" class="type_continous_document_general" value="<?php echo $row->category_continous; ?>" />
                                <input type="hidden" class="expiration_date_req_general_document" id="expiration_date_req_general_document_<?php echo $i;?>_<?php echo $row->code_t;?>" value=""/>
                                <td>
                                <input type="hidden" id="code_req_document_general_<?php echo $i;?>" value="<?php echo $row->code_t; ?>" />
                                <input type="file" id="file_req_document_general_<?php echo $i;?>_<?php echo $row->code_t;?>" class="file_req_document_general"/>
                                <b id="msg_<?php echo $i;?>"></b>
                                </td>                                   
                            <?php 
                                }                          
                            if($row->category_continous =='New') { ?>
                                <td>
                                <input type="text" class="expiration_date_req_general_document" id="expiration_date_req_general_document_<?php echo $i;?>_<?php echo $row->code_t;?>" value="<?php echo @$row->expiration_date;?>"/>
                                </td>
                                <td>
                                <input type="hidden" id="code_req_document_general_<?php echo $i;?>" value="<?php echo $row->code_t; ?>" />
                                <input type="file" id="file_req_document_general_<?php echo $i;?>_<?php echo $row->code_t;?>" class="file_req_document_general" disabled/>
                                <b id="msg_<?php echo $i;?>"></b>
                                </td>                                   
                            <?php 
                                }                             
                            ?>                              
                            <?php if (!empty($row->code_file)) { ?>
                            <td width="20%">
                                <div class="progressbox"><div id="progressbar_document_general_<?php echo $i;?>" class="progress" style="background:blue"></div>
                                <div id="statustxt_document_general_<?php echo $i;?>" class="statustxt_document_general">100%</div ></div>    
                                <input type="hidden" id="date_req_document_general_<?php echo $i;?>" />
                                <input type="hidden" id="time_req_document_general_<?php echo $i;?>" />
                                <input type="hidden" id="status_upload_document_general_<?php echo $i;?>" class="status_upload_document_general" value="<?php echo $i;?>" />
                            </td>
                                <td><img src = "<?php echo base_url('/assets/images/property/check.png'); ?>" class="status_file_document_general" id="status_file_document_general_<?php echo $i;?>" height="30" /> &nbsp; <img src = "<?php echo base_url('/assets/images/property/cross_check.png'); ?>" class="empty_file_document_general" id="empty_file_document_general_<?php echo $i;?>_<?php echo $row->code_t; ?>" height="30"/>
                                <br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loading_document_general_<?php echo $i;?>" src="<?php echo base_url('/assets/images/property/squares.gif'); ?>"/> 
                                </td> 
                            <?php 
                            } else {
                            ?>
                            <td width="20%">
                                <div class="progressbox"><div id="progressbar_document_general_<?php echo $i;?>" class="progress"></div>
                                <div id="statustxt_document_general_<?php echo $i;?>" class="statustxt_document_general">0%</div ></div>
                                <input type="hidden" id="date_req_document_general_<?php echo $i;?>" />
                                <input type="hidden" id="time_req_document_general_<?php echo $i;?>" />
                            </td>
                            <td>
                                <img class="status_file_document_general" id="status_file_document_general_<?php echo $i;?>" height="30"/> &nbsp; <img class="empty_file_document_general" id="empty_file_document_general_<?php echo $i;?>_<?php echo $row->code_t; ?>" height="30"/> 
                                <input type="hidden" id="status_upload_document_general_<?php echo $i;?>" class="status_upload_document_general" value="" />
                                <br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loading_document_general_<?php echo $i;?>" src="<?php echo base_url('/assets/images/property/squares.gif'); ?>"/> 
                                </td> 
                                <?php 
                                    }
                                ?>                        
                            </tr>
                        <?php
                            $i++;                     
                            endforeach;
                        }
                        // Document certificate (New & -)
                        if (is_array(@$data_req_specific_document) || is_object(@$data_req_specific_document))
                        {
                             foreach($data_req_specific_document as $row): 
                            ?>
                            <tr>                                        
                            <td align="center"><?php echo $i;?></td>                                               
                            <td><?php echo $row->name_t;?></td>
                            <?php 
                            if($row->category_continous == '-') { ?>
                                <td>
                                <input type="hidden" class="type_continous_document_general" value="<?php echo $row->category_continous; ?>" />
                                <input type="text" class="expiration_date_req_general_document" id="expiration_date_req_general_document_<?php echo $i;?>_<?php echo $row->code_t;?>"  value=""/>
                                </td>
                                <td>
                                <input type="hidden" id="code_req_document_general_<?php echo $i;?>" value="<?php echo $row->code_t; ?>" />
                                <input type="file" id="file_req_document_general_<?php echo $i;?>_<?php echo $row->code_t;?>" class="file_req_document_general"/>
                                <b id="msg_<?php echo $i;?>"></b>
                                </td>                                   
                            <?php 
                                }                          
                            if($row->category_continous =='New') { ?>
                                <td>
                                <input type="text" class="expiration_date_req_general_document" id="expiration_date_req_general_document_<?php echo $i;?>_<?php echo $row->code_t;?>"  value="<?php echo @$row->expiration_date;?>"/>
                                </td>
                                <td>
                                <input type="hidden" id="code_req_document_general_<?php echo $i;?>" value="<?php echo $row->code_t; ?>" />
                                <input type="file" id="file_req_document_general_<?php echo $i;?>_<?php echo $row->code_t;?>" class="file_req_document_general" disabled/>
                                <b id="msg_<?php echo $i;?>"></b>
                                </td>                                   
                            <?php 
                                }                             
                            ?>                             
                            <?php if (!empty($row->code_file)) { ?>
                            <td width="20%">
                                <div class="progressbox"><div id="progressbar_document_general_<?php echo $i;?>" class="progress" style="background:blue"></div>
                                <div id="statustxt_document_general_<?php echo $i;?>" class="statustxt_document_general">100%</div ></div>    
                                <input type="hidden" id="date_req_document_general_<?php echo $i;?>" />
                                <input type="hidden" id="time_req_document_general_<?php echo $i;?>" />
                                <input type="hidden" id="status_upload_document_general_<?php echo $i;?>" class="status_upload_document_general" value="<?php echo $i;?>" />
                            </td>
                                <td><img src = "<?php echo base_url('/assets/images/property/check.png'); ?>" class="status_file_document_general" id="status_file_document_general_<?php echo $i;?>" height="30" /> &nbsp; <img src = "<?php echo base_url('/assets/images/property/cross_check.png'); ?>" class="empty_file_document_general" id="empty_file_document_general_<?php echo $i;?>_<?php echo $row->code_t; ?>" height="30"/>
                                <br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loading_document_general_<?php echo $i;?>" src="<?php echo base_url('/assets/images/property/squares.gif'); ?>"/> 
                                </td> 
                            <?php 
                            } else {
                            ?>
                            <td width="20%">
                                <div class="progressbox"><div id="progressbar_document_general_<?php echo $i;?>" class="progress"></div>
                                <div id="statustxt_document_general_<?php echo $i;?>" class="statustxt_document_general">0%</div ></div>
                                <input type="hidden" id="date_req_document_general_<?php echo $i;?>" />
                                <input type="hidden" id="time_req_document_general_<?php echo $i;?>" />
                            </td>
                            <td>
                                <img class="status_file_document_general" id="status_file_document_general_<?php echo $i;?>" height="30"/> &nbsp; <img class="empty_file_document_general" id="empty_file_document_general_<?php echo $i;?>_<?php echo $row->code_t; ?>" height="30"/> 
                                <input type="hidden" id="status_upload_document_general_<?php echo $i;?>" class="status_upload_document_general" value="" />
                                <br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="display:none" id="loading_document_general_<?php echo $i;?>" src="<?php echo base_url('/assets/images/property/squares.gif'); ?>"/> 
                                </td> 
                                <?php 
                                    }
                                ?>                        
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
    var image_check                         = "<?php echo base_url('/assets/images/property/check.png'); ?>",
        image_cross_check                   = "<?php echo base_url('/assets/images/property/cross_check.png'); ?>",
        upload_file_general                 = "<?php echo site_url().'/apply_license/upload_file_general/';?>",
        delete_file_general                 = "<?php echo site_url().'/apply_license/delete_file_general/';?>",
        cek_date_file_current               = "<?php echo site_url().'/apply_license/cek_date_file_current/';?>",
        cek_time_file_current               = "<?php echo site_url().'/apply_license/cek_time_file_current/';?>",
        cek_expiration_file_current         = "<?php echo site_url().'/apply_license/cek_expiration_file_current/';?>",
        upload_file_document_certificate    = "<?php echo site_url().'/apply_license/upload_file_document_certificate/';?>",
        delete_file_document_certificate    = "<?php echo site_url().'/apply_license/delete_file_document_certificate/';?>",
        upload_file_spec_certificate        = "<?php echo site_url().'/apply_license/upload_file_spec_certificate/';?>",
        delete_file_spec_certificate        = "<?php echo site_url().'/apply_license/delete_file_spec_certificate/';?>";        
</script>
<script src="<?php echo base_url('assets/plugins/js/completing_data.js');?>" type="text/javascript"></script>        
            