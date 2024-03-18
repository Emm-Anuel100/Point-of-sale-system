<?php
## what this file does is to get the id of any selected distributor
## and delete the distributor accordingly

## require connection file
require_once '../conn.php';

## Check if distributor ID is provided in the URL
if (isset($_GET['id'])) { 
    $ID = $_GET['id'];
    ## Perform deletion query
    $delete = mysqli_query($conn, "DELETE FROM `distributors` WHERE `id` = '$ID'");
    if ($delete) {
        ## Redirect back to admin home page after successful deletion
        header("Location: ../iamadmin/admin_home.php");
        exit;
    } else {
        ## Handle deletion error
        echo "An error occurred while deleting the distributor." . $conn->error;
    }
   } else {
    ## Redirect back to admin home page if ID is not provided
    header("Location: ../iamadmin/admin_home.php");
    exit;
}
?>
