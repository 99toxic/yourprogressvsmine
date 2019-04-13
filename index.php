<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Your Progress VS Mine</title>
    <meta charset="utf-8">

    <!--Stylesheets-->
    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!--End Stylesheets-->

    <!--Favicon-->
    <link href="php/img/favicon.ico" rel="icon" type="image/x-icon">
    <!--End Favicon-->

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--End Font Awesome-->

    <!--JavaScript-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/main.js"></script>
    <!--JavaScript-->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nick's Creative Design">
    <meta name="Description" content="A short description goes here">
  </head>

  <body id="signin">

    <div id="wrapper">

      <!-- Navigation -->
      <nav>

        <div id="mobile_menu">
            <input type="checkbox" id="nav" class="hidden" />
            <label for="nav" class="nav-open"><i class="fa fa-bars"></i></label>
            <div class="nav-container">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="signup.php">Signup</a></li>
              </ul>
            </div>
        </div>
        <div class="logo">
          <img src="images/Group%203.png" alt="">
          <h1>Your Progress vs Mine</h1>
        </div>

        <div class="nav">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="signup.php">Signup</a></li>
          </ul>
        </div>
      </nav>
      <!-- End Navigation -->

      <main>
        <div class="login">
          <h1>Sign in</h1>
          <div class="form-message">
            <p>Javascript Here!</p>
<?php
  if (isset($_GET['err'])) {
  echo '<p class="showMessage">'.$_GET['err'].'</p>';
  }
?>
          </div>
          <form action="include/login_alt.php" method="post">
            <label for="uid">Username:</label>
            <input id="uid" type="text" name="uid" autofocus>
            <label for="pwd">Password:</label>
            <input id="pwd" type="password" name="pwd">
<!--            <a href="#">Forgot Password?</a>-->
            <div class="submit">
              <input type="submit" name="submit" value="Enter">
            </div>
          </form>

      <footer>
        <p>Don't have an account?<a href="signup.php">Sign up!</a></p>
        <a href="#"><i class="fa fa-instagram"></i></a><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a>
      </footer>
        </div>

        <div class="content">
          <h1>Welcome to the home of Your Progress VS Mine</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum dolore dicta, ullam nisi? Atque, beatae quaerat adipisci ea provident, magni deserunt dolore, quo sapiente iure illo maiores. Reprehenderit, eveniet qui.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum dolore dicta, ullam nisi? Atque, beatae quaerat adipisci ea provident, magni deserunt dolore, quo sapiente iure illo maiores. Reprehenderit, eveniet qui.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum dolore dicta, ullam nisi? Atque, beatae quaerat adipisci ea provident, magni deserunt dolore, quo sapiente iure illo maiores. Reprehenderit, eveniet qui.</p>
        </div>
      </main>
    </div>
  </body>

</html>
