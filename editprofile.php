<?php
require ("php/connect.php");

if(empty($_SESSION['user'])) {
	header("location: indexlogin.php");
	die("Redirecting to: indexlogin.php"); 
}
$id  = $_SESSION['user']['id'];
$first_name = NULL;
if(isset($_SESSION['user']['first_name'])){
	$first_name  = $_SESSION['user']['first_name'];
}
$last_name = null;
if(isset($_SESSION['user']['last_name'])){
	$last_name = $_SESSION['user']['last_name'];
}
$obf_email = $_SESSION['user']['obf_email'];
$email=NULL;
if(isset($_SESSION['user']['email'])){
	$email = $_SESSION['user']['email'];
}
include 'header.php';
?>

<div id="container">
	<div class="wrapper">
		<div class="col4 left1">
			<div id="userphoto">
				<img src="uploads/users/<?php echo $id; ?>.png" width="300">
			</div>
		</div>
		<form method="POST" action="php/editaccount.php" enctype="multipart/form-data">
			<div class="col6 right1">
					<input placeholder="First Name" value="<?php echo $first_name; ?>" style="width:220px; margin-right:20px;" name="user_firstname"><input placeholder="Last Name" value="<?php echo $last_name; ?>" style="width:220px;" name="user_lastname">
				<h4>
					<input placeholder="Active E-mail" value="<?php echo $email; ?>" name="user_email"><br><br>	
					<?php echo $obf_email; ?><br><br>
					<input placeholder="Contact Number" value="<?php echo $contact_number; ?>" maxlength = 11 name="user_contactnumber">
					<label for="user_image" style="visibility:visible; float:left;">Profile Photo (Max of 1mb total)</label>
					<input type="file" accept="image/*" style="float/left; width:300px;" name="user_image">
					<button type="submit" class="searchbutton" name="update_account">Update Profile</button>
				</h4>
			</div>
		</form>
		<div class="clear"></div><br>
		<div class="col12"><hr></div>
		<div class="clear"></div>
		<div class="col12">
			<h3 class="textblue">Items in Auction</h3><br>
			<div class="listitem col3">
				<img src="uploads/04.png">
				<div class="itemtext">
					<h3>Used Books</h3>
					<h5>several Ateneo leaders expressed mixed sentiments regarding the new line-item budgeting system proposed </h5><br>
					<h5 class="textgrey">Minimum Bid: P00000</h5>
					<h5 class="textgrey">Current Bid: P000000</h5>
					<h5 class="textgrey">Closes in: 0hrs 0mins 0secs</h5>
				</div>
			</div>
			<div class="listitem col3">
				<img src="uploads/05.png">
				<div class="itemtext">
					<h3>Used Books</h3>
					<h5>several Ateneo leaders expressed mixed sentiments regarding the new line-item budgeting system proposed </h5><br>
					<h5 class="textgrey">Minimum Bid: P00000</h5>
					<h5 class="textgrey">Current Bid: P000000</h5>
					<h5 class="textgrey">Closes in: 0hrs 0mins 0secs</h5>
				</div>
			</div>
			<div class="listitem col3">
				<img src="uploads/01.png">
				<div class="itemtext">
					<h3>Used Books</h3>
					<h5>several Ateneo leaders expressed mixed sentiments regarding the new line-item budgeting system proposed </h5><br>
					<h5 class="textgrey">Minimum Bid: P00000</h5>
					<h5 class="textgrey">Current Bid: P000000</h5>
					<h5 class="textgrey">Closes in: 0hrs 0mins 0secs</h5>
				</div>
			</div>
			<div class="listitem col3">
				<img src="uploads/01.png">
				<div class="itemtext">
					<h3>Used Books</h3>
					<h5>several Ateneo leaders expressed mixed sentiments regarding the new line-item budgeting system proposed </h5><br>
					<h5 class="textgrey">Minimum Bid: P00000</h5>
					<h5 class="textgrey">Current Bid: P000000</h5>
					<h5 class="textgrey">Closes in: 0hrs 0mins 0secs</h5>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="col12"><hr></div>
		<div class="col12">
			<h3 class="textblue">Recent bids</h3><br>
			<div class="listitem col3">
				<img src="uploads/04.png">
				<div class="itemtext">
					<h3>Used Books</h3>
					<h5>several Ateneo leaders expressed mixed sentiments regarding the new line-item budgeting system proposed </h5><br>
					<h5 class="textgrey">Minimum Bid: P00000</h5>
					<h5 class="textgrey">Current Bid: P000000</h5>
					<h5 class="textgrey">Closes in: 0hrs 0mins 0secs</h5>
				</div>
			</div>
			<div class="listitem col3">
				<img src="uploads/05.png">
				<div class="itemtext">
					<h3>Used Books</h3>
					<h5>several Ateneo leaders expressed mixed sentiments regarding the new line-item budgeting system proposed </h5><br>
					<h5 class="textgrey">Minimum Bid: P00000</h5>
					<h5 class="textgrey">Current Bid: P000000</h5>
					<h5 class="textgrey">Closes in: 0hrs 0mins 0secs</h5>
				</div>
			</div>
			<div class="listitem col3">
				<img src="uploads/01.png">
				<div class="itemtext">
					<h3>Used Books</h3>
					<h5>several Ateneo leaders expressed mixed sentiments regarding the new line-item budgeting system proposed </h5><br>
					<h5 class="textgrey">Minimum Bid: P00000</h5>
					<h5 class="textgrey">Current Bid: P000000</h5>
					<h5 class="textgrey">Closes in: 0hrs 0mins 0secs</h5>
				</div>
			</div>
			<div class="listitem col3">
				<img src="uploads/01.png">
				<div class="itemtext">
					<h3>Used Books</h3>
					<h5>several Ateneo leaders expressed mixed sentiments regarding the new line-item budgeting system proposed </h5><br>
					<h5 class="textgrey">Minimum Bid: P00000</h5>
					<h5 class="textgrey">Current Bid: P000000</h5>
					<h5 class="textgrey">Closes in: 0hrs 0mins 0secs</h5>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>