<?php
include "header.php";
require_once "databaseCon.php";
displayHeader(4);

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

    $stmt = $pdoConnect->query("SELECT * FROM CATEGORY WHERE Visible = 'yes'");
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['CategoryID']] = $row['Name'];
	}

    htmlSelectList($select_list, "CategoryID", $default);
}

function showManufacturerList($default) {
    global $pdoConnect;

    $stmt = $pdoConnect->query("SELECT * FROM MANUFACTURER WHERE Visible = 'yes'");
   
    $select_list = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $select_list[$row['ManufacturerID']] = $row['Name'];
	}

    htmlSelectList($select_list, "ManufacturerID", $default);
}
?>

<!--    Settings page style and functionality goes here -->
<!--    <link rel="stylesheet" href="settingFunctionality/settingsTabs/formPrototype.css">-->
<!--    <link rel="stylesheet" href="settingFunctionality/settingsTabs/prices.css">-->
    <link href="settingFunctionality/settingsTabs/theme/jquery-ui.css" rel="stylesheet">

    <link rel="stylesheet" href="settingFunctionality/settingsTabs/form.css">
<!--    Settings style end here -->




<!-- Breadcome Area Starts -->
<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list" style="margin-bottom: 0px;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="icon nalika-settings"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Settings</h2>
                                    <p>Add new categories, manufacturers, <span class="bread-ntd">locations, models etc.</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcome Area ends -->

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">

                        <div class="breadcomb-icon">
                   <br><br>
                                <div id="tabs">
                                    <ul class="settingsTabsUL">
                                        <li class="settingsTabsLI"><a href="#tabs-1">Category</a></li>
                                        <li class="settingsTabsLI"><a href="#tabs-2">Manufacture</a></li>
                                        <li class="settingsTabsLI"><a href="#tabs-3">Model</a></li>
                                        <li class="settingsTabsLI"><a href="#tabs-4">User</a></li>
                                        <li class="settingsTabsLI"><a href="#tabs-5">Dashboard</a></li>
                                    </ul>
                                    <div id="tabs-1" class="settingsTabsDivs">

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                 <td>ASSETS</td><td></td>
                                                <td><a style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addAssetModal">Add</a></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM CATEGORY WHERE Visible = "yes" ');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr>
                                                <!-- <td><img src="img/new-product/5-small.jpg" alt="" /></td> -->

                                                <td style="border: none; color: transparent"><?php echo $cat['CategoryID']; ?></td>
                                                <td><?php echo $cat['Name']; ?></td>
                                                <td> <button style="float: right" type="button" class="btn btn-danger deleteBtn">Hide</button>
                                                    <button style="float: right" type="button" class="btn btn-primary editBtn">Edit</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table">
                                            <thead>
                                            <tr>
<!--                                                <td>Hidden Elements</td>-->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM CATEGORY WHERE Visible = "no" ');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr>
                                                <!-- <td><img src="img/new-product/5-small.jpg" alt="" /></td> -->

                                                <td style="border: none; color: transparent"><?php echo $cat['CategoryID']; ?></td>
                                                <td><?php echo $cat['Name']; ?></td>
                                                <td>
                                                    <button style="float: right" type="button" class="btn btn-danger makeVisibleModalBtn">Un Hide</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>
















                                        <script>
                                            function validateForm() {
                                                var x = document.forms["myForm"]["CategoryName"].value;
                                                if (x == "") {
                                                    alert("*Asset must be filled!");
                                                    return false;
                                                }
                                            }
                                        </script>
                                        <!-- Start Welcome area -->
                                        <div class="all-content-wrapper">
                                            <!--  Add Modal -->
                                            <div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add Asset</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form name="myForm" onsubmit="return validateForm()" action="settingFunctionality/process_category.php" method="POST">
                                                            <p class="form-message"></p>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Asset Name</label>
                                                                    <input id="CategoryName_val" type="text" name= "CategoryName" class="form-control" placeholder=" ">
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="add-data" class="btn btn-success" >Add</button>
                                                            </div>
                                                            <p id="displayFirst"></p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add Modal Ends -->

                                            <script>
                                                function validateFormTWO() {
                                                    var x = document.forms["myFormTWO"]["CategoryName"].value;
                                                    var y = document.forms["myFormTWO"]["newName"].value;
                                                    if ((x == "") && (y=="")) {
                                                        alert("*Fields Cannot be empty!");
                                                        return false;
                                                    }else if (y=="") {
                                                        alert("*Please enter new Asset");
                                                        return false;
                                                    }else if (x==""){
                                                        alert("*Please enter Asset");
                                                        return false;
                                                    }
                                                }
                                            </script>



                                            <!--  Edit Asset Modal -->
                                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Asset</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form name="myFormTWO" onsubmit="return validateFormTWO()" action="settingFunctionality/process_category.php" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Current Name</label>
                                                                    <input type="hidden" name= "CategoryName" id="AssetID" class="form-control" placeholder=" ">
                                                                    <input type="text" name= "" id="Asset" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>New Name</label>
                                                                    <input type="text" name= "newName" id="Assettt" class="form-control" placeholder=" ">
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="update-data" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                        <p id="displayTWO"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Asset Modal Ends -->

                                            <!--  hide Asset Modal -->
                                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hide Asset</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="settingFunctionality/process_category.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="deleteid" id="deleteid">
                                                                <h3>Are you sure you want to Hide this asset?</h3>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="HideData" class="btn btn-danger">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- hide Asset Modal Ends -->


                                            <!--  make visible again  Modal -->
                                            <div class="modal fade" id="makeVisibleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Show Asset</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="settingFunctionality/process_category.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="showCategory" id="showCategory">
                                                                <h3>Are you sure you want to show this asset?</h3>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="makeVisible" class="btn btn-success">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- make visible again Modal Ends -->








                                        </div><!-- all content wrapper -->

                                    </div><!--   TAB 1 DIV -->
<!--   TAB 1 ENDS HERE                                 -->

                                    <div id="tabs-2" class="settingsTabsDivs">






                                        <table class="table ">
                                            <thead>
                                            <tr>
                                                <td>MANUFACTURER</td><td></td>
                                                <td><a style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addAssetModalManu">Add</a></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM MANUFACTURER WHERE Visible = "yes"');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr>
                                                <!-- <td><img src="img/new-product/5-small.jpg" alt="" /></td> -->
                                                <td style="border: none; color: transparent"><?php echo $cat['ManufacturerID']; ?></td>
                                                <td><?php echo $cat['Name']; ?></td>
                                                <td> <button style="float: right" type="button" class="btn btn-danger deleteBtnManu">Hide</button>
                                                    <button style="float: right" type="button" class="btn btn-primary editBtnManu">Edit</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>




                                        <table class="table ">
                                            <thead>
                                            <tr>
                                                <!--                                                <td>Hidden Elements</td>-->

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM MANUFACTURER WHERE Visible = "no" ');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr>
                                                <!-- <td><img src="img/new-product/5-small.jpg" alt="" /></td> -->
                                                <td style="border: none; color: transparent"><?php echo $cat['ManufacturerID']; ?></td>
                                                <td><?php echo $cat['Name']; ?></td>
                                                <td>
                                                    <button style="float: right" type="button" class="btn btn-danger makeVisibleModalBtn_Manufacture">Un Hide</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>

















                                        <!-- Start Welcome area -->
                                        <div class="all-content-wrapper">


                                            <script>
                                                function validateManufacture() {
                                                    var x = document.forms["myFormManufacture"]["CategoryName"].value;
                                                    if (x == "") {
                                                        alert("*Asset must be filled out");
                                                        return false;
                                                    }
                                                }
                                            </script>
                                            <!--  Add Modal -->
                                            <div class="modal fade" id="addAssetModalManu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add Manufacturer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form name="myFormManufacture" onsubmit="return validateManufacture()" action="settingFunctionality/process_manufacture.php" method="POST">
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label>Manufacturer Name</label>
                                                                    <input type="text" name= "CategoryName" class="form-control" placeholder=" ">
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="add-data" class="btn btn-success">Add</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add Modal Ends -->



                                            <script>
                                                function validateManufactureTWO() {
                                                    var x = document.forms["myFormManufactureTWO"]["CategoryName"].value;
                                                    var y = document.forms["myFormManufactureTWO"]["newName"].value;
                                                    if ((x == "") && (y=="")) {
                                                        alert("*Fields Cannot be Empty");
                                                        return false;
                                                    }else if (y=="") {
                                                        alert("*Please enter new field");
                                                        return false;
                                                    }else if (x==""){
                                                        alert("*Please enter new field");
                                                        return false;
                                                    }
                                                }
                                            </script>
                                            <!--  Edit Asset Modal -->
                                            <div class="modal fade" id="editModalManu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Manufacturer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form name="myFormManufactureTWO" onsubmit="return validateManufactureTWO()" action="settingFunctionality/process_manufacture.php" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Manufacturer Name</label>
                                                                    <input type="hidden" name= "CategoryName" id="ManuID" class="form-control" placeholder=" ">
                                                                    <input type="text" name= "" id="AssetManu" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>New Name</label>
                                                                    <input type="text" name= "newName" id="serialnumber" class="form-control" placeholder=" ">
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="update-data" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Asset Modal Ends -->
                                            <!--  Delete Asset Modal -->
                                            <div class="modal fade" id="deleteModalManu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hide Manufacturer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="settingFunctionality/process_manufacture.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="deleteid" id="deleteidManu">
                                                                <h3>Are you sure you want to Hide this Manufacture?</h3>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="delete-data" class="btn btn-danger">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete Asset Modal Ends -->














                                            <!--  make visible again  Modal -->
                                            <div class="modal fade" id="makeVisibleModal_Manufacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Show Asset</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="settingFunctionality/process_manufacture.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="showManufacture" id="showManufacture">
                                                                <h3>Are you sure you want to show this manufacturer?</h3>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="makeVisible" class="btn btn-success">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- make visible again Modal Ends -->



















                                        </div>

                                    </div><!--   TAB 2 DIV -->
    <!--   TAB 2 ENDS HERE                                 -->



                                    <div id="tabs-3" class="settingsTabsDivs">

                                        <table class="table ">
                                            <thead>
                                            <tr>
                                                <td style="color: transparent">ID</td> <td>MODEL</td> <td>Category</td> <td>Manufacture</td>
                                                <td><a style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addAssetModalModel">Add</a></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM VW_MODEL  WHERE Visible = "yes"');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr>
                                                <!-- <td><img src="img/new-product/5-small.jpg" alt="" /></td> -->
                                                <td style="border: none; color: transparent"><?php echo $cat['ModelID']; ?></td>
                                                <td><?php echo $cat['Name']; ?></td>
                                                <td><?php echo $cat['CategoryName']; ?></td>
                                                <td><?php echo $cat['ManufacturerName']; ?></td>
                                                <td>
                                                    <button style="float: right" type="button" class="btn btn-danger deleteBtnModel">Hide</button>
                                                    <button style="float: right" type="button" class="btn btn-primary editBtn_Models">Edit</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>



                                        <table class="table ">
                                            <thead>
                                            <tr>
                                                                    <!--   HIDDEN -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM VW_MODEL  WHERE Visible = "no"');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr>
                                                <!-- <td><img src="img/new-product/5-small.jpg" alt="" /></td> -->
                                                <td style="border: none; color: transparent"><?php echo $cat['ModelID']; ?></td>
                                                <td><?php echo $cat['Name']; ?></td>
                                                <td><?php echo $cat['CategoryName']; ?></td>
                                                <td><?php echo $cat['ManufacturerName']; ?></td>
                                                <td>
                                                    <button style="float: right" type="button" class="btn btn-danger makeVisibleModalBtn_Model">Un Hide</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>



                                        <!-- Start Welcome area -->
                                        <div class="all-content-wrapper">

                                            <script>
                                                function validateModel() {
                                                    var ModelIDName = document.forms["myFormModel"]["ModelIDName"].value;
                                                    if (ModelIDName == "") {
                                                        alert("Model name must be filled out");
                                                        return false;
                                                    }
                                                }
                                            </script>
                                            <!--  Add Modal -->
                                            <div class="modal fade" id="addAssetModalModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add Model</h5>
                                                            <button type="buttCategoryID" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form name="myFormModel" onsubmit="return validateModel()" action="settingFunctionality/process_model.php" method="POST">
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label>Model Name</label>
                                                                    <input type="text"  id ="ModelIDName" name= "CategoryName" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Category ID</label>
                                                                    <!-- <input type="text" name= "CategoryID" class="form-control" placeholder=" ">-->
                                                                    <?php showCategoryList(0); ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Manufacture ID</label>
                                                                    <!-- <input type="text" name= "ManufacturerID" class="form-control" placeholder=" "> -->
                                                                    <?php showManufacturerList(0); ?>
                                                                </div>


                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="add-data" class="btn btn-success" >Add</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add Modal Ends -->





                                            <script>
                                                function validateModelTWO() {
                                                    var CategoryName = document.forms["myFormModelTWO"]["ModelName"].value;
                                                    var CategoryID = document.forms["myFormModelTWO"]["CategoryID"].value;
                                                    var ManufacturerID = document.forms["myFormModelTWO"]["ManufacturerID"].value;
                                                    var Visible = document.forms["myFormModelTWO"]["Visible"].value;
                                                    if (CategoryName == "") {
                                                        alert("Category must be filled out");
                                                        return false;
                                                    }else if (CategoryID=="") {
                                                        alert("Please insert valid Category ID");
                                                        return false;
                                                    }
                                                    else if (ManufacturerID=="") {
                                                        alert("Please insert valid Manufacturer ID");
                                                        return false;
                                                    }
                                                    else if (Visible=="") {
                                                        alert("Please insert valid Visibility");
                                                        return false;
                                                    }
                                                }
                                            </script>
                                            <!--  Edit Asset Modal -->
                                            <div class="modal fade" id="editModalModelDisplay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Model</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form name="myFormModelTWO" onsubmit="return validateModelTWO()" action="settingFunctionality/process_model.php" method="POST">
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label>ID</label>
                                                                    <input type="text" name= "ModelID" id="ModelIDdisplay" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Model Name</label>
                                                                    <input type="text" name= "ModelName" id="AssetdisplayModel" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div id="myFormModelTWODynamic">
                                                                        <div class="form-group">
                                                                            <label>Category ID</label>
                                                                            <input type="text" name= "CategoryID" id="CategoryID" class="form-control" placeholder=" ">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Manufacture ID</label>
                                                                            <input type="text" name= "ManufacturerID" id="ManufactureID" class="form-control" placeholder=" ">
                                                                        </div>
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="update-data" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Asset Modal Ends -->
                                            <!--  Delete Asset Modal -->
                                            <div class="modal fade" id="deleteModalModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hide Model</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="settingFunctionality/process_model.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="deleteid" id="deleteidModel">
                                                                <h3>Are you sure you want to Hide this Model?</h3>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="delete-data" class="btn btn-danger">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete Asset Modal Ends -->





                                            <!--  make visible again  Modal -->
                                            <div class="modal fade" id="makeVisibleModal_Model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Show Asset</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="settingFunctionality/process_model.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="showVisible_Model" id="showVisible_Model">
                                                                <h3>Are you sure you want to show this model?</h3>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="makeVisible" class="btn btn-success">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- make visible again Modal Ends -->








                                        </div><!--  all content wrapper div -->
                                    </div><!--   TAB 3 DIV -->
     <!--   TAB 3 ENDS HERE                                 -->


      <!--   TAB 5 ENDS HERE                                 -->



























                                    <div id="tabs-4" class="settingsTabsDivs">
                                        <div class="product-status-wrap">
                                        <table class="table ">
                                            <thead>
                                            <tr><td>Users</td> <td>First Name</td> <td>Last Name</td> <td>Email</td> <td>Phone</td> <td>Location Name</td>
                                                <td><a style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#addAssetUSERModel">Add</a></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM USER WHERE Visible = "yes"');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr width="12">
                                                <td style="border: none; color: transparent"><?php echo $cat['UserID']; ?></td>
                                                <td><?php echo $cat['FirstName']; ?></td>
                                                <td><?php echo $cat['LastName']; ?></td>
                                                <td><?php echo $cat['Email']; ?></td>
                                                <td><?php echo $cat['Phone']; ?></td>
                                                <td><?php echo $cat['LocationName']; ?></td>

                                                <td>
                                                    <button style="float: right" type="button" class="btn btn-danger deleteBtn_User">Hide</button>
                                                    <button style="float: right" type="button" class="btn btn-primary editBtn_User">Edit</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>





                                        <table class="table ">
                                            <thead>
                                            <tr>
                                                                                <!-- Hidden  -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM USER WHERE Visible = "no"');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr width="12">
                                                <td style="border: none; color: transparent"><?php echo $cat['UserID']; ?></td>
                                                <td><?php echo $cat['FirstName']; ?></td>
                                                <td><?php echo $cat['LastName']; ?></td>
                                                <td><?php echo $cat['Email']; ?></td>
                                                <td><?php echo $cat['Phone']; ?></td>
                                                <td><?php echo $cat['LocationName']; ?></td>

                                                <td>
                                                    <button style="float: right" type="button" class="btn btn-danger makeVisibleModalBtn_User">Un Hide</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>








                                        <!-- Start Welcome area -->
                                        <div class="all-content-wrapper">









                                            <script>
                                                function validateUser() {
                                                    var fName = document.forms["myFormUser"]["user_Fname"].value;
                                                    var user_lName = document.forms["myFormUser"]["user_lName"].value;
                                                    var user_Email = document.forms["myFormUser"]["user_Email"].value;
                                                    var user_Phone = document.forms["myFormUser"]["user_Phone"].value;
                                                    var user_Location = document.forms["myFormUser"]["user_Location"].value;

                                                    if (user_lName == "") {
                                                        alert("*Please insert valid Last name Name");
                                                        return false;
                                                    }else if (fName == "") {
                                                        alert("*Please insert valid First Name");
                                                        return false;
                                                    }
                                                    else if (user_Phone != "") {
                                                        if (user_Phone.length < 7){
                                                            alert("*Please insert valid Phone number.\n *Number length needs to be greater than 7");
                                                            return false;
                                                        }
                                                    }
                                                }
                                            </script>
                                            <!--  Add Modal -->
                                            <div class="modal fade" id="addAssetUSERModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form name="myFormUser" onsubmit="return validateUser()"  action="settingFunctionality/process_user.php" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>First Name</label><input type="text" name= "user_Fname" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Last Name</label><input type="text" name= "user_lName" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Email</label><input type="text" name= "user_Email" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Phone</label><input type="text" name= "user_Phone" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Location</label><input type="text" name= "user_Location" class="form-control" placeholder=" ">
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="add-data" class="btn btn-success">Add</button>
                                                            </div>
                                                        </form>
                                                        <p id="displayFuncUser"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add Modal Ends -->





                                            <script>
                                                function validateUserTWO() {
                                                    var fName = document.forms["myFormUserTWO"]["user_Fname"].value;
                                                    var user_lName = document.forms["myFormUserTWO"]["user_lName"].value;
                                                    var user_Email = document.forms["myFormUserTWO"]["user_Email"].value;
                                                    var user_Phone = document.forms["myFormUserTWO"]["user_Phone"].value;
                                                    var user_Location = document.forms["myFormUserTWO"]["user_Location"].value;

                                                    if (user_lName == "") {
                                                        alert("Please insert valid Last name Name");
                                                        return false;
                                                    }else if (fName == "") {
                                                        alert("Please insert valid First Name");
                                                        return false;
                                                    }
                                                    else if (user_Email == "") {
                                                        alert("Please insert valid Email");
                                                        return false;
                                                    }
                                                    else if (user_Phone == "") {
                                                        alert("Please insert valid Phone");
                                                        return false;
                                                    }
                                                    else if (user_Location=="") {
                                                        alert("Please insert valid Location");
                                                        return false;
                                                    }
                                                }
                                            </script>
                                            <!--  Edit Asset Modal -->
                                            <div class="modal fade" id="displayEdit_User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Model</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form name="myFormUserTWO" onsubmit="return validateUserTWO()"  action="settingFunctionality/process_user.php" method="POST">
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label>ID</label><input type="text" name= "user_ID" id="user_ID" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>First Name</label><input type="text" name= "user_Fname" id="user_Fname" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Last Name</label><input type="text" name= "user_lName" id="user_lName" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Email</label><input type="text" name= "user_Email" id="user_Email" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Phone</label><input type="text" name= "user_Phone" id="user_Phone" class="form-control" placeholder=" ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Location</label><input type="text" name= "user_Location" id="user_Location" class="form-control" placeholder=" ">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="update-data" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Edit Asset Modal Ends -->

                                            <!--  Delete Asset Modal -->
                                            <div class="modal fade" id="displayDelete_User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hide User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="settingFunctionality/process_user.php" method="POST">
                                                            <div class="modal-body">
                                                                <label>Are you sure you want to Hide this user?</label>
                                                                <input type="hidden" name="deleteidUSER" id="deleteidUSER">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="delete-data" class="btn btn-danger">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete Asset Modal Ends -->




                                            <!--  make visible again  Modal -->
                                            <div class="modal fade" id="makeVisibleModal_User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Show Asset</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="settingFunctionality/process_user.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="makeVisibleUSER" id="showUSER_">
                                                                <h3>Are you sure you want to show this user?</h3>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="makeVisible" class="btn btn-success">Confirm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- make visible again Modal Ends -->
                                        </div><!--  all content wrapper div -->

                                    </div>
                                    </div>

<!--                  div 5 ends here-->











                                    <div id="tabs-5" class="settingsTabsDivs">



                                        <table class="table ">
                                            <thead>
                                            <tr>
                                                <td>Name</td> <td>Value</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $stmt = $pdoConnect->prepare('SELECT * FROM SETTING');
                                                    $stmt->execute();
                                                    $CATEGORY = $stmt->fetchAll();

                                                    foreach($CATEGORY as $cat)
                                                    {
                                                    ?>
                                            <tr>
                                                <!-- <td><img src="img/new-product/5-small.jpg" alt="" /></td> -->
                                                <td><?php echo $cat['Name']; ?></td>
                                                <td><?php echo $cat['Value']; ?></td>

                                                <td>
                                                    <button style="float: right" type="button" class="btn btn-primary editBtn_Display">Edit</button>
                                                </td>
                                            </tr>

                                            <!-- Fourth Part of Display Data -->
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            </tr>
                                            </tbody>
                                        </table>





                                        <!--  Edit Asset Modal -->
                                        <div class="modal fade" id="displayEdit_Display" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Dashboard Display Items</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="settingFunctionality/process_Display.php" method="POST">
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label></label><input type="hidden" name= "DisplayName" id="DisplayName" class="form-control" placeholder=" ">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Current days</label><input type="text" name= "Display" id="Display" class="form-control" placeholder=" ">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="update-data" class="btn btn-success" onclick="myFunctionLocationTWO()">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Asset Modal Ends -->










                                    </div>



                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>

<!-- Link to hosted jQuery library goes after css file but before local js file -->
<!-- Probable performance boost if at very bottom of file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="settingFunctionality/settingsTabs/theme/external/jquery/jquery.js"></script>
<script src="settingFunctionality/settingsTabs/theme/jquery-ui.js"></script>
<script src="settingFunctionality/settingsTabs/validation/dist/jquery.validate.js"></script>
<!-- Link to js file specific to this html page goes below hosted library link -->
<script src="settingFunctionality/settingsTabs/js/formScrape.js"></script>
<script src="settingFunctionality/settingsTabs/js/form.js"></script>

<!-- modal functionality -->
<script src="settingFunctionality/show_category.js"></script>
<script src="settingFunctionality/show_manufacture.js"></script>
<script src="settingFunctionality/show_model.js"></script>
<script src="settingFunctionality/show_user.js"></script>
<script src="settingFunctionality/show_Display.js"></script>

<!-- bootstrap JS ============================================ -->
<script src="js/bootstrap.min.js"></script>

<!-- Noty -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>

<!-- Selectize -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>

<script src="js/main.js"></script>

<script>
$(function () {
    $("select").selectize();
});
</script>



</body>

</html>
