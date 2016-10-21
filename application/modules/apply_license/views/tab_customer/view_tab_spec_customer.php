<option value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_spec_customer as $row): ?>  
<option value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>  
<script type="text/javascript">                          
        $('select#tab-spec-garuda').change(function() {             
        var spec_customer_garuda = $('#tab-spec-garuda :selected').val();
        var check_customer = $('[name=check_customer_authorization]').val();            
        var type_customer_23 =  $('#type_customer_23').val();                   
            $.get("<?php echo base_url();?>index.php/apply_license/get_spec_customer/" + spec_customer_garuda + "/" + check_customer + "/" + type_customer_23, function(data, status){                 
              $("select[id=tab-category-garuda]").html(data);
            }); 
        return true;
        });
        
        $('select#tab-spec-license-garuda').change(function() {             
        var spec_customer_license_garuda = $('select#tab-spec-license-garuda :selected').val();        
        var license_5 = $('#license_5').val();            
        var type_23 =  $('#type_23').val();         
            $.get("<?php echo base_url();?>index.php/apply_license/get_spec_customer/" + spec_customer_license_garuda + "/" + license_5 + "/" + type_23, function(data, status){                 
              $("select[id=tab-category-license-garuda]").html(data);
            }); 
        return true;
        });
        
        $('select#tab-spec-citilink').change(function() {         
        var spec_customer_citilink = $('#tab-spec-citilink :selected').val();                  
        var check_customer = $('[name=check_customer_authorization]').val();            
        var type_customer_24 =  $('#type_customer_24').val();                   
            $.get("<?php echo base_url();?>index.php/apply_license/get_spec_customer/" + spec_customer_citilink + "/" + check_customer + "/" + type_customer_24, function(data, status){                 
              $("select[id=tab-category-citilink]").html(data);
            });
        return true;            
        });
        
        $('select#tab-spec-license-citilink').change(function() {             
        var spec_customer_license_citilink = $('select#tab-spec-license-citilink :selected').val();
        var license_5 = $('#license_5').val();            
        var type_24 =  $('#type_24').val();                   
            $.get("<?php echo base_url();?>index.php/apply_license/get_spec_customer/" + spec_customer_license_citilink + "/" + license_5 + "/" + type_24, function(data, status){                 
              $("select[id=tab-category-license-citilink]").html(data);
            }); 
        return true;
        });
        
        $('select#tab-spec-sriwijaya').change(function() {                  
        var spec_customer_sriwijaya = $('#tab-spec-sriwijaya :selected').val();                    
        var check_customer = $('[name=check_customer_authorization]').val();            
        var type_customer_25 =  $('#type_customer_25').val();                   
            $.get("<?php echo base_url();?>index.php/apply_license/get_spec_customer/" + spec_customer_sriwijaya + "/" + check_customer + "/" + type_customer_25, function(data, status){                 
              $("select[id=tab-category-sriwijaya]").html(data);
            }); 
        return true;            
        });
        
        $('select#tab-spec-license-sriwijaya').change(function() {             
        var spec_customer_license_sriwijaya = $('select#tab-spec-license-sriwijaya :selected').val();
        var license_5 = $('#license_5').val();            
        var type_25 =  $('#type_25').val();                   
            $.get("<?php echo base_url();?>index.php/apply_license/get_spec_customer/" + spec_customer_license_sriwijaya + "/" + license_5 + "/" + type_25, function(data, status){                 
              $("select[id=tab-category-license-sriwijaya]").html(data);
            }); 
        return true;
        });
                
</script>
