<?php    $user_data = $this->session->userdata('users');    $personnel_number = $user_data->PERNR;         ?><script type="text/javascript"> $().ready(function(){      var personnel_number            = '<?php echo $personnel_number; ?>';    var request_number_user         = '<?php echo @$request_number_user; ?>';    var date_request                = '<?php echo @$date_request; ?>';    var employee_personnel_number   = '<?php echo $employee_personnel_number; ?>';    var name_personnel              = '<?php echo $name_personnel; ?>';    var status                      = '<?php echo $status; ?>';        //alert(request_number_user);                       $('#datatables').dataTable({		"scrollY"			: "342px",        "searching"         : false,          "select"            : true,              "scrollCollapse"	: true,		"processing" 		: true, //Feature control the processing indicator.		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.		"order" 	 		: [], //Initial no order.                		// Load data for the table's content from an Ajax source		"ajax": {			"url"	: "<?php echo site_url('home/home/get_ajax_home'); ?>",			"type"	: "POST" ,            "data"  : {                            personnel_number : personnel_number,                request_number_user : request_number_user,                date_request : date_request,                  employee_personnel_number : employee_personnel_number,                name_personnel : name_personnel,                 status : status,                                         }           		},		//Set column definition initialisation properties.		"columnDefs" : [			{ 				"targets"	: [ 0, 1, 2, 3, 4, 5], //first column / numbering column				"orderable"	: false, //set not orderable                            			},		],	}); });</script><div class="row">                  <?php                 $user_data = $this->session->userdata('users');                                                                           $sess_personnel_number = $user_data->PERNR;                $sess_employee_group = $user_data->id_employee_group;                                                                $cek_superior = $this->m_home->cek_superior($sess_personnel_number);                                                     if($this->session->flashdata('content_not_valid')!= '' || $this->session->flashdata('quality_check_schedule')!= ''){                 echo '<div class="col-xs-12 col-center-block">                <div class="box box-danger box-solid">                <div class="box-header with-border text-center">                    <h3 class="box-title">                      <b>';                           $quality_check_schedule = $this->session->flashdata('quality_check_schedule');                                     $content_not_valid = $this->session->flashdata('content_not_valid');                        echo $content_not_valid;                        echo $quality_check_schedule;                            unset($quality_check_schedule);                                            unset($content_not_valid);                                        echo '</b>                                    </h3>                    <div class="box-tools pull-right">                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>                    </div>                               </div>                </div>                </div>';                        }else{                    $content_not_valid=$this->session->flashdata('content_not_valid');                                                                    unset($content_not_valid);                 }                                ?>	<div class="col-sm-6 col-center-block table-responsive">    		<div class="box box-info">			<div class="box-header with-border">				<h3 class="box-title">INFORMATION</h3>			</div>			<div class="box-body">				<!-- div body -->				<div class="col-sm-12">					                <div id="myCarousel" class="carousel slide" data-ride="carousel">				<!--indicators-->				<ol class="carousel-indicators">					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>					<li data-target="#myCarousel" data-slide-to="1"></li>									</ol>				<!--Deklaration Carousel-->				<div class="carousel-inner" role="listbox">					<div class="item active">						<img src="<?php echo base_url();?>assets/images/slide/1.png" width="900"/>						<div class="carousel-caption">							<h3><font color="#000000">GMF</font></h3>							<p>Quality Machine</p>						</div>					</div>					<div class="item">						<img src="<?php echo base_url();?>assets/images/slide/2.png" width="900"/>						<div class="carousel-caption">							<h3><font color="#000000">GMF</font></h3>							<p>Quality Machine</p>						</div>					</div>									</div>				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">					<span class="glyphicon glyphicon-chevron-left " aria-hidden="true"></span>					<span class="sr-only">Previous</span>				</a>				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>					<span class="sr-only">Previous</span>				</a>			</div>            <br />            <br />				</div>	</div></div></div><div class="col-sm-6 col-center-block table-responsive">		<div class="box box-info">			<div class="box-header with-border">				<h3 class="box-title">My Application</h3>			</div>			<div class="box-body">				<!-- div body -->				<div class="col-sm-12">	                                                				<?php if(@$sess_employee_group == ''){ ?>                  <form method="POST" action="#" name="f_history_request_number">                                            <div class="form-group">                <label class="col-sm-5 control-label">Date request </label>                <div class="col-sm-7">                <input class="form-control " name="date_request" type="text" maxlength="50"/><br/>													                </div>                                </div>                <div class="form-group">                <label class="col-sm-5 control-label">Request Number </label>                <div class="col-sm-7">                <input class="form-control " name="request_number_user" type="text" maxlength="50" /><br/>														                </div>                                                </div>                <div class="col-sm-3 col-sm-offset-9">                                <button type="submit" name="cari_id" class="btn btn-info btn-sm"><b>SEARCH</b></button>                                </div>                             </form>                 <p>&nbsp;</p>                                                                                             <table class="table table-bordered" id="datatables">                                        <thead>                    <tr>                        						<th width="3%">No</th>                                                                                                  						<th width="50%">Request Number</th>                        <th width="27%">Date Request</th>                                                                         <th width="20%">Status</th>                                                                          					</tr>                        </thead>                                         				</table>     	        <?php }else if(@$sess_employee_group == '1'){ ?>                <form method="POST" action="#" name="f_history_request_number">                   <div class="form-group">                <label class="col-sm-5 control-label">Name </label>                <div class="col-sm-7">                <input class="form-control " name="name_personnel" type="text" maxlength="50"/><br/>													                </div>                                </div>                <div class="form-group">                <label class="col-sm-5 control-label">Personnel Number </label>                <div class="col-sm-7">                <input class="form-control " name="employee_personnel_number" type="text" maxlength="50"/><br/>													                </div>                                </div>                                                <div class="form-group">                <label class="col-sm-5 control-label">Request Number </label>                <div class="col-sm-7">                <input class="form-control " name="request_number_user" type="text" maxlength="50" /><br/>														                </div>                                                </div>                <div class="form-group">                <label class="col-sm-5 control-label">Date Request </label>                <div class="col-sm-7">                <input class="form-control " name="date_request" type="text" maxlength="50"/><br/>													                </div>                                </div>                <div class="form-group">                <label class="col-sm-5 control-label">Status </label>                <div class="col-sm-7">                <select class="form-control" name="status" type="text" maxlength="50">                    <option value="">Choose Status</option>                    <option value="1">Data submited</option>                    <option value="2">Superior approval</option>                    <option value="3">Superior rejected</option>                    <option value="4">Data validated</option>                    <option value="5">Data not validated</option>                    <option value="6">Assesment process</option>                    <option value="7">Assesment close</option>                    <option value="8">Issue authorization finish</option>                                        <option value="9">Referral authorization</option>                    <option value="10">Take authorization</option>                    <option value="11">Success</option>                </select>                <br/>													                </div>                                </div>                <div class="col-sm-3 col-sm-offset-9">                                <button type="submit" name="cari_id" class="btn btn-info btn-sm"><b>SEARCH</b></button>                                </div>                 <p>&nbsp;</p>                                                                                                                                       <table class="table table-bordered" id="datatables">                                        <thead>                    <tr>                        						<th width="2%">No</th>                        <th width="30%">Name</th>                           <th width="30%">ID Number</th>                                             						<th width="20%">Request Number</th>                        <th width="10%">Date Request</th>                                                                         <th width="8%">Status</th>                                                                          					</tr>                        </thead>                                                         </table>                 </form>                <?php } ?>                                                                        				                </div>		</div>	</div></div></div><?phpecho bootstrap_datepicker();?><script type="text/javascript">$('[name=date_request]').datepicker({   format : 'dd-mm-yyyy' });</script>