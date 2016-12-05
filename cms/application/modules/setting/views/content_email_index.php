<script type="text/javascript">
$(document).ready(function(){	  
	$('#datatables_users').dataTable({
		"scrollY"			: "342px",
        "scrollCollapse"	: true,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('setting/content_email/ajax_get_content_email'); ?>",
			"type"	: "POST"
		},

		//Set column definition initialisation properties.
		"columnDefs" : [
			{ 
				"targets"	: [ 0, 1, 2, 3 ], //first column / numbering column
				"orderable"	: false, //set not orderable
			},
		],
	});
});
</script>

<section class="content-header">
	<h1>Management User <small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>

<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table_bootstrap" id="datatables_users">
		<thead>
			<tr>
				<th width="3%">No</th>
				<th width="10%">Subject</th>				
				<th width="15%">Title</th>				
				<th width="30%">Content</th>				
				<th width="30%">Footer</th>				
				<th width="15%">Action</th>
			</tr>
		</thead>
	</table>
</div>