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

if(isset($_POST['update-data']))
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

    // mysql query to update data
    
    $query = "UPDATE `USRS` SET `categoryselect`=:categoryselect,`manufacturerselect`=:manufacturerselect,`serialnumber`=:serialnumber,`modelselect`=:modelselect,`purchasedate`=:purchasedate,`warranty`=:warranty,`user`=:user,`loc`=:loc WHERE `notes` = :notes";
    
    $pdoResult = $pdoConnect->prepare($query);
    
    $pdoExec = $pdoResult->execute(array(":categoryselect"=>$categoryselect, ":manufacturerselect"=>$manufacturerselect,":serialnumber"=>$serialnumber, ":modelselect"=>$modelselect,":purchasedate"=>$purchasedate, ":warranty"=>$warranty,":user"=>$user,":loc"=>$loc,":notes"=>$notes));
    
    if($pdoExec)
    {
        echo '<script> alert("Asset updated"); </script>';
        header("Location: dashboard.php"); 
    }else{
        echo 'Asset not updated, please try again!';
    }

}

?>
