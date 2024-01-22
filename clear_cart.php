<?php
## start session
session_start();
## require connection file
require_once("./conn.php"); 

## Check if total amount is not equal to 0,and if value is posted in input field
if ($_SESSION['total'] != 0 && isset($_POST["clear-cart"])) {
     ## initialize vars ...
     $product_infor = $_SESSION['product_infor'];
     $item_total = $_SESSION['total'];

     $trans_id = rand(10000000,99999999);
     ## session set for transaction id
     $_SESSION["trans_id"] = $trans_id;

     $payment_mode = $_POST["payment_mode"];
     ## session set for payment mode
     $_SESSION["payment_mode"] = $payment_mode;

     $change_element = $_POST["change_element"];
     ## session set for change element
     $_SESSION["change_element"] = $change_element;

     $year = DATE("y");
     $month = DATE("m");
     $day = DATE("d");
  
     ## insert cart values
     $sql = "INSERT INTO sales (product_infor,total,trans_id,change_element,payment_mode,year,month,day) 
     VALUES ('$product_infor','$item_total','$trans_id','$change_element','$payment_mode','$year','$month','$day')";
   
     ## check if values are inserted 
     if ($conn->query($sql) === true) {
      
        ## if success then redirect to index
        $redirect = "./receipt.php";
        header("Location: $redirect");

      //   ## unset cart session
      //   unset($_SESSION['cart']);
     }
     else{
        ## if error
        echo("An error occured: " . $conn->error);
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