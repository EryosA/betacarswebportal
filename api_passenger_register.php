<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
header("Access-Control-Allow-Origin: *");

include 'db.php';

// Escape all $_POST variables to protect against SQL injections
$mobile_no = $con->escape_string($_POST['mobile_no']);
$first_name = $con->escape_string($_POST['first_name']);
$last_name = $con->escape_string($_POST['last_name']);
$email_address = $con->escape_string($_POST['email_address']);
//$credit_card_no = $con->escape_string($_POST['credit_card_no']);
$password = $con->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $con->escape_string( md5( rand(0,1000) ) );

$results = array();
$results_array["status"] = array();
$results_array["data"] = array();

// Check if user with that email already exists
$result = $con->query("SELECT * FROM passenger WHERE mobile_no='$mobile_no'") or die($con->error);

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    $results = array (
        "return_code" => "1",
        "return_msg" => "User already exists."
    );
    array_push($results_array["status"], $results);
}

// Mobile for registration.
else {

    // Prepare the insert statement.
    //$sql = "INSERT INTO passenger (mobile_no, first_name, last_name, email_address, credit_card_no, password, hash) " 
            //. "VALUES ('$mobile_no', '$first_name', '$last_name', '$email_address', '$credit_card_no', '$password', '$hash')";
    $sql = "INSERT INTO passenger (mobile_no, first_name, last_name, email_address, password, hash) " 
            . "VALUES ('$mobile_no', '$first_name', '$last_name', '$email_address', '$password', '$hash')";        

    // Execute the prepared statement.
    if ( $con->query($sql) ) {

        // If previous insert statement is successful, query the DB for verification.
        $result = $con->query("SELECT * FROM passenger WHERE mobile_no='$mobile_no'") or die($con->error);
        if ( $result->num_rows > 0 ) {
            
            $results = array (
                "return_code" => "0",
                "return_msg" => "Success",
            );
            array_push($results_array["status"], $results);

            $user = $result->fetch_assoc();
            $results = array (
                "id" => $user['id'],
                "mobile_no" => $user['mobile_no'],
                "email" => $user['email_address'],
                "f_name" => $user['first_name'],
                "l_name" => $user['last_name'],
                "created_at" => $user['created_at'],
                "updated_at" => $user['updated_at']
            );
            array_push($results_array["data"], $results);
        }

        // DB query failed.
        else {
            $results = array (
                "return_code" => "2",
                "return_msg" => "Mobile no. does not exist."
            );
            array_push($results_array["status"], $results);
        }
    }

    // DB insert statement failed.
    else {
        $results = array (
            "return_code" => "3",
            "return_msg" => "Passenger registration failed."
        );
        array_push($results_array["status"], $results);
    }
}

// Make it JSON format.
print_r(json_encode($results_array));