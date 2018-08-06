<?php
//Starts session for page
session_start();

//If a user is not logged in it returns them to the log in page
if (!isset($_SESSION['session_id'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
  exit;
}

// initializing variables
$db_username = "root";					//change if necessary
$db_password = "LinkShortner";	//change if necessary
$db_name = "LinkShortener";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', $db_username, $db_password, $db_name);

$link_id = mysqli_real_escape_string($db, $_GET['link_id']);

$row_query = "SELECT * FROM link_".$link_id."";
$row_query = mysqli_query($db, $row_query);
?>
<!DOCTYPE html>
<html>
<!-- only runs if logged in -->
<?php  if (isset($_SESSION['session_id'])) : ?>
<head>
	<title>Links Shortened - Details</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Links Shortened</h2>
</div>
<div class="content">
  <!-- Welcomes the user -->
  <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>.</p>

  <!-- Allows website navigation -->
  <form action="list.php">
    <button type="submit" class="btn">All Links</button>
  </form>

  <!-- Table containing the appropriate links -->
  <table class="data-table">
    <thead>
      <tr>
        <th>DATE CREATED</th>
        <th>IP ADDRESS</th>
				<th>LOCATION</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($row = mysqli_fetch_array($row_query))
      {
        $date_created = date('D, d M Y - h:i:s', $row['date_created']);
        echo '<tr>
                <td>'.$date_created.'</td>
                <td>'.$row['ip_address'].'</td>
                <td>'.$row['location'].'</td>
              </tr>';
      }
      ?>
    </tbody>
  </table>
</div>
</body>
<?php endif ?>
</html>
