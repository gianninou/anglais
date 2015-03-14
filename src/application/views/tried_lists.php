<div id="tried_lists">
	<h2>Tried lists</h2>
	<ul class="list-group">
		<?php foreach ($lists as $key => $list) { ?>
			<li class="list-group-item">
				<span class="badge"><?php $nb=$list->get_nb_words(); echo $nb; ?> word<?php echo ($nb>1?'s':'') ?></span>
				
				<span  class="glyphicon glyphicon-play" aria-hidden="true"></span>
				<a href="<?php echo base_url()."/index.php/wlist/answer/".$list->get_id(); ?>">
					<button type="button" class="btn btn-success">Test it</button>
				</a>

				<h4 style="display:inline;"><a href="<?php echo base_url()."index.php/wlist/view/".$list->get_id(); ?>"><?php echo $list->get_name(); ?></a></h4>


				

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