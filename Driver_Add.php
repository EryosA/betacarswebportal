<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="assets/css/42.css">
  <!--<script src="js/42.js"></script>-->
  <link rel="stylesheet" href="assets/css/44.css">
  <!--<script src="includes/44.js"></script>-->
  <link rel="stylesheet" href="assets/css/50.css">
  <meta charset="utf-8" />
  <title>Add Driver Info</title>
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
  <!--<script src="js/47.js"></script>-->
  <!--<link rel="stylesheet" href="css/47.css">-->
  <link rel="stylesheet" href="assets/css/52.css">
  <script src="js/42.js"></script>
</head>

<body>
  <nav class="main-nav">
    <h1 class="logo">Administrators' Web Portal</h1>
    <div class="menu-trigger">
      <ul id="main-menu">
        <li><a href="adminhomepage.html">Home</a></li>
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
  <div class="card">
    <h1 class="h151">Add Driver Information</h1>

    <form class="add_driver" action="assets/php/DriverAdd.php" method="POST">
      <div class="input-group">
        <input type="text" name="first_name" class="m-input" placeholder="First Name" required>
        <!--<label for="first">Field 1</label>-->
      </div>
      <div class="input-group">
        <input type="text" name="last_name" class="m-input" placeholder="Last Name" required>
        <!--<label for="last">Field 2</label>-->
      </div>
      <div class="input-group">
        <input type="email" name="email_address" class="m-input" placeholder="Email Address" required>
        <!--<label for="password">Field 3</label>-->
      </div>
      <div class="input-group">
        <input type="text" name="mobile_no" class="m-input" placeholder="Mobile No" required>
        <!--<label for="password">Field 4</label>-->
      </div>
      <div class="input-group">
        <input type="password" name="password" class="m-input" placeholder="Password" required>
        <!--<label for="password">Field 5</label>-->
      </div>
      


    <!--<div class="input-group">
				<button class="btn">Submit</button>
		</div>-->
    <br/><br/>
  </div>

  <div class="ButtonDiv44">
    <button class="Button44" type="submit" name="submit">Submit</button>
  </div>


  <!-- <div class="MessageDiv44">
<p id="embed4"></p></div> -->
  <br/><br/>

  </form>
