<?php
// Require connection file
require '../conn.php';

// Fetch all notifications from the database that have a message of expiry
$result_notifications_expiry = mysqli_query($conn, "SELECT * FROM `notifications` ORDER BY `id` DESC");

// Check if there are any notifications
if (mysqli_num_rows($result_notifications_expiry) > 0) {
    $notifications = array();
    while ($row = mysqli_fetch_assoc($result_notifications_expiry)) {
        $notifications[] = $row;
    }
    // Return notifications as JSON
    echo json_encode($notifications);
} else {
    echo json_encode(array("message" => "You have no notifications yet."));
}
?>
