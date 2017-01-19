<?php
  require 'functions.php';
  if(isLogged()) {
    redirect();
  }

  require 'db.php';

  try {
    $res = $conn->query("SELECT College_Name FROM COLLEGE");
  } catch(PDOException $ex){
    echo "error";
  }
  $collegeList = [];
  $results = $res->fetchAll(PDO::FETCH_ASSOC);
  for($i=0; $i<count($results); $i++){
    $collegeList[$i] =  $results[$i]['College_Name'];
  }

  try {
    $res = $conn->query("SELECT Branch_Name FROM BRANCH");
  } catch(PDOException $ex){
    echo "error";
  }
  $branchList = [];
  $results = $res->fetchAll(PDO::FETCH_ASSOC);
  for($i=0; $i<count($results); $i++){
    $branchList[$i] =  $results[$i]['Branch_Name'];
  }
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/newStyle.css">
<title>student registration</title>

</head>
<body>

<h2>STUDENT REGISTRATION</h2>

<div class="content">
<a href="login.php">Log in</a>
<a href="collegeReg.php">College Registration</a>
</div>
      
<div class="reg">
<h3>ENTER DETAILS</h3>

<form action="studentRegistration.php" method="POST">

  <input type="text" name="studentName" placeholder="Name" required><br>

  <input type="text" name="studentRegNum" placeholder="Register Number" required><br>

  <select name="studentBranch" placeholder="Branch" required>
  <?php
    foreach($branchList as $branch){
       echo "<option value='$branch'>$branch</option>"; 
      }
  ?>
  </select>

  <select name="studentCollege" placeholder="Subject" required>
  <?php
    foreach($collegeList as $colg){
       echo "<option value='$colg'>$colg</option>"; 
      }
  ?>
  </select><br>

  <input type="text" name="studentDob" placeholder="Date of Birth" required><br>

  <input type="text" name="studentUsername" placeholder="Username" required><br>

  <input type="password" name="studentPassword" placeholder="Password" required><br>

  <input type="submit" class="submit" value="Submit">

</form>
</div>

</body></html>
