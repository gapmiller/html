<?php
// gotta have a session to see anything
session_start();
if ($_SESSION['loggedin'] != 1){
  header("Location: index.php"); 
  exit; 
}
?>