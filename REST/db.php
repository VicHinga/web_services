<?php
//Create database connection
$db = new mysqli("localhost","root","","testapi");
if (!$db) {
	die("Connection error: " . mysqli_connect_error());
}
?> 