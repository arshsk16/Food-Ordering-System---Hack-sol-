<?php
session_start();

// initializing variables
$UserId = "";
$EmailIdId    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $UserId = mysqli_real_escape_string($db, $_POST['UserId']);
  $EmailId = mysqli_real_escape_string($db, $_POST['EmailId']);
  $Password_1 = mysqli_real_escape_string($db, $_POST['Password_1']);
  $Password_2 = mysqli_real_escape_string($db, $_POST['Password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($UserId)) { array_push($errors, "UserId is required"); }
  if (empty($EmailId)) { array_push($errors, "EmailId is required"); }
  if (empty($Password_1)) { array_push($errors, "Password is required"); }
  if ($Password_1 != $Password_2) {
	array_push($errors, "The two Passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same UserId and/or EmailId
  $user_check_query = "SELECT * FROM users WHERE UserId='$UserId' OR EmailId='$EmailId' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['UserId'] === $UserId) {
      array_push($errors, "UserId already exists");
    }

    if ($user['EmailId'] === $EmailId) {
      array_push($errors, "EmailId already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$Password = md5($Password_1);//encrypt the Password before saving in the database

  	$query = "INSERT INTO users (UserId, EmailId, Password) 
  			  VALUES('$UserId', '$EmailId', '$Password')";
  	mysqli_query($db, $query);
  	$_SESSION['UserId'] = $UserId;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $UserId = mysqli_real_escape_string($db, $_POST['UserId']);
  $Password = mysqli_real_escape_string($db, $_POST['Password']);

  if (empty($UserId)) {
  	array_push($errors, "UserId is required");
  }
  if (empty($Password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$Password = md5($Password);
  	$query = "SELECT * FROM users WHERE UserId='$UserId' AND Password='$Password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['UserId'] = $UserId;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong UserId/Password combination");
  	}
  }
}

?>