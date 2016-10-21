<option value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_category_special as $row): ?>  
<option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>  
     <script type="text/javascript">                
        $('#tab-category-special').change(function(){            
            var category_special = $(this).val();
            var spec_special = $('#tab-spec-special').val();          
            var check_special = $('[name=check_special]:checked').val();            
            $.get("<?php echo base_url();?>index.php/apply_license/get_category_special/" + category_special + "/" + spec_special + "/" + check_special, function(data, status){                 
              $("select[id=tab-scope-special]").html(data);
            });
        });      
     </script>

    