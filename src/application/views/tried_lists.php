<div id="tried_lists">
	<h2>Tried lists</h2>
	<ul class="list-group">
		<?php foreach ($lists as $key => $list) { ?>
			<li class="list-group-item">
				<h4><a href="<?php echo base_url()."index.php/wlist/view/".$list->get_id(); ?>"><?php echo $list->get_name(); ?></a></h4>
				
				<?php if($list->get_stat($id_user)>66){ ?>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $list->get_stat($id_user)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $list->get_stat($id_user)?>%;">
							<?php echo $list->get_stat($id_user)?>% Complete
						</div>
					</div>
				<?php }else if($list->get_stat($id_user)>33){ ?>
					<div class="progress">
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $list->get_stat($id_user)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $list->get_stat($id_user)?>%;">
							<?php echo $list->get_stat($id_user)?>% Complete
						</div>
					</div>
					<?php }else{ ?>
					<div class="progress">
						<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $list->get_stat($id_user)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $list->get_stat($id_user)?>%;">
							<?php echo $list->get_stat($id_user)?>% Complete
						</div>
					</div>
				<?php } ?>

				


			</li>
		<?php } ?>
	<ul>
</div>