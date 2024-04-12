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


// $HOST = "localhost";
// $USERNAME = "id22025454_pos_userdb";
// $PASSWORD = "Pos12345@";
// $DB = "id22025454_pos_database";

// $conn = new mysqli("$HOST","$USERNAME","$PASSWORD","$DB");

// ## if error in connection
// if ($conn->connect_error) {
//    # code...
//    die ("CONNECTION ERROR:" .$conn->connect_error);
// }

?>