<?php
if(isset($_POST['search_button'])) {
	$keywords = $_POST['search'];
	$query = "
		SELECT *
		FROM auction
		WHERE name LIKE '%$keywords%' OR category LIKE '%$keywords%'";
}
else if(isset($_POST['category'])){
	$keyword = $_POST['category'];
	$query = "
		SELECT *
		FROM auction
		WHERE category LIKE '%$keyword%'
		ORDER BY duration DESC;";
}
else if(isset($user_id)) {
	if($flag == 0) {
	$query = "
		SELECT *
		FROM auction
		WHERE seller_id = $user_id";		
	}
	else {
	$query = "
		SELECT *
		FROM auction
		WHERE id in
		(SELECT DISTINCT auction_id FROM bid WHERE user_id = $user_id)";
	}
}
else {
	$query = "
		SELECT *
		FROM auction
		WHERE status='ONGOING'
		ORDER BY duration DESC
		";
}

try {  
	$stmt = $db->prepare($query); 
	$result = $stmt->execute(); 
} 
catch(PDOException $ex) {
	die("Failed to run check query: " . $ex->getMessage()); 
}
$rows = $stmt->fetchAll();
$html = "";
$script = "";

if(!empty($rows)) 
{
	$script = "<script type=\"text/javascript\">";
	
	foreach($rows as $row) {
	$id = $row['id'];
	$name = $row['name'];
	$duration = $row['duration'];
	$price = $row['price'];
	$description = $row['description'];
	if($row['images'] == NULL) {
		$image = "0.PNG";
	}
	else {
		$image = substr($row['images'], 0, strpos($row['images'], ", "));
	}
	$date = $row['duration'];

	$html = "
	<a href=\"item.php?id=$id\"><div class=\"listitem col3\">
		<img src=\"uploads/$image\">
		<div class=\"itemtext\">
			<h3>$name</h3>
			<h5>$description</h5><br>
			<h5 class=\"textgrey\">Minimum Bid: P$price</h5>
			<h5 class=\"textgrey\">Current Bid: PXXXX</h5>
			<h5 class=\"textgrey\">Closes in: <span id=\"countdown$id\">000hrs 00mins 00secs</span></h5>
		</div>
	</div></a>
	". $html;
	
	$today = date("U");
	$date = strtotime($date);
	$diff = $date - $today;
	/* to-do */
	if($diff < 0) {
		$diff = 0;
		
		$auction_id = $id;
		$query = "
				SELECT amount, user_id
				FROM bid 
				WHERE auction_id = $auction_id 
				ORDER BY amount DESC 
				LIMIT 1";

		try { 
			$stmt = $db->prepare($query); 
			$result = $stmt->execute(); 
		} 
		catch(PDOException $ex) {
			die("Failed to run register query: " . $ex->getMessage()); 
		}
		$row = $stmt->fetch();

		/* No Bid */
		if(!empty($row)) {
			$buyer_id = $row['user_id'];

			$query = "
				UPDATE auction
				SET buyer_id = $buyer_id, status = 'SOLD'
				WHERE id=$auction_id";

			try { 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute(); 
			} 
			catch(PDOException $ex) {
				die("Failed to run register query: " . $ex->getMessage()); 
			}
		}

		/* Highest Bid */
		else {
			$query = "
				UPDATE auction
				SET status = 'EXPIRED'
				WHERE id=$auction_id";

			try { 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute(); 
			} 
			catch(PDOException $ex) {
				die("Failed to run register query: " . $ex->getMessage()); 
			}
		}
	}
	else {
	$script = $script."
		startTimer($diff, \"countdown$id\");";
	}
	}	
}
else {
	$html = "
	<div>
		<p>Sorry, there are currently no auctions available.</p>
	<div>";
}
/*
if(isset($_POST['search_button'])) {
	header('location: default.php');
	die("Redirecting to: default.php"); 
}
*/
	$script = $script."</script>";
	echo $script . "" .	$html;

return;
?>