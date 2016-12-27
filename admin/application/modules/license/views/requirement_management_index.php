<script type="text/javascript">
$().ready(function(){
$('#datatables_specific').dataTable({
		"scrollY"			: "342px", 
        "searching"         : true, 
        "select"            : true,      
        "scrollCollapse"	: true,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order.                

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('license/requirements_management/ajax_req_specific'); ?>",
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
    
$('#datatables_general').dataTable({
		"scrollY"			: "342px", 
        "searching"         : true, 
        "select"            : true,      
        "scrollCollapse"	: true,
		"processing" 		: true,
		"serverSide" 		: true,
		"order" 	 		: [],                 

	
		"ajax": {
			"url"	: "<?php echo site_url('license/requirements_management/ajax_req_general'); ?>",
			"type"	: "POST",                        
		},

		
		"columnDefs" : [
			{ 
				"targets"	: [],
				"orderable"	: false, //set not orderable                            
			},
		],
	});
 });    
</script>

<section class="content-header">
	<h1>Requirements Management<small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>
<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_specific">
		<thead>
			<tr><h3>&nbsp;Specific Requirement</h3></tr>
            <tr>&nbsp;&nbsp;&nbsp;<a href="<?php echo $add_req_specific; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add Requirement</a></tr>            
            <tr>				
				<th width="15%">Name requirement</th>                
                <th width="15%">Code folder</th>                
                <th width="10%">Actions</th>                                							
			</tr>                                                          
		</thead>
    </table>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_general">
		<thead>
			<tr><h3>&nbsp;General Requirement</h3></tr>
            <tr>&nbsp;&nbsp;&nbsp;<a href="<?php echo $add_req_general; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add Requirement</a></tr>
            <tr>				
				<th width="15%">Name requirement</th>                
                <th width="15%">Code folder</th>                
                <th width="10%">Actions</th>                                							
			</tr>                                                           
		</thead>
    </table>
</div>
