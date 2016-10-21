<?php echo jquery_select2();?>
<script type="text/javascript">
$().ready(function(){
$('[name=id_license],[name=id_type],[name=id_spect]').select2({width : '60%'});
});    
</script>

<section class="content-header">
	<h1><?php echo $ttl.'-'.$action;?></h1>    
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
	<?php endif;?>   	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="submit_blocked_date"><span class="fa fa-save"></span> &nbsp;Save </button>			
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>
