<div id="list_view">
	<h2>List : <?php echo $list->get_name();?></h2>
	<ul>
	<?php foreach ($words as $key => $word) { ?>
		<li>
			<?php echo $word->get_french()." ".$word->get_english() ; ?>
		</li>
	<?php } ?>
	</ul>

	<a href="<?php echo base_url()."/index.php/word/add/".$list->get_id(); ?>"><button>Add word</button></a>
	<a href="<?php echo base_url()."/index.php/wlist/answer/".$list->get_id(); ?>"><button>Test it</button></a>


</div>