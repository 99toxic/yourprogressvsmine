<?php
  session_start();
  include_once 'include/dbh.php';

  $title = 'Your Progress VS Mine | 404';
  $javaScript = '';

  include 'header.php';
?>

<body id="error">
  <div class="wrapper">
  <main>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
			</div>
			<h2>We are sorry, Page not found!</h2>
			<p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
<?php if (isset($_SESSION['u_id'])) { ?>
			<a href="profile.php"><i class="fa fa-arrow-left"></i> Back To <?php echo $_SESSION['u_name']; ?>'s profile page</a>
<?php }else { ?>
            <a href="index.php"><i class="fa fa-arrow-left"></i> Back To Homepage</a>
<?php }?>
		</div>
	</div>
	</main>
  </div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
