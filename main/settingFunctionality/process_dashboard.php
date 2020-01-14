<?php
require_once "../databaseCon.php";


// php update data in mysql database using PDO
if(isset($_POST['submitQuery'])) {
    // get values
    $Serial = $_POST['AssetID'];
    $CurrentDate = date('Y-m-d H:i:s');


    // mysql query to update data
    $query = "UPDATE `VW_ASSET_NEW` SET `LastChecked`=:LastChecked WHERE `Serial` = :AssetID";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoExec = $pdoResult->execute(array(":LastChecked"=>$CurrentDate, ":AssetID"=>$Serial));



    if ($pdoExec) {
        header("Location: ../dashboard.php");
        echo '<script> alert("Asset updated"); </script>';

    } else {
        echo 'Asset not updated, please try again!';

    }


}
