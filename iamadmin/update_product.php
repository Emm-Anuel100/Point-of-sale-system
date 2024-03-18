<?php
## what this file does is to get the values of each input fields
## and update the product price and tax values in the database
## also invoked in (admin_home.php ln:1010) 

## Require connection file
require_once '../conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    ## Escape and filter user inputs
    $productName = mysqli_real_escape_string($conn, filter_var($_POST['productName'], FILTER_DEFAULT));
    $salesPrice = mysqli_real_escape_string($conn, filter_var($_POST['salesPrice'], FILTER_DEFAULT));
    $tax = mysqli_real_escape_string($conn, filter_var($_POST['tax'], FILTER_DEFAULT));

    ## Update query
    $update_query = "UPDATE products SET sales_price = '$salesPrice', tax = '$tax' WHERE product_name = '$productName'";

    if (mysqli_query($conn, $update_query)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    ## Close connection
    mysqli_close($conn);
}
?>
