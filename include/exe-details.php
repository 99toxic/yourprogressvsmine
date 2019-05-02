<?php

if ( isset( $_POST[ 'submit' ] ) ) {

  // Call connection to database and functions
  include_once 'dbh.php';
  include 'functions.php';
  // if user is admin show upload input
  if(!isset($_SESSION)) {
  session_start();
  }
  // Fetch information from form.
  $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST[ 'name' ]));
  $equip = mysqli_real_escape_string($conn, htmlspecialchars($_POST[ 'equip' ]));
  $sets = mysqli_real_escape_string($conn, htmlspecialchars($_POST[ 'sets' ]));
  $reps = mysqli_real_escape_string($conn, htmlspecialchars($_POST[ 'reps' ]));
  $time = mysqli_real_escape_string($conn, htmlspecialchars($_POST[ 'time' ]));

  $userId = $_SESSION['u_id'];
  // Prepare SQL
  $sqll = 'SELECT wrk_id FROM workout_desc WHERE active=1 AND user_id='.$userId.'';
  $result = $conn->query($sqll);
  // Check if get result from database.
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $wrkId = $row['wrk_id'];
    }
  }

  $var = array($name);

  foreach ($var as $empty);

  // Use error handler functions
  if (emptyFields($empty) != true) {

    // Prepare SQL
    $sql = 'SELECT * FROM exe_details WHERE exe_name=?';
    $stmt = mysqli_stmt_init( $conn );
    // Check if SQL connection fails
    if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
      echo '<p>Connection failed One!</p>';
    }
    else {
      // Pass parameters and run inside the database
      mysqli_stmt_bind_param( $stmt, 's', $name );
      mysqli_stmt_execute( $stmt );
      mysqli_stmt_store_result( $stmt );
      $resultCheck = mysqli_stmt_num_rows( $stmt );
        // Insert the workout into the database
        $sql = 'INSERT INTO exe_details (wrk_id, exe_name, exe_equip, exe_sets, exe_reps, exe_time) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = mysqli_stmt_init( $conn );
        // Check for another sql error
        if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
          echo '<p>Connection failed Two!</p>';
        }
          // Add workout
          mysqli_stmt_bind_param( $stmt, 'ssssss', $wrkId, $name, $equip, $sets, $reps, $time );
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
