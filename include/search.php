<?php

// Check if user clicked a submit button.
if ( isset( $_POST[ 'submit' ] ) ) {

  // Call connection to database and functions
  require 'dbh.php';
  include 'functions.php';

  // Fetch information from form.
  $search = mysqli_real_escape_string( $conn, $_POST['search'] );
  $type = mysqli_real_escape_string( $conn, $_POST['type'] );

  // Prepare SQL
  $sql = "SELECT w.user_id, wrk_name, type_id, wrk_sets, wrk_desc, u.user_id, user_name FROM workout_desc w LEFT JOIN users u ON w.user_id = u.user_id WHERE wrk_name=? OR type_id=?;";
  $stmt = mysqli_stmt_init($conn);
  // Check if SQL connection fails
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo '<p>Connection error!</p>';
  }
  else {
    // Pass parameters and run inside the database
    mysqli_stmt_bind_param($stmt, 'ss', $search, $type);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Check if get result from database.
    if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
      $wrkName = $row['wrk_name'];
      $wrkType = $row['type_id'];
      $wrkSets = $row['wrk_sets'];
      $wrkDesc = $row['wrk_desc'];
      $userName = $row['user_name'];

      $table = '<tr>
                  <td>'.$wrkName.'</td>
                  <td>'.$wrkType.'</td>
                  <td>'.$wrkSets.'</td>
                  <td>'.$wrkDesc.'</td>
                  <td>'.$userName.'</td>
                  <td><a href="#">View</a></td>
                </tr>';

      echo $table;
    }
  }
  else {
    echo 'Sorry no results found!';
  }
  }
}
