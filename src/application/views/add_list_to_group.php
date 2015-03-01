<div id="add_list_to_group">
	<h2>Add list <?php echo $list->get_name(); ?> to group</h2>
	<?php echo form_open('group/addlist/'.$list->get_id()); ?>

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