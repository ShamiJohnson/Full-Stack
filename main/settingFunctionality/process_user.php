<?php
require_once "../databaseCon.php";

//process user

// php update data in mysql database using PDO
if(isset($_POST['delete-data']))
{
    // get id to delete
    $ID = $_POST['deleteidUSER'];
    $ToNo = "no";
    $sql = "UPDATE USER SET Visible=? WHERE UserID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$ToNo,$ID]);

    if($stmt)
    {

        header("Location: ../settings.php#tabs-4");
    }else{
        echo 'user not Hidden, please try again!';
    }

}





// php update data in mysql database using PDO
if(isset($_POST['makeVisible']))
{
    // get id to delete
    $ID = $_POST['makeVisibleUSER'];
    $ToYES = "yes";




    $sql = "UPDATE USER SET Visible=? WHERE UserID=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$ToYES,$ID]);

    if($stmt)
    {

        header("Location: ../settings.php#tabs-4");
    }else{
        echo 'Asset not deleted, please try again!';
    }
}










// php add data in mysql database using PDO
if(isset($_POST['add-data']))
{
    // get values
    $Name = $_POST['user_Fname'];
    $LastName = $_POST['user_lName'];
    $Email = $_POST['user_Email'];
    $Phone = $_POST['user_Phone'];
    $LocationID = $_POST['user_Location'];




    // mysql query to insert data
    $sql = "INSERT INTO USER (FirstName,LastName,Email,Phone, LocationName) VALUES (?,?,?,?,?)";
    $stmt= $pdoConnect->prepare($sql);
    $stmt->execute([$Name,$LastName,$Email,$Phone,$LocationID]);
    // check if mysql insert query successful


    // check if mysql insert query successful
    echo '<script> alert("Manufacturer added"); </script>';

    if($stmt)
    {
        echo '<script> alert("Manufacturer added"); </script>';
        header("Location: ../settings.php#tabs-4");
    }else{
        echo 'Asset not added, please try again!';
    }
}

// php update data in mysql database using PDO
if(isset($_POST['update-data'])) {
    // get values
    $ID = $_POST['user_ID'];
    $Name = $_POST['user_Fname'];
    $LastName = $_POST['user_lName'];
    $Email = $_POST['user_Email'];
    $Phone = $_POST['user_Phone'];
    $LocationID = $_POST['user_Location'];


    // mysql query to update data
    $query = "UPDATE `USER` SET `FirstName`=:FirstName,`LastName`=:LastName,`Email`=:Email,`Phone`=:Phone,`LocationName`=:LocationID  WHERE `UserID` = :UserID";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoExec = $pdoResult->execute(array(":FirstName"=>$Name, ":LastName"=>$LastName,":Email"=>$Email, ":Phone"=>$Phone,":LocationID"=>$LocationID,":UserID"=>$ID));

    if ($pdoExec) {
        header("Location: ../settings.php#tabs-4");
        echo '<script> alert("Asset updated"); </script>';

    } else {
        echo 'Asset not updated, please try again!';

    }


}
