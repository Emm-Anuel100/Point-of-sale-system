<?php
## what this file does is to go through the products table
## check for product that are equal to zero
## and delete them automatically
## also invoked in (admin_home.php ln:546) 
## inplemented ajax for real time actions

## Require database connection file
require_once '../conn.php';

## SQL query to select rows with quantity equal to zero
$sql_select = "SELECT * FROM products WHERE quantity = 0";

$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    ## SQL query to delete rows with quantity equal to zero
    $sql_delete = "DELETE FROM products WHERE quantity = 0";

    if ($conn->query($sql_delete) === FALSE) {
      echo "Error deleting rows: " . $conn->error;
    } 
   } else {
    echo "No rows found with quantity equal to zero";
}

## Close connection
$conn->close();
?>
