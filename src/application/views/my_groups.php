<div id="my_groups">
	<h2>My groups</h2>
	<ul>
		<?php foreach ($groups as $key => $group) { ?>
			<li>
				<a href="<?php echo base_url()."index.php/group/view/".$group->get_id(); ?>"><?php echo $group->get_name(); ?></a>
			</li>
		<?php } ?>
	<ul>
</div>