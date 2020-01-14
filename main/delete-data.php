<?php

$host = "localhost";
$dbname = "singh83_db";
$user = "singh83";
$pass = "singh83";

try {
    // connect to mysql
    $pdoConnect = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit(); }

// php update data in mysql database using PDO
if(isset($_POST['delete-data']))
{
    // get id to delete
    $id = $_POST['deleteid'];
    
    // mysql delete query 
    $pdoQuery = "DELETE FROM `USRS` WHERE `id` = :id";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    $pdoExec = $pdoResult->execute(array(":id"=>$id));
    
    if($pdoExec)
    {
        echo '<script> alert("Asset deleted"); </script>';
        header("Location: dashboard.php"); 
    }else{
        echo 'Asset not deleted, please try again!';
    }

}

?>