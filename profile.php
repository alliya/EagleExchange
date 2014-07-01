<?php
require ("php/connect.php");


if(empty($_SESSION['user'])) {
	header("location: indexlogin.php");
	die("Redirecting to: indexlogin.php"); 
}
if(empty($_GET['id'])) {// to-do
	echo "Error: No id was passed.";
	header("location: indexlogin.php");
	die("Redirecting to: indexlogin.php");
}
else {
	$id = $_GET['id'];
	$query = "
		SELECT *
		FROM users
		WHERE id=$id";
	try {
		$stmt = $db->prepare($query); 
		$result = $stmt->execute(); 
	} 
	catch(PDOException $ex) {
		die("Failed to run register query: " . $ex->getMessage()); 
	}
	$row = $stmt->fetch();
	$imageID = $row['id']; //test
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	$obf_email = $row['obf_email'];
	$contact_number = $row['contact_number'];
	if($row['image'] == NULL) {
		$image = "0.PNG";
	}
	else {
		$image = $row['image'];
	}
}
//todo
// query = "DELETE FROM auction WHERE id=$id";
		
include 'header.php';
?>

<div id="container">
	<div class="wrapper">
		<div class="col4 left1">
			<div id="userphoto">
				<img src="uploads/users/<?php echo $image; ?>" width="300">
			</div>
		</div>
		<div class="col6 right1">
			<h1 class="textblue"><?php echo $first_name . " " . $last_name; ?></h1>
			<h4>
				<?php echo $email; ?><br>
				<?php echo $obf_email; ?><br>
				<?php if($contact_number != 0) echo $contact_number; ?>
			</h4>
		</div>
		<div class="clear"></div><br>
		<div class="col12"><hr></div>
		<div class="clear"></div>
		<div class="col12">
			<h3 class="textblue">Items in Auction</h3><br>
			<?php
			    $user_id = $id;
				$flag = 0;
				require('itembox.php');				
			?>
			<div class="clear"></div>
		</div>
		<div class="col12"><hr></div>
		<div class="col12">
			<h3 class="textblue">Recent bids</h3><br>
			<?php
				$flag = 1;

				require('itembox.php');			
			?>
			<div class="clear"></div>
		</div>
	</div>
</div>