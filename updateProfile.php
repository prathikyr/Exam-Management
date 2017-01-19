<?php
	require 'functions.php';
	if(isLogged()) {
		if($_SESSION['logintype'] == 'STUDENT'){
			$user = $_SESSION['username'];
		}
		else
			header("Location: collegeProfile.php");
	}
	else{
		header("Location: index.php");
	}


	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$sname = $_POST['studentName'];
		$sreg = $_POST['studentRegNum'];
		$sbranch = $_POST['studentBranch'];
		$scolg = $_POST['studentCollege'];
		$sdob = $_POST['studentDob'];

		try {
		   $q = "UPDATE STUDENT SET Student_Name = '$sname', Student_Reg_Num = '$sreg', Student_Branch = '$sbranch', Student_College = '$scolg', Student_Date_Of_Birth = '$sdob' WHERE Student_Username = '$user'";
		   $conn->query($q);
		} catch(PDOException $ex){
		   echo "error";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/newStyle.css">
<title>Update</title>
</head>

<body>

<div class="content">
	<a href="studentProfile.php">Home</a>
</div>
<br><br>
<div align="center">
<h3>Updated Successfully</h3>
</div>
</body>
