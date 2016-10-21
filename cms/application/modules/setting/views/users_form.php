<?php echo jquery_select2(); ?>

<script type="text/javascript">
$().ready(function(){
	$('[name=id_users_group_fk]').select2({width : '75%'});
});
</script>

<section class="content-header">
	<h1>Management User <small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ttl; ?></small></h1>
</section>

<?php echo form_open_multipart($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="name_users" id="inputName" placeholder="Name" value="<?php echo @$users->name; ?>" required />
		</div>
	</div>	
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Group</label>
		<div class="col-sm-4">
		  <select>
          <option>Superadmin</option>
          <option>Quality</option>
          <option>Superior</option>
          </select>
		</div>
	</div>		 
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm"><span class="fa fa-save"></span> &nbsp;Save </button>
			<button type="reset" class="btn btn-flat btn-danger color-palette btn-sm"><span class="fa fa-circle-o-notch"></span> &nbsp;Reset </button>
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>