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

include 'assets/php/driver_db.php';

//get the id to be updated

if (isset ($_GET['update'])) {
    $id = $_GET['update'];
    $edit_state = true;

    $rec = mysqli_query($mysqli, "SELECT * FROM car WHERE id=$id");

    $rec1 = mysqli_query($mysqli, "SELECT * FROM driver_profile WHERE id=$id");

    $record = mysqli_fetch_array($rec);
    $record1 = mysqli_fetch_array($rec1);


    $id = $record1['id'];
    $lname = $record1['last_name'];
    $fname = $record1['first_name'];
    $plate_no= $record['plate_no'];
    $cr_no = $record['cr_no'];
    $mv_no = $record['mv_no'];
    $engine_no = $record['engine_no'];
    $make = $record['make'];
    $series = $record['series'];
    $body_type = $record['body_type'];
    $year_model = $record['year_model'];
    $car_type_id = $record['car_type_id'];
    $driver_profile_id = $record['driver_profile_id'];


}

 ?>

<div class="card">
		<h1 class="h151">Update <?php echo $fname . " " . $lname ?>'s Car Information</h1>

    <form class="driver_update" action="assets/php/driver_update_car.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
        <p style="color:#3498db;">Plate No.</p>
				<input type="text" name="plate_no" class="m-input" value="<?php echo $plate_no; ?>" required>
				<!--<label for="first">Field 1</label>-->
		</div>
    <div class="input-group">
        <p style="color:#3498db;">Car Registration No.</p>
				<input type="text" name="cr_no" class="m-input" value="<?php echo $cr_no; ?>" required>
				<!--<label for="first">Field 1</label>-->
		</div>
		<div class="input-group">
        <p style="color:#3498db;">Car MV no.</p>
				<input type="text" name="mv_no" class="m-input" value="<?php echo $mv_no; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
    <div class="input-group">
        <p style="color:#3498db;">Car Engine No.</p>
				<input type="text" name="engine_no" class="m-input" value="<?php echo $engine_no; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
    <div class="input-group">
        <p style="color:#3498db;">Car Make</p>
				<input type="text" name="make" class="m-input" value="<?php echo $make; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
    <div class="input-group">
        <p style="color:#3498db;">Car Series</p>
				<input type="text" name="series" class="m-input" value="<?php echo $series; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
    <div class="input-group">
        <p style="color:#3498db;">Car Body Type</p>
				<input type="text" name="body_type" class="m-input" value="<?php echo $body_type; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
    <div class="input-group">
        <p style="color:#3498db;">Car Year Model</p>
				<input type="text" name="year_model" class="m-input" value="<?php echo $year_model; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
    <div class="input-group">
        <p style="color:#3498db;">Car Type ID</p>
        <input type="text" name="car_type_id" class="m-input" value="<?php echo $car_type_id; ?>" required>
        <!--<label for="last">Field 2</label>-->
    </div>
    <div class="input-group">
        <p style="color:#3498db;">Driver Profile ID</p>
        <input type="text" name="driver_profile_id" class="m-input" value="<?php echo $driver_profile_id; ?>" required>
        <!--<label for="last">Field 2</label>-->
    </div>


		<!--<div class="input-group">
				<button class="btn">Submit</button>
		</div>-->
		<br/><br/>
</div>

<div class="ButtonDiv44">
<?php  if ($edit_state == false);  ?>
 <button class="Button44" type="submit" name="update" >Update Driver Car Information</button>
</div>




<!-- <div class="MessageDiv44">
<p id="embed4"></p></div> -->
<br/><br/>
