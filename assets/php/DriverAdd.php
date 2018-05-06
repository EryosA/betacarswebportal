<?php



if (isset($_POST['submit'])) {


  include_once 'driver_db.php';


  //protecting from SQL injections
  $firstname = mysqli_real_escape_string($mysqli, $_POST['first_name']);
  $lastname = mysqli_real_escape_string($mysqli, $_POST['last_name']);
  $email = mysqli_real_escape_string($mysqli, $_POST['email_address']);
  $mobile = mysqli_real_escape_string($mysqli, $_POST['mobile_no']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

  $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
  $token = str_shuffle($token);
  $token = substr($token, 0, 10);




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
         $sql = "INSERT INTO driver_profile (mobile_no,email_address,first_name,last_name,password,hash,isVerified)
   					VALUES ('$mobile', '$email', '$firstname', '$lastname', '$hashedPassword', '$token', '0')";





         if (mysqli_query($mysqli, $sql)) {
          header("Location: https://betacars-webportal.000webhostapp.com/Driver_List.php");
          exit();

       } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);


       }

    }
