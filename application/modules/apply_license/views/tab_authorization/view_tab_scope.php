<option class="scope" value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_scope as $row): ?>  
<option class="scope" name="scope" id="scope_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>
<script type="text/javascript">                
$('#tab-scope').click(function(){            
    var scope = $(this).val();
    var category = $('#tab-category').val();
    var spec = $('#tab-spec').val();          
    var type = $('.type:checked').val();
    var license = $('.license:checked').val();
    if(scope!=''){  
    $.get("<?php echo base_url();?>index.php/apply_license/get_scope/" +  scope + "/" + category + "/" + spec + "/" + type + "/" + license, function(data, status){                 
      $("#scope-assesment").html(data);    
    });
    }
    });         
</script>  
    

    