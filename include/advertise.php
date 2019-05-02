<?php
// Check if get result from database.
include_once 'dbh.php';
// Check if user clicked a submit button.
if (isset($_POST['submit'])) {
  session_start();
  $file = $_FILES['file'];
  $url = $_POST['url'];

  // auto load http to url if need it
  $newUrl = parse_url($url);
  if (empty($newUrl['scheme'])) {
    $url = 'http://' . ltrim($url, '/');
}

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
      if ($fileSize < 10000000) {

        // Prepares database
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $userName = $_SESSION['u_name'];
        $userId = $_SESSION['u_id'];

        // insert admin url link to admin table
        $sqll = "SELECT * FROM admin WHERE user_id='$userId';";
        $result = mysqli_query($conn, $sqll);
        // If there is a url created update it to user input
        if (mysqli_num_rows($result) > 0) {
          $sqll = "UPDATE admin SET ad_url='$url' WHERE user_id='$userId';";
          mysqli_query( $conn, $sqll );
        }
        // If there is no url insert it
        else {
          $sqll = "INSERT INTO admin (user_id, ad_url) VALUES ('$userId', '$url');";
          mysqli_query( $conn, $sqll );
        }

        //Puts image in folder location
        $fileDestination = '../uploads/'.$userName.'_ad.png';
        move_uploaded_file($fileTmpName, $fileDestination);

          header("Refresh:0; url= ../profile.php" );
          header("Cache-Control: no-cache, must-revalidate");

      }
      // If file is too big let user know
      else {
        echo '<p>Your file is to big. Please try a different image.</p>';
             }
    }
    // If there was an error let user know
    else {
      echo '<p>There was an error uploading your file. Please try again.</p>';
    }
  }
  // If the filetype isn't right let user know
  else {
    echo '<p>You are not allowed to upload this filetype.</p>';
  }
}
