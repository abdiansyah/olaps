<link rel="icon" href="<?=base_url();?>assets/images/property/gmf.png" type="image/x-icon" /><!DOCTYPE html><html><head>	<meta charset="utf-8">	<meta http-equiv="X-UA-Compatible" content="IE=edge">	<title>Login System</title>	<!-- Tell the browser to be responsive to screen width -->	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/adminlte/css/font-awesome.css'); ?>">    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/adminlte/css/font-awesome.min.css'); ?>">    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap/css/ionicons.min.css'); ?>">    		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/adminlte/css/AdminLTE.min.css'); ?>">	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css'); ?>">		<script src="<?php echo base_url('assets/plugins/bootstrap/js/html5shiv.min.js'); ?>"></script>    <script src="<?php echo base_url('assets/plugins/bootstrap/js/respond.min.js'); ?>"></script></head><body  background="<?php echo base_url().'/assets/images/property/background_login.jpg';?>">	<div class="login-box">	  		<div class="login-box-body">			<div class="login-logo" style="background-color: C1B9B9;">				<a href="#"><b>Login</b></a>			</div> <!-- /.login-logo -->						<p class="login-box-msg">Sign in to start your session</p>						<?php echo form_open('site/login'); ?>				<div class="form-group has-feedback">					<input type="text" name="username" class="form-control" placeholder="Username" required />					<span class="glyphicon glyphicon-user form-control-feedback"></span>				</div>				<div class="form-group has-feedback">					<input type="password" name="password" class="form-control" placeholder="Password" required />					<span class="glyphicon glyphicon-lock form-control-feedback"></span>				</div>                <br/>                				<div class="row">					<div class="col-xs-6">																							</div>					<div class="col-xs-6">						<button name="b_login" type="submit" class="btn btn-success btn-block btn-flat"><span class="fa fa-key"></span>&nbsp;&nbsp;Sign In</button>                        					</div>					<br/>																	</div>				<br/>				<?php if ($this->session->flashdata('status') == 'failed'): ?>						<div class="alert alert-dismissible" role="alert" style="background-color: C1B9B9;">							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>									<span><b>Please enter a correct username and password.</b></span>						</div>				<?php endif; ?>				<?php echo form_close(); ?>			<div class="social-auth-links text-center">				<!--<p>- OR -</p>				<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in usingFacebook</a>				<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>-->			</div>				</div><!-- /.login-box-body -->	</div><!-- /.login-box -->	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>	<script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>	<script type="text/javascript" src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>	</body></html>