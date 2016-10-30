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
    $('.hidden-page, #etops').hide();
    $('div[name=tab-type]').hide();    
        $('div[name=tab-authorization]').hide();
        $('div[name=tab-customer-authorization],div[name=tab-authorization-garuda],div[name=tab-authorization-citilink],div[name=tab-authorization-sriwijaya]').hide();
        $('div[name=tab-add-authorization]').hide();        
        $('div[name=tab-type-easa]').hide(); 
        $('div[name=tab-add-easa-authorization]').hide(); 
        $('div[name=tab-add-special-authorization]').hide();   
        $('div[name=tab-add-cofc-authorization]').hide();
        $('div[name=tab-add-customer-authorization],div[name=tab-add-garuda-authorization],div[name=tab-add-citilink-authorization],div[name=tab-add-sriwijaya-authorization]').hide();                   
        $('[name=tab_page_1],[name=tab_page_2],[name=tab_page_3],[name=tab_page_4]').hide('slow');
        $('#tab_1,#tab_2,#tab_3,#tab_4').hide('slow');          
    
        $('.check_add_license').change(function() {
        if(!$('[name=check_easa]').is(':checked')){   
             $('[name=tab_page_1]').hide('slow');                           
            };
        if(!$('[name=check_special]').is(':checked')){ 
            $('[name=tab_page_2]').hide('slow');
            };
        if(!$('[name=check_customer_authorization]').is(':checked')){   
            $('[name=tab_page_3]').hide('slow');                                        
            };
        if(!$('[name=check_c_of_c]').is(':checked')){   
            $('[name=tab_page_4]').hide('slow');                                         
            };            
         });

        $('[name=check_easa]').change(function() {
            if(this.checked) {
                 $('div[name=tab-type-easa]').show('slow');
                 $('[name=tab_page_1]').show('slow');                 
                 $('[name=tab_page_2],[name=tab_page_3],[name=tab_page_4],#tab_2,#tab_3,#tab_4').removeClass('active');
                 $('[name=tab_page_1],#tab_1').addClass('active'); 
                 $('#tab_1').show('slow');                                                 
            }else{
                $('div[name=tab-type-easa]').hide('slow');
                $('[name=tab-add-easa-authorization]').hide('slow');                
                $('[name=tab_page_1],#tab_1').removeClass('active');  
                $('[name=tab_page_1]').hide('slow');
                $('#tab_1').hide('slow');  
                    if(!$('[name=check_easa],[name=check_special],[name=check_customer_authorization],[name=check_c_of_c]').is(':checked')){   
                            $('.hidden-page').hide('slow');                             
                    }                 
                }
            });            
            
        $('[name=check_special]').change(function() {
                if(this.checked) {
                 $('div[name=tab-add-special-authorization]').show('slow');
                 $('[name=tab_page_2]').show('slow');                 
                 $('[name=tab_page_1],[name=tab_page_3],[name=tab_page_4],#tab_1,#tab_3,#tab_4').removeClass('active');
                 $('[name=tab_page_2],#tab_2').addClass('active');
                 $('#tab_2').show('slow');                
            }else{
                $('div[name=tab-add-special-authorization]').hide('slow');                
                $('[name=tab_page_2],#tab_2').removeClass('active');
                $('[name=tab_page_2]').hide('slow');
                $('#tab_2').hide('slow');
                if(!$('[name=check_easa],[name=check_special],[name=check_customer_authorization],[name=check_c_of_c]').is(':checked')){   
                            $('.hidden-page').hide('slow');                             
                    }
                }
            });
            
        $('[name=check_customer_authorization]').change(function() {
            if(this.checked) {
                 $('div[name=tab-type-customer]').show('slow');
                 $('[name=tab_page_3]').show('slow');                 
                 $('[name=tab_page_1],[name=tab_page_2],[name=tab_page_4],#tab_1,#tab_2,#tab_4').removeClass('active');
                 $('[name=tab_page_3],#tab_3').addClass('active');
                 $('#tab_3').show('slow');                                               
            }else{
                $('div[name=tab-type-customer]').hide('slow');
                $('[name=tab-add-customer-authorization]').hide('slow');                
                $('[name=tab_page_3],#tab_3').removeClass('active');
                $('[name=tab_page_3]').hide('slow');
                $('#tab_3').hide('slow');
                if(!$('[name=check_easa],[name=check_special],[name=check_customer_authorization],[name=check_c_of_c]').is(':checked')){   
                            $('.hidden-page').hide('slow');                             
                    }
                }
            });  
            
        $('[name=check_c_of_c]').change(function() {
            if(this.checked) {
                 $('div[name=tab-type-cofc]').show('slow');                 
                 $('[name=tab_page_4]').show('slow');                 
                 $('[name=tab_page_1],[name=tab_page_2],[name=tab_page_3],#tab_1,#tab_2,#tab_3').removeClass('active');
                 $('[name=tab_page_4],#tab_4').addClass('active');
                 $('#tab_4').show('slow');                              
            }else{
                $('div[name=tab-type-cofc]').hide('slow');
                $('[name=tab-add-cofc-authorization]').hide('slow');                
                $('[name=tab_page_4],#tab_4').removeClass('active');
                $('[name=tab_page_4]').hide('slow');
                $('#tab_4').hide('slow');
                if(!$('[name=check_easa],[name=check_special],[name=check_customer_authorization],[name=check_c_of_c]').is(':checked')){   
                            $('.hidden-page').hide('slow');                             
                    }
                }
            });            
            
        // tab-license
        $('input[name=license]').click(function(){            
            var license = $(this).val();
            $('option[name=category]').val('');
            $('option[name=scope]').val(''); 
            $.get("<?php echo base_url();?>index.php/apply_license/get_license/" + license , function(data, status){
                //alert("Data: " + data + "\nStatus: " + status);
                $('#tab-type').html(data);
            });
            
            if(this.checked){
                    $('div[name=tab-type]').show('slow');
                    $('div[name=tab-authorization]').hide('slow');  
                    $('div[name=tab-customer-authorization]').hide('slow');
                    $('div[name=tab-add-authorization]').hide('slow');  
                    $('div[name=tab-add-easa-authorization]').hide('slow');
                    $('div[name=tab-add-special-authorization]').hide('slow');
                    $('[name=tab-authorization-garuda]').hide('slow');
                    $('[name=tab-authorization-citilink]').hide('slow');
                    $('[name=tab-authorization-sriwijaya]').hide('slow');  
                    $('div.hidden-page').hide('slow');                     
                    $('[name=check_easa]').prop( "checked", false );
                    $('[name=check_special]').prop( "checked", false );
                };
                if($('[id=license_2], [id=type_6]').checked) {
                    $('div[name=tab-add-authorization]').show('slow');
                    }else{
                    $('div[name=tab-add-authorization]').hide('slow');
                    $('div[name=tab-type-easa]').hide('slow');
                    $('div[name=tab-add-easa-authorization]').hide('slow');  
                    $('div[name=tab-add-special-authorization]').hide('slow'); 
                };                                                                                                                                                                      
                });
        
    $('[name=check_easa]').change(function() {
            if(this.checked) {
                var check_easa = $('[name=check_easa]:checked').val();            
                var type_easa = $('.type:checked').val();            
                $.get("<?php echo base_url();?>index.php/apply_license/get_license_easa/" + check_easa  + "/" + type_easa, function(data, status){                
                    $('#tab-type-easa').html(data);
                });               
                $('tr.text-easa-authorization#field-data-easa').remove(); 
                $('div.hidden-page').show('slow'); 
                $('[name=tab_1]').show('slow');                  
            };
    }); 
    
    $('[name=check_special]').change(function() {
        if(this.checked) {   
        var check_special = $(this).val();
        $.get("<?php echo base_url();?>index.php/apply_license/get_type_special/" + check_special , function(data, status){                
            $('#tab-spec-special').html(data);
        });
        $('tr.text-special-authorization#field-data-special').remove();            
        $('.category_special').empty();
        $('.scope_special').empty();   
        $('div.hidden-page').show('slow'); 
        $('[name=tab_2]').show('slow');  
        };        
    });
    
    $('[name=check_customer_authorization]').change(function() {
        if(this.checked) {                   
        var check_customer_authorization = $(this).val();                                   
        $.get("<?php echo base_url();?>index.php/apply_license/get_license_customer/" + check_customer_authorization, function(data, status){                
            $('#tab-type-customer').html(data);
        });               
        $('tr.text-customer-authorization#field-data-customer').remove(); 
        $('div.hidden-page').show('slow'); 
        $('[name=tab_3]').show('slow');         
        };        
    });
        
    $('[name=check_c_of_c]').change(function() {
        if(this.checked) {               
            var check_cofc_authorization = $(this).val();                                   
            $.get("<?php echo base_url();?>index.php/apply_license/get_license_cofc/" + check_cofc_authorization, function(data, status){                
                $('#tab-type-cofc').html(data);
            });               
            $('tr.text-cofc-authorization#field-data-cofc').remove(); 
            $('div.hidden-page').show('slow'); 
            $('[name=tab_4]').show('slow'); 
        };        
    });           
         
        $('.tab-authorization .add-box').click(function(){             
            var n_authorization     = $('.box-number-data-authorization').length + 1; 
            var tab_spec            = $('#tab-spec :selected').val();
            var tab_spec_text       = $('#tab-spec :selected').text();        
            var tab_category        = $('#tab-category :selected').val();
            var tab_category_text   = $('#tab-category :selected').text();        
            var tab_scope           = $('#tab-scope :selected').val();
            var tab_scope_text      = $('#tab-scope :selected').text();
            var tab_scope_assesment = $('input#tab-scope-assesment').val();
                if($('#etops').is(':checked')){
                        var etops  = '1';
                        var check_etops = 'checked';
                    }else if(!$('#etops').is(':checked')){
                        var etops  = '';
                        var check_etops = '';
                    }  
              
                var box_html_authorization = $('<tr class="text-authorization" id="field-data-authorization">' +
                                    '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_text + '" readonly/><input name="tab-spec[]" type="hidden" value="' + tab_spec + '"/></td>' +
                                    '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_text + '" readonly/><input name="tab-category[]" type="hidden" value="' + tab_category + '"/></td>' +
                                    '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_text + '" readonly/><input name="tab-scope[]" type="hidden" value="' + tab_scope + '"/><input name="tab-scope-assesment[]" type="hidden" value="' + tab_scope_assesment + '"/></td>' +  
                                    '<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops +' disabled/><input type="hidden" name="etops[]" '+ check_etops +' value="' + etops + '"/></td>' +                                                                                                   
                                    '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-data-authorization">' + n_authorization + 
                                    '</span><a class="remove-box btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                                    '</tr>');
                                                                                                                                                                             
                box_html_authorization.hide();
                $('.tab-authorization tr.text-authorization:last').before(box_html_authorization); 
                $('#tab-spec')[0].selectedIndex = 0;
                $('#tab-category').empty();
                $('#tab-scope').empty();  
                box_html_authorization.fadeIn('slow');
                $('#etops').attr('checked',false);
                return true; 

            });
            $('.tab-authorization').on('click', '.remove-box', function(){
                $(this).parent().parent().css( 'background-color', '#FF6C6C' );
                    $(this).parent().fadeOut("slow", function() {
                        $(this).parent().remove();
                            $('.box-number-data-authorization').each(function(index){
                                $(this).text( index + 1 );
                            });
                        });
                    return true;
            });
        
        $('.tab-add-easa-authorization .add-easa-box').click(function(){ 
        var n_easa_authorization    = $('.box-number-easa').length + 1; 
 		var tab_spec_easa           = $('#tab-spec-easa :selected').val();
 		var tab_spec_easa_text      = $('#tab-spec-easa :selected').text();        
        var tab_category_easa       = $('#tab-category-easa :selected').val();
 		var tab_category_easa_text  = $('#tab-category-easa :selected').text();        
        var tab_scope_easa          = $('#tab-scope-easa :selected').val();
 		var tab_scope_easa_text     = $('#tab-scope-easa :selected').text();
        var tab_scope_assesment_easa= $('input#tab-scope-assesment-easa').val(); 
        if($('#etops_easa').is(':checked')){
                        var etops_easa  = '1';
                        var check_etops_easa = 'checked';
                    }else if(!$('#etops_easa').is(':checked')){
                        var etops_easa  = '';
                        var check_etops_easa = '';
                    }         
            
            var box_html_authorization_easa = $('<tr class="text-easa-authorization" id="field-data-easa">' +
                                '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_easa_text + '" readonly/><input name="tab-spec-easa[]" type="hidden" value="' + tab_spec_easa + '"/></td>' +
                                '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_easa_text + '" readonly/><input name="tab-category-easa[]" type="hidden" value="' + tab_category_easa + '"/></td>' +
                                '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_easa_text + '" readonly/><input name="tab-scope-easa[]" type="hidden" value="' + tab_scope_easa + '"/><input name="tab-scope-assesment-easa[]" type="hidden" value="' + tab_scope_assesment_easa + '"/></td>' +  
                                    '<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops_easa +' disabled/><input type="hidden" name="etops-easa[]" '+ check_etops_easa +' value="' + etops_easa + '"/></td>' +                                                                 
                                '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-easa">' + n_easa_authorization + 
                                '</span><a class="remove-box-easa btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                                '</tr>');
                                                                                                                                                                         
            box_html_authorization_easa.hide();
            $('.tab-add-easa-authorization tr.text-easa-authorization:last').before(box_html_authorization_easa);
            $('#tab-spec-easa')[0].selectedIndex = 0;            
 			$('#tab-category-easa').empty();
 			$('#tab-scope-easa').empty(); 
            box_html_authorization_easa.fadeIn('slow');
            return true;
        });
                                                                            
    $('.tab-add-easa-authorization').on('click', '.remove-box-easa', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-easa').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    });
        
    $('.tab-add-special-authorization .add-box-special').click(function(){ 
        var n_special_authorization = $('.box-number-special').length + 1; 
 		var tab_spec_special        = $('#tab-spec-special :selected').val();
 		var tab_spec_special_text   = $('#tab-spec-special :selected').text();        
        var tab_category_special      = $('#tab-category-special :selected').val();
 		var tab_category_special_text  = $('#tab-category-special :selected').text();        
        var tab_scope_special       = $('#tab-scope-special :selected').val();
 		var tab_scope_special_text  = $('#tab-scope-special :selected').text();
        var tab_scope_assesment_special  = $('input#tab-scope-assesment-special').val(); 
        if($('#etops_special').is(':checked')){
                        var etops_special  = '1';
                        var check_etops_special = 'checked';
                    }else if(!$('#etops_special').is(':checked')){
                        var etops_special  = '';
                        var check_etops_special = '';
                    }    
        
            
        var box_html_authorization_special = $('<tr class="text-special-authorization" id="field-data-special">' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_special_text + '" readonly/><input name="tab-spec-special[]" type="hidden" value="' + tab_spec_special + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_special_text + '" readonly/><input name="tab-category-special[]" type="hidden" value="' + tab_category_special + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_special_text + '" readonly/><input name="tab-scope-special[]" type="hidden" value="' + tab_scope_special + '"/><input name="tab-scope-assesment-special[]" type="hidden" value="' + tab_scope_assesment_special + '"/></td>' +  
                                    '<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops_special +' disabled/><input type="hidden" name="etops-special[]" '+ check_etops_special +' value="' + etops_special + '"/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-special">' + n_special_authorization + 
                            '</span><a class="remove-box-special btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_special.hide();
        $('.tab-add-special-authorization tr.text-special-authorization:last').before(box_html_authorization_special);  			            
        $('#tab-spec-special')[0].selectedIndex = 0;
        $('#tab-category-special').empty();
        $('#tab-scope-special').empty(); 
        box_html_authorization_special.fadeIn('slow');
        return true;
    });
                                                                        
    $('.tab-add-special-authorization').on('click', '.remove-box-special', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-special').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    });
    
     // Garuda Specification
        $('.tab-authorization-garuda .add-license-garuda-box').click(function(){ 
        var n_license_garuda_authorization   = $('.box-number-data-license-garuda').length + 1; 
 		var tab_spec_license_garuda          = $('#tab-spec-license-garuda :selected').val();
 		var tab_spec_license_garuda_text     = $('#tab-spec-license-garuda :selected').text();        
        var tab_category_license_garuda      = $('#tab-category-license-garuda :selected').val();
 		var tab_category_license_garuda_text = $('#tab-category-license-garuda :selected').text();        
        var tab_scope_license_garuda         = $('#tab-scope-license-garuda :selected').val();
 		var tab_scope_license_garuda_text    = $('#tab-scope-license-garuda :selected').text(); 
        var tab_scope_assesment_license_garuda = $('input#tab-scope-assesment-customer-garuda').val();
            if($('#etops_license_garuda').is(':checked')){
                    var etops_license_garuda  = '1';
                    var check_etops_license_garuda = 'checked';
                }else if(!$('#etops_license_garuda').is(':checked')){
                    var etops_license_garuda  = '';
                    var check_etops_license_garuda = '';
                }                  
       
            
        var box_html_authorization_license_garuda = $('<tr class="text-license-garuda" id="field-data-license-garuda">' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_license_garuda_text + '" readonly/><input name="tab-spec-license-garuda[]" type="hidden" value="' + tab_spec_license_garuda + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_license_garuda_text + '" readonly/><input name="tab-category-license-garuda[]" type="hidden" value="' + tab_category_license_garuda + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_license_garuda_text + '" readonly/><input name="tab-scope-license-garuda[]" type="hidden" value="' + tab_scope_license_garuda + '"/><input name="tab-scope-assesment-license-garuda[]" type="hidden" value="' + tab_scope_assesment_license_garuda + '"/></td>' +'<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops_license_garuda +' disabled/><input type="hidden" name="etops-license-garuda[]" '+ check_etops_license_garuda +' value="' + etops_license_garuda + '"/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-license-garuda">' + n_license_garuda_authorization + 
                            '</span><a class="remove-box-license-garuda btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_license_garuda.hide();
        $('.tab-authorization-garuda tr.text-license-garuda:last').before(box_html_authorization_license_garuda);  			            
        $('#tab-spec-license-garuda')[0].selectedIndex = 0;
        $('#tab-category-license-garuda').empty();
        $('#tab-scope-license-garuda').empty(); 
        box_html_authorization_license_garuda.fadeIn('slow');
        return true;
    });
                                                                        
    $('.tab-authorization-garuda').on('click', '.remove-box-license-garuda', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-license-garuda').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    }); 
    
    // Citilink Specification
    $('.tab-authorization-citilink .add-license-citilink-box').click(function(){ 
        var n_license_citilink_authorization = $('.box-number-data-license-citilink').length + 1; 
 		var tab_spec_license_citilink        = $('#tab-spec-license-citilink :selected').val();
 		var tab_spec_license_citilink_text   = $('#tab-spec-license-citilink :selected').text();        
        var tab_category_license_citilink      = $('#tab-category-license-citilink :selected').val();
 		var tab_category_license_citilink_text  = $('#tab-category-license-citilink :selected').text();        
        var tab_scope_license_citilink       = $('#tab-scope-license-citilink :selected').val();
 		var tab_scope_license_citilink_text  = $('#tab-scope-license-citilink :selected').text();
        var tab_scope_assesment_license_citilink = $('input#tab-scope-assesment-customer-citilink').val(); 
            if($('#etops_license_citilink').is(':checked')){
                    var etops_license_citilink  = '1';
                    var check_etops_license_citilink = 'checked';
                }else if(!$('#etops_license_citilink').is(':checked')){
                    var etops_license_citilink  = '';
                    var check_etops_license_citilink = '';
                }
       
            
        var box_html_authorization_license_citilink = $('<tr class="text-licens-citilink" id="field-data-license-citilink">' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_license_citilink_text + '" readonly/><input name="tab-spec-license-citilink[]" type="hidden" value="' + tab_spec_license_citilink + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_license_citilink_text + '" readonly/><input name="tab-category-license-citilink[]" type="hidden" value="' + tab_category_license_citilink + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_license_citilink_text + '" readonly/><input name="tab-scope-license-citilink[]" type="hidden" value="' + tab_scope_license_citilink + '"/><input name="tab-scope-assesment-license-citilink[]" type="hidden" value="' + tab_scope_assesment_license_citilink + '"/></td>' +'<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops_license_citilink +' disabled/><input type="hidden" name="etops-license-citilink[]" '+ check_etops_license_citilink +' value="' + etops_license_citilink + '"/></td>' + '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-data-license-citilink">' + n_license_citilink_authorization + 
                            '</span><a class="remove-box-license-citilink btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_license_citilink.hide();
        $('.tab-authorization-citilink tr.text-license-citilink:last').before(box_html_authorization_license_citilink);  		            
        $('#tab-spec-license-citilink')[0].selectedIndex = 0;
        $('#tab-category-license-citilink').empty();
        $('#tab-scope-license-citilink').empty(); 
        box_html_authorization_license_citilink.fadeIn('slow');
        return true;
    });
                                                                        
    $('.tab-authorization-citilink').on('click', '.remove-box-license-citilink', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-data-license-citilink').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    }); 
    
    
    // Sriwijaya Specification
    $('.tab-authorization-sriwijaya .add-license-sriwijaya-box').click(function(){ 
        var n_license_sriwijaya_authorization = $('.box-number-data-license-sriwijaya').length + 1; 
 		var tab_spec_license_sriwijaya        = $('#tab-spec-license-sriwijaya :selected').val();
 		var tab_spec_license_sriwijaya_text   = $('#tab-spec-license-sriwijaya :selected').text();        
        var tab_category_license_sriwijaya      = $('#tab-category-license-sriwijaya :selected').val();
 		var tab_category_license_sriwijaya_text  = $('#tab-category-license-sriwijaya :selected').text();        
        var tab_scope_license_sriwijaya       = $('#tab-scope-license-sriwijaya :selected').val();
 		var tab_scope_license_sriwijaya_text  = $('#tab-scope-license-sriwijaya :selected').text(); 
        var tab_scope_assesment_license_sriwijaya = $('input#tab-scope-assesment-customer-sriwijaya').val();
            if($('#etops_license_sriwijaya').is(':checked')){
                        var etops_license_sriwijaya  = '1';
                        var check_etops_license_sriwijaya = 'checked';
                    }else if(!$('#etops_license_sriwijaya').is(':checked')){
                        var etops_license_sriwijaya  = '';
                        var check_etops_license_sriwijaya = '';
                    }
            
        var box_html_authorization_license_sriwijaya = $('<tr class="text-license-sriwijaya" id="field-data-license-sriwijaya">' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_license_sriwijaya_text + '" readonly/><input name="tab-spec-license-sriwijaya[]" type="hidden" value="' + tab_spec_license_sriwijaya + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_license_sriwijaya_text + '" readonly/><input name="tab-category-license-sriwijaya[]" type="hidden" value="' + tab_category_license_sriwijaya + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_license_sriwijaya_text + '" readonly/><input name="tab-scope-license-sriwijaya[]" type="hidden" value="' + tab_scope_license_sriwijaya + '"/><input name="tab-scope-assesment-license-sriwijaya[]" type="hidden" value="' + tab_scope_assesment_license_sriwijaya + '"/></td>' +'<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops_license_sriwijaya +' disabled/><input type="hidden" name="etops-license-sriwijaya[]" '+ check_etops_license_sriwijaya +' value="' + etops_license_sriwijaya + '"/></td>' + '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-data-license-sriwijaya">' + n_license_sriwijaya_authorization + 
                            '</span><a class="remove-box-license-sriwijaya btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_license_sriwijaya.hide();
        $('.tab-authorization-sriwijaya tr.text-license-sriwijaya:last').before(box_html_authorization_license_sriwijaya);  			            
        $('#tab-spec-license-sriwijaya')[0].selectedIndex = 0;
        $('#tab-category-license-sriwijaya').empty();
        $('#tab-scope-license-sriwijaya').empty(); 
        box_html_authorization_license_sriwijaya.fadeIn('slow');
        return true;
    });
                                                                        
    $('.tab-authorization-sriwijaya').on('click', '.remove-box-license-sriwijaya', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-data-license-sriwijaya').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    });
    

    // Garuda Add Specification
        $('.tab-add-garuda-authorization .add-garuda-box').click(function(){ 
        var n_garuda_authorization = $('.box-number-garuda').length + 1; 
 		var tab_spec_garuda        = $('#tab-spec-garuda :selected').val();
 		var tab_spec_garuda_text   = $('#tab-spec-garuda :selected').text();        
        var tab_category_garuda      = $('#tab-category-garuda :selected').val();
 		var tab_category_garuda_text  = $('#tab-category-garuda :selected').text();        
        var tab_scope_garuda       = $('#tab-scope-garuda :selected').val();
 		var tab_scope_garuda_text  = $('#tab-scope-garuda :selected').text(); 
        var tab_scope_assesment_garuda  = $('input#tab-scope-assesment-customer-garuda').val();
        if($('#etops_garuda').is(':checked')){
                        var etops_garuda  = '1';
                        var check_etops_garuda = 'checked';
                    }else if(!$('#etops_citilink').is(':checked')){
                        var etops_garuda  = '';
                        var check_garuda = '';
                    }
       
            
        var box_html_authorization_garuda = $('<tr class="text-garuda-authorization" id="field-data-garuda">' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_garuda_text + '" readonly/><input name="tab-spec-garuda[]" type="hidden" value="' + tab_spec_garuda + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_garuda_text + '" readonly/><input  name="tab-category-garuda[]" type="hidden" value="' + tab_category_garuda + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_garuda_text + '" readonly/><input name="tab-scope-garuda[]" type="hidden" value="' + tab_scope_garuda + '"/><input name="tab-scope-assesment-garuda[]" type="hidden" value="' + tab_scope_assesment_garuda + '"/></td>' +'<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops_garuda +' disabled/><input type="hidden" name="etops-garuda[]" '+ check_etops_garuda +' value="' + etops_garuda + '"/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-garuda">' + n_garuda_authorization + 
                            '</span><a class="remove-box-garuda btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_garuda.hide();
        $('.tab-add-garuda-authorization tr.text-garuda-authorization:last').before(box_html_authorization_garuda);  			            
        $('#tab-spec-garuda')[0].selectedIndex = 0;
        $('#tab-category-garuda').empty();
        $('#tab-scope-garuda').empty(); 
        box_html_authorization_garuda.fadeIn('slow');
        return true;
    });
                                                                        
    $('.tab-add-garuda-authorization').on('click', '.remove-box-garuda', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-garuda').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    }); 
    
    // Citilink Add Specification
    $('.tab-add-citilink-authorization .add-citilink-box').click(function(){ 
        var n_citilink_authorization = $('.box-number-citilink').length + 1; 
 		var tab_spec_citilink        = $('#tab-spec-citilink :selected').val();
 		var tab_spec_citilink_text   = $('#tab-spec-citilink :selected').text();        
        var tab_category_citilink      = $('#tab-category-citilink :selected').val();
 		var tab_category_citilink_text  = $('#tab-category-citilink :selected').text();        
        var tab_scope_citilink       = $('#tab-scope-citilink :selected').val();
 		var tab_scope_citilink_text  = $('#tab-scope-citilink :selected').text(); 
       var tab_scope_assesment_citilink  = $('input#tab-scope-assesment-customer-citilink').val();
       if($('#etops_citilink').is(':checked')){
                        var etops_citilink  = '1';
                        var check_etops_citilink = 'checked';
                    }else if(!$('#etops_citilink').is(':checked')){
                        var etops_citilink  = '';
                        var check_etops_citilink = '';
                    }
            
        var box_html_authorization_citilink = $('<tr class="text-citilink-authorization" id="field-data-citilink">' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_citilink_text + '" readonly/><input name="tab-spec-citilink[]" type="hidden" value="' + tab_spec_citilink + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_citilink_text + '" readonly/><input name="tab-category-citilink[]" type="hidden" value="' + tab_category_citilink + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_citilink_text + '" readonly/><input name="tab-scope-citilink[]" type="hidden" value="' + tab_scope_citilink + '"/><input name="tab-scope-assesment-citilink[]" type="hidden" value="' + tab_scope_assesment_citilink + '"/></td>' +'<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops_citilink +' disabled/><input type="hidden" name="etops-citilink[]" '+ check_etops_citilink +' value="' + etops_citilink + '"/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-citilink">' + n_citilink_authorization + 
                            '</span><a class="remove-box-citilink btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_citilink.hide();
        $('.tab-add-citilink-authorization tr.text-citilink-authorization:last').before(box_html_authorization_citilink);  			            
        $('#tab-spec-citilink')[0].selectedIndex = 0;
        $('#tab-category-citilink').empty();
        $('#tab-scope-citilink').empty(); 
        box_html_authorization_citilink.fadeIn('slow');
        return true;
    });
                                                                        
    $('.tab-add-citilink-authorization').on('click', '.remove-box-citilink', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-citilink').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    }); 
    
    
    // Sriwijaya Add Specification
    $('.tab-add-sriwijaya-authorization .add-sriwijaya-box').click(function(){ 
        var n_sriwijaya_authorization = $('.box-number-sriwijaya').length + 1; 
 		var tab_spec_sriwijaya        = $('#tab-spec-sriwijaya :selected').val();
 		var tab_spec_sriwijaya_text   = $('#tab-spec-sriwijaya :selected').text();        
        var tab_category_sriwijaya      = $('#tab-category-sriwijaya :selected').val();
 		var tab_category_sriwijaya_text  = $('#tab-category-sriwijaya :selected').text();        
        var tab_scope_sriwijaya       = $('#tab-scope-sriwijaya :selected').val();
 		var tab_scope_sriwijaya_text  = $('#tab-scope-sriwijaya :selected').text(); 
       var tab_scope_assesment_sriwijaya  = $('input#tab-scope-assesment-customer-sriwijaya').val();
       if($('#etops_sriwijaya').is(':checked')){
                        var etops_sriwijaya  = '1';
                        var check_etops_sriwijaya = 'checked';
                    }else if(!$('#etops_sriwijaya').is(':checked')){
                        var etops_sriwijaya  = '';
                        var check_etops_sriwijaya = '';
                    }
            
        var box_html_authorization_sriwijaya = $('<tr class="text-sriwijaya-authorization" id="field-data-sriwijaya">' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_sriwijaya_text + '" readonly/><input name="tab-spec-sriwijaya[]" type="hidden" value="' + tab_spec_sriwijaya + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_sriwijaya_text + '" readonly/><input name="tab-category-sriwijaya[]" type="hidden" value="' + tab_category_sriwijaya + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_sriwijaya_text + '" readonly/><input name="tab-scope-sriwijaya[]" type="hidden" value="' + tab_scope_sriwijaya + '"/><input name="tab-scope-assesment-sriwijaya[]" type="hidden" value="' + tab_scope_assesment_sriwijaya + '"/></td>' +'<td style="text-align: center;width: 10px;""><input type="checkbox" '+ check_etops_sriwijaya +' disabled/><input type="hidden" name="etops-license-sriwijaya[]" '+ check_etops_sriwijaya +' value="' + etops_sriwijaya + '"/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-sriwijaya">' + n_sriwijaya_authorization + 
                            '</span><a class="remove-box-sriwijaya btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_sriwijaya.hide();
        $('.tab-add-sriwijaya-authorization tr.text-sriwijaya-authorization:last').before(box_html_authorization_sriwijaya);  			            
        $('#tab-spec-sriwijaya')[0].selectedIndex = 0;
        $('#tab-category-sriwijaya').empty();
        $('#tab-scope-sriwijaya').empty(); 
        box_html_authorization_sriwijaya.fadeIn('slow');
        return true;
    });
                                                                        
    $('.tab-add-sriwijaya-authorization').on('click', '.remove-box-sriwijaya', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-sriwijaya').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    }); 
    
    
    // Tab add COFC Authorization
    $('.tab-add-cofc-authorization .add-cofc-box').click(function(){ 
        var n_cofc_authorization = $('.box-number-cofc').length + 1; 
 		var tab_spec_cofc        = $('#tab-spec-cofc :selected').val();
 		var tab_spec_cofc_text   = $('#tab-spec-cofc :selected').text();        
        var tab_category_cofc      = $('#tab-category-cofc :selected').val();
 		var tab_category_cofc_text  = $('#tab-category-cofc :selected').text();        
        var tab_scope_cofc       = $('#tab-scope-cofc :selected').val();
 		var tab_scope_cofc_text  = $('#tab-scope-cofc :selected').text();
        var tab_scope_assesment_cofc  = $('input#tab-scope-assesment-cofc').val();         
        
            
        var box_html_authorization_cofc = $('<tr class="text-cofc-authorization" id="field-data-cofc">' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_spec_cofc_text + '" readonly/><input name="tab-spec-cofc[]" type="hidden" value="' + tab_spec_cofc + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_category_cofc_text + '" readonly/><input name="tab-category-cofc[]" type="hidden" value="' + tab_category_cofc + '"/></td>' +
                            '<td><input type="text" class="form-control input-sm col-sm-12" value="' + tab_scope_cofc_text + '" readonly/><input name="tab-scope-cofc[]" type="hidden" value="' + tab_scope_cofc + '"/><input name="tab-scope-assesment-cofc[]" type="hidden" value="' + tab_scope_assesment_cofc + '"/></td>' +                                                                
                            '<td style="text-align: center;width: 10px;"><span style="display:none;" class="box-number-cofc">' + n_cofc_authorization + 
                            '</span><a class="remove-box-cofc btn btn-danger"><i class="fa fa-remove"></a></td>' +  
                            '</tr>');
                                                                                                                                                                     
        box_html_authorization_cofc.hide();
        $('.tab-add-cofc-authorization tr.text-cofc-authorization:last').before(box_html_authorization_cofc);  			            
        $('#tab-spec-cofc')[0].selectedIndex = 0;
        $('#tab-category-cofc').empty();
        $('#tab-scope-cofc').empty(); 
        box_html_authorization_cofc.fadeIn('slow');
        return true;
    });
                                                                        
    $('.tab-add-cofc-authorization').on('click', '.remove-box-cofc', function(){
        $(this).parent().parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).parent().remove();
                    $('.box-number-cofc').each(function(index){
                        $(this).text( index + 1 );
                    });
                });
            return true;
    });
        
    
</script> 