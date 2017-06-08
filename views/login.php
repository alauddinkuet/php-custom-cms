<div id="formlogin">
<h1>Login</h1>
<form action="login/runLogin" method="post">
	<input type="hidden" name="token" value="<?php echo $token; ?>" />
	<label>User</label><br /><input type="text" name="username" />(admin)<br />
	<label>Password</label><br /><input type="password" name="password" />(test)<br />
	 <input type="submit" value="login" />
</form>
</div>
