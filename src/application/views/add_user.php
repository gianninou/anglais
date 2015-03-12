<div id="add_user">

	<h2>Add user to group</h2>

	<?php if(isset($error)){ ?>
		<h4><span class="label label-danger"><?php echo $error; ?></span></h4>
	<?php } ?>

	<?php if(isset($success)){ ?>
		<h4><span class="label label-success">User added</span></h4>
	<?php } ?>


	<?php echo form_open('user/add/'.$group_id); ?>

		<div class="input-group">
			<span class="input-group-addon">Login</span>
			<?php //TODO add ajax with autocompletion ?>
			<input type="text" class="form-control" name="login" id="login" placeholder="Login" autofocus>
		</div>

		<div class="btn-group">
			<input class="btn btn-default" type="submit" name="add" value="Add">
			<input class="btn btn-default" type="submit" name="add_finish" value="Add and finish">
			<input class="btn btn-default" type="submit" name="cancel" value="Cancel">
		</div>
	</form>

</div>