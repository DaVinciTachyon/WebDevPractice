<?php include('loginServer.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Link Shortener - Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h2>Login</h2>
</div>
<!-- Displays any potential error messages -->
<div class="content">
  <?php if (isset($_SESSION['msg'])) : ?>
    <div class="error" >
      <h3>
        <?php
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        ?>
      </h3>
    </div>
  <?php endif ?>

  <!--The log in form -->
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>

    <!-- Allows non-members to register -->
  	<p>Not yet a member? <a href="register.php">Sign up</a></p>
  </form>
</div>
</body>
</html>
