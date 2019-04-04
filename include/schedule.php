<?php

  // Call connection to database and functions
  include_once 'dbh.php';

  $userId = $_SESSION['u_id'];

  // Prepare SQL
  $sql = "SELECT wrk_name, w.type_id, t.type_id, type_name, wrk_sets, wrk_desc, user_id, day FROM workout_desc w LEFT JOIN workout_type t ON w.type_id = t.type_id WHERE user_id=? AND day=?;";

  $stmt = mysqli_stmt_init($conn);
  // Check if SQL connection fails
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo '<p>Connection error!</p>';
  }
  else {
    // Pass parameters and run inside the database
    mysqli_stmt_bind_param($stmt, 'ss', $userId, $day);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Check if get result from database.
    if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_assoc($result);

      $wrkName = $row['wrk_name'];
      $wrkType = $row['type_name'];
      $wrkSets = $row['wrk_sets'];
      $wrkDesc = $row['wrk_desc'];
      $wrkDay = $row['day'];

      echo '<div class="view_day">
              <p>'.$weekDay.'</p>
              <a href="#view">
              <img src="images/icon/'.$wrkType.'.png" alt="'.$wrkType.'">
              <div>
                <h4>'.$wrkType.'</h4>
              </div>
              </a>
            </div>';
    }
    else {
      echo '<div class="add_day">
              <p>'.$weekDay.'</p>
              <a href="#add">
                <h1>+</h1>
              </a>
            </div>';
    }
  }

//          <div class="rest_day">
//          <p>Sunday</p>
//            <h1>Rest</h1>
//          </div>
