<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web-autthadej";

header("Content-type:text/html; charset=UTF-8");
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn, "SET NAMES UTF8");
mysqli_query($conn, "SET character_set_results=UTF8");
	mysqli_query($conn, "SET character_set_client=UTF8");
	mysqli_query($conn, "SET character_set_connection=UTF8");
	mb_internal_encoding('UTF-8');
	mb_http_output('UTF-8');
	mb_language('uni');
	mb_regex_encoding('UTF-8');
	ob_start('mb_output_handler');
	setlocale(LC_ALL, 'th_TH');

?>
