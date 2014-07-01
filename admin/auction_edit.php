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
	$query = "SELECT * FROM auction WHERE id = :asd";
	$sql = $db->prepare($query);
	$result = $sql->execute($query_params);
	$rowz = $sql->fetch();
?>

<form action="admin.php" method="POST" style="width:300px; margin:0px auto;>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="table_name" value="auction">
	Item Name:<br><input type="text" name="name" value="<?php echo $rowz['name']?>"><br>
	Seller:<br><input type="text" name="seller_id" value="<?php echo $rowz['seller_id']?>"><br>
	Category:<br><select name="category"><br>
		<?php
		if($rowz['category'] == "books"){?>
			<option value="books" selected>Books</option>
			<option value="electronics">Electronics</option>
			<option value="clothes">Clothes and Accessories</option>
			<option value="food">Food and Drinks</option>
			<option value="tickets">Event Tickets</option>
			<option value="collections">Collections and Hobbies</option>
			<option value="uncategorized">Uncategorized</option><br>
		<?php
		}
		else if($rowz['category'] == "electronics"){?>
			<option value="books">Books</option>
			<option value="electronics" selected>Electronics</option>
			<option value="clothes">Clothes and Accessories</option>
			<option value="food">Food and Drinks</option>
			<option value="tickets">Event Tickets</option>
			<option value="collections">Collections and Hobbies</option>
			<option value="uncategorized">Uncategorized</option><br>
		<?php
		}
		else if($rowz['category'] == "clothes"){?>
			<option value="books">Books</option>
			<option value="electronics">Electronics</option>
			<option value="clothes" selected>Clothes and Accessories</option>
			<option value="food">Food and Drinks</option>
			<option value="tickets">Event Tickets</option>
			<option value="collections">Collections and Hobbies</option>
			<option value="uncategorized">Uncategorized</option><br>
		<?php
		}
		else if($rowz['category'] == "food"){?>
			<option value="books">Books</option>
			<option value="electronics">Electronics</option>
			<option value="clothes">Clothes and Accessories</option>
			<option value="food" selected>Food and Drinks</option>
			<option value="tickets">Event Tickets</option>
			<option value="collections">Collections and Hobbies</option>
			<option value="uncategorized">Uncategorized</option><br>
		<?php
		}
		else if($rowz['category'] == "tickets"){?>
			<option value="books">Books</option>
			<option value="electronics">Electronics</option>
			<option value="clothes">Clothes and Accessories</option>
			<option value="food">Food and Drinks</option>
			<option value="tickets" selected>Event Tickets</option>
			<option value="collections">Collections and Hobbies</option>
			<option value="uncategorized">Uncategorized</option><br>
		<?php
		}
		else if($rowz['category'] == "collections"){?>
			<option value="books">Books</option>
			<option value="electronics">Electronics</option>
			<option value="clothes">Clothes and Accessories</option>
			<option value="food">Food and Drinks</option>
			<option value="tickets">Event Tickets</option>
			<option value="collections" selected>Collections and Hobbies</option>
			<option value="uncategorized">Uncategorized</option><br>
		<?php
		}
		else if($rowz['category'] == "uncategorized"){?>
			<option value="books">Books</option>
			<option value="electronics">Electronics</option>
			<option value="clothes">Clothes and Accessories</option>
			<option value="food">Food and Drinks</option>
			<option value="tickets">Event Tickets</option>
			<option value="collections">Collections and Hobbies</option>
			<option value="uncategorized" selected>Uncategorized</option><br>
		<?php
		}
		?>
	Condition:<br><select name="condition">
		<?php
		if($rowz['condition'] == "NEW"){?>
			<option value="new" selected>NEW</option>
			<option value="used">USED</option></select><br>
		<?php
		}
		else{?>
			<option value="new">NEW</option>
			<option value="used" selected>USED</option></select><br>
		<?php
		}
		?>
	Description:<br><input type="text" name="description" value="<?php echo $rowz['description']?>"><br>
	Status:<br><select name="status">
		<?php
		if($rowz['status'] == "CANCELLED"){?>
			<option value="cancelled" selected>CANCELLED</option>
			<option value="expired">EXPIRED</option>
			<option value="ongoing">ONGOING</option>
			<option value="sold">SOLD</option></select><br>
		<?php
		}
		else if($rowz['status'] == "EXPIRED"){?>
			<option value="cancelled">CANCELLED</option>
			<option value="expired" selected>EXPIRED</option>
			<option value="ongoing">ONGOING</option>
			<option value="sold">SOLD</option></select><br>
		<?php
		}
		else if($rowz['status'] == "ONGOING"){?>
			<option value="cancelled">CANCELLED</option>
			<option value="expired">EXPIRED</option>
			<option value="ongoing" selected>ONGOING</option>
			<option value="sold">SOLD</option></select><br>
		<?php
		}
		else{?>
			<option value="cancelled">CANCELLED</option>
			<option value="expired">EXPIRED</option>
			<option value="ongoing">ONGOING</option>
			<option value="sold" selected>SOLD</option></select><br>
		<?php
		}
		?>
	<input type="submit" value="Edit" name="auction_edit"><br>
	<input type="submit" value="Delete" name="delete">
</form>