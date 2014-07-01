<?php
require("connect.php");
echo "try";
if(isset($_POST['bid_button']) && isset($_POST['bid'])) {
	$bid = $_POST['bid'];
	$highest_bid = $_POST['highest_bid'];
	$auction_id = $_POST['auction_id'];
	
	if(!preg_match('/\d/', $bid)) {
		header("location: ../item.php?id={$_POST['auction_id']}&error=1");
		exit();
	}

	if($bid < $highest_bid){
		header("location: ../item.php?id={$auction_id}&error=2");
		exit();
	}
	

	$date = date('Y-m-d H:i:s', time());
	$query_params2 = array(
		':bid' => $bid,
		':date' => $date,
		':user' => $_SESSION['user']['id'],
		':auction' => $_POST['auction_id']);
	
	$query2 = "
			INSERT INTO bid (
				amount, bid_date, user_id, auction_id) 
			VALUES (
				:bid, :date, :user, :auction)";
	
	$sql2 = $db->prepare($query2);
	$result2 = $sql2->execute($query_params2);
	header("location: ../item.php?id={$auction_id}");
}
?>