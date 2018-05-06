<?php

include 'assets/php/db.php';

if(!isset($_SESSION)){
  session_start();
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
  
  <title>List of Vehicles</title>
</head>

<body>

<nav class="main-nav">
  <h1 class="logo">Administrators' Web Portal</h1>
  <div class="menu-trigger">
    <ul id="main-menu">
      <li><a href="dashboard.php">Dashboard</a></li>
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
<h3>List of Vehicles</h3>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Driver Name</th>
<th class="text-left">Model</th>
<th class="text-left">Plate No.</th>
<th class="text-left">Action</th>
</tr>
</thead>
<tbody class="table-hover">
<?php 
$result = $mysqli->query("SELECT make, plate_no, driver_profile.id, driver_profile.first_name, driver_profile.last_name FROM car INNER JOIN driver_profile ON car.driver_profile_id = driver_profile.id");

while($row = $result->fetch_assoc()) {
if($row > 0) {
?>
	<tr>
				<td class="text-left"><?php echo $row['first_name'] . " " . $row['last_name']; ?></a></td>
				<td class="text-left"><?php echo $row['make']; ?></a></td>
				<td class="text-left"><?php echo $row['plate_no']; ?></a></td>
			    <td class="text-left"><a href="Driver_Info.php?view=<?php echo $row['id']; ?>" target="_self">View</a>&nbsp;&nbsp;&nbsp;<a href="Driver_Update.php?update=<?php echo $row['id']; ?>" target="_self">Update</a>&nbsp;&nbsp;&nbsp;
				<a href="Driver_Delete.php?del=<?php echo $row['id']; ?>" target="_self">Delete</a>&nbsp;&nbsp;&nbsp;</td>
				</tr>

<?php 

}else { echo '<div> <h1> No record found </h1> <div>';}
} ?>

</tr>
</tbody>
</table>


<div class="ButtonDiv44">
	<a href="dashboard.php"><button class="Button44">Back to Dashboard</button></a>
</div>


<!-- <div class="MessageDiv44">
<p id="embed5"></p></div> -->

<br/>
</body>
</html>