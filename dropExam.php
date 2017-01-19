<?php
	session_start();

	if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
		if($_SESSION['logintype'] == 'COLLEGE'){
			$userid = $_SESSION['userid'];
			$user = $_SESSION['username'];
			require 'db.php';
			if(isset($_GET['eid'])){
				$eid = $_GET['eid'];
				$q = "DELETE FROM EXAM WHERE Exam_ID = $eid";
				try {
					$res = $conn->query($q);
				} catch(PDOException $ex){
					echo "error $ex";
				}
				header("Location: deleteExam.php");
			}
		}
		else{
			header("Location: studentProfile.php");
		}
	}
	else{
		header("Location: index.php");
	}
?>