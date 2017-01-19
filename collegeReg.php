<?php
  session_start();
  if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
    if($_SESSION['logintype'] == 'COLLEGE'){
      header("Location: collegeProfile.php");
    }
    if($_SESSION['logintype'] == 'STUDENT'){
      header("Location: studentProfile.php");
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/newStyle.css">
  <title>college registration</title>

</head>
<body>

<h2>COLLEGE REGISTRATION</h2>

<div class="content">
  <a href="login.php">Log in</a>
  <a href="studentReg.php">Student Registration</a>
</div>

<div class="reg">

  <h3>ENTER DETAILS</h3>

  <form action="collegeRegistration.php" method="POST">

    <input type="text" name="collegeName" placeholder="College Name" required><br>

    <input type="text" name="collegeAddress" placeholder="Address" required><br>

    <input type="text" name="collegeContact" placeholder="Contact Number" required><br>

    <input type="text" name="collegeUsername" placeholder="Username" required><br>

    <input type="password" name="collegePassword" placeholder="Password" required><br>

    <input type="submit" class="submit" value="Submit">

  </form>
</div>

</body></html>


