<section class="content-header">
	<h1>Blocked Date</h1>    
</section>

<?php echo form_open($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
	<?php if($ttl == 'Add'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Code assesment scope</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text"  value="<?php echo kode_tbl_assesment_scope(); ?>" disabled/>
		  <input class="form-control input-sm" type="hidden" name="code_assesment_scope" value="<?php echo kode_tbl_assesment_scope(); ?>"/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name assesment scope</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="name_assesment_scope"  required />
		</div>
	</div>
	<?php
	endif;
	if($ttl == 'Edit'):?>
	    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Code assesment scope</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text"  value="<?php echo $rc->code_t; ?>" disabled/>		  
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name assesment scope</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="name_assesment_scope"  value="<?php echo $rc->name_t; ?>" required />
		</div>
	</div>
	<?php
	endif;
	?>	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="submit_blocked_date"><span class="fa fa-save"></span> &nbsp;Save </button>			
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>

<?php
    echo bootstrap_datepicker();
?>     
<script type="text/javascript">
$('[name=date_from],[name=date_until]').datepicker({
    format:'dd-mm-yyyy'
});
</script>
