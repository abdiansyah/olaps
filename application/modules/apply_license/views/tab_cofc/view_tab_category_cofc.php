<option value="">--- Silahkan Pilih ---</option> 
    <?php foreach($auth_category_cofc as $row): ?>  
    <option id="category_select" value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
    <?php endforeach; ?>  
<script type="text/javascript">                
$('#tab-category-cofc').change(function(){            
    var category = $(this).val();
    var spec = $('#tab-spec-cofc').val();          
    var type = $('.type_cofc:checked').val();
    var license = $('[name=check_c_of_c]:checked').val();
    $.get("<?php echo base_url();?>index.php/apply_license/get_category_cofc/" + category + "/" + spec + "/" + type + "/" + license, function(data, status){                 
      $("#tab-scope-cofc").html(data);    
    });
    });         
</script>

    