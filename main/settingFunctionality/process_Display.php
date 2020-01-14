<?php
require_once "../databaseCon.php";

// php update data in mysql database using PDO
if(isset($_POST['update-data'])) {
    // get values
    $DisplayName = $_POST['DisplayName'];
    $Display = $_POST['Display'];

    $sql = "UPDATE SETTING SET Value=? WHERE Name=?";
    $stmt = $pdoConnect->prepare($sql);
    $stmt->execute([$Display,$DisplayName]);

    if ($stmt) {
        echo '<script> alert("Asset updated"); </script>';
        header("Location: ../settings.php#tabs-5");

    } else {
        echo 'Asset not updated, please try again!';

    }
}
