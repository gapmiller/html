<?php
// gotta have a session and an active user to see anything
session_start();
if (($_SESSION['loggedin'] != 1) || ($_SESSION['active'] == "f")){
  header("Location: index.php"); 
  exit; 
}
?>
<!DOCTYPE html>
<html>
<?php include('header.php'); ?>
  <head>
    <title>Climatec Controls-Old Job Names</title>
  </head>
  <body>
    <p>Old job names - not much here yet.</p>
    <p><?php echo $_SESSION['active']; ?></p>
  </body>


</html>