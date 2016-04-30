<?php
// gotta have a session
session_start();
if ($_SESSION['loggedin'] != 1){
  header("Location: index.php"); 
  exit; 
}
?>

<html>
  <head>
    <title>Climatec Controls</title>
    <h2>Climatec Controls Job Sites and Job Numbers</h2>
    <link rel="icon" href="favicon-16x16.png">
  </head>

  <body>
    <p><a href="jobsitenum.php">Job numbers listed by site</a></p>
    <p><a href="jobsites.php">Sites</a></p>
    <p><a href="jobnums.php">Job numbers</a></p>
    <p><a href="oldnames.php">Sites listed by previous names</a></p>
  </body>

</html>
