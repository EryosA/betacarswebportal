<?php
/* User login process, checks if user exists and password is correct */
//required headers
header("Access-Control-Allow-Origin: *");

include 'db.php';

 //Escape email to protect against SQL injections
$trip_id = $con->escape_string($_POST['trip_id']);
 
 
 
 
$results = array();
$results_array["status"] = array(); 
 
 
// $results = array (
              // "return_code" => "0",
              // "return_msg" => "success"
          // );
// array_push($results_array["status"], $results);
	   
  

   //  query the db.
    $result = $con->query("select * from trip  where id='$trip_id'") or die($con->error);
   
    if ( $result->num_rows > 0 ) {

         // prepare the update statement.
        $sql = "update trip set status = 'cancelled' where id= $trip_id"	 ;
   
        //  execute the prepared statement.
        if ( $con->query($sql) ) {
		   $results = array (
               "return_code" => "0",
               "return_msg" => "success",
           );
		   array_push($results_array["status"], $results);
	    }
    }

   //  if trip not found.
    else {
            $results = array (
                "return_code" => "1",
                "return_msg" => "trip does not exist."
            );
            array_push($results_array["status"], $results);
    }

//Make it JSON format.
print_r(json_encode($results_array));
