<?php
require("php/connect.php");

if(empty($_SESSION['user'])) {
	header("location: index.php");
	die("Redirecting to: index.php"); 
}

include 'header.php';
?>

<div id="container">
	<div class="wrapper">
		<form method="POST" action="php/addauction.php" enctype="multipart/form-data">	
		<div class="formitem">
			<input type="text" name="item_name" placeholder="Item Name">
		</div>
		<div class="formitem">
			<label for="item_condition">Condition</label>
			<select align="center" name="item_condition">
				<option value="new">New</option>
				<option value="used">Used</option>
			</select>
		</div>
		<div class="formitem">
			<input type="text" name="item_price" placeholder="Item Initial Price">
		</div>
		<div class="formitem">
			<label for="item_duration">Duration</label>
			<select align="center" name="item_duration">
				<option value="7">7 Days</option>
				<option value="14">14 Days</option>
			</select>
		</div>
		<div class="formitem">
			<label for="item_category">Category</label>
			<select align="center" name="item_category">
				<option value="books">Books</option>
				<option value="electronics">Electronics</option>
				<option value="clothes">Clothes and Accessories</option>
				<option value="food">Food and Drinks</option>
				<option value="tickets">Event Tickets</option>
				<option value="collections">Collections and Hobbies</option>
				<option value="uncategorized" selected="selected">Uncategorized</option>
			</select>
		</div>
		<div class="formitem">
			<label for="item_images" style="visibility:visible;">Images (Max of 1mb)</label>
			<input type="file" name="item_images[]" accept="image/*">
		</div>
		<div class="formitem">
			<label for="item_description">Description (Optional)</label><br>
			<textarea name="item_description">Enter text here...</textarea>
		</div>
		<input type="submit" name="add_auction" value="Add">
	</form>