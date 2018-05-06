<?php

include 'assets/php/db.php';

if(!isset($_SESSION)){
  session_start();
}

function getaddress($coord)
  {
     $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($coord).'&sensor=false';
     $json = @file_get_contents($url);
     $data=json_decode($json);
     $status = $data->status;
     if($status=="OK")
     {
       return $data->results[0]->formatted_address;
     }
     else
     {
       return false;
     }
  }

?>

<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" href="assets/css/42.css">
  <script src="includes/42.js"></script>
  <link rel="stylesheet" href="assets/css/43.css">
  <script src="includes/43.js"></script>
  <link rel="stylesheet" href="assets/css/44.css">
  <script src="includes/51_Delete.js"></script>
  <link rel="stylesheet" href="assets/css/51_Delete.css"> 
  
   <link rel="stylesheet" href="assets/css/style3.css">
  <meta charset="utf-8" />
  
  <title>Trip Details</title>
</head>

<body>

<nav class="main-nav">
  <h1 class="logo">Administrators' Web Portal</h1>
  <div class="menu-trigger">
    <ul id="main-menu">
      <li><a href="dashboard.php" target="_self">Home</a></li>
      <li><a href="Driver_List.php" target="_self">Drivers</a></li>
      <li><a href="vechicle.php" target="_self">Vehicles</a></li>
      <li><a href="55.html" target="_self">Fares</a></li>
      <li><a href="map.html" target="_self">Map</a></li>
      <li><a href="trip.php" target="_self">Trips</a></li>
      <li><a href="logout.php" target="_self">Logout</a></li>
      <!--<li><a href="">Blog</a></li>
      <li><a href="">Products</a></li>
      <li><a href="">Contact</a></li>-->
    </ul>
  </div>
</nav>
<div class="table-title">
<h3 class="h3_58">Trips</h3>
</div>
<table class="table-fill">
<thead>

<tr>
<th class="text-left">Trip Number</th>
<th class="text-left">Driver</th>
<th class="text-left">Fare Amount</th>
<th class="text-left">Payment Mode</th>
<th class="text-left">Status</th>
<th class="text-left">Origin</th>
<th class="text-left">Destination</th>

</tr>
</thead>
<tbody class="table-hover">
<?php 
//$result = $mysqli->query("SELECT * FROM trip");
$result = $mysqli->query("SELECT trip.driver_id, fare_amount, payment_mode, status, source, destination, driver_profile.id, driver_profile.first_name as first_name, driver_profile.last_name as last_name FROM trip INNER JOIN driver_profile ON trip.driver_id = driver_profile.id ");
$counter = 1;
		while($row = $result->fetch_assoc()) {
				?>
<tr>
<td class="text-left"><?php echo $counter; ?> </td>
<td class="text-left"><?php echo $row['first_name'] . " " . $row['last_name'] ; ?></td>
<td class="text-left"><?php echo $row['fare_amount']; ?></td>
<td class="text-left"><?php echo $row['payment_mode']; ?></td>
<td class="text-left"><?php echo $row['status']; ?></td>
<td class="text-left"><?php echo getaddress($row['source']); ?></td>
<td class="text-left"><?php echo getaddress($row['destination']); ?></td>
</tr>
<?php  $counter++; } 
				//} ?>
</tbody>
</table>
<br/><br/>

</body>
</html>
