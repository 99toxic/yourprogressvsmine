<?php

include_once 'dbh.php';

if(!isset($_SESSION)) {
  session_start();
}

    // Select from users and chat table
    $sql = 'SELECT u.user_id, c.user_id, u.user_name, c.chat_message, c.chat_timestamp FROM users u, chat c WHERE c.user_id = u.user_id ORDER BY c.chat_timestamp DESC';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {

        // Grab the message and image type.
        $theMessage = $row['chat_message'];
        $fileExt = 'jpg' or 'jpeg' or 'png' or 'gif';
        $sqlDate = strtotime($row[ 'chat_timestamp' ]);

        if (date ('Y-m-d', $sqlDate) == date('Y-m-d')) {
          $newDate = date ('h:ia', $sqlDate);
        }
        else {
          $newDate = date('m/d/Y h:ia', $sqlDate);
        }

        // Message from Session user
        if (isset($_SESSION['u_id'])) {
            if ($_SESSION['u_id'] == $row['user_id'] & file_exists('../uploads/'.$row['user_name'].'_profile.'.$fileExt)) {
            $message = '<div class="chat self"> <div class="user-photo">';
            $message .= '<a href="#userPic"><img src="uploads/'.$_SESSION['u_name'].'_profile.'.$fileExt.'" alt="'.$_SESSION['u_name'].'"></a></div>';
            $message .= '<p class="chat-message">'.$theMessage.' <span>('.$newDate.')</span></p></div>';
          }
          else if ($_SESSION['u_id'] == $row['user_id']) {
            $message = '<div class="chat self"> <div class="user-photo">';
            $message .= '<a href="#userPic"><img src="uploads/profiledefault.png" alt="Default profile image for Your Progress vs Mine"></a></div>';
            $message .= '<p class="chat-message">'.$theMessage.' <span>('.$newDate.')</span></p></div>';
          }
        // Message from other users
        else if ($_SESSION['u_id'] !== $row['user_id'] & file_exists('../uploads/'.$row['user_name'].'_profile.'.$fileExt)) {
          $message = '<div class="chat friend"> <div class="user-photo">';
          $message .= '<a href="#userPic"><img src="uploads/'.$row['user_name'].'_profile.'.$fileExt.'" alt="'.$row['user_name'].'"></a></div>';
          $message .= '<p class="chat-message">'.$theMessage.' <span>('.$newDate.')<span></p></div>';
        }
        else if ($_SESSION['u_id'] !== $row['user_id']) {
          $message = '<div class="chat friend"> <div class="user-photo">';
          $message .= '<a href="#userPic"><img src="uploads/profiledefault.png" alt="Default profile image for Your Progress vs Mine"></a></div>';
          $message .= '<p class="chat-message">'.$theMessage.' <span>('.$newDate.')<span></p></div>';
        }

          echo $message;

        } else {
          echo '';
        }
      }
    } else {
      echo '<div class="chat self"><p class="chat-message">they are no messages!</p></div>';
    }
