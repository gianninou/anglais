<div id="my_groups">
	<h2>My groups</h2>
	<ul class="list-group">
		<?php foreach ($groups as $key => $group) { ?>
			<li class="list-group-item">
				<span class="badge"><?php $nb=$group->get_nb_lists(); echo $nb; ?> list<?php echo ($nb>1?'s':'') ?></span>
				<span class="badge"><?php $nb=$group->get_nb_users(); echo $nb; ?> user<?php echo ($nb>1?'s':'') ?></span>
				
				<a href="<?php echo base_url()."index.php/group/view/".$group->get_id(); ?>"><?php echo $group->get_name(); ?></a>
			</li>
		<?php } ?>
	<ul>
</div>