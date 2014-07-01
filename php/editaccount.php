<?php
require("connect.php");

if(empty($_SESSION['user'])) {
	header("location: ../indexlogin.php");
	die("Redirecting to: indexlogin.php"); 
}

$previous = $_SERVER['HTTP_REFERER'];

// to-do fix error checking

if((isset($_POST['update_account'])) || (isset($_POST['finish_register']))) {
	if(empty($_POST['user_firstname']) || empty($_POST['user_lastname'])) { 
		$error = 'Please fill all fields.';
		$_SESSION['errors']['account'] = $error;
		header("Location:$previous");
		die("Redirecting to previous page."); 
	}

	if($_POST['user_contactnumber'] == "") {
		$user_contactnumber = "0";
	}
	else {
		$user_contactnumber = $_POST['user_contactnumber'];
	}
	$user_id = $_SESSION['user']['id'];

	if($_FILES["user_image"]["error"] > 0) { //TODO
		$query_params = array(
		':user_id' => $user_id,
		':user_firstname' => $_POST['user_firstname'],
		':user_lastname' => $_POST['user_lastname'],
		':user_email' => $_POST['user_email'],
		':user_number' => $user_contactnumber);

		$check_query = "
		UPDATE users
		SET first_name=:user_firstname, last_name=:user_lastname, email=:user_email, contact_number=:user_number
		WHERE id=:user_id";
	}
	else { //add image of user
		$uploads_dir = '../uploads/users';
		$tmp_name = $_FILES["user_image"]["tmp_name"];
		$extension = strrchr($_FILES["user_image"]["name"], '.');
		$image = $user_id . $extension;
		move_uploaded_file($tmp_name, "$uploads_dir/$image");

		$query_params = array(
		':user_id' => $user_id,
		':user_firstname' => $_POST['user_firstname'],
		':user_lastname' => $_POST['user_lastname'],
		':user_email' => $_POST['user_email'],
		':user_image' => $image,
		':user_number' => $user_contactnumber);

		$check_query = "
		UPDATE users
		SET first_name=:user_firstname, last_name=:user_lastname, email=:user_email, contact_number=:user_number, image=:user_image
		WHERE id=:user_id";
	}
	
	

	try {  
		$stmt = $db->prepare($check_query); 
		$result = $stmt->execute($query_params); 
	} 
	catch(PDOException $ex) { //to-do
		die("Failed to run check query: " . $ex->getMessage()); 
	}
 	
 	$query = "
		SELECT id, first_name, last_name, obf_email, email, contact_number
		FROM users
		WHERE id=\"$user_id\"";
	try { 
		$stmt = $db->prepare($query); 
		$result = $stmt->execute(); 
	} 
	catch(PDOException $ex) {
		die("Failed to run register query: " . $ex->getMessage()); 
	}
	$row = $stmt->fetch();

	// Login
	$_SESSION['user'] = $row;
	$id = $_SESSION['user']['id'];
}
	if(isset($_POST['finish_register'])) {
		header("location: ../index.php");
		die("Redirecting to: index.php");
	}
	else {
		header("location: ../profile.php?id=$id");
		die("Redirecting to: profile.php");
	}
?>