<?php
require("connect.php");

if(isset($_POST['add_auction'])) {
	$current_item_bid = 0;
	$date = date('Y-m-d H:i:s', strtotime("+". $_POST['item_duration'] . " days"));
	
	$query_params = array(
		':item_name' => $_POST['item_name'],
		':seller_id' => $_SESSION['user']['id'],
		':item_category' => $_POST['item_category'],
		':item_condition' => $_POST['item_condition'],
		':item_duration' => $date,
		':item_price' => $_POST['item_price'],
		':item_description' => $_POST['item_description']);
	
	if($_POST['item_name'] == "" || $_POST['item_price'] == 0) {
		$error = "You must fill in the required fields";
	}
	else {
		$query = "
			INSERT INTO auction (
				name, seller_id, category, `condition`, duration, price, description) 
			VALUES (
				:item_name, :seller_id, :item_category, :item_condition,  :item_duration, :item_price, :item_description)";
		try { 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params);
		} 
		catch(PDOException $ex) {
				die("Failed to run add auction query: " . $ex->getMessage()); 
		}
		
		$id = $db->lastInsertId();
		if($_FILES["item_images"]["error"][0] > 0) { //TODO
			echo "ERROR: ";
			print_r($_FILES["item_images"]["error"]);
		}
		else {//add images of auction
			$uploads_dir = '../uploads';
			$images = "";
			$count = 1;
			foreach($_FILES['item_images']['tmp_name'] as $key => $value) {
				$tmp_name = $_FILES["item_images"]["tmp_name"][$key];
				$extension = strrchr($_FILES["item_images"]["name"][$key], '.');
				$name = $id . "-" . $count . $extension;
				$images = $images . $name . ", ";
				$count++;
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}
			$query = "
				UPDATE auction
				SET images=\"$images\"
				WHERE id=$id";
			try {
					$stmt = $db->prepare($query); 
					$result = $stmt->execute($query_params); 
			} 
			catch(PDOException $ex) {
					die("Failed to run add auction query: " . $ex->getMessage()); 
			}
				
		}
	}
	header("location: ../item.php?id=$id"); //auction page of item
	die("Redirecting to: item.php?id=$id"); 
}
?>