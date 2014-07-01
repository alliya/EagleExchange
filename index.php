<?php
/* Home Page
	Not Logged In
*/
require("php/connect.php");

if(empty($_SESSION['user'])) {
	header("location: indexlogin.php");
	die("Redirecting to: indexlogin.php"); 
}

include 'header.php';
?>
<div id="container">
	<div class="wrapper">
		<div id="searchbar">
			<form action="" method="POST">
				<input class="bigsearch col7" placeholder="Search for an item" name="search"></input>
				<div class="col3"><button type="submit" class="searchbutton" name="search_button">Search</button></div>
			</form>
		</div>
		<form action="" method="POST">
			<div id="categoriesnav" class="col3">
				<button type='submit' name='category' value='Book'>Book</button>
				<button type='submit' name='category' value='Electronics'>Electronics</button>
				<button type='submit' name='category' value='Clothes'>Clothes and Accessories</button>
				<button type='submit' name='category' value='Food'>Food and Drinks</button>
				<button type='submit' name='category' value='Tickets'>Event Tickets</button>
				<button type='submit' name='category' value='Hobbies'>Collection and Hobbies</button>
			</div>
		</form>	
		<?php
			include 'itembox.php';
		?>
	</div>
	<div class="clear"></div>
</div>
</body>
</html>