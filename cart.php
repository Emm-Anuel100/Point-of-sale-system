<?php
## start session
session_start();
## require connection file
require_once "./conn.php"; 

## Check if the cart exists in the session, create it if not
if (!isset($_SESSION['cart'])) {
   $_SESSION['cart'] = array();
}

## Check if cashier session variables are not set
if (!isset($_SESSION['cashier_id']) || !isset($_SESSION['cashier_name'])) {
   ## Redirect to cashier error page
   header("Location: ./error_pages/cashier_error.htm");
   exit();
}

## Calculate the total amount of products in cart
$total = 0; 
foreach ($_SESSION['cart'] as $product) {
   @$total += $product['price'] * $product['quantity'];
} 
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="css/style.css" rel="stylesheet">
      <!-- title -->
      <title>Cart - Dadral Stores</title>
      <!-- fav icon -->
      <link rel="shortcut icon" href="./images/shop_logo.png" type="image/x-icon">
      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" integrity="sha512-8RxmFOVaKQe/xtg6lbscU9DU0IRhURWEuiI0tXevv+lXbAHfkpamD4VKFQRto9WgfOJDwOZ74c/s9Yesv3VvIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- style link -->
      <link rel="stylesheet" href="./styles/dist/cart.css">
   </head>
   <body>
   
      <section class="main-content">
         <!-- page header section starts here -->
         <header class="page-header">
            <div class="img-wrapper">
              <a href="./index.php">
                <img src="./images/shop_logo.png" alt="logo">
              </a>
            </div>

            <div class="cashier_name">
             Cashier: <?= $_SESSION['cashier_name'] ?> <i class="fas fa-caret-down"></i>

             <a href="./cashier_logout/logout.php" class="cashier_logout">log out</a>
            </div>
         </header> <br/>
         <!-- page header section ends here -->
       
        <section class="cart-section">
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="barcode_form">
            <fieldset>
              <input type="text" name="bar_code" class="bar_code" id="bar_code" required="" autocomplete="off" placeholder="Barcode here ...">
             </fieldset> <br/>
             <fieldset>
              <input type="number" name="quantity" id="quantity" id="quantity" required="" min="1" placeholder="Quantity ...">
             </fieldset>
           </form>
             <br/><br/>
             <samp class="title">
               Shopping cart.
             </samp>
          <br/><br/><br/>

         <section class="cart-detail">
         <?php foreach ($_SESSION['cart'] as $product_id => $product): ?>
            <div class="cart-wrapper">
               <samp class="product product-name">
               <?= @$product['name']; ?>
               </samp>
               <samp class="product product-price">
                  &#8358;<?= @number_format($product['price']); ?> <span>+ VAT</span>
               </samp>
               <samp class="product">
                 x <?= @$product['quantity']; ?>
               </samp>
             </div>
             <br/>
           <?php endforeach; ?>
           <br/>

           <!-- total sum of cart items -->  
            <samp class="title">
              Total: &#8358;<?= number_format($total, 2) ?> 
              <?php @$_SESSION['total'] = $total ?>
            </samp>
            <br/><br/><br/>

            <!-- form to add more details of product -->
            <form action="./clear_cart.php" method="post">
               <input type="number" name="change_element" placeholder="Change element given (&#8358;) ...." min="0" required autocomplete="off" step="1">
                <br/><br/>
                <input type="number" name="change_reminant" placeholder="Change reminant (&#8358;) ...." min="0" required autocomplete="off" step="1">
                <br/><br/>
                <span class="payment-label">Cash:</span> 
                <input type="radio" name="payment_mode" value="cash">

                <span class="payment-label">Transfer:</span> 
                <input type="radio" name="payment_mode" value="transfer"> 
                <br/><br/>
                <span class="payment-label">Debit card:</span> 
                <input type="radio" name="payment_mode" value="Debit card">

                <span class="payment-label">Credit card:</span> 
                <input type="radio" name="payment_mode" value="Credit card">

               <input type="hidden" name="ip_address" class="ip_address">
               <input type="hidden" name="clear-cart" value="clear-cart">
               <br/><br/><br/>
               <button type="submit" class="clear-cart">
                  <i class="fas fa-print"></i><span>PRINT</span>
               </button>
            </form><br/>

            <br/><br/><br/>
            <!-- page footer starts here -->
            <footer class="footer">
             Blue Ocean Stores <span>&copy;2012 - <?= Date('Y'); ?>.</span>
            </footer>
            <!-- page footer ends here -->
            <br/><br/><br/>
         </section>
        </section>
      </section>
      <img src="./images/claymorphic.png" alt="img" class="claymorphic" style="position: fixed; top: 36vh; left: 75%; height: 25rem; opacity: 20%">
   </body>

   <!-- external script source -->
   <script src="./script/cart.js"></script>
   <!-- embeded script -->
   <script type="text/javascript">
       // Function to fetch IP address using an external service
       function getIPAddress() {
       fetch('https://api.ipify.org?format=json')
       .then(response => response.json())
       .then(data => {
        const ipAddress = data.ip;
        document.querySelector(".ip_address").value = ipAddress;
      
        })
       .catch(error => {
       console.error('Error fetching IP address: ' + error);
      //  alert('Error fetching IP address ' + error);
      });
     }

    // Call the function to fetch IP address when the page loads
     document.addEventListener('DOMContentLoaded', getIPAddress);

   </script>
   <noscript>Pls. enable javascript in your browser</noscript>
</html>


<?php
  ## code to get product from the database base on the barcode inputed
  ## check if value is posted, also check the request method
  if (isset($_POST['bar_code']) && isset($_POST['quantity']) && $_SERVER["REQUEST_METHOD"] === "POST") {
   $bar_code = $conn->real_escape_string($_POST['bar_code']);
   $quantity = intval($_POST['quantity']); ## Ensure quantity is an integer

   $sql = "SELECT * FROM products WHERE bar_code = '$bar_code' LIMIT 1";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
       $product_id = $row['id'];
       $product_name = $row['product_name'];
       $product_price = $row['sales_price'] + $row['tax'];


       if (isset($_SESSION['cart'][$product_id])) { 
           $_SESSION['cart'][$product_id]['quantity'] += $quantity;
           $_SESSION['cart'][$product_id]['price'] = $product_price; 
       } else {
           $_SESSION['cart'][$product_id] = array(
               'name' => $product_name,
               'price' => $product_price,
               'quantity' => $quantity,
           );
       }
       ## Recalculate total
       $total = 0; 
       foreach ($_SESSION['cart'] as $product) {
           $total += $product['price'] * $product['quantity'];
       } 

       echo'
       <script>window.location = "./cart.php"</script>
       ';
       exit();
   } else {
       echo '<script>alert("Barcode mismatch!");</script>';
   }
}
//   unset($_SESSION['cart']);
?>