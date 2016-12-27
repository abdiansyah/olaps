<script type="text/javascript">
$().ready(function(){
$('#datatables_license_type').dataTable({
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
			"url"	: "<?php echo site_url('license/Authorization_group/ajax_license_type'); ?>",
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

$('#datatables_type_spect').dataTable({
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
			"url"	: "<?php echo site_url('license/Authorization_group/ajax_type_spect'); ?>",
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

$('#datatables_spect_category').dataTable({
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
			"url"	: "<?php echo site_url('license/Authorization_group/ajax_category_spect'); ?>",
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
	<h1>Authorization Group<small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>
<div class="block-table table-sorting clearfix">  <!-- block-fluid table-sorting clearfix -->
<div class="box box-warning box-solid">
	<div class="box-header with-border">
	<h3 class="box-title">&nbsp;License - Type</h3>
	<div class="box-tools pull-right">
	<button class="btn btn-box-tool" type="button" data-widget="collapse">
	<i class="fa fa-minus"></i>
	</button>
	</div>
</div>
<div class="box-body" style="display: block;">
<?php 
if($this->session->flashdata('msg_auth_group')!= ''){ 
echo '<div class="col-xs-12 col-center-block">
<div class="box box-success box-solid">
<div class="box-header with-border text-center">
    <h3 class="box-title">
      <b>';   
        $msg = $this->session->flashdata('msg_auth_group');                     
        echo $msg;                                        
        unset($msg);                        
echo '</b>                
    </h3>
    <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>               
</div>
</div>
</div>';        
}else{
    $msg = $this->session->flashdata('msg_auth_group');                                                
    unset($msg); 
}
?> 
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_license_type">
		<thead>			
            <tr>&nbsp;&nbsp;&nbsp;<a href="<?php echo $add_license_type; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add group</a></tr>            
            <tr>				
				<th width="40%">Authorization</th>                
                <th width="45%">Type</th>                
                <th width="15%">Actions</th>                                							
			</tr>                                                          
		</thead>
    </table>
     </div>
</div>
<div class="box box-warning box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">&nbsp;Type - Spect</h3>
		<div class="box-tools pull-right">
			<button class="btn btn-box-tool" type="button" data-widget="collapse">
			<i class="fa fa-minus"></i>
			</button>
		</div>
		</div>
		<div class="box-body" style="display: block;"> 
	    	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_type_spect">
			<thead>				
	            <tr>&nbsp;&nbsp;&nbsp;<a href="<?php echo $add_type_spect; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add group</a></tr>
	            <tr>								
	                <th width="40%">Type</th>
	                <th width="45%">Spec</th>                                             
	                <th width="15%">Actions</th>                                							
				</tr>                                                           
			</thead>
		    </table> 
		</div>
	</div>

	<div class="box box-warning box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">&nbsp;Spect - Category</h3>
		<div class="box-tools pull-right">
			<button class="btn btn-box-tool" type="button" data-widget="collapse">
			<i class="fa fa-minus"></i>
			</button>
		</div>
		</div>
		<div class="box-body" style="display: block;"> 
	    	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_spect_category">
			<thead>				
	            <tr>&nbsp;&nbsp;&nbsp;<a href="<?php echo $add_spect_category; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add group</a></tr>
	            <tr>								
	                <th width="20%">License</th>
	                <th width="20%">Type</th>                                             
	                <th width="20%">Spect</th>                                             
	                <th width="20%">Category</th>                                             
	                <th width="15%">Actions</th>                                							
				</tr>                                                           
			</thead>
		    </table> 
		</div>
	</div>
	</div>      
</div>
</div>
