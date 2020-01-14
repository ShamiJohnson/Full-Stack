<?php

if (!isset($_SESSION)) {
    session_start();
}
/*
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
}
*/

$host = "localhost";
$dbname = "enisar_db";
$user = "enisar";
$pass = "enisar";



try {
	$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    die("<h2>Fatal Error: Failed to connect to database</h2>");
	echo $e->getMessage();
}


// Login block
