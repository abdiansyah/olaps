<?php 
if($p_type_assesment =='17') :
if(@$data_assesment_oral[0]!='') :
?>
<div class="col-md-12">
    <div class="box-body table-responsive no-padding">
        <input type="hidden" name="request_number" value="<?php echo @$get_data_apply_personnel_by['request_number'];?>"/>
        <input type="hidden" name="personnel_number" value="<?php echo @$get_data_emp_personnel_by['personnel_number'];?>"/>
                            
        <table class="table table-bordered tab-schedule-oral-assesment">                    
        <thead>
        <tr>
            <th width="2%"><input type="checkbox" name="check_all" onClick="check_uncheck_checkbox(this.checked);"/></th>  <th width="2%">No</th>
            <th width="15%">Status</th>                                                                    
            <th width="30%">Scope</th>  
            <th width="10%">Date of Oral Test</th>
            <th width="10%">Time</th>
            <th width="10%">Location</th>                                                          
        </tr>    
        </thead>
        <tbody>                                        
        <?php
        $no=1;
        foreach ($data_assesment_oral as $value):                    
        ?> 
        <tr> 
            <td><input type="checkbox" class="check_assesment" name="check_assesment[]"/></td>                      
            <td>
                <?php echo $no ?>
                <input type="hidden" name="id_license[]" value="<?php echo $value->id_license;?>"/>
                <input type="hidden" name="id_type[]" value="<?php echo $value->id_type;?>"/>
                <input type="hidden" name="id_spect[]" value="<?php echo $value->id_spect;?>"/>
                <input type="hidden" name="id_category[]" value="<?php echo $value->id_category;?>"/>
                <input type="hidden" name="id_scope[]" value="<?php echo $value->id_scope;?>"/>
            </td>                        
            <td>
            <?php
                $status = @$data_assesment_oral[0]->reason_apply_license;                          
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
                echo $reason_apply_license;
                $is_etops = @$data_assesment[0]->is_etops;                          
                switch ($is_etops){
                        case 1 :
                            $status_etops = ' + ETOPS';
                            break;
                        case 0 :
                            $status_etops = '';
                            break;                
                    }
            ?>
            </td>                    
            <td><input type="hidden" name="id_assesment[]" value="<?php echo $value->id; ?>"/><?php echo $value->name_spect .' '.$value->name_category.' '.$value->name_scope.''.$status_etops; ?></td>
            <td><input type="text" name="date_oral_assesment[]" id="date_oral_assesment_<?php echo $no; ?>" class="form-control date_oral_assesment"/></td>                        
            <td>
            <select id="id_oral_sesi_<?php echo $no; ?>" name="id_oral_sesi[]" class="form-control id_oral_sesi"> 
            <option value="" data-date-format="hh:ii"><a>00:00</a></option>                       
            <option value="1" data-date-format="hh:ii"><a>09:00 - 11:00</a></option>
            <option value="2" data-date-format="hh:ii"><a>13:00 - 15:00</a></option>
            </select>
            </td>
            <td>
            <select class="form-control id_oral_room" name="id_oral_room[]" id="id_oral_room_<?php echo $no;?>">
            <option value="">--- Choose room ---</option>
            <?php echo modules::run('quality_control/quality_control/get_all_room');?>
            </select>                
            </td>
        </tr>                                       
        <?php
            $no++;
        endforeach;
        ?>                                                                           
        </tbody>                     
        </table>
    </div>
</div>
<div class="col-md-12">
<button type="submit" class="btn btn-info pull-right btn-sm" name="saveoralassesment"><strong>Save Oral Assesment</strong></button>
</div>
<?php 
endif; 
endif;

if($p_type_assesment =='5') :
if(@$data_assesment[0]!='') :
 ?>
<div class="col-md-12">                        
    <div class="box-body table-responsive no-padding">                    
        <table class="table table-bordered tab-schedule-written-assesment">                    
        <thead>
        <tr>
            <th width="2%"><input type="checkbox" name="check_all"  onClick="check_uncheck_checkbox(this.checked);"/></th>                        
            <th width="2%">No</th>
            <th width="15%">Status</th>                                                                    
            <th width="30%">Scope</th>  
            <th width="10%">Date of Written Test</th>
            <th width="10%">Time</th>
            <th width="10%">Location</th>                                                          
        </tr>    
        </thead>
        <tbody>                                        
        <?php
        $no=1;
        foreach ($data_assesment as $value):                    
        ?> 
        <tr> 
            <td><input type="checkbox" class="check_assesment" name="check_assesment[]"/></td>                                              
            <td>
            <?php echo $no ?>
            <input type="hidden" name="id_license[]" value="<?php echo $value->id_license;?>"/>
            <input type="hidden" name="id_type[]" value="<?php echo $value->id_type;?>"/>
            <input type="hidden" name="id_spect[]" value="<?php echo $value->id_spect;?>"/>
            <input type="hidden" name="id_category[]" value="<?php echo $value->id_category;?>"/>
            <input type="hidden" name="id_scope[]" value="<?php echo $value->id_scope;?>"/>
            </td>                        
            <td>
            <?php
            $status = @$data_assesment[0]->reason_apply_license;                          
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
            echo $reason_apply_license;
            $is_etops = @$data_assesment[0]->is_etops;                          
            switch ($is_etops){
                    case 1 :
                        $status_etops = ' + ETOPS';
                        break;
                    case 0 :
                        $status_etops = '';
                        break;                
                }
            ?>
            </td>                    
            <td><input type="hidden" name="id_assesment[]" value="<?php echo $value->id; ?>"/><?php echo $value->name_spect .' '.$value->name_category.' '.$value->name_scope.''.$status_etops; ?></td>
            <td><input type="text" name="date_written_assesment[]" id="date_written_assesment_<?php echo $no; ?>" class="form-control date_written_assesment"/></td>                        
            <td>
            <select id="id_written_sesi_<?php echo $no; ?>" name="id_written_sesi[]" class="form-control id_written_sesi"> 
            <option value="" data-date-format="hh:ii"><a>00:00</a></option>                       
            <option value="1" data-date-format="hh:ii"><a>09:00 - 11:00</a></option>
            <option value="2" data-date-format="hh:ii"><a>13:00 - 15:00</a></option>
            </select>                                                                                                                                                                                       
            </td>
            <td>
            <select class="form-control id_written_room" name="id_written_room[]" id="id_written_room_<?php echo $no;?>">
            <option value="">--- Choose room ---</option>
            <?php echo modules::run('quality_control/quality_control/get_all_room');?>
            </select>                         
            </td>                        
        </tr>                                       
        <?php
        $no++;
        endforeach;
        ?>                                                                           
        </tbody>                     
        </table>
    </div>
</div>
<div class="col-md-12">
<button type="submit" class="btn btn-info pull-right btn-sm" name="savewrittenassesment"><strong>Save Written Assesment</strong></button>           
</div>
<?php
endif;
endif;

if($p_type_assesment =='18') :
if(@$data_assesment_practical[0]!='') :
?>
<div class="col-md-12">                        
    <div class="box-body table-responsive no-padding">                    
        <table class="table table-bordered tab-schedule-written-assesment">                    
        <thead>
        <tr>
            <th width="2%"><input type="checkbox" name="check_all"  onClick="check_uncheck_checkbox(this.checked);"/></th>                        
            <th width="2%">No</th>
            <th width="15%">Status</th>                                                                    
            <th width="30%">Scope</th>  
            <th width="10%">Date of Practical Test</th>
            <th width="10%">Time</th>            
        </tr>    
        </thead>
        <tbody>                                        
        <?php
        $no=1;
        foreach ($data_assesment_practical as $value):                    
        ?> 
        <tr> 
            <td><input type="checkbox" class="check_assesment" name="check_assesment[]"/></td>                                              
            <td>
            <?php echo $no ?>
            <input type="hidden" name="id_license[]" value="<?php echo $value->id_license;?>"/>
            <input type="hidden" name="id_type[]" value="<?php echo $value->id_type;?>"/>
            <input type="hidden" name="id_spect[]" value="<?php echo $value->id_spect;?>"/>
            <input type="hidden" name="id_category[]" value="<?php echo $value->id_category;?>"/>
            <input type="hidden" name="id_scope[]" value="<?php echo $value->id_scope;?>"/>
            </td>                        
            <td>
            <?php
            $status = @$data_assesment_practical[0]->reason_apply_license;                          
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
            echo $reason_apply_license;
            $is_etops = @$data_assesment_practical[0]->is_etops;                          
            switch ($is_etops){
                    case 1 :
                        $status_etops = ' + ETOPS';
                        break;
                    case 0 :
                        $status_etops = '';
                        break;                
                }
            ?>
            </td>                    
            <td><input type="hidden" name="id_assesment[]" value="<?php echo $value->id; ?>"/><?php echo $value->name_spect .' '.$value->name_category.' '.$value->name_scope.''.$status_etops; ?></td>
            <td><input type="text" name="date_practical_assesment[]" id="date_practical_assesment_<?php echo $no; ?>" class="form-control date_practical_assesment"/></td>                        
            <td>
            <select id="id_practical_sesi_<?php echo $no; ?>" name="id_practical_sesi[]" class="form-control id_practical_sesi"> 
            <option value="" data-date-format="hh:ii"><a>00:00</a></option>                       
            <option value="1" data-date-format="hh:ii"><a>09:00 - 11:00</a></option>
            <option value="2" data-date-format="hh:ii"><a>13:00 - 15:00</a></option>
            </select>                                                                                                                              </td>                       
        </tr>                                       
        <?php
        $no++;
        endforeach;
        ?>                                                                           
        </tbody>                     
        </table>
    </div>
</div>
<div class="col-md-12">
    <button type="submit" class="btn btn-info pull-right btn-sm" name="savepracticalassesment"><strong>Save Practical Assesment</strong></button>
</div>
<?php
endif;
endif;
?>
<?php
echo bootstrap_datepicker();
?>     
<script type="text/javascript">
$().ready(function(){
    $('.date_written_assesment,.date_oral_assesment,.date_practical_assesment').datepicker({    
        autoclose: true,
        format:'dd-mm-yyyy',          
    });    

    $('.date_written_assesment,.date_oral_assesment,.date_practical_assesment').datepicker().on('changeDate', function(){
        $(this).datepicker('hide');
    });
    
    $('.tab-schedule-written-assesment').on('change', '.id_written_room', function(){    
        var id = this.id;
        var data_id_room = id.split("_"); 
        var row_id_room = data_id_room[3];  
        
        var date_written_assesment = $('#date_written_assesment_'+ row_id_room).val();
        var id_written_sesi = $('#id_written_sesi_'+ row_id_room).val();        
        var id_written_room = $('#id_written_room_'+ row_id_room).val();        
        var type_assesment  = $('#sub_status');
        if(id_written_room!=''){   
            $.getJSON("<?php echo site_url();?>/quality_control/cek_room/" + date_written_assesment + "/" + id_written_sesi + "/" + id_written_room , function(data) {
                if (data == null){
                    $('[name=savewrittenassesment]').attr('disabled',false);
                };                    
                if (data.limit >= data.quota) {
                    $('[name=savewrittenassesment]').attr('disabled',true);
                    alert('Room for this session full.');

                };                         
            });    
        }                         
       
    });

    $('.tab-schedule-oral-assesment').on('change', '.id_oral_room', function(){    
        var id = this.id;
        var data_id_room = id.split("_"); 
        var row_id_room = data_id_room[3]; 
        
        var date_oral_assesment = $('#date_oral_assesment_'+ row_id_room).val();
        var id_oral_sesi = $('#id_oral_sesi_'+ row_id_room).val();        
        var id_oral_room = $('#id_oral_room_'+ row_id_room).val();        
        if(id_oral_sesi!=''){        
        $.getJSON("<?php echo base_url();?>index.php/quality_control/cek_room_oral/" + date_oral_assesment + "/" + id_oral_sesi + "/" + id_oral_room, function(data) {                    
            $('#booked_oral_room_'+ row_id_room).val(data.kuota);        
        });
             
        };                      
       
    });
});
</script>
