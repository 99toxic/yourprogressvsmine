<?php
  session_start();
  include_once 'include/dbh.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Your Progress VS Mine</title>
  <meta charset="utf-8">

  <!--Stylesheets-->
  <link rel="stylesheet" href="css/jquery-ui.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <!--End Stylesheets-->

  <!--Favicon-->
  <link href="php/img/favicon.ico" rel="icon" type="image/x-icon">
  <!--End Favicon-->

  <!--Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--End Font Awesome-->

  <!--JavaScript-->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.validate.js"></script>
  <script src="js/main.js"></script>
  <!--JavaScript-->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Nick's Creative Design">
  <meta name="Description" content="A short description goes here">
</head>

<body id="profile">
  <!--Floating Add Image Form-->
  <div class="container" id="userPic">
    <form action="include/upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file">
      <button type="submit" name="submit">Upload</button>
    </form>
  </div>
  <!--End Floating Add Image Form-->
  <div id="wrapper">
    <header>
      <?php
  $fileExt = 'jpg' or 'jpeg' or 'png' or 'gif';
  if (isset($_SESSION['u_id'])) {
    echo '<a href="#userPic"><img class="profile_img" src="uploads/'.$_SESSION['u_name'].'_profile.'.$fileExt.'" alt="'.$_SESSION['u_name'].'"></a>';
  } else {
    echo '<img class="profile_img" src="uploads/profiledefault.png" alt="">';
  }
?>
    </header>
    <main>
      <form action="include/logout.php" method="post">
        <button type="submit" name="submitLogout"><i class="fa fa-sign-out"></i> Logout</button>
      </form>
    </main>

  </div>
</body>

</html>
