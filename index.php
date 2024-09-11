<!DOCTYPE html>
<html>
    <head>
        <title>ChainGuard</title>
    </head>
    <body>
        <div class="panel">
            <h1>ChainGuard</h1>
            <hr>
			<form action="validatelogin.php" method="POST">
				<label for="username">*Username</label>
				<input type="text" id="username" name="username" placeholder="Username" required><br/><br/>

				<label for="password">*Password</label>
				<input type="password" id="password" name="password" required><br/><br/>
            
				<input type="submit" value="Log In">
			</form>
            <a href="#">Forgot Password?</a>
        </div>
    </body>
</html>
