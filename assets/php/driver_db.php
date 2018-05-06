<?php





/* Database connection settings */
$host = 'localhost';
$user = 'id5274488_betacars';
$pass = 'cmsc207upou';
$db = 'id5274488_betacars_db';


//initialize variables

$lname = "";
$fname = "";
$mnumber = "";
$licnumber = "";
$status = "";
$id = 0;
$edit_state = false;


$mysqli = mysqli_connect($host,$user,$pass,$db);





//update function

if (isset($_POST['update'])) {
    $id = $_POST['update'];


  $id = mysqli_real_escape_string($mysqli, $_POST['id']);
  $fname = mysqli_real_escape_string($mysqli, $_POST['first_name']);
  $lname = mysqli_real_escape_string($mysqli, $_POST['last_name']);
  $email = mysqli_real_escape_string($mysqli, $_POST['email_address']);
  $mnumber = mysqli_real_escape_string($mysqli, $_POST['mobile_no']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


  $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
  $token = str_shuffle($token);
  $token = substr($token, 0, 10);




$sql = mysqli_query($mysqli, "UPDATE driver_profile SET id='$id', last_name='$lname', first_name='$fname', mobile_no='$mnumber', email_address='$email', password='$hashedPassword' WHERE id=$id");

header ("Location:https://betacars-webportal.000webhostapp.com/Driver_List.php?update=success");


}

//delete function
if (isset($_GET['del'])) {
   $id = $_GET['del'];
   $result = mysqli_query($mysqli, "DELETE FROM driver_profile WHERE id='$id'");
   $result1 = mysqli_query($mysqli, "DELETE FROM driver WHERE id='$id'");
   $result2 = mysqli_query($mysqli, "DELETE FROM driver_application_status WHERE id='$id'");
   $result3 = mysqli_query($mysqli, "DELETE FROM driver_status WHERE id='$id'");
   $result4 = mysqli_query($mysqli, "DELETE FROM car WHERE id='$id'");
   $result5 = mysqli_query($mysqli, "DELETE FROM car_type WHERE id='$id'");

   if($result) {
    header("Location: https://betacars-webportal.000webhostapp.com/Driver_List.php?submit=success");

   } else {
     echo "Delete Driver Failed";



   /*
   if (mysqli_query($conn, $sql)) {
    header("Location:https://betacars-webportal.000webhostapp.com/Driver_List.php?submit=success");
    exit();

 } else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   */

}
}
