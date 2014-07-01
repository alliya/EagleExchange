<?php
function debug($msg) 
{
	$log_file = "/logs/EagleExchange".date('Ymd').".log";

	$fp = fopen($log_file,"a+");
	fwrite($fp,$msg);
	fclose($fp);


}
?>