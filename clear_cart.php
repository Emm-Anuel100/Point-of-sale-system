<?php
## start session
session_start();
## require connection file
require_once("./conn.php"); 

## Check if total amount is not equal to 0,and if value is posted in input field
if ($_SESSION['total'] != 0 && isset($_POST["clear-cart"])) {
     # initialize vars ...
     $product_infor = $_SESSION['product_infor'];
     $item_total = $_SESSION['total'];
     $year = DATE("y");
     $month = DATE("m");
     $day = DATE("d");
  
     ## insert cart values
     $sql = "INSERT INTO sales (product_infor,total,year,month,day) 
     VALUES ('$product_infor','$item_total','$year','$month','$day')";
   
     ## check if values are inserted 
     if ($conn->query($sql) === true) {
        ## if success then redirect to index
        $redirect = "./index.php";
        header("Location: $redirect");
  
        ## unset cart session
        unset($_SESSION['cart']);
     }
     else{
      ## if error
        echo("An error occured: ");
     }
 } else {
   ?>
   <script type="text/javascript">
      alert("no product in cart yet!");
      window.location = "./index.php";
   </script>
   <?php
}
?>