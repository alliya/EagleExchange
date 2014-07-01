<?php
require ("connect.php");


if(isset($_POST['login'])) {
	$user_id = $_POST['user_id'];
	$query = "
		SELECT id, first_name, last_name, obf_email, email, password, salt
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
		
	$check_password = hash('sha256', $_POST['user_password'] . $row['salt']); 
	for($round = 0; $round < 65536; $round++) {
		$check_password = hash('sha256', $check_password . $row['salt']); 
	}
	
	if($user_id == "" || $_POST['user_password'] == "") {
		$error = "You must fill in all login fields.";
		$_SESSION['errors']['login'] = $error;
		header('location: ../indexlogin.php');
		die("Redirecting to: indexlogin.php"); 
	}
	else if(!($row) || $row['password'] != $check_password) {
		$error = "Invalid user or password.";
		$_SESSION['errors']['login'] = $error;
		header('location: ../indexlogin.php');
		die("Redirecting to: indexlogin.php");
	}
	else {
		unset($row['salt']); 
		unset($row['password']); 
		$_SESSION['user'] = $row;
		debug("User: ". $_POST['user_id'] . " has logged in");
		if(isset($_SESSION['user']['first_name'])) {
			header("location: ../index.php");
			die("Redirecting to: index.php"); 
		}
		else {
			header("location: ../register.php");
			die("Redirecting to: register.php"); 
		}
	}
}
else { 
	echo "Login Failed."; 
}
?>