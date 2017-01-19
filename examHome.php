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
	$colg = $_SESSION['userid'];
	try {
	    $res = $conn->query("SELECT Branch_Name FROM BRANCH WHERE Branch_College_ID = '$colg'");
	} catch(PDOException $ex){
	    echo "error";
	}
	$branchList = [];
	$results = $res->fetchAll(PDO::FETCH_ASSOC);
	for($i=0; $i<count($results); $i++){
		$branchList[$i] =  $results[$i]['Branch_Name'];
	}

	try {
	   	$res = $conn->query("SELECT Subject_Name FROM SUBJECT");
	} catch(PDOException $ex){
	   	echo "error";
	}
	$subjectList = [];
	$results = $res->fetchAll(PDO::FETCH_ASSOC);
	for($i=0; $i<count($results); $i++){
		$subjectList[$i] =  $results[$i]['Subject_Name'];
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
	<a href="deleteExam.php">Delete an exam</a>
	<a href="logout.php">logout</a>
</div>

	<div class="reg">
	<form action="registerExam.php" method="POST">
		
		<input type="text" name="examName" placeholder="Exam Name" required></input><br>

		<select name="examBranch" required>
		<?php
		  foreach($branchList as $branch){
		     echo "<option value='$branch'>$branch</option>"; 
		    }
		  ?>
		</select><br><br>

		<select name="examSubject" required>
		<?php
		  foreach($subjectList as $subject){
		     echo "<option value='$subject'>$subject</option>"; 
		    }
		  ?>
		</select><br><br>

		<input type="submit" class="submit" value="Submit"></input>

	</form>
	</div>
</body>

</html>