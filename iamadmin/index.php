<?php
## starts new session
session_start();
## require connection file
require_once("../conn.php");   

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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Title -->
     <title>admin Login</title>
   </head>
   <body>

      <main class="main-content">
         <!-- page header section -->
         <header class="page-header">
            <div class="img-wrapper">
              <a href="#">
               <img src="../images/shop_logo.png" alt="logo">
              </a>
            </div>
         </header> <br/>

         <section class="form-section" data-tilt>
            <h2>Welcome Back!</h2> <br/><br/>
            <form action="./" method="post">
               <fieldset>
                  <input type="text" name="username" placeholder="Username ..." autocomplete="off" required="">
               </fieldset> <br/>
               <fieldset>
                  <input type="password" name="password" placeholder="Password ..." autocomplete="off" required="" class="passsword-input">
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
           X-pression <span>&copy;2012 - 2023.</span>
         </footer>
      </main>

   <script src="../script/admin_index.js"></script>
   </body>
</html>


<?php  
   ## set session for password
   @$_SESSION["password"] = $_POST["password"];

   ## if value is posted
   if (isset($_POST["password"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

   $username = mysqli_real_escape_string($conn,$_POST["username"]);
   $password =  mysqli_real_escape_string($conn,$_POST["password"]);

   if ($username === "iamadmin" && $password === "iamadmin") {
       ## redirect to admin home page
       header("Location: ./admin_home.php");
   } else {
      ## alert message
      ?>
      <script type="text/javascript">
         alert("Informations are not correct!");
      </script>
      <?php
   }
}
?>