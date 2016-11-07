<script type="text/javascript">
$(document).ready(function(){            
    var request_number_written      = '<?php echo @$request_number_written; ?>';
    var personnel_number_written    = '<?php echo @$personnel_number_written; ?>'; 
    var status_assesment_written    = '<?php echo @$status_assesment_written; ?>'; 
    var date_assesment_written      = '<?php echo @$date_assesment_written; ?>'; 
    var id_written_sesi             = '<?php echo @$id_written_sesi; ?>'; 
    var id_written_room             = '<?php echo @$id_written_room; ?>';
    var score_written               = '<?php echo @$score_written; ?>'; 
    var result_written              = '<?php echo @$result_written; ?>';
    
    var request_number_oral      = '<?php echo @$request_number_oral; ?>';
    var personnel_number_oral    = '<?php echo @$personnel_number_oral; ?>'; 
    var status_assesment_oral    = '<?php echo @$status_assesment_oral; ?>'; 
    var date_assesment_oral      = '<?php echo @$date_assesment_oral; ?>'; 
    var id_oral_sesi             = '<?php echo @$id_oral_sesi; ?>'; 
    var id_oral_room             = '<?php echo @$id_oral_room; ?>';
    var score_oral               = '<?php echo @$score_oral; ?>'; 
    var result_oral              = '<?php echo @$result_oral; ?>';        
    
	$('#written_assesment').dataTable({
        "searching"         : false, 	   
		"scrollY"			: "342px",
        "scrollCollapse"	: true,
        "bPaginate"         : false,  
        "bSort"             : false,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('assesment/assesment/ajax_get_written_assesment'); ?>",
			"type"	: "POST",
            "data"  : {
                request_number_written      : request_number_written,
                personnel_number_written    : personnel_number_written,
                status_assesment_written    : status_assesment_written,
                date_assesment_written      : date_assesment_written,
                id_written_sesi             : id_written_sesi,
                id_written_room             : id_written_room,
                score_written               : score_written,
                result_written              : result_written                
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
    
    $('#oral_assesment').dataTable({
        "searching"         : false, 
		"scrollY"			: "342px",
        "scrollCollapse"	: true,
        "bPaginate"         : false,  
        "bSort"             : false,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('assesment/assesment/ajax_get_oral_assesment'); ?>",
			"type"	: "POST",
            "data"  : {
                request_number_oral      : request_number_oral,
                personnel_number_oral    : personnel_number_oral,
                status_assesment_oral    : status_assesment_oral,
                date_assesment_oral      : date_assesment_oral,
                id_oral_sesi             : id_oral_sesi,
                id_oral_room             : id_oral_room,
                score_oral               : score_oral,
                result_oral              : result_oral                
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
<div id="FormSearch_written" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Search Written</h4>
      </div>
      <form method="POST" action="#" name="form_list_search">      
      <div>                          
            <div class="form-group col-sm-12">
            <table class="table table-bordered">            
           	<tbody class="data-search-authorization-written">
                <tr>
                <br/>
                </tr>                
          		<tr class="text-authorization-written">
                    <td>
                        <select id="tab-search-written" name="tab-search-written" class="col-md-12 form-control">  
                        <option value="request_number_written">Request Number</option>
                        <option value="personnel_number_written">Personnel Number</option> 
                        <option value="status_assesment_written">Status</option>
                        <option value="date_assesment_written">Date Assesment</option>   
                        <option value="id_written_sesi">Sesi</option>
                        <option value="id_written_room">Room</option>
                        <option value="score_written">Score</option>
                        <option value="result_written">Result</option>              
                        </select>                   
                    </td>  
                    <td id="box-type-search-written">
                     <input name="input-tab-search-written" id="input-tab-search-written" class="col-md-12 form-control" type="text"/>
                     <span style="display:none;" class="box-number-search-written"></span>
                    </td>                                                         
                    <td style="text-align: center; width: 5px;"><a class="btn btn-info pull-right add-box-written"><i class="fa fa-plus"></i></a></td>
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

<div id="FormSearch_oral" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Search Oral</h4>
      </div>
      <form method="POST" action="#" name="form_list_search">      
      <div>                          
            <div class="form-group col-sm-12">
            <table class="table table-bordered">            
           	<tbody class="data-search-authorization-oral">
                <tr>
                <br/>
                </tr>                
          		<tr class="text-authorization-oral">
                    <td>
                        <select id="tab-search-oral" name="tab-search-oral" class="col-md-12 form-control">                                                
                        <option value="request_number_oral">Request Number</option>
                        <option value="personnel_number_oral">Personnel Number</option> 
                        <option value="status_assesment_oral">Status</option>
                        <option value="date_assesment_oral">Date Assesment</option>   
                        <option value="id_oral_sesi">Sesi</option>
                        <option value="id_oral_room">Room</option>
                        <option value="score_oral">Score</option>
                        <option value="result_oral">Result</option>                                                                                                                                                                                           
                        </select>                   
                    </td>  
                    <td id="box-type-search-oral">
                     <input name="input-tab-search-oral" id="input-tab-search-oral" class="col-md-12 form-control" type="text"/>
                     <span style="display:none;" class="box-number-search-oral"></span>
                    </td>                                                         
                    <td style="text-align: center; width: 5px;"><a class="btn btn-info pull-right add-box-oral"><i class="fa fa-plus"></i></a></td>
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
<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
<br/>
<?php 
if($this->session->flashdata('msg_assesment')!= ''){ 
echo '<div class="col-xs-12 col-center-block">
<div class="box box-info box-solid">
<div class="box-header with-border text-center">
    <h3 class="box-title">
      <b>';   
        $msg_assesment = $this->session->flashdata('msg_assesment');                     
        echo $msg_assesment;                                        
        unset($msg_assesment);                        
echo '</b>                
    </h3>
    <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>               
</div>
</div>
</div>';        
}else{
    $msg_assesment = $this->session->flashdata('msg_assesment');                                                
    unset($msg_assesment); 
}

?>
<div class="col-md-12"> 
    <form action="#" method="POST">
    <h3>Written Assesment&nbsp; &nbsp; &nbsp;<button type="button" class="btn btn-flat bg-light-blue color-palette btn-sm" data-toggle="modal" data-target="#FormSearch_written">Search</button>    
    &nbsp;<button type="submit" class="btn btn-flat bg-light-blue color-palette btn-sm">Reset</button></h3>
    </form>             
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="written_assesment">
		<thead>
			<tr>
				<th width="3%">No</th>
                <th width="7%">Tanggal</th>
				<th width="10%">Request number</th>
                <th width="10%">Personnel number</th>
				<th width="18%">Employee name</th>                
                <th width="5%">Sesi</th>
                <th width="10%">Room</th>
				<th width="20%">Assessment scope</th>
                <th width="10%">PIC</th>
				<th width="5%">Score</th>
                <th width="5%">Result</th>
                <th width="10%">Note</th>
				<th width="5%">Action</th>
			</tr>
		</thead>
	</table>
    </div> 
<div class="col-md-12">
    <form action="#" method="POST">
    <h3>Oral Assesment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-flat bg-light-blue color-palette btn-sm" data-toggle="modal" data-target="#FormSearch_oral">Search</button>
    &nbsp;<button type="submit" class="btn btn-flat bg-light-blue color-palette btn-sm">Reset</button></h3>
    </form>        
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel_bootstrap" id="oral_assesment">
		<thead>
			<tr>
				<th width="3%">No</th>
                <th width="7%">Tanggal</th>
				<th width="10%">Request number</th>
                <th width="10%">Personnel number</th>
				<th width="18%">Employee name</th>                
                <th width="5%">Sesi</th>
                <th width="10%">Room</th>
				<th width="20%">Assessment scope</th>
                <th width="10%">PIC</th>
				<th width="5%">Score</th>
                <th width="5%">Result</th>
                <th width="10%">Note</th>
				<th width="5%">Action</th>
			</tr>
		</thead>
	</table>
</div>
</div>
<script type="text/javascript">
$('#tab-search-written').change(function(){            
    var tab_search_written = $(this).val();                             
    $.get("<?php echo base_url();?>index.php/assesment/get_tab_search/" + tab_search_written , function(data, status){                 
        $("#box-type-search-written").html(data);
    });
});

$('#tab-search-oral').change(function(){            
    var tab_search_oral = $(this).val();                             
    $.get("<?php echo base_url();?>index.php/assesment/get_tab_search/" + tab_search_oral , function(data, status){                 
        $("#box-type-search-oral").html(data);
    });
});
    
$('.add-box-written').click(function(){    
        var n_search_written          = $('.box-number-search-written').length+1;
 		var tab_search_written        = $('#tab-search-written :selected').val();
 		var tab_search_written_text   = $('#tab-search-written :selected').text();
        var input_tab_search_written  = $('#input-tab-search-written').val();          
                                                           
        var box_html_authorization_search_written = $('<tr class="text-authorization-written">' +                            
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_search_written_text + '" disabled/></td>' +
                            '<td><input name="'+ tab_search_written +'" type="hidden" value="' + input_tab_search_written + '"/><input name="" class="form-control input-sm col-sm-12" type="text" value="' + input_tab_search_written + '" disabled/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-search-written">' + n_search_written + 
                            '</span><a class="remove-box-search-written btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_search_written.hide();
        $('tr.text-authorization-written:last').before(box_html_authorization_search_written);  			            
        $('#tab-search-written')[0].selectedIndex = 0;
        $('#input-tab-search-written').val('');         
        box_html_authorization_search_written.fadeIn('slow');
        return true;
    });
        
    $('.data-search-authorization-written').on('click', '.remove-box-search-written', function(){
                $(this).parent().parent().css( 'background-color', '#FF6C6C' );
                    $(this).parent().fadeOut("slow", function() {
                        $(this).parent().remove();
                            $('.box-number-search-written').each(function(index){
                                $(this).text( index + 1 );
                            });
                        });
                return true;
    });   

$('.add-box-oral').click(function(){    
        var n_search_oral          = $('.box-number-search-oral').length+1;
 		var tab_search_oral        = $('#tab-search-oral :selected').val();
 		var tab_search_oral_text   = $('#tab-search-oral :selected').text();
        var input_tab_search_oral  = $('#input-tab-search-oral').val();          
                                                           
        var box_html_authorization_search_oral = $('<tr class="text-authorization-oral">' +                            
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_search_oral_text + '" disabled/></td>' +
                            '<td><input name="'+ tab_search_oral +'" type="hidden" value="' + input_tab_search_oral + '"/><input name="" class="form-control input-sm col-sm-12" type="text" value="' + input_tab_search_oral + '" disabled/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-search-oral">' + n_search_oral + 
                            '</span><a class="remove-box-search-oral btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_search_oral.hide();
        $('tr.text-authorization-oral:last').before(box_html_authorization_search_oral);  			            
        $('#tab-search-oral')[0].selectedIndex = 0;
        $('#input-tab-search-oral').val('');         
        box_html_authorization_search_oral.fadeIn('slow');
        return true;
    });
        
    $('.data-search-authorization-oral').on('click', '.remove-box-search-oral', function(){
                $(this).parent().parent().css( 'background-color', '#FF6C6C' );
                    $(this).parent().fadeOut("slow", function() {
                        $(this).parent().remove();
                            $('.box-number-search-oral').each(function(index){
                                $(this).text( index + 1 );
                            });
                        });
                return true;
    });         

</script>

