<?php
/* Home Page
	Not Logged In
	Register
*/
require("php/connect.php");
include 'header.php';
?>
<div id="container">
	<div class="wrapper">
		<div class="col6 right1">
			<img src="images/logo-02.png">
			<h3>As of press time, the major- ity of the fighting has ceased, forcing the MNLF to only control small pockets of the city. All hostages have been freed since last September 26.</h3>
		</div>
		<div class="col5">
			<div class="roundcornercontainer">
				<h3>Not a member?</h3><br>
				<form action="php/register.php" method="POST" id="register_form">
					<input type="text" name="user_id" placeholder="ID Number" maxlength="6"  id="register_id" style="background-color:#f9f9f9;">
					<input type="text" name="user_email" placeholder="Ateneo Email" maxlength="50" style="background-color:#f9f9f9;">
					<input type="password" name="user_password" placeholder="Password" maxlength="8" style="background-color:#f9f9f9;">
					<br><input type="checkbox" name="user_legal" value="agree" style="float:left; margin-right:10px; width:20px;">
					<h5>I accept the following non-existing Terms and Conditions of Use</h5><br>
					<button type="submit" class="searchbutton" name="register">Register</button>
					<p class="error"><?php
						if(!empty($_SESSION['errors']['register'])) {
							echo $_SESSION['errors']['register'];
							unset ($_SESSION['errors']['register']);
						}
					?></p>
				</form>
			</div>
		</div>
		<div class="clear"></div><br><br><br>
		<div class="col12">
			<?php
				include 'itembox.php';
			?>
			<div class="clear"></div>
		</div>
	</div>
</div>
</body>
</html>