<section class="content-header">
	<h1>Room</h1>    
</section>

<?php echo form_open($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
	<?php if($ttl == 'Add'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" placeholder="" ="Name room" name="name_room" value="" required />
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Quota</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" placeholder="" ="Quota" name="quota" value=""  />
		</div>
	</div>
	<?php 
	endif; 
	if($ttl == 'Edit'):?> 
	<div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="name_room" placeholder="Name room" value="<?php echo $rc->name_room?>" required />
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Quota</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="quota"  placeholder="Quota" value="<?php echo $rc->quota?>"  />
		</div>
	</div>
	<?php endif;?>   	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="submit_room"><span class="fa fa-save"></span> &nbsp;Save </button>			
			<a class="btn btn-flat bg-olive color-palette btn-sm" name="back"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>
<script type="text/javascript">
$('[name=back]').on('click',function(){
    window.history.go(-1);
});
</script>
