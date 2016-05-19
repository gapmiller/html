<?php 
	//include 'db.inc.php'; 
	include 'config.php';
	session_start();

	$username=$_POST['username'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	$email = $_POST['email'];
    $message = "Hi!";

    // Do passwords match?
		if ($password != $password2){
			header("Location: reg_error.html");
        }else{
        	//Has the username or email been used?
            $checkuser = pg_exec($db, "SELECT fldusername FROM tblUsers WHERE fldusername='$username'");
            $username_exist = pg_num_rows($checkuser);
            $checkemail = pg_exec("SELECT fldEmail FROM tblUsers WHERE fldEmail='$email'");
            $email_exist = pg_num_rows($checkemail);
            if ($email_exist||$username_exist) {
                $message = "Username or email exists.";
                header("Location: register.php");
            }else{
                //Everything seems good, lets insert.
                $hpassword = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO tblUsers (fldusername, fldpassword, fldEmail) VALUES('$username','$hpassword','$email')";
                pg_exec($query) or die(pg_last_error());
                header("Location: form.html");
            }
        }        
     
?>