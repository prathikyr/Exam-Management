<?php
	require 'functions.php';
	if(isLogged()) {
		if($_SESSION['logintype'] == 'STUDENT'){
			header("Location: studentProfile.php");
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
<title>Add Questions</title>
</head>

<body>

<h2>Add Questions</h2>
<div class="content">
	<a href="collegeProfile.php">Home</a>
	<a href="studentsList.php">Students List</a>
	<a href="logout.php">logout</a>
</div>
	<div class="que">
		<form action="registerQuestion.php" method='POST'>
			
			<input type="textarea" name="question" placeholder="Question Description" required></input><br>
			<input type="text" name="option1" placeholder="Option 1" required></input>
			<input type="text" name="option2" placeholder="Option 2" required></input><br>
			<input type="text" name="option3" placeholder="Option 3" required></input>
			<input type="text" name="option4" placeholder="Option 4" required></input><br>
			<input type="text" name="correctAnswer" placeholder="Correct Answer" required></input><br>
			<input type="submit" class="submit" value="Submit"></input>
		</form>

	</div>

</body>

</html>