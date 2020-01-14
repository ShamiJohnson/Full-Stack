<?php
require_once "../databaseCon.php";

//process

// php update data in mysql database using PDO
if(isset($_POST['delete-data']))
{
    // get id to delete
    $ID = $_POST['deleteidLocation'];

    // mysql delete query
    $pdoQuery = "DELETE FROM `LOCATION` WHERE `LocationID` = :LocationID";

    $pdoResult = $pdoConnect->prepare($pdoQuery);

    $pdoExec = $pdoResult->execute(array(":LocationID"=>$ID));

    if($pdoExec)
    {
        echo '<script> alert("Asset deleted"); </script>';
        header("Location: ../settings.php");
    }else{
        echo 'Asset not deleted, please try again!';
    }
}


// php add data in mysql database using PDO
if(isset($_POST['add-data']))
{
    // get values
    $Building = $_POST['Building'];
    $BuildingNumber = $_POST['BuildingNumber'];



    // mysql query to insert data
    $sql = "INSERT INTO LOCATION (Building,BuildingNumber) VALUES (?,?)";
    $stmt= $pdoConnect->prepare($sql);
    $stmt->execute([$Building,$BuildingNumber]);
    // check if mysql insert query successful


    // check if mysql insert query successful
    echo '<script> alert("Building added"); </script>';

    if($stmt)
    {
        echo '<script> alert("Building added"); </script>';
        header("Location: ../settings.php");
    }else{
        echo 'Building not added, please try again!';
    }
}

// php update data in mysql database using PDO
if(isset($_POST['update-data'])) {
    // get values
    $ID = $_POST['LocationID'];
    $Building = $_POST['Building'];
    $BuildingNumber = $_POST['BuildingNumber'];


    // mysql query to update data
    $query = "UPDATE `LOCATION` SET `Building`=:Building,`BuildingNumber`=:BuildingNumber  WHERE `LocationID` = :LocationID";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoExec = $pdoResult->execute(array(":Building"=>$Building, ":BuildingNumber"=>$BuildingNumber, ":LocationID"=>$ID));

    if ($pdoExec) {
        header("Location: ../settings.php");
        echo '<script> alert("Building updated"); </script>';

    } else {
        echo 'Building not updated, please try again!';

    }


}
