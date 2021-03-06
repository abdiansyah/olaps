<section class="content-header">
	<h1>Blocked Date</h1>    
</section>

<?php echo form_open($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Date from</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="date_from" id="inputName" placeholder="Date from" value="<?php if($this->uri->segment(3) == 'edit'){echo date('d-m-Y',strtotime(@$rc->date_from));} ?>" required />
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Date until</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="date_until" id="inputName" placeholder="Date until" value="<?php if($this->uri->segment(3) == 'edit'){echo date('d-m-Y',strtotime(@$rc->date_until));} ?>" required />
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Reason</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="reason"  placeholder="Reason" value="<?php echo @$rc->reason; ?>" required />
		</div>
	</div>	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="submit_blocked_date"><span class="fa fa-save"></span> &nbsp;Save </button>			
			<a class="btn btn-flat bg-olive color-palette btn-sm" name="back"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>

<?php
    echo bootstrap_datepicker();
?>     
<script type="text/javascript">
$('[name=back]').on('click',function(){
    window.history.go(-1);
});
$('[name=date_from],[name=date_until]').datepicker({
    format:'dd-mm-yyyy'
});
</script>
