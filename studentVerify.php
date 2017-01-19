<?php
	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		require 'db.php';

		$username = $_POST['studentUsername'];
		$password = $_POST['studentPassword'];
		try {
			$res = $conn->query("SELECT Student_ID, Student_Name FROM STUDENT WHERE Student_Username = '$username' AND Student_Password = '$password'");
		} catch(PDOException $ex){
			echo "error";
		}
		$results = $res->fetchAll(PDO::FETCH_ASSOC);

		if(count($results) > 0){
			$_SESSION['logged'] = 1;
			$_SESSION['logintype'] = 'STUDENT';
			$_SESSION['username'] = $results[0]['Student_Name'];
			$_SESSION['userid'] = $results[0]['Student_ID'];
			header("Location: studentProfile.php");
		}
		else {
			$_SESSION['invalidStudent'] = 1;
			header("Location: studentLoginPage.php");
		}
	}
	else{
		header("Location : index.php");
	}



?>