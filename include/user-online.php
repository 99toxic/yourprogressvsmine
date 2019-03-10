<?php

include_once 'dbh.php';

$sql = 'SELECT user_name, user_login FROM users';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {


    $sqlDate = strtotime($row[ 'user_login' ]);
    $fileExt = 'jpg' or 'jpeg' or 'png' or 'gif';
    $newDate = date('h:ia', $sqlDate);

    if ($row['user_login'] !== '0000-00-00 00:00:00') {
      echo '<div class="online">';
      echo '<div class="user-photo"><a href="#userPic"><img src="uploads/'.$row['user_name'].'_profile.'.$fileExt.'" alt="'.$row['user_name'].'"></a></div>';
      echo '<p class="name">'.$row['user_name'].'<span>('.$newDate.')<span></p>' ;
      echo '</div>';
    }
    else {
      echo '';
    }
  }
}
