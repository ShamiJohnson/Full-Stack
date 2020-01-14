<?php
    include "../include/summary_page_util.php";
	include "header.php";
	displayHeader(1);
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
                          <i class="icon nalika-bar-chart icon-wrap"></i>
                        </div>
                        <div class="breadcomb-ctn">
                          <h2>Summary</h2>
                          <p>
                            View summary
                            <span class="bread-ntd"
                              >of catalogued assets</span
                            >
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <div class="breadcomb-report">
                        <a target="_blank" href="summary-csv.php"><button
                          data-toggle="tooltip"
                          data-placement="left"
                          title="Download Report"
                          class="btn"
                        >
                          <i class="icon nalika-download"></i>
                        </button></a>
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


    <!-- All Content Wrapper -->
    <div class="all-content-wrapper">

    

        <!-- Single pro tab start-->
        <!--
        <div class="single-product-tab-area mg-b-30">
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div style="padding-top: 8px;" class="review-tab-pro-inner">
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
											<div class="breadcomb-ctn">
												<h2 style="padding-bottom: 16px;">Filter Options</h2>
											</div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <select style='margin-bottom: 15px;' name="select" class="form-control pro-edt-select form-control-primary">
														<option value="opt1">User</option>
														<option value="opt2">2</option>
														<option value="opt3">3</option>
														<option value="opt4">4</option>
														<option value="opt5">5</option>
														<option value="opt6">6</option>
													</select>
                                                    <select style='margin-bottom: 15px;' nname="select" class="form-control pro-edt-select form-control-primary">
														<option value="opt1">Status</option>
														<option value="opt2">Verified</option>
														<option value="opt3">Unverified</option>
														<option value="opt4">Missing</option>
													</select>
                                                    <select style='margin-bottom: 15px;' nname="select" class="form-control pro-edt-select form-control-primary">
														<option value="opt1">Location</option>
														<option value="opt2">2</option>
														<option value="opt3">3</option>
														<option value="opt4">4</option>
														<option value="opt5">5</option>
														<option value="opt6">6</option>
													</select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <select style='margin-bottom: 15px;' nname="select" class="form-control pro-edt-select form-control-primary">
														<option value="opt1">Model</option>
														<option value="opt2">2</option>
														<option value="opt3">3</option>
														<option value="opt4">4</option>
														<option value="opt5">5</option>
														<option value="opt6">6</option>
													</select>
                                                    <select style='margin-bottom: 15px;' nname="select" class="form-control pro-edt-select form-control-primary">
														<option value="opt1">Manufacturer</option>
														<option value="opt2">2</option>
														<option value="opt3">3</option>
														<option value="opt4">4</option>
														<option value="opt5">5</option>
														<option value="opt6">6</option>
													</select>
                                                    <select style='margin-bottom: 15px;' nname="select" class="form-control pro-edt-select form-control-primary">
														<option value="opt1">Category</option>
														<option value="opt2">2</option>
														<option value="opt3">3</option>
														<option value="opt4">4</option>
														<option value="opt5">5</option>
														<option value="opt6">6</option>
													</select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
													<input class="form-check-input" type="checkbox">
													<label style="color: white; margin-left: 4px; margin-right: 10px;" class="form-check-label" for="defaultCheck1">
														Include Surplus
													</label>
                                                    <button type="button" class="btn btn-ctl-bt waves-effect waves-light m-r-10">Filter
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
        </div>
        -->
        <!-- Single Pro Tab Ends -->




        <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h2 style="color: white; margin-bottom: 32px;"><?php showHeader(); ?></h2>
                            <div id="overview_list">
                                <?php showAll(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

<?php include "footer.php"; ?>
