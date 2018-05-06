<?php
/* User login process, checks if user exists and password is correct */
// required headers
header("Access-Control-Allow-Origin: *");

include 'db.php';

// Escape email to protect against SQL injections
$mobile_no = $con->escape_string($_POST['mobile_no']);

$results = array();
$results_array["status"] = array();
$results_array["data"] = array();

// Get the ID from the driver table based on give mobile no.
$result = $con->query("SELECT a.id as driver_id FROM driver a, driver_profile b WHERE a.driver_profile_id = b.id AND b.mobile_no='$mobile_no'") or die($con->error);

if ( $result->num_rows > 0 ) {
    $user = $result->fetch_assoc();

    $driver_profile_id = $user['driver_id'];
    $result->free();

    // Get the trip and passenger details based on driver ID.
    $sql = "SELECT a.driver_id, a.source, a.destination, a.fare_amount, a.payment_mode, a.passenger_id,
            b.mobile_no, b.first_name, b.last_name, d.plate_no, d.make, d.series
            FROM trip a, passenger b, driver c, car d
            WHERE a.passenger_id = b.id
            AND a.driver_id = c.id
            AND c.car_id = d.id
            AND a.status = 'Booked'
            AND a.driver_id = '$driver_profile_id';";
    $result = $con->query($sql) or die($con->error);
    
    if ( $result->num_rows > 0 ) {
        $user = $result->fetch_assoc();

        $driver_id = $user['driver_id'];
        $passenger_id = $user['passenger_id'];
        $passenger_mobile = $user['mobile_no'];
        $passenger_fname = $user['first_name'];
        $passenger_lname = $user['last_name'];
        $origin = $user['source'];
        $destination = $user['destination'];
        $car = $user['make'] . " " . $user['series'];
        $plate_no = $user['plate_no'];
        $fare_amount = $user['fare_amount'];
        $payment_mode = $user['payment_mode'];

        $results = array (
            "return_code" => "0",
            "return_msg" => "Found a trip assignment."
        );
        array_push($results_array["status"], $results);

        $results = array (
            "driver_id" => $driver_id,
            "passenger_id" => $passenger_id,
            "passenger_mobile" => $passenger_mobile,
            "passenger_fname" => $passenger_fname,
            "passenger_lname" => $passenger_lname,
            "origin" => $origin,
            "destination" => $destination,
            "car" => $car,
            "plate_no" => $plate_no,
            "fare" => $fare_amount,
            "payment_mode" => $payment_mode,
        );
        $result->free();
        array_push($results_array["data"], $results);
    }

    // If no tripping details found.
    else {
        $results = array (
            "return_code" => "1",
            "return_msg" => "No current trip assignment."
        );
        array_push($results_array["status"], $results);
    }
}

else {
    $results = array (
        "return_code" => "2",
        "return_msg" => "Driver ID not found."
    );
    array_push($results_array["status"], $results);
}

// Make it JSON format.
print_r(json_encode($results_array));