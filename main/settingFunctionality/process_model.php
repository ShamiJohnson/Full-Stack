<?php
require_once "../databaseCon.php";

// php update data in mysql database using PDO
if(isset($_POST['delete-data']))
{

    // get id to delete
    $CategoryName = $_POST['deleteid'];
    $ToNo = "no";
    $sql = "UPDATE MODEL SET Visible=? WHERE ModelID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$ToNo,$CategoryName]);

    if($stmt)
    {

        header("Location: ../settings.php#tabs-3");
    }else{
        echo 'Model not Hidden, please try again!';
    }

}


// php update data in mysql database using PDO
if(isset($_POST['makeVisible']))
{
    // get id to visible
    $CategoryName = $_POST['showVisible_Model'];
    $ToNo = "yes";
    $sql = "UPDATE MODEL SET Visible=? WHERE ModelID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$ToNo,$CategoryName]);

    if($stmt)
    {

        header("Location: ../settings.php#tabs-3");
    }else{
        echo 'Asset not Visible, please try again!';
    }
}


















// php add data in mysql database using PDO
if(isset($_POST['add-data']))
{
    // get values
    $CategoryName = $_POST['CategoryName'];
    $CategoryID = $_POST['CategoryID'];
    $ManufacturerID = $_POST['ManufacturerID'];

    // mysql query to insert data
    $sql = "INSERT INTO MODEL (Name,CategoryID,ManufacturerID) VALUES (?,?,?)";
    $stmt= $pdoConnect->prepare($sql);
    $stmt->execute([$CategoryName,$CategoryID,$ManufacturerID]);
    // check if mysql insert query successful
    echo '<script> alert("Manufacturer added"); </script>';

    if($stmt)
    {
        echo '<script> alert("Manufacturer added"); </script>';
        header("Location: ../settings.php#tabs-3");
    }else{
        echo 'Asset not added, please try again!';
    }
}

// php update data in mysql database using PDO
if(isset($_POST['update-data'])) {
    // get values
    $ModelID = $_POST['ModelID'];
    $ModelName = $_POST['ModelName'];
    $CategoryID = $_POST['CategoryID'];
    $ManufacturerID = $_POST['ManufacturerID'];



    // mysql query to update data
    $query = "UPDATE `MODEL` SET `Name`=:ModelName,`CategoryID`=:CategoryID,`ManufacturerID`=:ManufacturerID WHERE `ModelID` = :ModelID";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoExec = $pdoResult->execute(array(":ModelName"=>$ModelName, ":CategoryID"=>$CategoryID,":ManufacturerID"=>$ManufacturerID,":ModelID"=>$ModelID));



    if ($pdoExec) {
        header("Location: ../settings.php#tabs-3");
        echo '<script> alert("Manufacturer updated!"); </script>';

    } else {
        echo 'Asset not updated, please try again!';

    }


}
