<?php

if (isset($_POST['submit'])) {


  include_once 'driver_db.php';


  //protecting from SQL injections
 $driver_profile_id = mysqli_real_escape_string($mysqli, $_POST['driver_profile_id']);
  $license_no = mysqli_real_escape_string($mysqli, $_POST['license_no']);
  $license_expiration = mysqli_real_escape_string($mysqli, $_POST['license_expiration']);
  $plate_no = mysqli_real_escape_string($mysqli, $_POST['plate_no']);
  $driver_appstat_id = mysqli_real_escape_string($mysqli, $_POST['driver_appstat_id']);
  $driver_accstat_id = mysqli_real_escape_string($mysqli, $_POST['driver_accstat_id']);


/*
      if (!preg_match("/^[a-zA-z]*$/", $lname) || !preg_match("/^[a-zA-z]*$/", $fname) || !preg_match("/^\d+$/", $mnumber) || !preg_match("/^\d+$/", $licnumber) || !preg_match("/^[a-zA-z]*$/", $status)) {
      header("Location: ../Driver_Add.php?submit=invalid");
      exit();


    } else {

       $sql = "SELECT * FROM driver WHERE license_no='$licnumber'";
       $result = mysqli_query($conn, $sql);
       $resultCheck = mysqli_num_rows($result);

       if ($resultCheck > 0) {
         header("Location: ../Driver_Add.php?submit=license_number_already_registered!");
         exit();

       } else {

       */

          // inserting driver data
         $sql = "INSERT INTO driver (driver_profile_id, license_no, license_expiration, plate_no, driver_appstat_id, driver_accstat_id)
   					VALUES ('$driver_profile_id', '$license_no', '$license_expiration', '$plate_no', '$driver_appstat_id', '$driver_accstat_id')";





         if (mysqli_query($mysqli, $sql)) {
          header("Location: ../Driver_Application.php");
          exit();

       } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);


       }

    }
