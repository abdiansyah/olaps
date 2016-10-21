<?php echo jquery_select2(); ?>

<script type="text/javascript">
$().ready(function(){
	$('[name=request_number],[name=assesment_scope]').select2({width : '75%'});
});
</script>

<section class="content-header">
	<h1>Management Assesment <small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ttl; ?></small></h1>
</section>

<?php 
echo form_open_multipart($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
	<?php if($this->uri->segment(3) == 'add'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Request Number</label>
		<div class="col-sm-4">
			<select name="request_number" required>
				<option value="0">--- choose request number ---</option>
				<?php echo modules::run('assesment/assesment/option_request_number_fk'); ?>
			</select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name personnel</label>
		<div class="col-sm-3">
            <input class="form-control input-sm" type="text" name="name_personnel"/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Assesment scope</label>
		<div class="col-sm-4">
			<select name="assesment_scope" required>
				<option value="0">--- choose assesment scope ---</option>
				<?php echo modules::run('assesment/assesment/option_assesment_scope'); ?>
			</select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Value</label>
        <div class="col-sm-3">
            <input class="form-control input-sm" type="text" name="value_assesment"/>
        </div>
    </div>
	<?php endif; ?>    
	<?php if($this->uri->segment(3) == 'edit'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Request Number</label>
		<div class="col-sm-3">
            <input class="form-control input-sm" type="text" name="request_number" value="<?php echo @$data_assesment->request_number_fk; ?>" disabled/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name personnel</label>
		<div class="col-sm-3">
            <input class="form-control input-sm" type="text" name="name_personnel" value="<?php echo @$data_assesment->personnel_number_fk; ?>" disabled/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Assesment Scope</label>
        <div class="col-sm-3">
            <input class="form-control input-sm" type="text" name="assesment_scope" value="<?php echo @$data_assesment->id_assesment_scope_fk; ?>" disabled/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Value</label>
        <div class="col-sm-3">
            <input class="form-control input-sm" type="text" name="value_assesment" value="<?php echo @$data_assesment->value; ?>"/>
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