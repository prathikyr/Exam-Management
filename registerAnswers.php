<?php

	require 'functions.php';
	  if(isLogged()) {
	    if($_SESSION['logintype'] == 'STUDENT'){
	      $userid = $_SESSION['userid'];
	      $user = $_SESSION['username'];
	    }
	    else
	      header("Location: collegeProfile.php");
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
<title>Exam</title>
</head>

<body>
<h2>Result</h2>

<div class="content">
  <a href="studentProfile.php">Home</a>

  <a href="examList.php">Upcoming exams</a>

  <!--<a href="editStudentProfile.php">Edit Profile</a>-->

  <a href="result.php">View Results</a>

  <a href="logout.php">logout</a>
</div>
<?php
	$ans = $_SESSION['answers'];
	$student = $_SESSION['userid'];
	$exam = $_SESSION['e_id'];
	$subj = $_SESSION['e_subject'];

	$q = "SELECT Question_Correct_Answer FROM QUESTION WHERE Question_Subject_ID = $subj";

	try {
	 	$res = $conn->query($q);
	} catch(PDOException $ex){
	 	echo "error $ex";
	}
	$results = $res->fetchAll(PDO::FETCH_ASSOC);

	$correct = 0;
	$total = count($results);

	for($i=0; $i < $total; $i++) {
		$correctAnswer = $results[$i]['Question_Correct_Answer'];
		$givenAnswer = $ans[$i];
		
		if($correctAnswer == $givenAnswer){
			$correct++;
		}
	}
	echo "<div class='reg'>";
	echo "$correct answers correct out of $total questions";
	echo "</div>";
	$q = "INSERT INTO RESULT VALUES ('', '$student', '$exam', '$subj', '$correct', '$total')"; 

	try {
	 	$res = $conn->query($q);
	} catch(PDOException $ex){
	 	echo "error $ex";
	}

?>