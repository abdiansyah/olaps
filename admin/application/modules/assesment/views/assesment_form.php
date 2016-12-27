<?php echo jquery_select2(); ?>
<?php echo bootstrap_datepicker(); ?>

<script type="text/javascript">
$().ready(function(){
	$('[name=pic_written],[name=pic_oral],[name=pic_practical]').select2({width : '73%'});
    $('[name=date_re_exam_written]').datepicker({
        autoclose: true,
        format:'dd-mm-yyyy', 
    });
    $('[name=date_re_exam_written]').datepicker().on('changeDate', function(){
        $(this).datepicker('hide');
    });
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
                    <?php if (@$data_assesment->pic_written == '') {?>
                    <option value="0">--- choose personnel number ---</option>
                <?php } else {?>
                    <option value="<?php echo $data_assesment->pic_written; ?>"><?php echo $data_assesment->name_pic_written;?></option>           
                <?php } echo modules::run('assesment/assesment/option_employee_tqd'); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Score &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <input class="form-control" type="text" name="score_written" value="<?php if(@$data_assesment->score_written!=''){echo @$data_assesment->score_written;} ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Result&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="result_written" value="<?php echo @$data_assesment->result_written; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Keterangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <textarea rows="10" cols="53" name="note_written"> <?php if(@$data_assesment->note_written != '') {echo @$data_assesment->note_written;} ?> </textarea>
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
                <?php if (@$data_assesment_oral->pic_oral == '') {?>
                    <option value="0">--- choose personnel number ---</option>
                <?php } else {?>
                    <option value="<?php echo $data_assesment_oral->pic_oral; ?>"><?php echo $data_assesment_oral->name_pic_oral;?></option>
                <?php } echo modules::run('assesment/assesment/option_employee_tqd'); ?>
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
    <div class="form-group">
        <label class="col-sm-2 control-label ">Keterangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <textarea rows="10" cols="53" name="note_oral"> <?php if(@$data_assesment_oral->note_oral != ''){echo @$data_assesment_oral->note_oral;} ?> </textarea>
        </div>
    </div>
	<?php endif; ?>
    <?php if($this->uri->segment(3) == 'edit_practical'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Request Number</label>
        <div class="col-sm-3">
            <input type="hidden" name="request_number" value="<?php echo @$data_assesment_practical->request_number_fk; ?>"/>
            <input class="form-control " type="text" value="<?php echo @$data_assesment_practical->request_number_fk; ?>" disabled/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Name personnel</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="name_personnel" value="<?php echo @$data_assesment_practical->name; ?>" disabled/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Assesment Scope</label>
        <div class="col-sm-3">
            <input type="hidden" name="id_assesment_scope" value="<?php echo @$data_assesment_practical->id_assesment_scope_fk; ?>"/>
            <input class="form-control " type="text" name="assesment_scope" value="<?php echo @$data_assesment_practical->name_t; ?>" disabled/>
        </div>
    </div>
    <div class="form-group">
    <label class="col-sm-2 control-label ">PIC Assesment Practical</label>
        <div class="col-sm-4">
            <select name="pic_practical" required>
                <?php if (@$data_assesment_practical->pic_practical == '') {?>
                    <option value="0">--- choose personnel number ---</option>
                <?php } else {?>
                    <option value="<?php echo $data_assesment_practical->pic_practical; ?>"><?php echo $data_assesment_practical->name_pic_practical;?></option>
                <?php } echo modules::run('assesment/assesment/option_employee_tqd'); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Score Practical Assesment</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="score_practical" value="<?php if(@$data_assesment_practical->score_practical!=''){echo @$data_assesment_practical->score_practical;} ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Result&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="result_practical" value="<?php echo @$data_assesment_practical->result_practical; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Keterangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-3">
            <textarea rows="10" cols="53" name="note_practical"> <?php if(@$data_assesment_practical->note_practical != ''){echo @$data_assesment_practical->note_practical;} ?> </textarea>
        </div>
    </div>
    <?php endif; ?> 	 
    <?php if($this->uri->segment(3) == 're_exam_written'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Request Number</label>
        <div class="col-sm-3">
            <input type="hidden" name="request_number" value="<?php echo @$data_re_exam->request_number_fk; ?>"/>
            <input class="form-control " type="text" value="<?php echo @$data_re_exam->request_number_fk; ?>" disabled/>
        </div>        
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Name personnel</label>
        <div class="col-sm-3">
            <input class="form-control " type="text" name="name_personnel" value="<?php echo @$data_re_exam->name; ?>" disabled/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Assesment Scope</label>
        <div class="col-sm-3">
            <input type="hidden" name="id_assesment_scope" value="<?php echo @$data_re_exam->id_assesment_scope_fk; ?>"/>
            <input class="form-control " type="text" name="assesment_scope" value="<?php echo @$data_re_exam->name_t; ?>" disabled/>
        </div>
    </div>    
    <div class="form-group">
        <label class="col-sm-2 control-label ">Last Score</label>
        <div class="col-sm-3">            
            <input class="form-control " type="text" name="assesment_scope" value="<?php echo @$data_re_exam->score_written; ?>" disabled/>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-2 control-label ">Date Re-Exam</label>
        <div class="col-sm-3">            
            <input class="form-control " type="text" name="date_re_exam_written" required value="<?php if(@$data_re_exam->date_re_exam != ''){echo date('d-m-Y',strtotime(@$data_re_exam->date_re_exam));}else{echo '';} ?>" />
        </div>   
        <div class="col-sm-2">  
            <?php if(@$data_re_exam->date_re_exam != ''){ ?>
            <button type="button" class="btn btn-flat btn-primary color-palette btn-md" name="btn_re_examp_last"><span class="fa fa-pencil"></span> &nbsp;Re Examp Last (Date)</button>            
            <?php } ?>
        </div>     
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Sesi Re-Exam</label>
        <div class="col-sm-3">            
            <select name="id_sesi_re_exam_written" class="form-control" required> 
                <?php if(@$data_re_exam->sesi_re_exam == '') :?>
                    <option value="" data-date-format="hh:ii"><a>00:00</a></option>                       
                <?php endif;
                    if(@$data_re_exam->sesi_re_exam   != '') :
                ?>    
                    <option value="" data-date-format="hh:ii" disabled><a><?php echo @$data_re_exam->sesi_re_exam; ?></a></option>                       
                <?php endif; ?>                                
                <?php echo modules::run('assesment/assesment/get_all_session');?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Room</label>
        <div class="col-sm-3">            
            <select class="form-control" name="id_room_re_exam_written">
            <?php if(@$data_re_exam->room_re_exam == '') :?>
                <option value="">--- Choose room ---</option>
            <?php endif;
                if(@$data_re_exam->room_re_exam   != '') :
            ?>    
                <option value="" disabled><a><?php echo @$data_re_exam->room_re_exam; ?></a></option>                       
            <?php endif; ?>                                        
            <?php echo modules::run('assesment/assesment/get_all_room');?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">PIC Re-Exam</label>
        <div class="col-sm-3">            
            <select class="form-control" name="pic_re_exam_written"> 
                <?php if(@$data_re_exam->name_pic_re_exam == '') :?>
                    <option>--- Choose personnel ---</option>
                <?php endif;
                    if(@$data_re_exam->name_pic_re_exam   != '') :
                ?>    
                    <option value="" disabled><a><?php echo @$data_re_exam->name_pic_re_exam; ?></a></option>                       
                    <option>--- Choose personnel ---</option>
                <?php endif; ?>                                
                <?php echo modules::run('assesment/assesment/option_employee_tqd');?>
            </select>
        </div>
    </div>                                
    <?php if (@$data_re_exam->date_re_exam != ''  && @$data_re_exam->result_re_exam == '' || @$data_re_exam->date_re_exam != '' && @$data_re_exam->result_re_exam != '') :?> 
    <div class="form-group">
        <label class="col-sm-2 control-label ">Score</label>
        <div class="col-sm-3">            
            <input class="form-control " type="text" name="score_re_exam_written" value="<?php echo @$data_re_exam->score_re_exam; ?>"/>
        </div>
        <div class="col-sm-2">  
            <button type="button" class="btn btn-flat btn-primary color-palette btn-md" name="btn_score_re_examp_last"><span class="fa fa-pencil"></span> &nbsp;Re Examp Last (Score)</button>            
        </div>     
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Result</label>
        <div class="col-sm-3">            
            <input class="form-control " type="text" name="result_re_exam_written" value="<?php echo @$data_re_exam->result_re_exam; ?>" />
        </div>
    </div>
    <div class="form-group">        
        <label class="col-sm-2 control-label ">Keterangan</label>
        <div class="col-sm-3">
            <textarea rows="10" cols="53" name="note_re_exam_written" > <?php echo @$data_re_exam->note_re_exam; ?> </textarea>
        </div>
    </div>
    <?php endif; ?>   
    <?php endif; ?>      
    <div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-md" name="save_assesment_form"><span class="fa fa-save"></span> &nbsp;Save </button>			
			<a class="btn btn-flat bg-olive color-palette btn-md" name="back"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $('[name=back]').on('click',function(){
        window.history.go(-1);
    });
    $('[name=btn_re_examp_last]').on('click', function(){
        $('[name=date_re_exam_written]').val('');        
    });

    $('[name=btn_score_re_examp_last]').on('click', function(){        
        $('[name=score_re_exam_written]').val('');
        $('[name=result_re_exam_written]').val('');
        $('[name=note_re_exam_written]').val('');        
    });

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

    $('[name=score_practical]').on('keyup',function(){
        var score = $('[name=score_practical]').val();
        if(score < 75){    
            $('[name=result_practical]').val('Tidak Lulus');
        }else if(score >= 75){
            $('[name=result_practical]').val('Lulus');
        }
    }); 

    $('[name=score_re_exam_written]').on('keyup',function(){
        var score = $('[name=score_re_exam_written]').val();
        if(score < 75){    
            $('[name=result_re_exam_written]').val('Tidak Lulus');
        }else if(score >= 75){
            $('[name=result_re_exam_written]').val('Lulus');
        }
    }); 

    $('[name=id_room_re_exam_written],[name=date_re_exam_written],[name=id_sesi_re_exam_written]').on('change', function(){                        
        var date_re_exam_written = $('[name=date_re_exam_written]').val();
        var id_sesi_re_exam_written = $('[name=id_sesi_re_exam_written]').val();        
        var id_room_re_exam_written = $('[name=id_room_re_exam_written]').val();                                
        if(date_re_exam_written!='' && id_sesi_re_exam_written!='' && id_room_re_exam_written!=''){   
            $.getJSON("<?php echo site_url();?>/assesment/cek_room/" + date_re_exam_written + "/" + id_sesi_re_exam_written + "/" + id_room_re_exam_written , function(data) {                 
                if (data == null){
                    $('[name=save_assesment_form]').attr('disabled',false);
                };                    
                if (data.limit >= data.quota) {
                    $('[name=save_assesment_form]').attr('disabled',true);
                    alert('Room for this session full.');

                };                             
            });    
        }                        
       
    });

</script>