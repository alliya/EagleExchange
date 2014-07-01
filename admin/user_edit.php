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
require("../php/connect.php");
?>

<?php
	$query_params = array(
		':asd' => $_GET['id']
	); 
	$query = "SELECT * FROM users WHERE id = :asd";
	$sql = $db->prepare($query);
	$result = $sql->execute($query_params);
	$rowz = $sql->fetch();
?>

<form action="admin.php" method="POST" style="width:300px; margin:0px auto;">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="table_name" value="users">
	First Name:<br><input type="text" name="first_name" value="<?php echo $rowz['first_name']?>"><br>
	Last Name:<br><input type="text" name="last_name" value="<?php echo $rowz['last_name']?>"><br>
	OBF Email:<br><input type="text" name="obf_email" value="<?php echo $rowz['obf_email']?>"><br>
	Email:<br><input type="text" name="email" value="<?php echo $rowz['email']?>"><br>
	Contact Number:<br><input type="text" name="contact_number" value="<?php echo $rowz['contact_number']?>"><br>
	User Type:<br><select name="type">
		<?php
		if($rowz['type'] == "NORMAL"){?>
			<option value="normal" selected>NORMAL</option>
			<option value="admin">ADMIN</option></select><br>
		<?php
		}
		else{?>
			<option value="normal">NORMAL</option>
			<option value="admin" selected>ADMIN</option></select><br>
		<?php
		}
		?>
	
	<input type="submit" value="Edit" name="user_edit"><br>
	<input type="submit" value="Delete" name="delete">

</form>