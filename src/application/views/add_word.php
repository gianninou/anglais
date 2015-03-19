<div id="add_word">

	<h2>Add a word to list "<?php echo $list->get_name(); ?>"</h2>
	

	<?php if(isset($error)){ ?>
		<h4><span class="label label-danger"><?php echo $error; ?></span></h4>
	<?php } ?>

	<?php if(isset($success)){ ?>
		<h4><span class="label label-success">Word added</span></h4>
	<?php } ?>



	<?php echo form_open_multipart('word/add/'.$list->get_id()); ?>

		<div class="input-group">
			<span class="input-group-addon" style="width:150px">English Word</span>
			<input type="text" class="form-control" name="en_word" id="en_word" placeholder="English Word" autofocus>
		</div>
		
		<div class="input-group">
			<span class="input-group-addon" style="width:150px">French Word</span>
			<input type="text" class="form-control" name="fr_word" id="fr_word" placeholder="French Word">
		</div>

		<!-- <div class="input-group">
			<span class="input-group-addon" style="width:150px">Phonetic</span>
			<input type="text" class="form-control" name="phonetic" id="phonetic" placeholder="Phonetic">
		</div> -->

		<div class="input-group">
			<span class="input-group-addon" style="width:150px">Audio file</span>
			<input type="file" name="audio_file" size="2000000" />
		</div>


		<div class="btn-group">
			<input class="btn btn-default" type="submit" name="add_continue" value="Add and view list">
			<input class="btn btn-default" type="submit" name="add" value="Add">
			<input class="btn btn-default" type="submit" name="cancel" value="Cancel">
		</div>
	</form>

</div>