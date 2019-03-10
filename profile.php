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
      <div class="overlay"><a href="#" class="close">X</a>
        <div id="add_tab">
          <div class="form-message"></div>
          <ul class="add_heading">
            <li class="desc-h"><a href="#desc_tab">Workout Description</a></li>
            <li class="details"><a href="#details_tab">Workout Details</a></li>
          </ul>
          <div id="desc_tab">
            <form action="include/workout-desc.php" method="post">
              <div class="add_top">
                <div class="name">
                  <h3>Name:</h3>
                  <input type="text" name="name">
                </div>
                <div class="type">
                  <h3>Type:</h3>
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
                <h3>Sets:</h3>
                <input type="text" name="sets">
              </div>
              <div class="desc">
                <h3>Description:</h3>
                <textarea id="desc" name="desc"></textarea>
              </div>
              <input type="submit" name="submit">
            </form>
          </div>
          <div id="details_tab">
            <form action="include/workout_detail.php" method="post">
              <div class="add_top">
                <div class="name">
                  <h3>Name:</h3>
                  <input type="text" name="name">
                </div>
                <div class="equipment">
                  <h3>Equipment:</h3>
                  <input type="text" name="equipment">
                </div>
              </div>
              <div class="setup">
                <div class="sets_two">
                  <h3>Sets:</h3>
                  <input type="text" name="sets">
                </div>
                <div class="reps">
                  <h3>Reps:</h3>
                  <input type="text" name="reps">
                </div>
                <div class="time">
                  <h3>Time:</h3>
                  <input type="text" name="time">
                </div>
                <input type="submit" name="submit">
              </div>
            </form>

            <div class="workout">
              <table>
                <tr>
                  <th></th>
                  <th>Sets</th>
                  <th>Reps</th>
                  <th>Time</th>
                  <th></th>
                </tr>
                <tr>
                  <td>Name of Exercise</td>
                  <td>5</td>
                  <td>12</td>
                  <td></td>
                  <td><a href="#">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>Name Of Exercise</td>
                  <td>3</td>
                  <td>10</td>
                  <td></td>
                  <td><a href="#">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>Name of Exercise</td>
                  <td>8</td>
                  <td></td>
                  <td>1:00</td>
                  <td><a href="#">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>Name of Exercise</td>
                  <td>2</td>
                  <td></td>
                  <td></td>
                  <td><a href="#">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>Name of Exercise</td>
                  <td>2</td>
                  <td></td>
                  <td></td>
                  <td><a href="#">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>Name of Exercise</td>
                  <td>2</td>
                  <td></td>
                  <td></td>
                  <td><a href="#">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>Name of Exercise</td>
                  <td>2</td>
                  <td></td>
                  <td></td>
                  <td><a href="#">Edit</a>
                  </td>
                </tr>
              </table>
            </div>
            <div class="done"><a>Done</a>
            </div>
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

      <div class="view">
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
        <div class="workout">
          <table>
            <tr>
              <th></th>
              <th>Sets</th>
              <th>Reps</th>
              <th>Time</th>
              <th></th>
            </tr>
            <tr>
              <td>Name of Exercise</td>
              <td>5</td>
              <td>12</td>
              <td></td>
              <td><a href="#">View</a>
              </td>
            </tr>
            <tr>
              <td>Name Of Exercise</td>
              <td>3</td>
              <td>10</td>
              <td></td>
              <td><a href="#">View</a>
              </td>
            </tr>
            <tr>
              <td>Name of Exercise</td>
              <td>8</td>
              <td></td>
              <td>1:00</td>
              <td><a href="#">View</a>
              </td>
            </tr>
            <tr>
              <td>Name of Exercise</td>
              <td>2</td>
              <td></td>
              <td></td>
              <td><a href="#">View</a>
              </td>
            </tr>
            <tr>
              <td>Name of Exercise</td>
              <td>2</td>
              <td></td>
              <td></td>
              <td><a href="#">View</a>
              </td>
            </tr>
            <tr>
              <td>Name of Exercise</td>
              <td>2</td>
              <td></td>
              <td></td>
              <td><a href="#">View</a>
              </td>
            </tr>
            <tr>
              <td>Name of Exercise</td>
              <td>2</td>
              <td></td>
              <td></td>
              <td><a href="#">View</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </header>

    <!-- Navigation -->
    <nav>
      <a class='mobile_btn'><i class="fa fa-bars"></i></a>

      <img src="images/icon/Strength.png" alt="">

      <div id="mobile_menu">
        <nav>
          <ul>
            <li>Find a workout</li>
            <li>Leader Board</li>
            <li>Live Updates</li>
            <li>Who's Online</li>
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

      <form action="include/logout.php" method="post">
        <button type="submit" name="submitLogout"><i class="fa fa-sign-out"></i><span>Logout</span></button>
      </form>
    </nav>
    <!-- End Navigation -->

    <main>

      <!-- Schedule -->
      <div class="schedule">
        <div id="sunday">
          <p>Sunday</p>
          <div class="rest_day">
            <h1>Rest</h1>
          </div>
        </div>
        <div id="monday">
          <div class="view_day">
            <p>Monday</p>
            <a href="#view">
              <img src="images/icon/Plyometrics.png" alt="">
              <div>
                <h4>Plyo</h4>
              </div>
            </a>
          </div>
        </div>
        <div id="tuesday">
          <div class="view_day">
            <p>Tuesday</p>
            <a href="#view">
              <img src="images/icon/Other.png" alt="">
              <div>
                <h4>Strength</h4>
              </div>
            </a>
          </div>
        </div>
        <div id="wednesday">
          <div class="view_day">
            <p>Wednesday</p>
            <a href="#view">
              <img src="images/icon/Cardio.png" alt="">
              <div>
                <h4>Cardio</h4>
              </div>
            </a>
          </div>
        </div>
        <div id="thursday">
          <div class="view_day">
            <p>Thursday</p>
            <a href="#view">
              <img src="images/icon/Abs.png" alt="">
              <div>
                <h4>Abs</h4>
              </div>
            </a>
          </div>
        </div>
        <div id="friday">
          <div class="view_day">
            <p>Friday</p>
            <a href="#view">
              <img src="images/icon/Stretching.png" alt="">
              <div>
                <h4>Stretch</h4>
              </div>
            </a>
          </div>
        </div>
        <div id="saturday">
          <div class="add_day">
            <p>Saturday</p>
            <a href="#add">
              <h1>+</h1>
            </a>
          </div>
        </div>
      </div>
      <!-- End Schedule -->

      <div class="flex">

        <!-- Find a Workout -->
        <div class="find">
          <h1>Find a Workout</h1>

          <div class="form-message">
            <p>Javascript Here!</p>
          </div>
          <form action="include/search.php" method="post">
            <div class="search_type">
              <div class="search">
                <label for="search">Search:</label>
                <input type="text" name="search">
              </div>
              <div class="type">
                <label for="type">Type:</label>
                <select name="type">
                  <option value="1">Strength</option>
                  <option value="2">Cardio</option>
                  <option value="3">Stretching</option>
                  <option value="4">Plyometrics</option>
                  <option value="5">Other</option>
                </select>
              </div>
            </div>
            <div class="submit"><input type="submit" name="submit" value="Search"></div>
          </form>
        </div>
        <!-- End User Info -->

        <!-- Leader Board -->
        <div class="leader">
          <h1>Leader Board</h1>
          <div class="score">
            <table>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Week</th>
                <th>Followers</th>
                <th></th>
              </tr>
              <tr>
                <td>1</td>
                <td>Ross Stevens</td>
                <td>45</td>
                <td>223</td>
                <td><a href="#">View</a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Jason Roberts</td>
                <td>55</td>
                <td>103</td>
                <td><a href="#">View</a>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Anna Nichole </td>
                <td>33</td>
                <td>44</td>
                <td><a href="#">View</a>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td>Nick Simpson</td>
                <td>2</td>
                <td>15</td>
                <td><a href="#">View</a>
                </td>
              </tr>
            </table>
          </div>
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
          <div class="chat-form">
            <textarea></textarea>
            <button id="btn">Submit</button>
          </div>
        </div>
        <!-- End Chat Box -->

        <!-- Who's Online -->
        <aside>
          <h2>Who's Online</h2>
          <div class="users">
            <?php
  include 'include/user-online.php';
?>
          </div>
        </aside>
        <!-- End Who's Online -->

      </div>
      <!-- End Social Area -->

    </main>

  </div>
</body>

</html>
