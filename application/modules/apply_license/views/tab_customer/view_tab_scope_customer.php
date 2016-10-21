<option class="scope_customer" value="">--- Silahkan Pilih ---</option> 
<?php foreach($auth_scope_customer as $row): ?>  
<option  value="<?php echo $row->id; ?>"><?php echo $row->name_t;?></option>                                                        
<?php endforeach; ?>  
<script type="text/javascript">                
        $('select#tab-scope-garuda').change(function() {   
        var scope_customer_garuda = $(this).val();
        var category_customer_garuda = $('#tab-category-garuda').val();
        var spec_customer_garuda = $('#tab-spec-garuda').val();          
        var type_customer_23 =  $('#type_customer_23').val();                   
        var check_customer = $('[name=check_customer_authorization]').val(); 
        $.get("<?php echo base_url();?>index.php/apply_license/get_scope_customer_garuda/" + scope_customer_garuda + "/" + category_customer_garuda + "/" + spec_customer_garuda + "/" + type_customer_23 + "/" + check_customer, function(data, status){                 
            $("#scope-assesment-garuda").html(data); 
        });
        return true;                                   
        });
        
        $('select#tab-scope-license-garuda').change(function() {
        var scope_customer_license_garuda = $(this).val();
        var category_customer_license_garuda = $('#tab-category-license-garuda :selected').val();
        var spec_customer_license_garuda = $('#tab-spec-license-garuda :selected').val();          
        var type_23 =  $('#type_23').val();                   
        var license_5 = $('#license_5').val(); 
        $.get("<?php echo base_url();?>index.php/apply_license/get_scope_customer_garuda/" + scope_customer_license_garuda + "/" + category_customer_license_garuda + "/" + spec_customer_license_garuda + "/" + type_23 + "/" + license_5, function(data, status){                 
            $("#scope-assesment-license-garuda").html(data); 
        }); 
        return true;                                  
        });
        
        $('select#tab-scope-citilink').change(function() {   
        var scope_customer_citilink = $(this).val();
        var category_customer_citilink = $('#tab-category-citilink').val();
        var spec_customer_citilink = $('#tab-spec-citilink').val();          
        var type_customer_24 =  $('#type_customer_24').val();                   
        var check_customer = $('[name=check_customer_authorization]').val(); 
        $.get("<?php echo base_url();?>index.php/apply_license/get_scope_customer_citilink/" + scope_customer_citilink + "/" + category_customer_citilink + "/" + spec_customer_citilink + "/" + type_customer_24 + "/" + check_customer, function(data, status){                 
            $("#scope-assesment-citilink").html(data); 
        });
        return true;                                   
        });
        
        $('select#tab-scope-license-citilink').change(function() {   
        var scope_customer_license_citilink = $(this).val();        
        var category_customer_license_citilink = $('#tab-category-license-citilink :selected').val();
        var spec_customer_license_citilink = $('#tab-spec-license-citilink :selected').val();          
        var type_24 =  $('#type_24').val();                   
        var license_5 = $('#license_5').val(); 
        $.get("<?php echo base_url();?>index.php/apply_license/get_scope_customer_citilink/" + scope_customer_license_citilink + "/" + category_customer_license_citilink + "/" + spec_customer_license_citilink + "/" + type_24 + "/" + license_5, function(data, status){                 
            $("#scope-assesment-license-citilink").html(data);
        }); 
        return true;                                  
        });
        
        $('select#tab-scope-sriwijaya').change(function() {
        var scope_customer_sriwijaya = $(this).val();
        var category_customer_sriwijaya = $('#tab-category-sriwijaya').val();
        var spec_customer_sriwijaya = $('#tab-spec-sriwijaya').val();          
        var type_customer_25 =  $('#type_customer_25').val();                   
        var check_customer = $('[name=check_customer_authorization]').val(); 
        $.get("<?php echo base_url();?>index.php/apply_license/get_scope_customer_sriwijaya/" + scope_customer_sriwijaya + "/" + category_customer_sriwijaya + "/" + spec_customer_sriwijaya + "/" + type_customer_25 + "/" + check_customer, function(data, status){                 
            $("#scope-assesment-sriwijaya").html(data); 
        });
        return true;                                   
        });
        
        $('select#tab-scope-license-sriwijaya').change(function() {   
        var scope_customer_license_sriwijaya = $(this).val();
        var category_customer_license_sriwijaya = $('#tab-category-license-sriwijaya :selected').val();
        var spec_customer_license_sriwijaya = $('#tab-spec-license-sriwijaya :selected').val();          
        var type_25 =  $('#type_25').val();                   
        var license_5 = $('#license_5').val(); 
        $.get("<?php echo base_url();?>index.php/apply_license/get_scope_customer_sriwijaya/" + scope_customer_license_sriwijaya + "/" + category_customer_license_sriwijaya + "/" + spec_customer_license_sriwijaya + "/" + type_25 + "/" + license_5, function(data, status){                 
            $("#scope-assesment-license-sriwijaya").html(data);
        });
        return true;                                   
        });
                
</script>
    

    