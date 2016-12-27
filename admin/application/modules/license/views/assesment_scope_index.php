<script type="text/javascript">
$().ready(function(){
$('#datatables_blocked_date').dataTable({
		"scrollY"			: "342px", 
        "searching"         : true, 
        "select"            : true,                 
        "bSort"             : false,     
        "scrollCollapse"	: true,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order.                

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('license/assesment_scope/ajax_assesment_scope'); ?>",
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
    });    
</script>

<section class="content-header">
	<h1>Assesment Scope <small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>

<div class="actions">
	<a href="<?php echo $add; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New</a>
</div>

<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_blocked_date">
		<thead>			
            <tr>				
				<th width="10%">Code</th>                
                <th width="70%">Name</th>
                <th width="20%">Action</th>                							
			</tr>                                                          
		</thead>
    </table>
</div>