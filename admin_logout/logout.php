<?php
## start session
session_start();
## unset admin session
unset($_SESSION['admin_username']);

## redirect back to admin login page
header("Location: ../iamadmin/");
?>