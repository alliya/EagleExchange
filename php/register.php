<?php
require("connect.php");
// to-do fix error checking
if(isset($_POST['register'])) {
	// empty error checking
	if(empty($_POST['user_id']) || empty($_POST['user_password']) || empty($_POST['user_email'])) { 
		$error = 'Please fill all fields.';
		$_SESSION['errors']['register'] = $error;
		header('location: ../indexlogin.php');
		die("Redirecting to: indexlogin.php"); 
	} 
	else if(substr($_POST['user_email'], -15) != "@obf.ateneo.edu" || (!filter_var($_POST['user_email'],  FILTER_VALIDATE_EMAIL))) {
		$error = "Please enter a valid Ateneo email address.";
		$_SESSION['errors']['register'] = $error;
		header('location: ../indexlogin.php');
		die("Redirecting to: indexlogin.php"); 
	}
	else if(!(isset($_POST['user_legal']))) {
		$error = "You must agree to the non-existing terms in order to user our service.";
		$_SESSION['errors']['register'] = $error;
		header('location: ../indexlogin.php');
		die("Redirecting to: indexlogin.php"); 
	}
	
	$password = $_POST['user_password'];
	$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
	$password = hash('sha256', $_POST['user_password'] . $salt);
	for($round = 0; $round < 65536; $round++) {
		$password = hash('sha256', $password . $salt); 
	}
	
	$query_params = array(
		':user_id' => $_POST['user_id'],
		':user_email' => $_POST['user_email']);
	
	$check_query = "
		SELECT *
		FROM users
		WHERE id=:user_id OR obf_email=:user_email";
	//$register_row = mysql_fetch_row($register_result);
	
	try {  
		$stmt = $db->prepare($check_query); 
		$result = $stmt->execute($query_params); 
	} 
	catch(PDOException $ex) { //to-do
		die("Failed to run check query: " . $ex->getMessage()); 
	}
	$row = $stmt->fetch(); 	

	/* to-do: id # of digits checking */
	if($row) {
		$error = 'You are already registered.';
		$_SESSION['errors']['register'] = $error;
		header('location: ../indexlogin.php');
		die("Redirecting to: indexlogin.php");
	}
	else {
		$query_params = array(
			':user_id' => $_POST['user_id'],
			':user_email' => $_POST['user_email'],
			':user_password' => $password,
			':user_salt' => $salt);
		
		$query = "
			INSERT INTO users(
				id, obf_email, password, salt) 
			VALUES ( :user_id, :user_email, :user_password, :user_salt)";
		try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
		} 
        catch(PDOException $ex) {
            die("Failed to run register query: " . $ex->getMessage()); 
		}
		$query = "
			SELECT id, obf_email
			FROM users
			WHERE id=" . $query_params[':user_id'];	
		try {  
			$stmt = $db->prepare($query); 
			$result = $stmt->execute(); 
		} 
		catch(PDOException $ex) { //to-do
			die("Failed to run check query: " . $ex->getMessage()); 
		}
		$row = $stmt->fetch();
		
		// Login
		$_SESSION['user'] = $row;
		header("location: ../register.php");
		die("Redirecting to: register.php"); 
	}
}
?>