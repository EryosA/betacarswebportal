<?php
    if (isset($_POST['btnLogin'])) {
		$con = new mysqli('localhost', 'id5274488_betacars', 'cmsc207upou', 'id5274488_betacars_db');

		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);
		
		$sql = $con->query("SELECT id, password, isVerified, isApplied, isUpload FROM driver_profile WHERE email_address='$email'");
		if ($sql->num_rows > 0) {
            $data = $sql->fetch_array();
            if (password_verify($password, $data['password'])) {
                if ($data['isVerified'] == 0){
					session_start();
					$_SESSION['email'] = $email;
					$_SESSION['login_time'] = time();
					echo '<script type="text/javascript">window.location.href = "https://betacars-webportal.000webhostapp.com/driverconfirm_alert.php";</script>';
				}
                else {
					if ($data['isApplied'] == 0){
					    session_start();
						$_SESSION['email'] = $email;
						$_SESSION['login_time'] = time();
						echo '<script type="text/javascript">alert("Complete Driver Application Form!");window.location.href = "driverapplication.php";</script>';
					}
					else {
						if ($data['isUpload'] == 0){
							session_start();
							$_SESSION['email'] = $email;
							$_SESSION['login_time'] = time();
							echo '<script type="text/javascript">alert("Upload the Required Documents!");window.location.href = "driveruploadfiles.php";</script>';
						}
						else {
							session_start();
							$_SESSION['email'] = $email;
							$_SESSION['login_time'] = time();
							echo '<script type="text/javascript">alert("Successfully logged in to your account!");window.location.href = "driverportal.php";</script>';
						}
					}
                }
            }
			else {
				echo '<script type="text/javascript">alert("Invalid password, please try again!");window.location.href = "https://betacars-webportal.000webhostapp.com/driverlogin.php";</script>';
			}
		}
		else {
			echo '<script type="text/javascript">alert("Invalid email, please try again!");window.location.href = "https://betacars-webportal.000webhostapp.com/driverlogin.php";</script>';
		}
	}
	elseif (isset($_POST['btnReset'])) {
		$con = new mysqli('localhost', 'id5274488_betacars', 'cmsc207upou', 'id5274488_betacars_db');

		$email = $con->real_escape_string($_POST['recovery_email']);
		$sql = $con->query("SELECT id, password, first_name, last_name FROM driver_profile WHERE email_address='$email'");
		if ($sql->num_rows > 0) {
			$data = $sql->fetch_array();
			$temppassword = 'Temp'.$data['last_name'].'13571113';
			$hashedPassword = password_hash($temppassword, PASSWORD_BCRYPT);
			$con->query("UPDATE driver_profile SET password='$hashedPassword' WHERE email_address='$email'");
			
			$name = $data['first_name'].$data['last_name'];
			require 'phpmailer/PHPMailerAutoload.php';
			$mail = new PHPMailer();

			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPSecure = "tls";
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username = 'betacars.mailer@gmail.com';
			$mail->Password = 'cmsc207upou';

			$mail->setFrom('noreply@betacars.com', 'Betacars Mailer');
			$mail->addAddress($email, $name);
			$mail->Subject = 'Password Recovery';
			$mail->isHTML(true);
			$mail->Body = "
					Hello $name,<br><br>
		            Below is your temporary password, please use this to login to your account:<br><br>
					Password: $temppassword<br><br>
                    Beta Cars<br>
                    betacars.mailer@gmail.com
				";
               
			if ($mail->send()){
				echo '<script type="text/javascript">alert("Your new temporary password has been sent to your email address, please check your inbox.");</script>';
			}	
		
		}
		else {
			echo '<script type="text/javascript">alert("Email address is not associated with any account, please try again!");window.location.href = "https://betacars-webportal.000webhostapp.com/driverlogin.php";</script>';
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

    <title>Beta Cars Driver Login</title>

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
	  	
		      <form class="form-login" method="POST" action="">
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <input name="email" id="email" type="email" class="form-control" placeholder="Email" autofocus>
		            <br/>
		            <input name="password" id="password" type="password" class="form-control" placeholder="Password">
		            <a href="#0" class="hide-show"><span class="pull-right">Show</span></a>
		                <span class="pull-left">
		                    <a data-toggle="modal" href="driverlogin.php#myModal"> Forgot Password?</a>
		                </span>
		            <button class="btn btn-theme btn-block" name="btnLogin" type="submit" id="btnLogin"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="driverreg.php">
		                    CREATE AN ACCOUNT
						</a><br/>
						<label class="checkbox">
							<span class="pull-right">
									<a class="label label-danger" href="index.php">BACK</a>
									<a class="label label-success" href="login.php">ADMIN</a>
							</span>
						</label>
			        </div>
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="recovery_email" id="recovery_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" name="btnReset" type="submit" id="btnReset">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
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
        $.backstretch("assets/img/backgrounds/1.jpg", {speed: 500});
    </script>


  </body>
</html>
