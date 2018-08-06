<?php
session_start();

// initializing variables
$db_username = "root";          //change if necessary
$db_password = "LinkShortner";  //change if necessary
$db_name = "LinkShortener";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', $db_username, $db_password, $db_name);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $company_name = mysqli_real_escape_string($db, $_POST['company_name']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

    if($company_name) //if the user is part of a company
    {
      //look for company
      $company_check_query = "SELECT * FROM companies WHERE name='$company_name' LIMIT 1";
      $result = mysqli_query($db, $company_check_query);
      $company = mysqli_fetch_assoc($result);

      if (!$company) { //if the company does not already exist, create it
        $query = "INSERT INTO companies (name)
      			  VALUES('$company_name')";
      	mysqli_query($db, $query);
        $company_check_query = "SELECT * FROM companies WHERE name='$company_name' LIMIT 1";
        $result = mysqli_query($db, $company_check_query);
        $company = mysqli_fetch_assoc($result);
      }

      //insert the new user into the database
      $company_id = $company['company_id'];
      $query = "INSERT INTO users (username, email, password, company_id)
            VALUES('$username', '$email', '$password', '$company_id')";
      mysqli_query($db, $query);
    } else {
      //insert the new user into the database
      $query = "INSERT INTO users (username, email, password)
    			  VALUES('$username', '$email', '$password')";
    	mysqli_query($db, $query);
    }

    //get user id
    $id_query = "SELECT * FROM users WHERE email='$email' AND username='$username' AND password='$password'";
    $id_query = mysqli_query($db, $id_query);
    $id_query = mysqli_fetch_assoc($id_query);
    $user_id = $id_query['user_id'];

    //give user a certain level of access (currently unable to vary it)
    $query = "INSERT INTO access_control (user_id, access_control)
  			  VALUES('$user_id', '2')";
    mysqli_query($db, $query);

    //start a new session
    $query = "INSERT INTO session_id (user_id)
  			  VALUES('$user_id')";
    mysqli_query($db, $query);

    //get the session id
    $id_query = "SELECT * FROM session_id WHERE user_id='$user_id'";
    $id_query = mysqli_query($db, $id_query);
    $id_query = mysqli_fetch_assoc($id_query);
    $session_id = $id_query['session_id'];

    //log in
  	$_SESSION['session_id'] = $session_id;
  	$_SESSION['success'] = "You are now logged in";
  	header('Location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  //get the username and password once submitted
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);

    //look for user in database
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) { //if the user exists
      $id_query = mysqli_fetch_assoc($results);
      $user_id = $id_query['user_id'];

      //start new session
      $query = "INSERT INTO session_id (user_id)
    			  VALUES('$user_id')";
      mysqli_query($db, $query);

      //find session_id
      $id_query = "SELECT * FROM session_id WHERE user_id='$user_id'"; //Make sure there is only one of that user_id at a time
      $id_query = mysqli_query($db, $id_query);
      $id_query = mysqli_fetch_assoc($id_query);
      $session_id = $id_query['session_id'];

      //log in
  	  $_SESSION['session_id'] = $session_id;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('Location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
?>
