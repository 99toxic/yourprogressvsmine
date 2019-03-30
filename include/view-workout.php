<?php

include_once 'dbh.php';

if(!isset($_SESSION)) {
  session_start();
}

$userId = $_SESSION['u_id'];

$sqll = 'SELECT wrk_id FROM workout_desc WHERE active=1 AND user_id='.$userId.'';
$result = $conn->query($sqll);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $wrkId = $row['wrk_id'];
  }

  $sql = 'SELECT * FROM exe_details WHERE wrk_id='.$wrkId.'';
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    echo '<table>
            <tr>
              <th></th>
              <th>Sets</th>
              <th>Reps</th>
              <th>Time</th>
              <th></th>
            </tr>';

    while ($row = mysqli_fetch_assoc($result)) {

      $exeName = $row['exe_name'];
      $exeEquip = $row['exe_equip'];
      $exeSets = $row['exe_sets'];
      $exeReps = $row['exe_reps'];
      $time = $row['exe_time'];

      $sqlDate = strtotime($time);
      $exeTime = date('i:s', $sqlDate);

      echo '<tr>
              <td>'.$exeName.'</td>
              <td>'.$exeSets.'</td>
              <td>'.$exeReps.'</td>
              <td>'.$exeTime.'</td>
              <td><a href="#">Edit</a>
              </td>
            </tr>';

    }
    echo '</table>';
  }

}
else {
  echo '<h2>No workouts Created!</h2>';
}
