<div id="add_list">

	<h2>Add a list</h2>

	<?php if(isset($error)){ ?>
		<h4><span class="label label-danger"><?php echo $error; ?></span></h4>
	<?php } ?>

	<?php if(isset($success)){ ?>
		<h4><span class="label label-success">List added</span></h4>
	<?php } ?>


	<?php echo form_open('wlist/add/'); ?>

		<div class="input-group">
			<span class="input-group-addon">Name</span>
			<input type="text" class="form-control" name="name" id="name" placeholder="Name" autofocus>
		</div>

		<div class="btn-group">
			<input class="btn btn-default" type="submit" name="add_continue" value="Add and continue">
			<input class="btn btn-default" type="submit" name="add" value="Add">
			<input class="btn btn-default" type="submit" name="cancel" value="Cancel">
		</div>
	</form>

</div>