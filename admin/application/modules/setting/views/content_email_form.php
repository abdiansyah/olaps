<?php echo jquery_select2(); ?>
<script type="text/javascript">
$().ready(function(){
	$('.subject').select2({width : '75%'});
	CKEDITOR.replace('edit_content');
	CKEDITOR.replace('edit_footer');
});
</script>

<section class="content-header">
	<h1>Management Content Email <small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ttl; ?></small></h1>
</section>

<?php echo form_open_multipart($action, array('class' => 'form-horizontal row-form', 'data-toggle' => 'validator')); ?>	
	<?php 	
	if($ttl=='Edit'):
	?>
    <div class="form-group">
        <label class="col-sm-2 control-label input-sm">Subject</label>
		<div class="col-sm-4">
		<input class="form-control input-sm" type="hidden" name="id" value="<?php echo $content_email->id;?>"/>		
		<input class="form-control input-sm" type="text" name="subject" value="<?php echo $content_email->subject;?>"/>		
		</div>
		<div class="col-md-4">		
		<button type="button" class="btn btn-warning btn-lg col-sm-4" name="submitcheckcontent" data-toggle="modal" data-target="#view-modal" onClick="return false;" data-id="<?php echo @ $content_email->id; ?>"> Preview </button>
		</div>
	</div>	    
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Title</label>
		<div class="col-sm-4">
		  <input class="form-control input-sm" type="text" name="title" value="<?php echo $content_email->title;?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Content</label>
		<div class="col-sm-6">		  			
			<textarea id="edit_content" name="content" rows="10" cols="80"><?php echo $content_email->content;?></textarea>			
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Footer</label>
		<div class="col-sm-6">		  
			<textarea id="edit_footer" name="footer" rows="10" cols="80"><?php echo $content_email->footer;?></textarea>			
		</div>
	</div>
	<?php
	endif;
	?>		 
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<br/>
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm"><span class="fa fa-save"></span> &nbsp;Save </button>
			
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>

<!-- Modal License History-->
<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog"> 
     <div class="modal-content">         
        <div class="modal-header"> 
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
           <h4 class="modal-title">
           <i class="glyphicon glyphicon-user"></i> Content Email
           </h4> 
        </div>                 
        <div class="modal-body">                     
            <div id="modal-loader" style="display: none; text-align: center;">               
                <img src="<?php echo base_url('/assets/images/property/hourglass.gif'); ?>">
            </div> 
            <div class="table-responsive">                                                          
                <div class="col-md-12">                                                            
                    <label>Subject :</label>&nbsp;<label id="subject"></label>
                    <p id="title"></p>
                    <p>Request Number : XXXXXXXX </p>                    
                    <p id="content"></p>
                    <p><i>Optional Table</i></p>
                    <p id="footer"></p>
                </div>
            </div>
        </div> 
                    
        <div class="modal-footer">             
            <button type="button" class="btn btn-default" data-dismiss="modal" name="close">Close</button>  
        </div> 
                        
    </div> 
  </div>
</div>        
<?php echo form_close(); ?>
<script type="text/javascript">
	$('[name=submitcheckcontent]').one('click', function(){
		content_preview_by = "<?php echo site_url().'/setting/content_email/preview_by/';?>";
        var id = $(this).data('id');        
        var jqxhr = $.getJSON(content_preview_by + id, function(data) {
	    	$('#subject').html(data.subject);                	    
	    	$('#title').html(data.title);                	    
	    	$('#content').html(data.content);                	    
	    	$('#footer').html(data.footer);                	    
	    });        
    });
</script>