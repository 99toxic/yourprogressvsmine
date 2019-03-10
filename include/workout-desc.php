<?php

// Check if user clicked a submit button.
if ( isset( $_POST[ 'submit' ] ) ) {

  // Call connection to database and functions
  require 'dbh.php';
  include 'functions.php';

  $name = mysqli_real_escape_string( $conn, $_POST[ 'name' ] );
  $type = mysqli_real_escape_string( $conn, $_POST[ 'type' ] );
  $sets = mysqli_real_escape_string( $conn, $_POST[ 'sets' ] );
  $desc = mysqli_real_escape_string( $conn, $_POST[ 'desc' ] );

  $var = array($name, $desc);

  foreach ($var as $input);

    // Use error handler functions
    if (emptyFields($input) != true) {
      //Insert the user workout into the database
      $sql = "INSERT INTO workout_desc (wrk_name, type_id, wrk_sets, wrk_desc) VALUES ('$name', '$type', '$sets', '$desc');";
      mysqli_query( $conn, $sql );
      exit();
    }

}
