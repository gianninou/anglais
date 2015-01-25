<div id="login_div">
	<h2>Login</h2>
	<?php echo form_open('welcome/login_form/'); ?>
		<div class="input-group">
			<span class="input-group-addon">Email</span>
			<input id="email" type="text" class="form-control" name="email" placeholder="Email" >
		</div>

		<div class="input-group">
            <span class="input-group-addon">Password</span>
            <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
        </div>
        <div class="btn-group">
            <input class="btn btn-default" type="submit" value="Login">
            <input class="btn btn-default" type="reset" value="Cancel">
        </div>
	</form>
</div>