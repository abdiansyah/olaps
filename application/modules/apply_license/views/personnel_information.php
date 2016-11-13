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
            $user_data = $this->session->userdata('users_applicant'); 
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
						<label for="businessphone" class="col-sm-2 col-md-offset-2 control-label">Office Phone :</label>
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
                        
                         <div class="col-sm-2">
                            <button type="button" name="cari_id_emp_gmf" class="btn btn-info btn-sm"><b>SEARCH EMP GMF</b></button>
                        </div>
                        
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
    var get_data_gmf = "<?php echo site_url().'/apply_license/get_data_personnel_by_gmf/'; ?>",
    	get_data_non_gmf = "<?php echo site_url().'/apply_license/get_data_personnel_by_non_gmf/';?>";
</script>
<script src="<?php echo base_url('assets/plugins/js/personnel_information.js');?>" type="text/javascript"></script>     
