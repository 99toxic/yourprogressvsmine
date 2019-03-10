<?php

include_once 'dbh.php';


 if (isset($_POST['message'])) {
  session_start();
  $chat = mysqli_real_escape_string( $conn, $_POST[ 'message' ] );
  $user = $_SESSION['u_id'];

  $sql = "INSERT INTO chat (user_id, chat_message) VALUES ('$user', '$chat');";
    mysqli_query( $conn, $sql );
  exit();

}
