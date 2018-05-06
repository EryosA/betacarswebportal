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
		
		if (isset($_POST['btnSubmit'])) {
			$plate_no = $con->real_escape_string($_POST['plate_no']);
			$cr_no = $con->real_escape_string($_POST['cr_no']);
			$mv_no = $con->real_escape_string($_POST['mv_file_no']);
			$engine_no = $con->real_escape_string($_POST['engine_no']);
			$make = $con->real_escape_string($_POST['make']);
			$series = $con->real_escape_string($_POST['series']);
			$body_type = $con->real_escape_string($_POST['body_type']);
			$year_model = $con->real_escape_string($_POST['year_model']);
			$car_type_id = $con->real_escape_string($_POST['car_type']);
			$license_no = $con->real_escape_string($_POST['license_no']);
			$license_ex = $con->real_escape_string($_POST['license_ex']);

			if ($con->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			$sql2 = "INSERT INTO car (plate_no, cr_no, mv_no, engine_no, make, series, body_type, year_model, car_type_id, driver_profile_id) VALUES ('$plate_no', '$cr_no', '$mv_no', '$engine_no', '$make', '$series', '$body_type', '$year_model', '$car_type_id', '$dp_id')";
			
			if ($con->query($sql2) === TRUE) {
				$car_id = $con->insert_id;
				$sql3 = "INSERT INTO driver (driver_profile_id, license_no, license_expiration, car_id, driver_appstat_id, driver_accstat_id) VALUES ('$dp_id', '$license_no', '$license_ex', '$car_id', 1, 1)";
				
				if ($con->query($sql3) === TRUE) {
					$driver_id = $con->insert_id;
					$con->query("INSERT INTO driver_status (pos_lat, pos_lng, driver_id, driver_status_type_id) VALUES (NULL, NULL, '$driver_id', 2)");
					echo '<script type="text/javascript">alert("License and Car Information Saved!");window.location.href = "driveruploadfiles.php";</script>';
					$con->query("UPDATE driver_profile SET isApplied=1 WHERE email_address='$activeuser'");
					$_SESSION['login_time'] = time();
					$_SESSION['email'] = $activeuser;
				} else {
					echo "Error: " . $sql3 . "<br>" . $con->error;
				}

			} else {
				echo "Error: " . $sql2 . "<br>" . $con->error;
			}
			
			$con->close();


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
    <title>Beta Cars Car Registration</title>
    <meta name="description" content="Beta Cars Car Registration">
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
                        <h3>Hi <?php echo $name ?>!</h3>
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
                  <span class="badge badge-pill badge-danger">Reminder!</span> You need to complete the following forms to be able to drive and access the Driver's Dashboard.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="alert alert-info" role="alert">
					Please fill in all the required information.<br/>Follow required format for each field.
                </div>
				
				<form action="" method="POST" class="">
				<div class="card">
                    <div class="card-header">
						<strong>Driver's License Information</strong>
                    </div>
                    <div class="card-body card-block">
  						<div class="row form-group">
							<div class="col col-md-4">
								<label for="license_no" class="form-control-label">License No.</label>
								<input type="text" id="license_no" name="license_no" title="Enter correct License No. format, Ex. A01-01-000001" placeholder="Ex. A01-01-000001" class="form-control" required pattern="[A-Z]{1,1}[0-9]{2,2}-[0-9]{2,2}-[0-9]{6,6}">
							</div>
							<div class="col col-md-4">
								<label for="license_ex" class="form-control-label">License Expiration</label>
								<input name="license_ex" class="form-control" id="license_ex" type="date" required>
							</div>
						</div>
                    </div>
                </div>
				<div class="card">
                    <div class="card-header">
						<strong>Car Information</strong>
                    </div>
                    <div class="card-body card-block">
  						<div class="row form-group">
							<div class="col col-md-4">
								<label for="plate_no" class="form-control-label">Plate No.</label>
								<input type="text" id="plate_no" name="plate_no" placeholder="Ex. ABC123 or AB1234" class="form-control" required>
							</div>
							<div class="col col-md-4">
								<label for="cr_no" class="form-control-label">CR No.</label>
								<input type="text" id="cr_no" name="cr_no" title="Enter correct CR No. format, 8digits-1digit" placeholder="Ex. 00000001-1" class="form-control" required pattern="[0-9]{8,8}-[0-9]{1,1}">
							</div>
							<div class="col col-md-4">
								<label for="mv_file_no" class="form-control-label">MV File No.</label>
								<input type="text" id="mv_file_no" name="mv_file_no" title="Enter correct MV File No. format, Ex. 4digits-11digits" placeholder="Ex. 0000-00000000001" class="form-control" required pattern="[0-9]{4,4}-[0-9]{11,11}">
							</div>
						</div>
						<div class="row form-group">
							<div class="col col-md-4">
								<label for="engine_no" class="form-control-label">Engine No.</label>
								<input type="text" id="engine_no" name="engine_no" placeholder="Ex. A1ABCD123456" class="form-control" required>
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
								<label for="series" class="form-control-label">Series</label>
								<input type="text" id="series" name="series" placeholder="Ex. Innova, CRV, Almera" class="form-control" required>
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
								<label for="year_model" class="form-control-label">Year Model</label>
								<select name="year_model" id="year_model" class="form-control" required>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018" selected>2018</option>
								</select>
							</div>
							<div class="col col-md-4">
								<label for="car_type" class="form-control-label">Car Type</label>
								<select name="car_type" id="car_type" class="form-control" required>
									<option value="1" selected>Regular</option>
									<option value="2">Premium</option>
								</select>
							</div>
						</div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit" name="btnSubmit">
							<i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
							<i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>
				</form>
            </div>
			 <div class="col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <strong class="card-title text-light">Driver Requirements</strong>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>Professional Driver's License</strong><br/>Scanned image of professional driver's license, front and back.</p>
								<p class="card-text"><strong>Vehicle's Certificate of Registration</strong><br/>Vehicle must be 3 years old or newer (e.g. if you are signing up in 2017, your vehicle must be a 2014 model or newer).</p>
                                <p class="card-text"><strong>Vehicle's Proof of Official Registration</strong><br/>In case your OR/CR is unavailable, we also accept Sales Invoice. Please note that this is only valid for the first 135 days upon issuance of your Provisional Authority.</p>
                                <p class="card-text"><strong>NBI Clearance</strong><br/>NBI Clearance must not be more than 6 months old upon filling of application.</p>
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


    <script src="assets_driverdashboard/js/dashboard.js"></script>
    <script src="assets_driverdashboard/js/widgets.js"></script>


</body>
</html>
