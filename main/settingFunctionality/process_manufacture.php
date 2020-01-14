<?php
require_once "../databaseCon.php";

// php update data in mysql database using PDO
if(isset($_POST['delete-data']))
{
    // get id to delete
    $CategoryName = $_POST['deleteid'];

    $ToNo = "no";
    $sql = "UPDATE MANUFACTURER SET Visible=? WHERE ManufacturerID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$ToNo,$CategoryName]);

    if($stmt)
    {

        header("Location: ../settings.php#tabs-2");
    }else{
        echo 'Asset not Hidden, please try again!';
    }
}





// php update data in mysql database using PDO
if(isset($_POST['makeVisible']))
{
    // get id to delete
    $CategoryName = $_POST['showManufacture'];
    $ToYes = "yes";




    $sql = "UPDATE MANUFACTURER SET Visible=? WHERE ManufacturerID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$ToYes,$CategoryName]);

    if($stmt)
    {

        header("Location: ../settings.php#tabs-2");
    }else{
        echo 'Manufacturer not shown, please try again!';
    }
}




// php add data in mysql database using PDO
if(isset($_POST['add-data']))
{
    // get values
    $CategoryName = $_POST['CategoryName'];

    // mysql query to insert data
    $sql = "INSERT INTO MANUFACTURER (Name) VALUES (?)";
    $stmt= $pdoConnect->prepare($sql);
    $stmt->execute([$CategoryName]);
    // check if mysql insert query successful
    echo '<script> alert("Manufacture added"); </script>';

    if($stmt)
    {
        echo '<script> alert("Asset added"); </script>';
        header("Location: ../settings.php#tabs-2");
    }else{
        echo 'Asset not added, please try again!';
    }
}


// php update data in mysql database using PDO
if(isset($_POST['update-data'])) {
    // get values
    $CategoryName = $_POST['CategoryName'];
    $newName = $_POST['newName'];

    $sql = "UPDATE MANUFACTURER SET Name=? WHERE ManufacturerID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$newName,$CategoryName]);

    if ($stmt) {
        echo '<script> alert("Asset updated"); </script>';
        header("Location: ../settings.php#tabs-2");

    } else {
        echo 'Asset not updated, please try again!';

    }
}
