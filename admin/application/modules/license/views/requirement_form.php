<?php echo jquery_select2(); ?>
<script type="text/javascript">
$().ready(function(){
	$('[name=id_license],[name=id_type],[name=id_spect],[name=id_category],[name=id_scope],[name=id_req_spec], [name=id_req_general],[name=category_continous],[name=id_assesment_scope],[name=category_admin]').select2({width : '100%'});
});
</script>

<section class="content-header">
	<h1><?php echo $ttl?></h1>    
</section>

<?php echo form_open($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
    <?php if($ttl == 'Add Requirement Specific'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Authorization</label>
		<div class="col-sm-4">
        <select name="id_license">
            <option value="">Choose authorization</option>                                                                                
            <?php echo modules::run('license/requirement/option_authorization'); ?>
        </select>         
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
        <select name="id_type">                    

        </select> 
		</div>
	</div>  
    <div class="form-group">
        <label class="col-sm-2 control-label ">Ratting/ Spect</label>
		<div class="col-sm-4">
        <select name="id_spect">                     
        
        </select> 
		</div>
	</div>  
    <div class="form-group">
        <label class="col-sm-2 control-label ">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
        <select name="id_category"> 
            
        </select> 
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Scope&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
            <select name="id_assesment_scope">
                <?php echo modules::run('license/requirement/option_scope'); ?>
            </select> 
        </div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Assesment Scope</label>
		<div class="col-sm-4">
            <select name="id_assesment_scope">
                <?php echo modules::run('license/requirement/option_assesment_scope'); ?>
            </select> 
        </div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Requirement&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
            <select name="id_req_spec">
            <option value="">Choose requirement</option>                                                                                
            <?php echo modules::run('license/requirement/option_req_spec'); ?>
        </select> 
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Reason&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
		<div class="col-sm-4 checkbox">
            <input type="checkbox" name="new_auth" value="1"/> &nbsp;New Auth<br/>
            <input type="checkbox" name="renewal" value="1"/> &nbsp;Renewal<br/>
            <input type="checkbox" name="additional" value="1"/> &nbsp;Additional<br/>
            <input type="checkbox" name="ratting_change" value="1"/> &nbsp;Ratting Change<br/>
        </div> 
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Continous&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
            <select name="category_continous">
            <option value="">Choose category</option>
            <option value="Non Recurrent">Non Recurrent</option>
            <option value="Recurrent">Recurrent</option>
            <option value="New">New</option>
            <option value="-">-</option>
            </select> 
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Age requirement</label>
		<div class="col-sm-4">
            <input type="text" class="form-control" name="age_requirement" placeholder="Numeric"/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Category Admin</label>
		<div class="col-sm-4">
            <select name="category_admin">
            <option value="">Choose category admin</option>                                                                                
            <option value="Quality">Quality</option>
            <option value="User">User</option>            
            </select> 
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Scope Code</label>
		<div class="col-sm-4">
            <input type="text" class="form-control" name="scope_code" placeholder="Scope code"/>
		</div>
	</div>
    <?php 
    endif;
    if($ttl == 'Edit Requirement Specific'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Authorization</label>
        <div class="col-sm-4">
        <select name="id_license">
            <option value="<?php echo $rc_specific->id_license;?>"><?php echo $rc_specific->name_license;?></option>
            <?php echo modules::run('license/requirement/option_authorization'); ?>
        </select>         
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="id_type">
            <option value="<?php echo $rc_specific->id_type;?>"><?php echo $rc_specific->name_type;?></option>
            <?php echo modules::run('license/requirement/option_type'); ?>
        </select> 
        </div>
    </div>  
    <div class="form-group">
        <label class="col-sm-2 control-label ">Ratting/ Spect</label>
        <div class="col-sm-4">
            <select name="id_spect"> 
            <option value="<?php echo $rc_specific->id_spect;?>"><?php echo $rc_specific->name_spect;?></option>
            <?php echo modules::run('license/requirement/option_spect'); ?>
        </select> 
        </div>
    </div>  
    <div class="form-group">
        <label class="col-sm-2 control-label ">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="id_category"> 
            <option value="<?php echo $rc_specific->id_category;?>"><?php echo $rc_specific->name_category;?></option>
            <?php echo modules::run('license/requirement/option_category'); ?>
        </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Scope&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="id_scope">
            <option value="<?php echo $rc_specific->id_scope;?>"><?php echo $rc_specific->name_scope;?></option>
            <?php echo modules::run('license/requirement/option_scope'); ?>
        </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Assesment Scope</label>
        <div class="col-sm-4">
            <select name="id_assesment_scope">
            <option value="<?php echo $rc_specific->id_assesment_scope;?>"><?php echo $rc_specific->name_assesment_scope;?></option>                                                                                
            <?php echo modules::run('license/requirement/option_assesment_scope'); ?>
        </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Requirement&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="id_req_spec">
            <option value="<?php echo $rc_specific->id_requirement;?>"><?php echo $rc_specific->name_requirement;?></option>                                                                               
            <?php echo modules::run('license/requirement/option_req_spec'); ?>
        </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Reason&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
        <div class="col-sm-4 checkbox">
            <input type="checkbox" name="new_auth" value="1" <?php if($rc_specific->new_auth!=0){echo 'checked';}?>/> &nbsp;New Auth<br/>
            <input type="checkbox" name="renewal" value="1" <?php if($rc_specific->renewal!=0){echo 'checked';}?>/> &nbsp;Renewal<br/>
            <input type="checkbox" name="additional" value="1" <?php if($rc_specific->additional!=0){echo 'checked';}?>/> &nbsp;Additional<br/>
            <input type="checkbox" name="ratting_change" value="1" <?php if($rc_specific->ratting_change!=0){echo 'checked';}?>/> &nbsp;Ratting Change<br/>
        </div> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Continous&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="category_continous">
            <option value="<?php echo $rc_specific->category_continous;?>"><?php echo $rc_specific->category_continous;?></option>                                                        
            <option value="Non Recurrent">Non Recurrent</option>
            <option value="Recurrent">Recurrent</option>
            <option value="New">New</option>
            <option value="-">-</option>
            </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Age requirement</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="age_requirement" placeholder="Numeric" value="<?php echo $rc_specific->age_requirement;?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Category Admin</label>
        <div class="col-sm-4">
            <select name="category_admin">
            <option value="<?php echo $rc_specific->category_admin;?>"><?php echo $rc_specific->category_admin;?></option>
            <option value="Quality">Quality</option>
            <option value="User">User</option>            
            </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Scope Code</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="scope_code" placeholder="Scope code" value="<?php echo $rc_specific->scope_code;?>"/>
        </div>
    </div>
    <?php endif;    
    if($ttl == 'Add Requirement General'):?>
        <div class="form-group">
        <label class="col-sm-2 control-label ">Authorization</label>
		<div class="col-sm-4">
            <select name="id_license">
                <option value="">Choose authorization</option>
                <?php echo modules::run('license/requirement/option_authorization'); ?>
            </select> 
        </div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
            <select name="id_type">
                    
            </select> 
		</div>
	</div>  
    <div class="form-group">
        <label class="col-sm-2 control-label ">Ratting/ Spec</label>
		<div class="col-sm-4">
            <select name="id_spect"> 
            
            </select> 
		</div>
	</div>  
    <div class="form-group">
        <label class="col-sm-2 control-label ">Requirement</label>
		<div class="col-sm-4">
            <select name="id_req_general"> 
            <option value="">Choose requirement</option>                                                                               
            <?php echo modules::run('license/requirement/option_req_general'); ?>
        </select> 
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Continous&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<div class="col-sm-4">
            <select name="category_continous">
            <option value="">Choose category</option>                                                                                
            <option value="Non Recurrent">Non Recurrent</option>
            <option value="Recurrent">Recurrent</option>
            <option value="New">New</option>
            <option value="-">-</option>
            </select> 
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Age requirement</label>
		<div class="col-sm-4">
            <input type="text" class="form-control" name="age_requirement" placeholder="Numeric"/>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Category Admin</label>
		<div class="col-sm-4">
            <select name="category_admin">
            <option value="">Choose category admin</option>                                                                                
            <option value="Quality">Quality</option>
            <option value="User">User</option>            
            </select> 
		</div>
	</div>
    <?php 
    endif;
    if($ttl == 'Edit Requirement General'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Authorization</label>
        <div class="col-sm-4">
        <select name="id_license">
            <option value="<?php echo $rc_general->id_license;?>"><?php echo $rc_general->name_license;?></option>
            <?php echo modules::run('license/requirement/option_authorization'); ?>
        </select>         
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="id_type">
            <option value="<?php echo $rc_general->id_type;?>"><?php echo $rc_general->name_type;?></option>
            <?php echo modules::run('license/requirement/option_type'); ?>
        </select> 
        </div>
    </div>  
    <div class="form-group">
        <label class="col-sm-2 control-label ">Ratting/ Spect</label>
        <div class="col-sm-4">
            <select name="id_spect"> 
            <?php if ($rc_general->id_spect != null) {;?>
                <option value="<?php echo $rc_general->id_spect;?>"><?php echo $rc_general->name_spect;?></option>
                <?php echo modules::run('license/requirement/option_spect'); 
            } else { ?>
                <option value=""></option>
            <?php }?>
        </select> 
        </div>
    </div>  
    <div class="form-group">
        <label class="col-sm-2 control-label ">Requirement&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="id_req_spec">
            <option value="<?php echo $rc_general->id_requirement;?>"><?php echo $rc_general->name_requirement;?></option><?php echo modules::run('license/requirement/option_req_spec'); ?>
        </select> 
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label ">Continous&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="category_continous">
            <option value="<?php echo $rc_general->category_continous;?>"><?php echo $rc_general->category_continous;?></option>                                                        
            <option value="Non Recurrent">Non Recurrent</option>
            <option value="Recurrent">Recurrent</option>
            <option value="New">New</option>
            <option value="-">-</option>
            </select> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Age requirement</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="age_requirement" placeholder="Numeric" value="<?php echo $rc_general->age_requirement;?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Category Admin</label>
        <div class="col-sm-4">
            <select name="category_admin">
            <option value="<?php echo $rc_general->category_admin;?>"><?php echo $rc_general->category_admin;?></option>
            <option value="Quality">Quality</option>
            <option value="User">User</option>            
            </select> 
        </div>
    </div>    
    <?php endif;?>	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="submit"><span class="fa fa-save"></span> &nbsp;Save </button>			
			<a class="btn btn-flat bg-olive color-palette btn-sm" name="back"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>    
<?php
echo form_close(); 
?>

<?php
    echo bootstrap_datepicker();
?>     
<script type="text/javascript">
    $('[name=back]').on('click', function(){
        window.history.go(-1);
    });

    $('[name=id_license]').on('change',function(){            
        var license = $(this).val();  
        var get_license  = "<?php echo site_url().'/license/requirement/get_license/'; ?>";                  
        $.get( get_license + license , function(data, status){        
            $('[name=id_type]').html(data);
        });
    });
    $('[name=id_type]').on('change',function(){            
        var license = $('[name=id_license]').val();  
        var type = $(this).val();  

        var get_type  = "<?php echo site_url().'/license/requirement/get_type/'; ?>";                  
        $.get( get_type + type , function(data, status){        
            $('[name=id_spect]').html(data);
        });
    });

    $('[name=id_spect]').on('change',function(){            
        var license = $('[name=id_license]').val();  
        var type = $('[name=id_type]').val();  
        var spect = $(this).val();  
        var get_spec  = "<?php echo site_url().'/license/requirement/get_spec/'; ?>";                  
        $.get( get_spec + license + '/' + type + '/' + spect , function(data, status){        
            $('[name=id_category]').html(data);
        });
    });
    
</script>
