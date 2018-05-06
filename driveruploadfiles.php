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
		$btndell = '';
		$btndelc = '';
		$btndelo = '';
		$btndeln = '';

		$extensions = array('jpg', 'jpeg', 'png', 'pdf');
		
		foreach ($extensions as $ext) {
			if (file_exists($license.$ext)) {
				$licensestat = 'Uploaded';
				$btndell = '<form method="POST" action=""><button type="submit" class="btn btn-outline-danger btn-sm" name="btnDeleteL" id="btnDeleteL"><i class="fa fa-eraser"></i>&nbsp;Delete</button></form>';
				$linkL = $license.$ext;
				break;
			}else{
				$licensestat = 'None';
			}
		}
		
		foreach ($extensions as $ext) {
			if (file_exists($cr.$ext)) {
				$crstat = 'Uploaded';
				$btndelc = '<form method="POST" action=""><button type="submit" class="btn btn-outline-danger btn-sm" name="btnDeleteC" id="btnDeleteC"><i class="fa fa-eraser"></i>&nbsp;Delete</button></form>';
				$linkC = $cr.$ext;
				break;
			}else{
				$crstat = 'None';
			}
		}
		
		foreach ($extensions as $ext) {
			if (file_exists($or.$ext)) {
				$orstat = 'Uploaded';
				$btndelo = '<form method="POST" action=""><button type="submit" class="btn btn-outline-danger btn-sm" name="btnDeleteO" id="btnDeleteO"><i class="fa fa-eraser"></i>&nbsp;Delete</button></form>';
				$linkO = $or.$ext;
				break;
			}else{
				$orstat = 'None';
			}
		}
		
		foreach ($extensions as $ext) {
			if (file_exists($nbi.$ext)) {
				$nbistat = 'Uploaded';
				$btndeln = '<form method="POST" action=""><button type="submit" class="btn btn-outline-danger btn-sm" name="btnDeleteN" id="btnDeleteN"><i class="fa fa-eraser"></i>&nbsp;Delete</button></form>';
				$linkN = $nbi.$ext;
				break;
			}else{
				$nbistat = 'None';
			}
		}
		
		if (isset($_POST['btnDone'])) {
			if ($licensestat == 'Uploaded' && $crstat == 'Uploaded' && $orstat == 'Uploaded' && $nbistat == 'Uploaded') {
				$con->query("UPDATE driver_profile SET isUpload=1 WHERE email_address='$activeuser'");
				$_SESSION['login_time'] = time();
				$_SESSION['email'] = $activeuser;
				echo '<script type="text/javascript">alert("Driver Application Complete! You may access the Driver Dashboard and wait for driver approval from administrator!");window.location.href = "https://betacars-webportal.000webhostapp.com/driverportal.php";</script>';
			}else{
				echo '<script type="text/javascript">alert("You have not uploaded all the required documents, please login again and check which document is not uploaded!");window.location.href = "https://betacars-webportal.000webhostapp.com/driverlogout.php";</script>';
			}
		}elseif (isset($_POST['btnDeleteL'])) {
			if (unlink($linkL)) {
				echo '<script type="text/javascript">alert("Driver\'s License File has been deleted!");window.location.href = "https://betacars-webportal.000webhostapp.com/driveruploadfiles.php";</script>';
			}else{
				echo '<script type="text/javascript">alert("File delete error!");window.location.href = "https://betacars-webportal.000webhostapp.com/driveruploadfiles.php";</script>';
			}
		}elseif (isset($_POST['btnDeleteC'])) {
			if (unlink($linkC)) {
				echo '<script type="text/javascript">alert("Certificate of Registration File has been deleted!");window.location.href = "https://betacars-webportal.000webhostapp.com/driveruploadfiles.php";</script>';
			}else{
				echo '<script type="text/javascript">alert("File delete error!");window.location.href = "https://betacars-webportal.000webhostapp.com/driveruploadfiles.php";</script>';
			}
		}elseif (isset($_POST['btnDeleteO'])) {
			if (unlink($linkO)) {
				echo '<script type="text/javascript">alert("Registration Official Receipt File has been deleted!");window.location.href = "https://betacars-webportal.000webhostapp.com/driveruploadfiles.php";</script>';
			}else{
				echo '<script type="text/javascript">alert("File delete error!");window.location.href = "https://betacars-webportal.000webhostapp.com/driveruploadfiles.php";</script>';
			}
		}elseif (isset($_POST['btnDeleteN'])) {
			if (unlink($linkN)) {
				echo '<script type="text/javascript">alert("NBI Clearance File has been deleted!");window.location.href = "https://betacars-webportal.000webhostapp.com/driveruploadfiles.php";</script>';
			}else{
				echo '<script type="text/javascript">alert("File delete error!");window.location.href = "https://betacars-webportal.000webhostapp.com/driveruploadfiles.php";</script>';
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
    <title>Beta Cars Upload Driver Files</title>
    <meta name="description" content="Beta Cars Upload Driver Files">
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
	<link rel="stylesheet" href="assets_driverdashboard/css/dropzone.css">
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
                <a class="navbar-brand" href="./"><img src="assets_driverdashboard/img/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="assets_driverdashboard/img/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="driverlogout.php"> <i class="menu-icon fa fa-power-off"></i>Logout</a>
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

                
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Driver Application</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-lg-9 col-md-9">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
					<span class="badge badge-pill badge-danger"><h6>Reminders!</h6></span><br/>
					<ul >
						<li>
							Allowed file format is only <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, or <b>.pdf</b>.	
						</li>
						<li>
							You need to upload a scanned copy of the following documents to complete the driver application:<br/>
							<span class="ti-hand-point-right"></span> <b>Driver's License</b><br/>
							<span class="ti-hand-point-right"></span> <b>Certificate of Registration</b><br/>
							<span class="ti-hand-point-right"></span> <b>Latest Registration Official Receipt</b><br/>
							<span class="ti-hand-point-right"></span> <b>NBI Clearance</b>
						</li>
						<li>
							Please follow the filename format shown below, otherwise <b>files uploaded with incorrect filename will not be validated</b> by the system:<br/>
							<span class="ti-hand-point-right"></span> License_LastnameFirstname.jpg, ex. <b>License_SantosJuan.jpg</b><br/>
							<span class="ti-hand-point-right"></span> CR_LastnameFirstname.jpg, ex. <b>CR_SantosJuan.jpg</b><br/>
							<span class="ti-hand-point-right"></span> OR_LastnameFirstname.jpg, ex. <b>OR_SantosJuan.jpg</b><br/>
							<span class="ti-hand-point-right"></span> NBI_LastnameFirstname.jpg, ex. <b>NBI_SantosJuan.jpg</b>
						</li>
					</ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="card">
                    <div class="card-header">
						<strong>Upload Files</strong>
                    </div>
                    <div class="card-body card-block">
  						<div class="row form-group">
							<div class="col col-md-12">
								<form action="driverupload.php" id="uploads" class="dropzone"></form>
							</div>
						</div>
                    </div>
					<div class="card-footer">
						<form method="POST" action="">
							<button type="submit" class="btn btn-primary btn-sm" name="btnDone" id="btnDone">
							<i class="fa fa-dot-circle-o"></i> Done
							</button>
						</form>
                    </div>
                </div>
            </div>
			        <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-id-badge text-success border-success"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Driver's License</div>
                                        <div class="stat-digit"><?php echo $licensestat; ?></div>
										<?php echo $btndell; ?>
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
										<?php echo $btndelc; ?>
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
										<?php echo $btndelo; ?>
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
										<?php echo $btndeln; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets_driverdashboard/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets_driverdashboard/js/plugins.js"></script>
    <script src="assets_driverdashboard/js/main.js"></script>
	<script src="assets_driverdashboard/js/dropzone.js"></script>
	<script src="assets_driverdashboard/js/validate.js"></script>


    <script src="assets_driverdashboard/js/dashboard.js"></script>
    <script src="assets_driverdashboard/js/widgets.js"></script>


</body>
</html>
