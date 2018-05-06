<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/53.css">
  <link rel="stylesheet" href="assets/css/42.css">
  <script src="js/42.js"></script>
  <link rel="stylesheet" href="assets/css/43.css">
  <script src="js/43.js"></script>
    <link rel="stylesheet" href="assets/css/44.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
  <meta charset="utf-8" />
  <title>Admin Dashboard Page</title>

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
<h3>Dashboard</h3>






<?php

include 'assets/php/driver_db.php';
$count_driver = mysqli_query($mysqli,"SELECT count(*) AS num FROM driver_profile");
$row_driver = mysqli_fetch_array($count_driver);

$count_pass = mysqli_query($mysqli,"SELECT count(*) AS num FROM passenger");
$row_pass = mysqli_fetch_array($count_pass);

$count_cars = mysqli_query($mysqli,"SELECT count(*) AS num FROM car");
$row_cars = mysqli_fetch_array($count_cars);

$count_trips = mysqli_query($mysqli,"SELECT count(*) AS num FROM trip");
$row_trips = mysqli_fetch_array($count_trips);
?>

<div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-id-card fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $row_driver['num']; ?></div>
                            <div class="label">Drivers</div>
                        </div>
                    </div>
                </div>
                <a href="Driver_List.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-circle fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $row_pass['num']; ?></div>
                            <div class="label">Passengers</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-orange">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-car fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $row_cars['num']; ?></div>
                            <div class="label">Cars</div>
                        </div>
                    </div>
                </div>
                <a href="vechicle.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-gray">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $row_trips['num']; ?></div>
                            <div class="label">Booked Trips</div>
                        </div>
                    </div>
                </div>
                <a href="trip.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div><br/>

<!-- Chart Top Drivers -->
<?php
	
//Get lists from db

$sql = mysqli_query($mysqli, "SELECT trip.driver_id, driver_profile.first_name as fname,
					driver_profile.last_name as lname, count(*) as trip_count
					FROM trip
					INNER JOIN driver_profile
					ON trip.driver_id = driver_profile.id
					GROUP BY driver_id
					ORDER BY count(*) DESC
					LIMIT 10");

$data = [
    'names' => [],
    'count' => [],
];

while($row = mysqli_fetch_array($sql)){
    $data['names'][]    =  $row['fname']." ".$row['lname'];
    $data['count'][]    = $row['trip_count'];
}

?>
</br>
<h4> Top 10 Driver based on number of trip</h4>

<div style="width:100%">
<canvas id="ChartDtrip" ></canvas>
</div>
    <!-- jQuery cdn -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    <!-- Chart.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    
</body>
</html><script>

      // chart DOM Element
      var ctx = document.getElementById("ChartDtrip");
      var data = {
        datasets: [{
          data: <?php echo json_encode($data['count']) ?>,
		  backgroundColor: 'transparent',
		  //backgroundColor: 'rgba(69, 92, 115, 0.5)',
		  //backgroundColor: 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 0.4)',
          //backgroundColor: "#455C73",
		  borderColor: "#336699",
		  borderWidth: 5,
          label: 'No. of trips' // for legend
        }],
        labels: 
          <?php echo json_encode($data['names']) ?>,
        
      };

      var xChart = new Chart(ctx, {
		 // The type of chart we want to create
        type: 'line',
		 // The data for our dataset
        data: data,
		 // Configuration options go here
		options: {
			 legend: {
				display: true,
				position: 'left',
				labels: {
					fontColor: 'black'
					//fontColor: 'rgb(255, 99, 132)'
				}
			  },
			  tooltips: {
				  mode: 'y'
			  },
		    scales: {
				yAxes: [{
				  ticks: {
					beginAtZero: true
				  }
				}],
				xAxes: [{
				  ticks: {
					autoskip: true,
					maxTicksLimit:6
				  }
				}]
			  }
			}
		  });
</script>

<?php
	
//Get lists from db

$sql = mysqli_query($mysqli, "SELECT trip.driver_id, driver_profile.first_name as fname,
					driver_profile.last_name as lname,sum(fare_amount) as income
					FROM trip
					INNER JOIN driver_profile
					ON trip.driver_id = driver_profile.id
					GROUP BY driver_id
					LIMIT 10");

$datarev = [
    'namesrev' => [],
    'revenues' => [],
];

while($row = mysqli_fetch_array($sql)){
    $datarev['namesrev'][]    =  $row['fname']." ".$row['lname'];
    $datarev['revenues'][]    = $row['income'];
}

?>
<p></p>
<p></p>
<h4> Top 10 Driver based on income</h4>
<div style="width:100%">
<canvas id="ChartDrev" ></canvas>
</div>
    <!-- jQuery cdn -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    <!-- Chart.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    
</body>
<script>

      // chart DOM Element
      var ctx = document.getElementById("ChartDrev");
      var data = {
        datasets: [{
          data: <?php echo json_encode($datarev['revenues']) ?>,
		  backgroundColor: 'transparent',
		  //backgroundColor: 'rgba(69, 92, 115, 0.5)',
		  //backgroundColor: 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 0.4)',
          //backgroundColor: "#455C73",
		  borderColor: "green",
		  borderWidth: 5,
          label: 'Income' // for legend
        }],
        labels: 
          <?php echo json_encode($datarev['namesrev']) ?>,
        
      };

      var xChart = new Chart(ctx, {
		 // The type of chart we want to create
        type: 'line',
		 // The data for our dataset
        data: data,
		 // Configuration options go here
		options: {
			 legend: {
				display: true,
				position: 'left',
				labels: {
					fontColor: 'black'
					//fontColor: 'rgb(255, 99, 132)'
				}
			  },
			  tooltips: {
				  mode: 'y'
			  },
		    scales: {
				yAxes: [{
				  ticks: {
					beginAtZero: true
				  }
				}],
				xAxes: [{
				  ticks: {
					autoskip: true,
					maxTicksLimit:6
				  }
				}]
			  }
			}
		  });
</script>





<!-- Chart Revenue-->
<?php
	
//Get lists from db

$sql = mysqli_query($mysqli, "SELECT DATE_FORMAT(trip_start,'%Y-%m') as trip_start1,  SUM(fare_amount) as income
FROM trip
WHERE trip_start IS NOT NULL
GROUP BY trip_start1
ORDER by trip_start1
LIMIT 12");

$data = [
    'amounts' => [],
    'dates' => [],
];

while($row = mysqli_fetch_array($sql)){
    $data['amounts'][]    = $row['income'];
    $data['dates'][]      =  date('M, Y', strtotime($row['trip_start1']));
}

?>


<h4> Monthly Revenue</h4>

<div style="width:100%">
<canvas id="Chart" ></canvas>
</div>
    <!-- jQuery cdn -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    <!-- Chart.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    
</body>
</html><script>

      // chart DOM Element
      var ctx = document.getElementById("Chart");
      var data = {
        datasets: [{
          data: <?php echo json_encode($data['amounts']) ?>,
		  backgroundColor: 'transparent',
		  //backgroundColor: 'rgba(69, 92, 115, 0.5)',
		  //backgroundColor: 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 0.4)',
          //backgroundColor: "#455C73",
		  borderColor: "#39a",
		  borderWidth: 5,
          label: 'Revenue' // for legend
        }],
        labels: 
          <?php echo json_encode($data['dates']) ?>,
        
      };

      var xChart = new Chart(ctx, {
		 // The type of chart we want to create
        type: 'line',
		 // The data for our dataset
        data: data,
		 // Configuration options go here
		options: {
			 legend: {
				display: true,
				position: 'left',
				labels: {
					fontColor: 'black'
					//fontColor: 'rgb(255, 99, 132)'
				}
			  },
			  tooltips: {
				  mode: 'y'
			  },
		    scales: {
				yAxes: [{
				  ticks: {
					beginAtZero: true
				  }
				}],
				xAxes: [{
				  ticks: {
					autoskip: true,
					maxTicksLimit:6
				  }
				}]
			  }
			}
		  });
</script>



<!-- Chart Trips-->
<?php
	
//initialize variables


//Get lists from db

$sql = mysqli_query($mysqli, "SELECT DATE_FORMAT(trip_start,'%Y-%m') as trip_start1,  count(id) as count_trip
FROM trip
WHERE trip_start IS NOT NULL
GROUP BY trip_start1
LIMIT 12");

$datatrip = [
    'num_trip' => [],
    'dates_trip' => [],
];

while($row = mysqli_fetch_array($sql)){
    $datatrip['num_trip'][]    =  $row['count_trip'];
    $datatrip['dates_trip'][]      =  date('M, Y', strtotime($row['trip_start1']));
}

?>

</br>
<h4> Monthly Booked Trip</h4>

<div style="width:100%">
<canvas id="ChartTrip" ></canvas>
</div>
    <!-- jQuery cdn -->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    <!-- Chart.js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    
</body>
</html><script>

      // chart DOM Element
      var ctx = document.getElementById("ChartTrip");
      var data = {
        datasets: [{
          data: <?php echo json_encode($datatrip['num_trip']) ?>,
		  backgroundColor: 'transparent',
		  //backgroundColor: 'rgba(69, 92, 115, 0.5)',
		  //backgroundColor: 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ', 0.4)',
          //backgroundColor: "#455C73",
		  borderColor: "red",
		  borderWidth: 5,
          label: 'Booked Trips' // for legend
        }],
        labels: 
          <?php echo json_encode($datatrip['dates_trip']) ?>,
        
      };

      var xChart = new Chart(ctx, {
		 // The type of chart we want to create
        type: 'line',
		 // The data for our dataset
        data: data,
		 // Configuration options go here
		options: {
			 legend: {
				display: true,
				position: 'left',
				labels: {
					fontColor: 'black'
					//fontColor: 'rgb(255, 99, 132)'
				}
			  },
			  tooltips: {
				  mode: 'y'
			  },
		    scales: {
				yAxes: [{
				  ticks: {
					beginAtZero: true
				  }
				}],
				xAxes: [{
				  ticks: {
					autoskip: true,
					maxTicksLimit:6
				  }
				}]
			  }
			}
		  });
</script>









































































	