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
		$dp_id =  $data['id'];
		$fname = $data['first_name'];
		$lname = $data['last_name'];
		$email = $data['email_address'];
		$mobile = $data['mobile_no'];
		
		if (isset($_POST['btnSave'])) {
			$new_fname = $con->real_escape_string($_POST['fname']);
			$new_lname = $con->real_escape_string($_POST['lname']);
			$new_email = $con->real_escape_string($_POST['email']);
			$new_mobile = $con->real_escape_string($_POST['mobile']);
			
			$con->query("UPDATE driver_profile SET mobile_no='$new_mobile', email_address='$new_email', first_name='$new_fname', last_name='$new_lname' WHERE id='$dp_id'");
			echo '<script type="text/javascript">alert("Successfully updated user information!");window.location.href = "driverviewuser.php";</script>';
			$_SESSION['login_time'] = time();
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
                    <li class="active menu-item-has-children dropdown">
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
                    <li class="menu-item-has-children dropdown">
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
                            <li class="active">Driver Dashboard / Account / Edit Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-lg-9 col-md-9">
 				<form action="" method="POST" class="">
				<div class="card">
                    <div class="card-header">
						<strong>User Information</strong>
                    </div>
                    <div class="card-body card-block">
  						<div class="row form-group">
							<div class="col col-md-6">
								<label for="fname" class=" form-control-label">First Name</label>
								<input type="text" id="fname" name="fname" value="<?php echo $fname ?>" class="form-control" placeholder="First Name" required>
							</div>
							<div class="col col-md-6">
								<label for="lname" class=" form-control-label">Last Name</label>
								<input type="text" id="lname" name="lname" value="<?php echo $lname ?>" class="form-control" placeholder="Last Name" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-6">
								<label for="email" class=" form-control-label">Email Address</label>
								<input type="email" id="email" name="email" value="<?php echo $email ?>" class="form-control" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
							</div>
							<div class="col col-md-6">
								<label for="mobile" class=" form-control-label">Mobile Number</label>
								<input type="text" id="mobile" name="mobile" value="<?php echo $mobile ?>" class="form-control" placeholder="Mobile Number" title="Ex. 09771234567" required pattern="09[0-9]{9,9}">
							</div>
						</div>
                    </div>
                    <div class="card-footer">
						<button type="submit" class="btn btn-primary btn-sm" id="btnSave" name="btnSave"><i class="fa fa-save"></i>&nbsp;Save</button>
						<a href="driverviewuser.php"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i>&nbsp;Cancel</button></a>
                    </div>
                </div>
				</form>
            </div>
          
                     
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets_driverdashboard/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets_driverdashboard/js/plugins.js"></script>
    <script src="assets_driverdashboard/js/main.js"></script>


    <script src="assets_driverdashboard/js/dashboard.js"></script>
    <script src="assets_driverdashboard/js/widgets.js"></script>
   

</body>
</html>
