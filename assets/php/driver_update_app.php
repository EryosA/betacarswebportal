<?php
/* Database connection settings */

include_once 'db.php';


session_start();
//initialize variables

$as = "";
$des = "";
$id = 0;
$edit_state = false;


$mysqli = mysqli_connect($host,$user,$pass,$db);





//update function

if (isset($_POST['update'])) {
    $id = $_POST['update'];


  $id = mysqli_real_escape_string($mysqli, $_POST['id']);
  $as = mysqli_real_escape_string($mysqli, $_POST['application_status']);
  $des = mysqli_real_escape_string($mysqli, $_POST['description']);









$sql = mysqli_query($mysqli, "UPDATE driver_application_status SET id='$id', application_status='$as', description='$des' WHERE id=$id");

header ("Location: https://betacars-webportal.000webhostapp.com/Driver_List.php?update=success");

if (mysqli_query($mysqli, $sql)) {
          header("Location: https://betacars-webportal.000webhostapp.com/Driver_List.php");
          exit();

       } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);


       }

}
