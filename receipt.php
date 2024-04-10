<?php
## require connection file
require_once("./conn.php");
## start session
session_start();

## if cashier id, cashier name is not set or total amount is equal to Zero go back to cashier's login page
if (!isset($_SESSION['cashier_id']) || !isset($_SESSION['cashier_name']) || $_SESSION['total'] === 0) {
   ## Redirect to cashier's login page
   header("Location: ./cashier_login/cashier_login.php");
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Customer's Receipt - Dadral Stores</title>
   <!-- Link favIcon -->
   <link rel="shortcut icon" href="./images/shop_logo.png" type="image/x-icon">
</head>
<body>
   
<section class="wrapper">
   <h2 class="store-name">Dadral Stores</h2>

   <div class="address">plot 506 along karu jikwoyi express way Abuja. <br/>
     <?php date_default_timezone_set('Africa/Lagos'); ?>
     Tel: 08121669013. Date: <?= Date("d/m/Y H:i a") ?>
   </div> 

   <div class="trans-id">TRANS-ID: GR<?= @$_SESSION["trans_id"] ?></div> <br/>

   <div class="header">
      <div>QTY</div>
      <div>DESCRIPTION</div>
      <div>AMOUNT</div>
      <div>TOTAL</div>
   </div>

   <?php foreach (@$_SESSION['cart'] as $product_id => $product): ?>
   <div class="header items">
      <div><?= @$product['quantity']; ?></div>
      <div><?= @$product['name']; ?></div>
      <div>&#8358;<?= number_format(@$product['price']); ?></div>
      <div>&#8358;<?= number_format(@$product['price'] * @$product['quantity']); ?></div>
   </div>
   <?php endforeach; ?>

   <br/>
   <div class="sales-infor">
      <div><?= @$_SESSION["payment_mode"] ?>: &#8358;<?= number_format(@$_SESSION['total'], 2)?></div>
      <div>Change Element: &#8358;<?= number_format(@$_SESSION["change_element"], 2) ?></div>
      <div>Change Reminant: &#8358;<?= number_format(@$_SESSION["change_reminant"], 2) ?></div>
      <div>Cashier: <?= $_SESSION['cashier_name'] ?></div>
   </div>

   <p class="vat-inclusive">
      THANK YOU FOR YOUR PATRONAGE <br/>
      Grand Total Is VAT Inclusive <br/>
      No Returns, No Refunds
   </p>

   <div class="print_btn" onclick="print()"></div>
</section>


<!-- style for receipt starts here-->
<style type="text/css">  
      body {
         font-family: Arial, sans-serif;
        }

      section.wrapper {
         width: 280px; /* Adjusted width for thermal printers */
         margin: auto;
         text-align: center;
      }

      h2.store-name {
         font-size: 14px;
         margin-top: 10px;
         margin-bottom: 5px;
         text-transform: uppercase;
      }
      .address {
         font-size: 10px;
         line-height: 14px;
      }
      .trans-id {
         font-size: 10px;
         margin-top: 5px;
         margin-bottom: 5px;
      }
      .header, .items {
         display: flex;
         justify-content: space-between;
         border-bottom: 1px dashed #000;
         padding-bottom: 3px;
         margin-bottom: 3px;
         font-size: 10px;
      }
      .header div:nth-child(1) {
         width: 30px; /* Width for quantity column */
         text-align: left;
      }
      .header div:nth-child(2) {
         width: 140px; /* Width for description column */
         text-align: left;
      }
      .header div:nth-child(3), 
      .items div:nth-child(3),
       .items div:nth-child(4) {
         width: 50px; /* Width for amount and total columns */
         text-align: right;
      }

      div.sales-infor{
      text-align: left;
      position: relative;
      left: 10px;
      font-family: sans-serif;
     }
      div.sales-infor div{
         font-size: 10px !important;
         margin: 3px 0;
      }

      .vat-inclusive {
         font-size: 10px;
         margin-top: 20px;
         text-align: left;
         line-height: 14px;
      }
</style>
<!-- style for receipt ends here-->


<!--- script for receipt btn click --->
<script type="text/javascript">
   let print_btn = document.querySelector(".print_btn");

   window.addEventListener('DOMContentLoaded', (e) => {
      e.preventDefault();

      // Perform printing
      print_btn.click();

      // Redirect to cart page after printing or canceling
      window.addEventListener('afterprint', () => {
         // Redirect to cart page
         window.location.href = "./cart.php";
      });

      <?php   
       ## unset cart session
       unset($_SESSION['cart']);
      ?>
   });
</script>

</body>
</html>