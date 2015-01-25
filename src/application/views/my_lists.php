<div id="my_lists">
	<ul>
		<?php foreach ($lists as $key => $list) { ?>
			<li>
				<a href="<?php echo base_url()."/wlist/view/".$list->get_id(); ?>"><?php echo $list->get_name(); ?></a>
			</li>
		<?php } ?>
	<ul>
</div>