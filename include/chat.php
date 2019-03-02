<?php

include_once 'dbh.php';

if (isset($_POST['message'])) {
  session_start();
  $chat = $_POST['message'];
  $user = $_SESSION['u_id'];

  $sql = "INSERT INTO chat (user_id, chat_message) VALUES ('$user', '$chat');";
    mysqli_query( $conn, $sql );

}

    $sql = 'SELECT * FROM chat LIMIT 30';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {

        $theMessage = $row['chat_message'];

        if (isset($_SESSION['u_id'])) {
          if ($_SESSION['u_id'] == $row['user_id']) {
          $message = '<div class="chat self"> <div class="user-photo">';
          //Gets users profile Picture
          $message .= '<a href="#userPic"><img src="uploads/'.$_SESSION['u_name'].'_profile.'.$fileExt.'" alt="'.$_SESSION['u_name'].'"></a></div>';
          $message .= '<p class="chat-message">'.$theMessage.'</p></div>';
        } else {
            $message = '<div class="chat friend">
          <div class="user-photo"><a href="#userPic"><img src="uploads/'.$_SESSION['u_name'].'_profile.'.$fileExt.'" alt="'.$_SESSION['u_name'].'"></a>
          </div>
          <p class="chat-message">'.$theMessage.'</p>
          </div>';
          }
        } else {
          echo '<div class="chat self"><p class="chat-message">You are not logged in!</p></div>';
        }
      }
    } else {
      echo '<div class="chat self"><p class="chat-message">they are no messages!</p></div>';
    }
