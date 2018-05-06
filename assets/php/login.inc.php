<?php

session_start();

if (isset($_POST['submit'])) {

   include 'driver_db.php';

   $admin_user = mysqli_real_escape_string($mysqli, $_POST['admin_user']);
   $password = mysqli_real_escape_string($mysqli, $_POST['password']);

   $sql = "SELECT * FROM administrator WHERE admin_user='$admin_user'";
   $result = mysqli_query($mysqli, $sql);
   $resultCheck = mysqli_num_rows($result);

   if (($admin_user != 'teambeta') || ($password != 'cmsc207')) {
     echo 'Invalid Admin Credentials';
     

   } else {
        header("Location:https://betacars-webportal.000webhostapp.com/dashboard.php");
        exit();

   }

 }
