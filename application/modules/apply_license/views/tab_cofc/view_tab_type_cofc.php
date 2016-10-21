<?php foreach($auth_type_cofc as $row): ?>
        <div class="col-md-4">
			<label class="radio-inline">                
			<input name="type_cofc" class="type_cofc" id="type_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" type="radio"> <?php echo $row->name_t; ?></label>
		</div>
<?php endforeach; ?>
<script type="text/javascript">
     $('[name=type_cofc]').click(function(){  
         $('[name=tab-add-cofc-authorization]').show('slow');
         $('.category_cofc').empty();
         $('.scope_cofc').empty();   
         var type_cofc = $(this).val();            
         $.get("<?php echo base_url();?>index.php/apply_license/get_type_cofc/" + type_cofc , function(data, status){                 
           $("select[id=tab-spec-cofc]").html(data);          
         });
         $('tr.text-cofc-authorization#field-data-cofc').remove();
     });                 
</script>  