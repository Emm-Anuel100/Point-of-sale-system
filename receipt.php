<?php
## require connection file
require_once("./conn.php");
## start session
session_start();

## if total amount is equal to Zero go back to index
if ($_SESSION['total'] === 0){
   header("Location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Customer's Receipt</title>
</head>
<body>
   
<section class="wrapper">
   <h2>Greecs supermarket</h2>

   <p class="address">plot 506 along karu jikwoyi express way<br/>
     Tel: 08121669013. Date: <?= Date("y/m/d h:i a") ?></p> 

   <p class="trans-id">TRANS-ID: GR<?= @$_SESSION["trans_id"] ?></p> <br/>

   <div class="header">
      <div>QTY</div>
      <div>DESCRIPTION</div>
      <div>AMOUNT</div>
   </div>
   <?php foreach (@$_SESSION['cart'] as $product_id => $product): ?>
   <div class="header items">
      <div><?= @$product['quantity']; ?></div>
      <div><?= @$product['name']; ?></div>
      <div>&#8358;<?= number_format(@$product['price']); ?></div>
   </div>
   <?php endforeach; ?>

   <br/>
   <div class="total">
      <p>Total: &#8358;<?= number_format(@$_SESSION['total'], 2)?></p>
      <p>Change Element: &#8358;<?= number_format(@$_SESSION["change_element"], 2) ?></p>
      <p>Payment mode: <?= @$_SESSION["payment_mode"] ?> </p>
   </div>

   <p class="vat-inclusive">
      THANK YOU FOR YOUR PATRONAGE <br/>
      Total is VAT inclusive.
   </p>

   <div class="print_btn" onclick="print()"></div>
</section>






<!-- intenal style -->
<style type="text/css">
body{
   width: 100%;
   overflow-x: hidden;
   transition: none;
}
section.wrapper{
   width: 20rem;
   text-align: center;
   justify-content: center;
}
h2{
   font-size: 20px;
   font-weight: 100;
   font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}
p.address{
   font-size: 13px;
   line-height: 21px;
}
.trans-id{
   font-size: 13px;
}
.header{
   display: flex;
   width: 100%;
   justify-content: space-between;
   padding: 6px 0;
   border-top: 1.1px dashed #000;
   border-bottom: 1.1px dashed #000;
}
.header div{
   font-size: 13px;
}
.items{
   border-top: none;
}
div.total{
   text-align: left;
   margin-left: 5.6rem;
}
div.total p{
   font-size: 14px;
}
.vat-inclusive{
   font-size: 13px;
   margin-top: 21px;
   text-align: left;
   margin-left: 2rem;
}
</style>


<script type="text/javascript">

   let print_btn = document.querySelector(".print_btn");

   window.addEventListener('DOMContentLoaded', (e)=>{
      e.preventDefault();

      print_btn.click();

      <?php   
       ## unset cart session
        unset($_SESSION['cart']);
      ?>
   });

</script>
</body>
</html>