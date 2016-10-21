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
			"url"	: "<?php echo site_url('configure_cms/news_information/ajax_get_news_inf'); ?>",
			"type"	: "POST"
		},

		//Set column definition initialisation properties.
		"columnDefs" : [
			{ 
				"targets"	: [ 0, 1, 2, 3, 4, 5], //first column / numbering column
				"orderable"	: false, //set not orderable
			},
		],
	});
});
</script>

<section class="content-header">
	<h1>News Information <small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>

<div class="actions">
	<a href="<?php echo $add; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New</a>
</div>

<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table_bootstrap" id="datatables">
		<thead>
			<tr>
				<th width="20%">category</th>
				<th width="20%">author</th>
				<th width="20%">title</th>
				<th width="15%">changed time</th>
				<th width="15%">changed by</th>
				<th width="10%">action</th>
			</tr>
		</thead>
	</table>
</div>