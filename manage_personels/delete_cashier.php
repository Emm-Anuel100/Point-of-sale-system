<?php
## what this file does is to get the id of any selected cashier
## and delete the cashier accordingly

## require connection file
require_once '../conn.php';

## Check if distributor ID is provided in the URL
if (isset($_GET['cashierid'])) { 
    $CashierID  = $_GET['cashierid'];
    ## Perform deletion query
    $delete = mysqli_query($conn, "DELETE FROM `cashier_infor` WHERE `id` = '$CashierID'");
    if ($delete) {
        ## Redirect back to admin home page after successful deletion
        header("Location: ../iamadmin/admin_home.php");
        exit;
     } else {
        ## Handle deletion error
        echo "An error occurred while deleting the cashier." . $conn->error;
     }
    } else {
    ## Redirect back to admin home page if ID is not provided
    header("Location: ../iamadmin/admin_home.php");
    exit;
}
?>
