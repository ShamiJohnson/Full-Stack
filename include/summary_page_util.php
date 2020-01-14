<?php

require_once "dbconnect.php";

function showHeader() {
    global $db;

    $stmt = $db->query("SELECT COUNT(*) AS Count FROM VW_ASSET_NEW WHERE Surplus=0");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['Count'];

    $stmt = $db->query("SELECT COUNT(*) AS Count FROM VW_ASSET_NEW WHERE CURDATE() > WarrantyEnd AND Surplus=0");
    $out_of_warranty = $stmt->fetch(PDO::FETCH_ASSOC)['Count'];


    //$stmt = $pdoConnect->prepare('SELECT * FROM VW_ASSET, SETTING where DaysSinceChecked > SETTING.Value');

    $stmt = $db->query("SELECT COUNT(*) AS Count FROM VW_ASSET_NEW, SETTING WHERE DaysSinceChecked > SETTING.Value AND Surplus=0");
    $unvarified = $stmt->fetch(PDO::FETCH_ASSOC)['Count'];

    $output = "$total Total Assets | <a href='reports.php?search=warranty'>$out_of_warranty</a> Out of Warranty | <a href='dashboard.php'>$unvarified</a> Unverified";
    
    echo $output;
}



function getCategoryList() {
    global $db;

    //$stmt = $db->query("SELECT ASSET.CategoryID, CATEGORY.Name, COUNT(*) as Count FROM ASSET RIGHT JOIN CATEGORY ON ASSET.CategoryID=CATEGORY.CategoryID GROUP BY ASSET.CategoryID");
    //https://stackoverflow.com/questions/7424913/how-to-count-the-number-of-instances-of-each-foreign-key-id-in-a-table
    $stmt = $db->query("SELECT CATEGORY.CategoryID, CATEGORY.Name, COUNT(VW_ASSET_CATMAN.CategoryID) as Count FROM CATEGORY LEFT JOIN VW_ASSET_CATMAN ON VW_ASSET_CATMAN.CategoryID=CATEGORY.CategoryID AND VW_ASSET_CATMAN.Surplus=0 GROUP BY CATEGORY.CategoryID");
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($select_list, array($row['CategoryID'], $row['Name'], $row['Count']));
	}

    return $select_list;
}

function manusForCategory($category_id) {
    global $db;

    $stmt = $db->prepare("SELECT VW_ASSET_CATMAN.ManufacturerID, MANUFACTURER.Name, COUNT(VW_ASSET_CATMAN.ManufacturerID) AS Count FROM VW_ASSET_CATMAN LEFT JOIN MANUFACTURER ON MANUFACTURER.ManufacturerID=VW_ASSET_CATMAN.ManufacturerID WHERE VW_ASSET_CATMAN.CategoryID=? AND VW_ASSET_CATMAN.Surplus=0 GROUP BY VW_ASSET_CATMAN.ManufacturerID");
    $stmt->execute(Array($category_id));
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($select_list, array($row['ManufacturerID'], $row['Name'], $row['Count']));
	}
   
    return $select_list;
}

function showCategoryBox($id, $name, $count) {
    global $db;

    $stmt = $db->prepare("SELECT COUNT(*) AS Count FROM VW_ASSET_CATMAN WHERE CategoryID=? AND CURDATE() > WarrantyEnd AND Surplus=0");
    $stmt->execute(Array($id));
    $test_value = $stmt->fetch(PDO::FETCH_ASSOC)['Count'];

    echo "<h4>$name <span title='total (including out of warranty)'>($count)</span> <span title='out of warranty'>($test_value OOW)</span></h4>";

    $manu_list = manusForCategory($id); 

    echo "<ul>";
    foreach($manu_list as $row) {
        $name = $row[1];
        $c = $row[2];
        echo "<li>$name ($c)";
        showModelList($id, $row[0]);
        echo "</li>";
    }
    echo "</ul>";
    if (count($manu_list) === 0) {
        echo "There are no assets in this category.";
    }
}


function showModelList($cat, $manu) {
    global $db;

    $stmt = $db->prepare("SELECT MODEL.ModelID, MODEL.Name, COUNT(VW_ASSET_CATMAN.ModelID) as Count FROM `MODEL` LEFT JOIN VW_ASSET_CATMAN ON VW_ASSET_CATMAN.ModelID=MODEL.ModelID WHERE MODEL.CategoryID=? AND MODEL.ManufacturerID=? AND VW_ASSET_CATMAN.Surplus=0 GROUP BY MODEL.ModelID");
    $stmt->execute([$cat, $manu]);
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($select_list, array($row['ModelID'], $row['Name'], $row['Count']));
	}

    echo "<ul>";
    foreach($select_list as $row) {
        $name = $row[1];
        $c = $row[2];
        echo "<li><a href='reports.php#@$name'>$name</a> ($c)</li>";
    }
    echo "</ul>";
}

//showModelList(3, 1);
function showAll() {
    $cat_list = getCategoryList();
    foreach ($cat_list as $row) {
        echo "<div class='categoryBox'>";
        showCategoryBox($row[0], $row[1], $row[2]);
        echo "</div>";
    }
}

//showCategoryBox(3, "Laptop", 290348509);

//manusForCategory(3);
//showCategoryBox();
//getCategoryList();

?>



