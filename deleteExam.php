<?php
	session_start();

	if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
		if($_SESSION['logintype'] == 'COLLEGE'){
			$userid = $_SESSION['userid'];
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
<h2>Delete an Exam</h2>
<div class="content">
	<a href="collegeProfile.php">Home</a>
	<a href="studentsList.php">Students List</a>
	<a href="examHome.php">Conduct an exam</a>
	<a href="logout.php">logout</a>
</div>
<?php			
			require 'db.php';
			try {
				$res = $conn->query("SELECT * FROM EXAM WHERE Exam_Conducting_College = $userid");
			} catch(PDOException $ex){
				echo "error";
			}
			$results = $res->fetchAll(PDO::FETCH_ASSOC);

			echo "<table>";
			echo "<tr><th>Exam Name</th></tr>";
			foreach($results as $row){
				echo "<tr>";
				$ename = $row['Exam_Name'];
				$eid = $row['Exam_ID'];
				echo "<td><div class='tablelink'><a href='dropExam.php?eid=$eid'>$ename</a></div></td></br>";
				echo "</tr>";
			}
			echo "</table>";

			echo "</body>";
			echo "</html>";
?>