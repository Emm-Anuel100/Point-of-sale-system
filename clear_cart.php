<?php
## Start session
session_start();

## Require connection file
require_once("./conn.php");

## Check if total amount is not equal to 0, and if value is posted in input field
if ($_SESSION['total'] != 0 && isset($_POST["clear-cart"])) {
    ## Initialize vars for cart informations ...
    $item_total = $_SESSION['total'];

    $trans_id = rand(10000000,99999999);
    ## session set for transaction id
    $_SESSION["trans_id"] = $trans_id;

    $payment_mode = $_POST["payment_mode"];
    ## session set for payment mode
    $_SESSION["payment_mode"] = $payment_mode;

    $change_element = $_POST["change_element"];
    ## session set for change element
    $_SESSION["change_element"] = $change_element;

    ## fetch computer's ip Address posted
    @$ip_address = $_POST["ip_address"];
    $year = Date("y");
    $month = Date("m");
    $day = Date("d");

    ## Initialize an empty array to store product information
    $product_info_array = array();

    ## Iterate through each product in the cart
    foreach ($_SESSION['cart'] as $product_id => $product) {
    ## Extract product details
    $product_name = $product['name'];
    $product_price = $product['price'];
    $product_quantity = $product['quantity'];

    ## change product price to number format
    $product_price_format = number_format($product_price);

    ## Append product information to the array
    $product_info_array[] = "$product_name (Quantity: $product_quantity, Price: $product_price_format)";

    
    ## Update the product quantity in the database
    $sql_update = "UPDATE products SET quantity = quantity - $product_quantity WHERE id = $product_id";
    if ($conn->query($sql_update) !== true) {
        ## If error while updating product quantity
        echo("An error occurred while updating product quantity: " . $conn->error);
        exit; ## Exit the script if an error occurs
    }
}

## Concatenate product information with commas
$product_info = implode(', ', $product_info_array);

## Insert cart values into the sales table
$sql = "INSERT INTO sales (product_infor,total,trans_id,change_element,payment_mode,ip_address) 
VALUES ('$product_info','$item_total','$trans_id','$change_element','$payment_mode','$ip_address')";

## Check if values are inserted successfully
if ($conn->query($sql) !== true) {
    ## If error while inserting values
    echo("An error occurred while inserting cart values: " . $conn->error);
    exit; ## Exit the script if an error occurs
}

    ## Redirect to receipt page
    $redirect = "./receipt.php";
    header("Location: $redirect");
    } else {
    ## If no product is in cart
    ?>
    <script type="text/javascript">
        alert("No product in cart yet!");
        window.location = "./index.php";
    </script>
    <?php
}
?>
