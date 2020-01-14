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

if(isset($_POST['add-data']))
{
    // get values 
    $categoryselect = $_POST['categoryselect'];
    $manufacturerselect = $_POST['manufacturerselect'];
    $serialnumber = $_POST['serialnumber'];
    $modelselect = $_POST['modelselect'];
    $purchasedate = $_POST['purchasedate'];
    $warranty = $_POST['warranty'];
    $user = $_POST['user'];
    $loc = $_POST['loc'];
    $notes = $_POST['notes'];
    
    // mysql query to insert data

    $pdoQuery = "INSERT INTO USRS (`categoryselect`, `manufacturerselect`,`serialnumber`, `modelselect`, `purchasedate`, `warranty`, `user`, `loc`, `notes`) VALUES (:categoryselect,:manufacturerselect,:serialnumber,:modelselect,:purchasedate,:warranty,:user,:loc,:notes)";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    $pdoExec = $pdoResult->execute(array(":categoryselect"=>$categoryselect, ":manufacturerselect"=>$manufacturerselect,":serialnumber"=>$serialnumber, ":modelselect"=>$modelselect,":purchasedate"=>$purchasedate, ":warranty"=>$warranty,":user"=>$user,":loc"=>$loc,":notes"=>$notes));
    
    // check if mysql insert query successful
    if($pdoExec)
    {
        echo '<script> alert("Asset added"); </script>';
        header("Location: dashboard.php"); 
    }else{
        echo 'Data not added, please try again!';
    }
}


?>
