<?php
    session_start();
	if ( !isset( $_SESSION['email'] )){
		  echo '<script type="text/javascript">alert("Not Allowed");window.location.href = "driverlogout.php";</script>';
	}
	elseif (time() - $_SESSION['login_time'] > 900) {
	    echo '<script type="text/javascript">alert("Session Expired");window.location.href = "driverlogout.php";</script>';
	}
	else {
		$_SESSION['login_time'] = time();
		$activeuser = $_SESSION["email"];
		$con = new mysqli('localhost', 'id5274488_betacars', 'cmsc207upou', 'id5274488_betacars_db');
		$sql = $con->query("SELECT id, first_name, last_name, mobile_no, email_address, password FROM driver_profile WHERE email_address='$activeuser'");
		$data = $sql->fetch_array();
		$name = $data['first_name'].' '.$data['last_name'];
		$fname = $data['first_name'];
		$fname = str_replace(' ', '', $fname);
		$dp_id =  $data['id'];
		
		$license = 'uploads/License_'.$data['last_name'].$fname.'.';
		$cr = 'uploads/CR_'.$data['last_name'].$fname.'.';
		$or = 'uploads/OR_'.$data['last_name'].$fname.'.';
		$nbi = 'uploads/NBI_'.$data['last_name'].$fname.'.';
		$btnviewl = '';
		$btnviewc = '';
		$btnviewo = '';
		$btnviewn = '';

		$extensions = array('jpg', 'jpeg', 'png', 'pdf');
		
		foreach ($extensions as $ext) {
			if (file_exists($license.$ext)) {
				$licensestat = 'Uploaded';
				$btnviewl = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#licenseModal"><i class="fa fa-eye"></i>&nbsp;View</button>';
				$linkl = $license.$ext;
				if ($ext == 'pdf') {
					$typel = 'application/'.$ext;
					$msgl1 = 'This browser does not support PDFs. Please download the PDF to view it:';
					$msgl2 = 'Download PDF';
				}else{
					$typel = 'image/'.$ext;
					$msgl1 = 'Download image if viewer is not working:';
					$msgl2 = 'Download Image';
				}
				break;
			}else{
				$licensestat = 'None';
			}
		}
		
		foreach ($extensions as $ext) {
			if (file_exists($cr.$ext)) {
				$crstat = 'Uploaded';
				$btnviewc = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#crModal"><i class="fa fa-eye"></i>&nbsp;View</button>';
				$linkc = $cr.$ext;
				if ($ext == 'pdf') {
					$typec = 'application/'.$ext;
					$msgc1 = 'This browser does not support PDFs. Please download the PDF to view it:';
					$msgc2 = 'Download PDF';
				}else{
					$typec = 'image/'.$ext;
					$msgc1 = 'Download image if viewer is not working:';
					$msgc2 = 'Download Image';
				}
				break;
			}else{
				$crstat = 'None';
			}
		}
		
		foreach ($extensions as $ext) {
			if (file_exists($or.$ext)) {
				$orstat = 'Uploaded';
				$btnviewo = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#orModal"><i class="fa fa-eye"></i>&nbsp;View</button>';
				$linko = $or.$ext;
				if ($ext == 'pdf') {
					$typeo = 'application/'.$ext;
					$msgo1 = 'This browser does not support PDFs. Please download the PDF to view it:';
					$msgo2 = 'Download PDF';
				}else{
					$typec = 'image/'.$ext;
					$msgo1 = 'Download image if viewer is not working:';
					$msgo2 = 'Download Image';
				}
				break;
			}else{
				$orstat = 'None';
			}
		}
		
		foreach ($extensions as $ext) {
			if (file_exists($nbi.$ext)) {
				$nbistat = 'Uploaded';
				$btnviewn = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#nbiModal"><i class="fa fa-eye"></i>&nbsp;View</button>';
				$linkn = $nbi.$ext;
				if ($ext == 'pdf') {
					$typen = 'application/'.$ext;
					$msgn1 = 'This browser does not support PDFs. Please download the PDF to view it:';
					$msgn2 = 'Download PDF';
				}else{
					$typec = 'image/'.$ext;
					$msgn1 = 'Download image if viewer is not working:';
					$msgn2 = 'Download Image';
				}
				break;
			}else{
				$nbistat = 'None';
			}
		}
	}
?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Beta Cars Driver Dashboard</title>
    <meta name="description" content="Beta Cars Driver Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="assets_driverdashboard/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets_driverdashboard/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets_driverdashboard/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets_driverdashboard/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets_driverdashboard/ico/apple-touch-icon-57-precomposed.png">

    <link rel="stylesheet" href="assets_driverdashboard/css/normalize.css">
    <link rel="stylesheet" href="assets_driverdashboard/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_driverdashboard/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets_driverdashboard/css/themify-icons.css">
    <link rel="stylesheet" href="assets_driverdashboard/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets_driverdashboard/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets_driverdashboard/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
	
</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="driverlogout.php"><img src="assets_driverdashboard/img/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="driverlogout.php"><img src="assets_driverdashboard/img/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="driverportal.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Account</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>User</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="driverviewuser.php">My Profile</a></li>
                            <li><i class="fa fa-edit"></i><a href="driveredituser.php">Edit Profile</a></li>
                            <li><i class="fa fa-exchange"></i><a href="drivereditpassword.php">Change Password</a></li>
							<li><i class="fa fa-credit-card"></i><a href="driverviewlic.php">View License Info</a></li>
							<li><i class="fa fa-pencil-square"></i><a href="drivereditlic.php">Edit License Info</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-car"></i>Car</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="ti-file"></i><a href="driverviewcar.php">View Car Info</a></li>
                            <li><i class="fa fa-pencil"></i><a href="drivereditcar.php">Edit Car Info</a></li>
                        </ul>
                    </li>
                    <li class="active menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Documents</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="ti-files"></i><a href="driverviewdocu.php">View Documents</a></li>
                            <li><i class="ti-pencil-alt"></i><a href="drivereditdocu.php">Edit Documents</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Reports</h3><!-- /.menu-title -->

                    <li>
                        <a href="#"> <i class="menu-icon fa fa-bar-chart"></i>Revenue</a>
                    </li>
                   
                    <h3 class="menu-title"></h3><!-- /.menu-title -->
					<li>
                        <a href="driverlogout.php"> <i class="menu-icon fa fa-sign-out"></i>Logout
					</li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <h3>Hi <?php echo $name; ?>!</h3>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-cogs"></i>
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="driverviewuser.php"><i class="fa fa- user"></i>My Profile</a>
								<a class="nav-link" href="driverviewcar.php"><i class="fa fa- car"></i>My Car</a>
                                <a class="nav-link" href="driverlogout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Driver Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Driver Dashboard / Account / View Documents</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
			<div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <strong class="card-title text-light">Uploaded Documents</strong>
                    </div>
                    <div class="card-body">
					
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body">
									<div class="stat-widget-one">
										<div class="stat-icon dib"><i class="ti-id-badge text-success border-success"></i></div>
										<div class="stat-content dib">
											<div class="stat-text">Driver's License</div>
											<div class="stat-digit"><?php echo $licensestat; ?></div>
											<?php echo $btnviewl; ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body">
									<div class="stat-widget-one">
										<div class="stat-icon dib"><i class="ti-car text-primary border-primary"></i></div>
										<div class="stat-content dib">
											<div class="stat-text">C.R.</div>
											<div class="stat-digit"><?php echo $crstat; ?></div>
											<?php echo $btnviewc; ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body">
									<div class="stat-widget-one">
										<div class="stat-icon dib"><i class="ti-receipt text-warning border-warning"></i></div>
										<div class="stat-content dib">
											<div class="stat-text">O.R.</div>
											<div class="stat-digit"><?php echo $orstat; ?></div>
											<?php echo $btnviewo; ?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body">
									<div class="stat-widget-one">
										<div class="stat-icon dib"><i class="ti-file text-danger border-danger"></i></div>
										<div class="stat-content dib">
											<div class="stat-text">NBI Clearance</div>
											<div class="stat-digit"><?php echo $nbistat; ?></div>
											<?php echo $btnviewn; ?>
										</div>
									</div>
								</div>
							</div>
						</div>		
						
                    </div>
					<div class="card-footer">
						<a href="drivereditdocu.php"><button type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit Documents</button></a>
                    </div>
                </div>
			</div>
			<!-- Modals -->
			<div class="modal fade" id="licenseModal" tabindex="-1" role="dialog" aria-labelledby="licenseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="licenseModalLabel">Driver's License</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
							<object data="<?php echo $linkl; ?>" type="<?php echo $typel; ?>" width="100%" height="100%">
								<iframe src="<?php echo $linkl; ?>" width="100%" height="100%" style="border: none;">
								<?php echo $msgl1; ?> <a href="<?php echo $linkl; ?>"><?php echo $msgl2; ?></a>
								</iframe>
							</object>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Modals -->
			
			<!-- Modals -->
			<div class="modal fade" id="crModal" tabindex="-1" role="dialog" aria-labelledby="crModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="crModalLabel">Certificate of Registration</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
							<object data="<?php echo $linkc; ?>" type="<?php echo $typec; ?>" width="100%" height="100%">
								<iframe src="<?php echo $linkc; ?>" width="100%" height="100%" style="border: none;">
								<?php echo $msgc1; ?> <a href="<?php echo $linkc; ?>"><?php echo $msgc2; ?></a>
								</iframe>
							</object>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Modals -->
			
			<!-- Modals -->
			<div class="modal fade" id="orModal" tabindex="-1" role="dialog" aria-labelledby="orModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="orModalLabel">Registration Official Receipt</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
							<object data="<?php echo $linko; ?>" type="<?php echo $typel; ?>" width="100%" height="100%">
								<iframe src="<?php echo $linko; ?>" width="100%" height="100%" style="border: none;">
								<?php echo $msgo1; ?> <a href="<?php echo $linko; ?>"><?php echo $msgo2; ?></a>
								</iframe>
							</object>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Modals -->
			
			<!-- Modals -->
			<div class="modal fade" id="nbiModal" tabindex="-1" role="dialog" aria-labelledby="nbiModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="nbiModalLabel">NBI Clearance</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
							<object data="<?php echo $linkn; ?>" type="<?php echo $typel; ?>" width="100%" height="100%">
								<iframe src="<?php echo $linkn; ?>" width="100%" height="100%" style="border: none;">
								<?php echo $msgn1; ?> <a href="<?php echo $linkn; ?>"><?php echo $msgn2; ?></a>
								</iframe>
							</object>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Modals -->
			
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
	
    <script src="assets_driverdashboard/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets_driverdashboard/js/plugins.js"></script>
    <script src="assets_driverdashboard/js/main.js"></script>
	<script src="assets_driverdashboard/js/popper.min.js"></script>


    <script src="assets_driverdashboard/js/dashboard.js"></script>
    <script src="assets_driverdashboard/js/widgets.js"></script>
	
</body>
</html>
