<?php echo jquery_select2();?>
<script type="text/javascript">
$().ready(function(){
var unit = '<?php echo @$unit;?>';
var comp_type = '<?php echo @$comp_type;?>';

$('#datatables_cofc_license').dataTable({
		"scrollY"         : "342px", 
    "searching"       : false, 
    "select"          : true,
    "bLengthChange"   : false,      
    "scrollCollapse"  : true,
    "bPaginate"       : false,  
    "processing"      : true, //Feature control the processing indicator.
    "serverSide"      : true, //Feature control DataTables' server-side processing mode.
    "order"           : [], //Initial no order.     Initial no order.                

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('license_holder/cofc_license/ajax_cofc_license'); ?>",
			"type"	: "POST",
      "data"  : {
        "unit"      : unit,
        "comp_type" : comp_type,     
       }                        
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
				<h3 class="box-title">List Stamp Holder</h3>
			</div>
			<div class="box-body">
    <div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->   
   	<div class="radio">
    <b>Search By Unit </b>&nbsp; &nbsp;
    <input type="text" name="unit" placeholder="Unit" maxlength="30" size="30">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     	
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   	<b>Component Type </b>&nbsp; &nbsp; 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;<select name="comp_type" >
    <option>---</option>
    <?php 
    echo modules::run('license_holder/cofc_license/option_comp_type'); 
    ?>   
    </select>
    &nbsp;&nbsp;&nbsp;<button type="submit" name="search" class="btn btn-info btn-sm">&nbsp;&nbsp;&nbsp; <b>Search</b> &nbsp;&nbsp;&nbsp;</button>
    <br/>
    <br/>
    <b>Total data :</b>&nbsp; &nbsp; 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;
   	</div>   	   	   	 	  	
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="datatables_cofc_license">
		<thead>			
            <tr>				
				    <th width="10%">ID</th>                
            <th width="20%">Name</th>                 
            <th width="10%">Unit</th>                							
            <th width="10%">Stamp No.</th>                							
            <th width="10%">Valid Until</th>                							
			</tr>                                                          
		</thead>
    </table>
</div>
</div>
</div>
</div>
</div>