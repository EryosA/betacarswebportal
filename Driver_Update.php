

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
    $rec = mysqli_query($mysqli, "SELECT * FROM driver_profile WHERE id=$id");



    $record = mysqli_fetch_array($rec);


    $id = $record['id'];
    $lname = $record['last_name'];
    $fname = $record['first_name'];
    $mnumber = $record['mobile_no'];
    $email= $record['email_address'];
    $password= $record['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);





}

 ?>

<div class="card">
		<h1 class="h151">Update <?php echo $fname . " " . $lname ?>'s Information</h1>

    <form class="driver_update" action="assets/php/driver_db.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
        <p style="color:#3498db;">Last Name</p>
				<input type="text" name="last_name" class="m-input" value="<?php echo $lname; ?>" required>
				<!--<label for="first">Field 1</label>-->
		</div>
		<div class="input-group">
        <p style="color:#3498db;">First Name</p>
				<input type="text" name="first_name" class="m-input" value="<?php echo $fname; ?>" required>
				<!--<label for="last">Field 2</label>-->
		</div>
		<div class="input-group">
        <p style="color:#3498db;">Mobile No.</p>
				<input type="text" name="mobile_no" class="m-input" value="<?php echo $mnumber; ?>" required>
				<!--<label for="password">Field 3</label>-->

		</div>
				<div class="input-group">
        <p style="color:#3498db;">Email Address</p>
				<input type="text" name="email_address" class="m-input" value="<?php echo $email; ?>" required>
				<!--<label for="password">Field 4</label>-->
		</div>
				<div class="input-group">
        <p style="color:#3498db;">Password</p>
				<input type="password" name="password" class="m-input" value="<?php echo "Enter New Password"?>" required>
				<!--<label for="password">Field 5</label>-->
		</div>

		<!--<div class="input-group">
				<button class="btn">Submit</button>
		</div>-->
		<br/><br/>
</div>

<div class="ButtonDiv44">
<?php  if ($edit_state == false);  ?>
 <button class="Button44" type="submit" name="update" >Update Driver Info</button>
</div>

<


<!-- <div class="MessageDiv44">
<p id="embed4"></p></div> -->
<br/><br/>
