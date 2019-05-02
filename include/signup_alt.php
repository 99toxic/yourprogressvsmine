<?php

echo '<head>
  <title>Your Prgress VS Mine</title>
  <meta charset="utf-8">

  <!--Stylesheets-->
  <link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
  <link rel="stylesheet" href="../css/style.css" type="text/css">
  <!--End Stylesheets-->

  <!--Favicon-->
  <link href="../images/favicon.png" rel="icon" type="image/x-icon">
  <!--End Favicon-->

  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--End Font Awesome-->

  <!--Meta Tags-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Nicks Creative Design">
  <meta name="Description" content="Your Progress VS Mine is a fitness social platform where you can engage in conversation and compete for a leaderboard based on your progress and the number of workouts shared.">
  <!--End Meta Tags-->

  <!--Social Meta Tags-->
  <meta property="og:title" content="Your Progress VS Mine">
  <meta property="og:description" content="Your Progress VS Mine is a fitness social platform where you can engage in conversation and compete for a leaderboard based on your progress and the number of workouts shared.">
  <meta property="og:image" content="https://www.yourprogressvsmine.com/images/ypvm.jpg">
  <meta property="og:url" content="http://yourprogressvsmine.com">
  <meta name="twitter:card" content="Your Progress VS Mine">
  <!--End Social Meta Tags-->

  	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head><body><div id="wrapper">

<main>';

// Check if user clicked a submit button.
if (isset($_POST['submit'])) {

  // Call connection to database and functions
  include_once 'dbh.php'; //ask about include_once vs include vs require
  include 'functions.php';

  // Fetch information from form.
  $uid = mysqli_real_escape_string($conn, htmlspecialchars($_POST['uid']));
  $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
  $date = mysqli_real_escape_string($conn, htmlspecialchars($_POST['dob']));
  $goal = mysqli_real_escape_string($conn, htmlspecialchars($_POST['goal']));
  $pwd = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pwd']));
  $pwd_two = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pwd_two']));

  // convert date to mysql
  $dob = date('Y-m-d', strtotime($date));

    $var = array($uid, $email, $date, $pwd, $pwd_two);

    foreach ($var as $empty);



  if ( empty( $empty ) ) {
    echo '<p>Please fill in all fields!</p> </br> <a href="../signup.php">Go back</a>';
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]*$/', $uid)) {
    echo '<p>That was an invalid username and email!</p> </br> <a href="../signup.php">Go back</a>';
  }
  elseif ( !filter_var( $email, FILTER_VALIDATE_EMAIL) ) {
    echo '<p>That was an invalid email!</p> </br> <a href="../signup.php">Go back</a>';
  }
  elseif ( !preg_match( '/^[a-zA-Z0-9]*$/', $uid ) ) {
    echo '<p>That was an invalid username!</p> </br> <a href="../signup.php">Go back</a>';
  }
  elseif ( $pwd !== $pwd_two ) {
    echo '<p>Password does not match!</p> </br> <a href="../signup.php">Go back</a>';
  }
  else {

    // Prepare SQL
    $sql = 'SELECT user_name FROM users WHERE user_name=? OR user_email=?';
    $stmt = mysqli_stmt_init( $conn );
    // Check if SQL connection fails
    if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
      echo '<p>Connection failed One!</p> </br> <a href="../signup.php">Go back</a>';
    }
    else {
      // Pass parameters and run inside the database
      mysqli_stmt_bind_param( $stmt, 'ss', $uid, $email );
      mysqli_stmt_execute( $stmt );
      mysqli_stmt_store_result( $stmt );
      $resultCheck = mysqli_stmt_num_rows( $stmt );
      // Check if user is being used
      if ( $resultCheck > 0 ) {
        echo '<p>The username or email already exist!</p> </br> <a href="../signup.php">Go back</a>';
      }
      else {
        // Insert the user into the database
        $sql = 'INSERT INTO users (user_name, user_email, user_date, goal_id, user_pwd) VALUES(?, ?, ?, ?, ?)';
        $stmt = mysqli_stmt_init( $conn );
        // Check for another sql error
        if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
          echo '<p>Connection failed Two!</p> </br> <a href="../signup.php">Go back</a>';
        }
        else {
          // Hashing the password
          $hashedPwd = password_hash( $pwd, PASSWORD_DEFAULT );
          // Sign up the user
          mysqli_stmt_bind_param( $stmt, 'sssss', $uid, $email, $dob, $goal, $hashedPwd );
          mysqli_stmt_execute( $stmt );

            header( "Location: ../profile.php" );
            exit();
         }
      }
    }
      // mysqli_stmt_close( $stmt );
      mysqli_close( $conn );
  }
}


// if submit not clicked send back to front page
else {
  header( 'Location: ../' );
  exit();
}
