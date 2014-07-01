<?php
require("connect.php");
session_unset();
session_write_close();
header("Location: ../indexlogin.php");
die("Redirecting to: indexlogin.php");
?>