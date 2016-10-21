<?php echo jquery_select2(); ?>
<?php echo editor_tinymce(); ?>

<script type="text/javascript">
$().ready(function(){
	$('[name=id_category_inf_fk]').select2({width : '75%'});
});
</script>

<section class="content-header">
	<h1>Category Information <small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ttl; ?></small></h1>
</section>

<?php echo form_open($action, array('class' => 'form-horizontal row-form')); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Category</label>
		<div class="col-sm-4">
			<select name="id_category_inf_fk" required>
				<option value="0">--- Choose Category ---</option>
				<?php echo modules::run('configure_cms/category_information/options_category_information'); ?>
			</select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Author</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="author" maxlength = "50" placeholder="Author" value="<?php echo $rc->author; ?>" required />
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Title</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="title" maxlength = "50" placeholder="Title" value="<?php echo $rc->title; ?>" required />
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Description</label>
		<div class="col-sm-3">
			<textarea name="description" class="form-control" id ="purbadian_editor" rows="3" placeholder="Description"><?php echo $rc->description; ?></textarea>
		</div>
	</div>
	<?php if($ttl == 'Edit') : ?>
	<div class="title-form-block"><span class="text-title-box">Log</span></div>
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Changed Date / Time</label>
		<div class="row">
			<div class="col-sm-2">
				<input type="text" name="change_date" class="form-control input-sm" placeholder="Change Date" value="<?php echo $rc->change_date; ?>" disabled />
			</div>
			<div class="col-sm-2" style="margin-left:-25px;">
				<input type="text" name="change_time" class="form-control input-sm" placeholder="Change Time" value="<?php echo $rc->change_time; ?>" disabled />
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">User</label>
		<div class="col-sm-4">
			<input type="text" name="user" class="form-control input-sm" placeholder="User" value="<?php echo $rc->name_users; ?>" disabled />
		</div>
	</div>
	<?php endif; ?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm"><span class="fa fa-save"></span> &nbsp;Save </button>
			<button type="reset" class="btn btn-flat btn-danger color-palette btn-sm"><span class="fa fa-circle-o-notch"></span> &nbsp;Reset </button>
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>