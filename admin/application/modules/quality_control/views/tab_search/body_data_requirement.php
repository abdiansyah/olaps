<?php
if(@$data_file_requirement[0]!='') :
?>
<div class="col-md-12">                        
	<div class="box-body table-responsive no-padding">                    
        <table class="table table-bordered tab-schedule-written-assesment">                    
                <table id="table_requirement_document" class="table table-bordered">					
		<tr>                        
			<th>No</th>                        
			<th>Document</th>                                                
            <th>Expiration Date</th>                         
            <th>Upload Document</th>
            <th>Progress</th>
            <th>Status</th>
            <th>Action</th>
            <th>Remarks</th>                        
		</tr>                    
        <tbody class="body_general_requirement" id="content_general_requirement" >	
        <?php 
        $i=1;
        if (is_array(@$data_file_requirement) || is_object(@$data_file_requirement))
        { 
        foreach($data_file_requirement as $row): 
        ?>
        <tr>                                        
        <td align="center"><?php echo $i;?></td>                                               
        <td><?php echo $row->name_t;?><input type="hidden" class="no_row_general_document" value="<?php echo $i;?>"/></td>                                                                                                                                                                             
        <td><input type="hidden" class="type_continous_general_document" value="<?php echo $row->category_continous; ?>" /></td>
        <td><input type="hidden" id="code_req_general_document_<?php echo $row->code_t;?>" name="code_req_general_document[]" value="<?php echo $row->code_t; ?>" />
        <input type="file" id="file_req_document_general_<?php echo $i;?>_<?php echo $row->code_t;?>" class="file_req_document_general" name="file_req_document_general[]"/>
        </td>                                                                                                 
        <td width="20%">
        <div class="progressbox"><div id="progressbar_document_general_<?php echo $i;?>" class="progress"></div>                                                                                                             
        </td>        
        <td><button class="btn btn-success btn-sm">Verified</button></td>
        <td><input type="text" class="type_continous_general_document" /></td>        
        <td><textarea name="remarks"></textarea></td>              
        </tr>
        <?php
        $i++;                     
        endforeach;
        }
        ?>                                     
        </tbody>                    
		</table>                
		</table>
	</div>
</div>
<div class="col-md-12">
<button type="submit" class="btn btn-info pull-right btn-sm" name="savewrittenassesment"><strong>Save</strong></button>    		
</div>
<?php
endif;
echo bootstrap_datepicker();
?>     
<script type="text/javascript">
$('.date_written_assesment,.date_oral_assesment').datepicker({
    format:'dd-mm-yyyy'
});

$('.tab-schedule-written-assesment').on('change', '.id_written_sesi', function(e){    
    var id = this.id;
    var data_id_sesi = id.split("_"); 
    var row_id_sesi = data_id_sesi[3]; 
    
    var date_written_assesment = $('#date_written_assesment_'+ row_id_sesi).val();
    var id_written_sesi = $('#id_written_sesi_'+ row_id_sesi).val();        
    var id_written_room = $('#id_room_'+ row_id_sesi).val();        
    if(id_written_sesi!=''){        
    $.getJSON("<?php echo base_url();?>index.php/quality_control/cek_room/" + id_written_sesi, function(data) {            
        $('#name_written_room_'+ row_id_sesi).val(data.nr);
        $('#id_written_room_'+ row_id_sesi).val(data.ir);                                          
    });
    $.getJSON("<?php echo base_url();?>index.php/quality_control/cek_one_room/", function(data) {            
        $('#name_written_room_'+ row_id_sesi).val(data.nr);
        $('#id_written_room_'+ row_id_sesi).val(data.ir);                                          
    });         
    };                      
   
});

$('.tab-schedule-oral-assesment').on('change', '.id_oral_sesi', function(e){    
    var id = this.id;
    var data_id_sesi = id.split("_"); 
    var row_id_sesi = data_id_sesi[3]; 
    
    var date_oral_assesment = $('#date_oral_assesment_'+ row_id_sesi).val();
    var id_oral_sesi = $('#id_oral_sesi_'+ row_id_sesi).val();        
    var id_oral_room = $('#id_room_'+ row_id_sesi).val();        
    if(id_oral_sesi!=''){        
    $.getJSON("<?php echo base_url();?>index.php/quality_control/cek_room/" + id_oral_sesi, function(data) {            
        $('#name_oral_room_'+ row_id_sesi).val(data.nr);
        $('#id_oral_room_'+ row_id_sesi).val(data.ir);                                          
    });
    $.getJSON("<?php echo base_url();?>index.php/quality_control/cek_one_room/", function(data) {            
        $('#name_oral_room_'+ row_id_sesi).val(data.nr);
        $('#id_oral_room_'+ row_id_sesi).val(data.ir);                                          
    });         
    };                      
   
});

</script>
