<?php
	session_start();
	
	require 'db.php';
	
	function isLogged(){
		if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1){
			return true;
		}
		return false;
	}


	function redirect(){
		if(isset($_SESSION['logintype']) && $_SESSION['logintype'] == 'COLLEGE'){
			header("Location: collegeProfile.php");
		}
		else{
			header("Location: studentProfile.php");
		}
	}

	
?>