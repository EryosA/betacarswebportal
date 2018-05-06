<?php

if (isset($_POST['submit'])) {


  include_once 'driver_db.php';


  //protecting from SQL injections
  $status = mysqli_real_escape_string($mysqli, $_POST['status']);
  $pos_lat = mysqli_real_escape_string($mysqli, $_POST['pos_lat']);
  $pos_lng = mysqli_real_escape_string($mysqli, $_POST['pos_lng']);



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
         $sql = "INSERT INTO driver_status (status, pos_lat, pos_lng)
   					VALUES ('$status', '$pos_lat', '$pos_lng')";





         if (mysqli_query($mysqli, $sql)) {
          header("Location: https://betacars-webportal.000webhostapp.com/Driver_List.php?submit=success");
          exit();

       } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);


       }

    }
