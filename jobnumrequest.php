<?php
// gotta have a session to see anything
session_start();
if (($_SESSION['loggedin'] != 1) || ($_SESSION['active'] == "f")){
	header("Location: index.php");
	if ($_SESSION['message1'] != NULL){
	    echo $_SESSION['message1'];
	}
  exit; 
}
?>
<!DOCTYPE html>
<html>
<?php //include('header.php'); ?>
  <head>
    <title>Climatec Controls-Job Numbers</title>
  </head>
  <body>
    <p>Sites - not much here yet.</p>
  </body>


</html>