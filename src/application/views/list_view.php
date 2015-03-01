<div id="list_view">
	<h2>List : <?php echo $list->get_name();?></h2>
	<h3>Words</h3>
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
				<td><a href="<?php echo base_url()."/index.php/wlist/delete_word/".$word->get_id()."/".$list->get_id(); ?>">Delete</a></td>
			</tr>
		<?php } ?>
	</table>

	<h3>Groups</h3>
	<ul>
		<?php foreach($groups as $g){ ?>
			<li><a href="<?php echo base_url()."/index.php/group/view/".$g->get_id(); ?>"><?php echo $g->get_name(); ?></a></li>
		<?php } ?>
	</ul>




	<?php if($list->get_id_admin() == $this->session->userdata('user')['id']){ ?>
		<a href="<?php echo base_url()."/index.php/word/add/".$list->get_id(); ?>"><button>Add word</button></a>
		<a href="<?php echo base_url()."/index.php/group/addlist/".$list->get_id(); ?>"><button>Add to group</button></a>
		<a href=""><button>Share (TODO)</button></a>
	<?php } ?>
	<a href="<?php echo base_url()."/index.php/wlist/answer/".$list->get_id(); ?>"><button>Test it</button></a>


</div>