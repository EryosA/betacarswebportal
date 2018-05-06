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
		$sql = $con->query("SELECT id, first_name, last_name, password FROM driver_profile WHERE email_address='$activeuser'");
		$data = $sql->fetch_array();
		$name = $data['first_name'].' '.$data['last_name'];
		$dp_id =  $data['id'];
		
		$sql2 = $con->query("SELECT id, plate_no, cr_no, mv_no, engine_no, series FROM car WHERE driver_profile_id = '$dp_id'");
		$data2 = $sql2->fetch_array();
		$plate_no = $data2['plate_no'];
		$cr_no = $data2['cr_no'];
		$mv_file_no = $data2['mv_no'];
		$engine_no = $data2['engine_no'];
		$series = $data2['series'];
		$c_id = $data2['id'];

		
		if (isset($_POST['btnSave'])) {
			$newplate_no = $con->real_escape_string($_POST['plate_no']);
			$newcr_no = $con->real_escape_string($_POST['cr_no']);
			$newmv_no = $con->real_escape_string($_POST['mv_file_no']);
			$newengine_no = $con->real_escape_string($_POST['engine_no']);
			$newmake = $con->real_escape_string($_POST['make']);
			$newseries = $con->real_escape_string($_POST['series']);
			$newbody_type = $con->real_escape_string($_POST['body_type']);
			$newyear_model = $con->real_escape_string($_POST['year_model']);
			$newcar_type_id = $con->real_escape_string($_POST['car_type']);
			
			$con->query("UPDATE car SET plate_no='$newplate_no', cr_no='$newcr_no', mv_no='$newmv_no', engine_no='$newengine_no', make='$newmake', series='$newseries', body_type='$newbody_type', year_model='$newyear_model', car_type_id='$newcar_type_id' WHERE id='$c_id'");
			echo '<script type="text/javascript">alert("Car Information updated successfully!");window.location.href = "driverviewcar.php";</script>';
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
                    <li class="active menu-item-has-children dropdown">
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
                            <li class="active">Driver Dashboard / Account / Edit Car Info</li>
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
						<strong>Car Information</strong>
                    </div>
                    <div class="card-body card-block">
  						<div class="row form-group">
							<div class="col col-md-4">
								<label for="plate_no" class=" form-control-label">Plate No.</label>
								<input type="text" id="plate_no" name="plate_no" value="<?php echo $plate_no ?>" placeholder="Ex. ABC123 or AB1234" class="form-control" required>
							</div>
							<div class="col col-md-4">
								<label for="cr_no" class=" form-control-label">CR No.</label>
								<input type="text" id="cr_no" name="cr_no" value="<?php echo $cr_no ?>" title="Enter correct CR No. format, 8digits-1digit" placeholder="Ex. 00000001-1" class="form-control" required pattern="[0-9]{8,8}-[0-9]{1,1}">		
							</div>
							<div class="col col-md-4">
								<label for="mv_file_no" class=" form-control-label">MV File No.</label>
								<input type="text" id="mv_file_no" name="mv_file_no" value="<?php echo $mv_file_no ?>" title="Enter correct MV File No. format, Ex. 4digits-11digits" placeholder="Ex. 0000-00000000001" class="form-control" required pattern="[0-9]{4,4}-[0-9]{11,11}">		
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-4">
								<label for="engine_no" class=" form-control-label">Engine No.</label>
								<input type="text" id="engine_no" name="engine_no" value="<?php echo $engine_no ?>" placeholder="Ex. A1ABCD123456" class="form-control" required>	
							</div>
							<div class="col col-md-4">
								<label for="make" class=" form-control-label">Make</label>
								<select name="make" id="make" class="form-control" required>
									<option value="">Select Car Brand</option>
									<option value="Acura">Acura</option>
									<option value="Alfa_Romeo">Alfa Romeo</option>
									<option value="Aston_Martin">Aston Martin</option>
									<option value="Audi">Audi</option>
									<option value="Bentley">Bentley</option>
									<option value="BMW">BMW</option>
									<option value="Bugatti">Bugatti</option>
									<option value="Buick">Buick</option>
									<option value="Cadillac">Cadillac</option>
									<option value="Chevrolet">Chevrolet</option>
									<option value="Chrysler">Chrysler</option>
									<option value="Citroen">Citroen</option>
									<option value="Dodge">Dodge</option>
									<option value="Ferrari">Ferrari</option>
									<option value="Fiat">Fiat</option>
									<option value="Ford">Ford</option>
									<option value="Geely">Geely</option>
									<option value="General_Motors">General Motors</option>
									<option value="GMC">GMC</option>
									<option value="Honda">Honda</option>
									<option value="Hyundai">Hyundai</option>
									<option value="Infiniti">Infiniti</option>
									<option value="Jaguar">Jaguar</option>
									<option value="Jeep">Jeep</option>
									<option value="Kia">Kia</option>
									<option value="Koenigsegg">Koenigsegg</option>
									<option value="Lamborghini">Lamborghini</option>
									<option value="Land Rover">Lexus</option>
									<option value="Maserati">Maserati</option>
									<option value="Mazda">Mazda</option>
									<option value="McLaren">McLaren</option>
									<option value="Mercedes_Benz">Mercedes-Benz</option>
									<option value="Mini">Mini</option>
									<option value="Mitsubishi">Mitsubishi</option>
									<option value="Nissan">Nissan</option>
									<option value="Pagani">Pagani</option>
									<option value="Peugeot">Peugeot</option>
									<option value="Porsche">Porsche</option>
									<option value="Ram">Ram</option>
									<option value="Renault">Renault</option>
									<option value="Rolls_Royce">Rolls Royce</option>
									<option value="Saab">Saab</option>
									<option value="Subaru">Subaru</option>
									<option value="Suzuki">Suzuki</option>
									<option value="Tata Motors">Tata Motors</option>
									<option value="Tesla">Tesla</option>
									<option value="Toyota">Toyota</option>
									<option value="Volkswagen">Volkswagen</option>
									<option value="Volvo">Volvo</option>
									<option value="Others">Others</option>
								</select>	
							</div>
							<div class="col col-md-4">
								<label for="series" class=" form-control-label">Series</label>
								<input type="text" id="series" name="series" value="<?php echo $series ?>" placeholder="Ex. Innova, CRV, Almera" class="form-control" required>	
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-4">
								<label for="body_type" class=" form-control-label">Body Type</label>
								<select name="body_type" id="body_type" class="form-control" required>
									<option value="">Select Car Body Type</option>
									<option value="Convertible">Convertible</option>
									<option value="Coupe">Coupe</option>
									<option value="Crossover">Crossover</option>
									<option value="Hatchback">Hatchback</option>
									<option value="MPV">MPV</option>
									<option value="Pick_up">Pick-up</option>
									<option value="Sedan">Sedan</option>
									<option value="SUV">SUV</option>
									<option value="Others">Others</option>
								</select>
							</div>
							<div class="col col-md-4">
								<label for="year_model" class=" form-control-label">Year Model</label>
								<select name="year_model" id="year_model" class="form-control" required>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018" selected>2018</option>
								</select>
							</div>
							<div class="col col-md-4">
								<label for="car_type" class=" form-control-label">Car Type</label>
								<select name="car_type" id="car_type" class="form-control" required>
									<option value="1" selected>Regular</option>
									<option value="2">Premium</option>
								</select>
							</div>
						</div>
					</div>
                    <div class="card-footer">
						<button type="submit" class="btn btn-primary btn-sm" id="btnSave" name="btnSave"><i class="fa fa-save"></i>&nbsp;Save</button>
						<a href="driverviewcar.php"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i>&nbsp;Cancel</button></a>
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
