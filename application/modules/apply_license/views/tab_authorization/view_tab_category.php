<option value="">--- Silahkan Pilih ---</option> 
    <?php foreach($auth_category as $row): ?>  
    <option id="category_select" value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
    <?php endforeach; ?>  
<script type="text/javascript">                
$('#tab-category').on('change',function(){            
    var category = $(this).val();
    var spec = $('#tab-spec').val();          
    var type = $('.type:checked').val();
    var license = $('.license:checked').val();
    
    $.get("<?php echo base_url();?>index.php/apply_license/get_category/" + category + "/" + spec + "/" + type + "/" + license, function(data, status){                 
      $("#tab-scope").html(data);    
    });
    });         
</script>

    