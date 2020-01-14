<?php

$host = "localhost";
$dbname = "enisar_db";
$user = "enisar";
$pass = "enisar";

try {
	$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
	echo $e->getMessage();
}


/*
$stmt = $db->query("SELECT username, password FROM users");
$stmt->setFetchMode(PDO::FETCH_ASSOC);

while ($row = $stmt->fetch()) {
	echo $row['username'] . "<br>";
}
*/


/*
$name = "bob";

$stmt = $db->prepare("SELECT username FROM users WHERE username LIKE ?");
$stmt->execute([$name]);

while ($row = $stmt->fetch()) {
	echo $row['username'] . "<br>";
}
*/


/*
$name = "bob";

$stmt = $db->prepare("SELECT username FROM users WHERE username LIKE ?");
$stmt->bindValue(1, "%$name%");

$stmt->execute();

while ($row = $stmt->fetch()) {
	echo $row['username'] . "<br>";
}
*/

