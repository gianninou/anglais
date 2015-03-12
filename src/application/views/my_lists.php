<div id="my_lists">
	<h2>My lists</h2>
	<ul class="list-group">
		<?php foreach ($lists as $key => $list) { ?>
			<li class="list-group-item">
				<a href="<?php echo base_url()."index.php/wlist/view/".$list->get_id(); ?>"><?php echo $list->get_name(); ?></a>
			</li>
		<?php } ?>
	<ul>
</div>