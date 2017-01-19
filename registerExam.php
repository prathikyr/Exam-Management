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
<title>Conduct Exam</title>
</head>

<body>

<h2>Conduct Exam</h2>
<div class="content">
	<a href="collegeProfile.php">Home</a>
	<a href="studentsList.php">Students List</a>
	<a href="logout.php">logout</a>
</div>

<?php
		require 'db.php';

		$id = $_SESSION['userid'];
		$name = $_POST['examName'];
		
		$branch = $_POST['examBranch'];
		$br = "SELECT Branch_ID FROM BRANCH WHERE Branch_Name = '$branch'";
		try {
			$res = $conn->query($br);
		} catch(PDOException $ex){
			echo "error";
		}
		$results = $res->fetchAll(PDO::FETCH_ASSOC);
		$branchid = $results[0]['Branch_ID'];

		$subject = $_POST['examSubject'];
		$sb = "SELECT Subject_ID FROM SUBJECT WHERE Subject_Name = '$subject'";
		try {
			$res = $conn->query($sb);
		} catch(PDOException $ex){
			echo "error";
		}
		$results = $res->fetchAll(PDO::FETCH_ASSOC);
		$subjectid = $results[0]['Subject_ID'];		

		$q = "INSERT INTO EXAM VALUES ('', '$name', '$id', '$branchid', '$subjectid')";
		echo "<div class='reg'>";
		try {
			$res = $conn->query($q);
			$_SESSION['examBranch'] = $branchid;
			$_SESSION['examSubject'] = $subjectid;
			echo "<h3>Exam Registered Successfully</h3>";
			echo "<a href='addQuestions.php'>Add Questions</a>";

		} catch(PDOException $ex){
			echo "error";
		}
		echo "</div>";
?>