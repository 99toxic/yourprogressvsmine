<?php

include_once 'dbh.php';

session_start();

    // Select from users and chat table
    $sql = 'SELECT u.user_id, c.user_id, u.user_name, c.chat_message, c.chat_timestamp FROM users u, chat c WHERE c.user_id = u.user_id ORDER BY c.chat_timestamp LIMIT 30';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {

        // Grab the message and image type.
        $theMessage = $row['chat_message'];
        $fileExt = 'jpg' or 'jpeg' or 'png' or 'gif';


        if (isset($_SESSION['u_id'])) {
          if ($_SESSION['u_id'] == $row['user_id']) {
          $message = '<div class="chat self"> <div class="user-photo">';
          $message .= '<a href="#userPic"><img src="uploads/'.$_SESSION['u_name'].'_profile.'.$fileExt.'" alt="'.$_SESSION['u_name'].'"></a></div>';
          $message .= '<p class="chat-message">'.$theMessage.'</p></div>';
        }
        else if ($_SESSION['u_id'] !== $row['user_id']) {
          $message = '<div class="chat friend"> <div class="user-photo">';
          $message .= '<a href="#userPic"><img src="uploads/'.$row['user_name'].'_profile.'.$fileExt.'" alt="'.$row['user_name'].'"></a></div>';
          $message .= '<p class="chat-message">'.$theMessage.'</p></div>';
        }

          echo $message;

        } else {
          echo '';
        }
      }
    } else {
      echo '<div class="chat self"><p class="chat-message">they are no messages!</p></div>';
    }
