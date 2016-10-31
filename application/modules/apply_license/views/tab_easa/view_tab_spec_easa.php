<option value="">--- Silahkan Pilih ---</option> 
    <?php foreach($auth_spec_easa as $row): ?>  
    <option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
    <?php endforeach; ?>  
<script type="text/javascript">                
$('#tab-spec-easa').change(function(){            
    var spec_easa = $(this).val();                     
    var check_easa = $('[name=check_easa]:checked').val();
    var type_easa = $('.type_easa:checked').val();
    $.get("<?php echo base_url();?>index.php/apply_license/get_spec_easa/" + spec_easa + "/" + check_easa + "/" + type_easa, function(data, status){                 
      $("select[id=tab-category-easa]").html(data);
    }); 
    $.get("<?php echo base_url();?>index.php/apply_license/cek_etops/" + spec_easa , function(data, status){                 
               if(data=='1') {
                  $('#etops_easa').show();
               } else {
                  $('#etops_easa').hide();
               };
    });             
});      
</script>
    