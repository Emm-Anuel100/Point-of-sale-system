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
     <title>Admin Login - Dadral Stores</title>
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
                  <input type="text" name="username" placeholder="Admin username ..." autocomplete="off" required="">
               </fieldset> <br/>
               <fieldset>
                  <input type="password" name="password" placeholder="Admin password ..." autocomplete="off" required="" class="passsword-input">
                  <span class="password-view">view</span>
               </fieldset> <br/>
               <fieldset>
                  <button type="submit">
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
</html>


<?php  
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && !empty($_POST['username'])) {
   ## Validate and sanitize input
   $username = mysqli_real_escape_string($conn, filter_var($_POST['username'], FILTER_DEFAULT));
   $password = mysqli_real_escape_string($conn, filter_var($_POST['password'], FILTER_DEFAULT));

   ## Prepare and execute the statement
   $stmt = $conn->prepare("SELECT id, admin_name, admin_password FROM admin_config WHERE admin_name = ?");
   $stmt->bind_param("s", $username);
   $stmt->execute();
   $stmt->store_result();

   if ($stmt->num_rows == 1) {
       ## Bind the result variables
       $stmt->bind_result($id, $db_username, $db_password);
       $stmt->fetch();

       ## Verify password
       if (password_verify($password, $db_password)) {
           ## Password is correct, set session variables and redirect to dashboard
           $_SESSION['admin_id'] = $id;
           $_SESSION['admin_username'] = $db_username;
           header("Location: ./admin_home.php");
           exit();
       } else {
           echo('
           <script>alert("Invalid username or password!")</script>
           ');
       }
     } else {
      echo('
           <script>alert("Invalid username or password!")</script>
         ');
   }
   $stmt->close();
}
?>