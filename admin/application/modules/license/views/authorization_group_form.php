<?php echo jquery_select2();?>
<script type="text/javascript">
$().ready(function(){
$('[name=id_license],[name=id_type],[name=id_spect],[name=id_category]').select2({width : '60%'});
});    
</script>

<section class="content-header">
	<h1><?php echo $ttl;?></h1>    
</section>

<?php echo form_open($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
	<?php if($ttl == 'Add License Type'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Authorization</label>
		<div class="col-sm-4">
		  <select name="id_license">
		  	<option value="">---</option>
			<?php 
			echo modules::run('license/authorization_group/option_authorization'); 
			?>   		  	
		  </select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_type">
		  	<option value="">---</option>
			<?php 
			echo modules::run('license/authorization_group/option_type'); 
			?>   		  	
		  </select>
		</div>
	</div>
	<?php 
	endif; 
	if($ttl == 'Add Type Spect'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_type">
		  	<option value="">---</option>
			<?php 
			echo modules::run('license/authorization_group/option_type'); 
			?>   		  	
		  </select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Spect&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_spect">
		  	<option value="">---</option>
			<?php 
			echo modules::run('license/authorization_group/option_spect'); 
			?>   		  	
		  </select>
		</div>
	</div>
	<?php 
	endif;	
	if($ttl == 'Add Spect Category'):?>	
	<div class="form-group">
        <label class="col-sm-2 control-label input-sm">Authorization</label>
		<div class="col-sm-4">
		  <select name="id_license">
		  	<option value="">---</option>
			<?php 
			echo modules::run('license/authorization_group/option_authorization'); 
			?>   		  	
		  </select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_type">
		  	<option value="">---</option>
			<?php 
			echo modules::run('license/authorization_group/option_type'); 
			?>   		  	
		  </select>
		</div>
	</div>	
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Spect&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_spect">
		  	<option value="">---</option>
			<?php 
			echo modules::run('license/authorization_group/option_spect'); 
			?>   		  	
		  </select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_category">
		  	<option value="">---</option>
			<?php 
			echo modules::run('license/authorization_group/option_category'); 
			?>   		  	
		  </select>
		</div>
	</div>
	<?php endif;
	if($ttl == 'Edit License Type'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">License&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_license">
		  	<option value="<?php echo $rc_license_type->id_license; ?>"><?php echo $rc_license_type->name_license; ?></option>
			<?php 
			echo modules::run('license/authorization_group/option_authorization'); 
			?>   		  	
		  </select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_type">
		  	<option value="<?php echo $rc_license_type->id_type; ?>"><?php echo $rc_license_type->name_type; ?></option>
			<?php 
			echo modules::run('license/authorization_group/option_type'); 
			?>   		  	
		  </select>
		</div>
	</div>
	<?php 
	endif;
	if($ttl == 'Edit Type Spect'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_type">
		  	<option value="<?php echo $rc_type_spect->id_type; ?>"><?php echo $rc_type_spect->name_type; ?></option>
			<?php 
			echo modules::run('license/authorization_group/option_type'); 
			?>   		  	
		  </select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Spect&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_spect">
		  	<option value="<?php echo $rc_type_spect->id_spect; ?>"><?php echo $rc_type_spect->name_spect; ?></option>
			<?php 
			echo modules::run('license/authorization_group/option_spect'); 
			?>   		  	
		  </select>
		</div>
	</div>
	<?php 
	endif;	
	if($ttl == 'Edit Spect Category'):?>	
	<div class="form-group">
        <label class="col-sm-2 control-label input-sm">Authorization</label>
		<div class="col-sm-4">
		  <select name="id_license">
		  	<option value="<?php echo $rc_spect_category->id_license; ?>"><?php echo $rc_spect_category->name_license; ?></option>
			<?php 
			echo modules::run('license/authorization_group/option_authorization'); 
			?>   		  	
		  </select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_type">
		  	<option value="<?php echo $rc_spect_category->id_type; ?>"><?php echo $rc_spect_category->name_type; ?></option>
			<?php 
			echo modules::run('license/authorization_group/option_type'); 
			?>   		  	
		  </select>
		</div>
	</div>	
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Spect&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_spect">
		  	<option value="<?php echo $rc_spect_category->id_spect; ?>"><?php echo $rc_spect_category->name_spect; ?></option>
			<?php 
			echo modules::run('license/authorization_group/option_spect'); 
			?>   		  	
		  </select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
		  <select name="id_category">
		  	<option value="<?php echo $rc_spect_category->id_category; ?>"><?php echo $rc_spect_category->name_category; ?></option>
			<?php 
			echo modules::run('license/authorization_group/option_category'); 
			?>   		  	
		  </select>
		</div>
	</div>
	<?php
	endif;
	?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="submit_blocked_date"><span class="fa fa-save"></span> &nbsp;Save </button>			
			<a class="btn btn-flat bg-olive color-palette btn-sm" name="back"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>
<script type="text/javascript">
$('[name=back]').on('click',function(){
    window.history.go(-1);
});
</script>

