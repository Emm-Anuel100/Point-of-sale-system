<?php
## starts session
session_start();
## require connection file
require_once "../conn.php";  

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- external styling -->
      <link href="../styles/dist/admin_index.css" rel="stylesheet">
      <!-- fav-icon -->
      <link rel="shortcut icon" href="../images/shop_logo.png" type="image/x-icon">
      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" integrity="sha512-8RxmFOVaKQe/xtg6lbscU9DU0IRhURWEuiI0tXevv+lXbAHfkpamD4VKFQRto9WgfOJDwOZ74c/s9Yesv3VvIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Title -->
     <title>Cashier Login - Dadral Stores</title>
   </head>
   <body>

      <main class="main-content">
         <!-- page header section -->
         <header class="page-header">
            <div class="img-wrapper">
              <a href="../index.php">
               <img src="../images/shop_logo.png" alt="logo">
              </a>
            </div>
         </header> <br/>

         <section class="form-section">
            <h2>Welcome Back!</h2> <br/><br/>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                   <!-- get cashiers from the database -->
                   <?php
                    $result = mysqli_query($conn, "SELECT `name` FROM `cashier_infor` ORDER BY `id`");
                    if (mysqli_num_rows($result) < 0) {
                    # code...
                    $row = mysqli_fetch_array($result);
                    }
                    ?>
                    <select required="" name="cashier_name" class="cashier_name">
                     <option selected="" disabled="">Cashier name</option>
                     <?php
                     $i = 1;
                     while ($row = mysqli_fetch_array($result)){               
                     ?> 
                     <option value="<?= $row["name"] ?>"><?= $row["name"] ?></option>
                     <?php  $i++; }  ?>
                    </select>
                    </fieldset> <br/><br/>
                  <fieldset>
                  <input type="password" name="cashier_id" placeholder="Cashier ID ..." autocomplete="off" required="" class="passsword-input cashier_id">
                  <span class="password-view">view</span>
               </fieldset> <br/>
               <fieldset>
                  <button type="submit" name="cashier_login_btn">
                     Proceed
                  </button>
               </fieldset>
            </form>
         </section>

         <br/><br/><br/>
         <footer class="footer">
           Dadral Stores <span>&copy;2012 - <?= Date('Y') ?></span>
         </footer>
      </main>

   <script src="../script/admin_index.js"></script>
   </body>

   <!-- Internal styles -->
   <style type="text/css">
      *{
         transition: none !important;
      }
      select{
         background: none;
         color: rgb(161, 160, 160);
         padding: 0 15px;
         width: 95%;
         font-size: 13.5px;
         opacity: 70%;
      }
      select:hover{
         opacity: 100%;
      }
      option{
         font-size: 15px;
         color: rgb(161, 160, 160);
      }
      input[type="password"].cashier_id{
         color: rgb(161, 160, 160);
      }
   </style>
</html>



<?php
## if values is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cashier_name']) && !empty($_POST['cashier_name'])) {
    ## Get the submitted values
    $cashier_name = mysqli_real_escape_string($conn, filter_var($_POST['cashier_name'], FILTER_DEFAULT));;
    $cashier_id = mysqli_real_escape_string($conn, filter_var($_POST['cashier_id'], FILTER_DEFAULT));
    
    ## Fetch the cashier information from the database based on the provided name
    $query = "SELECT * FROM `cashier_infor` WHERE `name` = '$cashier_name'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ## Verify if the provided cashier ID matches the one in the database
        if ($row['cashier_id'] == $cashier_id) {
            ## Cashier credentials are correct, create session and redirect
            $_SESSION['cashier_id'] = $cashier_id;
            $_SESSION['cashier_name'] = $cashier_name;
            ## Redirect to cart page
            ?>
            <script>
               window.location.href = "../cart.php";
            </script>
            <?php
            exit();
          } else {
            ## Incorrect cashier ID
            echo '
            <script>alert("Incorrect cashier ID!");</script>
            ';
        }
     } else {
        ## Cashier name not found
        echo "Cashier not found";
    }
  } elseif (isset($_POST["cashier_login_btn"])) {
   ## alert error message if any input field is empty
   echo '
   <script>alert("All input fields must be filled!")</script>
   ';
}
?>
