<!-- First Part of Display Data-->
<?php
$host = "localhost";
$dbname = "enisar_db";
$user = "enisar";
$pass = "enisar";

try {
    // connect to mysql
    $pdoConnect = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

} catch (PDOException $e) {
    echo $e->getMessage();
    exit(); }

