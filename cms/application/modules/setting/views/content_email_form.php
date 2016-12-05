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
<?php echo form_close(); ?>