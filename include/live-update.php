<?php
// Call connection to database
include_once 'dbh.php';
// Prepare SQL
$sql = 'SELECT user_name, u.user_id, w.user_id, wrk_name, w.type_id, t.type_id, type_name FROM users u RIGHT JOIN workout_desc w ON u.user_id = w.user_id LEFT JOIN workout_type t ON w.type_id = t.type_id ORDER BY wrk_id DESC LIMIT 30';
$result = mysqli_query($conn, $sql);
// Check if SQL connection fails
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {

    // Check image type
    $fileExt = 'jpg' or 'jpeg' or 'png' or 'gif';
  // if profile image exists show image in live updates
  if (file_exists('uploads/'.$row['user_name'].'_profile.jpg')) {
      echo '<div class="online">';
      echo '<div class="user-photo"><a href="#userPic"><img src="uploads/'.$row['user_name'].'_profile.'.$fileExt.'" alt="'.$row['user_name'].'"></a></div>';
      echo '<p class="name">'.$row['user_name'].' created a  new workout '.$row['wrk_name'].'</p>';
      echo '</div>';
  }
  // if profile image doesn't exists then show default profile image
  else {
    echo '<div class="online">';
      echo '<div class="user-photo"><a href="#userPic"><img src="uploads/profiledefault.png" alt="Default profile image for Your Progress vs Mine"></a></div>';
      echo '<p class="name">'.$row['user_name'].' created a  new workout '.$row['wrk_name'].'</p>';
      echo '</div>';
  }
  }
}
