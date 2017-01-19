<?php
	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require 'db.php';

		$username = $_POST['collegeUsername'];
		$password = $_POST['collegePassword'];
		$colName = $_POST['collegeName'];
		$address = $_POST['collegeAddress'];
		$contact = $_POST['collegeContact'];

		try {
			$res = $conn->query("SELECT College_ID, College_Name FROM COLLEGE WHERE College_Username = '$username'");
		} catch(PDOException $ex){
			echo "error $ex";
		}
		$results = $res->fetchAll(PDO::FETCH_ASSOC);

		if(count($results) > 0){
			header("Location: collegeReg.php?colgExists=1");
		}
		else{
			$q = "INSERT INTO COLLEGE VALUES ('', '$colName', '$address', '$contact', '$username', '$password')"; 
			try {
				$res = $conn->query($q);
				$_SESSION['logged'] = 1;
				$_SESSION['logintype'] = 'COLLEGE';
				$_SESSION['username'] = $colName;
				try {
					$res = $conn->query("SELECT College_ID FROM COLLEGE WHERE College_Name = '$colName'");
				} catch(PDOException $ex){
					echo "error $ex";
				}
				$results = $res->fetchAll(PDO::FETCH_ASSOC);
				$_SESSION['userid'] = $results[0]['College_ID'];
				header("Location: collegeProfile.php");
			} catch(PDOException $ex){
				echo "error $ex";
			}
		}
	}
	else{
		header("Location: index.php");
	}

?>