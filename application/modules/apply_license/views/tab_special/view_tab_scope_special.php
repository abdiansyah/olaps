<option class="scope_special" value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_scope_special as $row): ?>  
<option class="scope_special" name="scope_special[]" id="scope_special_<?php echo $row->id; ?>"  value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?> 
<script type="text/javascript">                
$('#tab-scope-special').change(function(){            
    var scope_special = $(this).val();
    var category_special = $('#tab-category-special').val();   
    var spec_special = $('#tab-spec-special').val();              
    var check_special = $('[name=check_special]:checked').val();           
        $.get("<?php echo base_url();?>index.php/apply_license/get_scope_special/" +  scope_special + "/" + category_special + "/" + spec_special + "/" + check_special + "/" + '2', function(data, status){                 
          $("#scope-assesment-special").html(data);    
        });
    });      
</script>  
    

    