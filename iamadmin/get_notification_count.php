<?php
## this file is used to get the number of notifications
## in the notifications table
## also invoked in (admin_home.php ln:480) 
## inplemented ajax for real time update

## Require connection file
require_once '../conn.php';

## Calculate the timestamp for 4 days ago
$FourDaysAgo = date('Y-m-d H:i:s', strtotime('-4 day'));

## Fetch notification count from the database for notifications inserted within the last 4 days
$notification_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM notifications WHERE timestamp >= '$FourDaysAgo'");
$row = mysqli_fetch_assoc($notification_result);
$count = $row['count'];

## Return the count as JSON
echo json_encode($count);
?>
 