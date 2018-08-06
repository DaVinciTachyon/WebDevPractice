<?php

$db_username = "root";          //change if necessary
$db_password = "LinkShortner";  //change if necessary
$db_name = "LinkShortener";

$chars = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

$db = mysqli_connect('localhost', $db_username, $db_password, $db_name);
$code = mysqli_real_escape_string($db, $_GET['c']);

try {
  $url = shortCodeToUrl($db, $code, $chars);
  header("Location: " . $url);
  exit;
} catch(Exception $e) {
  echo "The link you have entered is not valid.";
}

function shortCodeToUrl($db, $code, $chars) {
  if(empty($code)) {
    echo "No short code was supplied.";
  }
  if(!validateShortCode($code, $chars)) {
    echo "Short code does not have a valid format.";
  }
  $urlRow = getUrlFromDb($db, $code);
  if(empty($urlRow)) {
    echo "Short code does not appear to exist.";
  } else {
    logConnection($db, $urlRow['link_id']);
  }

  return $urlRow["long_url"];
}

function validateShortCode($code, $chars) {
  return preg_match("|[" . $chars . "]+|", $code);
}

function getUrlFromDb($db, $code) {
  $query = "SELECT link_id, long_url FROM short_urls WHERE short_code = '$code' LIMIT 1";
  $query = mysqli_query($db, $query);
  $result = mysqli_fetch_assoc($query);
  return (empty($result)) ? false : $result;
}

function logConnection($db, $link_id)
{
  $ip_address = getClientIP();
  $timestamp = time();
  $details = json_decode(file_get_contents("http://ipinfo.io/".$ip_address."/json"));
  if($details->country) {
    $query = "INSERT INTO link_" . $link_id . " (ip_address, date_created, location) VALUES ('$ip_address', '$timestamp', '$details->country')";
  } else {
    $query = "INSERT INTO link_" . $link_id . " (ip_address, date_created, location) VALUES ('$ip_address', '$timestamp', 'private')";
  }
  $query = mysqli_query($db, $query);
}
/*$ curl ipinfo.io/8.8.8.8
{
  "ip": "8.8.8.8",
  "hostname": "google-public-dns-a.google.com",
  "loc": "37.385999999999996,-122.0838",
  "org": "AS15169 Google Inc.",
  "city": "Mountain View",
  "region": "CA",
  "country": "US",
  "phone": 650
}*/

// Function to get the client IP address
function getClientIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>
