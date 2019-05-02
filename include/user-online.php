<?php
// Call connection to database
include_once 'dbh.php';
// Prepare SQL
$sql = 'SELECT user_name, user_login FROM users ORDER BY user_login';
$result = mysqli_query($conn, $sql);
// Check if get result from database.
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {

    $sqlDate = strtotime($row[ 'user_login' ]);
    $newDate = date('m/d/Y h:ia', $sqlDate);
    $fileExt = 'jpg' or 'jpeg' or 'png' or 'gif';

    $newDate = date ('h:ia', $sqlDate);
    // Check if user is logged in, has a profile image and display image and time if it's today's date
    if ($row['user_login'] !== '0000-00-00 00:00:00' && file_exists('../uploads/'.$row['user_name'].'_profile.'.$fileExt) && date('Y-m-d', $sqlDate) == date('Y-m-d')) {
      echo '<div class="online">';
      echo '<div class="user-photo"><a href="#userPic"><img src="uploads/'.$row['user_name'].'_profile.'.$fileExt.'" alt="'.$row['user_name'].'"></a></div>';
      echo '<p class="name">'.$row['user_name'].'<span>('.$newDate.')</span></p>' ;
      echo '</div>';
    }
    // if user does not have profile image display with default image instead
    else if ($row['user_login'] !== '0000-00-00 00:00:00' && date('Y-m-d', $sqlDate) == date('Y-m-d')) {
      echo '<div class="online">';
      echo '<div class="user-photo"><a href="#userPic"><img src="uploads/profiledefault.png" alt="Default profile image for Your Progress vs Mine"></a></div>';
      echo '<p class="name">'.$row['user_name'].'<span>('.$newDate.')</span></p>' ;
      echo '</div>';
    }
    // if user is not online or it's been longer than a day display nothing
    else {
      echo '';
    }
  }
}
