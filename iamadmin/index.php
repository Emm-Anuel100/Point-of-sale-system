<?php
## starts session
session_start();
## require connection file
require_once ("../conn.php");  
## require function file
require_once ("./function.php"); 

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
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
           Blue Ocean Stores <span>&copy;2012 - <?= Date('Y') ?></span>
         </footer>
      </main>

   <script src="../script/admin_index.js"></script>
   </body>
</html>


<?php  
   ## set session for password
   ##@$_SESSION["password"] = $_POST["password"];

  if(isset($_POST["username"]) && $_SERVER["REQUEST_METHOD"] === "POST"){
    ## Sign-in process
    $username = mysqli_real_escape_string($conn, filter_var($_POST["username"], FILTER_DEFAULT));
    $password = mysqli_real_escape_string($conn, filter_var($_POST["password"], FILTER_DEFAULT));
 
    ## Prepare and bind parameters to avoid SQL injection
    $stmt = $conn->prepare("SELECT admin_name, admin_password FROM admin_config WHERE admin_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
 
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($db_username, $db_password);
        $stmt->fetch();
 
        ## Verify password
        if (verifyPassword($password, $db_password)) {
            ## Set session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $db_username;
            $_SESSION["ip_address"] = $_SERVER["REMOTE_ADDR"];
            $_SESSION["user_agent"] = $_SERVER["HTTP_USER_AGENT"];
 
            ## Set session expiration time (1 month)
            $_SESSION["expire_time"] = time() + (30 * 24 * 60 * 60);
 
            ## Redirect to main page
            header("Location: ./admin_home.php");
            exit;
        } else {
          echo '<script>alert"Incorrect username or password!"</script>';
        }
    } else {
        echo '<script>alert"Incorrect username or password!"</script>';
    }
 
    $stmt->close();
 
 ## Check session expiration
 if (isset($_SESSION["expire_time"]) && $_SESSION["expire_time"] < time()) {
    session_unset();
    session_destroy();
 }
 
 ## Check if user is signed in
 if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    ## Check session IP address and user agent to prevent session hijacking
    if ($_SESSION["ip_address"] !== $_SERVER["REMOTE_ADDR"] || $_SESSION["user_agent"] !== $_SERVER["HTTP_USER_AGENT"]) {
        redirectToErrorPage();
    }
 
    ## Redirect to main page if signed in
    header("Location: ./admin_home.php");
    exit;
 }
}
?>