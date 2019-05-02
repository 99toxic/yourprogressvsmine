<?php
// Call connection to database
include_once 'dbh.php';
// Check if session has been started if not start session
if(!isset($_SESSION)) {
  session_start();
}
// if user is admin show upload input
if ($_SESSION['u_level'] == 1) {
  // Prepare SQL
  $sql = 'SELECT ad_url FROM admin WHERE user_id='.$_SESSION['u_id'].'';
  $result = mysqli_query($conn, $sql);
  // Check if get result from database.
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

      $url = $row['ad_url'];

      echo '<h1>Admin Area</h1>
            <form action="include/advertise.php" method="post" enctype="multipart/form-data">
              <input type="file" name="file">
              <input type="text" name="url" value="url for ad here!">
              <button type="submit" name="submit">Upload</button>
            </form>
            <p>Image width 250px</p>
            <a href="'.$url.'" target="_blank"><img class="admin_img" src="uploads/'.$_SESSION['u_name'].'_ad.png" alt="'.$_SESSION['u_name'].' advertisement"></a>';
    }
  }
  else {
    echo '<h1>Admin Area</h1>
            <form action="include/advertise.php" method="post" enctype="multipart/form-data">
              <input type="file" name="file">
              <input type="text" name="url" placeholder="url for ad here!">
              <button type="submit" name="submit">Upload</button>
            </form>
            <p>No url selected!</p></br>
            <img class="admin_img" src="uploads/'.$_SESSION['u_name'].'_ad.png" alt="'.$_SESSION['u_name'].' advertisement">';
  }
}
// if not admin then show advertisement from admin for users
else {
  // Prepare SQL
  $sql = 'SELECT u.user_id, a.user_id, u.user_name, a.ad_url FROM users u RIGHT JOIN admin a ON a.user_id = u.user_id WHERE user_level="1"';
  $result = mysqli_query($conn, $sql);
  // Check if get result from database.
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {


      $userName = $row['user_name'];
      $url = $row['ad_url'];

      echo '<a href="'.$url.'" class="advertise" target="_blank"><img class="advertise_img" src="uploads/'.$userName.'_ad.png" alt="'.$userName.' advertisement"></a>';

    }
  }
}
