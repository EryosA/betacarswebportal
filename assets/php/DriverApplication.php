<?php

if (isset($_POST['submit'])) {


  include_once 'driver_db.php';


  //protecting from SQL injections
  $application_status = mysqli_real_escape_string($mysqli, $_POST['application_status']);
  $description = mysqli_real_escape_string($mysqli, $_POST['description']);



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
         $sql = "INSERT INTO driver_application_status (application_status, description)
   					VALUES ('$application_status', '$description')";



         if (mysqli_query($mysqli, $sql)) {
          header("Location:https://betacars-webportal.000webhostapp.com/Driver_Status.php");
          exit();

       } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);


       }

    }
