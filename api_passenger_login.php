<?php
header('Access-Control-Allow-Origin: *');

include 'db.php';

// Escape email to protect against SQL injections
$mobile_no = $con->escape_string($_POST['mobile_no']);
$password = $con->escape_string($_POST['password']);

$results = array();
$results_array["status"] = array();
$results_array["data"] = array();

// Query the DB.
$result = $con->query("SELECT * FROM passenger WHERE mobile_no='$mobile_no'") or die($con->error);

// If mobile no. found on the DB.
if ( $result->num_rows > 0 ) {
    $user = $result->fetch_assoc();

    // Password passed the verification.
    if ( password_verify($_POST['password'], $user['password']) ) {

        $results = array (
            "return_code" => "0",
            "return_msg" => "Success",
        );
        array_push($results_array["status"], $results);

        $results = array (
            "id" => $user['id'],
            "mobile" => $user['mobile_no'],
            "email" => $user['email_address'],
            "f_name" => $user['first_name'],
            "l_name" => $user['last_name'],
            "created_at" => $user['created_at'],
            "updated_at" => $user['updated_at']
        );
        array_push($results_array["data"], $results);
    }

    // Password failed the verification.
    else {
        $results = array (
            "return_code" => "2",
            "return_msg" => "Incorrect password."
        );
        array_push($results_array["status"], $results);
    }
}

// If mobile no. not found.
else {
        $results = array (
            "return_code" => "1",
            "return_msg" => "Mobile no. does not exist."
        );
        array_push($results_array["status"], $results);
}

// Make it JSON format.
print_r(json_encode($results_array));
