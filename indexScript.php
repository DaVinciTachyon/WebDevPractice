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
$db_username = "root";          //change if necessary
$db_password = "LinkShortner";  //change if necessary
$db_name = "LinkShortener";
unset($errors);
$errors = array();
$chars = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

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

//get user id from session id
$session_id = $_SESSION['session_id'];
$id_query = "SELECT * FROM session_id WHERE session_id='$session_id'";
$id_query = mysqli_query($db, $id_query);
$id_query = mysqli_fetch_assoc($id_query);
$user_id = $id_query['user_id'];

//get username from user id
$user_query = "SELECT * FROM users WHERE user_id='$user_id'";
$user_query = mysqli_query($db, $user_query);
$user_query = mysqli_fetch_assoc($user_query);
$_SESSION['username'] = $user_query['username'];

// SHORTEN URL
if (isset($_POST['shorten'])) {

  // receive all input values from the form
  $url = mysqli_real_escape_string($db, $_POST['url']);

  $company_id = $user_query['company_id'];
  $timestamp = time();
  try {
    if(empty($url)) {
      array_push($errors, "No URL was supplied.");
    } else if(!validateUrlFormat($url)) {
      array_push($errors, "Url does not have a valid format.");
    } else if(!verifyUrlExists($url)) {
      array_push($errors, "URL does not appear to exist.");
    } else {
      if($company_id) {
        $shortCode = urlExistsInDbWithCompany($url, $db, $company_id);
      } else {
        $shortCode = urlExistsInDb($url, $db, $user_id);
      }
      if($shortCode == false) {
        $shortCode = createShortCode($url, $db, $timestamp, $user_id, $company_id, $chars, $errors);
      }
    }
    if(count($errors) == 0) {
      $code = "r.php?c=".$shortCode."";
      $link = "Shortened url of <a href='".$url."' target='_blank'>". $url ."</a> is <a href=" . $code . " target='_blank'>localhost/Short/" . $code . "</a>";
    }
  } catch(Exception $e) {
    array_push($errors, "Error when shortening url.");
  }
}

function validateUrlFormat($url)
{
  return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
}

function verifyUrlExists($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_exec($ch);
  $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  return(!empty($response) && $response != 404);
}

function urlExistsInDb($url, $db, $user_id)
{
  $query = "SELECT short_code FROM short_urls WHERE long_url='$url' AND user_id='$user_id' LIMIT 1";
  $result = mysqli_query($db, $query);
  $result = mysqli_fetch_assoc($result);
  return(empty($result)) ? false : $result["short_code"];
}

function urlExistsInDbWithCompany($url, $db, $company_id)
{
  $query = "SELECT short_code FROM short_urls WHERE long_url='$url' AND company_id='$company_id' LIMIT 1";
  $result = mysqli_query($db, $query);
  $result = mysqli_fetch_assoc($result);
  return(empty($result)) ? false : $result["short_code"];
}

function createShortCode($url, $db, $timestamp, $user_id, $company_id, $chars, $errors)
{
  if($company_id) {
    $link_id = insertUrlInDbWithCompany($url, $db, $timestamp, $user_id, $company_id);
  } else {
    $link_id = insertUrlInDb($url, $db, $timestamp, $user_id);
  }
  $shortCode = convertIntToShortCode($link_id, $chars, $errors);
  if($company_id) {
    insertShortCodeInDbWithCompany($db, $company_id, $link_id, $shortCode, $errors);
  } else {
    insertShortCodeInDb($db, $user_id, $link_id, $shortCode, $errors);
  }
  createTable($db, $link_id);
  return $shortCode;
}

function createTable($db, $link_id)
{
  $query = "CREATE TABLE link_" . $link_id . " (
    `ip_address` varchar(15) NOT NULL,
    `date_created` INTEGER UNSIGNED NOT NULL,
    `location` varchar(100)
    )";
  mysqli_query($db, $query);
}

function insertUrlInDb($url, $db, $timestamp, $user_id)
{
  $query = "INSERT INTO short_urls (long_url, date_created, user_id, short_code) VALUES ('$url', '$timestamp', '$user_id', '0')";
  mysqli_query($db, $query);

  //get link id from url
  $id_query = "SELECT * FROM short_urls WHERE long_url='$url' AND user_id='$user_id'";
  $id_query = mysqli_query($db, $id_query);
  $id_query = mysqli_fetch_assoc($id_query);
  return $id_query['link_id'];
}

function insertUrlInDbWithCompany($url, $db, $timestamp, $user_id, $company_id)
{
  $query = "INSERT INTO short_urls (long_url, date_created, user_id, short_code, company_id) VALUES ('$url', '$timestamp', '$user_id', '0', $company_id)";
  mysqli_query($db, $query);

  //get link id from url
  $id_query = "SELECT * FROM short_urls WHERE long_url='$url' AND company_id='$company_id'";
  $id_query = mysqli_query($db, $id_query);
  $id_query = mysqli_fetch_assoc($id_query);
  return $id_query['link_id'];
}

function convertIntToShortCode($link_id, $chars, $errors)
{
  $link_id = intval($link_id);
  if($link_id < 1) {
    array_push($errors, "The ID is not a valid integer.");
  }

  $length = strlen($chars);
  //make sure length of available characters is at least a reasonable minimum
  //there should be at least 10 characters
  if($length < 10) {
    array_push($errors, "Length of chars is too small");
  }

  $code = "";
  while($link_id > $length - 1) {
    //determine the value of the next higher character in the short code should be and prepend
    $code = $chars[fmod($link_id, $length)] . $code;
    //rest $link_id to remaining value to be converted
    $link_id = floor($link_id / $length);
  }
  //remaining value of $link_id is less than the length of $chars
  $code = $chars[$link_id]. $code;

  return $code;
}

function insertShortCodeInDb($db, $user_id, $link_id, $code, $errors) {
  if($link_id == null || $code == null) {
    array_push($errors, "Input parameter(s) invalid.");
  }
  $query = "UPDATE short_urls SET short_code = '$code' WHERE link_id = '$link_id' AND user_id='$user_id'";
  $query = mysqli_query($db, $query);

  return true;
}

function insertShortCodeInDbWithCompany($db, $company_id, $link_id, $code, $errors) {
  if($link_id == null || $code == null) {
    array_push($errors, "Input parameter(s) invalid.");
  }
  $query = "UPDATE short_urls SET short_code = '$code' WHERE link_id = '$link_id' AND company_id='$company_id'";
  mysqli_query($db, $query);

  return true;
}
?>
