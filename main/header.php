<?php
/**
 *  Display the "current" class to an link on the nav. var if the current page matches the id of the nav. bar link
 * 
 *  @param int $page_id the page of the current page
 *  @param int $my_id the page id of the menu item
 */
function echoCurrentPageClass($page_id, $my_id) {
	if ($page_id == $my_id) {
		echo "id='current'";
	}
}

$titles = Array("Dashboard", "Summary", "Loan Form", "Reports", "Settings");

function displayHeader($page_id) {
    global $titles;
?>


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $titles[$page_id]?> | Asset Management System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/IULogo.png">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <!-- Datatables -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->

    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">-->
    <!--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.20/datatables.min.css"/>

    <!-- Noty -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">

    <!-- Selectize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.css">

    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- nalika Icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/nalika-icon.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css"> -->
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

        <div class="left-sidebar-pro">
            <nav id="sidebar" class="">
                <div class="sidebar-header">
                    <a href="dashboard.php"><img class="main-logo" src="img/logo/IULogo.png" alt="" style="width:75px; height:85px; margin: 15px;" /></a>
                    <strong><img src="img/logo/IULogo.png" style="width:40px; height:45px; margin: 15px;" alt="" /></strong>
                </div>
                
                <div class="left-custom-menu-adp-wrap comment-scrollbar">
                    <nav class="sidebar-nav left-sidebar-menu-pro">
                        <ul class="metismenu" id="menu1">
                                
                                <li class="active">
                                    <a <?php echoCurrentPageClass($page_id, 0); ?> href="dashboard.php">
                                        <i class="icon nalika-home icon-wrap"></i>
                                        <span class="mini-click-non">Dashboard</span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a <?php echoCurrentPageClass($page_id, 1); ?> href="summary-reports.php">
                                        <i class="icon nalika-bar-chart icon-wrap"></i>
                                        <span class="mini-click-non">Summary</span>
                                    </a>
        
                                </li>
                                <li class="active">
                                    <a <?php echoCurrentPageClass($page_id, 2); ?> href="rform.php">
                                        <i class="icon nalika-table icon-wrap"></i>
                                        <span class="mini-click-non">Loan Form</span>
                                    </a>
                                </li>
                                
                                <li class="active">
                                    <a <?php echoCurrentPageClass($page_id, 3); ?> href="reports.php">
                                        <i class="icon nalika-search icon-wrap"></i>
                                        <span class="mini-click-non">Reports</span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a <?php echoCurrentPageClass($page_id, 4); ?> href="settings.php">
                                        <i class="icon nalika-settings icon-wrap"></i>
                                        <span class="mini-click-non">Settings</span>
                                    </a>
                                </li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
        
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <br>
                <br>
                <br>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                    
                                    <!-- Menu Switcher -->
                                    <div class="menu-switcher-pro">
                                        <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
											<i class="icon nalika-menu-task"></i>
										</button>
                                    </div>
                                    
                                    
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <div class="breadcome-heading">
												<!-- <form role="search" class="">
													<input type="text" placeholder="Search by Serial #" class="form-control">
													<a href=""><i class="fa fa-search"></i></a>
												</form> -->
											</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item">
                                                        
                                                        <li><a href="login.php"><span class="icon nalika-unlocked author-log-ic"></span> Log Out</a>
                                                        </li>
                                                        
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger Menu start -->
            <div class="mobile-menu-area">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="mobile-menu">
                              <nav id="dropdown">
                                  <ul class="mobile-menu-nav">
                                      <li><a href="dashboard.php">Dashboard <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                          
                                      </li>
                                      
                                      <li><a href="summary-reports.php">Summary <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                          
                                      </li>
                                      <li><a  href="rform.php">Loan Form <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                          
                                      </li>
                                      <li><a  href="reports.php">Reports <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                          
                                      </li>
                                      <li><a href="settings.php">Settings <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                          
                                      </li>
                                      
                                  </ul>
                              </nav>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Mobile Hamburger Menu end -->


<?php }
?>





