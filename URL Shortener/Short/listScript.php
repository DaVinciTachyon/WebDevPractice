<?php
//Starts session for page
session_start();

//If a user is not logged in it returns them to the log in page
if(!isset($_SESSION['session_id'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
  exit;
}

// initializing variables
$db_username = "root";          //change if necessary
$db_password = "LinkShortner";  //change if necessary
$db_name = "LinkShortener";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', $db_username, $db_password, $db_name);

//if the user logs out, it returns them to the log in page
if (isset($_GET['logout'])) {
  $session_id = $_SESSION['session_id'];
  $query = "DELETE from session_id where session_id = '$session_id'";
  mysqli_query($db, $query);
  unset($_SESSION['session_id']);
  session_destroy();
  header("location: login.php");
  exit;
}

//DELETE link
if(isset($_GET['delete'])) {
  $link_id = mysqli_real_escape_string($db, $_GET['link_id']);
  $query = "DELETE from short_urls where link_id='$link_id'";
  mysqli_query($db, $query);
  $query = "drop table link".$link_id."";
  mysqli_query($db, $query);
  unset($_GET['delete']);
  unset($_GET['link_id']);
}

//get user id from session id
$session_id = $_SESSION['session_id'];
$id_query = "SELECT * FROM session_id WHERE session_id='$session_id'";
$id_query = mysqli_query($db, $id_query);
$id_query = mysqli_fetch_assoc($id_query);
$user_id = $id_query['user_id'];

//get company id from user id
$id_query = "SELECT * FROM users WHERE user_id='$user_id'";
$id_query = mysqli_query($db, $id_query);
$id_query = mysqli_fetch_assoc($id_query);
$company_id = $id_query['company_id'];

//SEARCH
if(isset($_GET['search_input'])) //if there was a search made
{
  $search_input = mysqli_real_escape_string($db, $_GET['search_input']);

  //Search the database
  if($company_id) //if corporate account
  {
    $query = "SELECT * FROM short_urls WHERE company_id='$company_id' AND long_url like '%$search_input%'";
  } else {
    $query = "SELECT * FROM short_urls WHERE user_id='$user_id' AND long_url like '%$search_input%'";
  }
  $row_query = mysqli_query($db, $query);
  unset($_GET['search_input']);
} else {
  if($company_id) //if corporate account
  {
    $query = "SELECT * FROM short_urls WHERE company_id='$company_id'";
  } else {
    $query = "SELECT * FROM short_urls WHERE user_id='$user_id'";
  }
  $row_query = mysqli_query($db, $query);
}
?>
