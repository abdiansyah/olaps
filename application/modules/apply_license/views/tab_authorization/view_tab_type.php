<?php if(@$license == 5):?>
    <?php foreach($auth_type as $row): ?>
            <div class="col-md-4">
				<label class="checkbox-inline">                
				<input type="checkbox" name="type_check_<?php echo $row->id;?>" class="type" id="type_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" > <?php echo $row->name_t; ?></label>
			</div>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach($auth_type as $row): ?>
            <div class="col-md-4">
				<label class="radio-inline">                
				<input type="radio" name="type" class="type" id="type_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>"> <?php echo $row->name_t; ?></label>
			</div>
    <?php endforeach; ?>
<?php endif; ?>                  
     <script type="text/javascript">
        
        $('#type_6').click(function(){
            $('div[name=tab-add-authorization]').show('slow');            
        });
            $('#type_23').change(function(){                               
                $('div[name=tab-authorization]').hide();
                $('div[name=tab-customer-authorization]').show('slow');                                     
                if(this.checked){                
                var type_23 =  $('#type_23').val();                
                    $.get("<?php echo base_url();?>index.php/apply_license/get_type_customer/" + type_23, function(data, status){                 
                    $("select[id=tab-spec-license-garuda]").html(data);          
                    });                                             
                $('[name=tab-authorization-garuda]').show('slow');  
                }else{
                    $('div[name=tab-authorization]').hide();                                
                    $('[name=tab-authorization-garuda]').hide('slow'); 
                    $('tr.text-license-garuda#field-data-license-garuda').remove(); 
                    if(!$('#type_23,#type_24,#type_25').is(':checked')){   
                        $('div[name=tab-customer-authorization]').hide('slow');                             
                    };                                    
                };                                
                });
                
                $('#type_24').change(function(){
                $('div[name=tab-authorization]').hide();
                $('div[name=tab-customer-authorization]').show('slow');                                 
                if(this.checked){
                var type_24 =  $('#type_24').val();                                                 
                    $.get("<?php echo base_url();?>index.php/apply_license/get_type_customer/" + type_24 , function(data, status){                 
                    $("select[id=tab-spec-license-citilink]").html(data);          
                    });                                              
                $('[name=tab-authorization-citilink]').show('slow');  
                }else{
                    $('div[name=tab-authorization]').hide();                                
                    $('[name=tab-authorization-citilink]').hide('slow'); 
                    $('tr.text-license-citilink#field-data-license-citilink').remove(); 
                    if(!$('#type_23,#type_24,#type_25').is(':checked')){   
                        $('div[name=tab-customer-authorization]').hide('slow');                             
                    };
                };
                });
                
                $('#type_25').change(function(){
                $('div[name=tab-authorization]').hide();
                $('div[name=tab-customer-authorization]').show('slow');                                
                if(this.checked){
                var type_25 =  $('#type_25').val();                               
                    $.get("<?php echo base_url();?>index.php/apply_license/get_type_customer/" + type_25 , function(data, status){                 
                    $("select[id=tab-spec-license-sriwijaya]").html(data);          
                    });                                                 
                $('[name=tab-authorization-sriwijaya]').show('slow');  
                }else{
                    $('div[name=tab-authorization]').hide();                                
                    $('[name=tab-authorization-sriwijaya]').hide('slow'); 
                    $('tr.text-license-sriwijaya#field-data-license-sriwijaya').remove(); 
                    if(!$('#type_23,#type_24,#type_25').is(':checked')){   
                        $('div[name=tab-customer-authorization]').hide('slow');                             
                    };
                };
                });                
                
                        
        $('[name=type]').click(function(){            
            var type = $(this).val();
            var type_6 = $(this).val();
            var type_7 = $(this).val();
            var special_auth1 = $(this).val();
            var spec = $('.spec').val(); 
            
            $('[name=tab-add-authorization],[name=tab-authorization]').show('slow');         
            $('.category').empty();
            $('.scope').empty(); 
            $('#tab-type-easa').empty();
            $('tr.text-authorization#field-data-authorization').remove();
            $('div[name=tab-type-easa]').hide('slow');
            $('div[name=tab-add-easa-authorization]').hide('slow');
            $('div[name=tab-add-special-authorization]').hide('slow');  
            $('[name=check_easa]').prop( "checked", false );
            $('[name=check_special]').prop( "checked", false );   
            $('[name=check_customer_authorization]').prop( "checked", false );
            $('[name=check_c_of_c]').prop( "checked", false );           
             
            // $('.hidden-page, #tab_1, #tab_2, #tab_3, #tab_4, [name=tab-add-customer-authorization], [name=tab-type-customer]').hide();             
           if($('#type_6').is(':checked')){               
                $('[name=tab-add-authorization],[name=tab-authorization]').show('slow'); 
                $('[name=col-easa]').show('slow');
                $('[name=col-special]').show('slow');
                $('[name=col-cust-auth]').show('slow');
                $('[name=col-cofc]').show('slow');
                $('.hidden-page').hide('slow');
                // $('.hidden-page').show('slow'); 
                $('[name=tab_page_1]').show('slow');  
                $('[name=tab_page_2]').show('slow');  
                $('[name=tab_page_3]').show('slow');
                $('[name=tab_page_4]').show('slow');  
                // $('#tab_2').hide('fast');  
                // $('#tab_3').hide('fast');  
                // $('#tab_4').hide('fast');  
            }else if($('#type_7').is(':checked')){
                $('[name=tab-add-authorization],[name=tab-authorization]').show('slow');   
                $('[name=col-easa]').hide('slow');
                $('[name=col-special]').hide('slow');
                $('[name=col-cust-auth]').show('slow');
                $('[name=col-cofc]').hide('slow');  
                $('.hidden-page').hide('slow');
                // $('.hidden-page').show('slow'); 
                $('[name=tab_page_1]').hide('slow');  
                $('[name=tab_page_2]').hide('slow');  
                $('[name=tab_page_3]').show('slow');
                $('[name=tab_page_4]').hide('slow');
                // $('#tab_3').hide('fast');                 
            }else if($('#license_2').is(':checked') && $('#type_8,#type_9,#type_10,#type_11').is(':checked')){
                $('[name=tab-add-authorization],[name=tab-authorization]').show('slow'); 
                $('[name=col-easa]').show('slow');                                           
                $('[name=col-special]').hide('slow');
                $('[name=col-cust-auth]').hide('slow');
                $('[name=col-cofc]').show('slow'); 
                $('.hidden-page').hide('slow');
                // $('.hidden-page').show('slow'); 
                $('[name=tab_page_1]').show('slow');  
                $('[name=tab_page_2]').hide('slow');  
                $('[name=tab_page_3]').hide('slow');
                $('[name=tab_page_4]').show('slow');  
                // $('#tab_4').hide('fast');                  
            }else if($('#type_23,#type_24,#type_25').is(':checked')){                
                $('div[name=tab-authorization]').hide();
                $('div[name=tab-add-authorization]').hide();
                $('.hidden-page').hide('slow');  
            }else{                
                $('div[name=tab-add-authorization]').hide();
                $('.hidden-page').hide('slow');                 
            }                                                       
            $.get("<?php echo base_url();?>index.php/apply_license/get_type/" + type , function(data, status){                 
              $("#tab-spec").html(data);              
            });                        
        });                 
     </script>       
            
    

