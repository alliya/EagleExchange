<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Eagle Exchange | Trading the Ateneo Way</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Monda:400,700' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script>
	<script src= "js/timer.js" type="text/javascript"></script>
	<script type="text/javascript">
		alert("<?php echo $error; ?>");
	</script>
</head>
<body> 

<?php
if($_SESSION['user']['type'] != "ADMIN"){
	header("location: ../index.php");
	die("Redirecting to: ../index.php"); 
}

require("../php/connect.php");

if(isset($_POST['user_edit'])){
	$query_params = array(
	':id' => $_POST['id'],
	':first_name' => $_POST['first_name'],
	':last_name' => $_POST['last_name'],
	':obf_email' => $_POST['obf_email'],
	':email' => $_POST['email'],
	':contact_number' => $_POST['contact_number'],
	':type' => $_POST['type']
	);
	
	$query = "UPDATE users SET first_name= :first_name,
								last_name = :last_name,
								obf_email = :obf_email,
								email = :email,
								contact_number = :contact_number,
								`type` = :type
								WHERE id= :id;";
	try{
		$sql = $db->prepare($query);
		$result = $sql->execute($query_params);
	}
	catch(PDOException $ex) {
			die("Failed to run register query: " . $ex->getMessage()); 
	}
}
if(isset($_POST['bid_edit'])){
	$query_params = array(		
		':id' => $_POST['id'],
		':amount' => $_POST['amount'],
		':user_id' => $_POST['user_id']
	);

	$query = "UPDATE bid SET amount= :amount,
								user_id = :user_id,
								WHERE id= :id;";
	try{
		$sql = $db->prepare($query);
		$result = $sql->execute($query_params);
	}
	catch(PDOException $ex) {
			die("Failed to run register query: " . $ex->getMessage()); 
	}
}
if(isset($_POST['auction_edit'])){
	$query_params = array(		
		':id' => $_POST['id'],
		':name' => $_POST['name'],
		':seller' => $_POST['seller_id'],
		':category' => $_POST['category'],
		':condition' => $_POST['condition'],
		':description' => $_POST['description'],
		':status' => $_POST['status']
	);

	$query = "UPDATE auction SET name= :name,
								seller_id = :seller,
								category = :category,
								`condition` = :condition,
								description = :description,
								`status` = :status
								WHERE id= :id;";
	try{
		$sql = $db->prepare($query);
		$result = $sql->execute($query_params);
	}
	catch(PDOException $ex) {
			die("Failed to run register query: " . $ex->getMessage()); 
	}
}

if(isset($_POST['delete'])){
	$query_params = array(
		':id' => $_POST['id']
	);
	if($_POST['table_name'] == "users"){
		$query = "DELETE from users WHERE id = :id";
	}
	else if($_POST['table_name'] == "auction"){
		$query = "DELETE from auction WHERE id = :id";
	}
	else{
		$query = "DELETE from bid WHERE id = :id";
	}
	
	try{
		$sql = $db->prepare($query);
		$result = $sql->execute($query_params);
	}
	catch(PDOException $ex) {
			die("Failed to run register query: " . $ex->getMessage()); 
	}
}
?>
USERS
<table class="user_table">
	<tr>
		<th>ID Number</th>
		<th>OBF Email</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Type</th>
	</tr>
	
	<?php
	$query = "SELECT * FROM users";
	$sql = $db->prepare($query);
	$result = $sql->execute();
	$rowz = $sql->fetchAll();
	
	foreach($rowz as $row){
	?>	
		<tr>
			<td><a href="user_edit.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
			<td><?php echo $row['obf_email']; ?></td>
			<td><?php echo $row['first_name']; ?></td>
			<td><?php echo $row['last_name']; ?></td>
			<td><?php echo $row['type']; ?></td>
		</tr>
	<?php
	}?>
</table>
<hr>
AUCTIONS
<table class="auction_table">
	<tr>
		<th>Item Name</th>
		<th>Price</th>
		<th>Seller</th>
	</tr>
	
	<?php
	$query = "SELECT * FROM auction";
	$sql = $db->prepare($query);
	$result = $sql->execute();
	$rowz = $sql->fetchAll();
	
	foreach($rowz as $row) 
	{
	?>	
		<tr>
			<td><a href="auction_edit.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
			<td>Php <?php echo $row['price']; ?></td>
			<td><?php echo $row['seller_id']; ?></td>
		</tr>
	<?php
	}?>
</table>
<hr>	
BIDS
<table class="bid_table">
	<tr>
		<th>Amount</th>
		<th>Date</th>
		<th>Bidder</th>
		<th>Item Name</th>
		<th>Delete</th>
	</tr>
	
	<?php
	$query = "SELECT bid.id, amount, bid_date, user_id, auction.name
			  FROM bid inner join auction on bid.auction_id=auction.id;";
	$sql = $db->prepare($query);
	$result = $sql->execute();
	$rowz = $sql->fetchAll();
	
	foreach($rowz as $row) 
	{
	?>	
		<tr>
			<td><?php echo $row['amount']; ?> </td>
			<td>Php <?php echo $row['bid_date']; ?></td>
			<td><?php echo $row['user_id']; ?></td>
			<td><?php echo $row['name'];?></td>
			<td><form action="admin.php" method="POST"><input type="hidden" name="table_name" value="bid"><input type="hidden" name="id" value="<?php echo $row['id']; ?>"><button Value="Delete" name="delete">x</button></form></td>
		</tr>
	<?php
	}?>
</table>