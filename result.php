<?php
  require 'functions.php';
  if(isLogged()) {
    if($_SESSION['logintype'] == 'STUDENT')
      $userid = $_SESSION['userid'];
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
<title>results</title>
</head>

<body>
<h2>Result</h2>

<div class="content">
  <a href="studentProfile.php">Home</a>
  <a href="examList.php">Upcoming exams</a>
  <a href="editProfile.php">Edit Profile</a>
  <a href="logout.php">logout</a>
</div>
<?php
  $q = "SELECT * FROM RESULT WHERE Result_Student_ID = '$userid'";

  try {
    $res = $conn->query($q);
    } catch(PDOException $ex){
        echo "error $ex";
    }
    $results = $res->fetchAll(PDO::FETCH_ASSOC);

  echo "<table class='table'>";
  echo "<tr><th>Exam Name</th><th>Subject Name</th><th>Marks Obtained</th><th>Total Marks</th></tr>";

  foreach ($results as $row) {
   
    echo "<tr>";

    $e = "SELECT Exam_Name FROM EXAM WHERE Exam_ID = " . $row['Result_Exam_ID'];
    try {
    $r = $conn->query($e);
    } catch(PDOException $ex){
        echo "error $ex";
    }
    $exam = $r->fetchAll(PDO::FETCH_ASSOC);
    if(count($exam)>0){
      echo "<td>" . $exam[0]['Exam_Name'] . "</td>";
    }

    $e = "SELECT Subject_Name FROM SUBJECT WHERE Subject_ID = " . $row['Result_Subject_ID'];

    try {
    $r = $conn->query($e);
    } catch(PDOException $ex){
        echo "error $ex";
    }
    $sub = $r->fetchAll(PDO::FETCH_ASSOC);

    echo "<td>" . $sub[0]['Subject_Name'] . "</td>";

    echo "<td>" . $row['Result_Marks_Obtained'] . "</td>";
    echo "<td>" . $row['Result_Total_Marks'] . "</td>";
    echo "</tr>";
  }

  echo "</table>";
?>
</body>