<?php

$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB = "pos";

$conn = new mysqli("$HOST","$USERNAME","$PASSWORD","$DB");

## if error in connection
if ($conn->connect_error) {
   # code...
   die ("CONNECTION ERROR:" .$conn->connect_error);
}

?>