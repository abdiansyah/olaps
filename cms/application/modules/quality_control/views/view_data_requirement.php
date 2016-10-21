<?php
if(@$data_file_requirement[0]!='') {
?>
<section class="content-header">
	<h1>Document Validation</h1>    
</section>
<div class="col-md-12">                        
	<div class="box-body table-responsive no-padding">                    
        <table class="table table-bordered tab-requirement-document">                    
        <table id="table_requirement_document" class="table table-bordered">					
		<tr>                        
			<th width="3%" align="center">No</th>                        
			<th width="15%">Document</th>                                                
            <th width="10%">Expiration Date</th>                         
            <th width="5%">Upload Document</th>
            <th width="10%">Progress</th>
            <th width="5%">Action</th>
            <th width="5%">Status</th>            
            <th width="10%">Remarks</th>                        
		</tr>                    
        <tbody class="body_general_requirement" id="content_general_requirement" >	
        <?php 
        $i=1;
        if (is_array(@$data_file_requirement) || is_object(@$data_file_requirement))
        { 
        foreach($data_file_requirement as $row): 
        ?>
        <tr>                                        
        <td align="center" width="3%"><?php echo $i;?></td>                                               
        <td width="15%">
        <?php echo @$row->name_file;?>
        <input type="hidden" class="no_row_general_document" value="<?php echo $i;?>"/>
        </td>                                                                                                                                                                             
        <td width="10%"></td>
        <td width="5%"><input type="hidden" name="code_req_general_document[]" value="<?php echo $row->code_file; ?>" />
        <input type="file" name="file_req_document_general[]"/>
        </td>                                                                                                 
        <td width="10%">
        <div class="progressbox"><div id="progressbar_document_general_<?php echo $i;?>" class="progress"></div>                                                                                                             
        </td>        
        <td width="5%"><button type="submit" class="btn btn-info pull-right btn-sm" name="view_data_document">View</button></td>
        <td width="5%"></td>                
        <td width="10%"><textarea name="remarks"></textarea></td>              
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
    <button type="submit" class="btn btn-info pull-right btn-sm" name="save_validation_document"><strong>Save</strong></button>    		
    </div>
    </div>
    <!-- Update by quality-->
    <div class="box-body table-responsive no-padding">                    
        <table class="table table-bordered tab-requirement-document">                    
        <table id="table_requirement_document" class="table table-bordered">                    
        <tr>                        
            <th width="3%" align="center">No</th>                        
            <th width="15%">Document</th>                                                
            <th width="10%">Expiration Date</th>                         
            <th width="5%">Upload Document</th>
            <th width="10%">Progress</th>
            <th width="5%">Action</th>
            <th width="5%">Status</th>            
            <th width="10%">Remarks</th>                        
        </tr>                    
        <tbody class="body_general_requirement" id="content_general_requirement" >  
        <?php 
        $i=1;
        if (is_array(@$data_file_requirement) || is_object(@$data_file_requirement))
        { 
        foreach($data_file_requirement as $row): 
        ?>
        <tr>                                        
        <td align="center" width="3%"><?php echo $i;?></td>                                               
        <td width="15%">
        <?php echo @$row->name_file;?>
        <input type="hidden" class="no_row_general_document" value="<?php echo $i;?>"/>
        </td>                                                                                                                                                                             
        <td width="10%"></td>
        <td width="5%"><input type="hidden" name="code_req_general_document[]" value="<?php echo $row->code_file; ?>" />
        <input type="file" name="file_req_document_general[]"/>
        </td>                                                                                                 
        <td width="10%">
        <div class="progressbox"><div id="progressbar_document_general_<?php echo $i;?>" class="progress"></div>                                                                                                             
        </td>        
        <td width="5%"><button type="submit" class="btn btn-info pull-right btn-sm" name="view_data_document">View</button></td>
        <td width="5%"></td>                
        <td width="10%"><textarea name="remarks"></textarea></td>              
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
    <button type="submit" class="btn btn-info pull-right btn-sm" name="save_validation_document"><strong>Save</strong></button>         
    </div>
    </div>
<?php
}else{
    redirect('quality_control/index');
}
echo bootstrap_datepicker();
?>     