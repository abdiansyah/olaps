<?php
if(!isset($data_completing_data['submitcompletingdata'])){
        redirect('apply_license/index');
    }else
    {
?>
<script type="text/javascript">
    window.history.forward();
    function noBack() { window.history.forward(); }
    function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
// To disable f5
    /* jQuery < 1.7 */
    $(document).bind("keydown", disableF5);
    /* OR jQuery >= 1.7 */
    $(document).on("keydown", disableF5);

    // To re-enable f5
        /* jQuery < 1.7 */
    $(document).unbind("keydown", disableF5);
    /* OR jQuery >= 1.7 */
    $(document).off("keydown", disableF5);
</script>
<div class="row" onload="noBack();" 
    onpageshow="if (event.persisted) noBack();" onunload="">
<div class="col-md-10 col-md-offset-1 col-center-block table-responsive">
<div class="box box-info box-center" id="halaman4">
<div class="progress">
<div id="progress-step" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 80%">                                
    <label>80% Completed</label>
</div>                 
</div>
	<div class="box-header with-border">
		<h3 class="box-title">SUMMARY</h3>
	</div>
     <form method="POST" action="<?php echo site_url('apply_license/summary');?>" enctype="multipart/form-data" name="form_summary">	
		  <div class="box-body"> 
        <div id="confirm" class="modal fade" role="dialog">
          <div class="modal-dialog">      
            <div class="modal-content">
              <div class="modal-header">        
              <h4 class="modal-title">Request</h4>
              </div>
              <div class="modal-body">
              <h3><img src="<?php echo base_url('/assets/images/property/check.png');?>" height="30"/> &nbsp;&nbsp;The request has been submitted succcessfully.</h3>        
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" name="ok">OK</button>
              </div>
            </div>
          </div>
        </div>
			<div class="panel panel-default"> <!-- div type panel -->
                       <div class="panel-heading text-center"> <!-- div head panel -->
                       Detail Request
                       </div> <!-- end div head panel -->                  
                        <div class="panel-body"> <!-- div body panel -->
                            <div class="col-sm-12"> <!-- div content panel -->
                               <div class="form-horizontal">
                               <div class="form-group">
                               <label class="col-sm-3 control-label">Request Number</label>
                               <div class="col-sm-9">
                               <input type="text" class="form-control" name="sumrequestnumber" value="<?php 
                               $personnel_number = $sess_data_personnel['personnel_number'];
                               $unit = $sess_data_personnel['departement'];
                               echo kode_auto_apply($personnel_number,$unit); ?>" readonly>                               
                               </div>                               
                               </div>
                               <div class="form-group">
                               <label class="col-sm-3 control-label">Date Request</label>
                               <div class="col-sm-9">
                               <input type="text" class="form-control" name="sumdaterequest" value="<?php echo date('d-M-Y');?>" readonly>                               
                               </div>                               
                               </div>
                               <div class="form-group">
                               <label class="col-sm-3 control-label">IP Address</label>
                               <div class="col-sm-9">
                               <input type="text" class="form-control" name="sumipaddress" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" readonly>                               
                               </div>                               
                               </div>
                               </div>
                            </div>  <!-- end div content panel -->
                        </div>  <!-- end div body panel -->                                       
                                               
                   </div> <!-- end div type panel -->    
                   <div class="panel panel-default"> <!-- div type panel -->
                       <div class="panel-heading text-center"> <!-- div head panel -->
                       Personnel Information
                       </div> <!-- end div head panel -->                  
                      <div class="panel-body"> <!-- div body panel -->
                            <div class="col-md-12"> <!-- div content panel -->                               
                               <div class="form-horizontal">
                               <div class="form-group">
                               <label class="col-sm-3 control-label">Name</label>
                               <div class="col-sm-9">
                               <input type="text" class="form-control" name="sumname" value="<?php echo $sess_data_personnel['name']; ?>">                               
                               </div>                               
                               </div>
                               <div class="form-group">
                               <label class="col-sm-3 control-label">Personnel Number</label>
                               <div class="col-sm-9">
                               <input type="text" class="form-control" name="sumpersonnelnumber" value="<?php echo $sess_data_personnel['personnel_number']; ?>">                                 
                               </div>                               
                               </div>
                               <div class="form-group">
                               <label class="col-sm-3 control-label">Unit</label>
                               <div class="col-sm-9">
                               <input type="text" class="form-control" name="sumunit" value="<?php echo $sess_data_personnel['departement']; ?>">                               
                               </div>                               
                               </div>
                               <div class="form-group">
                               <label class="col-sm-3 control-label">Job Title</label>
                               <div class="col-sm-9">
                               <input type="text" class="form-control" name="sumjobtitle" value="<?php echo $sess_data_personnel['presenttitle']; ?>">                               
                               </div>                               
                               </div>
                               <div class="form-group">
                               <label class="col-sm-3 control-label">E-Mail</label>
                               <div class="col-sm-9">
                               <input type="email" class="form-control" name="sumemail" value="<?php echo $sess_data_personnel['email']; ?>">                               
                               </div>                               
                               </div>
                               <div class="form-group">
                               <label class="col-sm-3 control-label">Mobile Phone</label>
                               <div class="col-sm-9">
                               <input type="text" class="form-control" name="summobilephone" value="<?php echo $sess_data_personnel['mobilephone']; ?>">                               
                               </div>                               
                               </div>
                               </div>
                            </div>  <!-- end div content panel -->
                        </div>  <!-- end div body panel -->                                                                                      
                   </div> <!-- end div type panel -->   
                   <div class="panel panel-default"> <!-- div type panel -->
                       <div class="panel-heading text-center"> <!-- div head panel -->
                       Authorization Request
                       </div> <!-- end div head panel -->                  
                      <div class="panel-body"> <!-- div body panel -->
                            <div class="col-md-12"> <!-- div content panel -->
                            <?php
                            @$status_license = $sess_license['status_license'];
                            switch (@$status_license){
                                case 1 :
                                    $reason_apply_license = 'New Authorization';
                                    break;
                                case 2 :
                                    $reason_apply_license = 'Renewal';
                                    break;
                                case 3 :
                                    $reason_apply_license = 'Additional';
                                    break;
                                case 4 :
                                    $reason_apply_license = 'Rating Change/ Upgrade';
                                    break;
                            }
                            ?>
                            <label>Reason of Requested : <?php echo @$reason_apply_license;?> </label>                            
                            </div>
                            <div class="col-md-12">
                               <table class="table table-bordered" id="tb-summary">
                                    <thead>
                                        <tr>
                                            <th align="center"><label>No</label></th>
                                            <th align="center"><label>Authorization Type</label></th>                                
                                            <th align="center"><label>Type</label></th> 
                                            <th align="center"><label>Rating</label></th> 
                                            <th align="center"><label>Category</label></th> 
                                            <th align="center"><label>Scope of Authorization</label></th>                                                                                                                                                                                     
                                        </tr>
                                    </thead>                                    
                                    <tbody id="sum_license_authorization">
                                     <?php
                                     if(@$data_license!=''){
                                          echo @$data_license;
                                        }
                                     ?>   
                                    </tbody>  
                                    
                                    <tbody id="sum_license_garuda_authorization">
                                     <?php
                                     echo @$data_license_garuda;
                                     ?>   
                                    </tbody> 
                                    
                                    <tbody id="sum_license_citilink_authorization">
                                     <?php
                                     echo @$data_license_citilink;
                                     ?>   
                                    </tbody> 
                                    
                                    <tbody id="sum_license_sriwijaya_authorization">
                                     <?php
                                     echo @$data_license_sriwijaya;
                                     ?>   
                                    </tbody> 
                                     
                                    <tbody id="sum_easa_authorization">
                                    <?php
                                    echo @$data_license_easa;
                                    ?>    
                                    </tbody>  
                                    <tbody id="sum_special_authorization">
                                    <?php
                                    echo @$data_license_special;
                                    ?>    
                                    </tbody>  
                                    <tbody id="sum_garuda_authorization">
                                    <?php
                                    echo @$data_with_garuda;
                                    ?>    
                                    </tbody> 
                                    <tbody id="sum_citilink_authorization">
                                    <?php
                                    echo @$data_with_citilink;
                                    ?>                                        
                                    </tbody>     
                                    <tbody id="sum_sriwijaya_authorization">
                                    <?php
                                    echo @$data_with_sriwijaya;
                                    ?>    
                                    </tbody> 
                                    <tbody id="sum_cofc_authorization">
                                    <?php
                                    echo @$data_with_cofc ;
                                    ?>    
                                    </tbody>                                        
                                </table>                                                                               
                            </div>  <!-- end div content panel -->                               
                        </div>  <!-- end div body panel -->                                                                                      
                   </div>                    
		</div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right btn-sm" name="submitsummary">SEND</button>               
            <a href="<?php echo site_url('home/index');?>"><button type="button" class="btn btn-warning pull-right btn-sm" name="cancel">CANCEL</button></a>           
        </div>
        </form>
</div>
</div>
</div>
<?php
}
?>
<script Type="text/javascript">
$(function(){  
  $('button[name="submitsummary"]').click(function(e) {
    return confirm("The request has been submitted succcessfully. Is that OK?");
  });  
});
</script>