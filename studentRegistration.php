<?php

	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require 'db.php';

		$username = $_POST['studentUsername'];
		$password = $_POST['studentPassword'];
		$studentRegNum = $_POST['studentRegNum'];
		$studentName = $_POST['studentName'];
		$studentColg = $_POST['studentCollege'];
		$studentBranch = $_POST['studentBranch'];
		$studentDob = $_POST['studentDob'];

		try {
			$res = $conn->query("SELECT Student_ID, Student_Name FROM STUDENT WHERE Student_Username = '$username'");
		} catch(PDOException $ex){
			echo "error";
		}
		$results = $res->fetchAll(PDO::FETCH_ASSOC);
		if(count($results) > 0){
			header("Location: studentReg.php?studentExists=1");
		}
		else{
			try {
				$res = $conn->query("SELECT Branch_ID FROM BRANCH WHERE Branch_Name = '$studentBranch'");
			} catch(PDOException $ex){
				echo "error";
			}
			$results = $res->fetchAll(PDO::FETCH_ASSOC);
			$br = $results[0]['Branch_ID'];

			try {
				$res = $conn->query("SELECT College_ID FROM COLLEGE WHERE College_Name = '$studentColg'");
			} catch(PDOException $ex){
				echo "error";
			}
			$results = $res->fetchAll(PDO::FETCH_ASSOC);
			$col = $results[0]['College_ID'];

		 	$q = "INSERT INTO STUDENT VALUES ('', '$studentName', '$studentRegNum', '$br', '$col', '$studentDob', '$username', '$password')"; 
		 	try {
				$res = $conn->query($q);
				$_SESSION['logged'] = 1;
				$_SESSION['logintype'] = 'STUDENT';
				$_SESSION['username'] = $username;
				//$_SESSION['userid'] = $studentRegNum;
				try {
					$res = $conn->query("SELECT Student_ID FROM STUDENT WHERE Student_Reg_Num = '$studentRegNum'");
				} catch(PDOException $ex){
					echo "error $ex";
				}
				$results = $res->fetchAll(PDO::FETCH_ASSOC);
				$_SESSION['userid'] = $results[0]['Student_ID'];
				header("Location: studentProfile.php");
		 	} catch(PDOException $ex){
				echo "error";
			}
		}
	}
	else{
		header("Location: index.php");
	}



?>