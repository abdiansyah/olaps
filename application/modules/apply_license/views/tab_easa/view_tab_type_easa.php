    <?php foreach($auth_type_easa as $row): ?>
            <div class="col-md-4">
				<label class="radio-inline">                
				<input name="type_easa" class="type_easa" id="type_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" type="radio"><?php echo $row->name_t; ?></label>
			</div>
    <?php endforeach; ?>
     <script type="text/javascript">
        $('[name=type_easa]').click(function(){  
            $('[name=tab-add-easa-authorization]').show('slow');
            $('.category_easa').empty();
            $('.scope_easa').empty();   
            var type_easa = $(this).val();            
            $.get("<?php echo base_url();?>index.php/apply_license/get_type_easa/" + type_easa , function(data, status){                 
              $("select[id=tab-spec-easa]").html(data);          
            });
            $('tr.text-easa-authorization#field-data-easa').remove();
        });                 
     </script>       
            
                   
