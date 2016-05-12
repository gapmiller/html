<?php 
	//include 'db.inc.php'; 
	include 'config.php';
	session_start();

	$username=$_POST['username'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];

	$query = pg_exec($db,"SELECT fldusername,fldpassword FROM tblUsers WHERE fldusername = '$username'") or die(pg_last_error());
	$data = pg_fetch_array($query);
	echo $data;
	echo "Need to finish the code to register users.";
	//$query = pg_exec($db,"SELECT fldusername,fldpassword FROM tblUsers WHERE fldusername = '$username'") or die(pg_last_error());
	//$data = pg_fetch_array($query);

	//check username and password
	//if (password_verify ($password, $data['fldpassword'])) {
	//    setcookie("user", "$username", time()+3600);
	 //   $_SESSION['loggedin'] = 1;                
	//    header("Location: menu.php");
	//}else{
	//	header ("Location: register.html");
	//}

?>