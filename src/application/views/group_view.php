<div id="group_view">
	<h2><?php echo $group->get_name();?></h2>
	<table class="table table-hover table-bordered">

		<th>First name</th>
		<th>Last name</th>

		<?php foreach ($users as $key => $user) { ?>
			<tr>
				<td><?php echo $user->get_first_name()  ;?></td>
				<td><?php echo $user->get_last_name() ; ?></td>
			</tr>
		<?php } ?>
	</table>

	<?php if($group->get_id_admin() == $this->session->userdata('user')['id']){ ?>
		<a href="<?php echo base_url()."index.php/user/add/".$group->get_id(); ?>"><button>Add user</button></a>
	<?php } ?>


</div>