<?php
## what this file does is to fetch all products in the products table
## which is used for autocomplete searchform
## integrated in (admin_home.php ln:615)

## Require connection file
require_once '../conn.php';

## SQL query to select product names
$sql = "SELECT product_name FROM products";
$result = $conn->query($sql);

$product_names = array();

if ($result->num_rows > 0) {
    ## Fetch product names
    while($row = $result->fetch_assoc()) {
        $product_names[] = $row["product_name"];
    }
}

## Close connection 
$conn->close();

## Return product names as JSON
echo json_encode($product_names);
?>
