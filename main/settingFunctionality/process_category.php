<?php
require_once "../databaseCon.php";

// php update data in mysql database using PDO
if(isset($_POST['HideData']))
{
    // get id to delete
    $CategoryName = $_POST['deleteid'];
    $ToNo = "no";




    $sql = "UPDATE CATEGORY SET Visible=? WHERE CategoryID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$ToNo,$CategoryName]);

    if($stmt)
    {

        header("Location: ../settings.php#tabs-1");
    }else{
        echo 'Asset not Hidden, please try again!';
    }
}









// php update data in mysql database using PDO
if(isset($_POST['makeVisible']))
{
    // get id to delete
    $CategoryName = $_POST['showCategory'];
    $ToNo = "yes";




    $sql = "UPDATE CATEGORY SET Visible=? WHERE CategoryID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$ToNo,$CategoryName]);

    if($stmt)
    {

        header("Location: ../settings.php#tabs-1");
    }else{
        echo 'Asset not deleted, please try again!';
    }
}



























// php add data in mysql database using PDO
if(isset($_POST['add-data']))
{
    // get values
    $CategoryName = $_POST['CategoryName'];

    // mysql query to insert data
    $sql = "INSERT INTO CATEGORY (Name) VALUES (?)";
    $stmt= $pdoConnect->prepare($sql);
    $stmt->execute([$CategoryName]);
    // check if mysql insert query successful
    if($stmt)
    {
        echo '<script> alert("Asset added"); </script>';
        header("Location: ../settings.php");
    }else{
        echo 'Asset not added, please try again!';
    }
}


// php update data in mysql database using PDO
if(isset($_POST['update-data'])) {
    // get values
    $CategoryName = $_POST['CategoryName'];
    $newName = $_POST['newName'];

    $sql = "UPDATE CATEGORY SET Name=? WHERE CategoryID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$newName,$CategoryName]);

    if ($stmt) {
        echo '<script> alert("Asset updated"); </script>';
        header("Location: ../settings.php");

    } else {
        echo 'Asset not updated, please try again!';
    }
}
