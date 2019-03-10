<?php

include_once 'dbh.php';

session_start();

// Insert when user loged out
$userId = $_SESSION['u_id'];
$loginDetails = ("UPDATE users SET user_login = 0 WHERE user_id = '$userId'");
mysqli_query( $conn, $loginDetails );

header("Location: ../");

session_unset();
session_destroy();
