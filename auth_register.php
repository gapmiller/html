<?php 
	session_start();
	include 'config.php';

    $_SESSION['loggedin'] = 0;

	$username=$_POST['username'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	$email = $_POST['email'];
    $action = $_POST['submit'];

    // Do passwords match?
    if ($action == "Login") {
        //$query = pg_exec($db,"SELECT fldusername,fldpassword FROM tblUsers WHERE fldusername = '$username'") or die(pg_last_error());
        $query = pg_exec($db,"SELECT * FROM tblUsers WHERE fldusername = '$username'") or die(pg_last_error());
        $data = pg_fetch_array($query);
        //check username and password
        if (password_verify ($password, $data['fldpassword'])) {
            //setcookie("user", "$username", time()+3600);
            $_SESSION['loggedin'] = 1;
            $_SESSION['logintime'] = idate("U");
            $_SESSION['active'] = $data['fldactive'];
            /*echo $data['fldusername'];
            echo $data['fldpassword'];
            echo $data['fldcreated'];
            echo $data['fldlastlogin'];
            if ($data['fldactive'] == "t"){
                echo "true </br>";
            }else{
                echo "false </br>";
            }
            echo $data['fldactive'];
            echo $data['fldemail'];*/
            if ($data['fldactive'] == "f"){
                $_SESSION['message1'] = "Account: "  . $data['fldusername'] . " - Your account is not active. Contact the database administrator to confirm your registration.";
            }
            header("Location: index.php");
        }else{
            $_SESSION['message1'] = "Incorrect username or password.";
            header("Location: auth_register_form.php");
        }
    }else if ($action == "Register"){
		if ($password != $password2){
            $_SESSION['message2'] = "Passwords do not match. Please try again.";
			header("Location: auth_register_form.php");
        }else{
        	//Has the username or email been used?
            //$checkuser = pg_exec($db, "SELECT fldusername FROM tblUsers WHERE fldusername='$username'");
            $checkuser = pg_exec($db, "SELECT fldusername FROM tblUsers WHERE fldusername='$username'");
            $username_exist = pg_num_rows($checkuser);
            $checkemail = pg_exec("SELECT fldEmail FROM tblUsers WHERE fldEmail='$email'");
            $email_exist = pg_num_rows($checkemail);
            if ($email_exist||$username_exist) {
                $_SESSION['message2'] = "Username or email exists.";
                header("Location: auth_register_form.php");
            }else{
                //Everything seems good, lets insert.
                $hpassword = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO tblUsers (fldusername, fldpassword, fldEmail) VALUES('$username','$hpassword','$email')";
                pg_exec($query) or die(pg_last_error());
                header("Location: auth_register_form.php");
                $_SESSION['message2'] = "Contact the database administrator to confirm your registration.";
            }
        }        
    }else if ($action =="Logout"){
        $_SESSION['loggedin'] = 0;
        $_SESSION['message1'] = NULL;
        $_SESSION['message2'] = NULL;
        $_SESSION['logintime'] = NULL;
        //unset($_COOKIE["user"]);
        header("Location: auth_register_form.php");
    }else{
        $_SESSION['message1'] = "So confused! What did you want to do?";
        $_SESSION['message2'] = NULL;
        header("Location: auth_register_form.php");
    }
?>