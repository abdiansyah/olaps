<!DOCTYPE html><html><head>	<meta charset="utf-8">	<meta http-equiv="X-UA-Compatible" content="IE=edge">	<title>LICENSE SYSTEM</title>	<link rel="icon" href="<?=base_url();?>assets/images/property/gmf.png" type="image/x-icon" />	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">    	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/adminlte/css/font-awesome.css'); ?>">    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/adminlte/css/font-awesome.min.css'); ?>">    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap/css/style.css'); ?>">	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/adminlte/css/AdminLTE.min.css'); ?>">	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/adminlte/css/skins/_all-skins.min.css'); ?>">    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/data_table/dataTables.bootstrap.css'); ?>">    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/toastr/toastr.css'); ?>">    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css'); ?>">   		<script type="text/javascript" src="<?php echo base_url('assets/plugins/js/html5shiv.min.js'); ?>"></script>    <script type="text/javascript" src="<?php echo base_url('assets/plugins/js/respond.min.js'); ?>"></script>    	<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>	<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>	<script src="<?php echo base_url('assets/plugins/adminlte/js/app.min.js'); ?>"></script>	    <script type="text/javascript" src="<?php echo base_url('assets/plugins/data_table/jquery.dataTables.min.js'); ?>"></script>	<script type="text/javascript" src="<?php echo base_url('assets/plugins/data_table/dataTables.bootstrap.min.js'); ?>"></script>    <script type="text/javascript" src="<?php echo base_url('assets/plugins/data_table/dataTables.bootstrap.js'); ?>"></script>            <script type="text/javascript" src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script></head><body class="hold-transition skin-blue" background="<?php echo base_url('assets/images/property/background.jpg');?>">     		<div class="header">                   <?php echo $this->load->view($header);?>					</div>        <br/>		<div class="main-container container-fluid">				<div class="main-content">				<div class="page-content">					<?php echo $this->load->view($content);?>				</div><!--/.page-content-->					</div><!--/.main-content-->		</div><!--/.main-container-->			</body></html>