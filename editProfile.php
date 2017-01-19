<?php
	require 'functions.php';
	if(isLogged()) {
		if($_SESSION['logintype'] == 'STUDENT'){
			$userid = $_SESSION['userid'];
			$q = "SELECT * FROM STUDENT WHERE Student_ID = $userid";

			try {
				$res = $conn->query($q);
			} catch(PDOException $ex){
				echo "error $ex";
			}
			$results = $res->fetchAll(PDO::FETCH_ASSOC);
			if(count($results)){
				$sname = $results[0]['Student_Name'];
				$sreg = $results[0]['Student_Reg_Num'];
				$sbranch = $results[0]['Student_Branch'];
				$scollege = $results[0]['Student_College'];
				$sdob = $results[0]['Student_Date_Of_Birth'];
			}

			  try {
			    $res = $conn->query("SELECT * FROM COLLEGE");
			  } catch(PDOException $ex){
			    echo "error";
			  }
			  $collegeList = [];
			  $results = $res->fetchAll(PDO::FETCH_ASSOC);
			  for($i=0; $i<count($results); $i++){
			    $collegeList[$i] =  $results[$i]['College_Name'];
			    $collegeid[$i] =  $results[$i]['College_ID'];
			  }

			  try {
			    $res = $conn->query("SELECT * FROM BRANCH");
			  } catch(PDOException $ex){
			    echo "error";
			  }
			  $branchList = [];
			  $results = $res->fetchAll(PDO::FETCH_ASSOC);
			  for($i=0; $i<count($results); $i++){
			    $branchList[$i] =  $results[$i]['Branch_Name'];
			    $branchid[$i] =  $results[$i]['Branch_ID'];
			  }
		}
		else
			header("Location: collegeProfile.php");
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
<h2>Edit Profile</h2>
<div class="content">
	<a href="studentProfile.php">Home</a>
	<a href="result.php">View Results</a>
	<a href="editProfile.php">Edit Profile</a>
	<a href="logout.php">logout</a>
</div>
<div class="reg">
<h3>ENTER YOUR DETAILS</h3>

	<form action="updateProfile.php" method="POST">

	  <input type="text" name="studentName" placeholder="Name" value="<?php echo "$sname"?>"><br>

	  <input type="text" name="studentRegNum" placeholder="Register Number" value="<?php echo "$sreg"?>"><br>
	  <select name="studentBranch" placeholder="Branch">
	  <?php
	    for($i=0; $i<count($branchList); $i++){
	    	if($branchid[$i] == $sbranch)
	    		echo "<option value='$branchid[$i]' selected='selected'>$branchList[$i]</option>"; 
	    	else
	       		echo "<option value='$branchid[$i]'>$branchList[$i]</option>"; 
	      }
	  ?>
	  </select>

	  <select name="studentCollege" placeholder="Subject">
	  <?php
	    for($i=0; $i<count($collegeList); $i++){
	       if($collegeid[$i] == $scollege) 
	           echo "<option value='$collegeid[$i]' selected='selected'>$collegeList[$i]</option>"; 
	    	else
	       		echo "<option value='$collegeid[$i]'>$collegeList[$i]</option>"; 
	    }
	  ?>
	  </select><br>

	  <input type="text" name="studentDob" placeholder="Date of Birth" value="<?php echo "$sdob"?>"><br>

	  <input type="submit" class="submit" value="Update">

	</form>
</div>

</body>

</html>