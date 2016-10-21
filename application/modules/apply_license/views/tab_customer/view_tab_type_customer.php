<?php foreach($auth_type_customer as $row): ?>
        <div class="col-md-4">
            <label class="checkbox-inline">                
            <input type="checkbox" name="type_customer[]" class="type_customer" id="type_customer_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" > <?php echo $row->name_t; ?></label>
        </div>
<?php endforeach; ?>
<script type="text/javascript">           
        $('.category_customer').empty();
        $('.scope_customer').empty();           
        $('tr.text-customer-authorization#field-data-customer').remove();        
             
        $('#type_customer_23').change(function() {
        if(this.checked) { 
            var type_customer_23 =  $('#type_customer_23').val();         
            $('[name=tab-add-garuda-authorization],[name=tab-add-customer-authorization]').show('slow');                                                         
            $.get("<?php echo base_url();?>index.php/apply_license/get_type_customer/" + type_customer_23, function(data, status){                 
                  $("select[id=tab-spec-garuda]").html(data);          
            })
        }else{            
            $('[name=tab-add-garuda-authorization]').hide('slow'); 
             $('tr.text-garuda-authorization#field-data-garuda').remove(); 
            if(!$('#type_customer_23,#type_customer_24,#type_customer_25').is(':checked')){   
                        $('[name=tab-add-customer-authorization]').hide('slow');                             
                };            
        }; 
        });
        
        $('#type_customer_24').change(function() {
        if(this.checked) {
            var type_customer_24 =  $('#type_customer_24').val();                  
            $('[name=tab-add-citilink-authorization],[name=tab-add-customer-authorization]').show('slow');
              $.get("<?php echo base_url();?>index.php/apply_license/get_type_customer/" + type_customer_24 , function(data, status){                 
              $("select[id=tab-spec-citilink]").html(data);          
            });                  
        }else{            
            $('[name=tab-add-citilink-authorization]').hide('slow');
            $('tr.text-citilink-authorization#field-data-citilink').remove();             
            if(!$('#type_customer_23,#type_customer_24,#type_customer_25').is(':checked')){   
                        $('[name=tab-add-customer-authorization]').hide('slow');                             
                };             
        }; 
        });
        $('#type_customer_25').change(function() {
        if(this.checked) {
            var type_customer_25 =  $('#type_customer_25').val();             
            $('[name=tab-add-sriwijaya-authorization],[name=tab-add-customer-authorization]').show('slow');  
              $.get("<?php echo base_url();?>index.php/apply_license/get_type_customer/" + type_customer_25 , function(data, status){                 
              $("select[id=tab-spec-sriwijaya]").html(data);          
            });                 
        }else{            
            $('[name=tab-add-sriwijaya-authorization]').hide('slow');
            $('tr.text-sriwijaya-authorization#field-data-sriwijaya').remove(); 
            if(!$('#type_customer_23,#type_customer_24,#type_customer_25').is(':checked')){   
                        $('[name=tab-add-customer-authorization]').hide('slow');                             
                };             
        };
        });  
        
</script>  
    