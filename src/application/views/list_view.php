<div id="list_view">
	<h2><span class="label label-info"><?php echo $list->get_name();?></span></h2>


	<h3 style="float:left"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>Words</h3>

	<h3 style="float:right">
		<span class="glyphicon glyphicon-play" aria-hidden="true"></span>
		
		<a href="<?php echo base_url()."/index.php/wlist/answer/".$list->get_id(); ?>">
			<button type="button" class="btn btn-success">Test it</button>
		</a>
		
	</h3>

	<table class="table table-hover table-bordered">

		<th>English</th>
		<th>French</th>
		<th>Phonetic</th>
		<th>Sound</th>

		<?php foreach ($words as $key => $word) { ?>
			<tr>
				<td><?php echo $word->get_english()  ;?></td>
				<td><?php echo $word->get_french() ; ?></td>
				<td><?php echo $word->get_phonetic() ; ?></td>
				<td>
					<?php if(!empty($word->get_sound())){ ?>
						<audio controls="controls" preload="auto">
		                        <source src="<?php echo base_url()."/uploads/".$word->get_sound(); ?>" type="audio/mp3"/>
		                        Le navigateur ne semble pas compatible.
		                </audio>
					<?php } ?>
				</td>
				<td  width="100"><a href="<?php echo base_url()."/index.php/wlist/delete_word/".$word->get_id()."/".$list->get_id(); ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a></td>
			</tr>
		<?php } ?>
	</table>
	<?php if($list->get_id_admin() == $this->session->userdata('user')['id']){ ?>
		<a href="<?php echo base_url()."/index.php/word/add/".$list->get_id(); ?>"><button>Add word</button></a>
	<?php } ?>

	<h3><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>Groups</h3>
	<ul class="list-group">
		<?php foreach($groups as $g){ ?>
			<li class="list-group-item"><a href="<?php echo base_url()."/index.php/group/view/".$g->get_id(); ?>"><?php echo $g->get_name(); ?></a></li>
		<?php } ?>
	</ul>




	<?php if($list->get_id_admin() == $this->session->userdata('user')['id']){ ?>
		<a href="<?php echo base_url()."/index.php/group/addlist/".$list->get_id(); ?>"><button>Add to group</button></a>
		<!-- <a href=""><button>Share (TODO)</button></a>-->
	<?php } ?>
	

</div>