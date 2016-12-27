<option value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_type as $row): ?>
    <option id="type_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>"><?php echo $row->name_t; ?></option>
<?php endforeach; ?>
      