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
<title>Home</title>
</head>
<body>

	<h2>Welcome Guest!</h2>

	<div class="content">
		<a href="login.php">Log in</a>
		<a href="studentReg.php">Student Registration</a>
		<a href="collegeReg.php">College Registration</a>
	</div>

<br><br>
<p class="text" align="justify">The Online Examination System gives the platform to conduct exams online for students. The colleges should register and they can update their examination details like question paper,
answers and all. The students have to register their names under their respective colleges and
they can take exams. They can view their results as well. This system contains almost everything
present in the manual examination system.</p>


</body></html>