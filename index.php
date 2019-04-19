<?php
  session_start();
  include_once 'include/dbh.php';
  include 'header.php';
?>

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
<?php
if (isset($_SESSION['u_id'])) {
  echo '<li><a href="profile.php">Profile</a></li>';
}
else {
  echo '<li><a href="signup.php">Signup</a></li>';
}
?>
              </ul>
            </div>
        </div>
        <div class="logo">
          <img src="images/logo.png" alt="Your Progress VS Mine">
          <h1>Your Progress vs Mine</h1>
        </div>

        <div class="nav">
          <ul>
            <li><a href="index.php">Home</a></li>
<?php
if (isset($_SESSION['u_id'])) {
  echo '<li><a href="profile.php">Profile</a></li>';
}
else {
  echo '<li><a href="signup.php">Signup</a></li>';
}
?>

          </ul>
        </div>
      </nav>
      <!-- End Navigation -->

      <main>

<?php
if (!isset($_SESSION['u_id'])) {
  echo '<div class="login">
          <h1>Sign in</h1>
          <div class="form-message">
            <p>Javascript Here!</p>';

  if (isset($_GET['err'])) {
  echo '<p class="showMessage">'.$_GET['err'].'</p>';
  }

  echo  '</div>
          <form action="include/login_alt.php" method="post">
            <label for="uid">Username:</label>
            <input id="uid" type="text" name="uid" autofocus>
            <label for="pwd">Password:</label>
            <input id="pwd" type="password" name="pwd">
            <input id="recaptchaResponse" type="hidden" name="recaptcha_response">
<!--            <a href="#">Forgot Password?</a>-->
            <div class="submit">
              <input type="submit" name="submit" value="Enter">
            </div>
          </form>

      <footer>
        <p>Dont have an account?<a href="signup.php">Sign up!</a></p>
        <a href="#"><i class="fa fa-instagram"></i></a><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a>
      </footer>
        </div>';
}
?>

        <div id="about">
          <h1>Welcome to Your Progress VS Mine</h1>
          <p>Your Progress VS Mine is not your everyday fitness app. We are not it to show off what we can do for, we want you to show off what you got!</p>
          <p>Your Progress VS Mine is a fitness social platform where you can engage in conversation and compete for a leaderboard based on your progress and the number of workouts shared.</p>
          <p>Here you can make up your schedule, keep track of your workouts and look for advise at the same time.</p>
        </div>
      </main>
    </div>

  </body>

</html>
