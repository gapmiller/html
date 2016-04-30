<!DOCTYPE html>
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
    <title>Climatec Controls-Job Numbers</title>
  </head>
  <body>
    <p>Sites - not much here yet.</p>
  </body>


</html>