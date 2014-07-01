<?php

$username = "root"; 
$password = ""; 
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

try 
{ 
	while(TRUE)
	{
		//echo "Updater running...\n";
		$query = "SELECT id from auction WHERE status='ONGOING' AND duration < NOW()";
		$stmt = $db->prepare($query); 
		$result = $stmt->execute(); 
		while($row = $stmt->fetch())
		{
			echo "Processing id: " . $row[0] ."\n";
			$query2 = "SELECT user_id FROM bid WHERE auction_id=" . $row[0] . " ORDER BY bid_date DESC LIMIT 1";
			$stmt2 = $db->prepare($query2); 
			$result2 = $stmt2->execute();
			if($stmt2->rowCount() > 0)
			{
				$row2 = $stmt2->fetch();
				$query3 = "UPDATE auction SET status='SOLD', buyer_id=". $row2[0] ." WHERE id=" . $row[0];
				$stmt3 = $db->prepare($query3); 
				$result3 = $stmt3->execute();
				echo "SOLD id: " . $row[0] ."\n";
			}
			else
			{
				$query3 = "UPDATE auction SET status='EXPIRED' WHERE id=" . $row[0];
				$stmt3 = $db->prepare($query3); 
				$result3 = $stmt3->execute();
				echo "EXPIRED id: " . $row[0] ."\n";
			}
		}
		
	}
	
	
} 
catch(PDOException $ex)
{
	die("Failed to run query: " . $ex->getMessage()); 
}



?>