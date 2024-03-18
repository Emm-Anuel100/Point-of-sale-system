<?php
## start session
session_start();
## unset individual cashier session
unset($_SESSION['cashier_name']);
unset($_SESSION['cashier_id']);

## redirect back to cashier login page
header("Location: ../cashier_login/cashier_login.php");
?>