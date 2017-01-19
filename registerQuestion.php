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

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		header("Location : index.php");
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

<?php
		require 'db.php';

		$colg = $_SESSION['userid'];
		$branch = $_SESSION['examBranch'];
		$subject = $_SESSION['examSubject'];
		$qd = $_POST['question'];
		$o1 = $_POST['option1'];
		$o2 = $_POST['option2'];
		$o3 = $_POST['option3'];
		$o4 = $_POST['option4'];
		$co = $_POST['correctAnswer'];

		$q = "INSERT INTO QUESTION VALUES ('', '$colg', '$branch', '$subject', '$qd', '$o1', '$o2', '$o3', '$o4', '$co')";
		echo "<div class='reg'>";
		try {
			$res = $conn->query($q);
			echo "<h3>Question added successfully</h3>";
			echo "<a href='addQuestions.php'>Add another question</a><br><br>";
			echo "<a href='collegeProfile.php'>Finish adding questions</a>";
		} catch(PDOException $ex){
			echo "error $ex";
		}
		echo "</div";
?>

