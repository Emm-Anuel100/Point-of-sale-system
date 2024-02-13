<?php
## start session
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
            <a href="#" class="nav"><i class="fas fa-store add_product"></i><span class="title">Add new product</span></a>
            <br/>
             <a href="#" class="nav"><i class="fas fa-store-slash manage_products"></i><span class="title">Manage products</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-wallet track_sales"></i><span class="title">Track sales</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-user manage_distributor"></i><span class="title">Manage distributors</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-bell notifications"></i><span class="title">Notifications</span></a>
            <br/>
            <div class="theme_btn nav"><i class="fas fa-adjust"></i> <span class="title">Theme</span></div>
            </section>
         </nav>

         <!-- sections -->
         <img src="../images/illustration.svg" alt="illustration" class="section1 illustration">
         
         <!-- add product section starts here -->
         <section class="section2 page">
            <section class="form-section">
               <h2 class="title">Add new product to system.</h2> <br/><br/>
               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <fieldset>
                     <input type="text" name="product_name" placeholder="Product name ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="text" name="bar_code" placeholder="Product barcode ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="sale_percent" placeholder="Sale percentage(%) ..." autocomplete="off" required="" min="1">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="purchace_price" placeholder="Purchace price(&#8358;) ..." autocomplete="off" required="" min="1">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="product_vat" placeholder="Product VAT(&#8358;) ..." autocomplete="off" required="" min="0">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="quantity" placeholder="Product Quantity ..." autocomplete="off" required="" min="1">
                  </fieldset> <br/>
                  <fieldset>
                     <div class="expiry_date">product expiry date</div> <br/>
                   <select name="year">
                      <option disabled selected>year</option>
                      <option value="24">2024</option>
                      <option value="25">2025</option>
                      <option value="26">2026</option>
                      <option value="27">2027</option>
                      <option value="28">2028</option>
                      <option value="29">2029</option>
                      <option value="30">2030</option>
                      <option value="31">2031</option>
                      <option value="32">2032</option>
                      <option value="33">2033</option>
                      <option value="34">2034</option>
                      <option value="35">2035</option>
                      <option value="36">2036</option>
                      <option value="37">2037</option>
                      <option value="38">2038</option>
                      <option value="39">2039</option>
                      <option value="40">2040</option>
                      </select>
                      <select name="month">
                       <option disabled selected>month</option>
                       <option value="01">january</option>
                       <option value="02">february</option>
                       <option value="03">march</option>
                       <option value="04">april</option>
                       <option value="05">may</option>
                       <option value="06">june</option>
                       <option value="07">july</option>
                       <option value="08">august</option>
                       <option value="09">september</option>
                       <option value="10">october</option>
                       <option value="11">november</option>
                       <option value="12">december</option>
                       </select>
                      <select name="day">
                      <option disabled selected>day</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                    </select>
                  </fieldset> <br/>
                  <fieldset>
                   <!-- get distributors from our table -->
                   <?php
                    $result = mysqli_query($conn, "SELECT `distributor_name` FROM `distributors` ORDER BY `id`");
                    if (mysqli_num_rows($result) < 0) {
                    # code...
                    $row = mysqli_fetch_array($result);
                    }
                    ?>
                    <select required="" name="distributor" title="select distributor" class="distributor">
                     <option selected="" disabled="">Select Distributor</option>
                     <?php
                     $i = 1;
                     while ($row = mysqli_fetch_array($result)){               
                     ?> 
                     <option value="<?= $row["distributor_name"] ?>"><?= $row["distributor_name"] ?></option>
                     <?php  $i++; }  ?>
                    </select>
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
         ## if (isset($_GET['id'])) { 
         ## $ID = $_GET['id'];
         ## $delete = mysqli_query($conn,"DELETE FROM `products` WHERE `id` = '$ID'");
         ## check if product was deleted
         ## if ($delete){
         ##    ?>
             <script type="text/javascript">
         //       alert("product deleted sucessfully!");
         //    </script>
               <?php
         ## } else {
         ##    echo "AN ERROR OCCURED:" .$conn->error;
         ## }
         ## }


         ## fetch all products added to the system
         $result = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `id`");

         ## fetch 4 recently added products
         $result_recent = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `timestamp` DESC LIMIT 4");
         if (mysqli_num_rows($result_recent) < 0) {
            # code...
            $row = mysqli_fetch_array($result_recent);
         }
         ?>
         <section class="section3 page">
            <h2 class="title"><?= number_format(mysqli_num_rows($result)) ?> Products currently in the system.</h2> 
            <br/>
            <h2 class="title recent">Recently added products.</h2>
            <br/>
            <div class="product-wrapper">
               <div class="product header">
                  PRODUCT NAME
               </div>
               <div class="product header">
                  PRODUCT PRICE
               </div>
               <div class="product header">
                  BARCODE
               </div>
               <div class="product header">
                 PRODUCT VAT
               </div>
               <div class="product header">
                  QUANTITY
               </div>
             </div>
             <br/>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_array($result_recent)){               
             ?> 
             <div class="product-wrapper">
               <div class="product sec3"><?= $row["product_name"] ?>
               </div>
               <div class="product sec3">&#8358;<?= $row["sales_price"] ?>
               </div>
               <div class="product sec3"><?= $row["bar_code"] ?>
               </div>
               <div class="product sec3">&#8358;<?= $row["tax"] ?> 
               </div>
               <div class="product sec3"><?= $row["quantity"] ?> 
               </div>
               <!-- <?= "<a href='admin_home.php?id=".$row['id']."' class='product delete' title='delete product'>delete</a>" ?> -->
            </div>
            <br/>
            <?php 
             $i++; 
            } 
            ?>
         </section>
         <!-- manage products section ends here -->


         <!-- track sales section starts here -->
         <section class="section4 page">
            <h2 class="title">Track sales.</h2>
            <br/>
            <section class="form-section track">
               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <fieldset>
                     <input type="number" name="year" placeholder="Enter year e.g (20<?= date('y') ?>) ..." autocomplete="off" required="" min="1">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="month" placeholder="Enter month e.g (12) ..." autocomplete="off" required="" min="1" max="12">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="day" placeholder="Enter day e.g (31) ..." autocomplete="off" required="" min="1" max="31">
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
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["month"]) && !empty($_POST["month"])) {
            ## Initialize variables
            $year = mysqli_real_escape_string($conn, filter_var($_POST["year"], FILTER_DEFAULT));
            $month = mysqli_real_escape_string($conn, filter_var($_POST["month"], FILTER_DEFAULT));
            $day = mysqli_real_escape_string($conn, filter_var($_POST["day"], FILTER_DEFAULT));

            ## Query to fetch sales data
            $result_infor = mysqli_query($conn, "SELECT * FROM `sales` WHERE `year` = '$year' AND `month` = '$month' AND `day` = '$day'");

            ## Variables to store total amount and number of rows
            $totalamount = 0;
            $num_rows = mysqli_num_rows($result_infor);

            ## Process sales data
            if ($num_rows > 0) {
           while ($row = mysqli_fetch_array($result_infor)) {
            ## Calculate total amount
            $totalamount += $row["total"];
            }
           } else {
           ## No sales found for the selected date
           echo '<script>alert("No sale matches the date inputed!")</script>';
          }
        }
       ?>

      <div class="product-wrapper">
      <div class="product sales-count">
        <div> <?= number_format(@$num_rows) ?> <span>sale(s) made</span> </div>
      </div>
      <div class="product sales-count">
        <div> &#8358;<?= number_format(@$totalamount, 2) ?> <span>total income</span> </div>
      </div>
     </div>
     <br/><br/>

     <?php
     if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["month"]) && !empty($_POST["month"])) {
     if ($num_rows > 0) {
        ## Reset the pointer back to the beginning
        mysqli_data_seek($result_infor, 0);
        ?>
        <ul class="product_sold">
            <?php
            $i = 1;
            while ($row = mysqli_fetch_array($result_infor)) {
             ?>
               <li><?= @$i ?>.  &nbsp;<?= @$row["product_infor"] ?></li>
               <?php
                $i++;
             }
            ?>
        </ul>
       <?php
      }
     }
     ?>
   </section>
   <!-- track sales section ends here -->

</main>
</body>
<script src="../script/admin_home.js"></script>
<noscript>Pls. enable javascript in your browser</noscript>
</html>


<?php
## check if value is set, check request method
if (isset($_POST["product_name"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
   ## initialize vars...
   $product_name = mysqli_real_escape_string($conn,filter_var($_POST["product_name"], FILTER_DEFAULT));
   $barcode = mysqli_real_escape_string($conn, filter_var($_POST["bar_code"], FILTER_DEFAULT));
   $sale_percent = mysqli_real_escape_string($conn, filter_var($_POST["sale_percent"], FILTER_DEFAULT));
   $purchace_price = mysqli_real_escape_string($conn, filter_var( $_POST["purchace_price"], FILTER_DEFAULT));

   ## convert sale percent to decimal
   $convert_to_decimal = $sale_percent / 100;

   ## calculate interest
   $interest = $purchace_price * $convert_to_decimal;

   ## sum interest with purchace price
   $sum_data = $interest + $purchace_price;

   $sales_price = mysqli_real_escape_string($conn, filter_var($sum_data, FILTER_DEFAULT));
   $product_vat = mysqli_real_escape_string($conn, filter_var($_POST["product_vat"], FILTER_DEFAULT));
   $product_quantity = mysqli_real_escape_string($conn, filter_var($_POST["quantity"], FILTER_DEFAULT));
   @$distributor = mysqli_real_escape_string($conn, filter_var($_POST["distributor"], FILTER_DEFAULT));

   ## get product expiry year
   @$expiry_year = mysqli_real_escape_string($conn, filter_var($_POST["year"], FILTER_DEFAULT));

   ## get product expiry month
   @$expiry_month = mysqli_real_escape_string($conn, filter_var($_POST["month"], FILTER_DEFAULT));
   
   ## get product expiry day
   @$expiry_day = mysqli_real_escape_string($conn, filter_var($_POST["day"], FILTER_DEFAULT));
   
   $query = "SELECT * FROM products WHERE bar_code = '$barcode' LIMIT 1";
   $result = mysqli_query($conn,$query);
   if (mysqli_num_rows($result) > 0) {
      echo '<script>
            alert("Product with this barcode already exist!");
            </script>';
          } else {
         $sql = "INSERT INTO `products` (product_name, sales_price, sale_percent, purchace_price, distributor, bar_code, tax, quantity, expiry_year, expiry_month, expiry_day)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

         $stmt = $conn->prepare($sql);
         $stmt->bind_param("siiissiiiii", $product_name, $sales_price, $sale_percent, $purchace_price, $distributor, $barcode, $product_vat, $product_quantity, $expiry_year, $expiry_month, $expiry_day);
         if ($stmt->execute() === true) {
            ## alert success message
            echo '<script>
            alert("Product added Successfully!");
            window.location = "./admin_home.php";
            </script>';
         } else {
            ## error message
            echo "AN ERROR OCCURED WHILE ADDING PRODUCT:" .$conn->error;
         }
   }
}
## insert new products ends here
?>