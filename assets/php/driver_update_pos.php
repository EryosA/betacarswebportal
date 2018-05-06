<?php
/* Database connection settings */

include_once 'db.php';


session_start();
//initialize variables

$dristatus = "";
$lat = "";
$lng = "";
$id = 0;
$edit_state = false;


$mysqli = mysqli_connect($host,$user,$pass,$db);





//update function

if (isset($_POST['update'])) {
    $id = $_POST['update'];


  $id = mysqli_real_escape_string($mysqli, $_POST['id']);
  $lat = mysqli_real_escape_string($mysqli, $_POST['pos_lat']);
  $lng= mysqli_real_escape_string($mysqli, $_POST['pos_lng']);









$sql = mysqli_query($mysqli, "UPDATE driver_status SET id='$id', pos_lat='$lat', pos_lng='$lng' WHERE id=$id");

header ("Location: https://betacars-webportal.000webhostapp.com/Driver_List.php?update=success");


}
