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
    $rec = mysqli_query($mysqli, "SELECT * FROM driver_application_status WHERE id=$id");

    $rec1 = mysqli_query($mysqli, "SELECT * FROM driver_profile WHERE id=$id");
    
    

    $record = mysqli_fetch_array($rec);
    $record1 = mysqli_fetch_array($rec1);
   

    $as = $record['application_status'];
    $des = $record['description'];
    $id = $record1['id'];
    $lname = $record1['last_name'];
    $fname = $record1['first_name'];
    

    

}

 ?>

<div class="card">
		<h1 class="h151">Update <?php echo $fname . " " . $lname ?>'s Application Status</h1>
		
    <form class="driver_update" action="assets/php/driver_update_app.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
        <p style="color:#3498db;">Application Status(Pending, Approved, Disapproved)</p>
				<input type="text" name="application_status" class="m-input" value="<?php echo $as; ?>" required>
				<!--<label for="first">Field 1</label>-->
		</div>
		<div class="input-group">
        <p style="color:#3498db;">Description</p>
				<input type="text" name="description" class="m-input" value="<?php echo $des; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
		<div class="input-group">
		<p style="color:#3498db;">Document Copies</p>
		<a href="https://betacars-webportal.000webhostapp.com/uploads/License_<?php echo $lname.$fname?>.jpg">Click here for the License Copy</a><br /> 
		<a href="https://betacars-webportal.000webhostapp.com/uploads/NBI_<?php echo $lname.$fname?>.jpg">Click here for the NBI Copy</a><br /> 
		<a href="https://betacars-webportal.000webhostapp.com/uploads/OR_<?php echo $lname.$fname?>.jpg">Click here for the OR Copy</a><br /> 
		<a href="https://betacars-webportal.000webhostapp.com/uploads/CR_<?php echo $lname.$fname?>.jpg">Click here for the CR Copy</a>
				
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
