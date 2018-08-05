<?php include('indexScript.php'); ?>
<!DOCTYPE html>
<html>
<!-- only runs if logged in -->
<?php  if (isset($_SESSION['session_id'])) : ?>
<head>
	<title>Link Shortener</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Link Shortener</h2>
</div>

<div class="content">
	<!-- prints login message -->
	<?php if (isset($_SESSION['success'])) : ?>
    <div class="error success" >
    	<h3>
        <?php
        	echo $_SESSION['success'];
        	unset($_SESSION['success']);
        ?>
    	</h3>
    </div>
	<?php endif ?>

	<!-- prints a new link -->
	<?php if (isset($link)) : ?>
    <div class="error link">
    	<h3>
        <?php
        	echo $link;
        	unset($link);
        ?>
    	</h3>
    </div>
	<?php endif ?>

  <!-- Welcomes the user -->
  <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>.</p>

  <!-- Allows website navigation -->
  <form action="list.php">
    <button type="submit" class="btn">View Links</button>
    <button type="submit" class="btn" name="logout" style="background: red;">Log Out</button>
  </form>

  <!-- The url shortener interface -->
  <form method="post" action="index.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
  	  <input type="text" name="url" style="width:70%;" placeholder="What URL do you want shortened?">
      <button type="submit" class="btn" name="shorten" style="width:20%; min-width: 70px;">Shorten</button>
  	</div>
  </form>
</div>
</body>
<?php endif ?>
</html>
