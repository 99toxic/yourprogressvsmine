<?php

include_once 'dbh.php';

if(!isset($_SESSION)) {
  session_start();
}

$url = '../www.google.com';

if ($_SESSION['u_level'] == 1) {
  echo '<h1>Admin Area</h1>
        <form action="include/advertise.php" method="post" enctype="multipart/form-data">
          <input type="file" name="file">
          <input type="text" name="url" value="url for ad here!">
          <button type="submit" name="submit">Upload</button>
        </form>
        <p>Image width 250px</p></br>
        <a href="'.$url.'"><img class="admin_img" src="sponsor/'.$_SESSION['u_name'].'_ad.png" alt="'.$_SESSION['u_name'].' advertisement"></a>';
}
else {

  $sql = 'SELECT user_name FROM users WHERE user_level="1"';
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {


      $userName = $row['user_name'];

      echo '<a href="'.$url.'" class="advertise"><img class="advertise_img" src="sponsor/'.$userName.'_ad.png" alt="'.$userName.' advertisement"></a>';

    }
  }
}
