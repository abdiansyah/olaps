<option class="scope_easa" value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_scope_easa as $row): ?>  
<option class="scope_easa" id="scope_easa_<?php echo $row->id; ?>"  value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?> 
<script type="text/javascript">                
$('#tab-scope-easa').click(function(){            
    var scope_easa = $(this).val();
    var category_easa = $('#tab-category-easa').val();   
    var spec_easa = $('#tab-spec-easa').val();          
    var type_easa = $('.type_easa:checked').val();
    var check_easa = $('[name=check_easa]:checked').val();
    if(scope_easa!=''){    
    $.get("<?php echo base_url();?>index.php/apply_license/get_scope_easa/" +  scope_easa + "/" + category_easa + "/" + spec_easa + "/" + type_easa + "/" + check_easa, function(data, status){                 
      $("#scope-assesment-easa").html(data);    
    });
    }
    });         
</script>   
    

    