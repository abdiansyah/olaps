<?php echo jquery_select2(); ?>
<script type="text/javascript">
$().ready(function(){
    $('[name=code_folder_spec],[name=code_folder_general]').select2({width : '100%'});
});
</script>

<section class="content-header">
    <h1><?php echo $ttl?></h1>    
</section>

<?php echo form_open($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>
    <?php if($ttl == 'Add Requirement Specific'):?>
    <div class="form-group">
        <label class="col-sm-2 control-label ">Name requirement</label>
        <div class="col-sm-4">
        <input type="text" name="name_req_spec" class="form-control">
        <input type="hidden" name="code_req_spec" value="<?php echo kode_tbl_req_spec();?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">To folder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="code_folder_spec">
            <option value="">Choose to folder</option>
            <?php echo modules::run('license/requirements_management/option_dir'); ?>
        </select> 
        </div>
    </div>      
    <?php 
    endif;
    if($ttl == 'Edit Requirement Specific'):?>
    <div class="form-group">   
        <label class="col-sm-2 control-label ">Name requirement</label>
        <div class="col-sm-4">
        <input type="text" name="name_req_spec" class="form-control" value="<?php echo $rc_specific->name_req_spec;?>">
        <input type="hidden" name="code_req_spec" value="<?php echo $rc_specific->code_req_spec;?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">To folder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="code_folder_spec">
            <option value="<?php echo $rc_specific->code_folder_spec;?>"><?php echo $rc_specific->name_folder_spec;?></option>
            <?php echo modules::run('license/requirements_management/option_dir'); ?>
        </select> 
        </div>
    </div>      
    <?php endif;    
    if($ttl == 'Add Requirement General'):?>
         <div class="form-group">
        <label class="col-sm-2 control-label ">Name requirement</label>
        <div class="col-sm-4">
        <input type="text" name="name_req_general" class="form-control">
        <input type="hidden" name="code_req_general" value="<?php echo kode_tbl_req_general();?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">To folder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="code_folder_general">
            <option value="">Choose to folder</option>
            <?php echo modules::run('license/requirements_management/option_dir'); ?>
        </select> 
        </div>
    </div>     
    <?php 
    endif;
    if($ttl == 'Edit Requirement General'):?>
        <div class="form-group">   
        <label class="col-sm-2 control-label ">Name requirement</label>
        <div class="col-sm-4">
        <input type="text" name="name_req_general" class="form-control" value="<?php echo $rc_general->name_req_general;?>">
        <input type="hidden" name="code_req_general" value="<?php echo $rc_general->code_req_general;?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label ">To folder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <div class="col-sm-4">
            <select name="code_folder_general">
            <option value="<?php echo $rc_general->code_folder_general;?>"><?php echo $rc_general->name_folder_general;?></option>
            <?php echo modules::run('license/requirements_management/option_dir'); ?>
        </select> 
        </div>
    </div>   
    <?php endif;?>  
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button type="submit" class="btn btn-flat btn-primary color-palette btn-sm" name="submit"><span class="fa fa-save"></span> &nbsp;Save </button>         
            <a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back_req; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
        </div>
    </div>    
<?php
echo form_close(); 
?>

<?php
    echo bootstrap_datepicker();
?>     
