<?php include('listScript.php') ?>
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
	<h2>Links Shortened - list</h2>
</div>
<div class="content">
  <!-- Welcomes the user -->
  <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>.</p>

  <!-- Allows website navigation -->
  <form action="index.php">
    <button type="submit" class="btn">Create Links</button>
    <button type="submit" class="btn" name="logout" style="background: red;">Log Out</button>
  </form>

  <!-- Link searchbar -->
  <form action="list.php">
    <div class="input-group">
      <input type="text" name="search_input" style="width:75%;" placeholder="Search for link....">
      <button type="submit" class="btn" style="width:15%; min-width: 70px;">Search</button>
    </div>
  </form>

  <!-- Table containing the appropriate links -->
  <table id="URLTable" class="data-table">
    <thead>
      <tr>
        <th>ORIGINAL URL</th>
        <th>SHORTENED URL</th>
				<th>MORE INFO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($row = mysqli_fetch_array($row_query))
      {
        $link_id = $row['link_id'];
				$code = "r.php?c=".$row['short_code']."";
        echo '<tr>
                <td><a href='.$row['long_url'].' target="_blank">'.$row['long_url'].'</a></td>
                <td><a href='.$code.' target="_blank">localhost/Short/'.$code.'</a></td>
								<td><a href="linkAnalytics.php?link_id='.$link_id.'">click here</a></td>
                <td><a href="list.php?delete='."1".'&link_id='.$link_id.'">delete</a></td>
              </tr>';
      }
      ?>
    </tbody>
  </table>
</div>
</body>
<?php endif ?>
</html>
