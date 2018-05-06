<?php

//$host = "https://betacars-webportal.000webhostapp.com";
//$host = "http://35.234.55.30";
$host = "localhost";

//$user = "id5274488_betacars";
$user = "root";
//$pass = "cmsc207upou";
//$pass = "fbQz2wkvhjQ9Gs";
$pass = "root";
$db = "id5274488_betacars_db";

// Create the DB connection.
$con = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

?>