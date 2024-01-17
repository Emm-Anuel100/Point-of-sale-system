<?php
## starts new session
session_start();
## require connection file
require_once("../conn.php");   

## check if session is set
if (!isset($_SESSION["password"]) || $_SESSION["password"] !== "iamadmin") {
   ## if password session is not set or password input not equal to iamadmin then redirect to error page
   header("Location: ../error.htm");
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- external stylings -->
      <link href="../styles/dist/admin_home.css" rel="stylesheet">
      <link href="../styles/dist/admin_index.css" rel="stylesheet">
      <link href="../styles/dist/add_product.css" rel="stylesheet">
      <link href="../styles/dist/manage_products.css" rel="stylesheet">
      <link href="../styles/dist/track_sales.css" rel="stylesheet">
      <!-- fav-icon -->
      <link rel="shortcut icon" href="../images/shop_logo.png" type="image/x-icon">
      <!-- font awesome cdn link  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <title>I am admin</title>
   </head>
   <body>

      <main class="main-content">
         <nav class="navigation">
            <img src="../images/shop_logo.png" alt="logo" class="logo_image">
            <section class="nav_bars">
            <a href="#" class="nav"><i class="fas fa-home home"></i><span class="title">Home</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-store add_product"></i><span class="title">Add product</span></a>
            <br/>
             <a href="#" class="nav"><i class="fas fa-store-slash manage_products"></i><span class="title">Manage products</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-wallet track_sales"></i><span class="title">Track sales</span></a>
            <br/>
            <div class="theme_btn nav"><i class="fas fa-adjust"></i> <span class="title">Theme</span></div>
            </section>
         </nav>

         <!-- sections -->
         <img src="../images/illustration.svg" alt="illustration" class="section1 illustration">
         <!-- add product section starts here -->
         <section class="section2 page">
            <section class="form-section">
               <h2 class="title">Add product to system.</h2> <br/><br/>
               <form action="./admin_home.php" method="post">
                  <fieldset>
                     <input type="text" name="product_name" placeholder="Product name ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="text" name="bar_code" placeholder="Product barcode ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="product_price" placeholder="Product price(&#8358;) ..." autocomplete="off" required="" min="1">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="product_vat" placeholder="Product VAT(&#8358;) ..." autocomplete="off" required="" min="0">
                  </fieldset> <br/>
                  <fieldset>
                     <button type="submit">
                        Add product
                     </button>
                  </fieldset>
               </form>
            </section>
         </section>
         <!-- add product section ends here -->

         <!-- manage products section starts here -->
         <?php  
         if (isset($_GET['id'])) { 
         $ID = $_GET['id'];
         $delete = mysqli_query($conn,"DELETE FROM `products` WHERE `id` = '$ID'");
         ## check if product was deleted
         if ($delete){
            ?>
            <script type="text/javascript">
               alert("product deleted sucessfully!");
            </script>
            <?php
         }
         }

         $result = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `id` DESC");
         if (mysqli_num_rows($result) < 0) {
            # code...
            $row = mysqli_fetch_array($result);
         }
         ?>
         <section class="section3 page">
            <h2 class="title">(<?= mysqli_num_rows($result) ?>) Products in system.</h2> 
            <br/><br/>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_array($result)){               
             ?>
            <div class="product-wrapper">
               <div class="product"><?= $row["product_name"] ?>
                   <span class="detail">product name</span>
               </div>
               <div class="product">&#8358;<?= $row["product_price"] ?>
                  <span class="detail">price</span>
               </div>
               <div class="product"><?= $row["bar_code"] ?>
                  <span class="detail">barcode</span>
               </div>
               <div class="product">&#8358;<?= $row["tax"] ?> 
                  <span class="detail">vat</span>
               </div>
               <?= "<a href='admin_home.php?id=".$row['id']."' class='product delete' title='delete product'>delete</a>" ?>
            </div>
            <br/>
            <?php  $i++; }  ?>
         </section>
         <!-- manage products section ends here -->


         <!-- track sales section starts here -->
         <section class="section4 page">
            <h2 class="title">Track sales.</h2>
            <br/>
            <section class="form-section track">
               <form action="./admin_home.php" method="post">
                  <fieldset>
                     <input type="number" name="month" placeholder="Enter month e.g (01) ..." autocomplete="off" required="" min="1" max="12">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="day" placeholder="Enter day e.g (01) ..." autocomplete="off" required="" min="1" max="31">
                  </fieldset> <br/>
                  <fieldset>
                     <button type="submit">
                        Proceed
                     </button>
                  </fieldset>
               </form>
            </section>
            <br/><br/>
            <?php  
           if (isset($_POST["month"]) && $_SERVER["REQUEST_METHOD"] === "POST"){
            ## initialize vars ...
           $month = $_POST["month"];
           $day = $_POST["day"];

           $result = mysqli_query($conn, "SELECT * FROM `sales` WHERE `month` = '$month' AND `day` = '$day'");
           if (mysqli_num_rows($result) > 0) {
            # code...
            $row = mysqli_fetch_array($result);
           }
           }
           ?>

            <div class="product-wrapper">
               <div class="product sales-count">
                  <?= mysqli_num_rows($result) ?> <span>sales made</span>
               </div>
               <div class="product sales-count">
                  &#8358;230022 <span>total income</span>
               </div>
            </div>
            <br/>
         </section>
         <!-- track sales section ends here -->
      </main>
   </body>
   <script src="../script/admin_home.js"></script>
</html>


<?php
## insert new products starts here
if (isset($_POST["product_name"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
   ## initialize var...
   $product_name = $_POST["product_name"];
   $barcode = $_POST["bar_code"];
   $product_price = $_POST["product_price"];
   $product_vat = $_POST["product_vat"];
   $year = Date("y");
   $month = Date("m");
   $day = Date("d");

   $query = "SELECT * FROM products WHERE bar_code = '$barcode' LIMIT 1";
   $result = mysqli_query($conn,$query);
   if (mysqli_num_rows($result) > 0) {
      ?>
      <script type="text/javascript">
         alert("Product already exist in the system!");
      </script>
      <?php
   } else {
      $sql = "INSERT INTO `products` (product_name, product_price, bar_code, tax, year, month, day)
              VALUES ('$product_name', '$product_price', '$barcode', '$product_vat', '$year', '$month', '$day')";

      if($conn->query($sql) === true){
         ?>
         <script type="text/javascript">
            alert("product added sucessfully");
         </script>
         <?php
      } else {
         ?>
         <script type="text/javascript">
            alert("AN ERROR OCCURED: ");
         </script>
         <?php
      }
   }
}
## insert new products ends here


## track sales starts here

## track sales ends here
?>