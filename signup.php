<?php
  session_start();
  include_once 'include/dbh.php';

  $title = 'Your Progress VS Mine';
  $javaScript = '<script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/main.js" async></script>
  <script src="https://www.google.com/recaptcha/api.js" defer></script>';

  include 'header.php';
?>

<body id="signup">
  <div id="wrapper">
    <!-- Navigation -->
    <nav>
      <div id="mobile_menu">
        <input type="checkbox" id="nav" class="hidden">
        <label for="nav" class="nav-open"><i class="fa fa-bars"></i></label>
        <div class="nav-container">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="signup.php">Signup</a></li>
          </ul>
        </div>
      </div>
      <div class="logo">
        <img src="images/logo.png" alt="">
        <h1>Your Progress vs Mine</h1>
      </div>
      <div class="nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="highlight"><a href="signup.php">Signup</a></li>
        </ul>
      </div>
    </nav>
    <!-- End Navigation -->
    <main>
      <h1>Sign up</h1>
      <div class="form-message">
        <p>JAVASCRIPT HERE</p>
      </div>
      <form action="include/signup_alt.php" method="post">
        <div id="recaptcha" class="g-recaptcha" data-sitekey="6LeZHaAUAAAAAGwhqte3qMRtEheMn-2hdfNYrgCh" data-callback="onSubmit" data-size="invisible">
        </div>

        <div class="uid_email">
          <div class="uid">
            <label for="uid">Username:</label>
            <input id="uid" type="text" name="uid" placeholder="Username123" autofocus>
          </div>
          <div class="email">
            <label for="email">Email:</label>
            <input id="email" type="text" name="email" placeholder="JonJoe@email.com">
          </div>
        </div>
        <div class="date_goal">
          <div class="date">
            <label for="dob">Date of Birth:</label>
            <input type="text" name="dob" id="dob" placeholder="10/20/1950">
          </div>
          <div class="goal">
            <label for="goal">Goal:</label>
            <select id="goal" name="goal">
              <option value="1">Build Muscle</option>
              <option value="2">Lose Fat</option>
              <option value="3">Transform</option>
              <option value="4">Improve</option>
              <option value="5">Endurance</option>
              <option value="6">Flexibility</option>
              <option value="7">Other</option>
            </select>
          </div>
        </div>
        <div class="pwd_pwd_two">
          <div class="pwd">
            <label for="pwd">Password:</label>
            <input id="pwd" type="password" name="pwd">
          </div>
          <div class="pwd_two">
            <label for="pwd_two">Re enter Password:</label>
            <input id="pwd_two" type="password" name="pwd_two">
          </div>
        </div>
        <div class="submit"><input type="submit" name="submit" value="Enter"></div>
      </form>
    </main>
  </div>
</body>

</html>
