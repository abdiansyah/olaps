<option class="scope" value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_scope_cofc as $row): ?>  
<option class="scope" name="scope" id="scope_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>
<script type="text/javascript">                
$('#tab-scope-cofc').click(function(){            
    var scope = $(this).val();
    var category = $('#tab-category-cofc').val();
    var spec = $('#tab-spec-cofc').val();          
    var type = $('.type_cofc:checked').val();
    var license = $('[name=check_c_of_c]:checked').val();
    if(scope!=''){  
    $.get("<?php echo base_url();?>index.php/apply_license/get_scope_cofc/" +  scope + "/" + category + "/" + spec + "/" + type + "/" + license, function(data, status){                 
      $("#scope-assesment-cofc").html(data);    
    });
    }
    });         
</script>  
    

    