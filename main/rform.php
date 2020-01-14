<?php
    include "../include/asset_form_util.php";
    include "header.php";
    require "upload-pdf.php";
    
	displayHeader(2);
    
    if (isset($_GET['serial'])) {
        $predata = getCheckoutData();
    }

    if (isset($predata)) {}

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
												<i class="icon nalika-table icon-wrap"></i>
											</div>
											<div class="breadcomb-ctn">
												<h2>Loan Form</h2>
												<p>Loan <span class="bread-ntd">an asset</span></p>
											</div>
										</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcomb-report">
                                          <button type="submit" onclick="window.open('fpdf/LoanForm.pdf')"
                                            data-toggle="tooltip"
                                            data-placement="left"
                                            title="Download Blank Form"
                                            class="btn"
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

    <!-- Single pro tab start-->
    <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                                <ul id="myTab3" class="tab-review-design">
                                    <li class="active"><a href="#makepdf"><i class="icon nalika-edit" aria-hidden="true"></i>Complete</a></li>
                                    <!-- <li><a href="#reviews"><i class="icon nalika-picture" aria-hidden="true"></i> Pictures</a></li> -->
                                    <li><a href="#uploadpdf"><i class="icon nalika-upload" aria-hidden="true"></i>Upload</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <!-- Html Complete Form -->
                                    <div class="product-tab-list tab-pane fade active in" id="makepdf">
                                        <form action="make-pdf.php" method="POST">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section ">

                                                    <!-- Full Name -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                        <input <?php if (isset($predata) && !is_null($predata['UserID'])) {echo "value='".htmlspecialchars($predata['FirstName'], ENT_QUOTES)." ".htmlspecialchars($predata['LastName'], ENT_QUOTES)."'";} ?> type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                                                    </div>

                                                    <!-- Purpose -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-menu" aria-hidden="true"></i></span>
                                                        
                                                        <select name="purpose" id="purpose" class="form-control" required>
                                                            <option value="" selected disabled hidden>Purpose</option>
                                                            <option value="N/A">N/A</option>
                                                            <option value="Faculty use for class">Faculty use for class</option>
                                                            <option value="Faculty use for meeting">Faculty use for meeting</option>
                                                            <option value="Staff use for work at home">Staff use for work at home</option>
                                                            <option value="Staff use for meeting">Staff use for meeting</option>                                 
                                                        </select>
                                                        
                                                    </div>
                                                    
                                                    <!-- Extra Item Select -->
                                                    <!-- <div class="input-group mg-b-pro-edt" style="width:100%;"> -->
                                                        <!-- <span class="input-group-addon"><i class="icon nalika-favorites-button" aria-hidden="true"></i></span> -->
                                                        <!-- <button class="form-control" required> -->
                                                        
                                                        <label class="form-control input-group mg-b-pro-edt">
                                                        <label style="margin-right: 14px;">
                                                         Extra Item:
                                                        </label> 
                                                        <input type="checkbox" style="margin-right: 3px;" id="extraselect" name="extraselect[]" value="Power Supply">
                                                        Power Supply
                                                        </label>

                                                        <label class="form-control input-group mg-b-pro-edt"><input type="checkbox" style="margin-right: 6px;" id="extraselect" name="extraselect[]" value="Network Wire">Network Wire</label>
                                                        <label class="form-control input-group mg-b-pro-edt"><input type="checkbox" style="margin-right: 6px;" id="extraselect" name="extraselect[]" value="Video Cord">Video Cord</label>
                                                        <label class="form-control input-group mg-b-pro-edt"><input type="checkbox" style="margin-right: 6px;" id="extraselect" name="extraselect[]" value="Mouse">Mouse</label>
                                                        <label class="form-control input-group mg-b-pro-edt"><input type="checkbox" style="margin-right: 6px;" id="extraselect" name="extraselect[]" value="None" checked>None</label>
                                                        
                                                        <!-- <input type="checkbox" style="color: white; margin-left: 6px;"  id="extraselect" name="extraselect[]" value="Network Wire"> Network Wire
                                                        <input type="checkbox" style="color: white; margin-left: 6px;"  id="extraselect" name="extraselect[]" value="Video Cord"> Video Cord
                                                        <input type="checkbox" style="color: white; margin-left: 6px;" id="extraselect" name="extraselect[]" value="Mouse"> Mouse
                                                        <input type="checkbox" style="color: white; margin-left: 6px;" id="extraselect" name="extraselect[]" value="None" checked> None -->
                                                  
                                                        <!-- </button> -->
                                                        
                                                    <!-- </div> -->

                  
                                                    <!-- Other Item Tag -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-edit" aria-hidden="true"></i></span>
                                                        <input type="text" name="otheritem" class="form-control" placeholder="Other Extra Item" required>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">

                                                    <!-- Email -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                        <input <?php if (isset($predata) && !is_null($predata['Email'])) {echo "value='". htmlspecialchars($predata['Email'], ENT_QUOTES) ."'";} ?> type="email" name="email" class="form-control" placeholder="Email" required>
                                                    </div>
                                                    

                                                    <!-- Manufacturer Select -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-favorites-button" aria-hidden="true"></i></span>
                                                        <?php if (isset($predata)) { ?>
                                                        <input value="<?= htmlspecialchars($predata['ManufacturerName'], ENT_QUOTES) ?>" type="text" id="manufacturerselect" name="manufacturerselect" class="form-control" placeholder="manufacturer" required>
                                                        <?php } else { ?>
                                                        <?php showManufacturerList(-1, true, true); ?>
                                                        <!-- <select name="manufacturerselect" id="manufacturerselect" class="form-control" required>
                                                            <option value="" selected disabled hidden>Manufacturer</option>
                                                            <option value="N/A">N/A</option>
                                                            <option value="Apple">Apple</option>
                                                            <option value="Samsung">Samsung</option>
                                                            <option value="Dell">Dell</option>
                                                            <option value="Lenovo">Lenovo</option>
                                                            <option value="HP">HP</option>
                                                            <option value="HP">Microsoft</option>
                                                            <option value="HP">Ricoh</option>
                                                            <option value="Samsung">Samsung</option>
                                                            <option value="Tandberg">Tandberg</option>
                                                            <option value="Logitech">Logitech</option>
                                                            <option value="Canon">Canon</option>
                                                            <option value="Cisco">Cisco</option>                                        
                                                        </select> -->
                                                        <?php } ?>
                                                    </div>

                                                    <!-- Category Select -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-desktop" aria-hidden="true"></i></span>

                                                        <?php if (isset($predata)) { ?>
                                                        <input value="<?= htmlspecialchars($predata['CategoryName'], ENT_QUOTES) ?>" type="text" name="categoryselect" id="categoryselect" class="form-control" placeholder="Service Tag" required>
                                                        <?php } else { ?>
                                                        <?php showCategoryList(-1, true, true); ?>
                                                        <!-- <select name="categoryselect" id="categoryselect" class="form-control" required>
                                                            <option value="" selected disabled hidden>Category</option>
                                                            <option value="N/A">N/A</option>
                                                            <option value="Camera">Camera</option>
                                                            <option value="Desktop">Desktop</option>
                                                            <option value="Laptop">Laptop</option>
                                                            <option value="Tablet">Tablet</option>
                                                            <option value="Printer">Printer</option>
                                                            <option value="Video Conferencing">Video Conferencing</option>                                     
                                                        </select> --> 
                                                        <?php } ?>
                                                    </div>

                                                    
                                                    <!-- Model Select -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-info" aria-hidden="true"></i></span>
                                                        <?php if (isset($predata)) { ?>
                                                        <input value="<?= htmlspecialchars($predata['ModelName'], ENT_QUOTES) ?>" type="text" name="modelselect" id="modelselect" class="form-control" placeholder="Service Tag" required>
                                                        <?php } else { ?>
                                                        <?php showFullModelList(true); ?>
                                                        <!-- <select name="modelselect" id="modelselect" class="form-control" required>
                                                            <option value="" selected disabled hidden>Model</option>
                                                            <option value="N/A">N/A</option>
                                                            <option value="Optiplex 5040">Optiplex 5040</option>
                                                            <option value="Optiplex 5050">Optiplex 5050</option>
                                                            <option value="Optiplex 7020">Optiplex 7020</option>
                                                            <option value="XPS 13">XPS 13</option>
                                                            <option value="Latitude 7450">Latitude 7450</option>
                                                            <option value="Latitude 7250">Latitude 7250</option>
                                                            <option value="Latitude 531">Latitude 531</option>
                                                            <option value="iMac">iMac</option>
                                                            <option value="MacAir">MacAir</option>
                                                            <option value="MacPro">MacPro</option>
                                                            <option value="MacBook">MacBook</option>
                                                        </select> -->
                                                        <?php } ?>
                                                    </div>
                                                    
                                                    <!-- Service Tag -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-price-tag" aria-hidden="true"></i></span>
                                                        <?php if (isset($predata)) { ?>
                                                        <input value="<?= htmlspecialchars($predata['Serial'], ENT_QUOTES) ?>" type="text" name="servicetag" class="form-control" placeholder="Service Tag" required>
                                                        <?php } else { ?>
                                                        <input type="text" name="servicetag" class="form-control" placeholder="Service Tag" required>
                                                        <?php } ?>
                                                    </div>
                      
                                                    <!-- Time -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i class="icon nalika-alarm-clock" aria-hidden="true"></i></span>
                                                        <input type="text" name="time" class="form-control" placeholder="Time">
                                                    </div>

                                                    <!-- Loan Date -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i aria-hidden="true"></i><strong>Loan Date: </strong></span>
                                                        <input type="date" name="loandate" class="form-control" required>
                                                    </div>

                                                    <!-- Return Date -->
                                                    <div class="input-group mg-b-pro-edt">
                                                        <span class="input-group-addon"><i aria-hidden="true"></i><strong>Return Date: </strong></span>
                                                        <input type="date" name="returndate" class="form-control">
                                                    </div>
                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <button type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10">Generate PDF
													</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    <!-- Html Complete Form ends -->

                                  <!-- Html Upload Form -->
                                  <div class="product-tab-list tab-pane fade" id="uploadpdf">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="text-center custom-pro-edt-ds">
                                                
                                                <form action="upload-pdf.php" method="POST" enctype="multipart/form-data">
                   
                                                <button style="vertical-align: top;" class="btn btn-ctl-bt waves-effect waves-light m-r-10">
                                                <input type="file" name="src" required>
                                                <!-- <input type="text" name="serial_number" required>-->
                                                </button>
                                                <!-- <input type="text" class="form-control" style="width: 500px; display: inline;"> -->
                                                <span id="serial_list_container">
                                                    <?php showSerialList(0); ?>
                                                </span>
                                                <button style="vertical-align: top;" type="submit" name="sb" class="btn btn-ctl-bt waves-effect waves-light m-r-10"> Upload
                                                </button>
                                                
                                                </form>
                                                <br>
                                                

                                            </div>
                                        </div>
                                    </div>

                                    <!-- PHP Upload Form -->
                                    <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for PDFs.."> -->

                                    <?php 
                                    if (isset($_GET['serial'])) {
                                        $stmt = $pdoConnect->prepare("SELECT * FROM ASSET WHERE Serial = ?");
                                        $stmt->execute([$_GET['serial']]);

                                        if ($stmt->rowCount() === 1) {
                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $assetid = $row['AssetID'];
                                            $t_serial_name = $_GET['serial'];
                                            echo "<h2 style='color: white;'>Forms For Asset $t_serial_name</h2>";

                                            $stmt=$pdoConnect->prepare('SELECT * FROM CHECKOUT WHERE AssetID=? ORDER BY CheckoutID DESC');
                                            $stmt->execute([$assetid]);
                                        } else {
                                            $stmt=$pdoConnect->prepare('SELECT * FROM CHECKOUT ORDER BY CheckoutID DESC');
                                            $stmt->execute();
                                        }
                                    } else {
                                        $stmt=$pdoConnect->prepare('SELECT * FROM CHECKOUT ORDER BY CheckoutID DESC');
                                        $stmt->execute();
                                    }

                                    if($stmt->rowCount()>0)
                                    {
                                        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                                        {
                                            extract($row);
                                    ?>

                                    <!-- Display of Form -->
                                    
                                    <table class="table" id="myTable">
                                        <thead>
                                            <tr>
                                            <th><a href="<?php echo $row['CheckoutFormURL'] ?>"> <?php echo $row['CheckoutFormURL'] ?> </a> </th>

                                            <!-- Delete button -->
                                            <th><a class="btn btn-danger" href="?delete_id=<?php echo $row['CheckoutID']?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a> </th>
                                            
                                            </tr>
                                        </thead>
                                    </table>  
                                    
                                    
                            
                                    <?php 
                                        }
                                    }
                                    ?>
                                    <!-- PHP Upload Form ends -->
                                    
                                    
                                </div> 
                                <!-- Html Upload Form ends -->

                                <!-- PHP Delete Form -->
                                <?php 
                                    
                                    if(isset($_GET['delete_id'])) {
                                        $stmt_select=$pdoConnect->prepare('SELECT * FROM CHECKOUT WHERE CheckoutID=:uid');
                                        $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
                                        $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
                                        unlink("uploads/".$imgRow['CheckoutFormURL']);
                                        $stmt_delete=$pdoConnect->prepare('DELETE FROM CHECKOUT WHERE CheckoutID =:uid');
                                        $stmt_delete->bindParam(':uid', $_GET['delete_id']);
                                        if($stmt_delete->execute()) {
                                            ?>
                                            <script>
                                            
                                            window.location.href=('rform.php');
                                            </script>
                                            <?php 
                                        } else
                                
                                        ?>
                                            <script>
                                            alert("Can not delete this item, try again!");
                                            window.location.href=('rform.php');
                                            </script>
                                            <?php 
                                        
                                
                                    }
                                
                                    ?>
                                    <!-- PHP Delete Form ends -->

                                </div> <!-- My Tab Content ends-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
<?php include "footer.php"; ?>

