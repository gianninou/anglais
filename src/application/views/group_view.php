<div id="group_view">
	<h2><span class="label label-info"><?php echo $group->get_name();?></span></h2>

	
	<?php if(isset($users)){ ?>
		<h3><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>People on this group</h3>
		<table class="table table-hover table-bordered">

			<th>First name</th>
			<th>Last name</th>

			<?php foreach ($users as $key => $user) { ?>
				<tr>
					<td><?php echo $user->get_first_name()  ;?></td>
					<td><?php echo $user->get_last_name() ; ?></td>
					<td  width="100"><a href="<?php echo base_url()."/index.php/group/delete_user/".$user->get_id()."/".$group->get_id(); ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a></td>

				</tr>
			<?php } ?>
		</table>
	<?php } ?>
	<?php if($group->get_id_admin() == $this->session->userdata('user')['id']){ ?>
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		<a href="<?php echo base_url()."index.php/user/add/".$group->get_id(); ?>">
			<button type="button" class="btn btn-success">Add user</button>
		</a>
	<?php } ?>

	<h3><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>Lists on this group</h3>
	<table class="table table-hover table-bordered">
		<?php foreach($lists as $l){ ?>
			<tr>
				<td class="list-group-item"><a href="<?php echo base_url()."index.php/wlist/view/".$l->get_id();?>"><?php echo $l->get_name();?></a></td>
				
				<?php if($group->get_id_admin() == $this->session->userdata('user')['id']){ ?>
					<td width="100"><a href="<?php echo base_url()."/index.php/group/delete_list/".$l->get_id()."/".$group->get_id(); ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a></td>
				<?php } ?>

			</tr>
		<?php } ?>
	</table>

	


</div>