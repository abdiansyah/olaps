<?php echo jquery_select2(); ?>
<?php echo editor_tinymce(); ?>

<script type="text/javascript">
$().ready(function(){
	$('[name=id_user_fk]').select2({width : '75%'});
});
</script>

<section class="content-header">
	<h1>Slider <small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ttl; ?></small></h1>
</section>

<?php echo form_open_multipart($action, array('class' => 'form-horizontal row-form')); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Title</label>
		<div class="col-sm-4">
				<input class="form-control input-sm" type="text" name="title" maxlength="200" placeholder="Title"  value="<?php echo $rc->title; ?>" />				
		</div>
	</div>	
	<?php if($ttl == 'Add') : ?>	
	<div class="form-group">
        <label class="col-sm-2 control-label input-sm">Images</label>
		<div class="col-sm-3">
			<input type="file" name="image" rows="3" />
		</div>
	</div>

	<?php 
	endif; 
	if($ttl == 'Edit') : ?>	
	<div class="form-group">
        <label class="col-sm-2 control-label input-sm">Status</label>
		<div class="col-sm-4">
				<select class="form-control" name="status">
 					<option value="1">
						Enabled
					</option>
					<option value="0">
						Disabled
					</option>
				</select>			
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Changed Date / Time</label>
		<div class="row">
			<div class="col-sm-2">
				<input type="text" name="change_date" class="form-control input-sm" placeholder="Change Date" value="<?php echo date('d-m-Y',strtotime($rc->create_datetime)); ?>" disabled />
			</div>

			<div class="col-sm-2" style="margin-left:-25px;">
				<input type="text" name="change_time" class="form-control input-sm" placeholder="Change Time" value="<?php echo date('H:i:s',strtotime($rc->create_datetime)); ?>" disabled />
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">User</label>
		<div class="col-sm-4">
			<input type="text" name="user" class="form-control input-sm" placeholder="User" value="<?php echo $rc->name; ?>" disabled />
		</div>
	</div>
	<?php endif; ?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm"><span class="fa fa-save"></span> &nbsp;Save </button>	
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo site_url('configure_cms/slider/index'); ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>