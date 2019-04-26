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
if ( isset( $_POST[ 'submit' ] ) ) {

  // Call connection to database and functions
  include_once 'dbh.php';
  include 'functions.php';

  // Fetch information from form.
  $uid = mysqli_real_escape_string( $conn, $_POST[ 'uid' ] );
  $pwd = mysqli_real_escape_string( $conn, $_POST[ 'pwd' ] );

  $var = array($uid, $pwd);

  foreach ($var as $empty);

    // Use error handler functions
    if (emptyFields($empty) !== true ) {

      // Prepare SQL
      $sql = "SELECT * FROM users WHERE user_name =? OR user_email =?;";
      $stmt = mysqli_stmt_init($conn);
      // Check if SQL connection fails
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo '<p>Connection error!</p> </br> <a href="../index.php">Go back</a>';
      }
      else {
        // Pass parameters and run inside the database
        mysqli_stmt_bind_param($stmt, 'ss', $uid, $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        // Check if get result from database.
        if ($row = mysqli_fetch_assoc($result)) {
          // Check if hashed password is correct
          $pwdCheck = password_verify($pwd, $row['user_pwd']);
          if ($pwdCheck == false) {
            echo '<p>Wrong Password!</p> </br> <a href="../index.php">Go back</a>';
          }
          else if ($pwdCheck == true) {

          // Insert when user loged in
          $userId = $row['user_id'];
          $loginDetails = ("UPDATE users SET user_login = now() WHERE user_id = '$userId'");
          mysqli_query( $conn, $loginDetails );

            // Sign user in
            $sqlDate = strtotime($row[ 'user_login' ]);
            $newDate = date('h:ia', $sqlDate);
            session_start();
            $_SESSION[ 'u_id' ] = $row[ 'user_id' ];
            $_SESSION[ 'u_name' ] = $row[ 'user_name' ];
            $_SESSION[ 'u_date' ] = $row[ 'user_date' ];
            $_SESSION[ 'u_email' ] = $row[ 'user_email' ];
            $_SESSION[ 'u_goal' ] = $row[ 'goal_id' ];
            $_SESSION[ 'u_login' ] = $newDate;
            $_SESSION[ 'u_level' ] = $row[ 'user_level' ];

            header( "Location: ../profile.php" );
            exit();
          }
          else {
            echo '<p>Wrong Password!</p> </br> <a href="../index.php">Go back</a>';
          }
        }
        else {
            echo '<p>Wrong Username!</p> </br> <a href="../index.php">Go back</a>';
        }
      }
    }
}
else {
  header( "Location: ../" );
  exit();
}
