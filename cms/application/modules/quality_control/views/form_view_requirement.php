<?php if(@$name_file_ftp) {?>
<section class="content-header">
    <h1><?php echo $ttl; ?><h3><span class="fa fa-file"></span> <?php echo $name_file;?></h3></h1>  
</section>

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
                    <button type="submit" class="btn btn-primary" >Not Valid</button>
                </div> 
            <?=form_close();?>                       
        </div>
  </div>
</div>
<div class="col-md-12 col-md-offset-2">

<iframe src="<?php echo "ftp://usr-olaps:p@ssw0rd@192.168.40.107/TQ-STORAGE/LICENSE_CERTIFICATION/OLAPS/".$personnel_number."/".$code_folder."/".$name_file_ftp; ?>"  height="600px" width="70%"></iframe>
<br/>
<br/>
<form action="<?php echo base_url()."index.php/quality_control/process_document"; ?>" method="post">            
<input type="hidden" name="request_number" value="<?php echo $request_number;?>" />
<input type="hidden" name="personnel_number" value="<?php echo $personnel_number;?>" />
<input type="hidden" name="code_file" value="<?php echo $code_file;?>" />                
&nbsp;
<button class="btn btn-success btn-md" type="submit" name="valid">Valid</button>
&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#basicModal">Not Valid</button>
&nbsp;<button type="submit" class="btn btn-info btn-md" name="back">Back</button>
<?=form_close();?>                       
<br/>
<br/>
</div>
<?php 
}else{
    echo "<form action='.base_url().'.index.php/quality_control/process_document'; method='post'>";
    echo "<button type='submit' class='btn btn-info btn-md' name='back'>Back</button>";
};
?>