<?php

	if (isset($_POST['btnSignup'])) {
		$con = new mysqli('localhost', 'id5274488_betacars', 'cmsc207upou', 'id5274488_betacars_db');


		$firstname = $con->real_escape_string($_POST['fname']);
		$lastname = $con->real_escape_string($_POST['lname']);
		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);
		$mobile = $con->real_escape_string($_POST['mobile']);
		
		$sql = $con->query("SELECT id FROM driver_profile WHERE mobile_no='$mobile'");
		$sql2 = $con->query("SELECT id FROM driver_profile WHERE email_address='$email'");
		if ($sql->num_rows > 0) {
				echo '<script type="text/javascript">alert("Mobile number already used, please register again!");</script>';
			}
		elseif ($sql2->num_rows > 0) {
		        echo '<script type="text/javascript">alert("Email already exists, please register again!");</script>';
		    }
		else {
			$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
			$token = str_shuffle($token);
			$token = substr($token, 0, 10);

			$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

			$con->query("INSERT INTO driver_profile (mobile_no, email_address, first_name, last_name, password, hash, isVerified, isApplied, isUpload)
					VALUES ('$mobile', '$email', '$firstname', '$lastname', '$hashedPassword', '$token', '0', '0', '0');
				");
			$name = "$firstname $lastname";
			require 'phpmailer/PHPMailerAutoload.php';
			$mail = new PHPMailer();
            
            $mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPSecure = "tls";
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username = 'betacars.mailer@gmail.com';
			$mail->Password = 'cmsc207upou';

			$mail->setFrom('noreply@betacars.com', 'Beta Cars Mailer');
			$mail->addAddress($email, $name);
			$mail->Subject = 'Email Verification';
			$mail->isHTML(true);
			$mail->Body = "
			        Hello $name,<br><br>
			        Welcome to betacars-webportal.000webhostapp.com!<br>
                    Please click on the link below to activate your account:<br><br>
                    <a href='https://betacars-webportal.000webhostapp.com/driverconfirm.php?email=$email&token=$token'>Click Here</a><br><br>
                    Beta Cars<br>
                    betacars.mailer@gmail.com
                ";
                
			if ($mail->send()){
				echo '<script type="text/javascript">alert("Verification email has been sent, please check your inbox and click the verification link to activate your account.");window.location.href = "https://betacars-webportal.000webhostapp.com/driverlogin.php";</script>';
	        }	
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Beta Cars Driver Registration</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style2.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
	  <div id="login-page">
	  	<div class="container">
			<div class="col-lg-4 pull-right">
		      <form class="form-login" method="POST" action="">
		        <h2 class="form-login-heading">sign up now</h2>
		        <div class="login-wrap">
					<input name="fname" id="fname" type="text" class="form-control" placeholder="First Name" autofocus required><br>
                    <input name="lname" id="lname" type="text" class="form-control" placeholder="Last Name" required><br>
                    <input name="mobile" id="mobile" type="text" class="form-control" placeholder="Mobile Number" title="Ex. 09771234567" required pattern="09[0-9]{9,9}"><br>
                    <input name="email" id="email" type="email" class="form-control" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"><br>
					<input name="password" id="password" type="password" class="password form-control" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
					<a href="#0" class="hide-show"><span class="pull-right">Show</span></a><br><br>
					<button class="btn btn-theme btn-block" name="btnSignup" type="submit" id="btnSignup"><i class="fa fa-user"></i> CREATE ACCOUNT</button>
                    <hr>
		            <div class="registration">
						Already have an account??<br/>
						<a class="" href="driverlogin.php">SIGN IN</a><br/>
						<label class="checkbox">
							<span class="pull-right">
								<a class="label label-danger" href="index.php">BACK</a>
							</span>
						</label>
			        </div>
		        </div>
		      </form>	  	
			</div>
		</div>
	  </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/scripts2.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/downloads/3.jpg", {speed: 500});
    </script>


  </body>
</html>
