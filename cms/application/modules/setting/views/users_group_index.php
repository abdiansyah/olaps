<script type="text/javascript">
$(document).ready(function(){	  
	$('#datatables_users_group').dataTable({
		"scrollY"			: "342px",
        "scrollCollapse"	: true,
	});
});
</script>

<section class="content-header">
	<h1>Group User <small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>

<div class="actions">
	<a href="<?php echo $add; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add Data</a>
</div>

<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table_bootstrap" id="datatables_users_group">
		<thead>
			<tr>
				<th width="3%">no</th>
				<th width="87%">Group User</th>
				<th width="10%">action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$no = 1;
				foreach($grid as $record) :
			?>
					<tr>
						<td align="center"><?php echo $no; ?></td>
						<td><?php echo $record->name_group; ?></td>
						<td align="center">
						<a href="<?php echo site_url('/setting/users_group/edit/'.$record->id_group); ?>" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a> &nbsp;&nbsp;
                        <a href="<?php echo site_url('/setting/users_group/delete/'.$record->id_group); ?>" title="Delete Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Delete</a>
						</td>
					</tr>
			<?php 
					$no++;
				endforeach;
			?>
		</tbody>
	</table>
</div>