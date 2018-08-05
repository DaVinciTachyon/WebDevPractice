<?php include('loginServer.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Link Shortener - Register</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h2>Register</h2>
</div>
<div class="content">
  <!-- The form used to register a new user -->
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
    <!-- A user may not want to be in a corporate account, so it is optional -->
    <div class="input-group">
  	  <label>Company Name (optional)</label>
  	  <input type="text" name="company_name">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>

    <!-- Allows member to log in -->
  	<p>Already a member? <a href="login.php">Sign in</a></p>
  </form>
</div>
</body>
</html>
