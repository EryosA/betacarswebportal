<?php
/* User login process, checks if user exists and password is correct */
// required headers
header("Access-Control-Allow-Origin: *");

include 'db.php';

// Escape email to protect against SQL injections
$mobile_no = $con->escape_string($_POST['mobile_no']);
$status = $con->escape_string($_POST['status']);
$position = $con->escape_string($_POST['pos']);

$passenger_pos = explode(',',trim($position));
$passenger_lat = $passenger_pos[0];
$passenger_lng = $passenger_pos[1];
              
$results = array();
$results_array["status"] = array();
$results_array["data"] = array();

// Query the DB.
$result = $con->query("SELECT * FROM driver_profile WHERE mobile_no='$mobile_no' AND isVerified='1'") or die($con->error);

// If mobile no. found on the DB.
if ( $result->num_rows > 0 ) {
    $user = $result->fetch_assoc();

    $driver_profile_id = $user['id'];
    $result->free();

    // Get the corresponding IDs.
    $result = $con->query("SELECT a.id as id FROM driver a, driver_profile b WHERE a.driver_profile_id = b.id AND a.driver_profile_id='$driver_profile_id'") or die($con->error);

    if ( $result->num_rows > 0 ) {
        $user = $result->fetch_assoc();
        $driver_id = $user['id'];
        $result->free();

        // Query from the driver_status_type table.
        $result = $con->query("SELECT id FROM driver_status_type WHERE status='$status'") or die($con->error);
        if ( $result->num_rows > 0 ) {
            $user = $result->fetch_assoc();
            $driver_status_type_id = $user['id'];
            $result->free();

            $sql = "UPDATE driver_status SET driver_status_type_id='$driver_status_type_id', pos_lat='$passenger_lat', pos_lng='$passenger_lng' WHERE driver_id='$driver_id'";

            if ( $con->query($sql) ) {
                $results = array (
                    "return_code" => "0",
                    "return_msg" => "Status update successful."
                );
                array_push($results_array["status"], $results);
            }
            else {
                $results = array (
                "return_code" => "1",
                "return_msg" => "Status update failed."
                );
                array_push($results_array["status"], $results);
            }
        }
        // If no mapping found for driver_status and driver_status_type table.
        else {
            $results = array (
                "return_code" => "2",
                "return_msg" => "Invalid driver status type."
            );
            array_push($results_array["status"], $results);
        }
    }

    // If no mapping found for driver and driver_profile table.
    else {
        $results = array (
            "return_code" => "3",
            "return_msg" => "Driver data not found."
        );
        array_push($results_array["status"], $results);
    }
}

// If mobile no. not found.
else {
    $results = array (
        "return_code" => "4",
        "return_msg" => "Driver status ID not found."
    );
    array_push($results_array["status"], $results);
}

// Make it JSON format.
print_r(json_encode($results_array));