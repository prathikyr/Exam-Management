<?php
  require 'functions.php';
  if(isLogged()) {
    redirect();
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/newStyle.css">
<title>studentlogin</title>

</head>
<body>

<h2>Student Login</h2>

<div class="content">
	<a href="index.php">Home</a>
	<a href="collegeLoginPage.php">College Login</a>
</div>


<div class="login">
	<h3>Login Credentials</h3>

	<form action="studentVerify.php" method="POST">

	<input type="text" name="studentUsername" placeholder="Username"><br>

	<input type="password" name="studentPassword" placeholder="Password"><br>

	<?php
	  if(isset($_SESSION['invalidStudent']) && $_SESSION['invalidStudent'] == 1)
	    echo "Username or Password is invalid<br>";
	?>

	<input type="submit" class="submit" value="login">

	</form>
</div>
</body></html>


