<aside class="main-sidebar">
	<section class="sidebar" style="height: auto;">
	  <!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="active treeview">
				<a href="<?php echo site_url('quality_control/quality_control'); ?>">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<?php             
			$users_group = $this->session->userdata('users_quality')->id_employee_group;                        
			$query = "
				SELECT m.*, 
					ma.id_menu_akses 
				FROM menu AS m 
				JOIN (SELECT * FROM menu_akses WHERE id_group_fk = '$users_group') AS ma 
				  ON ma.id_menu_fk = m.id_menu 
				WHERE m.id_menu_induk = 0
				ORDER BY m.id_menu 		
			";
			$parents = $this->db->query($query);
			
			foreach($parents->result() as $parent) :
			?>
				<li class="treeview">
					<a href="<?php echo site_url($parent->uri); ?>">
						<i class="fa fa-reorder"></i>
						<span><?php echo $parent->nama; ?></span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<?php
					$query = "
						SELECT m.*, 
							ma.id_menu_akses 
						FROM menu AS m 
						JOIN (SELECT * FROM menu_akses WHERE id_group_fk = '$users_group') AS ma 
						  ON ma.id_menu_fk = m.id_menu 
						WHERE m.id_menu_induk = '$parent->id_menu'
						ORDER BY m.id_menu 		
					";
					$childs = $this->db->query($query);
					?>
					<ul class="treeview-menu">
						<?php foreach($childs->result() as $child) : ?>
							<li>
								<a href="<?php echo site_url($child->uri); ?>"><i class="fa fa-circle-o"></i><?php echo $child->nama; ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			<?php endforeach; ?>
		</ul>
	</section>
</aside>