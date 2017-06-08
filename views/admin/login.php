<form action="login/runLogin" method="post">
    <h1>Admin Login</h1>
    <div id="formlogin" class="form-group">
        <input type="hidden" name="token" value="<?php echo $token; ?>" />
        <label>Username</label><input type="text" name="username" class="form-control" />
        <label>Password</label><input type="password" name="password" class="form-control" />
         <input type="submit" value="login" class="btn btn-primary" />
    </div>
</form>
