<?php

  // Call connection to database and functions
  include_once 'dbh.php';

if(!isset($_SESSION)) {
  session_start();
}

  $userId = $_SESSION['u_id'];

  $day = mysqli_real_escape_string($conn, $_POST['day']);
  $weekDay = mysqli_real_escape_string($conn, $_POST['weekDay']);

  // Prepare SQL
  $sql = "SELECT w.wrk_id, wrk_name, w.type_id, t.type_id, type_name, wrk_sets, wrk_desc, user_id, day, exe_name, exe_equip, exe_sets, exe_reps, exe_time, e.wrk_id FROM workout_desc w LEFT JOIN workout_type t ON w.type_id = t.type_id LEFT JOIN exe_details e ON w.wrk_id = e.wrk_id WHERE user_id=? AND day=?;";

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
      $exeName = $row['exe_name'];
    $exeEquip = $row['exe_equip'];
    $exeSets = $row['exe_sets'];
    $exeReps = $row['exe_reps'];
    $exeTime = $row['exe_time'];

      echo '<div class="view">
      <div class="view_schedule">
        <div class="view-icon">
          <p>'.$weekDay.'</p>
          <img src="images/icon/'.$wrkType.'.png" alt="'.$wrkType.'">
          <div class="edit">
            <a href="#view">View</a> <a href="#">Edit</a>
          </div>
          <h4>'.$wrkType.'</h4>
        </div>
        <div class="view_content">
          <h2>'.$wrkName.'</h2>
          <p>'.$wrkDesc.'</p>
        </div>
      </div>
      <div class="workout">
        <table>
            <tr>
              <th></th>
              <th>Sets</th>
              <th>Reps</th>
              <th>Time</th>
            </tr>';

    while ($row = $result->fetch_assoc()) {
            echo '<tr>
              <td>'.$exeName.'</td>
              <td>'.$exeSets.'</td>
              <td>'.$exeReps.'</td>
              <td>'.$exeTime.'</td>
            </tr>';
    }
    echo '</table>
      </div>
    </div>';
    }
    else {
      echo '';
    }
  }

//          <div class="rest_day">
//          <p>Sunday</p>
//            <h1>Rest</h1>
//          </div>
