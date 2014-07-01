<?php
require("php/connect.php");


if(empty($_GET['id'])) {// to-do
	echo "Error: No id was passed.";
	die();
}
else {
	$id = $_GET['id'];
	// SELECT auction.*, users.first_name, users.last_name
	// 	FROM auction, users
	// 	WHERE auction.seller_id = users.id AND auction.id = $id
	// 	LIMIT 1"
	$query = "
		SELECT *
		FROM auction
		WHERE id=$id";
	try {
		$stmt = $db->prepare($query); 
		$result = $stmt->execute(); 
	} 
	catch(PDOException $ex) {
		die("Failed to run register query: " . $ex->getMessage()); 
	}
	$row = $stmt->fetch();

	$name = $row['name'];
	$seller_id = $row['seller_id'];
	$category = $row['category'];
	$condition = $row['condition'];
	$date = $row['duration'];
	$price = $row['price'];
	if($row['images'] == NULL) {
		$image = "0.PNG";
	}
	else {
		$image = substr($row['images'], 0, strpos($row['images'], ", "));
	}
	$description = $row['description'];
	$status = $row['status'];

	$amount = 0;
	$bid = $price;
	$query = "
		SELECT amount, user_id
		FROM bid 
		WHERE auction_id = $id 
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
	if(!empty($row)) {
		$amount = $row['amount'];
		$bid = $amount;
	}

	$today = date("U");
	$date = strtotime($date);
	$diff = $date - $today;	
}

include 'header.php';
?>
<div id="container">
	<div class="wrapper">
		<div class="col4 left1">
			<div id="userphoto">
				<img src="uploads/<?php echo $image; ?>" width="300">
			</div>
		</div>
		<div class="col6 right1">
			<h1 class="textblue"><?php echo $name; ?></h1>
			<h6><?php echo $description; ?></h6><br>
			<p></p>
			<h4>
				Highest Bid: <?php echo $amount; ?><br>
				Starting Bid: <?php echo $price; ?><br>
				Posted by: <a href ="profile.php?id=<?php echo $seller_id; ?>" style = "text-decoration: none"><?php echo $seller_id; ?></a><br>
				Condition: <?php echo $condition; ?><br>
				Tags: <?php echo $category; ?>
			</h4>
			<h2 id="countdown<?php echo $id; ?>">000hrs 00mins 00secs</h2>
			<?php if($status == 'ONGOING') : ?>
				<form action="php/bid.php" method="POST">
					<input type="hidden" name="auction_id" value="<?php echo $id; ?>"/>
					<input type="hidden" name="highest_bid" value="<?php echo $bid; ?>"/>
					<input placeholder="Your Bid" name="bid"></input>
					<?php
						if( isset($_GET['error']) && $_GET['error'] == 1 ){
							echo "Not A Number"; 
						}
						else if ( isset($_GET['error']) && $_GET['error'] == 2 ){
							echo "Insufficient bid amount"; 
						}
					?>
					<button type="submit" class="searchbutton" name="bid_button">Bid</button>
				</form> 	
			<?php elseif ($status == 'SOLD'): ?>
				<p>SOLD WINNING BID: <?php echo $amount; ?></p>
			<?php elseif ($status == 'EXPIRED'): ?>
				<p>EXPIRED</p>
			<?php elseif ($status == 'CANCELLED'): ?>
				<p>CANCELLED</p>
			<?php endif; ?>
			<h6><?php echo $description; ?></h6><br>
		</div>
		<div class="clear"></div><br>
	</div>
</div>
<script type="text/javascript">
	startTimer( <?php echo $diff . " , \"countdown". $id . "\""; ?>);
</script>
</body>
</html>