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
<title>collegelogin</title>
</head>
<body>

        
<h2>College Login</h2>

<div class="content">
	<a href="index.php">Home</a>
	<a href="studentLoginPage.php">Student login</a>
</div>

<div class="login">
	<h3>Login Credentials</h3>

	<form action="collegeVerify.php" method="POST">

	<input type="text" name="collegeUsername" placeholder="Username"><br>

	<input type="password" name="collegePassword" placeholder="Password"><br>

	<?php
	  if(isset($_SESSION['invalidCollege']) && $_SESSION['invalidCollege'] == 1)
	    echo "Username or Password is invalid<br>";
	?>

	<input type="submit" class="submit" value="login">

	</form>

</div>
</body>
</html>


