<?php

	require 'functions.php';
	  if(isLogged()) {
	    if($_SESSION['logintype'] == 'STUDENT'){
	      $userid = $_SESSION['userid'];
	      $username = $_SESSION['username'];
	    }
	    else
	      header("Location: collegeProfile.php");
	  }
	  else{
	    header("Location: index.php");
	  }

	if($_SERVER["REQUEST_METHOD"] == "GET"){

		$id = $_GET['e_id'];
		$taken = "SELECT * FROM RESULT WHERE Result_Exam_ID = $id AND Result_Student_ID = $userid";
		try {
		 	$quer = $conn->query($taken);
		 } catch(PDOException $e){
		 	echo "error $e";
		 }
		 $dupl = $quer->fetchAll(PDO::FETCH_ASSOC);
		 echo count($dupl);

		 if(count($dupl) > 0){
		 	header("Location: examList.php");
		 }
		// $q = "SELECT Exam_Time FROM EXAM WHERE Exam_ID = $id";
		// try {
		//  	$res = $conn->query($q);
		//  } catch(PDOException $ex){
		//  	echo "error $ex";
		//  }
		//  $results = $res->fetchAll(PDO::FETCH_ASSOC);
		
		$name = $_GET['e_name'];
		$subj = $_GET['e_subject'];

		$_SESSION['e_id'] = $id;
		$_SESSION['e_name'] = $name;
		$_SESSION['e_subject'] = $subj;

		$num = 0;
		$_SESSION['q_no'] = 1;
		
		$answerArray = [];
		$_SESSION['answers'] = $answerArray;
	}
	else if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_SESSION['e_id'];
		$name = $_SESSION['e_name'];
		$subj = $_SESSION['e_subject'];

		$num = $_SESSION['q_no'];
		$_SESSION['q_no'] = $num + 1;

		$answerArray = $_SESSION['answers'];

		array_push($answerArray, $_POST['option']);

		$_SESSION['answers'] = $answerArray;
	}
	else{
		;
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
<h2><?php echo "$name"; ?></h2>

<div class="content">
  <a href="studentProfile.php">Home</a>

  <a href="examList.php">Upcoming exams</a>

  <!--<a href="editStudentProfile.php">Edit Profile</a>-->

  <a href="result.php">View Results</a>

  <a href="logout.php">logout</a>
</div>

<?php
	$q = "SELECT Question_ID, Question_Description, Question_Option1, Question_Option2, Question_Option3, Question_Option4 FROM QUESTION WHERE Question_Subject_ID = $subj";

	 try {
	 	$res = $conn->query($q);
	 } catch(PDOException $ex){
	 	echo "error $ex";
	 }
	 $results = $res->fetchAll(PDO::FETCH_ASSOC);
	 echo "<div class='reg'>";
	 if($num < count($results)){
	 	echo "<h4>";
	 	print_r($results[$num]['Question_Description']);
	 	echo "</h4>";
		$o1 = $results[$num]['Question_Option1'];
		$o2 = $results[$num]['Question_Option2'];
		$o3 = $results[$num]['Question_Option3'];
		$o4 = $results[$num]['Question_Option4'];
		$qid = $results[$num]['Question_ID'];

		echo "<form action='takeExam.php' method='POST'>";
			
			echo "<input type='radio' name='option' value='$o1'>" . $o1 . "</br>";

			echo "<input type='radio' name='option' value='$o2'>" . $o2 . "</br>";
			
			echo "<input type='radio' name='option' value='$o3'>" . $o3 . "</br>";
			
			echo "<input type='radio' name='option' value='$o4'>" . $o4 . "</br><br>";
			
			echo "<input type='submit' class='submit' name='$qid' value='Submit'><br><br>";

		echo "</form>";

		echo "<a href='registerAnswers.php'>Finish</a>";
	}
	else{
		echo "<a href='registerAnswers.php'>Finish</a>";
	}
	echo "</div>";
?>