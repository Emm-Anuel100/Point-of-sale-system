<?php
## what this file does is to fetch all notifications data
## from the database
## also invoked in (admin_home.php ln:541) 
## implemented ajax for real time update on UI

## Require connection file
require '../conn.php';

## Calculate the timestamp for 4 days ago
$FourDaysAgo = date('Y-m-d H:i:s', strtotime('-4 day'));

## Fetch all notifications from the database within the last 4 days
$result_notifications = mysqli_query($conn, "SELECT * FROM `notifications` WHERE timestamp >= '$FourDaysAgo' ORDER BY `id` DESC");

## Check if there are any notifications
if (mysqli_num_rows($result_notifications) > 0) {
    $notifications = array();
    while ($row = mysqli_fetch_assoc($result_notifications)) {
        $notifications[] = $row;
    }
    ## Return notifications as JSON
    echo json_encode($notifications);
  } else {
    echo json_encode(array("message" => "You have no notifications yet."));
}
?>
