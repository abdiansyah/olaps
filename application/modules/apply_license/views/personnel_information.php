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
                            <b id="personnel_expired"></b>      		
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
						<label  class="col-sm-2 col-md-offset-2 control-label">Validity Contract :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="validitycontract" type="text" />
						</div>						
					</div>
                    <?php }?>                    
                    <div class="form-group" id="fieldnongmfemp">
						<hr/>
                        <label  class="col-sm-4 control-label">Superior Information</label>
					</div>
                    
                    <div class="form-group" id="fieldnongmfemp">
						<label  class="col-sm-4 control-label">Personnel Number Superior :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="personnel_number_superior" type="text" />
						</div>
                        
                         <div class="col-sm-2">
                            <button type="button" name="cari_id_emp_gmf" class="btn btn-info btn-sm"><b>SEARCH EMP GMF</b></button>
                        </div>
                        
					</div>
                    <div class="form-group data-superior" id="fieldnongmfemp">
						<label  class="col-sm-2 col-md-offset-2 control-label">Name :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="name_superior" type="text" />
						</div>						
					</div>
                    <div class="form-group data-superior" id="fieldnongmfemp">
						<label  class="col-sm-2 col-md-offset-2 control-label">Job Title :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="jobtitle_superior" type="text"/>
						</div>						
					</div>
                    <div class="form-group data-superior" id="fieldnongmfemp">
						<label  class="col-sm-2 col-md-offset-2 control-label">Email :</label>
						<div class="col-sm-4">
							<input class="form-control input-sm" name="email_superior" type="text"/>
						</div>						
					</div>										
				</div>
				<div class="form-group">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label  class="col-sm-2 col-md-offset-2 control-label">&nbsp;&nbsp;&nbsp;Authorization Details :</label>			
					<button type="submit" class="btn btn-success btn-md col-sm-4" name="submitchecklicense" data-toggle="modal" data-target="#view-modal" onClick="return false;">
					<b>View</b>
					</button>									
				</div>
                
            </div>          
            <div class="box-footer">	            
                <button type="submit" class="btn btn-info btn-sm pull-right" name="submitpersonnelinformation">NEXT</button>                
            </div>	
            </form>
</div>  
</div> 
</div> 
 <!-- Modal License History-->
<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog"> 
     <div class="modal-content">         
        <div class="modal-header">            
           <h4 class="modal-title">
           <i class="glyphicon glyphicon-user"></i> License history
           </h4> 
        </div>                 
        <div class="modal-body">                     
            <div id="modal-loader" style="display: none; text-align: center;">               
                <img src="<?php echo base_url('/assets/images/property/hourglass.gif'); ?>">
            </div> 
            <div class="table-responsive">                                                          
                <div class="col-md-12">                                        
                    <h4><b>Basic License</b></h4>
                    <table class="table table-bordered table-responsive" id="datatables_basic">                    
                        <thead>
                        <tr>                        
                            <th width="3%">No</th>
                            <th width="97%">Basic License</th>                    
                        </tr>    
                        </thead>                                         
                    </table> 
                    <h4><b>AME License</b></h4>
                    <b>
                    <font size="3">AME License Number :</font></b>&nbsp;
                    <font size="3">
                        <b id="ame_license_number"></b>
                    </font>  
                    <br/>
                    <b>
                    <font size="3">Date Validity :</font></b>&nbsp;
                    <font size="3">
                        <b id="validity_ame"></b>
                    </font>
                    <font size="3">
                        <b id="status_ame" class="pull-right"></b>
                    </font>
                    <font size="3"> 
                        <b id="status_days_ame" class="pull-right">                        
                    </b>
                    </font>                                    
                    <table class="table table-bordered table-responsive" id="datatables_ame">                    
                        <thead>
                        <tr>                        
                            <th width="3%">No</th>
                            <th width="97%">Scope</th>                                                
                        </tr>    
                        </thead>                                         
                    </table>                                                                                                       
                    <h4><b>Certifying Staff Authorization</b></h4>
                    <b><font size="3">Date Validity :</font></b>&nbsp;<font size="3"><b id="validity_cs"></b></font><font size="3"><b id="status_cs" class="pull-right"></b></font><font size="3"> <b id="status_days_cs" class="pull-right"></b></font>
                    <table class="table table-bordered table-responsive" id="datatables_cs">                    
                        <thead>
                        <tr>                        
                            <th width="3%">No</th>
                            <th width="97%">Scope</th>                                                
                        </tr>    
                        </thead>                                         
                    </table>
                    <h4><b>GMF License</b></h4>
                    <b><font size="3">Date Validity :</font></b>&nbsp;<font size="3"><b id="validity_gmf"></b></font><font size="3"><b id="status_gmf" class="pull-right"></b></font><font size="3"> <b id="status_days_gmf" class="pull-right"></b></font>
                    <table class="table table-bordered table-responsive" id="datatables_gmf">                    
                        <thead>
                        <tr>                        
                            <th width="3%">No</th>
                            <th width="97%">Scope</th>                                                                            
                        </tr>    
                        </thead>                                         
                    </table>                 
                    <h4><b>GA Authorization</b></h4>
                    <b><font size="3">Date Validity :</font></b>&nbsp;<font size="3"><b id="validity_ga"></b></font><font size="3"><b id="status_ga" class="pull-right"></b></font><font size="3"> <b id="status_days_ga" class="pull-right"></b></font>
                    <table class="table table-bordered table-responsive" id="datatables_ga">                    
                        <thead>
                        <tr>                        
                            <th width="3%">No</th>
                            <th width="97%">Scope</th>                                                
                        </tr>    
                        </thead>                                         
                    </table>     
                    <h4><b>Citilink Authorization</b></h4>
                    <b><font size="3">Date Validity :</font></b>&nbsp;<font size="3"><b id="validity_citilink"></b></font><font size="3">
                    <b id="status_citilink" class="pull-right"></b></font><font size="3"> <b id="status_days_citilink" class="pull-right"></b></font>
                    <table class="table table-bordered table-responsive" id="datatables_citilink">                    
                        <thead>
                        <tr>                        
                            <th width="3%">No</th>
                            <th width="97%">Scope</th>                                                
                        </tr>    
                        </thead>                                         
                    </table>
                    <h4><b>Sriwijaya Authorization</b></h4>
                    <b><font size="3">Date Validity :</font></b>&nbsp;<font size="3"><b id="validity_sriwijaya"></b></font><font size="3"><b id="status_sriwijaya" class="pull-right"></b></font><font size="3"> <b id="status_days_sriwijaya" class="pull-right"></b></font>
                    <table class="table table-bordered table-responsive" id="datatables_sriwijaya">                    
                        <thead>
                        <tr>                        
                            <th width="3%">No</th>
                            <th width="42%">Scope</th>                                                
                        </tr>    
                        </thead>                                         
                    </table>                                                                                                                      

                    <h4><b>EASA Authorization</b></h4>
                    <b><font size="3">Date Validity :</font></b>&nbsp;<font size="3"><b id="validity_easa"></b></font><font size="3"><b id="status_easa" class="pull-right"></b></font><font size="3"> <b id="status_days_easa" class="pull-right"></b></font>
                    <table class="table table-bordered table-responsive" id="datatables_easa">                    
                        <thead>
                        <tr>                        
                            <th width="3%">No</th>
                            <th width="42%">Scope</th>                                                
                        </tr>    
                        </thead>                                         
                    </table> 

                    <h4><b>Stamp Data</b></h4>
					<b><font size="3">No Stamp :</font></b>&nbsp;<font size="3"><b id="no_stamp"></b></font><br/>
                    <b><font size="3">Date Validity :</font></b>&nbsp;<font size="3"><b id="validity_cofc"></b></font><font size="3"><b id="status_cofc" class="pull-right"></b></font><font size="3"> <b id="status_days_cofc" class="pull-right"></b></font> 
                    <table class="table table-bordered table-responsive" id="datatables_cofc">                    
                        <thead>
                        <tr>                                                    
                            <th width="10%">No.</th>                    
                            <th width="37%">EC Description</th>                    
                            <th width="20%">Rating</th>                    
                        </tr>    
                        </thead>                                         
                    </table> 

                </div>
            </div>
        </div> 
                    
        <div class="modal-footer">             
            <button type="button" class="btn btn-default" name="close">Close</button>  
            <!-- data-dismiss="modal" -->
        </div> 
                        
    </div> 
  </div>
</div>        
<?php 
echo bootstrap_datepicker();
?>   
<script type="text/javascript">
    var get_data_gmf = "<?php echo site_url().'/apply_license/get_data_personnel_by_gmf/'; ?>",
    	get_data_non_gmf = "<?php echo site_url().'/apply_license/get_data_personnel_by_non_gmf/';?>",
    	get_data_basic_license      = "<?php echo site_url().'/apply_license/get_data_basic_license/'; ?>",
        get_data_ame_license        = "<?php echo site_url().'/apply_license/get_data_ame_license/'; ?>",
        get_data_cs_license         = "<?php echo site_url().'/apply_license/get_data_cs_license/'; ?>",
        get_data_gmf_license        = "<?php echo site_url().'/apply_license/get_data_gmf_license/'; ?>",
        get_data_ga_license         = "<?php echo site_url().'/apply_license/get_data_ga_license/'; ?>",
        get_data_citilink_license   = "<?php echo site_url().'/apply_license/get_data_citilink_license/'; ?>",
        get_data_sriwijaya_license  = "<?php echo site_url().'/apply_license/get_data_sriwijaya_license/'; ?>",
        get_data_easa_license       = "<?php echo site_url().'/apply_license/get_data_easa_license/'; ?>",
        get_data_cofc_license       = "<?php echo site_url().'/apply_license/get_data_cofc_license/'; ?>";
        $(document).keyup(function(e) {          
          if (e.keyCode === 27) window.location.reload();   // esc
        });
</script>
<script src="<?php echo base_url('assets/plugins/js/personnel_information.js');?>" type="text/javascript"></script>     
