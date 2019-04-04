<?php

// Call connection to database and functions
include_once 'dbh.php';
include_once 'functions.php';

if(!isset($_SESSION)) {
  session_start();
}

// Check what day user clicked to submit.
if ( isset( $_POST[ 'sunday' ] ) ) {
  $day = '1';
}
if ( isset( $_POST[ 'monday' ] ) ) {
  $day = '2';
}
if ( isset( $_POST[ 'tuesday' ] ) ) {
  $day = '3';
}
if ( isset( $_POST[ 'wednesday' ] ) ) {
  $day = '4';
}
if ( isset( $_POST[ 'thursday' ] ) ) {
  $day = '5';
}
if ( isset( $_POST[ 'friday' ] ) ) {
  $day = '6';
}
if ( isset( $_POST[ 'saturday' ] ) ) {
  $day = '7';
}

// Check if user clicked a submit button.
if ( isset( $_POST[ 'sunday' ] ) || isset( $_POST[ 'monday' ] ) || isset( $_POST[ 'tuesday' ] ) || isset( $_POST[ 'wednesday' ] ) || isset( $_POST[ 'thursday' ] ) || isset( $_POST[ 'friday' ] ) || isset( $_POST[ 'saturday' ] ) ) {

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
    $sql = 'SELECT * FROM workout_desc WHERE user_id=? AND day=?';
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
      mysqli_stmt_bind_param( $stmt, 'ss', $userId, $day );
      mysqli_stmt_execute( $stmt );
      mysqli_stmt_store_result( $stmt );
      $resultCheck = mysqli_stmt_num_rows( $stmt );
        // Check if the day user submits has workout and update
      if ( $resultCheck > 0 ) {
        $sql = "UPDATE workout_desc SET user_id=?, wrk_name=?, type_id=?, wrk_sets=?, wrk_desc=?, active=?, day=? WHERE user_id='$userId' AND day='$day';";
      }
      else {
        // if workout e doesnt exist then insert a new workout into the database
        $sql = 'INSERT INTO workout_desc (user_id, wrk_name, type_id, wrk_sets, wrk_desc, active, day) VALUES (?, ?, ?, ?, ?, ?, ?)';
      }
        $stmt = mysqli_stmt_init( $conn );
        // Check for another sql error
        if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
          echo '<p>Connection failed Two!</p>';
        }
          // Add workout
          mysqli_stmt_bind_param( $stmt, 'sssssss', $userId, $name, $type, $sets, $desc, $active, $day );
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

