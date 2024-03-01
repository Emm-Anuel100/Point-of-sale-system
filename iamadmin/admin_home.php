<?php
## start session
session_start();
## require connection file
require_once('../conn.php');  
## require function.php file
require('./function.php'); 

## check if session is set
//if (!isset($_SESSION["password"]) /* || $_SESSION["password"] !== "iamadmin"*/) {
   ## if password session is not set or password input not equal to iamadmin then redirect to error page
  // header("Location: ../error.htm");
//}
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
      <link  href="../styles/dist/manage_distributor.css" rel="stylesheet">
      <!-- fav-icon -->
      <link rel="shortcut icon" href="../images/shop_logo.png" type="image/x-icon">
      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Include jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <title>I am admin</title>
   </head>
   <body>

    <?php
    $notification_result = mysqli_query($conn, "SELECT * FROM `notifications` ORDER BY `id`");
    ?>

      <main class="main-content">
         <nav class="navigation">
            <img src="../images/shop_logo.png" alt="logo" class="logo_image">
            <section class="nav_bars">
            <a href="#" class="nav"><i class="fas fa-home home"></i><span class="title">Home</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-store add_product"></i><span class="title"> Add new product</span></a>
            <br/>
             <a href="#" class="nav"><i class="fas fa-store-slash manage_products"></i><span class="title">Manage products</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-wallet track_sales"></i><span class="title">Track sales</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-user-plus manage_distributor"></i><span class="title">Manage distributors</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-bell notifications"></i><span id="notification-counter" class="counter"><?= number_format(mysqli_num_rows($notification_result)) ?></span><span class="title">Notifications</span></a>
            <br/>
            <a href="./chart.php" class="nav"><i class="fas fa-chart-line"></i><span class="title">Sales chart</span></a>
            <br/>
            <a href="#" class="nav"><i class="fas fa-users-cog config"></i><span class="title">Configs</span></a>
            <br/>
            <a href="./logout.php" class="nav"><i class="fas fa-sign-out-alt"></i><span class="title">Log out</span></a>
            <br/>
            <div class="theme_btn nav"><i class="fas fa-adjust"></i> <span class="title">Theme</span></div>
            </section>
         </nav>

         <!-- sections -->
         <img src="../images/illustration.png" alt="illustration" class="section1 illustration">
         
         <!-- add product section starts here -->
         <section class="section2 page">
            <section class="form-section">
               <h2 class="title">Add new product to system.</h2> <br/><br/>
               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateProduct()">
                  <fieldset>
                     <input type="text" name="product_name" id="product_name" placeholder="Product name ..." autocomplete="off" required="">
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
                      <option value="41">2041</option>
                      <option value="42">2042</option>
                      <option value="43">2043</option>
                      <option value="44">2044</option>
                      <option value="45">2045</option>
                      <option value="46">2046</option>
                      <option value="47">2047</option>
                      <option value="48">2048</option>
                      <option value="49">2049</option>
                      <option value="50">2050</option>
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
                     <button type="submit" name="add_product_btn">
                      Add product
                     </button>
                     <img src="../images/Loading-gif-unscreen.gif" alt="gif" class="gif gif3">
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
            <h2 class="title title-2"><?= number_format(mysqli_num_rows($result)) ?> <span class="sm-text">Products added.</span></h2> 
            <br/>
            <h2 class="title sm-text">Recently added.</h2>
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
               <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateSales()">
                  <fieldset>
                     <input type="number" name="year" id="year" placeholder="Enter year e.g (<?= date('Y') ?>) ..." autocomplete="off" required="" min="1">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="month" placeholder="Enter month e.g (<?= number_format(date('m')) ?>) ..." autocomplete="off" required="" min="1" max="12">
                  </fieldset> <br/>
                  <fieldset>
                     <input type="number" name="day" placeholder="Enter day e.g (<?= number_format(date('d')) ?>) ..." autocomplete="off" required="" min="1" max="31">
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
            $totalamount += $row["total_naira"];
            }
           } else {
           ## if no sale was found for the selected date
           echo '<script>alert("No sale matches the date inputed!")</script>';
          }
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
               <li style="display: flex; line-height: 25px">
                  <span><?= @$i ?>.</span> <span>&nbsp;<?= @$row["product_infor"] ?>&nbsp;&nbsp; TRANS-ID: <?= "GR" . @$row["trans_id"] ?></span>
               </li>
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


   <!-- manage distributor section starts here -->
   <section class="section5 page">
      <h1 class="title">Manage distributors</h1> <br/>
      <span class="sub-title">Manage distributors &nbsp; <i class="fas fa-angle-right"></i> &nbsp; add distributor</span><br/><br/>

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

            <span class="sub-title">Manage distributors &nbsp; <i class="fas fa-angle-right"></i> &nbsp; remove distributor</span><br/><br/>

            <?php
            ## Check if delete request is received
            if (isset($_GET['id'])) { 
               $ID = $_GET['id'];
               ## Display confirmation dialog
               echo "
               <script>
                  if (confirm('Are you sure you want to delete this distributor?')) {
                     window.location.href = './delete_distributor.php?id=$ID';
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
    <section class="section6 page">
      <h1 class="title">Notifications ..</h1> <br/>

      <!-- notifications wrapper -->
      <div class="notifications_wrapper"></div>
      
         <!-- <?php
         // Fetch all notifications from the database that have a message of expiry
         $result_notifications_expiry = mysqli_query($conn, "SELECT * FROM `notifications` ORDER BY `id` DESC");

         // Check if there are any notifications
         if (mysqli_num_rows($result_notifications_expiry) > 0) {
            echo "<div class='notifications_wrapper'>";
            $i = 1;
            // Display notification details about expiry
            while ($row = mysqli_fetch_array($result_notifications_expiry)) {
                  echo "<div><samp>{$row['product_name']} is <samp>{$row['message']} you are advised to restock!</samp></div><br/>";
                  $i++;
            } 
            echo "</div>";
         } else {
            echo "You have no notifications yet.";
         }
         ?>   -->
      </section>
     <!-- notifications section ends here -->


    <!-- manage distributor section starts here -->
    <section class="section7 page">
      <h1 class="title">Configurations</h1>
    </section>
   <!-- manage distributor section ends here -->
</main>
</body>

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



   // function to pop up preloader on the add distributor section when submiting form
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


    // function to pop up preloader on the track sales section when submiting form
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


   // function to pop up preloader on the add product section when submiting form
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
</script>
<noscript>Pls. enable javascript in your browser</noscript>
</html>


<?php
## Check if the form for adding new products is submitted
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
} elseif (isset($_POST["add_product_btn"])) {
    ## Display error message if any input field is empty
    echo '<span style="font-size: 13.5px; color: orange; top: 3px; left: 25px; position: relative; font-family: sans-serif">⚠ &nbsp; All input fields must be filled.</span>';
}



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
## adding distributor ends here
?>

