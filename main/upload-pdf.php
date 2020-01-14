<?php 
$host = "localhost";
$dbname = "enisar_db";
$user = "enisar";
$pass = "enisar";

try {
    //connection
    $pdoConnect = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit(); }

function getCheckoutData() {
    global $pdoConnect;

    $serial = $_GET['serial'];
    
    $stmt = $pdoConnect->prepare("SELECT * FROM VW_ASSET_NEW WHERE Serial = ?");
    $stmt->execute([$serial]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function htmlSelectListRForm($data, $value_name, $default_value) {
    echo "<select id='serial_list' name='$value_name' required>";
    if ($default_value == 0) {
        echo "<option selected hidden disabled value=''>--Select--</option>";
    }

    foreach ($data as $key => $text) {
        $encoded_text = htmlspecialchars($text);
        $encoded_key = htmlspecialchars($key);
        $default_option = ($key == $default_value) ? "selected" : "";
        echo "<option $default_option value='$encoded_key'>$encoded_text</option>";
    }
    echo "</select>";
}


function showSerialList($default) {
    global $pdoConnect;

    $stmt = $pdoConnect->query("SELECT * FROM ASSET");
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['AssetID']] = $row['Serial'];
	}

    $default = 0;
    if (isset($_GET['serial'])) {
        $stmt = $pdoConnect->prepare("SELECT * FROM ASSET WHERE Serial = ?");
        $stmt->execute([$_GET['serial']]);

        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $default = $row['AssetID'];
        }
    }

    htmlSelectListRForm($select_list, "serial_upload", $default);
}



if (isset($_POST["sb"])) {

    // save the file to uploads folder
    $filename = $_FILES['src']['name'];
    $tempname= $_FILES['src']['tmp_name'];
    $folder= "uploads/".$filename;
    // echo $folder;
    move_uploaded_file($tempname, $folder);
    // echo "<img src='$folder' height='100' width='100' />";
 
    $imgSource = $_FILES['src']['name'];
    $fileType= pathinfo($imgSource, PATHINFO_EXTENSION);

    if($_FILES['src']['size'] > 1000000) {
        header("location:404.php");
    } else {
        if($fileType != "pdf" && $fileType != "jpg" && $fileType != "jpeg" && $fileType != "png") {
            header("location:404.php");

        } else{
            //$query = "insert into `CHECKOUT` set CheckoutFormURL='$folder'";
            //exec($pdoConnect->query($query));
            $query = "INSERT INTO `CHECKOUT` SET CheckoutFormURL=?, AssetID=?";
            $stmt = $pdoConnect->prepare($query);
            $stmt->execute([$folder, $_POST['serial_upload']]);
            header("location:rform.php");
        }
    }
    
}

?>

