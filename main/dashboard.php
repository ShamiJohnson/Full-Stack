<?php
include "../include/asset_form_util.php";
include "header.php";
require_once "databaseCon.php";
displayHeader(0);
?>
<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="icon nalika-home"></i>
                                </div>


                                <div class="breadcomb-ctn">
                                    <h2>Dashboard</h2>
                                    <p>Welcome to Asset <span class="bread-ntd">Mangement System<br></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">


                                <div class="add-product">
                                    <a type="button" class="btn btn-primary" onclick="$('#addAssetModal').modal('show');">Add Asset</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="breadcomb-icon">


                            <table class="table" style="text-align: center" >
                                <thead>
                                <tr style="color: white">
                                 <td><h4>Serial</h4></td>  <td><h4>Manufacturer</h4></td> <td><h4>Model</h4></td> <td><h4>Location</h4></td> <td><h4>Last Checked</h4></td> <td><h4> </h4></td>

                                </thead>
                                <tbody>


                                        <?php
                                        $stmt = $pdoConnect->prepare('SELECT * FROM VW_ASSET_NEW, SETTING where DaysSinceChecked >= SETTING.Value AND Surplus=0');
                                        $stmt->execute();
                                        $CATEGORY = $stmt->fetchAll();

                                        foreach($CATEGORY as $cat)
                                        {
                                        ?>
                                <tr style="color: white">
                                    <!-- <td><img src="img/new-product/5-small.jpg" alt="" /></td> -->

                                    <td><?php echo $cat['Serial']; ?></td>
                                    <td><?php echo $cat['ManufacturerName']; ?></td>
                                    <td><?php echo $cat['ModelName']; ?> </td>

                                    <td><?php echo $cat['UserLocationName']; ?>
                                    <td><?php echo $cat['DaysSinceChecked']; ?> </td>

                                    <td>
                                        <button style="float: right" type="button" class="btn btn-primary deleteBtnModel" > Verify! </button>
                                    </td>
                                </tr>

                                <!-- Fourth Part of Display Data -->
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>

                            <div class="all-content-wrapper">
                                <div class="modal fade" id="deleteModalModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Verify</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="settingFunctionality/process_dashboard.php" method="POST">
                                                <div class="modal-body">
                                                    <input type="hidden" name="AssetID" id="AssetID">
                                                    <h3>Click OK to confirm!</h3>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="submitQuery" class="btn btn-success">OK</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Link to hosted jQuery library goes after css file but before local js file -->
<!-- Probable performance boost if at very bottom of file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="settingFunctionality/settingsTabs/theme/external/jquery/jquery.js"></script>
<script src="settingFunctionality/settingsTabs/theme/jquery-ui.js"></script>
<script src="settingFunctionality/settingsTabs/validation/dist/jquery.validate.js"></script>
<!-- Link to js file specific to this html page goes below hosted library link -->
<script src="settingFunctionality/settingsTabs/js/formScrape.js"></script>
<script src="settingFunctionality/settingsTabs/js/form.js"></script>



<!-- bootstrap JS ============================================ -->
<script src="js/bootstrap.min.js"></script>





<!--  Add Modal -->
<div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #1b2a47; color: white;">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Add Asset</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" id="asset_add_form" method="POST" autocomplete="off">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Category*</label>
                        <?php showCategoryList(0, true); ?>
                    </div>

                    <div class="form-group">
                        <label>Manufacturer*</label>
                        <?php showManufacturerList(0, true); ?>
                    </div>

                    <div class="form-group">
                        <label>Model Name*</label>
                        <?php showModelList(0, 0, 0); ?>
                    </div>

                    <div class="form-group">
                        <label>Service Tag/s*</label>
                        <textarea placeholder="enter one serial tag per line" style="text-transform: uppercase;" class="form-control" name="serialnumbers"></textarea>
                    </div>

                    <div class="form-group">
                        <label>User</label>
                        <?php showUserList(0, true); ?>
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" style="text-transform: uppercase;" name="loc" class="form-control" placeholder="">
                        <!-- <?php showLocationList(0); ?> -->
                    </div>

                    <div class="form-group">
                        <label>Purchase Date</label>
                        <input type="date" name= "purchasedate" class="form-control" placeholder="mm-dd-year">
                    </div>
                    <div class="form-group">
                        <label>Network</label>
                        <input type="text" style="text-transform: uppercase;" name="network" class="form-control" placeholder="">
                        <!-- <?php showNetworkList(0); ?> -->
                    </div>
                    <div class="form-group">
                        <label>Warranty</label>
                        <input type="text" name= "warranty" class="form-control" placeholder="(in years)">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea class="form-control" name="notes"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="add-data" class="btn btn-success" onclick="doAssetAdd(this, event);">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal Ends -->


<?php include "footer.php"; ?>
<!-- modal functionality -->
<script src="settingFunctionality/get_dashboardinfo.js"></script>