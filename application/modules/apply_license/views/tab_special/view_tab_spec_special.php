<option value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_spec_special as $row): ?>  
<option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>  
     <script type="text/javascript">                
        $('#tab-spec-special').change(function(){            
            var spec_special = $(this).val();                                 
            var type_special = $('[name=check_special]:checked').val();
            $.get("<?php echo base_url();?>index.php/apply_license/get_spec_special/" + spec_special + "/" + type_special, function(data, status){                 
              $("select[id=tab-category-special]").html(data);
            });        
        });      
     </script>
    