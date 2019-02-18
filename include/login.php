<?php

if ( isset( $_POST[ 'submit' ] ) ) {

  require 'dbh.php';
  include 'functions.php';

  $uid = mysqli_real_escape_string( $conn, $_POST[ 'uid' ] );
  $pwd = mysqli_real_escape_string( $conn, $_POST[ 'pwd' ] );

  $var = array($uid, $pwd);

  foreach ($var as $empty);

    if (emptyFields($empty) == false ) {

      // Prepare SQL
      $sql = "SELECT * FROM users WHERE user_name =? OR user_email =?;";
      $stmt = mysqli_stmt_init($conn);
      // Check if SQL connection fails
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo '<p>Connection error!</p>';
      }
      else {
        mysqli_stmt_bind_param($stmt, 'ss', $uid, $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        // Check if hashed password is correct
        if ($row = mysqli_fetch_assoc($result)) {
          $pwdCheck = password_verify($pwd, $row['user_pwd']);
          if ($pwdCheck == false) {
            echo '<p>Wrong Password!</p>';
          }
          else if ($pwdCheck == true) {

            // Insert info for login details here!

            // Sign user in
            session_start();
            $_SESSION[ 'u_id' ] = $row[ 'user_id' ];
            $_SESSION[ 'u_uid' ] = $row[ 'user_name' ];
            $_SESSION[ 'u_date' ] = $row[ 'user_date' ];
            $_SESSION[ 'u_goal' ] = $row[ 'user_goal' ];
            $_SESSION[ 'u_email' ] = $row[ 'user_email' ];
            header( "Location: ../profile.php" );
            exit();
          }
          else {
            echo '<p>Wrong Password!</p>';
          }
        }
        else {
            echo '<p>Wrong Username!</p>';
        }
      }
    }

}
else {
  header( "Location: ../" );
  exit();
}
