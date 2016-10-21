<header class="main-header">
	<!-- Logo -->
	<a href="#" class="logo" id="navbar-top-black">
		<!-- mini logo for sidebar mini 50x50 pixels -->		
	</a>
	
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" id="navbar-top-black">
        <a class="sidebar-toggle" role="button" data-toggle="offcanvas" href="#">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                
        </a>
        <ul class="nav navbar-nav navbar-left">
            <a class="banner">
            <center><img src="<?php echo base_url('/assets/plugins/adminlte/img/header.png')?>" width="220" height="150" class="img-responsive"/></center>
            </a>
        </ul>                
		<div class="navbar-custom-menu">
                            
			<ul class="nav navbar-nav">                                                
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php 						    
//						if ($this->session->userdata('users_quality')->EMPL_PHOTO != '') {@$img_photo = $this->session->userdata('users_quality')->EMPL_PHOTO;						 											                                                
//                        header('Cache-control: public');                                                
//                        }
                        ?> 
                        <!--img src="data:image/jpg;base64,<?php //echo @$img_photo ?>" class="user-image" alt="User Image"-->
						<span class="hidden-xs"><?php echo $this->session->userdata('users_quality')->EMPLNAME; ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<!--img src="data:image/jpg;base64,<?php //echo @$img_photo ?>" class="user-image" alt="User Image"-->
							<p>
								<?php echo $this->session->userdata('users_quality')->EMPLNAME; ?>								
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">							
							<div class="pull-right">
								<a href="<?php echo site_url('site/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>