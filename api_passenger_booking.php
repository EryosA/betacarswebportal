<?php
header("Access-Control-Allow-Origin: *");

include 'db.php';

// Function to calculate distance between two points using Haversine Formula
// return value will be in meters.
function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
  // convert from degrees to radians
    $earthRadius = 6371000;
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
}

// Escape all $_POST variables to protect against SQL injections
$passenger_mobile = $con->escape_string($_POST['mobile']);
$passenger_origin = $con->escape_string($_POST['origin']);
$passenger_dest = $con->escape_string($_POST['destination']);
$distance = $con->escape_string($_POST['distance']);
$duration = $con->escape_string($_POST['duration']);
$fare = $con->escape_string($_POST['fare']);

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
    // Get passenger ID.
    $passenger = $result->fetch_assoc();
    $passenger_id = $passenger['id'];

    $result->free();

    // Query available drivers.
    $result = $con->query("SELECT c.id, b.pos_lat, b.pos_lng FROM driver_status_type a, driver_status b, driver c
        WHERE a.status = 'Available'
        AND a.id = b.driver_status_type_id
        AND c.id = b.driver_id") or die($con->error);

    if ( $result->num_rows > 0 ) {

        $driver_distance = array();
        // Get data from passenger's request.
        $passenger_pos = explode(',',trim($passenger_origin));
        $passenger_lat = $passenger_pos[0];
        $passenger_lng = $passenger_pos[1];

        // Calculate the distance of each driver and save to array variable.
        // This method is efficient for few drivers, but with thousands of drivers, this method is no longer the best solution.
        while ($driver = $result->fetch_assoc()) {
            $driver_lat = $driver['pos_lat'];
            $driver_lng = $driver['pos_lng'];
    
            $driver_id = $driver['id'];
            $passenger_driver_distance = haversineGreatCircleDistance($passenger_lat, $passenger_lng, $driver_lat, $driver_lng);
            $driver_distance = array (
                "$driver_id" => "$passenger_driver_distance"
            );
        }

        $result->free();
        
        foreach ($driver_distance as $id => $distance) {
            // If driver and passenger distance is below or equal to 3000 meters, push notify the driver.

            if ($distance <= 5000) {
                // TODO: Push notify the driver and wait for response. Put a 30 seconds timeout.

                // TODO: If driver accepts, query the driver details.
                // Query the details of the driver and car who accepted the booking.

                // For now, just make the API query and assign a driver automatically without the driver having to 
                // accept or refuse the booking trip.
                // Assign to the first driver found from the list.
                $sql = "SELECT a.id, b.mobile_no, b.first_name, b.last_name, c.plate_no, c.car_model
                        FROM driver a, driver_profile b, car c
                        WHERE a.driver_profile_id = b.id
                        AND a.car_id = c.id
                        AND a.id = '$id';";
                
                $result = $con->query($sql) or die($con->error);
                $driver_car_details = $result->fetch_assoc();
                // Capture the driver details.
                $driver_id = $driver_car_details['id'];
                $driver_mobile = $driver_car_details['mobile_no'];
                $driver_fname = $driver_car_details['first_name'];
                $driver_lname = $driver_car_details['last_name'];
                $driver_car = $driver_car_details['car_model'];
                $driver_plate = $driver_car_details['plate_no'];
                $status = "booked";

                $result->free();
                 
                // Insert the trip details to the database.
                $sql = "INSERT INTO trip (driver_id, passenger_id, source, destination, fare_amount, status, payment_mode) " 
                . "VALUES ('$driver_id', '$passenger_id', '$passenger_origin', '$passenger_dest', '$fare', '$status', 'cash');";
                
                // Execute the prepared statement.
                if ( $con->query($sql) ) {
                    // Get the 'Booked' status ID.
                    $result =  $con->query("SELECT id FROM driver_status_type WHERE status = 'Booked';")  or die($con->error);
                    $status_details = $result->fetch_assoc();
                    // Capture the driver_status ID.
                    $driver_status_type_id = $status_details['id'];
                    $result->free();
                    
                    // Update driver status on the DB.
                    $sql = "UPDATE driver_status SET driver_status_type_id = '$driver_status_type_id' WHERE driver_id = '$driver_id';";
                    
                    if ( $con->query($sql) ) {
                         $results = array (
                            "return_code" => "0",
                            "return_msg" => "Successful booking."
                        );
                        array_push($results_array["status"], $results);

                        $results = array (
                            "mobile_no" => $driver_mobile,
                            "f_name" => $driver_fname,
                            "l_name" => $driver_lname,
                            "car" => $driver_car,
                            "driver_plate" => $driver_plate
                        );
                        array_push($results_array["data"], $results);

                        break;
                    }
                    // Update driver status failed.
                    else {
                        $results = array (
                            "return_code" => "5",
                            "return_msg" => "DB update failed for the driver_status."
                        );
                        array_push($results_array["status"], $results);
                    }
                }
                // Insert trip details failed.
                else {
                    $results = array (
                    "return_code" => "4",
                    "return_msg" => "DB insert failed for the trip."
                    );
                    array_push($results_array["status"], $results);
                }
            }
            else {
                // Since no driver is availabe, just insert the trip details to the database with a status of 'Unassgined'.
                $sql = "INSERT INTO trip (passenger_id, source, destination, fare_amount, status, payment_mode) " 
                . "VALUES ('$passenger_id', '$passenger_origin', '$passenger_dest', '$fare', 'Unassigned', 'cash');";

                $con->query($sql) or die($con->error);
                
                $results = array (
                        "return_code" => "3",
                        "return_msg" => "No driver available within 3KM."
                );
                array_push($results_array["status"], $results);
            }

            // Assign to the nearest driver.
            break;
        }
    }
    else {
        $results = array (
            "return_code" => "2",
            "return_msg" => "No available drivers."
        );
        array_push($results_array["status"], $results);
    }
}

// Make it JSON format.
print_r(json_encode($results_array));