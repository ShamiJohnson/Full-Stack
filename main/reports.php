<?php
include "../include/asset_form_util.php";
include "header.php";
displayHeader(3);
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
                                    <i class="icon nalika-search icon-wrap"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Reports</h2>
                                    <p>
                                        Take a
                                        <span class="bread-ntd"
                                        >deeper look at your assets</span
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">
                                <button
                                        data-toggle="tooltip"
                                        data-placement="left"
                                        title="Download Report"
                                        class="btn"
                                        id="download_report"
                                >
                                    <i class="icon nalika-download"></i>
                                </button>
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
<!-- End Welcome Area -->


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

<!--  Delete Asset Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #1b2a47; color: white;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="asset_delete_form"action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="deleteid" id="deleteid">
                    <h3>Are you sure you want to delete this asset?</h3>
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



<!--  Edit Modal -->
<div class="modal fade" id="editAssetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <div class="form-group">
                        <label>Category*</label>
                        <?php showCategoryList(); ?>
                    </div>

                    <div class="form-group">
                        <label>Manufacturer*</label>
                        <?php showManufacturerList(); ?>
                    </div>

                    <div class="form-group">
                        <label>Model Name*</label>
                        <?php showModelList(0, 0); ?>
                    </div>

                    <div class="form-group">
                        <label>Service Tag*</label>
                        <input type="text" name= "serialnumbers" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Location*</label>
                        <?php showLocationList(); ?>
                    </div>

                    <div class="form-group">
                        <label>Purchase Date</label>
                        <input type="date" name= "purchasedate" class="form-control" placeholder="mm-dd-year">
                    </div>
                    <div class="form-group">
                        <label>Network</label>
                        <?php showNetworkList(); ?>
                    </div>
                    <div class="form-group">
                        <label>Warranty</label>
                        <input type="text" name= "warranty" class="form-control" placeholder="(in years)">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea class="form-control" name="notes"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Surplus</label>
                        <input type="checkbox" name="surplus">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="add-data" class="btn btn-success" onclick="doAssetUpdate(this, event);">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal Ends -->



<!-- All Content Wrapper -->
<div class="all-content-wrapper">

    <div class="product-status mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Asset List</h4>
                        <div class="add-product">
                            <a type="button" class="btn btn-primary" onclick="$('#addAssetModal').modal('show');">Add Asset</a>
                        </div>
                        <div id="asset_table_container">
                            <?php showAssetTable(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
