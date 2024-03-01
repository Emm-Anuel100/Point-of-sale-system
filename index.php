<?php
## start session
session_start();
## require connection file
require_once("./conn.php"); 

## Check if the cart exists in the session, create it if not
if (!isset($_SESSION['cart'])) {
   $_SESSION['cart'] = array();
}

## Calculate the total amount
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
      <title>shopping cart</title>
      <!-- fav icon -->
      <link rel="shortcut icon" href="./images/shop_logo.png" type="image/x-icon">
      <!-- style link -->
      <link rel="stylesheet" href="./styles/dist/cart.css">
   </head>
   <body>
   
      <main class="main-content">
         <!-- page header section starts here -->
         <header class="page-header">
            <div class="img-wrapper">
              <a href="#">
                <img src="./images/shop_logo.png" alt="logo">
              </a>
            </div>
         </header> <br/>
         <!-- page header section ends here -->
       
        <section class="cart-section">
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
               <input type="text" name="bar_code" class="bar_code" required="" autocomplete="off" placeholder="bar code here ...">
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
                  &#8358;<?= @$product['price']; ?> x <?= @$product['quantity']; ?> <span>+VAT</span>
               </samp>
               <a href="./index.php?remove=<?= $product_id ?>" class="product">
                  delete
               </a>
             </div>
             <br/><br/>
           <?php endforeach; ?>

           <!-- total sum of cart items -->
            <samp class="title">
              Total: &#8358;<?= number_format($total, 2) ?>
              <?php $_SESSION['total'] = $total; ?>
            </samp>
            <br/><br/><br/>

            <!-- if user want to clear cart and save cart items to database -->
            <form action="./clear_cart.php" method="post">
               <input type="number" name="change_element" placeholder="Change element(&#8358;) ...." min="0" required>
                <br/><br/>
                <span class="payment-label">Cash:</span> 
                <input type="radio" name="payment_mode" value="cash">

                <span class="payment-label">Transfer:</span> 
                <input type="radio" name="payment_mode" value="transfer"> 
                
                <span class="payment-label">Card:</span> 
                <input type="radio" name="payment_mode" value="card">

               <input type="hidden" name="ip_address" class="ip_address">
               <input type="hidden" name="clear-cart" value="clear-cart">
               <br/><br/><br/>
               <input type="submit" value="Clear cart and archive">
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
      </main>
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
       alert('Error fetching IP address ' + error);
      });
     }

    // Call the function to fetch IP address when the page loads
     document.addEventListener('DOMContentLoaded', getIPAddress);
   </script>
   <noscript>Pls. enable javascript in your browser</noscript>
</html>


<?php
## Remove selected product from cart base on the id
if (isset($_GET['remove']) && isset($_SESSION['cart'])) {
   ## unset product from the cart
   unset($_SESSION['cart'][$_GET['remove']]);

   echo '<script>window.location = "./";</script>';
  }

  ## code to get product from the database base on the barcode inputed
  ## if value is posted, also check the request mthod
  if (isset($_POST['bar_code']) && $_SERVER["REQUEST_METHOD"] === "POST") {
   @$bar_code = $conn->real_escape_string($_POST['bar_code']);

   ## select all from products table where barcode is same as barcode posted
   $sql = "SELECT * FROM products WHERE bar_code = '$bar_code' LIMIT 1";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
       $product_id = $row['id'];
       $product_name = $row['product_name'];
       $product_price = $row['sales_price'] + $row['tax'];

       ## Add the product to the cart
       if (isset($_SESSION['cart'][$product_id])) { 
           $_SESSION['cart'][$product_id]['quantity'] += 1;
         
           echo '<script>window.location = "./";</script>';

             } else {
               $_SESSION['cart'][$product_id] = array(
               'name' => $product_name,
               'price' => $product_price,
               'quantity' => 1,
           );
           
           echo '<script>window.location = "./";</script>';
        }
      } else {
         echo '<script>alert("Barcode mismatch!");</script>';
   }
}
?>