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
<h2><?php echo "$user"; ?> Students</h2>
<div class="content">
	<a href="collegeProfile.php">Home</a>
	<a href="examHome.php">Conduct an exam</a>
	<a href="deleteExam.php">Delete an exam</a>
	<a href="logout.php">logout</a>
</div>
<?php			
			require 'db.php';
			try {
				$res = $conn->query("SELECT * FROM STUDENT WHERE Student_College = '$userid' ORDER BY Student_Branch");
			} catch(PDOException $ex){
				echo "error";
			}
			$results = $res->fetchAll(PDO::FETCH_ASSOC);

			echo "<table>";
			echo "<tr><th>Student Name</th><th>Register number</th><th>Branch</th></tr>";
			foreach($results as $row){
				echo "<tr>";
				$name = $row['Student_Name'];
				$regNum = $row['Student_Reg_Num'];
				//$username = $row['Student_Branch'];
				$bid = $row['Student_Branch'];
				try {
					$brname = $conn->query("SELECT Branch_Name FROM BRANCH WHERE Branch_ID = $bid");
				} catch(PDOException $ex){
					echo "error";
				}
				$brnameres = $brname->fetchAll(PDO::FETCH_ASSOC);
				$branchName = $brnameres[0]['Branch_Name'];
				echo "<td>$name</td><td>$regNum</td><td>$branchName</td></br>";
				echo "</tr>";
			}
			echo "</table>";

			echo "</body>";
			echo "</html>";
?>