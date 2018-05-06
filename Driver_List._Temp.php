<!DOCTYPE html>
<html>
<head>
<!--
  <link rel="stylesheet" href="css/42.css">
  <script src="js/42.js"></script>
  <link rel="stylesheet" href="css/43.css">
  <script src="js/43.js"></script>
    <link rel="stylesheet" href="css/44.css">
  <meta charset="utf-8" /> -->
  <link rel="stylesheet" href="assets/css/style3.css">
  <title>List of Drivers</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300">
</head>
</head>

<body>

<nav class="main-nav">
  <h1 class="logo">Administrators' Web Portal</h1>
  <div class="menu-trigger">
    <ul id="main-menu">
      <li><a href="adminhomepage.html" target="_self">Home</a></li>
      <li><a href="Driver_List.php" target="_self">Drivers</a></li>
      <li><a href="vechicle.php" target="_self">Vehicles</a></li>
      <li><a href="55.html" target="_self">Fares</a></li>
      <li><a href="57.html" target="_self">Map</a></li>
      <li><a href="58.html" target="_self">Trips</a></li>
      <!--<li><a href="">Blog</a></li>
      <li><a href="">Products</a></li>
      <li><a href="">Contact</a></li>-->
    </ul>
  </div>
</nav>

<div class="table-title">
<h3>List of Drivers</h3>
</div>
<table class="table-fill">
<thead>

<tr>
<th class="text-left">Name</th>

<th class="text-left">Action</th>

</tr>
</thead>



<tbody class="table-hover">

<?php

include 'assets/php/db.php';



$results = mysqli_query($mysqli, "SELECT * FROM driver_profile");

while ($row =  mysqli_fetch_array($results))


 { ?>

<tr>
<td class="text-left"><?php echo $row['first_name'] . " " . $row['last_name'] ; ?></a></td>

<td class="text-left"><a href="Driver_Info.php?view=<?php echo $row['id']; ?>" target="_self">View</a>&nbsp;&nbsp;&nbsp;<a href="Driver_Update.php?update=<?php echo $row['id']; ?>" target="_self">Update</a>&nbsp;&nbsp;&nbsp;
<a href="Driver_Delete.php?del=<?php echo $row['id']; ?>" target="_self">Delete</a>&nbsp;&nbsp;&nbsp;</td>
</tr>

<?php } ?>

</tr>
</tbody>
</table>
<br/>

 <div class="ButtonDiv44">
 <button class="Button44" type="button" onclick="window.location.href='Driver_Add.php'">Add Driver Data</button>
 </div>
 
