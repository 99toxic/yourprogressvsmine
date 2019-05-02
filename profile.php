<?php
  session_start();
  include_once 'include/dbh.php';
  if (isset($_SESSION['u_id'])) {
    $title = 'Your Progress VS Mine | Profile';
  }
  else {
    $title = 'Your Progress VS Mine | Login';
  }
  $javaScript = '<script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.idle.js"></script>
  <script src="js/main.js" async></script>
  <script src="https://www.google.com/recaptcha/api.js" defer></script>';

  include 'header.php';
?>

<body id="profile">
  <!--Floating Add Image Form-->
  <div class="container" id="userPic">
    <div class="form-message">
      <p>JAVASCRIPT HERE!</p>
    </div>
    <form action="include/upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file">
      <button type="submit" name="submit">Upload</button>
    </form>
  </div>
  <!--End Floating Add Image Form-->

  <!--Floating Add Workout Form-->
  <div class="container" id="add">
    <div class="add">
      <div id="add_tab">
        <div class="form-message">
          <p>JAVASCRIPT HERE!</p>
        </div>
        <div id="desc_tab">
          <form action="include/workout-desc.php" method="post">
            <div class="add_top">
              <div class="name">
                <label>Name:</label>
                <input type="text" name="name" placeholder="Name of Workout" required autofocus>
              </div>
              <div>
                <label>Type:</label>
                <select name="type">
                  <option value="1">Strength</option>
                  <option value="2">Cardio</option>
                  <option value="3">Stretching</option>
                  <option value="4">Plyometrics</option>
                  <option value="5">Other</option>
                  <option value="6">Rest</option>
                </select>
              </div>
            </div>
            <div class="sets">
              <label>Sets:</label>
              <input type="text" name="sets">
            </div>
            <div class="flex">
              <div class="desc">
                <label>Description:</label>
                <textarea name="desc" placeholder="Short discription of today's workout"></textarea>
              </div>
              <input class="desc_submit" type="submit" name="submit" value="Next">
            </div>
          </form>
        </div>
        <div id="details_tab">
          <form action="include/exe-details.php" method="post">
            <div class="add_top">
              <div class="name">
                <label>Name:</label>
                <input type="text" name="name" placeholder="Name of Exercise" required>
              </div>
              <div class="equipment">
                <label>Equipment:</label>
                <input type="text" name="equip" placeholder="ie Dumbbell, Barbell, Kettlebell etc.">
              </div>
            </div>
            <div class="flex">
              <div class="sets_two">
                <label>Sets:</label>
                <input type="text" name="sets">
              </div>
              <div class="reps">
                <label>Reps:</label>
                <input type="text" name="reps">
              </div>
              <div class="time">
                <label>Time:</label>
                <select name="time">
                  <option value="0">Select</option>
                  <option value="10">10secs</option>
                  <option value="20">20secs</option>
                  <option value="30">30secs</option>
                  <option value="40">40secs</option>
                  <option value="50">50secs</option>
                  <option value="100">1min</option>
                  <option value="130">1min 30secs</option>
                  <option value="200">2mins</option>
                  <option value="230">2mins 30 secs</option>
                  <option value="300">3mins</option>
                  <option value="330">3mins 30secs</option>
                  <option value="400">4mins</option>
                  <option value="430">4mins 30secs</option>
                  <option value="500">5mins</option>
                  <option value="530">5mins 30secs</option>
                  <option value="600">6mins</option>
                  <option value="630">6mins 30secs</option>
                  <option value="700">7mins</option>
                  <option value="730">7mins 30secs</option>
                  <option value="800">8mins</option>
                  <option value="830">8mins 30secs</option>
                  <option value="900">9mins</option>
                  <option value="930">9mins 30secs</option>
                  <option value="1000">10mins</option>
                </select>
              </div>
              <input type="submit" name="submit" value="Next">
            </div>
          </form>

          <div class="workout exe"></div>
          <div class="done">
            <a>Done</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--End Floating Add Workout Form-->

  <div id="wrapper">

    <!-- Navigation -->
    <nav>
      <div id="mobile_menu">
        <input type="checkbox" id="nav" class="hidden" />
        <label for="nav" class="nav-open"><i class="fa fa-bars"></i></label>
        <div class="nav-container">
          <ul>
            <li><a href="#messenger" class="view_chat">Chat</a></li>
            <li><a href="#find" class="view_find">Find Workout</a></li>
            <li><a href="#schedule" class="view_schedule">Schedule</a></li>
            <li><a href="#updates" class="view_update">Live Updates</a></li>
            <li><a href="#online_users" class="view_online">Who's Online</a></li>
            <li><a href="index.php">Home</a></li>
          </ul>
        </div>
      </div>
      <div class="logo">
        <img src="images/logo.png" alt="">
        <h1>Your Progress vs Mine</h1>
      </div>

      <div class="nav">
        <ul>

          <?php
if (isset($_SESSION['u_id'])) {
  echo '<li><a href="index.php">Home</a></li>
  <li class="highlight"><a href="profile.php">Profile</a></li>';

    echo '</ul><form action="include/logout.php" method="post">';
    echo '<button type="submit" name="submitLogout"><i class="fa fa-sign-out"></i><span>Logout '.$_SESSION['u_name'].' </span></button>
          </form>';
  }
  else {
    echo '<li class="highlight"><a href="index.php">Home</a></li>
    <li><a href="signup.php">Signup</a></li></ul>';
  }

  ?>
      </div>
    </nav>
    <!-- End Navigation -->

    <?php
  if (isset($_SESSION['u_id'])) {
  ?>

    <main>

      <div class="top">

        <!-- View the profile image or default image if not logged in -->
        <?php
  if (isset($_SESSION['u_id'])) {
    if (file_exists('uploads/'.$_SESSION['u_name'].'_profile.jpg')) {
      echo '<a href="#userPic" class="proPic"><img class="profile_img" src="uploads/'.$_SESSION['u_name'].'_profile.jpg" alt="'.$_SESSION['u_name'].'"></a>';
    }
    else {
      echo '<a href="#userPic" class="proPic"><img class="profile_img" src="uploads/profiledefault.png" alt="Default profile image for Your Progress vs Mine"></a>';
    }
  } else {
    echo '<img class="profile_img" src="uploads/profiledefault.png" alt="Default profile image for Your Progress vs Mine">';
  }
?>
        <!-- View Workout -->
        <div class="view"></div>
        <!-- End View Workout -->
      </div>

      <!-- Schedule -->
      <div id="schedule">
        <div id="sunday">
          <?php
    $day = '1';
    $weekDay = 'Sunday';
    include 'include/schedule.php';
  ?>
        </div>
        <div id="monday">
          <?php
    $day = '2';
    $weekDay = 'Monday';
    include 'include/schedule.php';
  ?>
        </div>
        <div id="tuesday">
          <?php
    $day = '3';
    $weekDay = 'Tuesday';
    include 'include/schedule.php';
  ?>
        </div>
        <div id="wednesday">
          <?php
    $day = '4';
    $weekDay = 'Wednesday';
    include 'include/schedule.php';
  ?>
        </div>
        <div id="thursday">
          <?php
    $day = '5';
    $weekDay = 'Thursday';
    include 'include/schedule.php';
  ?>
        </div>
        <div id="friday">
          <?php
    $day = '6';
    $weekDay = 'Friday';
    include 'include/schedule.php';
  ?>
        </div>
        <div id="saturday">
          <?php
    $day = '7';
    $weekDay = 'Saturday';
    include 'include/schedule.php';
  ?>
        </div>
      </div>
      <!-- End Schedule -->

      <div class="flex">

        <!-- Find a Workout -->
        <div id="find">
          <h1>Find a Workout</h1>
          <form action="include/search.php" method="post">
            <input id="search" type="text" name="search" value="Search">
            <select id="type" name="type">
              <option value="1">Strength</option>
              <option value="2">Cardio</option>
              <option value="3">Stretching</option>
              <option value="4">Plyometrics</option>
              <option value="5">Other</option>
            </select>
            <input type="submit" name="submit" value="Search">
          </form>
          <div class="workout search"></div>
        </div>
        <!-- End User Info -->

        <!-- Admin Board -->
        <div class="admin">
          <?php
    include 'include/admin.php';
  ?>
        </div>
        <!-- End Admin Board -->

      </div>

      <!-- Social Area -->
      <div class="social">

        <!-- Live Updates -->
        <aside id="updates">
          <h2>Live Update</h2>
          <div class="update">
            <?php
  include 'include/live-update.php';
?>
          </div>
        </aside>
        <!-- End Live Updates -->

        <!-- Chat Box -->
        <div id="messenger">
          <h2>Chat</h2>
          <div class="chatbox">
            <div class="chatlogs">
              <?php
  include 'include/chat.php';
?>
            </div>
          </div>
          <form class="chat-form" action="include/chat-add.php" method="post">
            <textarea></textarea>
            <input id="btn" type="submit" value="Send">
          </form>
        </div>
        <!-- End Chat Box -->

        <!-- Who is Online -->
        <aside id="online_users">
          <h2>Who's Online</h2>
          <div class="users">
            <?php
  include 'include/user-online.php';
?>
          </div>
        </aside>
        <!-- End Who is Online -->

      </div>
      <!-- End Social Area -->

    </main>
    <?php
        }
      else {
        echo '<main style="padding-top: 100px;"><h1>You are logged out!</h1>';
         echo '<div class="login">
          <div class="form-message">
            <p>Javascript Here!</p>';

  if (isset($_GET['err'])) {
  echo '<p class="showMessage">'.$_GET['err'].'</p>';
  }
  echo  '</div>
          <form action="include/login_alt.php" method="post" style="width: 300px;">
            <div id="recaptcha" class="g-recaptcha"
              data-sitekey="6LeZHaAUAAAAAGwhqte3qMRtEheMn-2hdfNYrgCh"
              data-callback="onSubmit"
              data-size="invisible">
            </div>
            <label for="uid">Username:</label>
            <input id="uid" type="text" name="uid" placeholder="Username or Email" autofocus>
            <label for="pwd">Password:</label>
            <input id="pwd" type="password" name="pwd">
<!--            <a href="#">Forgot Password?</a>-->
            <div class="submit">
              <input type="submit" name="submit" value="Enter">
            </div>
          </form>

      <div class="social_signup">
        <p>Dont have an account?<a href="signup.php">Sign up!</a></p>
        <a href="#"><i class="fa fa-instagram"></i></a><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a>
      </div>
        </div></main>';
      }
  ?>
  </div>
</body>

</html>
