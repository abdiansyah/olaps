    <option value="">--- Silahkan Pilih ---</option> 
    <?php foreach($auth_spec as $row): ?>  
    <option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
    <?php endforeach; ?>                     
<script type="text/javascript">                              
    $('#tab-spec').on('change',function(){            
    var spec = $(this).val();                     
    var license = $('.license:checked').val();
    var type = $('.type:checked').val();
        $.get("<?php echo base_url();?>index.php/apply_license/get_spec/" + spec + "/" + license + "/" + type, function(data, status){                 
          $("#tab-category").html(data);
        });

        $.get("<?php echo base_url();?>index.php/apply_license/cek_etops/" + spec , function(data, status){                 
           if(data=='1'){
              $('#etops').show();
           }else{
              $('#etops').hide();
           }
        });
    });                          
</script>