<?php
    if(!isset($data_personnel_information['submitpersonnelinformation'])){
        redirect('apply_license/index');
    }else
    {
?>
<div class="row">
<div class="col-md-10 col-md-offset-1 col-center-block table-responsive">
<div class="box box-info box-center" id="halaman2">
<div class="progress">
<div id="progress-step" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 30%">                                
<label>30% Completed</label>
</div>                 
</div>
	<div class="box-header with-border">
		<h3 class="box-title">AUTHORIZATION REQUEST</h3>
	</div>
        <form method="POST" action="<?php echo site_url('apply_license/authorization_request');?>" enctype="multipart/form-data" name="form_authorization_request">
		<div class="box-body">        
			<div class="panel panel-body panel-info">
                <input type="hidden" name="personnel_number" value="<?php echo $data_personnel_information['personnel_number']; ?>"/>
				<div class="col-md-3">
					<label class="radio-inline">
					<input name="status" value="1" type="radio">New Authorization</label>
				</div>
				<div class="col-md-3">
					<label class="radio-inline">
					<input name="status" value="2" type="radio">Renewal</label>
				</div>
				<div class="col-md-3">
					<label class="radio-inline">
					<input name="status" value="3" type="radio">Additional</label>
				</div>
				<div class="col-md-3">
					<label class="radio-inline">
					<input name="status" value="4" type="radio">Rating Change/ Upgrade</label>
				</div>
			</div>
			<div class="panel panel-body panel-info" id="tab-license">
				<?php foreach($auth_license as $row): ?>
                        <div class="col-md-4">
    						<label class="radio-inline">
    						<input class="license" name="license" id="license_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" type="radio"><?php echo $row->name_t; ?></label>                            
    					</div>
                <?php endforeach; ?>
			</div>
			<div class="panel panel-body panel-info" name="tab-type">
				<div id="tab-type">
                
                </div>
			</div>            
			<div class="panel panel-body panel-info tab-authorization" name="tab-authorization" id="tab-authorization">                                
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                <th style="width:10px">ETOPS</th>                                
                                <th style="text-align: center;">&nbsp;</th>
                            </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-authorization">
                      		<tr class="text-authorization">
                                <td>
                                    <select id="tab-spec" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope" class="col-md-12 form-control"> 
                                    
                                    </select>
                                    <a id="scope-assesment">
                                    </a>                                       
                                </td> 
                                <td>
                                <input type="checkbox" style="text-align: center;width:50px" id="etops"/>
                                </td>                  
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-authorization">1</span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-box" class=""><i class="fa fa-plus"></i></a>                                                             
            </div>
            <!--  -->
            <div class="panel panel-body panel-info tab-customer-authorization" name="tab-customer-authorization"> 
            <div class="panel panel-body tab-authorization-garuda" name="tab-authorization-garuda">                         
                <label>Garuda Indonesia Authorization</label>   
                <hr/>                   
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                <th style="width:10px">ETOPS</th>                                
                                <th style="text-align: center;">&nbsp;</th>                               
    				        </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-license-garuda">
                      		<tr class="text-license-garuda">
                                <td>
                                    <select id="tab-spec-license-garuda" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category-license-garuda" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope-license-garuda" class="col-md-12 form-control"> 
                                    
                                    </select> 
                                    <a id="scope-assesment-license-garuda">
                                    
                                    </a>      
                                </td>
                                <td>
                                    <input type="checkbox" style="text-align: center;width:50px" id="etops_license_garuda"/>
                                </td>  
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-license-garuda">1</span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-license-garuda-box" class=""><i class="fa fa-plus"></i></a>                                                  
            </div>             
            <div class="panel panel-body tab-authorization-citilink" name="tab-authorization-citilink">             
            <label>Citilink Indonesia Authorization</label>       
            <hr/>            
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                <th style="width:10px">ETOPS</th>                                
                                <th style="text-align: center;">&nbsp;</th>                              
    				        </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-license-citilink">
                      		<tr class="text-license-citilink">
                                <td>
                                    <select id="tab-spec-license-citilink" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category-license-citilink" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope-license-citilink"  class="col-md-12 form-control"> 
                                    
                                    </select>   
                                    <a id="scope-assesment-license-citilink">
                                    
                                    </a>    
                                </td>
                                <td>
                                    <input type="checkbox" style="text-align: center;width:50px" id="etops_license_citilink"/>
                                </td> 
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-license-citilink">1</span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-license-citilink-box" class=""><i class="fa fa-plus"></i></a>                                                  
            </div>  
            <div class="panel panel-body tab-authorization-sriwijaya" name="tab-authorization-sriwijaya"> 
            <label>Sriwijaya Authorization</label>            
            <hr/>                
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                <th style="width:10px">ETOPS</th>                                
                                <th style="text-align: center;">&nbsp;</th>                               
    				        </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-license-sriwijaya">
                      		<tr class="text-license-sriwijaya">
                                <td>
                                    <select id="tab-spec-license-sriwijaya" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category-license-sriwijaya" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope-license-sriwijaya" class="col-md-12 form-control"> 
                                    
                                    </select>
                                    <a id="scope-assesment-license-sriwijaya">
                                    
                                    </a>    
                                </td> 
                                <td>
                                    <input type="checkbox" style="text-align: center;width:50px" id="etops_license_sriwijaya"/>
                                </td> 
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-license-sriwijaya">1</span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-license-sriwijaya-box" class=""><i class="fa fa-plus"></i></a>                                                  
            </div>             
            </div>
			<!-- End Detail GMF Authorization -->
            <div class="panel panel-body panel-info" name="tab-add-authorization">  
                <div class="col-md-12">
                    <div class="col-md-3" name="col-easa">
                    <input type="checkbox" class="check_add_license" name="check_easa" value="4" /> EASA Authorization
                    </div>
                    <div class="col-md-3" name="col-special">
                    <input type="checkbox" class="check_add_license" name="check_special" value="7" /> Special Authorization
                    </div>    
                    <div class="col-md-3" name="col-cust-auth">
                    <input type="checkbox" class="check_add_license" name="check_customer_authorization" value="5" /> Customer Authorization
                    </div> 
                    <div class="col-md-3" name="col-cofc">
                    <input type="checkbox" class="check_add_license" name="check_c_of_c" value="3" /> Certificate of Competency 
                    </div>                     
                </div> 
            </div> 
            <div class="hidden-page"><!-- hidden-page -->				           
                <div class="panel panel-body panel-info" name="tabs">
				<ul id="myTab" class="nav nav-tabs">
                    <li class="active" name="tab_page_1"><a aria-expanded="true" href="#tab_1" data-toggle="tab">EASA Authorization</a></li>
                    <li class="" name="tab_page_2"><a aria-expanded="false" href="#tab_2" data-toggle="tab">Special Authorization</a></li>
                    <li class="" name="tab_page_3"><a aria-expanded="false" href="#tab_3" data-toggle="tab">Customer Authorization</a></li>
                    <li class="" name="tab_page_4"><a aria-expanded="false" href="#tab_4" data-toggle="tab">Certificate of Competency & Stamp</a></li>															
				</ul>                
            <div id="myTabContent" class="tab-content">
            <div class="tab-pane" id="tab_1">
                <div class="panel panel-body panel-info" name="tab-type-easa">
                    <div id="tab-type-easa">
                    
                    </div>
                </div>             
                <div class="panel panel-body panel-info tab-add-easa-authorization" name="tab-add-easa-authorization" id="tab-add-easa-authorization">                 				
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                    <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                    <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                    <th style="width:10px">ETOPS</th>                                
                                    <th style="text-align: center;">&nbsp;</th>                                
                                </tr>
                            </thead>
                            <div class="form-group">
                            <tbody class="data-easa-authorization">
                                <tr class="text-easa-authorization">
                                    <td>
                                        <select id="tab-spec-easa" class="col-md-12 form-control">
                      
                                        </select>                   
                                    </td>  
                                    <td>
                                        <select id="tab-category-easa" class="col-md-12 form-control">
                      
                                        </select> 
                                    </td>  
                                    <td>
                                        <select id="tab-scope-easa" class="col-md-12 form-control"> 
                                        
                                        </select>   
                                        <a id="scope-assesment-easa">
                                        
                                        </a>                    
                                    </td>
                                    <td>
                                        <input type="checkbox" style="text-align: center;width:50px" id="etops_easa"/>
                                    </td>  
                                    <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-easa"></span></td>
                                </tr>
                            </tbody>
                            </div>
                    </table>                    
                        <a class="btn btn-info pull-right add-easa-box" class=""><i class="fa fa-plus"></i></a>                                                  
                </div>  
            </div> 
            <div class="tab-pane" id="tab_2">
            <div class="panel panel-body panel-info tab-add-special-authorization" name="tab-add-special-authorization">                 				
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                <th style="width:10px">ETOPS</th>                                
                                <th style="text-align: center;">&nbsp;</th>                                
    				        </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-special-authorization">
                      		<tr class="text-special-authorization">
                                <td>
                                    <select id="tab-spec-special" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category-special" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope-special" class="col-md-12 form-control"> 
                                    
                                    </select>
                                    <a id="scope-assesment-special">
                                    
                                    </a>                        
                                </td> 
                                <td>
                                    <input type="checkbox" style="text-align: center;width:50px" id="etops_special"/>
                                </td>                                   
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-special"></span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-box-special" class=""><i class="fa fa-plus"></i></a>  
            </div> 
            </div>
            <div class="tab-pane" id="tab_3">            
			<div class="panel panel-body panel-info" name="tab-type-customer">
				<div id="tab-type-customer">
                
                </div>
			</div>             
			<div class="panel panel-body panel-info tab-add-customer-authorization" name="tab-add-customer-authorization"> 
            <div class="panel panel-body tab-add-garuda-authorization" name="tab-add-garuda-authorization">                         
                <label>Garuda Indonesia Authorization</label>   
                <hr/>                   
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                <th style="width:10px">ETOPS</th>                                
                                <th style="text-align: center;">&nbsp;</th>                                
    				        </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-garuda-authorization">
                      		<tr class="text-garuda-authorization">
                                <td>
                                    <select id="tab-spec-garuda" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category-garuda" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope-garuda" class="col-md-12 form-control"> 
                                    
                                    </select>
                                    <a id="scope-assesment-garuda">
                                    
                                    </a>    
                                </td>
                                <td>
                                    <input type="checkbox" style="text-align: center;width:50px" id="etops_garuda"/>
                                </td>                                    
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-garuda"></span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-garuda-box" class=""><i class="fa fa-plus"></i></a>                                                  
            </div>             
            <div class="panel panel-body tab-add-citilink-authorization" name="tab-add-citilink-authorization">             
            <label>Citilink Indonesia Authorization</label>       
            <hr/>            
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                <th style="width:10px">ETOPS</th>                                
                                <th style="text-align: center;">&nbsp;</th>                                
    				        </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-citilink-authorization">
                      		<tr class="text-citilink-authorization">
                                <td>
                                    <select id="tab-spec-citilink" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category-citilink" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope-citilink" class="col-md-12 form-control"> 
                                    
                                    </select> 
                                    <a id="scope-assesment-citilink">
                                    
                                    </a>  
                                </td>
                                <td>
                                    <input type="checkbox" style="text-align: center;width:50px" id="etops_citilink"/>
                                </td> 
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-citilink"></span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-citilink-box" class=""><i class="fa fa-plus"></i></a>                                                  
            </div>  
            <div class="panel panel-body tab-add-sriwijaya-authorization" name="tab-add-sriwijaya-authorization"> 
            <label>Sriwijaya Authorization</label>            
            <hr/>                
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-8">Category</label></th>
                                <th style="text-align: center;width:250px"><label class="col-md-9">Scope</label></th>
                                <th style="width:10px">ETOPS</th>                                
                                <th style="text-align: center;">&nbsp;</th>                               
    				        </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-sriwijaya-authorization">
                      		<tr class="text-sriwijaya-authorization">
                                <td>
                                    <select id="tab-spec-sriwijaya" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category-sriwijaya" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope-sriwijaya" class="col-md-12 form-control"> 
                                    
                                    </select> 
                                    <a id="scope-assesment-sriwijaya">
                                    
                                    </a>  
                                </td> 
                                <td>
                                    <input type="checkbox" style="text-align: center;width:50px" id="etops_sriwijaya"/>
                                </td> 
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-sriwijaya"></span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-sriwijaya-box" class=""><i class="fa fa-plus"></i></a>                                                  
            </div>             
            </div>
            </div> 
            
            <div class="tab-pane" id="tab_4">
			<div class="panel panel-body panel-info" name="tab-type-cofc">
				<div id="tab-type-cofc">
                
                </div>
			</div>             
			<div class="panel panel-body panel-info tab-add-cofc-authorization" name="tab-add-cofc-authorization">                 				
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:300px"><label class="col-md-9">Rating/ Spec</label></th>
                                <th style="text-align: center;width:300px"><label class="col-md-8">Category</label></th>                                
                                <th style="text-align: center;width:300px"><label class="col-md-9">Scope</label></th>                                                               
                                <th style="text-align: center;">&nbsp;</th>                                
    				        </tr>
                        </thead>
                        <div class="form-group">
                       	<tbody class="data-cofc-authorization">
                      		<tr class="text-cofc-authorization">
                                <td>
                                    <select id="tab-spec-cofc" class="col-md-12 form-control">
                  
                                    </select>                   
                                </td>  
                                <td>
                                    <select id="tab-category-cofc" class="col-md-12 form-control">
                  
                                    </select> 
                                </td>  
                                <td>
                                    <select id="tab-scope-cofc" class="col-md-12 form-control"> 
                                    
                                    </select>
                                    <a id="scope-assesment-cofc">
                                    
                                    </a>    
                                </td> 
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-cofc"></span></td>
                            </tr>
                        </tbody>
                        </div>
                </table>                    
                    <a class="btn btn-info pull-right add-cofc-box" class=""><i class="fa fa-plus"></i></a>                                                  
            </div>  
            </div>
                        
            </div>
            </div>
            </div>
        </div>        
		<div class="box-footer">
			<button type="submit" class="btn btn-info pull-right open2 btn-sm" name="submitauthorizationrequest">NEXT</button>
			<button type="button" class="btn btn-info pull-right close1 btn-sm" onClick="window.history.go(-1); return false;"name="previous">PREVIOUS</button>
		</div>
        </form>
</div>
</div>
</div>
<?php
    }
?>
<script type="text/javascript">
    var get_license                 = "<?php echo site_url().'/apply_license/get_license/'; ?>",    
        get_license_easa            = "<?php echo site_url().'/apply_license/get_license_easa/'; ?>",    
        get_type_special            = "<?php echo site_url().'/apply_license/get_type_special/'; ?>",    
        get_license_customer        = "<?php echo site_url().'/apply_license/get_license_customer/'; ?>",
        get_license_cofc            = "<?php echo site_url().'/apply_license/get_license_cofc/'; ?>"; 
</script>
<script src="<?php echo base_url('assets/plugins/js/authorization_request.js');?>" type="text/javascript"></script> 