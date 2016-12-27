<header class="main-header">   
  <nav class="navbar-top-black">    
    <div class="container-fluid">       
    <div class="navbar-header">
        <a class="banner">
        <center><img src="<?php echo base_url('/assets/plugins/adminlte/img/header.png')?>" width="220" height="150" class="img-responsive"/></center>
        </a>    
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <h4><span class="label label-default">Menus</span>&nbsp; &nbsp;<i class="fa fa-bars"></i></h4>
      </button> 
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">           
      <ul class="nav navbar-nav navbar-left">
        <li><a class="menu" href="<?php echo site_url('home/index');?>"><span class="glyphicon glyphicon-home"></span><b> Home</b></a></li>        
        <!--li><a class="menu" href="<?php //echo site_url('profile/index')?>"><span class="glyphicon glyphicon-blackboard"></span><b> Personnel Qualification Services</b></a></li-->        
        <li><a class="menu" href="<?php echo site_url('apply_license/index')?>"><span class="glyphicon glyphicon-file"></span><b> Apply License</b></a></li>      
        <!-- <li class="dropdown"><a class="menu" href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span><b> License Information</b> <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">            
            <li><a class="menu" href="<?php //echo base_url('index.php/license_holder/ame_license');?>"><span><b>AME License Holder</b></span></a></li>
            <li><a class="menu" href="<?php //echo base_url('index.php/license_holder/certifying_staff_license');?>"><span><b>Certifying Staff License Holder</b></span></a></li>                        
            <li><a class="menu" href="<?php// echo base_url('index.php/license_holder/gmf_authorization_license');?>"><span><b>GMF Authorization License Holder</b></span></a></li>    
            <li><a class="menu" href="<?php //echo base_url('index.php/license_holder/customer_authorization_license');?>"><span><b>Customer Authorization Holder</b></span></a></li>
            <li><a class="menu" href="<?php //echo base_url('index.php/license_holder/easa_license');?>"><span><b>Roster EASA Holder</b></span></a></li>            
            <li><a class="menu" href="<?php //echo base_url('index.php/license_holder/cofc_license');?>"><span><b>Stamp & C Holder</b></span></a></li>    
            <li><a class="menu" href="<?php //echo base_url('index.php/license_holder/basic_license');?>"><span><b>Find Stamp/License Holder</b></span></a></li>            
        </ul>
        </li>    -->     
        <!--li><a class="menu" href="#"><span class="glyphicon glyphicon-download-alt"></span><b> Download</b></a></li-->      
        <li><a class="menu" href="<?php echo site_url('contact/index')?>"><span class="glyphicon glyphicon-send"></span><b> Contact</b></a></li>        
        </ul>         
        <ul class="nav navbar-nav navbar-right">                			                
				<li class="dropdown user user-menu">                
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php                             
                        if ($this->session->userdata('users_applicant')->PERNR != '') {@$img_photo = $this->session->userdata('users_applicant')->PERNR.'.jpg';
                        ?> 
                        <img src="https://talentlead.gmf-aeroasia.co.id/images/avatar/<?php echo $img_photo;?>" class="user-image" alt="User Image">
                        <?php 
                        } else {
                        ?>
                            <img src="<? echo base_url().'assets/photo_users/photo_default.jpg'?>" class="user-image" alt="User Image">
                        <?php
                        }
                        ?>                        

                        <span class="hidden-xs"><b class="menu">Personnel Qualification & Quality System Documentation</b></span>
                    </a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
						<?php                             
                        if ($this->session->userdata('users_applicant')->PERNR != '') {@$img_photo = $this->session->userdata('users_applicant')->PERNR.'.jpg';
                        ?> 
                        <img src="https://talentlead.gmf-aeroasia.co.id/images/avatar/<?php echo $img_photo;?>" class="user-image" alt="User Image">
                        <?php 
                        } else {
                        ?>
                            <img src="<? echo base_url().'assets/photo_users/photo_default.jpg'?>" class="user-image" alt="User Image">
                        <?php
                        }
                        ?>  
							<p>
								<?php echo $this->session->userdata('users_applicant')->EMPLNAME; ?>								
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
    </ul>
    </div><!-- /.navbar-collapse -->    
    </div><!-- /.container-fluid -->
  </nav>
</header>