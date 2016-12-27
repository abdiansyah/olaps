<option value="">--- Silahkan Pilih ---</option> 
<?php foreach($type_auth as $row): ?>  
<option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>