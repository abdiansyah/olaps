<script type="text/javascript">
$().ready(function(){
$('#datatables_category').dataTable({
		"scrollY"			: "342px", 
        "searching"         : false, 
        "select"            : true,      
        "scrollCollapse"	: true,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order.                

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('license/category/ajax_category'); ?>",
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
	<h1>Category <small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>

<div class="actions">
	<a href="<?php echo $add; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New</a>
</div>

<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_category">
		<thead>
			<tr><h3>&nbsp;Category</h3></tr>
            <tr>				
				<th width="15%">Name category</th>                
                <th width="15%">Keterangan</th>
                 <th width="7%">Action</th>                							
			</tr>                                                          
		</thead>
    </table>
</div>