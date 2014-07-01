<?php
/* Header
	File imports
	Top bar
*/
if(isset($_SESSION['errors']['login'])) {
	$error = $_SESSION['errors']['login'];
	unset($_SESSION['errors']);
}
?>
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
	<div id="header">
		<div class="wrapper">
			<div id="branding" class="col3">
				<?php
				$host = $_SERVER['REQUEST_URI'];
				if($host != '/test/indexlogin.php') { //changes depending on foldername
					echo "<a href=\"index.php\"><img src=\"images/logo.png\"></a>";
				}
				?>
			</div>
			<div id="navigation1" class="col9">
					<div id="login" class="textright">
				<?php if(!empty($_SESSION['user'])) : $user = $_SESSION['user']['id'];  ?>
						<h6> <a href="profile.php?id=<?php echo $_SESSION['user']['id']; ?>">My Profile</a> | <a href="php/logout.php">Logout</a> </h6>
					</div>
					<div id="feedpostrequest" class="textright">
						<h3> 
							<a href="newitem.php">Auction Item</a> |
							<a href="editprofile.php">Manage Account</a>
						</h3>
					</div>
				<?php else : ?>
						<form action="php/login.php" method="POST" id="register_form">
							<input type="text" size="25" placeholder="ID Number" maxlength=6  id="register_id" name="user_id">
							<input type="password" placeholder="Password" maxlength=50 name="user_password">
							<button type="submit" class="searchbutton" name="login">Login</button>
						</form>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>