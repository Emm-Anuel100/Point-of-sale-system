<?php
## start session
session_start();

## require connection file
require_once '../conn.php';  

## Require Year sales file
require_once '../dashboard_sales_infor/present_year_sales.php';

## Require Month sales file
require_once '../dashboard_sales_infor/present_month_sales.php';

## Require Week sales file
require_once '../dashboard_sales_infor/present_week_sales.php';

## Require Day sales file
require_once '../dashboard_sales_infor/present_day_sales.php';

## Require product expiry file
require_once '../dashboard_sales_infor/product_expiry.php';

## Require product stock file
require_once '../dashboard_sales_infor/product_stock.php';

## Require payment mode file
require_once '../dashboard_sales_infor/payment_method.php';


## Check if admin session variables are not set
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_username'])) { 
   ## Redirect to admin error page
   header("Location: ../error_pages/admin_error.htm");
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- External stylings -->
      <link href="../styles/dist/admin_home.css" rel="stylesheet">
      <link href="../styles/dist/admin_index.css" rel="stylesheet">
      <link href="../styles/dist/add_product.css" rel="stylesheet">
      <link href="../styles/dist/manage_product_price.css" rel="stylesheet">
      <link href="../styles/dist/track_sales.css" rel="stylesheet">
      <link href="../styles/dist/manage_distributor.css" rel="stylesheet">
      <link href="../styles/dist/configuration.css" rel="stylesheet">
      <link href="../styles/dist/joter.css" rel="stylesheet">
      <link href="../styles/dist/sales_report.css" rel="stylesheet">
      <link href="../styles/dist/dashboard.css" rel="stylesheet">
      <link href="../styles/dist/Product_restock.css" rel="stylesheet">
      <!-- Fav-icon -->
      <link rel="shortcut icon" href="../images/shop_logo.png" type="image/x-icon">
      <!-- Font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" integrity="sha512-8RxmFOVaKQe/xtg6lbscU9DU0IRhURWEuiI0tXevv+lXbAHfkpamD4VKFQRto9WgfOJDwOZ74c/s9Yesv3VvIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Include jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- page title -->
      <title>Admin - Dadral Stores</title>
      <!-- Include typed.js library -->
      <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/typed.js"></script>
   </head>
   <body>

    <?php
    $notification_result = mysqli_query($conn, "SELECT * FROM `notifications` ORDER BY `id`");
    ?>

      <main class="main-content">
         <nav class="navigation">
            <img src="../images/shop_logo.png" alt="logo" class="logo_image">
            <section class="nav_bars">
            <a href="#" class="nav"><i class="fas fa-dashboard active" id="btn1" onclick="showPage(1)"></i><span class="title">Dashboard</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-store" id="btn2" onclick="showPage(2)"></i><span class="title">Add new product</span></a>
            <br/>
             <a href="#" class="nav"><i class="fas fa-sack-dollar" id="btn3" onclick="showPage(3)"></i><span class="title">Manage price list</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-cart-shopping" id="btn4" onclick="showPage(4)"></i><span class="title">Sales Snapshot</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-warehouse" id="btn5" onclick="showPage(5)"></i><span class="title">Manage distributors</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-bell" id="btn6" onclick="showPage(6)"></i><span id="notification-counter" class="counter"><?= number_format(mysqli_num_rows($notification_result)) ?></span><span class="title">Notifications</span></a>
            <br/>
            <a href="../chart_views/general_chart.php" class="nav"><i class="fas fa-chart-line"></i><span class="title">View sales chart</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-cash-register" id="btn7" onclick="showPage(7)"></i><span class="title">Manage cashier</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-list-ul" id="btn8" onclick="showPage(8)"></i><span class="title">UDO list</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-money-check" id="btn9" onclick="showPage(9)"></i><span class="title">Sales report</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-list-check" id="btn10" onclick="showPage(10)"></i><span class="title">Admin joter</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-users-cog" id="btn11" onclick="showPage(11)"></i><span class="title">Configurations</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-boxes-stacked" id="btn12" onclick="showPage(12)"></i><span class="title">Product restock</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-person-circle-question" id="btn13" onclick="showPage(13)"></i><span class="title">Help</span></a>
            <br/>
            <a href="../admin_logout/logout.php" class="nav"><i class="fas fa-sign-out-alt"></i><span class="title">Log out</span></a>
            <!--<br/>
            <div class="theme_btn nav"><i class="fas fa-adjust"></i> <span class="title">Theme</span></div> -->
            </section>
         </nav>

         <!-- dashboard section starts here -->
         <section class="dashboard page section1" id="section1"  style="display: block;">
            <div class="dashboard-title">
              <i class="fas fa-wallet"></i> Finances ...
            </div> <br/>
            <div class="wrapper-con">
               <div class="sales-con sec1">
                  <?php Present_year_sales(); ?>
               </div>
               <div class="sales-con sec2">
                  <?php Present_month_sales(); ?>
               </div>
               <div class="sales-con sec3">
                  <?php Present_week_sales(); ?>
               </div>
               <div class="sales-con sec4">
                  <?php present_day_sales(); ?>
               </div>
             </div> <br/><br/><br/>

             <div class="dashboard-title">
               ....
             </div> <br/>
             <div class="wrapper-con con2">
               <div class="stock-detail">
                  <h2>Product close to expiry: <span><?php product_expiry(); ?></span></h2><br/>
               </div>
               <div class="expiry-detail">
                  <h2>Product out of stock: <span><?php product_stock(); ?></span></h2><br/>
               </div>
               <div class="payment-detail">
                  <h2>Most used payment method: <span><?php payment_mode(); ?></span></h2><br/>
               </div>
             </div>
           </section>
           <!-- dashboard section ends here -->
         

         <!-- add product section starts here -->
         <section class="page" id="section2">
            <section class="form-section">
               <h2 class="title">Add new product to the system</h2> <br/><br/>
               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateProduct()">
                  <fieldset>
                     <input type="text" name="product_name" id="product_name" placeholder="Product name ..." autocomplete="off" required="" class="add-product-input">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="text" name="bar_code" placeholder="Product barcode ..." autocomplete="off" required="" class="add-product-input">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="purchace_price" placeholder="Purchace price(&#8358;) ..." autocomplete="off" required="" min="1" class="add-product-input purchase_price">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="sale_percent" placeholder="Sale percentage(%) ..." autocomplete="off" required="" min="1" class="add-product-input sale_percent">
                  </fieldset> <br/>
                  <fieldset>
                     <span class="sales_price">Sales price: ₦<span class="interest"></span></span>
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="product_vat" placeholder="Product VAT(&#8358;) ..." autocomplete="off" required="" min="0" class="add-product-input">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="quantity" placeholder="Product Quantity ..." autocomplete="off" required="" min="1" class="add-product-input">
                  </fieldset> <br/>
                  <fieldset>
                  <div class="expiry_date">product expiry date</div> <br/>
                     <select name="year" class="date">
                     <?php
                     ## Get the current year
                     $currentYear = date('Y');

                     ## Loop to generate options for the next 50 years
                     for ($i = 0; $i <= 50; $i++) {
                        $year = $currentYear + $i;
                        echo "<option value='$year'>$year</option>";
                     }
                     ?>
                     </select>
                      <select name="month" class="date">
                       <option value="1">january</option>
                       <option value="2">february</option>
                       <option value="3">march</option>
                       <option value="4">april</option>
                       <option value="5">may</option>
                       <option value="6">june</option>
                       <option value="7">july</option>
                       <option value="8">august</option>
                       <option value="9">september</option>
                       <option value="10">october</option>
                       <option value="11">november</option>
                       <option value="12">december</option>
                       </select>
                      <select name="day" class="date">
                     <?php
                     ## Loop to generate 31 days 
                     for ($i = 1; $i <= 31; $i++) {
                        $value = sprintf("%02d", $i); ## Add leading zeros for display
                        echo "<option value=\"$i\">$value</option>\n";
                     }
                     ?>
                    </select>
                  </fieldset> <br/>
                  <fieldset>
                   <!-- get distributors from distributors table -->
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
                    </fieldset> <br/><br/>
                    <fieldset>
                     <button type="submit" name="empty_field_btn">
                      Add product
                     </button>
                     <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif3">
                  </fieldset>
               </form>
            </section>
         </section>
         <!-- add product section ends here -->

         <?php  
          ## Adding of new product to the system starts here
          if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_name"]) && isset($_POST["year"]) && isset($_POST["month"]) && isset($_POST["day"]) && isset($_POST["distributor"])) {
            ## Initialize variables and sanitize input
            $product_name = mysqli_real_escape_string($conn, filter_var($_POST["product_name"], FILTER_DEFAULT));
            $barcode = mysqli_real_escape_string($conn, filter_var($_POST["bar_code"], FILTER_DEFAULT));
            $sale_percent = mysqli_real_escape_string($conn, filter_var($_POST["sale_percent"], FILTER_DEFAULT));
            $purchace_price = mysqli_real_escape_string($conn, filter_var($_POST["purchace_price"], FILTER_DEFAULT));

            ## Convert sale percent to decimal
            $convert_to_decimal = $sale_percent / 100;

            ## Calculate interest
            $interest = $purchace_price * $convert_to_decimal;

            ## Sum interest with purchase price
            $sales_price = $interest + $purchace_price;
            $product_vat = mysqli_real_escape_string($conn, filter_var($_POST["product_vat"], FILTER_DEFAULT));
            $product_quantity = mysqli_real_escape_string($conn, filter_var($_POST["quantity"], FILTER_DEFAULT));
            $distributor = mysqli_real_escape_string($conn, filter_var($_POST["distributor"], FILTER_DEFAULT));

            ## Get product expiry date
            $expiry_year = mysqli_real_escape_string($conn, filter_var($_POST["year"], FILTER_DEFAULT));
            $expiry_month = mysqli_real_escape_string($conn, filter_var($_POST["month"], FILTER_DEFAULT));
            $expiry_day = mysqli_real_escape_string($conn, filter_var($_POST["day"], FILTER_DEFAULT));

            ## Check if product with the same barcode already exists
            $query = "SELECT * FROM products WHERE bar_code = '$barcode' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
               echo '<script>alert("Product with this barcode already exists!");</script>';
            } else {
               ## Insert new product into the database
               $sql = "INSERT INTO `products` (product_name, sales_price, sale_percent, purchace_price, distributor, bar_code, tax, quantity, expiry_year, expiry_month, expiry_day)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("siiissiiiii", $product_name, $sales_price, $sale_percent, $purchace_price, $distributor, $barcode, $product_vat, $product_quantity, $expiry_year, $expiry_month, $expiry_day);
               if ($stmt->execute() === true) {
                  ## Alert success message and redirect
                  echo '<script>alert("Product added successfully!"); window.location = "./admin_home.php";</script>';
               } else {
                  ## Display error message
                  echo "An error occurred while adding the product: " . $conn->error;
               }
            }
          } elseif (isset($_POST["empty_field_btn"])) {
            ## Display warning message if any input field is empty
            echo '<span style="font-size: 13.5px; color: orange; top: 0; left: -15px; position: relative; font-family: sans-serif">⚠ &nbsp; All input fields must be filled.</span>';
         }
         ## Adding of new product to the system ends here
         ?>


         <!-- manage price section starts here -->
         <?php 
         ## fetch all products added to the system
         $result = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `id`");

         ## fetch 3 recently added products
         $result_recent = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `timestamp` DESC LIMIT 3");
         if (mysqli_num_rows($result_recent) < 0) {
            # code...
            $row = mysqli_fetch_array($result_recent);
         }
         ?>
         <section class="page" id="section3">
            <h2 class="title title-2"><?= number_format(mysqli_num_rows($result)) ?> <span class="sm-text">Products added..</span></h2> 
            <br/> 
            <div class="product-wrapper">
               <div class="product header">
                  PRODUCT NAME
               </div>
               <div class="product header">
                  SALES PRICE
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
             <h2 class="title sm-text">Recently added..</h2>
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
            </div>
            <br/>
            <?php 
             $i++; 
            } 
            ?>
            <br/><br/>

             <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
             <input type="text" name="product_search" required autocomplete="off" class="product-search input-box" placeholder="Search product to update price/vat..."> <br/><br/>
             <button type="submit" class="submit"><i class="fas fa-search"></i></button> <br/><br/>
             </form>
             <div class="result-box"></div> <br/>

             <div class="product-wrapper">
               <div class="product header">
                  PRODUCT NAME
               </div>
               <div class="product header">
                  SALES PRICE
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
             </div> <br/>

           <?php 
            if (isset($_POST["product_search"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
            ## value posted 
            $product_name = mysqli_real_escape_string($conn, filter_var($_POST["product_search"], FILTER_DEFAULT));

            $result_sort = mysqli_query($conn, "SELECT * FROM `products` WHERE `product_name` = '$product_name' LIMIT 1");

            $i = 1;
            while ($row = mysqli_fetch_array($result_sort)){               
            ?>
           <div class="product-wrapper">
            <div class="product sec3"><?= $row["product_name"] ?></div>
            <div class="product sec3">
                <input type="text" class="update sales_price" value="<?= $row["sales_price"] ?>" required autocomplete="off">
            </div>
            <div class="product sec3"><?= $row["bar_code"] ?></div>
            <div class="product sec3">
                <input type="text" class="update tax" value="<?= $row["tax"] ?>" required autocomplete="off">
            </div>
            <div class="product sec3"><?= $row["quantity"] ?></div>
        </div>
        <br/>
       <?php 
        $i++; 
        } 
      }
      ?>
      </section>
      <!-- manage price section ends here -->


         <!-- sales snapshot section starts here -->
         <section class="page" id="section4">
            <h2 class="title">Sales snapshot .. <span style="font-size: 12px">| Get all sales, total income, infor. of products sold on a specific date |</span></h2>
            <br/><br/><br/>
            <section class="form-section track">
               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateSales()">
                  <fieldset>
                     <input type="number" name="year" id="year" placeholder="Enter year e.g (<?= date('Y') ?>) ..." autocomplete="off" required="" min="1">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="month" placeholder="Enter month e.g (<?= date('n') ?>) ..." autocomplete="off" required="" min="1" max="12">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="day" placeholder="Enter day e.g (<?= date('j') ?>) ..." autocomplete="off" required="" min="1" max="31">
                  </fieldset> <br/>
                  <fieldset>
                     <button type="submit">
                        Proceed
                     </button>
                     <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif2">
                  </fieldset>
               </form>
            </section>

            <br/><br/>
         <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["month"]) && isset($_POST["month"])) {
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
                $totalamount += $row["total_naira"];
            }
         } ## elseif ($num_rows === 0) {
            ## if no sale was found for the selected date
           ## echo '<script>alert("No sale matches the date inputted!")</script>';
          ## }
         }
       ?>


      <div class="product-wrapper">
      <div class="product sales-count">
        <div> <?= number_format(@$num_rows) ?> <span>sale(s) made</span></div>
      </div>
      <div class="product sales-count">
        <div> &#8358;<?= number_format(@$totalamount, 2) ?> <span>total income</span></div>
      </div>
     </div>
     <br/><br/>

     <div class="product-wrapper">
      <div class="track-sales">
          S/N
      </div>
      <div class="track-sales">
          PRODUCTS INFOR
      </div>
      <div class="track-sales">
         SUB-TOTAL
      </div>
      <div class="track-sales">
         TRANSACTION-ID
      </div>
      <div class="track-sales">
         PAYMENT MODE
      </div>
      <div class="track-sales">
         CASHIER
      </div>
      </div> <br/><br/>
     
     <?php
     if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["month"]) && !empty($_POST["month"])) {
     if ($num_rows > 0) {
        ## Reset the pointer back to the beginning
        mysqli_data_seek($result_infor, 0);
        ?>
         <span class="sales-label">all sales made on <?= $_POST["day"]. "-" .$_POST["month"]. "-" .$_POST["year"] ?></span> <br/><br/>

            <?php
            $i = 1;
            while ($row = mysqli_fetch_array($result_infor)) {
             ?>
             <div class="product-wrapper">
               <div class="track-sales detail">
                  <?= @$i ?>
               </div>
               <div class="track-sales detail infor">
                    <?= @$row["product_infor"] ?>
               </div>
               <div class="track-sales detail">
                  <?= '₦'.number_format((@$row["total_naira"]),2) ?>
               </div>
               <div class="track-sales detail">
                   <?= "GR" . @$row["trans_id"] ?>
               </div>
               <div class="track-sales detail">
                   <?= @$row["payment_mode"] ?>
               </div>
               <div class="track-sales detail">
                   <?= @$row["cashier"] ?>
               </div>
              </div> <br/>
               <?php
               $i++;
             }
            ?>
       <?php
      }
     }
     ?> <br/><br/>

    <span style="display: flex; gap: 10px;">
     <a href='../sales_snapshot_export/export_pdf.php?year=<?= @$year ?>&month=<?= @$month ?>&day=<?= @$day ?>' class="btn-download">Export to PDF</a> <br/><br/><br/>
     <a href='../sales_snapshot_export/export_csv.php?year=<?= @$year ?>&month=<?= @$month ?>&day=<?= @$day ?>' class="btn-download">Export to CSV</a>
    </span>
   </section>
   <!-- sales snapshot section ends here -->


   <!-- manage distributor section starts here -->
   <section class="page" id="section5">
      <h1 class="title">Manage distributors .. <span style="font-size: 12px">| Add or remove a distributor |</span></h1> <br/>
      <span class="sub-title">Manage distributors &nbsp; <i class="fas fa-caret-right"></i> &nbsp; add distributor</span><br/><br/>

         <section class="form-section track">
               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateAddress()">
                  <fieldset>
                     <input type="text" name="distributor_name" id="distributor_name" placeholder="Distributor's name ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="text" name="distributor_address" placeholder="Distributor's address ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="text" name="distributor_reg_no" placeholder="Distributor's reg. no ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <button type="submit">
                        Proceed
                     </button>
                     <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif1">
                  </fieldset>
               </form>
            </section> <br/><br/><br/><br/>

            <span class="sub-title">Manage distributors &nbsp; <i class="fas fa-caret-right"></i> &nbsp; remove distributor</span><br/><br/>

            <?php
            ## Check if delete request is received
            if (isset($_GET['id']) && !empty($_GET['id'])) { 
               $ID = $_GET['id'];
               ## Display confirmation dialog
               echo "
               <script>
                  if (confirm('Are you sure you want to delete this distributor?')) {
                     window.location.href = '../manage_personels/delete_distributor.php?id=$ID';
                  } else {
                     window.location.href = './admin_home.php';
                  }
               </script>
               ";
            }

            ## Fetch all distributors from the database
            $result_distributor = mysqli_query($conn, "SELECT * FROM `distributors` ORDER BY `id` DESC");

            ## Check if there are any distributors
            if (mysqli_num_rows($result_distributor) > 0) {
               echo "<div class='manage_distributor_wrapper'>";
               $i = 1;
               ## Display distributor details with delete link
               while ($row = mysqli_fetch_array($result_distributor)) {
                  echo "<div> $i <samp>{$row['distributor_name']}</samp> <samp>{$row['address']}</samp> <a href='?id={$row['id']}'>delete</a></div><br/>";
                  $i++;
               } 
               echo "</div>";
              } else {
               echo "No distributors found.";
            }
            ?>             
       </section>
    <!-- manage distributor section ends here -->


    <!-- notifications section starts here -->
    <section class="page section6" id="section6">
      <h1 class="title">Notifications ..</h1> <br/>
      <span><i class="fas fa-bell"></i> Notifications in the last four days ..</span>  <br/><br/>

      <!-- notifications wrapper -->
      <div class="notifications_wrapper"></div>
    </section>
    <!-- notifications section ends here -->


    <!-- configurations section starts here -->
    <section class="page" id="section11">
      <h1 class="title">Configurations ..</h1> <br/><br/>
      <!--- updating expiry countdown starts here --->
      <span class="sub-title">Configuration &nbsp; <i class="fas fa-caret-right"></i> &nbsp; product expiry &nbsp; <i class="fas fa-caret-right"></i> &nbsp; set expiry countdown [in days]</span><br/><br/>

       <?php
        ## Query to get current countdown value from the database
         $sql = "SELECT expiry_range FROM expiry_config";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
         ## Output data of each row
         while($row = $result->fetch_assoc()) {
            $expiry_range = $row["expiry_range"];
         }
         } else {
         echo "0 results";
         }
      ?>
      <br/>
      <span>Current Countdown: <samp><?= $expiry_range; ?></samp></span>
      <br/><br/>

      <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateExpiryRange()">
         <fieldset>
            <input type="number" name="expiry_range" class="expiry_range config_input" placeholder="Update expiry countdown.. [in days]" autocomplete="off" required="" min="1">
         </fieldset> <br/>
         <fieldset>
         <button type="submit" class="config_btn">
            Proceed
         </button>
            <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif4">
         </fieldset>
         </form> <br/><br/>
         <!--- updating expiry countdown ends here --->


         <!--- updating stock threshold starts here --->
         <span class="sub-title">Configuration &nbsp; <i class="fas fa-caret-right"></i> &nbsp; stock threshold</span><br/><br/>

         <?php
         ## Query to get current threshold value from the database
         $sql = "SELECT quantity FROM quantity_config";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
         ## Output data of each row
         while($row = $result->fetch_assoc()) {
            $stock_threshold = $row["quantity"];
         }
         } else {
         echo "0 results";
         }
        ?>
         <br/>
          <span>Current Threshold: <samp><?= $stock_threshold; ?></samp></span>
         <br/><br/>

        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateStockRange()">
         <fieldset>
            <input type="number" name="stock_threshold" class="stock_range config_input" placeholder="Update stock threshold.." autocomplete="off" required="" min="1">
         </fieldset> <br/>
         <fieldset>
         <button type="submit" class="config_btn">
            Proceed
         </button>
            <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif5">
         </fieldset>
         </form> <br/><br/>
         <!--- updating stock threshold ends here --->


       <!--- updating admin username starts here --->
       <span class="sub-title">Configuration &nbsp; <i class="fas fa-caret-right"></i> &nbsp; update admin username</span><br/><br/>

        <?php
         ## Query to get current admin username from the database
         $sql = "SELECT admin_name FROM admin_config";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
         ## Output data of each row
         while($row = $result->fetch_assoc()) {
            $admin_name = $row["admin_name"];
         }
         } else {
         echo "0 results";
         }
         ?>
         <br/>
          <span>Current Username: <samp><?= $admin_name; ?></samp></span>
         <br/><br/>

         <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return updateAdminUsername()">
         <fieldset>
            <input type="text" name="admin_username" class="admin_username config_input" placeholder="Update admin username.." autocomplete="off" required="">
         </fieldset> <br/>
         <fieldset>
         <button type="submit" class="config_btn">
            Proceed
         </button>
            <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif6">
         </fieldset>
         </form> <br/><br/>
         <!--- updating admin username ends here --->


         <!--- updating admin password starts here --->
         <span class="sub-title">Configuration &nbsp; <i class="fas fa-caret-right"></i> &nbsp; update admin password</span><br/><br/>

         <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return updateAdminPassword()">
         <fieldset>
            <input type="text" name="admin_password" class="admin_password config_input" placeholder="Update admin password.." autocomplete="off" required="">
         </fieldset> <br/>
         <fieldset>
         <button type="submit" class="config_btn">
            Proceed
         </button>
            <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif7">
         </fieldset>
         </form> <br/><br/>
         <!--- updating admin password ends here --->
    </section>
    <!-- configurations section ends here -->


     <!-- manage cashier section starts here -->
      <section class="page" id="section7">
      <h1 class="title">Manage cashier .. <span style="font-size: 12px">| Add or remove a cashier |</span></h1> <br/><br/>

      <span class="sub-title">Manage cashier &nbsp; <i class="fas fa-caret-right"></i> &nbsp; add cashier</span><br/><br/>

      <section class="form-section track">
               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateCashier()">
                  <fieldset>
                     <input type="text" name="cashier_name" id="cashier_name" placeholder="Cashier's name ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="text" name="cashier_gender" id="cashier_gender" placeholder="Gender (m/f) ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="text" name="cashier_id" placeholder="Cashier's ID ..." autocomplete="off" required="">
                  </fieldset> <br/>
                  <fieldset>
                     <button type="submit">
                        Proceed
                     </button>
                     <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif8">
                  </fieldset>
               </form>
            </section> <br/><br/><br/><br/>

            <span class="sub-title">Manage cashier &nbsp; <i class="fas fa-caret-right"></i> &nbsp; remove cashier</span><br/><br/>

            <?php
            ## Check if delete request is received
            if (isset($_GET['cashierid']) && !empty($_GET['cashierid'])) { 
               $CashierID = $_GET['cashierid'];
               ## Display confirmation dialog
               echo "
               <script>
                  if (confirm('Are you sure you want to delete this cashier?')) {
                     window.location.href = '../manage_personels/delete_cashier.php?cashierid=$CashierID';
                  } else {
                     window.location.href = './admin_home.php';
                  }
               </script>
               ";
            }

            ## Fetch all cashier from the database
            $result_cashier = mysqli_query($conn, "SELECT * FROM `cashier_infor` ORDER BY `id` DESC");

            ## Check if there are any cashier
            if (mysqli_num_rows($result_cashier) > 0) {
               echo "<div class='manage_distributor_wrapper'>";
               $i = 1;
               ## Display cashier details with delete link
               while ($row = mysqli_fetch_array($result_cashier)) {
                  echo "<div> $i <samp>{$row['name']}</samp> <samp>{$row['cashier_id']}</samp> <a href='?cashierid={$row['id']}'>delete</a></div><br/>";
                  $i++;
               } 
               echo "</div>";
              } else {
               echo "No cashier found.";
            }
            ?>             
      </section>
      <!-- manage cashier section ends here -->


      <!-- manage UDO list section starts here -->
       <section class="page" id="section8">
        <?php
         ## Fetch product data from the database alphabetically
         $sql_fetch_products = "SELECT id, product_name FROM products ORDER BY product_name";
         $result_fetch_products = mysqli_query($conn, $sql_fetch_products);
         $products = mysqli_fetch_all($result_fetch_products, MYSQLI_ASSOC);
         ?>
       <h1 class="title">Manage UDO list .. <span style="font-size: 12px">| Mark Product as Unsold/internally used, Destroyed, or Other |</span></h1> <br/><br/><br/>
          
       <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="product_id" style="font-family: sans-serif; color: #cfcfcf;">Select Product:</label> <br/><br/>

        <select name="product_id" id="product_id" style="color: #fcfcfc; background: none; padding: 1rem; border-radius: .2rem; border: 1px solid gray">
            <?php foreach ($products as $product): ?>
            <option value="<?= $product['id']; ?>" style="color: #696767"><?= $product['product_name']; ?></option> 
            <?php endforeach; ?> 
        </select>
        <br/><br/><br/>

        <label for="udo_quantity" style="font-family: sans-serif; color: #cfcfcf;">Quantity:</label> <br/><br/>
        <input type="number" name="udo_quantity" id="udo_quantity" placeholder="...." min="1" required autocomplete="off" step="1" style="background: none; padding: 1rem; border: 1px solid gray; border-radius: .2rem; color: #eee">
        <br/><br/><br/>

        <label for="action" style="font-family: sans-serif; color: #cfcfcf;">Action:</label> <br/><br/>
        <select name="action" id="action" style="color: #fcfcfc; background: none; padding: 1rem; border-radius: .2rem; border: 1px solid gray">
            <option value="unsold/internally used" style="color: #696767">Unsold/internally used</option>
            <option value="destroyed" style="color: #696767">Destroyed</option>
            <option value="other" style="color: #696767">Other</option>
        </select>
        <br/><br/><br/>

        <input type="submit" value="Add Udo" name="UDOsubmitBtn" style="width: 10rem; color: #f0efef; height: 3rem; border-radius: 0.2rem; padding: 9px 2%; background: linear-gradient(20deg, #6a6ae2, #acacf7); cursor: pointer;">
       </form>
       </section>
      <!-- manage UDO list section ends here -->


    <!-- Sales report section starts here -->
   <section class="page section9" id="section9">
      <h1 class="title">Generate Sales Report ..</h1>
    
     <span style="display: flex; gap: 10px; position: absolute; left: 60%;">
         <div id="exportPDF" class="btn-download">Export to PDF</div>
         <div id="exportCSV" class="btn-download">Export to CSV</div>
     </span>

    <br/><br/>
    <span class="sub-title">Sales report &nbsp; <i class="fas fa-caret-right"></i> &nbsp; Generate report base on date range</span><br/><br/>

    <form id="salesReportForm">
        <input type="number" class="sales-report" id="start_year" name="start_year" required min="2000" step="1" placeholder="Start year ...">
        
        <input type="number" class="sales-report" id="start_month" name="start_month" required min="1" max="12" step="1" placeholder="Start month ...">
        
        <input type="number" class="sales-report" id="start_day" name="start_day" required min="1" max="31" step="1" placeholder="Start day ...">

        <br/><br/>

        <input type="number" class="sales-report" id="end_year" name="end_year" required min="2000" max="<?= Date('Y'); ?>" step="1" placeholder="End year ...">
        
        <input type="number" class="sales-report" id="end_month" name="end_month" required min="1" max="12" step="1" placeholder="End month ..."> 
        
        <input type="number" class="sales-report" id="end_day" name="end_day" required min="1" max="31" step="1" placeholder="End day ...">

        <br/><br/>
        <input type="submit" class="sales-report" value="Generate Report" class="report_btn">
     </form> <br/><br/>

     <!-- container where sales report table will be rendered -->
     <div id="salesReportTable"></div>

    </section>
    <!-- Sales report section ends here -->


       <!-- Joter section starts here -->
        <section class="page" id="section10">
        <h1 class="title">Admin joter ..</h1> <br/><br/>

         <textarea id="noteInput" placeholder="Write your note here..."></textarea> <br/>
         <button id="saveButton" type="submit">Save Note</button> <br/><br/>

         <div id="savedNotes"></div>
        </section>
       <!-- Joter section ends here -->


       <!-- Product restock section starts here -->
       <section class="page" id="section12">
         <h1 class="title">Product restock ..</h1> <br/><br/>

         <section class="form-section">
            <h2 class="title">Restock a product in the system</h2> <br/><br/><br/>

               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return productRestock()">
                  <fieldset>
                     <?php
                     ## SQL query to select products with quantity 0
                     $sql = "SELECT * FROM products WHERE quantity = 0";

                     ## Execute the query
                     $result = $conn->query($sql);

                     ## Check if the query was successful
                     if (!$result) {
                        echo "Error getting product with quantity equal to zero: " . $conn->error;
                       } else {
                        ?>
                        <select name="product_name_restock" class="product_name_restock">
                           <?php
                           ## Fetch all products as an associative array
                           while ($product = $result->fetch_assoc()) {
                              echo "<option value=\"" . $product['product_name'] . "\">" . $product['product_name'] . "</option>";
                           }
                           ?>
                        </select>
                        <?php
                     }
                     ?>
                  </fieldset> <br/>
                  <fieldset>
                     <input type="text" name="bar_code_restock" placeholder="Product barcode ..." autocomplete="off" required="" class="add-product-input">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="purchase_price_restock" placeholder="Purchace price(&#8358;) ..." autocomplete="off" required="" min="1" class="add-product-input purchase_price">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="sale_percent_restock" placeholder="Sale percentage(%) ..." autocomplete="off" required="" min="1" class="add-product-input sale_percent">
                  </fieldset> <br/>
                  <fieldset>
                     <span class="sales_price">Sales price: ₦<span class="interest"></span></span>
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="product_vat_restock" placeholder="Product VAT(&#8358;) ..." autocomplete="off" required="" min="0" class="add-product-input">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="quantity_restock" placeholder="Product Quantity ..." autocomplete="off" required="" min="1" class="add-product-input" id="restock_quantity">
                  </fieldset> <br/>
                  <fieldset>
                  <div class="expiry_date">product expiry date</div> <br/>
                    <select name="year_restock" class="date">
                    <?php
                     ## Get the current year
                     $currentYear = date('Y');

                     ## Loop to generate options for the next 50 years
                     for ($i = 0; $i <= 50; $i++) {
                        $year = $currentYear + $i;
                        echo "<option value='$year'>$year</option>";
                     }
                     ?>
                     </select>
                      <select name="month_restock" class="date">
                       <option value="1">january</option>
                       <option value="2">february</option>
                       <option value="3">march</option>
                       <option value="4">april</option>
                       <option value="5">may</option>
                       <option value="6">june</option>
                       <option value="7">july</option>
                       <option value="8">august</option>
                       <option value="9">september</option>
                       <option value="10">october</option>
                       <option value="11">november</option>
                       <option value="12">december</option>
                       </select>
                      <select name="day_restock" class="date">
                     <?php
                     ## Loop to generate 31 days 
                     for ($i = 1; $i <= 31; $i++) {
                        $value = sprintf("%02d", $i); ## Add leading zeros for display
                        echo "<option value=\"$i\">$value</option>\n";
                     }
                     ?>
                    </select>
                  </fieldset> <br/>

                  <fieldset>
                   <!-- get distributors from distributors table -->
                   <?php
                    $result = mysqli_query($conn, "SELECT `distributor_name` FROM `distributors` ORDER BY `id`");
                    if (mysqli_num_rows($result) < 0) {
                    # code...
                    $row = mysqli_fetch_array($result);
                    }
                    ?>
                    <select required="" name="distributor_restock" title="select distributor" class="distributor">
                     <option selected="" disabled="">Select Distributor</option>
                     <?php
                     $i = 1;
                     while ($row = mysqli_fetch_array($result)){               
                     ?> 
                     <option value="<?= $row["distributor_name"] ?>"><?= $row["distributor_name"] ?></option>
                     <?php  $i++; }  ?>
                    </select>
                    </fieldset> <br/><br/>
                    <fieldset>
                     <button type="submit" name="restock_empty_field_btn">
                      Update stock
                     </button>
                     <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif9">
                  </fieldset>
               </form>
            </section>
       </section>
       <!-- Product restock ends here -->


       <!-- Help section starts here -->
         <section class="page" id="section13">
         <h1 class="title">Help ..</h1> <br/><br/>

         <!-- help infor. wrapper-->
         <div id="text-container"></div>
         </section>
       <!-- Help section ends here -->
</main>
</body>


<style type="text/css">
/* styles for sales report starts here*/
input[type="number"].sales-report{
   padding: 9px 2%;
   width: 18rem;
   border: none;
   margin: 5px 3px;
   border-radius: .1rem;
   background: transparent;
   border: 1px solid #424242;
   color: rgb(212, 212, 212);
   height: 3rem;
}
input[type="submit"].sales-report{
   padding: 9px 2%;
   width: 10rem !important;
   border: none;
   cursor: pointer;
   margin: 3.5px 0;
   border-radius: .2rem;
   background: linear-gradient(20deg, rgb(106, 106, 226), rgb(172, 172, 247));
   color: rgb(240, 239, 239);
   height: 3rem;
}
input[type="submit"].sales-report:hover{
   background: linear-gradient(70deg, rgb(106, 106, 226), rgb(172, 172, 247));
   transition: ease-in-out .2s;
}

table{
   width: 100%;
   font-family: sans-serif;
   border-collapse: collapse;
}
.report-title{
   font-family: sans-serif;
}
th, td {
   padding: 8px;
   text-align: left;
   color: rgb(224, 222, 222);
   border: 1px solid #c5c5c5;
   font-size: 12.5px;
   line-height: 22px;
}
th {
   background-color: rgb(96, 126, 223);
   color: rgb(243, 242, 242);
}
/* syles for sales report ends here*/
</style>

<script src="../script/admin_home.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
    // Function to update notification counter
    function updateNotificationCount() {
        try {
            $.ajax({
               // URL of the PHP script to update notification counter
                url: './get_notification_count.php', 
                type: 'POST',
                 // Parse response as JSON
                dataType: 'json',
                success: function(data) {
                    // Update the notification count
                    $('#notification-counter').text(data); 
                }
            });
          } catch (error) {
            // Handle any errors gracefully
            console.error('An error occurred:', error);
        }
     }

    // Call the updateNotificationCount function initially
    updateNotificationCount();

    // Set an interval to update notification count every 3 seconds 
    setInterval(updateNotificationCount, 3000);  // 3000 milliseconds = 3 seconds
  });


  // Function to update expiry notification infor
  function reloadFunction() {
            $.ajax({
                url: './get_expiry_notification.php', // File containing expiry notificaion function
                success: function(data) {
                  // $('#notification_wrapper').text(data);
                   console.log(data);
                }
            });
        }

   // Call the reloadFunction every 5 seconds
   setInterval(reloadFunction, 5000); // 5000 milliseconds = 5 seconds


   // Function to get the current stock of all product
   // and push to the notification section if any is out of stock base on the stock threshold set by the Admin
   function StockNotification() {
            $.ajax({
                url: './get_stock_notification.php', // File containing product stock details
                success: function(data) {
                  // $('#notification_wrapper').text(data);
                   console.log(data);
                }
            });
        }

   // Call the StockNotification every 5 seconds
   setInterval(StockNotification, 5000); // 5000 milliseconds = 5 seconds


   $(document).ready(function() {
    // Function to update notification UI
    function fetchNotifications() {
        $.ajax({
            url: './notificationUI.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Update UI with new notifications
                updateNotificationsUI(data);
            },
            error: function(xhr, status, error) {
                console.error('An error occurred while fetching notifications:', error);
            }
        });
    }

    // Function to update UI with new notifications
    function updateNotificationsUI(data) {
        $('.notifications_wrapper').empty(); // Clear existing notifications
        if (data.length > 0) {
            // Append notifications to the wrapper
            data.forEach(function(notification) {
                $('.notifications_wrapper').append(`<div><samp>${notification.product_name} is <samp>${notification.message} you are advised to restock!</samp></div><br/>`);
            });
        } else {
            $('.notifications_wrapper').text("You have no notifications yet.");
        }
    }

    // Call fetchNotifications initially
    fetchNotifications();

    // Set interval to fetch new notifications every 4 seconds
    setInterval(fetchNotifications, 4000); // 4000 milliseconds = 4 seconds
  });


   // Function to remove product with quantity equal to zero
   function deleteProduct() {
            $.ajax({
                url: './delete_product.php', 
                success: function(data) {
                   console.log(data);
                }
            });
        }

   // Call the deleteProduct function every 5 seconds
   setInterval(deleteProduct, 5000); // 5000 milliseconds = 5 seconds


   // function to pop up preloader on the add distributor section 
   function validateAddress() {
    let input = document.getElementById('distributor_name');

    // Get the value of the input field
    let query = input.value.trim();

    if (query !== '') {
      document.querySelector('img.gif1').style.visibility = "visible";
      return true;
    } else {
      return false;
    }
    }


    // function to pop up preloader on the track sales section 
    function validateSales(){
      let input = document.getElementById('year');

    // Get the value of the input field
    let query = input.value.trim();

   if (query !== '') {
      document.querySelector('img.gif2').style.visibility = "visible";
      return true;
   } else {
      return false;
   }
   }


   // function to pop up preloader on the add product section 
   function validateProduct(){
   let input = document.getElementById('product_name');

    // Get the value of the input field
    let query = input.value.trim();

   if (query !== '') {
   document.querySelector('img.gif3').style.visibility = "visible";
      return true;
     } else {
      return false;
      }
   }
   

   // function to pop up preloader on the set expiry range section
   function validateExpiryRange(){
   let input = document.querySelector('.expiry_range');

    // Get the value of the input field
    let query = input.value.trim();

   if (query !== '') {
   document.querySelector('img.gif4').style.visibility = "visible";
      return true;
   } else {
      return false;
      }
   }

   // function to pop up preloader on the stock threshold section
   function validateStockRange(){
   let input = document.querySelector('.stock_range');

    // Get the value of the input field
    let query = input.value.trim();

   if (query !== '') {
   document.querySelector('img.gif5').style.visibility = "visible";
      return true;
     } else {
      return false;
      }
   }

    // function to pop up preloader on the update admin username section
    function updateAdminUsername(){
    let input = document.querySelector('.admin_username');

    // Get the value of the input field
    let query = input.value.trim();

    if (query !== '') {
    document.querySelector('img.gif6').style.visibility = "visible";
      return true;
     } else {
      return false;
      }
    }

    // function to pop up preloader on the update admin password section
    function updateAdminPassword(){
    let input = document.querySelector('.admin_password');

    // Get the value of the input field
    let query = input.value.trim();

   if (query !== '') {
     document.querySelector('img.gif7').style.visibility = "visible";
      return true;
     } else {
      return false;
      }
   }


    // function to pop up preloader on the cashier section
    function validateCashier(){
    let input = document.querySelector('#cashier_name');

    // Get the value of the input field
    let query = input.value.trim();

    if (query !== '') {
     document.querySelector('img.gif8').style.visibility = "visible";
      return true;
     } else {
      return false;
      }
   }


   // function to pop up preloader on the product restock section
    function productRestock(){
    let input = document.querySelector('#restock_quantity');

    // Get the value of the input field
    let query = input.value.trim();

    if (query !== '') {
     document.querySelector('img.gif9').style.visibility = "visible";
      return true;
     } else {
      return false;
      }
   }


// autocomplete search starts here
const results_box = document.querySelector('.result-box');
const input_box = document.querySelector('.input-box');

// Fetch product names from PHP script
fetch('./fetch_all_products.php')
  .then(response => response.json())
  .then(productNames => {
    const available_words = productNames;

    input_box.oninput = ()=> {
      let result = [];
      let input = input_box.value;
      if (input.length) {
         result = available_words.filter((keyword)=>{
          return keyword.toLowerCase().includes(input.toLowerCase());
         });
      }
      display_outputs(result);

      if (!result.length) {
         results_box.innerHTML = "";
      }
    }
 });

  function display_outputs(result) {
  const content = result.map((list)=>{
     return "<li onclick=selectinput(this)>" + list + "</li>";
  });

  results_box.innerHTML = "<ul>" + content.join('') + "</ul>";
}

function selectinput(list) {
  input_box.value = list.innerHTML;
  results_box.innerHTML = ""; // hide all elements when clicked on one
}
// autocomplete search ends here


 // JavaScript to handle AJAX request for updating sales_price and tax starts here
 $(document).ready(function(){
        $(".sales_price, .tax").change(function(){
            var productName = $(this).closest('.product-wrapper').find('.product').first().text().trim();
            var salesPrice = $(this).closest('.product-wrapper').find('.sales_price').val();
            var tax = $(this).closest('.product-wrapper').find('.tax').val();

            $.ajax({
                url: "./update_product.php",
                method: "POST",
                data: { productName: productName, salesPrice: salesPrice, tax: tax },
                success: function(response){
                    // Handle success
                    console.log(response);
                    alert("Record updated successfully");
                },
                error: function(xhr, status, error){
                    // Handle error
                    console.error(xhr.responseText);
                    alert("An error occured:" + error);
                }
            });
        });
    });
    // JavaScript to handle AJAX request for updating sales_price and tax ends here


    // javascript to handle updating of sales report table and dispayimg of datas in different file format starts here 
    document.addEventListener("DOMContentLoaded", function () {
        const salesReportForm = document.getElementById("salesReportForm");
        const exportPDFButton = document.getElementById("exportPDF");
        const exportCSVButton = document.getElementById("exportCSV");
        const salesReportTable = document.getElementById("salesReportTable");

        salesReportForm.addEventListener("submit", function (e) {
            e.preventDefault();
            generateSalesReport();
        });

        exportPDFButton.addEventListener("click", function () {
            exportSalesReport("pdf");
        });

        exportCSVButton.addEventListener("click", function () {
            exportSalesReport("csv");
        });

        function generateSalesReport() {
            const formData = new FormData(salesReportForm);
            fetch("../generate_report/generate_sales_report.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                salesReportTable.innerHTML = data;
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }

        function exportSalesReport(format) {
            const formData = new FormData(salesReportForm);
            const url = format === "pdf" ? "../sales_report_export/export_pdf.php" : "../sales_report_export/export_csv.php";
            const params = new URLSearchParams(formData).toString();
            window.location.href = `${url}?${params}`;
        }
    });
   // javascript to handle updating of sales report table and dispayimg of datas in different file format ends here 
</script>
<noscript>Pls. enable javascript in your browser</noscript>
</html>


<?php
## adding of distributor starts here
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["distributor_name"]) && isset($_POST["distributor_address"]) && isset($_POST["distributor_reg_no"])) {
   ## initialise vars...
   $distributor_name = mysqli_real_escape_string($conn, filter_var($_POST["distributor_name"], FILTER_DEFAULT));
   $distributor_address = mysqli_real_escape_string($conn, filter_var($_POST["distributor_address"], FILTER_DEFAULT));
   $distributor_reg_no = mysqli_real_escape_string($conn, filter_var($_POST["distributor_reg_no"], FILTER_DEFAULT));

   ## Insert distributor infor.. into the database
   $sql = "INSERT INTO `distributors` (distributor_name, address, reg_no )
   VALUES (?, ?, ?)";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("sss", $distributor_name, $distributor_address, $distributor_reg_no);
   if ($stmt->execute() === true) {
   ## Alert success message and redirect
   echo '<script>alert("distributor added successfully!"); 
   window.location = "./admin_home.php";</script>';
   } else {
   ## Display error message
   echo "An error occurred while adding distributor: " . $conn->error;
   }
}
## adding of distributor ends here


## adding of cashier starts here
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cashier_name"]) && isset($_POST["cashier_gender"]) && !empty($_POST["cashier_id"])) {
   ## initialise vars...
   $cashier_name = mysqli_real_escape_string($conn, filter_var($_POST["cashier_name"], FILTER_DEFAULT));
   $cashier_gender = mysqli_real_escape_string($conn, filter_var($_POST["cashier_gender"], FILTER_DEFAULT));
   $cashier_id = mysqli_real_escape_string($conn, filter_var($_POST["cashier_id"], FILTER_DEFAULT));

   ## Insert cashier infor.. into the database
   $sql = "INSERT INTO `cashier_infor` (name, gender, cashier_id)
   VALUES (?, ?, ?)";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("sss", $cashier_name, $cashier_gender, $cashier_id);
   if ($stmt->execute() === true) {
   ## Alert success message and redirect
   echo '<script>alert("cashier added successfully!"); 
   window.location = "./admin_home.php";</script>';
   } else {
   ## Display error message
   echo "An error occurred while adding cashier: " . $conn->error;
   }
}
## adding of cashier ends here


## updating admin username starts here
if (isset($_POST["admin_username"]) && !empty([@$_POST["admin_username"]]) && $_SERVER["REQUEST_METHOD"] === "POST"){
   ## initialize var..
   @$admin_username = mysqli_real_escape_string($conn, filter_var($_POST["admin_username"], FILTER_DEFAULT));

   ## query to update admin username
   $username_update_query = "UPDATE `admin_config` SET `admin_name` = '$admin_username' WHERE `id` = 1";

   ## check if error
   if($conn->query($username_update_query) === true){
      echo('
      <script> alert("Admin username updated successfully!");
        window.location = "./admin_home.php";
      </script>
      ');
   } else {
      echo('AN ERROR OCCURED WHILE UPDATING ADMIN USERNAME:' .$conn->error);
   }
}
## updating admin username ends here


## updating admin password starts here
if (isset($_POST["admin_password"]) && !empty([@$_POST["admin_password"]]) && $_SERVER["REQUEST_METHOD"] === "POST"){
   ## initialize var..
   @$admin_password = mysqli_real_escape_string($conn, filter_var($_POST["admin_password"], FILTER_DEFAULT));
   @$password_hash = password_hash($admin_password,PASSWORD_DEFAULT);

   ## query to update admin password
   $password_update_query = "UPDATE `admin_config` SET `admin_password` = '$password_hash' WHERE `id` = 1";

   ## check if error occured
   if($conn->query($password_update_query) === true){
      echo('
      <script> alert("Admin password updated successfully!");
        window.location = "./admin_home.php";
      </script>
      ');
   } else {
      echo('AN ERROR OCCURED WHILE UPDATING ADMIN PASSWORD:' .$conn->error);
   }
}
## updating of admin password ends here


## updating out of stock threshold starts here
if (isset($_POST["stock_threshold"]) && !empty([@$_POST["stock_threshold"]]) && $_SERVER["REQUEST_METHOD"] === "POST"){
   ## initialize var..
   @$stockthreshold = mysqli_real_escape_string($conn, filter_var($_POST["stock_threshold"], FILTER_DEFAULT));

   ## query to update stock threshold
   $stock_threshold = "UPDATE `quantity_config` SET `quantity` = '$stockthreshold', `timestamp` = CURRENT_TIMESTAMP WHERE `id` = 1";

   ## check if error
   if($conn->query($stock_threshold) === true){
      echo('
      <script> alert("Stock threshold updated successfully!");
      window.location = "./admin_home.php";
      </script>
      ');
    } else {
      echo('AN ERROR OCCURED WHILE UPDATING STOCK THRESHOLD:' .$conn->error);
   }
}
## updating out of stock threshold ends here


## updating expiry countdown starts here
if (isset($_POST["expiry_range"]) && !empty([@$_POST["expiry_range"]]) && $_SERVER["REQUEST_METHOD"] === "POST"){
   ## initialize var..
   @$expiry_range = mysqli_real_escape_string($conn, filter_var($_POST["expiry_range"], FILTER_DEFAULT));

   ## query to update expiry_range
   $expiry_range_query = "UPDATE `expiry_config` SET `expiry_range` = '$expiry_range', `timestamp` = CURRENT_TIMESTAMP WHERE `id` = 1";

   ## check if error
   if($conn->query($expiry_range_query) === true){
      echo('
      <script> alert("Expiry countdown updated successfully!");
       window.location = "./admin_home.php";
      </script>
      ');
   } else {
      echo('AN ERROR OCCURED WHILE UPDATING EXPIRY COUNTDOWN:' .$conn->error);
   }
}
## updating expiry countdown ends here


## adding of UDO list starts here
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['udo_quantity']) && !empty($_POST['udo_quantity'])) {
   ## Retrieve form data
   $product_id = mysqli_real_escape_string($conn, filter_var($_POST["product_id"], FILTER_DEFAULT));
   $quantity = mysqli_real_escape_string($conn, filter_var($_POST["udo_quantity"], FILTER_DEFAULT));
   $action = mysqli_real_escape_string($conn, filter_var($_POST["action"], FILTER_DEFAULT));
   
   ## Update product quantity
   $sql_update_quantity = "UPDATE products SET quantity = quantity - $quantity WHERE id = $product_id";
   $result_update_quantity = mysqli_query($conn, $sql_update_quantity);
   
   if ($result_update_quantity) {
       ## Insert into UDO list
       $sql_insert_udo = "INSERT INTO udo_list (product_id, quantity, action) VALUES ('$product_id', '$quantity', '$action')";
       $result_insert_udo = mysqli_query($conn, $sql_insert_udo);
       
       if ($result_insert_udo) {
            echo '
            <script>alert("Product quantity updated and UDO record inserted successfully!");
            window.location.href = "./admin_home.php";
            </script>
            ';
        } else {
           echo "Error inserting UDO list: " . mysqli_error($conn);
       }
    } else {
       echo "Error Updating product quantity: " . mysqli_error($conn);
   }
 } elseif(isset($_POST['UDOsubmitBtn'])){
   echo '
   <script>alert("all input fields must be filled!")</script>
   ';
}
## adding of UDO list ends here


## Product restock starts here
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_name_restock"]) && isset($_POST["distributor_restock"])) {
    ## Get form inputs
    $productName = mysqli_real_escape_string($conn, filter_var($_POST["product_name_restock"], FILTER_SANITIZE_SPECIAL_CHARS));
    $barcode = mysqli_real_escape_string($conn, filter_var($_POST["bar_code_restock"], FILTER_SANITIZE_SPECIAL_CHARS));
    $purchasePrice = filter_var($_POST["purchase_price_restock"], FILTER_SANITIZE_NUMBER_INT);
    $salePercent = filter_var($_POST["sale_percent_restock"], FILTER_SANITIZE_NUMBER_INT);
    $vat = filter_var($_POST["product_vat_restock"], FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($_POST["quantity_restock"], FILTER_SANITIZE_NUMBER_INT);
    $year = filter_var($_POST["year_restock"], FILTER_SANITIZE_NUMBER_INT);
    $month = filter_var($_POST["month_restock"], FILTER_SANITIZE_NUMBER_INT);
    $day = filter_var($_POST["day_restock"], FILTER_SANITIZE_NUMBER_INT);
    $distributor = mysqli_real_escape_string($conn, filter_var($_POST["distributor_restock"], FILTER_SANITIZE_SPECIAL_CHARS));

    ## Calculate sales price
    $interest = ($purchasePrice * $salePercent) / 100;
    $salesPrice = $purchasePrice + $interest;

    ## Update products table
    $updateSql = "UPDATE products SET bar_code = '$barcode', purchace_price = $purchasePrice, sale_percent = $salePercent, 
    tax = $vat, quantity = $quantity, expiry_year = $year, expiry_month = $month, expiry_day = $day, distributor = '$distributor', 
    sales_price = $salesPrice, timestamp = CURRENT_TIMESTAMP WHERE product_name = '$productName'";

    if ($conn->query($updateSql) === TRUE) {
        echo '<script>
        alert("Stock updated successfully!");
        window.location.href = "./admin_home.php";
        </script>';
     } else {
        echo "Error updating stock: " . $conn->error;
    }
} elseif (isset($_POST["restock_empty_field_btn"])) {
   ## Display warning message if any input field is empty
   echo '
    <script>alert("⚠ All input fields must be filled!");</script>
   ';
}
## Product restock nds here

?>
