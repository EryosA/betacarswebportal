<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="assets/css/42.css">
  <script src="js/42.js"></script>
  <link rel="stylesheet" href="assets/css/44.css">
  <script src="js/44.js"></script>
  <link rel="stylesheet" href="assets/css/50.css">
  <meta charset="utf-8" />
  <title>Driver's Information</title>
  <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
  <script src="js/47.js"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300">

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

<?php

include 'assets/php/driver_db.php';

// get driver data

if (isset ($_GET['view'])) {
  $id = $_GET['view'];

  /*
  $sql = mysqli_query($mysqli, "SELECT * FROM driver_profile WHERE id=$id");
  */
  $sql = mysqli_query($mysqli, "SELECT * FROM driver_profile WHERE id=$id");
  $sql1 = mysqli_query($mysqli, "SELECT * FROM driver WHERE id=$id");
  $sql2 = mysqli_query($mysqli, "SELECT * FROM driver_status WHERE id=$id");
  $sql3 = mysqli_query($mysqli, "SELECT * FROM driver_application_status WHERE id=$id");
  $sql4 = mysqli_query($mysqli, "SELECT * FROM car_type WHERE id=$id");
  $sql5 = mysqli_query($mysqli, "SELECT * FROM car WHERE id=$id");
  $sql6 = mysqli_query($mysqli, "SELECT * FROM driver_status_type WHERE id=$id");

  $result = mysqli_fetch_array($sql);
  $results = mysqli_fetch_array($sql1);
  $results1 = mysqli_fetch_array($sql2);
  $results2 = mysqli_fetch_array($sql3);
  $results3 = mysqli_fetch_array($sql4);
  $results4 = mysqli_fetch_array($sql5);
  $results5 = mysqli_fetch_array($sql6);

  $id = $result['id'];
  $lname = $result['last_name'];
  $fname = $result['first_name'];
  $mnumber = $result['mobile_no'];
  $createdat = $result['created_at'];
  $lnumber = $results['license_no'];
  $fromstatus= $results2['created_at'];
  $application_status= $results2['application_status'];
  $email = $result['email_address'];
  $pos_lat = $results1['pos_lat'];
  $pos_lng = $results1['pos_lng'];
  $desc = $results2['description'];
  $ctype = $results3['type'];
  $plate_no = $results4['plate_no'];
  $body_type= $results4['body_type'];
  $make= $results4['make'];
  $series= $results4['series'];
  $status= $results5['status'];






}



 ?>

<div class="table-title">
<h3>Driver's Information</h3>
</div>
<form class="driver_info" action="Driver_List.php" method="POST">

<div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Field</th>
<th class="text-left">Information</th>
</tr>
</thead>
<tbody class="table-hover">
  <tr>
  <td class="text-left">Last Name</td>
  <td class="text-left" name="last_name"><?php echo $lname; ?></td>
  </tr>
<tr>
<td class="text-left">First Name</td>
<td class="text-left" name="first_name"><?php echo $fname; ?></td>
</tr>
<tr>
<td class="text-left">Mobile Number</td>
<td class="text-left" name="mobile_no"><?php echo $mnumber; ?></td>
</tr>
<tr>
<td class="text-left">License No</td>
<td class="text-left" name="license_no"><?php echo $lnumber; ?></td>
</tr>
<tr>
<td class="text-left">Driver Status</td>
<td class="text-left" name="status"><?php echo $status; ?></td>
</tr>
<tr>
<td class="text-left">Email Address</td>
<td class="text-left" name="email_address"><?php echo $email; ?></td>
</tr>
<tr>
<td class="text-left">Latitude</td>
<td class="text-left" name="pos_lat"><?php echo $pos_lat; ?></td>
</tr>
<tr>
<td class="text-left">Longhitude</td>
<td class="text-left" name="pos_lng"><?php echo $pos_lng; ?></td>
</tr>
<tr>
<td class="text-left">Car Type</td>
<td class="text-left" name="body_type"><?php echo $body_type; ?></td>
</tr>
<td class="text-left">Plate No.</td>
<td class="text-left" name="plate_no"><?php echo $plate_no; ?></td>
</tr>
<td class="text-left">Car Make</td>
<td class="text-left" name="make"><?php echo $make; ?></td>
</tr>
<td class="text-left">Car Series</td>
<td class="text-left" name="series"><?php echo $series; ?></td>
</tr>
</tbody>
</table>



<!--
<div class="ButtonDiv44">
<button class="Button44" type="button" onclick="alert('')">Download Driver's Documents</button>
</div>
-->
<!--<div class="ButtonDiv44">
<button class="Button44" type="button" onclick="alert('')">Approve</button>
</div>

<div class="ButtonDiv44">
<button class="Button44" type="button" onclick="alert('')">Disapprove</button>
</div>

<div class="ButtonDiv44">
<button class="Button44" type="button" onclick="alert('')">Save Changes</button>
</div><!--
<!--
<br/><br/>
<div class="ButtonDiv44">
  <div class="DisappDiv44">Change status to:</div>
  <div class="DisappDiv44">
  	<select name="status">
	  <option value="app">Approve</option>
	  <option value="disapp">Disapprove</option>
	  <option value="deact">Deactivate</option>
	  <option value="susp">Suspend</option>
	</select>
	<button class="action" type="button" onclick="myFunction()">Submit</button>
</div>-->
    <!--<ul class="action">
      <li class="liChoices" onclick="myFunction()" id="app">Approve</li>
      <li class="liChoices" onclick="myFunction()" id="disapp">Disapprove</li>
      <li class="liChoices" onclick="myFunction()" id="deact">Deactivate</li>
      <li class="liChoices" onclick="myFunction()" id="susp">Suspended</li>
    </ul>-->
  </div>
</div>


<!--<p id="statp">Change status to:
<select name="status">
  <option value="disapp" class="popup">Disapproved</option>
  <option value="app">Approved</option>
  <option value="susp">Suspended</option>
</select>
</p>
<br/>

<span class="popuptext" id="myPopup">Popup text...</span>-->
<!--<div class="popup" onclick="myFunction()">Click me!
  <span class="popuptext" id="myPopup"><p id="remarks">Remark(s) <br/><textarea id="RemarksTextArea" rows="4"></span>

<p id="remarks">Remark(s) <br/><textarea id="RemarksTextArea" rows="4"></textarea></p>-->
<div class="MessageDiv44">
<p id="embed"></p></div>

<!-- <div class="ButtonDiv44">
<button class="Button44" type="button" onclick="myFunction2()">Save Changes</button>
</div> -->

<!-- <div class="MessageDiv44">
<p id="embed2"></p></div> -->

<br/><br/>
<h2 id="HistoryH2">Status History</h2>
<div class="HistoryDiv44">
	<div class="container">
	  <div class="row">
	    <div class="col-xs-12">
	      <div class="table-responsive">
	        <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-bordered table-hover">
	          <!--<caption class="shtext-center">An example of a responsive table based on <a href="https://getbootstrap.com/css/#tables-responsive" target="_blank">Bootstrap</a>:</caption>-->
	          <thead>
	            <tr>
	              <th>Date and Time</th>
	              <th>From Status</th>
	              <th>To Status</th>
	              <th>Reason for New Status</th>
	              <th>Administrator</th>
	            </tr>
	          </thead>
	          <tbody>
	            <tr>
	              <td name="created_at"><?php echo $createdat;   ?></td>
	              <td name="application_status"><?php echo $application_status;   ?></td>
	              <td></td>
	              <td name="description"><?php echo $desc;?></td>
	              <td><?php echo "SuperUser" ?></td>
	            </tr>
	          </tbody>
	          <tfoot>
	            <!--<tr>
	              <td colspan="5" class="shtext-center">Data retrieved from <a href="http://www.infoplease.com/ipa/A0855611.html" target="_blank">infoplease</a> and <a href="http://www.worldometers.info/world-population/population-by-country/" target="_blank">worldometers</a>.</td>
	            </tr>-->
	          </tfoot>
	        </table>
	      </div><!--end of .table-responsive-->
	    </div>
	  </div>
	</div>
</div>



<div class="ButtonDiv44">
	<a href="Driver_List.php"><button class="Button44">Back</button></a>
</div>

<!-- <p class="p">Demo by George Martsoukos. <a href="http://www.sitepoint.com/responsive-data-tables-comprehensive-list-solutions" target="_blank">See article</a>.</p> -->
<br/>
</body>
</html>
