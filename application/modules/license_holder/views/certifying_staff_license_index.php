<?php echo jquery_select2();?>
<script type="text/javascript">
$().ready(function(){
$('#datatables_certifying_staff_license').dataTable({
		"scrollY"         : "342px", 
    "searching"       : false, 
    "select"          : true,
    "bLengthChange"   : false,      
    "scrollCollapse"  : true,
    "bPaginate"       : false,  
    "processing"      : true, //Feature control the processing indicator.
    "serverSide"      : true, //Feature control DataTables' server-side processing mode.
    "order"           : [], //Initial no order.     

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('license_holder/certifying_staff_license/ajax_certifying_staff_license'); ?>",
			"type"	: "POST",                        
		},

		//Set column definition initialisation properties.
		"columnDefs" : [
			{ 
				"targets"	: [], //first column / numbering column
				"orderable"	: false, //set not orderable                            
			},
		],
	});

	$('[name=ac_type]').select2({width : '20%'});

});    
</script>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 col-center-block table-responsive">    
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Certifying Staff License Holder</h3>
			</div>
			<div class="box-body">
    <div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->   
   	<div class="radio">
    <b>Search By Unit </b>&nbsp; &nbsp;
    <input type="text" name="unit" placeholder="Unit" maxlength="30" size="30">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     	
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   	<b>Status</b>   	
   	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status_license" value="A"><b>Active</b>
   	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status_license" value="R"><b>Revoke</b>
   	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status_license" value="S"><b>Suspend</b>
   	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status_license" value="F"><b>Freeze</b>
   	</div>   	
   	<div class="radio">
   	<br/>
   	<b>A/C Type </b>&nbsp; &nbsp; 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;<select name="ac_type" >
    <option>---</option>
    <?php 
    //echo modules::run('license_holder/ame_license/option_ac_type'); 
    ?>   
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     	
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
    <button type="submit" name="search" class="btn btn-info btn-sm">&nbsp;&nbsp;&nbsp; <b>Search</b> &nbsp;&nbsp;&nbsp;</button>
   	</div> 
   	<div class="radio">
   	<br/>
   	<b>Total data :</b>&nbsp; &nbsp; 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;
   	</div>   	  	
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_certifying_staff_license">
		<thead>			
            <tr>				
				<th width="20%">Name</th>                
                <th width="10%">Unit</th>
                 <th width="10%">Lic No.</th>                							
                 <th width="10%">Stamp No.</th>                							
                 <th width="10%">Valid From</th>                							
                 <th width="10%">Valid Until</th>                							
			</tr>                                                          
		</thead>
    </table>
</div>
</div>
</div>
</div>
</div>