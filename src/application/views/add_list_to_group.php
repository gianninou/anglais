<div id="add_list_to_group">
	<h1>Add list X to group</h1>
	<?php echo form_open('group/addlist/'.$list_id); ?>

		<div class="input-group">
			<span class="input-group-addon">List</span>
			<select name="group">
				<?php foreach ($groups as $g){ ?>
					<option value="<?php echo $g->get_id(); ?>"><?php echo $g->get_name(); ?></option>
				<?php } ?>
			</select>
		</div>

		<div class="btn-group">
			<input class="btn btn-default" type="submit" name="add" value="Add to group">
			<input class="btn btn-default" type="submit" name="cancel" value="Cancel">
		</div>

	</form>
</div>