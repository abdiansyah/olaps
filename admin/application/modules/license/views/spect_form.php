<section class="content-header">
	<h1>Spect</h1>    
</section>

<?php echo form_open($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
	<?php if($ttl == 'Add'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name spect/ ratting</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="name_t" id="inputName" placeholder="name" value="" />
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Keterangan</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="desc_t" id="inputName" placeholder="keterangan" value=""  />
		</div>
	</div>
    <?php endif;
    if($ttl == 'Edit'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Name spect/ ratting</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="name_t" id="inputName" placeholder="name" value="<?php echo $rc->name_t;?>" required />
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Keterangan</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="desc_t" id="inputName" placeholder="keterangan" value="<?php echo $rc->desc_t;?>"  />
		</div>
	</div>
	<?php endif;?>
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
