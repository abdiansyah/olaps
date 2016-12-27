<option value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_category as $row): ?>  
    <option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>
<?php endforeach; ?>     


    