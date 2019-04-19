<?php

include_once 'dbh.php';

$sql = 'SELECT user_name, u.user_id, w.user_id, wrk_name, w.type_id, t.type_id, type_name FROM users u RIGHT JOIN workout_desc w ON u.user_id = w.user_id LEFT JOIN workout_type t ON w.type_id = t.type_id ORDER BY wrk_id DESC LIMIT 7';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {


    $fileExt = 'jpg' or 'jpeg' or 'png' or 'gif';

      echo '<div class="online">';
      echo '<div class="user-photo"><a href="#userPic"><img src="uploads/'.$row['user_name'].'_profile.'.$fileExt.'" alt="'.$row['user_name'].'"></a></div>';
      echo '<p class="name">'.$row['user_name'].' created a  new workout '.$row['wrk_name'].'</p>';
      echo '</div>';
  }
}
