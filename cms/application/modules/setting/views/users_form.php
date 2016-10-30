<?php echo jquery_select2(); ?>

<script type="text/javascript">
$().ready(function(){
	$('[name=group]').select2({width : '75%'});
});
</script>

<section class="content-header">
	<h1>Management User <small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ttl.'-'.$action; ?></small></h1>
</section>

<?php echo form_open_multipart($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
	<?php if($ttl=='Add'):?>
	<div class="form-group">
        <label class="col-sm-2 control-label input-sm">Personnel Number</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="personnel_number" placeholder="personnel number" required />
		</div>
	</div>	    
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Group</label>
		<div class="col-sm-4">
		  <select name="group">          		
                <option value="">--- Choose Group ---</option>                                              
                <?php echo modules::run('setting/users/option_group'); ?>
          </select>
		</div>
	</div>
	<?php 
	endif;
	if($ttl=='Edit'):
	?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Personnel Number</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" id="inputName" placeholder="Name" value="<?php echo @$users->personnel_number; ?>" disabled />
		  <input class="form-control input-sm" type="hidden" name="personnel_number" value="<?php echo @$users->personnel_number; ?>"/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="name_users" id="inputName" placeholder="Name" value="<?php if(@$users->name!=''){echo @$users->name;}; ?>" required />
		</div>
	</div>	
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Group</label>
		<div class="col-sm-4">
		  <select name="group">
				<?php if(@$users->id_group != ''){ ?>                
                <option value="<?php echo $users->id_group;?>"><?php echo $users->name_group;?></option>
                <?php }; echo modules::run('setting/users/option_group'); ?>
          </select>
		</div>
	</div>
	<?php
	endif;
	?>		 
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm"><span class="fa fa-save"></span> &nbsp;Save </button>
			
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>