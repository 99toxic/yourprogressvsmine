<?php

include_once 'dbh.php';
// Check if session has been started if not start session
if(!isset($_SESSION)) {
  session_start();
}
// Check if user clicked logout.
if ( isset( $_POST[ 'submitLogout' ] ) ) {

// Update when user logged out and return home
$userId = $_SESSION['u_id'];
$loginDetails = ("UPDATE users SET user_login = 0 WHERE user_id = '$userId'");
mysqli_query( $conn, $loginDetails );
header("Location: ../");
// distory session user
session_unset();
session_destroy();
}
