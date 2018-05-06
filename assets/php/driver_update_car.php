<?php
/* Database connection settings */
include_once 'db.php';





$pno = "";
$plate_no= "";
$cr_no = "";
$mv_no = "";
$engine_no = "";
$make = "";
$series = "";
$body_type = "";
$year_model = "";
$car_type_id = "";
$driver_profile_id = "";
$id = 0;
$edit_state = false;


$mysqli = mysqli_connect($host,$user,$pass,$db);





//update function

if (isset($_POST['update'])) {
    $id = $_POST['update'];


  $id = mysqli_real_escape_string($mysqli, $_POST['id']);
  $plate_no= mysqli_real_escape_string($mysqli, $_POST['plate_no']);
  $cr_no = mysqli_real_escape_string($mysqli, $_POST['cr_no']);
  $mv_no = mysqli_real_escape_string($mysqli, $_POST['mv_no']);
  $engine_no = mysqli_real_escape_string($mysqli, $_POST['engine_no']);
  $make = mysqli_real_escape_string($mysqli, $_POST['make']);
  $series = mysqli_real_escape_string($mysqli, $_POST['series']);
  $body_type = mysqli_real_escape_string($mysqli, $_POST['body_type']);
  $year_model = mysqli_real_escape_string($mysqli, $_POST['year_model']);
  $car_type_id = mysqli_real_escape_string($mysqli, $_POST['car_type_id']);
  $driver_profile_id = mysqli_real_escape_string($mysqli, $_POST['driver_profile_id']);







$sql = mysqli_query($mysqli, "UPDATE car SET id='$id', plate_no='$plate_no', cr_no='$cr_no', mv_no='$mv_no', engine_no='$engine_no', make='$make', series='$series' , body_type='$body_type', year_model='$year_model', car_type_id='$car_type_id', driver_profile_id='$driver_profile_id' WHERE id=$id");

header ("Location:https://betacars-webportal.000webhostapp.com/Driver_List.php?update=success");


}
