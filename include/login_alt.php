<?php

// Check if user clicked a submit button.
if ( isset( $_POST[ 'submit' ] ) ) {

  // Call connection to database and functions
  include_once 'dbh.php';
  include 'functions.php';

  // Fetch information from form.
  $uid = mysqli_real_escape_string( $conn, $_POST[ 'uid' ] );
  $pwd = mysqli_real_escape_string( $conn, $_POST[ 'pwd' ] );

  if ( empty( $uid ) || empty($pwd)) {
    header( "Location: ../?err=Please fill in all fields!" );
    exit();
  }
  else {
      // Prepare SQL
      $sql = "SELECT * FROM users WHERE user_name =? OR user_email =?;";
      $stmt = mysqli_stmt_init($conn);
      // Check if SQL connection fails
      if (!mysqli_stmt_prepare($stmt, $sql)) {
            header( "Location: ../?err=Sorry connection error" );
            exit();
      }
      else {
        // Pass parameters and run inside the database
        mysqli_stmt_bind_param($stmt, 'ss', $uid, $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        // Check if get result from database.
        if ($row = mysqli_fetch_assoc($result)) {
          // Check if hashed password is correct
          $pwdCheck = password_verify($pwd, $row['user_pwd']);
          if ($pwdCheck == false) {
            header( "Location: ../?err=Wrong Password!" );
            exit();
          }
          else if ($pwdCheck == true) {

          // Insert when user loged in
          $userId = $row['user_id'];
          $loginDetails = ("UPDATE users SET user_login = now() WHERE user_id = '$userId'");
          mysqli_query( $conn, $loginDetails );

            // Sign user in
            $sqlDate = strtotime($row[ 'user_login' ]);
            $newDate = date('h:ia', $sqlDate);
            session_start();
            $_SESSION[ 'u_id' ] = $row[ 'user_id' ];
            $_SESSION[ 'u_name' ] = $row[ 'user_name' ];
            $_SESSION[ 'u_date' ] = $row[ 'user_date' ];
            $_SESSION[ 'u_email' ] = $row[ 'user_email' ];
            $_SESSION[ 'u_goal' ] = $row[ 'goal_id' ];
            $_SESSION[ 'u_login' ] = $newDate;
            $_SESSION[ 'u_level' ] = $row[ 'user_level' ];

            header( "Location: ../profile.php" );
            exit();
          }
          else {
            header( "Location: ../?err=Wrong Password!" );
            exit();
          }
        }
        else {
            header( "Location: ../?err=Wrong Username!" );
            exit();
        }
      }
    }

}
else {
  header( "Location: ../" );
  exit();
}
