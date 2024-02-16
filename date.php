<?php
## start session
session_start();
## get product expiry function
function get_product_expiry_date(){
require("./conn.php");

## Query to select products with quantity greater than 0
$result = mysqli_query($conn, "SELECT * FROM products WHERE quantity > 0");

## Check if there are rows returned
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    ## Fetch each row
    while ($row = mysqli_fetch_array($result)) {
        ## Get product ID
        $productId = $row["id"];

        ## SQL query to retrieve expiry date of the product
        $sql = "SELECT expiry_year, expiry_month, expiry_day FROM products WHERE id = ?"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->bind_result($expiryYear, $expiryMonth, $expiryDay);
        $stmt->fetch();
        $stmt->close();

        ## Get current date
        $currentYear = date('y');
        $currentMonth = date('m');
        $currentDay = date('d');

        ## Calculate remaining days until expiry
        $expiryDate = mktime(0, 0, 0, $expiryMonth, $expiryDay, $expiryYear);
        $currentDate = mktime(0, 0, 0, $currentMonth, $currentDay, $currentYear);
        $remainingDays = round(($expiryDate - $currentDate) / (60 * 60 * 24));

        ## Check if remaining days is less than or equal to 15
        if ($remainingDays <= 15) {
            ## Get product name
            $product_name = $row["product_name"];
            ## what the notification is all about
            $notification_on  = "expiry";
            ## Notification message
            $message = "15 days or less to expire";

            ## Check if the product exists in the expiry_notification table
            $query = "SELECT * FROM `notifications` WHERE `product_name` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $product_name);
            $stmt->execute();
            $stmt->store_result();
            $num_rows = $stmt->num_rows;
            $stmt->close();

            if ($num_rows > 0) {
                ## If product already exists in system as an expired product
                continue; ## Skip to the next iteration
                } else {
                ## Insert product expiry info into the expiry_notification table
                $sql = "INSERT INTO `notifications` (product_name, notification_on, message) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $product_name, $notification_on, $message);
                if ($stmt->execute() !== true) {
                    ## Error message
                    echo "ERROR WHILE INSERTING PRODUCT EXPIRY INFO: " . $conn->error;
                }
                $stmt->close();
            }
        }
    }
}
}
get_product_expiry_date();
?>
