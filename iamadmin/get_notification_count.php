<?php
## this file is used to get the number of notifications
## in the notifications table
## also invoked in (admin_home.php ln:470) 
## inplemented ajax for real time update

## Require connection file
require_once '../conn.php';

## Fetch notification count from the database
$notification_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM notifications");
$row = mysqli_fetch_assoc($notification_result);
$count = $row['count'];

## Return the count as JSON
echo json_encode($count);
?>
