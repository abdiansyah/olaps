<style>
.datepicker{z-index:1151;}
</style>
<?php echo jquery_select2(); ?>
<script type="text/javascript">    
	$('.select2-tab-search-high').select2({width : '100%'});

    $('.datepicker').datepicker({
        format:'dd-mm-yyyy',        
    });

</script>
<?php if($p_search_high =='status_approved_superior') :?>
<select name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control">
    <option value="1">Approved</option>
    <option value="2">Disapproved</option>
</select>
<?php endif;
if($p_search_high =='status_approved_quality') :?>
<select name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control">
    <option value="1">Data Valid</option>
    <option value="2">Data Not Valid</option>
</select>
<?php endif;
if(($p_search_high =='request_number')||($p_search_high =='personnel_number')||($p_search_high =='personnel_number_superior')||($p_search_high =='personnel_number_quality ')|| ($p_search_high == 'id_disposition_user_fk') || ($p_search_high=='id_location_user_fk')) : ?>
<input name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control" type="text"/>
<?php endif; 
if(($p_search_high =='datetime_priority')||($p_search_high =='date_request')||($p_search_high =='date_approved_superior')||($p_search_high =='date_approved_quality')||($p_search_high =='date_take_authorization')||($p_search_high =='date_finish')):?>
<input name="input-tab-search-high" id="input-tab-search-high" class="datepicker col-md-12 form-control" type="text" placeholder="sample : 21-01-2016"/>
<?php endif; 
if($p_search_high =='code_unit') : ?>
<select name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control select2-tab-search-high">    
    <option value="0">--- Choose Unit ---</option>
    <?php echo modules::run('quality_control/quality_control/option_unit_gmf'); ?>                
</select>
<?php endif; 
if($p_search_high =='priority') : ?>
<select name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control"> 
    <option value="Normal">Normal</option>
    <option value="High">High</option>   
</select>
<?php endif; 
if($p_search_high =='status_assesment') : ?>
<select name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control">     
    <option value="">Assesment Finish</option>    
</select>
<?php endif; 
if(($p_search_high =='status_submit') || ($p_search_high =='status_issue_authorization')||($p_search_high =='take_authorization')||($p_search_high =='referral_authorization')) : ?>
<select name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control"> 
    <option value="1">Yes</option>
    <option value="2">No</option>    
</select>
<?php endif; 
if ($p_search_high =='reason_apply_license') : ?>
<select name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control"> 
    <option value="1">New Authorization</option>
    <option value="2">Renewal</option>
    <option value="3">Additional</option>
    <option value="4">Ratting Change</option>    
</select>
<?php endif;?>



         