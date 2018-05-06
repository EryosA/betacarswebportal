<?php
$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'uploads';   //2
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
	$file_name = $_FILES['file']['name']; 
	 
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
	
    move_uploaded_file($tempFile,$targetFile); //6
	
	session_start();
	$activeuser = $_SESSION["email"];
	$con = new mysqli('localhost', 'id5274488_betacars', 'cmsc207upou', 'id5274488_betacars_db');
	$sql = $con->query("SELECT id FROM driver_profile WHERE email_address='$activeuser'");
	$data = $sql->fetch_array();
	$dp_id =  $data['id'];
    
	$con->query("INSERT INTO driver_documents (driver_profile_id, file_name, file_path) VALUES ('$dp_id', '$file_name', '$targetFile')");
}
?> 