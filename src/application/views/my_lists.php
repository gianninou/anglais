<div id="my_lists">
	<h2>My lists</h2>
	<ul class="list-group">
		<?php foreach ($lists as $key => $list) { ?>
			<li class="list-group-item">
				<span class="badge"><?php $nb=$list->get_nb_words(); echo $nb; ?> word<?php echo ($nb>1?'s':'') ?></span>
				<a href="<?php echo base_url()."index.php/wlist/view/".$list->get_id(); ?>"><?php echo $list->get_name(); ?></a>
			</li>
		<?php } ?>
	<ul>
</div>