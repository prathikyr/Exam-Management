<?php
	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		require 'db.php';

		$username = $_POST['collegeUsername'];
		$password = $_POST['collegePassword'];
		try {
			$res = $conn->query("SELECT College_ID, College_Name FROM COLLEGE WHERE College_Username = '$username' AND College_Password = '$password'");
		} catch(PDOException $ex){
			echo "error";
		}
		$results = $res->fetchAll(PDO::FETCH_ASSOC);

		if(count($results) > 0){
			$_SESSION['logged'] = 1;
			$_SESSION['logintype'] = 'COLLEGE';
			$_SESSION['username'] = $results[0]['College_Name'];
			$_SESSION['userid'] = $results[0]['College_ID'];
			header("Location: collegeProfile.php");
		}
		else {
			$_SESSION['invalidCollege'] = 1;
			header("Location: collegeLoginPage.php");
		}
	}
	else{
		header("Location : index.php");
	}



?>