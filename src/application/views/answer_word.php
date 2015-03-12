<div is="answer_word">
	<h2>Find the word</h2>

	<div>
		<?php if(isset($previous)){ ?>
			<?php if($previous){ ?>
				<h4><span class="label label-success">Previous word : good answer</span></h4>
			<?php }else{ ?>
				<h4><span class="label label-danger">Previous word : bad answer</span></h4>
			<?php } ?>			
		<?php } ?>
	</div>

	<span><?php if($en_to_fr){ echo $word->get_english(); }else{ echo $word->get_french(); } ?></span>
	
	<?php if($en_to_fr){ ?>English to French<?php }else{ ?>French to English<?php } ?>

	<?php echo form_open('wlist/answer/'.$list_id); ?>

		<div class="input-group">
			<span class="input-group-addon">Translation</span>
			<input type="text" class="form-control" name="translation" id="translation" placeholder="Translation" autofocus autocomplete="off">
		</div>

		<div class="btn-group">
			<input type="hidden" name="en_to_fr" value="<?php echo $en_to_fr;  ?>"/>
			<input class="btn btn-default" type="submit" name="validate" value="Validate">
			<input class="btn btn-default" type="submit" name="cancel" value="Finish">
		</div>

	</form>
</div>