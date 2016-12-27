<?php echo jquery_select2(); ?>
<script type="text/javascript">    
	$('.select2-tab-search-written').select2({width : '100%'});
</script>
<!--Written Assesment-->
<?php if($p_search =='status_assesment_written') :?>
<select name="input-tab-search-written" id="input-tab-search-written" class="col-md-12 form-control">
    <option value="1">Assesment Open</option>
    <option value="2">Assesment Closed</option>
</select>
<?php endif;
if($p_search =='result_written') :?>
<select name="input-tab-search-written" id="input-tab-search-written" class="col-md-12 form-control">
    <option value="Lulus">Lulus</option>
    <option value="Tidak Lulus">Tidak Lulus</option>
</select>
<?php endif;
if(($p_search =='personnel_number_written')||($p_search =='request_number_written')||($p_search =='score_written')) : ?>
<input name="input-tab-search-written" id="input-tab-search-written" class="col-md-12 form-control" type="text"/>
<?php endif; 
if(($p_search =='date_assesment_written')):?>
<input name="input-tab-search-written" id="input-tab-search-written" class="col-md-12 form-control" type="text" placeholder="dd-mm-yyyy"/>
<?php endif; 
if(($p_search =='id_written_sesi')):?>
<select name="input-tab-search-written" id="input-tab-search-written" class="col-md-12 form-control">
    <option value="1">09:00 - 11:00</option>
    <option value="2">13:00 - 15:00</option>
</select>
<?php endif; 
if(($p_search =='id_written_room')):?>
<select name="input-tab-search-written" id="input-tab-search-written" class="col-md-12 form-control">
    <option value="1">Sikidang</option>
    <option value="2">Candradimuka</option>
</select>
<!--Oral Assesment-->
<?php endif; 
if($p_search =='status_assesment_oral') :?>
<select name="input-tab-search-oral" id="input-tab-search-oral" class="col-md-12 form-control">
    <option value="1">Assesment Open</option>
    <option value="2">Assesment Closed</option>
</select>
<?php endif;
if($p_search =='result_oral') :?>
<select name="input-tab-search-oral" id="input-tab-search-oral" class="col-md-12 form-control">
    <option value="Lulus">Lulus</option>
    <option value="Tidak Lulus">Tidak Lulus</option>
</select>
<?php endif;
if(($p_search =='personnel_number_oral')||($p_search =='request_number_oral')||($p_search =='score_oral')) : ?>
<input name="input-tab-search-oral" id="input-tab-search-oral" class="col-md-12 form-control" type="text"/>
<?php endif; 
if(($p_search =='date_assesment_oral')):?>
<input name="input-tab-search-oral" id="input-tab-search-oral" class="col-md-12 form-control" type="text" placeholder="dd-mm-yyyy"/>
<?php endif; 
if(($p_search =='id_oral_sesi')):?>
<select name="input-tab-search-oral" id="input-tab-search-oral" class="col-md-12 form-control">
    <option value="1">09:00 - 11:00</option>
    <option value="2">13:00 - 15:00</option>
</select>
<?php endif; 
if(($p_search =='id_oral_room')):?>
<select name="input-tab-search-oral" id="input-tab-search-oral" class="col-md-12 form-control">
    <option value="1">Sikidang</option>
    <option value="2">Candradimuka</option>
</select>
<?php endif;?>


         