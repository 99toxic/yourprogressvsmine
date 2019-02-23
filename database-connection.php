<?php

define('SERVER', 'localhost');
define('USER', 'Nick');
define('PWD', 'ghostski');
define('DB', 'yourprogressvsmine');

$conn = mysqli_connect(SERVER, USER, PWD, DB);

// test the connection to database
if (!$conn) {
  die('Connection Failed:'.mysqli_connect_error());
}

$sql = "SELECT * FROM user_goal;";
$result = $conn->query($sql);


    echo '<h1>User Goals</h1>';

  while($row = $result->fetch_assoc()) {
    echo $row['goal_name'], '<br><br>';
  }

