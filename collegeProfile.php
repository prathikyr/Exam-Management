<?php
	session_start();

	if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
		if($_SESSION['logintype'] == 'COLLEGE'){
			$user = $_SESSION['username'];
		}
		else{
			header("Location: studentProfile.php");
		}
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
<title><?php echo "$user" ?></title>
</head>

<body>
<h2>Welcome <?php echo "$user"; ?> </h2>
<div class="content">
	<a href="studentsList.php">Students List</a>
	<a href="examHome.php">Conduct an exam</a>
	<a href="deleteExam.php">Delete an exam</a>
	<a href="logout.php">logout</a>
</div>
</body>

</html>