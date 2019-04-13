<?php

 require 'dbh.php';

if (isset($_POST['submit'])) {
  session_start();
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  // Gets the image extension
  $fileExt = explode('.',$fileName);
  $fileActualExt = strtolower(end($fileExt));

  // Checks for image type
  $allowed = array('jpg', 'jpeg', 'png', 'gif');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {

      // Checks for file size
      if ($fileSize < 1000000) {

        // Prepares database
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $userName = $_SESSION['u_name'];
        $userLevel = $_SESSION['u_level'];

        //Puts image in folder location
        $fileDestination = '../uploads/'.$userName.'_profile.jpg';
        move_uploaded_file($fileTmpName, $fileDestination);

          header("Refresh:0; url= ../profile.php" );
          header("Cache-Control: no-cache, must-revalidate");

      } else {
        echo '<p>Your file is to big. Please try a different image.</p>';
             }
    } else {
      echo '<p>There was an error uploading your file. Please try again.</p>';
    }
  } else {
    echo '<p>You are not allowed to upload this filetype.</p>';
  }
}
