<?php
require("../php/connect.php");
?>

<?php
	$id = $_GET['id'];
	echo $id;
	$query = "SELECT * FROM bid WHERE id = $id";
	ECHO "SDADSADASD";
	$sql = $db->prepare($query);
	$result = $sql->execute();
	$rowz = $sql->fetch();
?>
<form action="" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="table_name" value="bid">
	Amount:<br><input type="text" name="amount" value="<?php echo $rowz['amount']?>"><br>
	Date:<br>
	Insert date thingy here<br>
	Bidder:<br><input type="text" name="user_id" value="<?php echo $rowz['user_id']?>"><br>
	<input type="submit" value="Edit" name="bid_edit">
	<input type="submit" value="Delete" name="delete">
</form>