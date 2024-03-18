<?php

function product_stock(){
   
## make $conn variable global
global $conn;

## Calculate the timestamp for 4 days ago
$FourDaysAgo = date('Y-m-d H:i:s', strtotime('-4 day'));

## Fetch notification count from the database for notifications inserted within the last 4 days
$notification_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM notifications WHERE timestamp >= '$FourDaysAgo' AND notification_on = 'stock'");
$row = mysqli_fetch_assoc($notification_result);
$count = $row['count'];

## echo count variable
echo ($count);
}
?>
 