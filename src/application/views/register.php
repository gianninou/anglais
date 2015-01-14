<div id="register_div">

	<h2>Register</h2>
	<?php echo form_open('welcome/register_form/'); ?>

		<div class="input-group">
			<span class="input-group-addon">First Name</span>
			<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
		</div>
		
		<div class="input-group">
			<span class="input-group-addon">Last name</span>
			<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name">
		</div>

		<div class="input-group">
			<span class="input-group-addon">Email</span>
			<input type="mail" class="form-control" name="email" id="email" placeholder="Email">
		</div>

		<div class="input-group">
			<span class="input-group-addon">Password</span>
			<input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
		</div>

		<div class="input-group">
			<span class="input-group-addon">Confirm password</span>
			<input type="password" name="pass2" id="pass2" class="form-control" placeholder="Confirm Password">
		</div>

		<div class="btn-group">
			<input class="btn btn-default" type="submit" value="Register">
			<input class="btn btn-default" type="reset" value="Cancel">
		</div>
	</form>
</div>