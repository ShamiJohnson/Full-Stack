<?php
require_once "../databaseCon.php";

// php update data in mysql database using PDO
if(isset($_POST['delete-data']))
{
    // get id to delete
    $Name = $_POST['deleteidNETWORK'];

    // mysql delete query
    $pdoQuery = "DELETE FROM `NETWORK` WHERE `Name` = :Name";

    $pdoResult = $pdoConnect->prepare($pdoQuery);

    $pdoExec = $pdoResult->execute(array(":Name"=>$Name));

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
    $Name = $_POST['NetworkName'];


    // mysql query to insert data
    $sql = "INSERT INTO NETWORK (Name) VALUES (?)";
    $stmt= $pdoConnect->prepare($sql);
    $stmt->execute([$Name]);
    // check if mysql insert query successful
    echo '<script> alert("Manufacturer added"); </script>';

    if($stmt)
    {
        echo '<script> alert("Manufacturer added"); </script>';
        header("Location: ../settings.php");
    }else{
        echo 'Asset not added, please try again!';
    }
}

// php update data in mysql database using PDO
if(isset($_POST['update-data'])) {
    // get values
    $Name = $_POST['NetworkName'];
    $NewName = $_POST['newName'];

    // mysql query to update data
    $query = "UPDATE `NETWORK` SET `Name`=:NewName WHERE `Name` = :Name";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoExec = $pdoResult->execute(array(":NewName"=>$NewName, ":Name"=>$Name));



    if ($pdoExec) {
        header("Location: ../settings.php");
        echo '<script> alert("Asset updated"); </script>';

    } else {
        echo 'Asset not updated, please try again!';

    }


}
