<?php
	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		echo '<script type="text/javascript">alert("Error! Check your inbox and click on the verification link!");window.location.href = "https://betacars-webportal.000webhostapp.com/driverlogin.php";</script>';
	} else {
		$con = new mysqli('localhost', 'id5274488_betacars', 'cmsc207upou', 'id5274488_betacars_db');

		$email = $con->real_escape_string($_GET['email']);
		$token = $con->real_escape_string($_GET['token']);

		$sql = $con->query("SELECT id FROM driver_profile WHERE email_address='$email' AND hash='$token' AND isVerified=0");

		if ($sql->num_rows > 0) {
			$con->query("UPDATE driver_profile SET isVerified=1, hash='done' WHERE email_address='$email'");
			echo '<script type="text/javascript">alert("Your email has been verified! You can log in now!");window.location.href = "https://betacars-webportal.000webhostapp.com/driverlogin.php";</script>';
		} else
			echo '<script type="text/javascript">alert("Error! Check your inbox and click on the verification link!");window.location.href = "https://betacars-webportal.000webhostapp.com/driverlogin.php";</script>';
	}
?>