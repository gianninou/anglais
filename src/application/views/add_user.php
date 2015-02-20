<div id="add_user">

	<h2>Add user to group</h2>
	<?php if(isset($error)) echo $error; ?>
	<?php if(isset($success)){?>
		<span>User added</span>
	<?php } ?>


	<?php echo form_open('user/add/'.$group_id); ?>

		<div class="input-group">
			<span class="input-group-addon">Login</span>
			<input type="text" class="form-control" name="login" id="login" placeholder="Login" autofocus>
		</div>

		<div class="btn-group">
			<input class="btn btn-default" type="submit" name="add_continue" value="Add and continue">
			<input class="btn btn-default" type="submit" name="add" value="Add">
			<input class="btn btn-default" type="submit" name="cancel" value="Cancel">
		</div>
	</form>

</div>