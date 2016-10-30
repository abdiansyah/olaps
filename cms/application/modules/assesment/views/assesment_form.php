<?php echo jquery_select2(); ?>

<script type="text/javascript">
$().ready(function(){
	$('[name=pic_written],[name=pic_oral]').select2({width : '73%'});
});
</script>

<section class="content-header">
	<h1>Management Assesment <small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ttl; ?></small></h1>
</section>

<?php 
echo form_open_multipart($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); 
?>	
	<?php if($this->uri->segment(3) == 'edit'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Request Number</label>
		<div class="col-sm-3">
            <input type="hidden" name="request_number" value="<?php echo @$data_assesment->request_number_fk; ?>"/>
            <input class="form-control " type="text" value="<?php echo @$data_assesment->request_number_fk; ?>" disabled/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Name personnel</label>
		<div class="col-sm-3">
            <input class="form-control " type="text" name="name_personnel" value="<?php echo @$data_assesment->name; ?>" disabled/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Assesment Scope</label>
        <div class="col-sm-3">
            <input type="hidden" name="id_assesment_scope" value="<?php echo @$data_assesment->id_assesment_scope_fk; ?>"/>
            <input class="form-control " type="text" name="assesment_scope" value="<?php echo @$data_assesment->name_t; ?>" disabled/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">PIC Assesment Written</label>
        <div class="col-sm-4">
            <select name="pic_written" required>
                <option value="0">--- choose personnel number ---</option>
                <?php echo modules::run('assesment/assesment/option_employee_tqd'); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Score &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="score_written" value="<?php if(@$data_assesment->score_written!=''){echo @$data_assesment->score_written;} ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Result&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="result_written" value="<?php echo @$data_assesment->result_written; ?>"/>
        </div>
    </div>
    <?php endif; ?>    
	<?php if($this->uri->segment(3) == 'edit_oral'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Request Number</label>
		<div class="col-sm-3">
            <input type="hidden" name="request_number" value="<?php echo @$data_assesment_oral->request_number_fk; ?>"/>
            <input class="form-control " type="text" value="<?php echo @$data_assesment_oral->request_number_fk; ?>" disabled/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Name personnel</label>
		<div class="col-sm-3">
            <input class="form-control " type="text" name="name_personnel" value="<?php echo @$data_assesment_oral->name; ?>" disabled/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Assesment Scope</label>
        <div class="col-sm-3">
            <input type="hidden" name="id_assesment_scope" value="<?php echo @$data_assesment_oral->id_assesment_scope_fk; ?>"/>
            <input class="form-control " type="text" name="assesment_scope" value="<?php echo @$data_assesment_oral->name_t; ?>" disabled/>
        </div>
    </div>
    <div class="form-group">
    <label class="col-sm-2 control-label ">PIC Assesment Oral</label>
        <div class="col-sm-4">
            <select name="pic_oral" required>
                <option value="0">--- choose personnel number ---</option>
                <?php echo modules::run('assesment/assesment/option_employee_tqd'); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Score Oral Assesment</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="score_oral" value="<?php if(@$data_assesment_oral->score_oral!=''){echo @$data_assesment_oral->score_oral;} ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Result&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="result_oral" value="<?php echo @$data_assesment_oral->result_oral; ?>"/>
        </div>
    </div>
	<?php endif; ?>	 
    <div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm"><span class="fa fa-save"></span> &nbsp;Save </button>			
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">

 $('[name=score_written]').on('keyup',function(){
    var score = $('[name=score_written]').val();
    if(score < 75){    
        $('[name=result_written]').val('Tidak Lulus');
    }else if(score >= 75){
        $('[name=result_written]').val('Lulus');
    }
 });  

 $('[name=score_oral]').on('keyup',function(){
    var score = $('[name=score_oral]').val();
    if(score < 75){    
        $('[name=result_oral]').val('Tidak Lulus');
    }else if(score >= 75){
        $('[name=result_oral]').val('Lulus');
    }
 });   
    
</script>