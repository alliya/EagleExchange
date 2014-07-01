<?php
/* Register Page
	Continue registration
*/
require("php/connect.php");

if(empty($_SESSION['user'])) {
	header("location: indexlogin.php");
	die("Redirecting to: indexlogin.php"); 
}

if((isset($_SESSION['user']['first_name']))||(isset($_SESSION['user']['last_name']))||(isset($_SESSION['user']['email']))) {
	header("location: index.php");
	die("Redirecting to: index.php"); 
}
$id = $_SESSION['user']['id'];
$obf_email = $_SESSION['user']['obf_email'];
include 'header.php';
?>
<div id="container">
	<div class="wrapper">
		<div class="col8 left2 right2">
			<div class="roundcornercontainer">
				<h3>Finish Registration</h3><br>
				<form method="POST" action="php/editaccount.php" enctype="multipart/form-data">
					<?php echo $id ?><br>
					<?php echo $obf_email ?><br><br>
					<input type="text" placeholder="First Name" style="background-color:#f9f9f9;" name="user_firstname">
					<input type="text" placeholder="Last Name" style="background-color:#f9f9f9;" name="user_lastname">	
					<input type="text" placeholder="Active Email" style="background-color:#f9f9f9;" name="user_email">
					<input type="text" placeholder="Contact Number (optional ex. 09123456789)" maxlength = 11 style="background-color:#f9f9f9;" name="user_contactnumber">
					<label for="user_image" style="visibility:visible; float:left;">Profile Photo (Max of 1mb total)</label>
					<input type="file" name="user_image" accept="image/*" style="float/left; width:300px;">
					<button type="submit" class="searchbutton" name="finish_register">Register</button>
					<p class="error"><?php
						// if(!empty($_SESSION['errors']['account'])) {
						// 		echo $_SESSION['errors']['account'];
						// 		unset($_SESSION['errors']['account']);
						// }
					?></p>
				</form>
			</div>
		</div>
	</div>
</div>