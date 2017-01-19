<?php
	require 'functions.php';
	if(isLogged()) {
		if(isset($_SESSION['logintype']) && $_SESSION['logintype'] == 'COLLEGE'){
			header("Location: collegeProfile.php");
		}
	}
	else{
		header("Location: index.php");
	}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/newStyle.css">
<title>Student</title>
</head>

<body>
<h2>Welcome</h2>

<div class="content">
	<a href="examList.php">Upcoming exams</a>
	<a href="result.php">View Results</a>
	<a href="editProfile.php">Edit Profile</a>
	<a href="logout.php">logout</a>
</div>
</body>