<?php
## what this file does is to go through the products table 
## and then get product that are out of stock
## if it finds any it will be stored in the notifications table
## also invoked in (admin_home.php ln:516) 
## inplemented ajax for real time update

## require the connection file
require '../conn.php';


## invoke the get_product_stock function
get_product_stock();

## Function to get product stock
function get_product_stock() {
   global $conn;

   ## Select products with quantity less than or equal to 10
   $result = mysqli_query($conn, "SELECT * FROM products WHERE quantity <= 10");

   ## Check if there are rows returned
   $num_rows = mysqli_num_rows($result);
   if ($num_rows > 0) {
       ## Fetch each row
       while ($row = mysqli_fetch_array($result)) {
           ## Get product name
           $product_name = $row["product_name"];
           ## Set notification type
           $notification_on = "stock";
           ## Notification message
           $message = "out of stock";

           // Check if notification already exists for this product
           $existing_notification_query = "SELECT * FROM notifications WHERE product_name = ? AND notification_on = ?";
           $existing_stmt = $conn->prepare($existing_notification_query);
           $existing_stmt->bind_param("ss", $product_name, $notification_on);
           $existing_stmt->execute();
           $existing_result = $existing_stmt->get_result();
           if ($existing_result->num_rows == 0) {
               ## Insert product expiry info into the notifications table
               $insert_sql = "INSERT INTO `notifications` (product_name, notification_on, message) VALUES (?, ?, ?)";
               $insert_stmt = $conn->prepare($insert_sql);
               $insert_stmt->bind_param("sss", $product_name, $notification_on, $message);
               if ($insert_stmt->execute() !== true) {
                   ## Error message
                   echo "ERROR WHILE INSERTING PRODUCT STOCK INFO: " . $conn->error;
               }
               $insert_stmt->close();
           }
           $existing_stmt->close();
       }
   }
}

?>
