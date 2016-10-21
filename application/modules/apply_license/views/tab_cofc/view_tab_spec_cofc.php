    <option value="">--- Silahkan Pilih ---</option> 
    <?php foreach($auth_spec_cofc as $row): ?>  
    <option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
    <?php endforeach; ?>                     
<script type="text/javascript">                              
    $('#tab-spec-cofc').change(function(){            
    var spec = $(this).val();                     
    var license = $('[name=check_c_of_c]:checked').val();
    var type = $('.type_cofc:checked').val();
    $.get("<?php echo base_url();?>index.php/apply_license/get_spec_cofc/" + spec + "/" + license + "/" + type, function(data, status){                 
      $("#tab-category-cofc").html(data);
    });
    });                          
</script>