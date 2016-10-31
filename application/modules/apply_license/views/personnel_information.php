<div class="row">
<div class="col-md-10 col-md-offset-1 col-center-block table-responsive">
<div class="box box-info box-center" id="halaman1">
<div class="progress">
<div id="progress-step" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 5%">                                
    <label>0% Completed</label>
</div>                 
</div>    
	<div class="box-header with-border">
		<h3 class="box-title">PERSONEL INFORMATION</h3>
	</div>
    <div id="msg"> 
    <div class="col-xs-12 col-center-block"><div class="box box-info box-solid"><div class="box-header with-border text-center"><h3 class="box-title"><b>Record not found</b></h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></div></div></div></div>   
    </div>    
        <form method="POST" action="<?php echo site_url('apply_license/index');?>" enctype="multipart/form-data" name="form_personnel_information">	
		<div class="box-body">
            <?php if(validation_errors()!=''){echo '<div class="alert alert-danger"><b>'.validation_errors().'</b></div>';}?>
            <br/>
            <?php 
            $user_data = $this->session->userdata('users'); 
            $sess_personnel_number = $user_data->PERNR;
            $sess_employee_group = $user_data->id_employee_group;                        
            if(@$sess_employee_group == '1'){                                
            ?>         
			<div id="group">
				<div class="col-md-6">
					<label class="radio-inline">
					<input  class="radio" type="radio" name="typeemp" id="gmfemp" value="1" >GMF Employee</label>
				</div>
				<div class="col-md-6">
					<label class="radio-inline">
					<input class="radio" type="radio" name="typeemp" id="nongmfemp" value="2">Non GMF Employee</label>
					<br/>
					<br/>
				</div>                
			</div>
            <?php     
            }                                 
            ?>
             
				<div class="form-horizontal personnel_information_form">
					<div class="form-group">
						<label class="col-sm-2 col-md-offset-2 control-label">Personnel Number :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="personnel_number" type="text" maxlength="50" value="<?php echo stripslashes(strip_tags(htmlspecialchars ($user_data->PERNR,ENT_QUOTES)));?>" />														
						</div>
                        <?php if(@$sess_employee_group == '1'){ ?>
                        <div class="col-sm-2">
                            <button type="button" name="cari_id" class="btn btn-info btn-sm">SEARCH </button>
                        </div>
                        <?php                    
                        } 
                        ?>
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-md-offset-2 control-label">Name :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="name" type="text" />							
						</div>						
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-md-offset-2 control-label">Present Title :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="presenttitle" type="text" />							
						</div>						
					</div>
					<div class="form-group">
						<label class="col-sm-2 col-md-offset-2 control-label">Departement :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="departement" type="text" />
						</div>						
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 col-md-offset-2 control-label">E-Mail Address :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="email" type="text"/>
						</div>
					</div>
					<div class="form-group">
						<label for="dateofbirth" class="col-sm-2 col-md-offset-2 control-label">Date of Birth :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="dateofbirth" type="text"/>
						</div>						
					</div>
					<div class="form-group">
						<label for="dateofemployee" class="col-sm-2 col-md-offset-2 control-label">Date of Employee :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="dateofemployee" type="text"/>
						</div>						
					</div>
					<div class="form-group"> 
						<label for="formaleducation" class="col-sm-2 col-md-offset-2 control-label">Formal Education :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="formaleducation" type="text" />
						</div>						
					</div>
					<div class="form-group">
						<label for="mobilephone" class="col-sm-2 col-md-offset-2 control-label">Mobile Phone :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="mobilephone" type="text" />
						</div>						
					</div>
					<div class="form-group">
						<label for="businessphone" class="col-sm-2 col-md-offset-2 control-label">Business Phone :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="businessphone" type="text" />
						</div>						
					</div>
                    <?php if(@$sess_employee_group == '1'){ ?>                    
                    <div class="form-group" id="fieldnongmfemp">
						<label for="" class="col-sm-2 col-md-offset-2 control-label">Validity Contract :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="validitycontract" type="text" />
						</div>						
					</div>
                    <?php }?>                    
                    <div class="form-group" id="fieldnongmfemp">
						<hr/>
                        <label for="" class="col-sm-4 control-label">Superior Information</label>
					</div>
                    
                    <div class="form-group" id="fieldnongmfemp">
						<label for="" class="col-sm-4 control-label">Personnel Number Superior :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="personnel_number_superior" type="text" />
						</div>
                        <?php if(@$sess_employee_group == '1'){ ?>
                         <div class="col-sm-2">
                            <button type="button" name="cari_id_emp_gmf" class="btn btn-info btn-sm"><b>SEARCH EMP GMF</b></button>
                        </div>
                        <?php } ?>						
					</div>
                    <div class="form-group data-superior" id="fieldnongmfemp">
						<label for="" class="col-sm-2 col-md-offset-2 control-label">Name :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="name_superior" type="text" />
						</div>						
					</div>
                    <div class="form-group data-superior" id="fieldnongmfemp">
						<label for="" class="col-sm-2 col-md-offset-2 control-label">Job Title :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="jobtitle_superior" type="text"/>
						</div>						
					</div>
                    <div class="form-group data-superior" id="fieldnongmfemp">
						<label for="" class="col-sm-2 col-md-offset-2 control-label">Email :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="email_superior" type="text"/>
						</div>						
					</div>										
				</div>
                
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-info btn-sm pull-right" name="submitpersonnelinformation">NEXT</button>
            </div>	
            </form>
</div>  
</div> 
</div> 
        
<?php 
echo bootstrap_datepicker();
?>        
<script type="text/javascript"> 
    $( window ).load(function() {
        $('[name=personnel_number]').click();                 
    });
    $('.personnel_information_form').one('mousemove',function(){
            $('[name=personnel_number_superior]').click();
            $('.data-superior').show();    
        });
    $('#msg,.data-superior').hide();
            
    $('[name=dateofbirth],[name=dateofemployee],[name=validitycontract]').datepicker({
    format : 'dd-mm-yyyy'
    }); 
    
    $('[name=dateofbirth],[name=dateofemployee],[name=validitycontract]').datepicker().on('changeDate', function(e){        
        $(this).datepicker('hide');
    });
    
         
    $('[name=cari_id],[name=personnel_number]').click(function(){
    $('[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone],[name=validitycontract],[name=id_personnel_superior],[name=name_superior],[name=jobtitle_superior],[name=email_superior]').val('');                               
    var typeemp = $('[name=typeemp]:radio:checked').val();
    var personnel_number = $('[name=personnel_number]').val();
    if(typeemp == 1 || typeemp == null){           
    var jqxhr = $.getJSON("<?php echo base_url();?>index.php/apply_license/get_data_personnel_by_gmf/" + personnel_number, function(data) {
        $('[name=name]').val(data.EMPLNAME);                
        $('[name=presenttitle]').val(data.JOBTITLE);
        $('[name=departement]').val(data.UNIT);
        $('[name=email]').val(data.EMAIL);
        $('[name=dateofbirth]').val(data.BORNDATE); 
        $('[name=dateofemployee]').val(data.EMPLODATE);
        $('[name=formaleducation]').val(data.LASTEDUCLEVEL);
        $('[name=mobilephone]').val(data.mobilephone);
        $('[name=businessphone]').val(data.businessphone); 
        if(data.WORKUNTILDATE == '31-12-9999'){       
            var now = new Date(); 
            var work = (data.WORKUNTILDATE).split("-");
            var d = work[0];
            var m = work[1];
            var y = work[2]; 
            var date_work = new Date(y+'-'+m+'-'+d);                       
            if(date_work > now){                
               $('[name=submitpersonnelinformation]').attr('disabled',false);                
            };                                                         
            $('[name=validitycontract]').attr('disabled',true);
            $('[name=submitpersonnelinformation]').attr('disabled',false);
        };
        if(data.WORKUNTILDATE != '31-12-9999'){
            var now = new Date();
            var work = (data.WORKUNTILDATE).split("-");
            var d = work[0];
            var m = work[1];
            var y = work[2]; 
            var date_work = new Date(y+'-'+m+'-'+d);            
            if(date_work > now || date_work == '31-12-9999'){                
               $('[name=submitpersonnelinformation]').attr('disabled',false);                
            };                            
            if(date_work < now !== '31-12-9999'){                
               $('[name=submitpersonnelinformation]').attr('disabled',true);
               alert('You retired'); 
            };    
            $('[name=validitycontract]').attr('disabled',false);
            $('[name=validitycontract]').val(data.WORKUNTILDATE);                
            };
            
            $('[name=personnel_number_superior]').val(data.REPORT_TO);
        }); 
        jqxhr.complete(function(){
           console.log("send data complete");
           $('#msg').hide();        
        });              
    };
    if(typeemp == 2 || typeemp == null){
        var jqxhr = $.getJSON("<?php echo base_url();?>index.php/apply_license/get_data_personnel_by_non_gmf/" + personnel_number, function(data) {                
        $('[name=name]').val(data.EMPLNAME);                
        $('[name=presenttitle]').val(data.JOBTITLE);
        $('[name=departement]').val(data.UNIT);
        $('[name=email]').val(data.EMAIL);
        $('[name=dateofbirth]').val(data.BORNDATE); 
        $('[name=dateofemployee]').val(data.EMPLODATE);
        $('[name=formaleducation]').val(data.LASTEDUCLEVEL);
        $('[name=mobilephone]').val(data.mobilephone);
        $('[name=businessphone]').val(data.businessphone); 
        if(data.WORKUNTILDATE == '31-12-9999'){       
            var now = new Date(); 
            var work = (data.WORKUNTILDATE).split("-");
            var d = work[0];
            var m = work[1];
            var y = work[2]; 
            var date_work = new Date(y+'-'+m+'-'+d);                       
            if(date_work > now){                
               $('[name=submitpersonnelinformation]').attr('disabled',false);                
            };                                                         
            $('[name=validitycontract]').attr('disabled',true);
            $('[name=submitpersonnelinformation]').attr('disabled',false);
        };
        if(data.WORKUNTILDATE != '31-12-9999'){
            var now = new Date();
            var work = (data.WORKUNTILDATE).split("-");
            var d = work[0];
            var m = work[1];
            var y = work[2]; 
            var date_work = new Date(y+'-'+m+'-'+d);
            if(date_work > now){                
               $('[name=submitpersonnelinformation]').attr('disabled',false);                
            };                            
            if(date_work < now){                
               $('[name=submitpersonnelinformation]').attr('disabled',true);
               alert('You retired'); 
            };    
            $('[name=validitycontract]').attr('disabled',false);
            $('[name=validitycontract]').val(data.WORKUNTILDATE);                
            };
            
            $('[name=personnel_number_superior]').val(data.REPORT_TO);            
        }); 
        jqxhr.complete(function(){
           console.log("send data complete");
           $('#msg').hide();        
        });               
    }; 
    if($('[name=name]').val()=='' || $('[name=typeemp]').val()==''){
        $('#msg').show();
    };  
    });
    
    $('[name=cari_id_emp_gmf],[name=personnel_number_superior]').click(function(){
    $('[name=name_superior],[name=jobtitle_superior],[name=email_superior]').val('');                               
    var personnel_number_superior = $('[name=personnel_number_superior]').val();  
    var jqxhr = $.getJSON("<?php echo base_url();?>index.php/apply_license/get_data_personnel_by_gmf/" + personnel_number_superior, function(data) {
        $('[name=name_superior]').val(data.EMPLNAME);                
        $('[name=jobtitle_superior]').val(data.JOBTITLE);
        $('[name=email_superior]').val(data.EMAIL);        
    });
    jqxhr.complete(function(){
       console.log("send data complete");       
    });    
    });
    
    
    $('#nongmfemp, #gmfemp').change(function() {      
    if($('#gmfemp').is(':checked')){                
        $('input[name=validitycontract]').hide(); 
        $('div#fieldgmfemp').show('slow');
        $('div#fieldnongmfemp').hide();   
        $('div.personnel_information_form').show('fast');                                    
        $('[name=name],[name=presenttitle]').attr('readonly',true);           
        $('[name=validitycontract],[name=id_personnel_superior],[name=email_superior]').prop('required',false); 
        $('[name=personnelnumber],[name=mobilephone],[name=businessphone]').prop('required',true);  
        $('[name=personnelnumber],[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone],[name=personnel_number_superior],[name=name_superior],[name=jobtitle_superior],[name=email_superior]').val('');                       
        $('[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation]').prop("readonly", true);          
    }else if($('#nongmfemp').is(':checked')){
        $('input[name=validitycontract]').show(); 
        $('div#fieldnongmfemp').show('slow'); 
        $('div#fieldgmfemp').hide();          
        $('[name=validitycontract]').attr('disabled',false);      
        $('div.personnel_information_form').show('fast');        
        $('[name=personnelnumber],[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone]').attr('readonly',false);                           
        $('[name=personnelnumber],[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone],[name=validitycontract],[name=id_personnel_superior],[name=email_superior]').prop('required',true);                                                 
        $('[name=name],[name=presenttitle],[name=departement],[name=email],[name=dateofbirth],[name=dateofemployee],[name=formaleducation],[name=mobilephone],[name=businessphone],[name=validitycontract],[name=personnel_number_superior],[name=name_superior],[name=jobtitle_superior],[name=email_superior]').val('');                
    }
    });
    
 
</script>