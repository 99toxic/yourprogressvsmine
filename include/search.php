<?php

// Check if user clicked a submit button.
if ( isset( $_POST[ 'submit' ] ) ) {

  // Call connection to database and functions
  include_once 'dbh.php';
  include 'functions.php';

  // Fetch information from form.
  $search = mysqli_real_escape_string( $conn, $_POST['search'] );
  $type = mysqli_real_escape_string( $conn, $_POST['type'] );

  // Prepare SQL
  $sql = "SELECT w.user_id, wrk_name, w.type_id, wrk_sets, wrk_desc, u.user_id, user_name, t.type_id, type_name FROM workout_desc w LEFT JOIN users u ON w.user_id = u.user_id LEFT JOIN workout_type t ON w.type_id = t.type_id WHERE wrk_name=? AND w.type_id=? ORDER BY wrk_name;";

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

      echo '<table>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Sets</th>
                <th>Description</th>
                <th>By</th>
                <th></th>
              </tr>';

  while ($row = mysqli_fetch_assoc($result)) {
      $wrkName = $row['wrk_name'];
      $wrkType = $row['type_name'];
      $wrkSets = $row['wrk_sets'];
      $wrkDesc = $row['wrk_desc'];
      $userName = $row['user_name'];

      echo '<tr>
              <td>'.$wrkName.'</td>
              <td>'.$wrkType.'</td>
              <td>'.$wrkSets.'</td>
              <td>'.$wrkDesc.'</td>
              <td>'.$userName.'</td>
              <td><a href="#">View</a></td>
            </tr>';
    }
    echo '</table>';
  }
  else {
    // Prepare SQL
    $sql = "SELECT w.user_id, wrk_name, w.type_id, wrk_sets, wrk_desc, u.user_id, user_name, t.type_id, type_name FROM workout_desc w LEFT JOIN users u ON w.user_id = u.user_id LEFT JOIN workout_type t ON w.type_id = t.type_id WHERE w.type_id=$type ORDER BY wrk_name;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

      echo '<table>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Sets</th>
                <th>Description</th>
                <th>By</th>
                <th></th>
              </tr>';

      while ($row = mysqli_fetch_assoc($result)) {
              $wrkName = $row['wrk_name'];
      $wrkType = $row['type_name'];
      $wrkSets = $row['wrk_sets'];
      $wrkDesc = $row['wrk_desc'];
      $userName = $row['user_name'];

      echo '<tr>
              <td>'.$wrkName.'</td>
              <td>'.$wrkType.'</td>
              <td>'.$wrkSets.'</td>
              <td>'.$wrkDesc.'</td>
              <td>'.$userName.'</td>
              <td><a href="#">View</a></td>
            </tr>';
      }

      echo '</table>';
  }
  else {
    echo '<p>Sorry that type of workout has not been created yet!</p>';
  }
  }
}}
