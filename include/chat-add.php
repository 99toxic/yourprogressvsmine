<?php
// Call connection to database
include_once 'dbh.php';
// Check if user clicked a submit button.
if (isset($_POST['message'])) {
  session_start();
  // Fetch information from chat.
  $chat = mysqli_real_escape_string($conn, htmlspecialchars($_POST['message']));
  $user = $_SESSION['u_id'];
    // Insert message into chat
    $sql = "INSERT INTO chat (user_id, chat_message) VALUES ('$user', '$chat');";
      mysqli_query( $conn, $sql );
    exit();
}
