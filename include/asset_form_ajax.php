<?php
require_once "asset_form_util.php";


/*
 *  Return false if the array has no duplicate values, else return the first offending value
 */
function containsDuplicates($array) {
    $dupe_array = array();
    foreach ($array as $val) {
        if (!isset($dupe_array[$val])) {
            $dupe_array[$val] = 0;
        }
        if (++$dupe_array[$val] > 1) {
            return $val;
        }
    }
    return false;
}

/*
 * Given a list of serial ids either return a list containing serial ids already in the database, or false if there are no duplicates
 */
function checkForDuplicates($serial_list) {
    global $db;

    $serial_list_count = count($serial_list);
    
    $question_marks = trim(str_repeat("?,",$serial_list_count), ",");
    $query = "SELECT * FROM ASSET WHERE Serial IN ($question_marks)";
    
    $stmt = $db->prepare($query);
    $success = $stmt->execute($serial_list);

    if ($success && $stmt->rowCount() > 0) {
        $overlap = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($overlap, $row['Serial']);
        }
        return $overlap;
    }
    return false; 
}

if (isset($_GET['model_list']) ) {
    showModelList($_GET['cat'], $_GET['man'], 0);
} else if (isset($_GET['model_list_hide']) ) {
    showModelList($_GET['cat'], $_GET['man'], 0, true);
} else if (isset($_POST['delete'])) {
    $id = $_POST['deleteid'];

    $query = "DELETE FROM `ASSET` WHERE `AssetID` = :id";
    $stmt = $db->prepare($query);
    $success = $stmt->execute(array(":id"=>$id));
    
    if($success) {
        $message = Array(
            "type" => "success",
            "message" => "Success: Asset deleted."
        );
        echo json_encode($message);
        exit();
    } else {
        $message = Array(
            "type" => "error",
            "message" => "Error: Failed to delete asset, please try again."
        );
        echo json_encode($message);
        exit();
    }

} else if (isset($_POST['insert'])) {
    $categoryselect = $_POST['categoryselect'];
    $manufacturerselect = $_POST['manufacturerselect'];
    $modelselect = $_POST['modelselect'];

    $serialnumbers = strtoupper(trim($_POST['serialnumbers']));
    $user = $_POST['user'];
    $loc = strtoupper(trim($_POST['loc']));
    $purchasedate = $_POST['purchasedate'];
    $network = strtoupper(trim($_POST['network']));
    $warranty = trim($_POST['warranty']);
    $notes = trim($_POST['notes']);

    $serialnumbers_array = preg_split("/[\n\r]+/", $serialnumbers);



    if ($categoryselect === "0") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Category not selected."
        );
        echo json_encode($message);
        exit();
    }

    if ($manufacturerselect === "0") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Manufacturer not selected."
        );
        echo json_encode($message);
        exit();
    }

    if ($modelselect === "0") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Model not selected."
        );
        echo json_encode($message);
        exit();
    }

    if ($serialnumbers === "") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Servace tag is empty. (At least one value is required)"
        );
        echo json_encode($message);
        exit();
    }

    /* check that the same value does not appear more than once in the serial list */
    $duplicates = containsDuplicates($serialnumbers_array);
    if ($duplicates !== false) {
        $message = Array(
            "type" => "error",
            "message" => "Error: The following serial id appears more than once: " . $duplicates
        );
        echo json_encode($message);
        exit();
    }

    /* check that no serial id's are being added that are already in the database */
    $dup_check = checkForDuplicates($serialnumbers_array);
    if ($dup_check !== false) {
        $message = Array(
            "type" => "error",
            "message" => "Error: The following serial tags are already in the database: " . join(", ", $dup_check)
        );
        echo json_encode($message);
        exit();
    }

    if ($warranty === "") {
        $message = Array(
            "type" => "error",
            "message" => "Error: No warranty entered."
        );
        echo json_encode($message);
        exit();
    }

    if ($warranty !== "0" && !ctype_digit($warranty)) {
        $message = Array(
            "type" => "error",
            "message" => "Error: Warranty must be an integer."
        );
        echo json_encode($message);
        exit();
    }

    // do checks on:

    // Serial numbers $serialnumbers

    // Autofill LastChecked, Surplus
    foreach ($serialnumbers_array as $s_num) {

        $query = "INSERT INTO ASSET (`ModelID`, `Serial`, `LocationName`, `PurchaseDate`, `NetworkName`, `WarrantyEnd`, `Notes`, `Surplus`, `LastChecked`, `UserID`) VALUES (:modelselect, :serialnumbers, :loc, :purchasedate, :network, DATE_ADD(:purchasedate, INTERVAL :warranty YEAR), :notes, 0, NOW(), :user);";
        $stmt = $db->prepare($query);

        $stmt->bindValue(":loc", $loc, PDO::PARAM_STR);

        if ($user === "0") {
            $stmt->bindValue(":user", NULL, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(":user", $user, PDO::PARAM_INT);
        }

        $stmt->bindValue("modelselect", $modelselect, PDO::PARAM_INT);
        $stmt->bindValue("serialnumbers", $s_num, PDO::PARAM_STR);

        if ($purchasedate === "") {
            $stmt->bindValue("purchasedate", date('Y-m-d', time()), PDO::PARAM_STR);
        } else {
            $stmt->bindValue("purchasedate", $purchasedate, PDO::PARAM_STR);
        }

        $stmt->bindValue("network", $network, PDO::PARAM_STR);
        $stmt->bindValue("warranty", $warranty, PDO::PARAM_STR);
        $stmt->bindValue("notes", $notes, PDO::PARAM_STR);

        $success = $stmt->execute();

        if ($success) {

        } else {
            $message = Array(
                "type" => "error",
                "message" => $stmt->errorInfo()
            );
            echo json_encode($message);
            exit();
        }

    }

    $added_amount = count($serialnumbers_array);
    $success_message = "Asset successfully added.";
    if ($added_amount != 1) {
        $success_message = "($added_amount) Assets successfully added.";
    }
    
    if ($success) {
        $message = Array(
            "type" => "success",
            "message" => $success_message
        );
        echo json_encode($message);
        exit();
    }

} else if (isset($_POST['update'])) {
    //{"update":"","id":"2","categoryselect":"3","manufacturerselect":"1","modelselect":"1","serialnumbers":"OR293845","loc":"NULL","purchasedate":"2019-11-14","network":"2","notes":"Lorem ipsum","surplus":"on"}
    $id = $_POST['id'];
    $categoryselect = $_POST['categoryselect'];
    $manufacturerselect = $_POST['manufacturerselect'];
    $modelselect = $_POST['modelselect'];

    $serialnumbers = strtoupper(trim($_POST['serialnumbers']));
    $user = $_POST['user'];
    $loc = strtoupper(trim($_POST['loc']));
    $purchasedate = $_POST['purchasedate'];
    $network = strtoupper(trim($_POST['network']));
    $warranty = $_POST['warranty'];
    $notes = trim($_POST['notes']);
    $surplus = isset($_POST['surplus']) ? 1 : 0;

    if ($categoryselect === "0") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Category not selected."
        );
        echo json_encode($message);
        exit();
    }

    if ($manufacturerselect === "0") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Manufacturer not selected."
        );
        echo json_encode($message);
        exit();
    }

    if ($modelselect === "0") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Model not selected."
        );
        echo json_encode($message);
        exit();
    }

    if ($serialnumbers === "") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Servace tag is empty."
        );
        echo json_encode($message);
        exit();
    }

    if ($purchasedate === "") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Purchase Date is empty"
        );
        echo json_encode($message);
        exit();
    }

    if ($warranty === "") {
        $message = Array(
            "type" => "error",
            "message" => "Error: Warranty End is empty"
        );
        echo json_encode($message);
        exit();
    }


    $query = "UPDATE `ASSET` SET UserID=:user, ModelID=:modelselect, Serial=:serialnumbers, LocationName=:loc, PurchaseDate=:purchasedate, NetworkName=:network, WarrantyEnd=:warranty, Notes=:notes, Surplus=:surplus WHERE AssetID=:id";
    $stmt = $db->prepare($query);
    
    $stmt->bindValue(":loc", $loc, PDO::PARAM_STR);

    if ($user === "0") {
        $stmt->bindValue(":user", NULL, PDO::PARAM_INT);
    } else {
        $stmt->bindValue(":user", $user, PDO::PARAM_INT);
    }

    $stmt->bindValue("modelselect", $modelselect, PDO::PARAM_INT);
    $stmt->bindValue("serialnumbers", $serialnumbers, PDO::PARAM_STR);

    if ($purchasedate === "") {
        $stmt->bindValue("purchasedate", date('Y-m-d', time()), PDO::PARAM_STR);
    } else {
        $stmt->bindValue("purchasedate", $purchasedate, PDO::PARAM_STR);
    }

    $stmt->bindValue("network", $network, PDO::PARAM_STR);
    $stmt->bindValue("warranty", $warranty, PDO::PARAM_STR);
    $stmt->bindValue("notes", $notes, PDO::PARAM_STR);
    $stmt->bindValue("surplus", $surplus, PDO::PARAM_INT);
    $stmt->bindValue("id", $id, PDO::PARAM_INT);

    $success = $stmt->execute();

    if ($success) {
        $message = Array(
            "type" => "success",
            "message" => "Asset successfully updated."
        );
        echo json_encode($message);
        exit();
    } else {
        $message = Array(
            "type" => "error",
            "message" => $stmt->errorInfo()
        );
        echo json_encode($message);
        exit();
    }
}


//{"include":"","categoryselect":"3","manufacturerselect":"1","modelselect":"0","serialnumbers":"","loc":"0","purchasedate":"","network":"0","warranty":"","notes":""}
//echo json_encode($_POST);

?>
