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

    ## Concatenate naira sign with the formatted product price
    $product_price_with_sign = "₦" . $product_price_format;

    ## Append product information to the array
    $product_info_array[] = "$product_name (Quantity: $product_quantity, Price: $product_price_with_sign)";
    
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

## Prepare the SQL statement with placeholders
$sql = "INSERT INTO sales (product_infor, total, trans_id, change_element, payment_mode, ip_address, year, month, day) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

## Prepare the statement
$stmt = $conn->prepare($sql);

## Bind parameters to the placeholders
$stmt->bind_param("siisssiii", $product_info, $item_total, $trans_id, $change_element, $payment_mode, $ip_address, $year, $month, $day);

## Execute the statement
if ($stmt->execute()) {
    ## if executed successfully Redirect to receipt page
    $redirect = "./receipt.php";
    header("Location: $redirect");
} else {
    ## Error executing query
    echo "An error occured while inserting cart info: " . $stmt->error;
}

## Close the statement
$stmt->close();
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