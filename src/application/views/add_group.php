<div id="add_group">

	<h2>Create a group</h2>
	<?php if(isset($error)) echo $error; ?>
	<?php if(isset($success)){?>
		<span>Group added</span>
	<?php } ?>


	<?php echo form_open('group/add/'); ?>

		<div class="input-group">
			<span class="input-group-addon">Name</span>
			<input type="text" class="form-control" name="name" id="name" placeholder="Name" autofocus>
		</div>

		<div class="btn-group">
			<input class="btn btn-default" type="submit" name="add" value="Add">
			<input class="btn btn-default" type="submit" name="cancel" value="Cancel">
		</div>
	</form>

</div>