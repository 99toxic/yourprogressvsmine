<?php
  session_start();
  include_once 'include/dbh.php';
?>

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
  <!--  <link href="php/img/favicon.ico" rel="icon" type="image/x-icon">-->
  <!--End Favicon-->

  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--End Font Awesome-->

  <!--JavaScript-->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <!--  <script src="js/jquery.validate.js"></script>-->
  <script src="js/main.js"></script>
  <!--JavaScript-->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Nick's Creative Design">
  <meta name="Description" content="A short description goes here">
</head>

<body id="profile">
  <!--Floating Add Image Form-->
  <div class="container" id="userPic">
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
        <div class="form-message">JAVASCRIPT HERE!</div>
        <ul class="add_heading">
          <li><a href="#desc_tab">Workout Description</a></li>
          <li><a href="#details_tab">Workout Details</a></li>
        </ul>
        <div id="desc_tab">
          <form action="include/workout-desc.php" method="post">
            <div class="add_top">
              <div class="name">
                <label>Name:</label>
                <input type="text" name="name" autofocus>
              </div>
              <div>
                <label>Type:</label>
                <select name="type">
                  <option value="1">Strength</option>
                  <option value="2">Cardio</option>
                  <option value="3">Stretching</option>
                  <option value="4">Plyometrics</option>
                  <option value="5">Other</option>
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
                <textarea name="desc"></textarea>
              </div>
              <input type="submit" name="submit" value="Next">
            </div>
          </form>
        </div>
        <div id="details_tab">
          <form action="include/exe-details.php" method="post">
            <div class="add_top">
              <div class="name">
                <label>Name:</label>
                <input type="text" name="name" autofocus>
              </div>
              <div class="equipment">
                <label>Equipment:</label>
                <input type="text" name="equip">
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
                <input type="text" name="time">
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
    <header>

      <!-- View the profile image or default image if not logged in -->
      <?php
  $fileExt = 'jpg' or 'jpeg' or 'png' or 'gif';
  if (isset($_SESSION['u_id'])) {
    echo '<a href="#userPic" class="proPic"><img class="profile_img" src="uploads/'.$_SESSION['u_name'].'_profile.'.$fileExt.'" alt="'.$_SESSION['u_name'].'"></a>';
  } else {
    echo '<img class="profile_img" src="uploads/profiledefault.png" alt="Default profile image for Your Progress vs Mine">';
  }
?>
<!-- View Workout -->
<?php
      if (isset($_SESSION['u_id'])) {
      echo '<div class="view">
        <div class="view_heading">
          <div class="view-icon">
            <p>Tuesday</p>
            <img src="images/icon/Other.png" alt="">
            <div class="edit">
              <a href="#view">View</a> <a href="#">Edit</a>
            </div>
            <h4>Strength</h4>
          </div>
          <div class="view_content">
            <h2>Name</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum veritatis asperiores tempore, atque modi, voluptatum a magni suscipit, repudiandae culpa esse. Placeat, doloremque?</p>
          </div>
        </div>
        <div class="workout"></div>
      </div>';
}
else {
  echo '<h1>You are not logged in!</h1>';
}
?>
<!-- End View Workout -->
    </header>

    <!-- Navigation -->
    <nav>
      <a class='mobile_btn'><i class="fa fa-bars"></i></a>

      <img src="images/icon/Strength.png" alt="">

      <div id="mobile_menu">
        <nav>
          <ul>
            <li><a href="#" class="find_workout">Find a workout</a></li>
            <li><a href="#" class="display_leader">Leader Board</a></li>
            <li><a href="#" class="view_updates">Live Updates</a></li>
            <li><a href="#" class="view_online">Who's Online</a></li>
            <li><a href="#" class="view_chat">Chat</a></li>
          </ul>
        </nav>
      </div>

      <div class="week">
        <h2>Week</h2>
        <h2>4</h2>
      </div>

      <div class="rank">
        <h2>Your Rank</h2>
        <h2>33</h2>
        <a>view</a>
      </div>

      <div class="follow">
        <h2>Followers</h2>
        <h2>24</h2>
      </div>

<?php
      if (isset($_SESSION['u_id'])) {

        echo '<form action="include/logout.php" method="post">
              <button type="submit" name="submitLogout"><i class="fa fa-sign-out"></i><span> '.$_SESSION['u_name'].'</span></button>
              </form>';
      }
      else {
        echo '<form action="include/logout.php" method="post">
              <button type="submit" name="submitLogout"><i class="fa fa-sign-in"></i><span> Login</span></button>
              </form>';
      }

?>
    </nav>
    <!-- End Navigation -->
<?php
      if (isset($_SESSION['u_id'])) {
?>
    <main>

      <!-- Schedule -->
      <div class="schedule">
        <div id="sunday">
              <?php
  include 'include/schedule.php';
?>
        </div>
        <div id="monday">
              <?php
  include 'include/schedule.php';
?>
        </div>
        <div id="tuesday">
              <?php
  include 'include/schedule.php';
?>
        </div>
        <div id="wednesday">
              <?php
  include 'include/schedule.php';
?>
        </div>
        <div id="thursday">
              <?php
  include 'include/schedule.php';
?>
        </div>
        <div id="friday">
              <?php
  include 'include/schedule.php';
?>
        </div>
        <div id="saturday">
              <?php
  include 'include/schedule.php';
?>
        </div>
      </div>
      <!-- End Schedule -->

      <div class="flex">

        <!-- Find a Workout -->
        <div class="find">
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

        <!-- Leader Board -->
        <div class="leader">
<?php
  include 'include/admin.php';
?>
        </div>
        <!-- End Leader Board -->

      </div>

      <!-- Social Area -->
      <div class="social">

        <!-- Live Updates -->
        <aside>
          <h2>Live Update</h2>
          <div class="update">
            <div class="user_update">
              <p class="name"><span>Nick Simpson:</span> Added a new workout today! <a href="#">View</a>
              </p>
            </div>
          </div>
        </aside>
        <!-- End Live Updates -->

        <!-- Chat Box -->
        <div class="messenger">
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
        <aside>
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
      echo '<main><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</main></p>';
    }
?>
  </div>
</body>

</html>
