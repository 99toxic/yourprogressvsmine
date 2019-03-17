<?php

// Check if user clicked a submit button.
if ( isset( $_POST[ 'submit' ] ) ) {

  // Call connection to database and functions
  require 'dbh.php';
  include 'functions.php';

   session_start();

  $name = mysqli_real_escape_string( $conn, $_POST[ 'name' ] );
  $type = mysqli_real_escape_string( $conn, $_POST[ 'type' ] );
  $sets = mysqli_real_escape_string( $conn, $_POST[ 'sets' ] );
  $desc = mysqli_real_escape_string( $conn, $_POST[ 'desc' ] );

  $userId = $_SESSION['u_id'];
  $active = '1';

  $var = array($name, $desc);

  foreach ($var as $input);

    // Use error handler functions
  if (emptyFields($input) != true) {
    // Prepare SQL
    $sql = 'SELECT * FROM workout_desc WHERE wrk_name=?';
    $stmt = mysqli_stmt_init( $conn );
    // Check if SQL connection fails
    if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
      echo '<p>Connection failed One!</p>';
    }
    else {
      // Set all active workouts back to 0
      $oldActive = 'UPDATE workout_desc SET active=0 WHERE user_id='.$userId.'';
      mysqli_query( $conn, $oldActive );

      // Pass parameters and run inside the database
      mysqli_stmt_bind_param( $stmt, 's', $name );
      mysqli_stmt_execute( $stmt );
      mysqli_stmt_store_result( $stmt );
      $resultCheck = mysqli_stmt_num_rows( $stmt );
        // Insert the workout into the database
        $sql = 'INSERT INTO workout_desc (user_id, wrk_name, type_id, wrk_sets, wrk_desc, active) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = mysqli_stmt_init( $conn );
        // Check for another sql error
        if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
          echo '<p>Connection failed Two!</p>';
        }
          // Add workout
          mysqli_stmt_bind_param( $stmt, 'ssssss', $userId, $name, $type, $sets, $desc, $active );
          mysqli_stmt_execute( $stmt );

          exit();
      }
    }
}

// if submit not clicked send back to front page
else {
  header( 'Location: ../' );
  exit();
}
