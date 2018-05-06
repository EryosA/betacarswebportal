<?php

header("Access-Control-Allow-Origin: *");

include 'db.php';

// Escape all $_POST variables to protect against SQL injections
$passenger_mobile = $con->escape_string($_POST['mobile']);
$car_type = $con->escape_string($_POST['car_type']);
$minutes = $con->escape_string($_POST['minutes']);

$results = array();
$results_array["status"] = array();
$results_array["data"] = array();

// Check if user with that mobile exists.
$result = $con->query("SELECT * FROM passenger WHERE mobile_no='$passenger_mobile'") or die($con->error);

// If user does not exist in the database.
if ( $result->num_rows <= 0 ) {
    $results = array (
        "return_code" => "1",
        "return_msg" => "User does not exist."
    );
    array_push($results_array["status"], $results);
}

// Otherwise, proceed to process the booking request.
else {
    $result->free();

    // Query available drivers.
    $result = $con->query("SELECT a.*, b.type
        FROM fare_matrix a, car_type b
        WHERE a.car_type_id = b.id
        AND b.type = '$car_type'
        AND min_start <= '$minutes'
        AND min_end >= '$minutes';") or die($con->error);

    if ( $result->num_rows > 0 ) {

        $fare_matrix = $result->fetch_assoc();

        // Capture the fare matrix details.
        $base_fare = $fare_matrix['base_fare'];
        $surge = $fare_matrix['surge'];
        $distance_rate = $fare_matrix['distant_rate'];
        $min_start = $fare_matrix['min_start'];
        $min_end = $fare_matrix['min_end'];

        $results = array (
            "return_code" => "0",
            "return_msg" => "Fare matrix data found."
        );
        array_push($results_array["status"], $results);

        $results = array (
            "base_fare" => $base_fare,
            "surge" => $surge,
            "distance_rate" => $distance_rate,
            "min_start" => $min_start,
            "min_end" => $min_end
        );
        array_push($results_array["data"], $results);
    }
    else {
        $results = array (
            "return_code" => "2",
            "return_msg" => "No fare matrix data found."
        );
        array_push($results_array["status"], $results);
    }
}

// Make it JSON format.
print_r(json_encode($results_array));