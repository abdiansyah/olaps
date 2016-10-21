<script type="text/javascript">
$().ready(function(){	  
	$('#datatables').dataTable({
		"scrollY"			: "342px",
        "scrollCollapse"	: true,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('configure_cms/profile/ajax_get_profile'); ?>",
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
	<h1>Profile<small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>

<div class="actions">
	<a href="<?php echo $add; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New</a>
</div>

<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table_bootstrap" id="datatables">
		<thead>
			<tr>
				<th width="20%">Profile</th>
				<th width="20%">changed time</th>
				<th width="30%">changed by</th>
				<th width="20%">action</th>
			</tr>
		</thead>
	</table>
</div>