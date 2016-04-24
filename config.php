<?php

$servername = "mysql.cc.puv.fi";
$username = "e1500966";
$password = "TzsHKKE66K4q";
$dbname = "e1500966_Othello";

$currency = '&euro;'; //Currency Character or code
		
//connect to MySql						
$mysqli = new mysqli($servername, $username, $password, $dbname);
// check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>