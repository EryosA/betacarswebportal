<?php
/* Database connection settings */
include_once 'db.php';


session_start();
//initialize variables

$lname = "";
$fname = "";
$dpi = "";
$ln = "";
$plate_no = "";
$dasi = "";
$dai = "";
$status = "";
$id = 0;
$edit_state = false;


$mysqli = mysqli_connect($host,$user,$pass,$db);





//update function

if (isset($_POST['update'])) {
    $id = $_POST['update'];


  $id = mysqli_real_escape_string($mysqli, $_POST['id']);
  $dpi = mysqli_real_escape_string($mysqli, $_POST['driver_profile_id']);
  $ln = mysqli_real_escape_string($mysqli, $_POST['license_no']);
  $dai = mysqli_real_escape_string($mysqli, $_POST['driver_accstat_id']);
  $dasi = mysqli_real_escape_string($mysqli, $_POST['driver_appstat_id']);








$sql = mysqli_query($mysqli, "UPDATE driver SET id='$id', driver_profile_id='$dpi', license_no='$ln',  driver_accstat_id='$dai', driver_appstat_id='$dasi' WHERE id=$id");

header ("Location: https://betacars-webportal.000webhostapp.com/Driver_List.php?update=success");


}
