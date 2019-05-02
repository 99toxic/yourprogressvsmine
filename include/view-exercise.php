<?php
// Call connection to database
include_once 'dbh.php';
// Check if session has been started if not start session
if(!isset($_SESSION)) {
  session_start();
}
// Check if user clicked a submit button.
if ( isset( $_POST[ 'submit' ] ) ) {

  $wrkId = $_POST['wrkid'];
  // Prepare SQL
  $sql = "SELECT w.wrk_id, wrk_name, w.type_id, wrk_sets, wrk_desc, day, e.wrk_id, exe_name, exe_equip, exe_sets, exe_reps, exe_time, t.type_id, type_name FROM workout_desc w LEFT JOIN exe_details e ON w.wrk_id = e.wrk_id LEFT JOIN workout_type t ON w.type_id = t.type_id WHERE w.wrk_id=$wrkId;";
  // Check if get result from database.
  $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);

    $wrkName = $row['wrk_name'];
    $type = $row['type_name'];
    $wrkSets = $row['wrk_sets'];
    $wrkDesc = $row['wrk_desc'];
    $wrkDay = $row['day'];
    $exeName = $row['exe_name'];
    $exeEquip = $row['exe_equip'];
    $exeSets = $row['exe_sets'];
    $exeReps = $row['exe_reps'];
    $exeTime = $row['exe_time'];

    echo '<div class="view_schedule">
        <div class="view-icon">
          <p>'.$wrkDay.'</p>
          <img src="images/icon/'.$type.'.png" alt="'.$type.'">
          <h4>'.$type.'</h4>
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
            </tr>
            <tr>
              <td>'.$exeName.'</td>
              <td>'.$exeSets.'</td>
              <td>'.$exeReps.'</td>
              <td>'.$exeTime.'</td>
            </tr>
            </table>
      </div>';
}
else {
    echo "Not working!";
}
