<?php
	require 'functions.php';
	if(isLogged()) {
		if($_SESSION['logintype'] == 'STUDENT')
			$user = $_SESSION['username'];
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
<title>Exam List</title>
</head>

<body>
<h2>Exam List</h2>
<div class="content">
	<a href="studentProfile.php">Home</a>
	<a href="result.php">View Results</a>
	<a href="editProfile.php">Edit Profile</a>
	<a href="logout.php">logout</a>
</div>

<?php
	require 'db.php';

	$userid = $_SESSION['userid'];

	$colg = "SELECT Student_College, Student_Branch FROM STUDENT WHERE Student_ID = $userid";
	try {
		$res = $conn->query($colg);
	} catch(PDOException $ex){
		echo "error $ex";
	}
	$results = $res->fetchAll(PDO::FETCH_ASSOC);
	if(count($results) > 0){
		$id = $results[0]['Student_College'];
		$br = $results[0]['Student_Branch'];

		$q = "SELECT DISTINCT EXAM.Exam_ID, EXAM.Exam_Name, EXAM.Exam_Subject FROM EXAM, STUDENT WHERE EXAM.Exam_Conducting_College = STUDENT.Student_College AND EXAM.Exam_Branch = STUDENT.Student_Branch AND EXAM.Exam_Conducting_College = $id AND STUDENT.Student_Branch = $br";

		try {
			$res = $conn->query($q);
		} catch(PDOException $ex){
			echo "error $ex";
		}
		$results = $res->fetchAll(PDO::FETCH_ASSOC);

		echo "<table>";
		echo "<tr><th>Exam Name</th></tr>";
		
		foreach ($results as $row) {
			echo "<tr>";
			echo "<td><div class='tablelink'><a href='takeExam.php?e_id=$row[Exam_ID]&e_name=$row[Exam_Name]&e_subject=$row[Exam_Subject]'><span>$row[Exam_Name]</span></a></div></td>";
			echo "</tr>";
		}

		echo "</table>";
	}
	else{
		echo "No exams to display";
	}

?>