<?php
//http://forums.devshed.com/php-faqs-and-stickies-167/how-to-program-a-basic-but-secure-login-system-using-891201.html
$username = "root"; 
$password = "root"; 
$host = "localhost"; 
$dbname = "eagle_exchange"; 

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 

try { 
	$db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
} 
catch(PDOException $ex) 
{ 
	die("Failed to connect to the database: " . mysql_error()); 
} 
 
// This statement configures PDO to throw an exception when it encounters an error.  This allows us to use try/catch blocks to trap database errors. 
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
 
// This statement configures PDO to return database rows from your database using an associative array.  This means the array will have string indexes, where the string value represents the name of the column in your database. 
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
 
// This block of code is used to undo magic quotes.  Magic quotes are a terrible feature that was removed from PHP as of PHP 5.4.  However, older installations 
// of PHP may still have magic quotes enabled and this code is necessary to prevent them from causing problems.  For more information on magic quotes: 
// http://php.net/manual/en/security.magicquotes.php 
if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) { 
	function undo_magic_quotes_gpc(&$array) { 
		foreach($array as &$value) { 
			if(is_array($value)) { 
				undo_magic_quotes_gpc($value); 
			} 
			else { 
				$value = stripslashes($value); 
			} 
		} 
	} 
 
	undo_magic_quotes_gpc($_POST); 
	undo_magic_quotes_gpc($_GET); 
	undo_magic_quotes_gpc($_COOKIE); 
}

date_default_timezone_set('Asia/Manila');

header('Content-Type: text/html; charset=utf-8'); 
session_name("login"); // Starting the session
session_set_cookie_params(2*7*24*60*60); // Making the cookie live for 2 weeks
session_start();
?>