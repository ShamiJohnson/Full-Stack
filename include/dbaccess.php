<?php

require_once "dbconnect.php";

function categoryCount($cat_id) {
	global $db;

	$stmt = $db->prepare("SELECT count(*) FROM ASSET WHERE CategoryID = ?");
	$stmt->execute([$cat_id]);

	return $stmt->fetch(PDO::FETCH_NUM)[0];
}

function surplusCount() {
	global $db;

	$stmt = $db->query("SELECT count(*) FROM ASSET WHERE Surplus=1");

	return $stmt->fetch(PDO::FETCH_NUM)[0];
}

function locationCount() {
	global $db;

	$stmt = $db->query("SELECT count(*) FROM LOCATION");

	return $stmt->fetch(PDO::FETCH_NUM)[0];
}

?>


