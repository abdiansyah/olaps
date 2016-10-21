<option value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_category_easa as $row): ?>  
<option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>  
<script type="text/javascript">                
$('#tab-category-easa').change(function(){            
    var category_easa = $(this).val();
    var spec_easa = $('#tab-spec-easa').val();          
    var type_easa = $('.type_easa:checked').val();
    var check_easa = $('[name=check_easa]:checked').val();
    $.get("<?php echo base_url();?>index.php/apply_license/get_category_easa/" + category_easa + "/" + spec_easa + "/" + type_easa + "/" + check_easa, function(data, status){                 
      $("select[id=tab-scope-easa]").html(data);
    });
});      
</script>

    