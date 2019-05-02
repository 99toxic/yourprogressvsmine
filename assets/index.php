<!DOCTYPE html>
<html lang="en">

<head>
  <title>Your Progress VS Mine | Assets</title>
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

  <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body id="assets">
  <div id="wrapper">
    <main>
      <ul class="assets">
        <li><a href="media-sources.docx" target="_blank">Media Sources</a></li>
        <li><a href="dbw.jpg" target="_blank">Database Wireframe</a></li>
        <li><a href="database-final.sql" target="_blank">Database Script</a></li>
        <li><a href="directory-wireframe.txt" target="_blank">Directory Wireframe</a></li>
        <li><a href="original-unedited-artwork" target="_blank">Original Unedited Artwork</a></li>
      </ul>
        <?php if (isset($_SESSION['u_id'])) { ?>
          <a href="../profile.php"><i class="fa fa-arrow-left"></i> Back To <?php echo $_SESSION['u_name']; ?>'s profile page</a>
        <?php }else { ?>
          <a href="../index.php"><i class="fa fa-arrow-left"></i> Back To Homepage</a>
        <?php }?>
    </main>
  </div>
</body>
