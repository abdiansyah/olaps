<div class="row">
<div class="col-md-8 col-md-offset-2 col-center-block table-responsive">
<div class="box box-info box-center" id="halaman5">	
    <form action="<?php echo site_url('apply_license/approved_superior');?>" method="POST" enctype="multipart/form-data" name="form_approved" id="form_approved">
	<div class="box-body">
            <div class="col-md-12" id="">           
				<div class="box-body table-responsive no-padding">                    
                    <table id="detail_personnel" class="table">
                    <tbody>	                    
					<tr>                        
						<td class="col-md-2">Name</td>                        
						<td class="col-md-10">: <input type="hidden" name="name_applicant" value="<?php echo $get_data_apply_personnel_by['name'];?>"/><?php echo $get_data_apply_personnel_by['name'];?></td>                        						
					</tr>
                    <tr>                        
						<td class="col-md-2">ID Number</td>                        
						<td class="col-md-10">: <input type="hidden" name="personnel_number_applicant" value="<?php echo $get_data_apply_personnel_by['personnel_number'];?>"/><?php echo $get_data_apply_personnel_by['personnel_number'];?></td>                        						
					</tr>
                    <tr>                        
						<td class="col-md-2">Unit</td>                        
						<td class="col-md-10">: <?php echo $get_data_apply_personnel_by['departement'];?></td>                        						
					</tr>
                    <tr>                        
						<td class="col-md-2">Jobtitle</td>                        
						<td class="col-md-10">: <?php echo $get_data_apply_personnel_by['presenttitle'];?></td>                        						
					</tr>
                    <tr>                        
						<td class="col-md-2">Request Number</td>                        
						<td class="col-md-10">: <input type="hidden" name="request_number_applicant" value="<?php echo $get_request_apply_personnel_by['request_number'];?>"/><?php echo $get_request_apply_personnel_by['request_number'];?></td>                        						
					</tr>
                    <tr>                        
						<td class="col-md-2">Date Request</td>                        
						<td class="col-md-10">: <?php echo date('d-M-Y',strtotime($get_request_apply_personnel_by['date_request']));?></td>                        						
					</tr>                                                                                               
                    </tbody>                     
					</table>
				</div>
			</div>
			<div class="col-md-12" id="dtl_to_atasan">           
				<div class="box-body table-responsive no-padding">                    
                    <table id="" class="table table-bordered">                    
                    <thead>
                    <tr>                        
						<th>No</th>                        
						<th>Authorization Type</th>                        
                        <th>Reason of Request</th>                        
                        <th>Scope of Authorization</th>                        
					</tr>    
                    </thead>
                    <tbody>	
                    <?php
                    echo $data_cek_approved_atasan; 
                    ?>				                                     
                    </tbody>                     
					</table>
				</div>
            </div>
            <div class="col-md-12" id="statement_atasan">			
            <div class="box-body table-responsive no-padding">                
                <table class="table" id="tbl_dtl_statement_atasan">
                    <thead>
                    <h3><?php 
                    echo $content_approved['title'];
                    ?></h3>
                    </thead>
                    <tbody>										                       
                    <?php 
                    echo $content_approved['content'];
                    ?>
                    <p></p>
                    <?php 
                    echo $content_approved['footer'];
                    ?>                                                                     											
                    </tbody>                                                        
	           </table>
            </div>
            </div>           
	</div>    
	<div class="box-footer">        
        <div>
            <input type="checkbox" name="check_agree_atasan" value="1"/> I Have read and agree 
        </div>
		<button type="submit" class="btn btn-info pull-right btn-sm" name="submitapproved" value="1"><b>APPROVED</b></button>
        &nbsp;
		<button type="submit" class="btn btn-danger pull-right btn-sm" name="submitdisapproved" value="0"><b>DISAPPROVED</b></button>
	</div>    
    </form>
</div>
</div>
</div> 
<script type="text/javascript">
  $('[name=submitapproved]').attr('disabled',true);
  $('[name=submitdisapproved]').attr('disabled',true);
  $('[name=check_agree_atasan]').on('change',function(){
    if(this.checked){
    $('[name=submitapproved]').attr('disabled',false);
    $('[name=submitdisapproved]').attr('disabled',false);      
    }else
    {
    $('[name=submitapproved]').attr('disabled',true);
    $('[name=submitdisapproved]').attr('disabled',true);        
    }
  });  
</script>   
            