<?php
require_once "dbaccess.php";


function displayModalUpdate($id) {
    global $db;

    $stmt = $db->prepare("SELECT * FROM VW_ASSET_NEW WHERE AssetID = ?");
    $stmt->execute(Array($id));

    $data = $stmt->fetch(PDO::FETCH_ASSOC);


    $stmt = $db->prepare("SELECT * FROM VW_ASSET_CATMAN WHERE AssetID = ?");
    $stmt->execute(Array($id));

    $catmanmod = $stmt->fetch(PDO::FETCH_ASSOC);

?>
        <!--  Edit Modal -->
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #1b2a47; color: white;">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Update Asset</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" id="asset_update_form" method="POST" autocomplete="off">
            <div class="modal-body">
                    
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label>Category*</label>
                        <?php showCategoryList($catmanmod['CategoryID']); ?>
                    </div>

                    <div class="form-group">
                        <label>Manufacturer*</label>
                        <?php showManufacturerList($catmanmod['ManufacturerID']); ?>
                    </div>

                    <div class="form-group">
                        <label>Model Name*</label>                                
                        <?php showModelList($catmanmod['CategoryID'], $catmanmod['ManufacturerID'], $catmanmod['ModelID']); ?>
                    </div>

                    <div class="form-group">
                        <label>Service Tag*</label>
                        <input style="text-transform: uppercase;" value="<?= htmlspecialchars($data['Serial']) ?>" type="text" name= "serialnumbers" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>User</label> 
                        <?php showUserListSpecial($data['UserID']); ?>
                    </div>

                    <div class="form-group">
                        <label>Location</label> 
                        <input style="text-transform: uppercase;" value="<?= htmlspecialchars($data['LocationName']) ?>" type="text" name="loc" class="form-control">
                        <!-- <?php showLocationList($data['LocationID']); ?> -->
                    </div>

                    <div class="form-group">
                        <label>Purchase Date</label> 
                        <input value="<?= $data['PurchaseDate'] ?>" type="date" name="purchasedate" class="form-control" placeholder="mm-dd-year">
                    </div>
                    <div class="form-group">
                        <label>Network</label> 
                        <input type="text" name="network" style="text-transform: uppercase;" class="form-control" value="<?= htmlspecialchars($data['NetworkName']) ?>">
                        <!-- <?php showNetworkList($data['NetworkID']); ?> -->
                    </div>
                    <div class="form-group">
                        <label>Warranty End</label> 
                        <input type="date" name="warranty" class="form-control" value="<?= $data['WarrantyEnd'] ?>">
                    </div>
                    <!--
                    <div class="form-group">
                        <label>Warranty</label> 
                        <input type="text" name= "warranty" class="form-control" placeholder="(in years)">
                    </div>
                    -->
                    <div class="form-group">
                        <label>Notes</label> 
                        <textarea class="form-control" name="notes"><?= $data['Notes'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Surplus</label> 
                        <input <?= $data['Surplus']==1 ? "checked" : "" ?> type="checkbox" name="surplus">
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="add-data" class="btn btn-success" onclick="doAssetUpdate(this, event, <?= $id ?>);">Update</button>
            </div>
            </form>   
        </div>
        </div>
        <!-- Edit Modal Ends -->
<?php }


/**
 *  Given the assoc array return a select block
 */
function htmlSelectList($data, $value_name, $default_value, $required=false, $required_default="--Select--") {
    $required_val = $required ? "class='form-control' required" : "";
    echo "<select name='$value_name' $required_val>";
    if ($required) {
        echo "<option value='' selected disabled hidden>$required_default</option>";
    } else if ($default_value == 0 && !isset($data['0'])) {
        echo "<option selected value='0'>--Select--</option>";
    }

    foreach ($data as $key => $text) {
        $encoded_text = htmlspecialchars($text);
        $encoded_key = htmlspecialchars($key);
        $default_option = ($key == $default_value) ? "selected" : "";
        if ($key == "NULL" && is_null($default_value)) {
            $default_option = "selected";
        }
        echo "<option $default_option value='$encoded_key'>$encoded_text</option>";
    }
    echo "</select>";
}


function showCategoryList($default, $hide_hidden=false, $use_names=false) {
    global $db;

    if ($hide_hidden) {
        $stmt = $db->query("SELECT * FROM CATEGORY WHERE Visible='yes' ORDER BY Name");
    } else {
        $stmt = $db->query("SELECT * FROM CATEGORY ORDER BY Name");
    }
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($use_names) {
            $select_list[$row['Name']] = $row['Name'];
        } else {
            $select_list[$row['CategoryID']] = $row['Name'];
        }
	}

    if ($use_names) {
        htmlSelectList($select_list, "categoryselect", $default, true, "Category");
    } else {
        htmlSelectList($select_list, "categoryselect", $default);
    }

}

function showManufacturerList($default, $hide_hidden=false, $use_names=false) {
    global $db;

    if ($hide_hidden) {
        $stmt = $db->query("SELECT * FROM MANUFACTURER WHERE Visible='yes' ORDER BY Name");
    } else {
        $stmt = $db->query("SELECT * FROM MANUFACTURER ORDER BY Name");
    }
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($use_names) {
            $select_list[$row['Name']] = $row['Name'];
        } else {
            $select_list[$row['ManufacturerID']] = $row['Name'];
        }
	}

    if ($use_names) {
        htmlSelectList($select_list, "manufacturerselect", $default, true, "Manufacturer");
    } else {
        htmlSelectList($select_list, "manufacturerselect", $default);
    }

}



function showModelList($cate_id, $manu_id, $default, $hide_hidden=false) {
    global $db;

    if (isset($cate_id) && isset($manu_id)) {
        
    }

    if ($hide_hidden) {
        $stmt = $db->prepare("SELECT * FROM MODEL WHERE CategoryID = ? AND ManufacturerID = ? AND Visible='yes'");
        $stmt->execute([$cate_id, $manu_id]);
    } else {
        $stmt = $db->prepare("SELECT * FROM MODEL WHERE CategoryID = ? AND ManufacturerID = ?");
        $stmt->execute([$cate_id, $manu_id]);
    }

   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['ModelID']] = $row['Name'];
	}

    htmlSelectList($select_list, "modelselect", $default);
}

function showFullModelList($hide_hidden=false) {
    global $db;

    if ($hide_hidden) {
        $stmt = $db->prepare("SELECT * FROM MODEL WHERE Visible='yes' ORDER BY Name");
        $stmt->execute();
    } else {
        $stmt = $db->prepare("SELECT * FROM MODEL ORDER BY Name");
        $stmt->execute();
    }
     
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['Name']] = $row['Name'];
	}

    htmlSelectList($select_list, "modelselect", -1, true, "Model");
}

function showLocationList($default) {
    global $db;

    $stmt = $db->query("SELECT * FROM LOCATION");
   
    $select_list = array();
    $select_list['NULL'] = "Tech Shelf";
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['LocationID']] = $row['Building'] . " " . $row['BuildingNumber'];
	}

    htmlSelectList($select_list, "loc", $default);
}

function showNetworkList($default) {
    global $db;

    $stmt = $db->query("SELECT * FROM NETWORK");
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['NetworkID']] = $row['Name'];
	}


    htmlSelectList($select_list, "network", $default);
}

function showUserList($default, $hide_hidden=false) {
    global $db;

    if ($hide_hidden) {
        $stmt = $db->query("SELECT * FROM USER WHERE Visible='yes'");
    } else {
        $stmt = $db->query("SELECT * FROM USER");
    }
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['UserID']] = $row['FirstName'] . " " . $row['LastName'];
	}

    htmlSelectList($select_list, "user", $default);
}

function showUserListSpecial($default) {
    global $db;

    $stmt = $db->query("SELECT * FROM USER");
   
    $select_list = array();
    $select_list['0'] = "--Select--";
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['UserID']] = $row['FirstName'] . " " . $row['LastName'];
	}

    htmlSelectList($select_list, "user", $default);
}


function showAssetTable() {
    global $db;

    //$labels = Array("Serial", "Category", "Manufacturer", "Model", "Location", "Network", "WarrantyEnd", Array("Varified", "Days since last varified"), "User", "Notes", "Modify");
    $labels = Array("Serial", "Category", "Manufacturer", "Model", Array("Location", "Displays the location of the user over the entered value if the user field is set."), "Network", Array("WarrantyEnd", "Days until warranty expires"), "Purchase Date", "User", "Surplus", "Actions");

    $stmt = $db->query("SELECT * FROM VW_ASSET");
    //Serial CategoryName(Name) ManufacturerName ModelName Location Network WarrantyEnd DaysSinceChecked (FirstName+LastName) 

    echo "
    <table id='asset_table' class='display'>
        <thead>
            <tr>";
    foreach ($labels as $label) {
        if(is_array($label)){
            echo "<th> <span data-toggle='tooltip' title='$label[1]'>$label[0]</span></th>";
        } else {
            echo "<th><span>$label</span></th>";
        }
    }
    echo "
            </tr>
        </thead>";

    echo "
        <tfoot>
            <tr>";
    foreach ($labels as $label) {
        if(is_array($label)){
            echo "<th>$label[0]</th>";
        } else {
            echo "<th>$label</th>";
        }
    }
    echo "
            </tr>
        </tfoot>";
    /*  
    echo    "<tbody>";
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>"; 
            echo "<td>". $row['Serial'] ."</td>";
            echo "<td>". $row['CategoryName'] ."</td>";
            echo "<td>". $row['ManufacturerName'] ."</td>";
            echo "<td>". $row['ModelName'] ."</td>";
            echo "<td>". $row['Building'] . " " . $row['BuildingNumber'] ."</td>";
            echo "<td>". $row['NetworkName'] ."</td>";
            echo "<td>". $row['WarrantyEnd'] ."</td>";
            echo "<td>". $row['DaysSinceChecked'] ."</td>";
            echo "<td>". $row['FirstName'] . " " . $row['LastName'] ."</td>";
            echo "<td>". $row['Notes'] ."</td>";
            echo '<td><button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>';
        echo "</tr>"; 
	}
    echo "</tbody>";
    */

    echo "</table>";
}

function getAssetTableData() {
    global $db;
    $table_data = Array("data" => Array());

    $stmt = $db->query("SELECT * FROM VW_ASSET_NEW");

    $empty_column = "<span style='color: grey;'>-----</span>";

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row_data = Array();
        $serial_name_encoded = htmlspecialchars($row['Serial']);
        array_push($row_data, "<a style='cursor: pointer' onclick='showCheckoutForm(\"".$serial_name_encoded."\");' >".$serial_name_encoded."</a>");
        //array_push($row_data, htmlspecialchars($row['Serial']));

        array_push($row_data, htmlspecialchars($row['CategoryName']));
        array_push($row_data, htmlspecialchars($row['ManufacturerName']));
        array_push($row_data, htmlspecialchars($row['ModelName']));
        //if ($row['Building'] === NULL && true) {
        if (false) {
            array_push($row_data, "<a style='cursor: pointer' onclick='showCheckoutForm(\"".$row['Serial']."\");' >Tech Shelf</a>");
        } else {
            //array_push($row_data, htmlspecialchars($row['Building'] . " " . $row['BuildingNumber']));
            //array_push($row_data, htmlspecialchars($row['LocationName']));
        }

        $locationName = "";
        if (is_null($row['UserID'])) {
            $locationName = htmlspecialchars($row['LocationName']);
        } else {
            $locationName = htmlspecialchars($row['UserLocationName']);
        }
        if ($locationName === "") {
            $locationName = $empty_column;
        }
        array_push($row_data, $locationName);

        if ($row['NetworkName'] === "") {
            array_push($row_data, $empty_column);
        } else {
            array_push($row_data, htmlspecialchars($row['NetworkName']));
        }

        $now = new DateTime();
        $date = new DateTime($row['WarrantyEnd']);
        $unix_diff = date_timestamp_get($date) - date_timestamp_get($now);
        $SECOND_TO_DAY = 60*60*24;
        //echo $date->diff($now)->format("%r%y");
        //array_push($row_data, $now->diff($date)->format("%r%y") + 1);
        array_push($row_data, floor($unix_diff / $SECOND_TO_DAY));

        //array_push($row_data, htmlspecialchars($row['WarrantyEnd']));
        
        //array_push($row_data, htmlspecialchars($row['DaysSinceChecked']));

        array_push($row_data, htmlspecialchars($row['PurchaseDate']));

        if (is_null($row['UserID'])) {
            array_push($row_data, $empty_column);
        } else {
            array_push($row_data, htmlspecialchars($row['FirstName'] . " " . $row['LastName']));
        }

        array_push($row_data, $row['Surplus']);

        //array_push($row_data, $row['FirstName'] . " " . $row['LastName']);
        //array_push($row_data, $row['Notes']);
        //array_push($row_data, "<td><button onclick=\"doAssetEdit('".$row['AssetID']."');\" data-toggle='tooltip' title='' class='pd-setting-ed' data-original-title='Edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><button onclick=\"doAssetDelete('".$row['AssetID']."');\" data-toggle='tooltip' title='' class='pd-setting-ed' data-original-title='Trash'><i class='fa fa-trash-o' aria-hidden='true'></i></button><button onclick=\"showCheckoutForm('".$row['AssetID']."');\" data-toggle='tooltip' title='' class='pd-setting-ed' data-original-title='Loan'><i class='fa fa-check' aria-hidden='true'></i></button></td>");
        array_push($row_data, "<td><button onclick=\"doAssetEdit('".$row['AssetID']."');\" data-toggle='tooltip' title='' class='pd-setting-ed' data-original-title='Edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><a style='color: white;' href='rform.php?serial=".$row['Serial']."'><button data-toggle='tooltip' title='' class='pd-setting-ed' data-original-title='Trash'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></button></a></td>");

        array_push($table_data['data'], $row_data);
	}
    echo json_encode($table_data);
}


//showAssetTable();

//showModelList(3, 1);
