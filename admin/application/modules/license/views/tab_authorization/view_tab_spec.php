<option value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_spec as $row): ?>  
	<option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>                     
