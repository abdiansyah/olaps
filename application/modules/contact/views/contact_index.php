<div class="row">
	<div class="col-sm-8 col-md-offset-2 col-center-block table-responsive">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">CONTACT US</h3>
			</div>
			<div class="box-body">
				<!-- div body -->
				<div class="col-sm-12">
					<!-- div content panel -->
					<div class="col-sm-8">
						<form class="form-horizontal" action="<?php echo site_url('contact/send_email');?>" method="post">
							<div class="form-group">
								<label for="name" class="col-sm-4 control-label">Name</label>
								<div class="col-sm-8">
									<input type="text" name="name" class="form-control"></div>
							</div>
							<div class="form-group">
								<label for="request_number" class="col-sm-4 control-label">Email personnel</label>
								<div class="col-sm-8">
									<input type="text" name="email" class="form-control" id="email"></div>
							</div>
							<div class="form-group">
								<label for="request_number" class="col-sm-4 control-label">Subject</label>
								<div class="col-sm-8">
									<input type="text" name="subject" class="form-control" ></div>
							</div>
							<div class="form-group">
								<label for="message" class="col-sm-4 control-label">Message</label>
								<div class="col-sm-8">
									<textarea class="form-control" cols="50" name="message"></textarea>
								</div>
							</div>
						
						<button type="submit" class="btn btn-info pull-right" name="send" id="send">SEND</button>
						</form>
					</div>
					<div class="col-sm-4">
						<label for="request_number">EMAIL</label><br/>
						<label for="request_number">list-TQD@gmf-aeroasia.co.id</label><br/>
						<br/>
						<br/>
						<label for="request_number">PHONE</label><br/>
						<label for="request_number">Unit Licensing +62 21 550 8732</label><br/><label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; or +62 21 550 8082</label><br/>
						<label for="request_number">Unit Documentation +62 21 550 8079</label><br/>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
