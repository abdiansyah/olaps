<?php if(@$name_file_ftp) {?>
<section class="content-header">
    <h3><span class="fa fa-file"></span> <?php echo $name_file;?></h3>
    <div class="col-md-10">
    &nbsp;
    </div>
    <div class="col-md-2">
    <form action="<?php echo base_url()."index.php/quality_control/process_document"; ?>" method="post">            
    <input type="hidden" name="request_number" value="<?php echo $request_number;?>" />
    <input type="hidden" name="personnel_number" value="<?php echo $personnel_number;?>" />
    <input type="hidden" name="code_file" value="<?php echo $code_file;?>" />                
    &nbsp;
    <button class="btn btn-success btn-md" type="submit" name="valid">Valid</button>
    &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#basicModal">Not Valid</button>
    &nbsp;<button type="submit" class="btn btn-info btn-md" name="back">Back</button>
    <?php form_close();?>                           
    </div>
</section>
<br/>
<br/>
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span></button>
            <h4 class="modal-title" id="myModalLabel">Confirmation?</h4>
            </div>
            <form action="<?php echo base_url()."index.php/quality_control/process_document"; ?>" method="post">            
                <div class="modal-body">            
                    <h4>Document <b><?php echo $name_file;?></b>, sure not valid?</h4> 
                    <h4>Reason : </h4>           
                    <textarea name="reason" cols="70" rows="10"></textarea>                    
                    <input type="hidden" name="request_number" value="<?php echo $request_number;?>" />
                    <input type="hidden" name="personnel_number" value="<?php echo $personnel_number;?>" />
                    <input type="hidden" name="code_file" value="<?php echo $code_file;?>" />                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="not_valid" >Not Valid</button>
                </div> 
            <?=form_close();?>                       
        </div>
  </div>
</div>
<div class="col-md-12 ">
<iframe src="<?php echo "ftp://yayas:Bismillah@127.0.0.1/TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS/".$personnel_number."/".$code_folder."/".$name_file_ftp; ?>"  height="700px" width="100%"></iframe>
<?php @ftp_close('127.0.0.1', 21);?>
<br/>
<br/>
<br/>
<br/>
</div>
<?php 
}else{
    echo "<form action='.base_url().'.index.php/quality_control/process_document'; method='post'>";
    echo "<button type='submit' class='btn btn-info btn-md' name='back'>Back</button>";
};
?>