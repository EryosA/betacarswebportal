<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="assets/css/42.css">
  <script src="js/42.js"></script>
  <link rel="stylesheet" href="assets/css/44.css">
  <!--<script src="includes/44.js"></script>-->
  <link rel="stylesheet" href="assets/css/50.css">
  <meta charset="utf-8" />
  <title>Edit Driver Data</title>
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
  <script src="js/47.js"></script>
    <!--<link rel="stylesheet" href="css/47.css">-->
  <link rel="stylesheet" href="assets/css/52.css">
  <script src="js/51_Edit.js"></script>
</head>

<body>



<nav class="main-nav">
  <h1 class="logo">Administrators' Web Portal</h1>
  <div class="menu-trigger">
    <ul id="main-menu">
      <li><a href="dashboard.php">Home</a></li>
      <li><a href="Driver_List.php">Drivers</a></li>
      <li><a href="vechicle.php">Vehicles</a></li>
      <li><a href="55.html">Fares</a></li>
      <li><a href="57.html">Map</a></li>
      <li><a href="trip.php">Trips</a></li>
      <!--<li><a href="">Blog</a></li>
      <li><a href="">Products</a></li>
      <li><a href="">Contact</a></li>-->
    </ul>
  </div>
</nav>
<br/>

<?php

include 'assets/php/db.php';

//get the id to be updated

if (isset ($_GET['update'])) {
    $id = $_GET['update'];
    $edit_state = true;
    $rec = mysqli_query($mysqli, "SELECT * FROM driver_status WHERE id=$id");

    $rec1 = mysqli_query($mysqli, "SELECT * FROM driver_profile WHERE id=$id");

    $record1 = mysqli_fetch_array($rec1);
    $record = mysqli_fetch_array($rec);



    $lat = $record['pos_lat'];
    $lng = $record['pos_lng'];
    $id = $record['id'];
    $lname = $record1['last_name'];
    $fname = $record1['first_name'];
}

 ?>

<div class="card">
	<h1 class="h151">Update <?php echo $fname . " " . $lname ?>'s Status & Position</h1>

    <form class="driver_update" action="assets/php/driver_update_pos.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
        <!--
        <p style="color:#3498db;">Driver Status</p>
				<input type="text" name="status" class="m-input" value="<?php echo $dristatus; ?>" required>
				<!--<label for="first">Field 1</label>
		</div>-->
		<div class="input-group">
        <p style="color:#3498db;">Latitude</p>
				<input type="text" name="pos_lat" class="m-input" value="<?php echo $lat; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
    <div class="input-group">
        <p style="color:#3498db;">Longhitude</p>
				<input type="text" name="pos_lng" class="m-input" value="<?php echo $lng; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>


		<!--<div class="input-group">
				<button class="btn">Submit</button>
		</div>-->
		<br/><br/>
</div>

<div class="ButtonDiv44">
<?php  if ($edit_state == false);  ?>
 <button class="Button44" type="submit" name="update" >Update Driver Application Status</button>
</div>




<!-- <div class="MessageDiv44">
<p id="embed4"></p></div> -->
<br/><br/>
