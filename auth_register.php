<?php 
	//include 'db.inc.php'; 
	include 'config.php';
	session_start();

	$username=$_POST['username'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];

	$query = pg_exec($db,"SELECT fldusername,fldpassword FROM tblUsers WHERE fldusername = '$username'") or die(pg_last_error());
	$data = pg_fetch_array($query);
	

	//check username and password
	if ($data) {
	    echo "User already exists";
	    header("Location: reg_error.html");
	}else{
		echo "Need to add user.";
		if ($password != $password2){
			echo "passwords don't match";
			usleep(10);
			//header("Location: reg_error.html");
        }else{
            $hpassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO tblUsers (fldusername, fldpassword, fldcreated) VALUES('$username','$hpassword','$email')";
            pg_exec($query) or die(pg_last_error());
            welcome( "The user $username has been successfully registered.");
            usleep(10);
            echo "wake up!";
            die();
        }        
    } 
?>