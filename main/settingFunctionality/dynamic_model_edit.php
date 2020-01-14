<?php
require_once "../databaseCon.php";

/**
 *  Given the assoc array return a select block
 */
function htmlSelectList($data, $value_name, $default_value) {
    echo "<select name='$value_name'>";
    if ($default_value == 0) {
        echo "<option selected value=''>--Select--</option>";
    }

    foreach ($data as $key => $text) {
        $encoded_text = htmlspecialchars($text);
        $default_option = ($key == $default_value) ? "selected" : "";
        if ($key == "NULL" && is_null($default_value)) {
            $default_option = "selected";
        }
        echo "<option $default_option value='$key'>$encoded_text</option>";
    }
    echo "</select>";
}

function showCategoryList($default) {
    global $pdoConnect;

    $stmt = $pdoConnect->query("SELECT * FROM CATEGORY");
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['CategoryID']] = $row['Name'];
	}

    htmlSelectList($select_list, "CategoryID", $default);
}

function showManufacturerList($default) {
    global $pdoConnect;

    $stmt = $pdoConnect->query("SELECT * FROM MANUFACTURER");
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['ManufacturerID']] = $row['Name'];
	}

    htmlSelectList($select_list, "ManufacturerID", $default);
}


$id = $_GET['id'];

$stmt = $pdoConnect->prepare("SELECT * FROM MODEL WHERE ModelID = ?");
$stmt->execute(Array($id));

$data = $stmt->fetch(PDO::FETCH_ASSOC);

?>

        <div class="form-group">
                <label>Category ID</label>
                <?php showCategoryList($data['CategoryID']); ?>
        </div>
        <div class="form-group">
                <label>Manufacture ID</label>
                <?php showManufacturerList($data['ManufacturerID']); ?>
        </div>
