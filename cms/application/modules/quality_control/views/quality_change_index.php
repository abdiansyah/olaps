<script type="text/javascript"> 
$().ready(function(){
  //  var request_number = '';
//    var personnel_number = '';
    var request_number              = '<?php echo $request_number; ?>';
    var personnel_number            = '<?php echo $personnel_number; ?>'; 
    var reason_apply_license        = '<?php echo $reason_apply_license; ?>'; 
    var code_unit                   = '<?php echo $code_unit; ?>'; 
    var priority                    = '<?php echo $priority; ?>'; 
    var datetime_priority           = '<?php echo $datetime_priority; ?>'; 
    var personnel_number_superior   = '<?php echo $personnel_number_superior; ?>'; 
    var personnel_number_quality    = '<?php echo $personnel_number_quality; ?>'; 
    var id_disposition_user_fk      = '<?php echo $id_disposition_user_fk; ?>'; 
    var id_location_user_fk         = '<?php echo $id_location_user_fk; ?>'; 
    var date_request                = '<?php echo $date_request; ?>'; 
    var date_approved_superior      = '<?php echo $date_approved_superior; ?>'; 
    var date_approved_quality       = '<?php echo $date_approved_quality; ?>';
    var date_referral_authorization = '<?php echo $date_referral_authorization; ?>';          
    var date_take_authorization     = '<?php echo $date_take_authorization; ?>';     
    var status_submit               = '<?php echo $status_submit; ?>';     
    var status_approved_superior    = '<?php echo $status_approved_superior; ?>'; 
    var status_approved_quality     = '<?php echo $status_approved_quality; ?>'; 
    var status_assesment            = '<?php echo $status_assesment; ?>';
    var status_issue_authorization  = '<?php echo $status_issue_authorization; ?>';
    var referral_authorization      = '<?php echo $referral_authorization; ?>';  
    var take_authorization          = '<?php echo $take_authorization; ?>'; 
    // alert(date_request)
    
    $('#datatables_high').dataTable({
		"scrollY"			: "342px",
        "searching"         : false, 
        "bPaginate"         : false,  
        "bSort"             : false,
        "select"            : true,      
        "scrollCollapse"	: true,
		"processing" 		: true, 
		"serverSide" 		: true, 
		"order" 	 		: [],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        switch(aData[7]){
            case 'Success':                               
                $(nRow).css('color', 'white');               
                $('td', nRow).css('background-color', '#1FA67B');
                break;
            default:                                
                $('td', nRow).css('background-color', '#FFA500');        
            };  
        },
		
		"ajax": {
			"url"	: "<?php echo site_url('quality_control/quality_control/ajax_get_history_inf'); ?>",
			"type"	: "POST" ,
            "data"  : {
                request_number : request_number,
                personnel_number : personnel_number,
                reason_apply_license : reason_apply_license,
                code_unit : code_unit,
                priority : priority,
                datetime_priority : datetime_priority,
                personnel_number_superior : personnel_number_superior,
                personnel_number_quality : personnel_number_quality,
                id_disposition_user_fk : id_disposition_user_fk,
                id_location_user_fk : id_location_user_fk,
                date_request : date_request,
                date_approved_superior : date_approved_superior,
                date_approved_quality : date_approved_quality,
                date_referral_authorization : date_referral_authorization,
                date_take_authorization : date_take_authorization,                
                status_submit : status_submit,
                status_approved_superior : status_approved_superior,
                status_approved_quality : status_approved_quality,
                status_assesment : status_assesment,
                take_authorization : take_authorization,
                referral_authorization : referral_authorization,                                
            }           
		},

		
		"columnDefs" : [
			{ 
				"targets"	: [],
				"orderable"	: false,
			},
		],
	});
    
	$('#datatables_normal').dataTable({
		"scrollY"			: "342px", 
        "searching"         : false, 
        "bPaginate"         : false,  
        "bSort"             : false,
        "select"            : true,      
        "scrollCollapse"	: true,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order. 
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        switch(aData[6]){
            case 'Approved Superior':
                $(nRow).css('color', 'white');
                $('td', nRow).css('background-color', 'Red');
                break;        
            };
        switch(aData[6]){
            case 'Success':
                $(nRow).css('color', 'white');                
                $('td', nRow).css('background-color', 'green');
            break;
            };
        },
		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('quality_control/quality_control/ajax_get_history_inf_normal'); ?>",
			"type"	: "POST",
            "data"  : {
                request_number : request_number,
                personnel_number : personnel_number,
                reason_apply_license : reason_apply_license,
                code_unit : code_unit,
                priority : priority,
                datetime_priority : datetime_priority,
                personnel_number_superior : personnel_number_superior,
                personnel_number_quality : personnel_number_quality,
                id_disposition_user_fk : id_disposition_user_fk,
                id_location_user_fk : id_location_user_fk,
                date_request : date_request,
                date_approved_superior : date_approved_superior,
                date_approved_quality : date_approved_quality,
                date_referral_authorization : date_referral_authorization,
                date_take_authorization : date_take_authorization,                
                status_submit : status_submit,
                status_approved_superior : status_approved_superior,
                status_approved_quality : status_approved_quality,
                status_assesment : status_assesment,
                take_authorization : take_authorization,
                referral_authorization : referral_authorization,                                
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
});
</script>
<section class="content-header">
	<h1>List Data <small><i class="fa fa-fw fa-angle-double-right"></i> All</small></h1>
</section>
<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
<br/>
<?php 
if($this->session->flashdata('msg')!= ''){ 
echo '<div class="col-xs-12 col-center-block">
<div class="box box-info box-solid">
<div class="box-header with-border text-center">
    <h3 class="box-title">
      <b>';   
        $msg = $this->session->flashdata('msg');                     
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
    $msg = $this->session->flashdata('msg');                                                
    unset($msg); 
}

?>
<div id="FormSearch" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Search</h4>
      </div>
      <form method="POST" action="#" name="form_list_search">      
      <div>                          
            <div class="form-group col-sm-12">
            <table class="table table-bordered">            
           	<tbody class="data-search-authorization-high">
                <tr>
                <br/>
                </tr>                
          		<tr class="text-authorization-high">
                    <td>
                        <select id="tab-search-high" name="tab-search-high" class="col-md-12 form-control"> 
                        <optgroup label="Apply License">                       
                        <option value="request_number">Request Number</option>
                        <option value="reason_apply_license">Reason Apply License</option> 
                        <option value="code_unit">Code Unit</option>
                        <option value="priority">Priority</option>   
                        <option value="datetime_priority">Due Date Priority</option>   
                        <optgroup label="Personnel Number">
                        <option value="personnel_number">Personnel Number</option>
                        <option value="personnel_number_superior">Personnel Number Superior</option>
                        <option value="personnel_number_quality">Personnel Number Quality</option>
                        <option value="id_disposition_user_fk">Personnel Number Disposition</option>   
                        <option value="id_location_user_fk">Personnel Number Postition</option>
                        <optgroup label="Date Apply License">
                        <option value="date_request">Date Request</option>
                        <option value="date_approved_superior">Date Approved Superior</option>
                        <option value="date_approved_quality">Date Approved Quality</option>
                        <option value="date_take_authorization">Date Take Authorization</option>                         
                        <option value="date_finish">Date Finish</option> 
                        <optgroup label="Status License">                                                                       
                        <option value="status_submit">Status Terkirim Applicant</option>                        
                        <option value="status_approved_superior">Status Approved Superior</option>                                                                             
                        <option value="status_data_validated">Status Approved Quality</option>                                                
                        <option value="status_assesment">Status Assesment</option>                                                                       
                        <option value="status_issue_authorization">Status Issue Authorization</option>
                        <option value="referral_authorization">Status Referral Authorization</option>  
                        <option value="take_authorization">Status Take Authorization</option>                                                                                                                                                                
                        </select>                   
                    </td>  
                    <td id="box-type-search-high">
                     <input name="input-tab-search-high" id="input-tab-search-high" class="col-md-12 form-control" type="text"/>
                     <span style="display:none;" class="box-number-search-high"></span>
                    </td>                                                         
                    <td style="text-align: center; width: 5px;"><a class="btn btn-info pull-right add-box-high"><i class="fa fa-plus"></i></a></td>
                </tr>                                               
            </tbody>
            </table>            
        	</div>                	
      </div>                                     
      <div class="modal-footer">            			        			
      <button type="button" class="btn btn-flat btn-danger color-palette btn-sm" data-dismiss="modal"><span class="fa fa-sign-out"></span> &nbsp;Cancel</button>      
      <button type="submit" class="btn btn-flat btn-primary color-palette btn-sm"><span class="fa fa-search"></span> &nbsp;Find </button>     
      </div>
      </form>
    </div>
  </div>
</div> 
    <div class="col-md-12">
    <form method="POST" action="#" name="form_list_search"> 
    <h3>Highlight Issue &nbsp; &nbsp; &nbsp;
    <button type="button" class="btn btn-flat bg-light-blue color-palette btn-sm" data-toggle="modal" data-target="#FormSearch">Search</button>
    <button type="submit" class="btn btn-flat bg-light-blue color-palette btn-sm">Reset</button>
    </form>
    </h3>             
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table_bootstrap" id="datatables_high">
		<thead>                                    			
				<th width="5%" rowspan="2">Date of Application</th>
                <th width="7%" rowspan="2">Priority</th>
				<th width="15%" rowspan="2">Request Number</th>
				<th width="15%" rowspan="2">Name</th>
                <th width="10%" rowspan="2">ID Number</th>
                <th width="13%" rowspan="2">Disposition</th>
                <th width="7%" rowspan="2">Location</th>
                <th width="10%" rowspan="2">Current Status</th>
                <th width="15%" rowspan="2">Last update</th>
                <th width="5%" rowspan="2">Time</th>
                <th width="3%" rowspan="2">Duration</th>                
                <th width="5%" colspan="2">Deadline</th>                
                <th width="8%" rowspan="2">Remarks</th>
                <th width="5%" rowspan="2">Action</th>   				
			</tr>
            <tr>                				
                <th width="5%">Date</th>
                <th width="5%">Time</th>                   				
			</tr>
		</thead>
	</table>
    </div> 
    <div class="col-md-12">
    <h3>Normal Issue </h3>   
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table_bootstrap" id="datatables_normal">
		<thead>			
            <tr>
				<th width="5%">Date of Application</th>
				<th width="10%">Request Number</th>
				<th width="15%">Name</th>
                <th width="10%">ID Number</th>
                <th width="17%">Disposition</th>
                <th width="7%">Location</th>
                <th width="10%">Current Status</th>
                <th width="10%">Last update</th>
                <th width="5%">Time</th>
                <th width="8%">Duration</th>                                                
                <th width="8%">Remarks</th>
                <th width="5%">Action</th>   				
			</tr>            
		</thead>
	</table>
    </div>
    <div class="col-md-12">    
    </div>
</div>
<?php echo jquery_select2(); ?>
<?php echo bootstrap_datepicker();?>
<script type="text/javascript">
$('.modal-content').datepicker({       
        // language: 'pt-BR'
});
$('.select2-tab-search-high').select2({width : '100%'});

$('#tab-search-high').change(function(){            
    var tab_search_high = $(this).val();                             
    $.get("<?php echo base_url();?>index.php/quality_control/get_tab_search_high/" + tab_search_high , function(data, status){                 
        $("#box-type-search-high").html(data);
    });
})
    
$('.add-box-high').click(function(){    
        var n_search_high          = $('.box-number-search-high').length+1;
 		var tab_search_high        = $('#tab-search-high :selected').val();
 		var tab_search_high_text   = $('#tab-search-high :selected').text();
        var input_tab_search_high  = $('#input-tab-search-high').val();          
                                                           
        var box_html_authorization_search_high = $('<tr class="text-authorization-high">' +                            
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_search_high_text + '" disabled/></td>' +
                            '<td><input name="'+ tab_search_high +'" type="hidden" value="' + input_tab_search_high + '"/><input name="" class="form-control input-sm col-sm-12" type="text" value="' + input_tab_search_high + '" disabled/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-search-high">' + n_search_high + 
                            '</span><a class="remove-box-search-high btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_search_high.hide();
        $('tr.text-authorization-high:last').before(box_html_authorization_search_high);  			            
        $('#tab-search-high')[0].selectedIndex = 0;
        $('#input-tab-search-high').val('');         
        box_html_authorization_search_high.fadeIn('slow');
        return true;
    });
        
    $('.data-search-authorization-high').on('click', '.remove-box-search-high', function(){
                $(this).parent().parent().css( 'background-color', '#FF6C6C' );
                    $(this).parent().fadeOut("slow", function() {
                        $(this).parent().remove();
                            $('.box-number-search-high').each(function(index){
                                $(this).text( index + 1 );
                            });
                        });
                return true;
    });    
    
</script>