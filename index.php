<!-- This Script is from www.phpfreecpde.com, Coded by: Kerixa Inc
http://www.phpfreecode.com/Login_-_Register_System.htm

revised for PostgreSQL by Gretchen Miller
-->

<?php
// gotta have a session
session_start();
// this page assumes the person is logged out until proven otherwise
$_SESSION['loggedin'] = 0;
include 'config.php';
$db= pg_connect("host=" . PGHOST . " dbname=" . PGDATABASE . " user=" . PGUSER . " password=" . PGPASSWORD) or die('Could not connect to database server.');

if (isset( $_GET['type'])&& $_GET['type']=='login'){
    // read username and password if they suppled a username
    if ($_POST['username']) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        // check to see if password supplied
        if ($password==NULL) {
            echo "The password was not supplied";
        // look up username and password in database
        }else{
            $query = pg_exec($db,"SELECT fldusername,fldpassword FROM tblUsers WHERE fldusername = '$username'") or die(pg_last_error());
            $data = pg_fetch_array($query);
            //check username and password
            if (password_verify ($password, $data['fldpassword'])) {
                //$query = pg_exec("SELECT fldusername,fldpassword FROM tblUsers WHERE fldusername = '$username'") or die(pg_last_error());
                //$row = pg_fetch_array($query);
                setcookie("user", "$username", time()+3600);
                $_SESSION['loggedin'] = 1;
                welcome("The login was successful.");
                header("Location: menu.php");
            }else{
                echo "The supplied login is incorrect";
            }
        }
    }else echo 'The username was not supplied';
}elseif (isset( $_GET['type'])&& $_GET['type']=='register'){
    if (isset($_POST["username0"])) {
        $username = $_POST["username0"];
        $password = $_POST["password0"];
        $cpassword = $_POST["cpassword"];
        $email = $_POST["email"];
        //Was a field left blank?
        if($username==NULL||$password==NULL||$cpassword==NULL||$email==NULL) {
            echo "A field was left blank.";
        }else{
            //Do the passwords match?
            if($password!=$cpassword) {
                echo "Passwords do not match";
            }else{
                //Has the username or email been used?
                $checkuser = pg_exec($db, "SELECT fldusername FROM tblUsers WHERE fldusername='$username'");
                $username_exist = pg_num_rows($checkuser);
                $checkemail = pg_exec("SELECT fldEmail FROM tblUsers WHERE fldEmail='$email'");
                $email_exist = pg_num_rows($checkemail);
                if ($email_exist||$username_exist) {
                    echo "The username or email is already in use";
                }else{
                    //Everything seems good, lets insert.
                    $hpassword = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO tblUsers (fldusername, fldpassword, fldEmail) VALUES('$username','$hpassword','$email')";
                    pg_exec($query) or die(pg_last_error());
                    welcome( "The user $username has been successfully registered.");
                }
            }
        }
    }   
}elseif (isset( $_GET['type'])&& $_GET['type']=='logout'){
    setcookie("user", "", time()-3600);
    $_SESSION['loggedin'] = 0;
}

if (isset($_COOKIE['user']) && $_COOKIE['user']!="") {
    $username= $_COOKIE['user'];
    if ($_SESSION['loggedin']==1) welcome("You have already logged in; Enjoy.");
} 

$row1 = pg_exec("SELECT * FROM tblUsers");// ORDER BY uid DESC LIMIT 1") or die(pg_last_error());
while($row=pg_fetch_array($row1))
{
    $lastuser= $row['fldusername'];
}

function welcome($msg){
global $username;
die(
'
<head>
    <title>Climatec Controls</title>
    <h2>Climatec Controls Job Sites and Job Numbers</h2>
    <link rel="icon" href="favicon-16x16.png">
</head>
<table style="border-width: 0px;width: 400px; height: 107px">
    <tr>
        <td style="border-style: solid;border-width: 0px;font-size: 17pt;background-color: #DFDFFF;">'.$msg.'</td></tr><tr>
        <td style="border-style: solid;border-width: 0px;font-size: 17pt;background-color: #DFDFFF;"><strong>Welcome '.$username.'</strong><br>
        <a href="'.$_SERVER['PHP_SELF'].'?type=logout"><span style="border-style: solid;border-width: 0px;background-color: #DFDFFF;">Logout</span></a><br><br>
        <a href=menu.php><span style="border-style: solid;border-width: 0px;background-color: #DFDFFF;">Menu</span></a></td>
    </tr>
</table>');
}

?>

<html>
<head>
    <title>Climatec Controls</title>
    <h2>Climatec Controls Job Sites and Job Numbers</h2>
    <link rel="icon" href="favicon-16x16.png">
</head>
<body>

<table style="border-width: 0px;width: 400px; height: 107px">
    <tr>
        <td style="border-style: solid;border-width: 0px;background-color: #DFDFFF;"><form action="<?php echo $_SERVER['PHP_SELF'].'?type=login'?>" method="post" ><h1>Login</h1>
<table style='border:0px solid #000000;'>
<tr>
<td align='right'>
Username: <input type='text' size='15' maxlength='25' name='username'>
</td>
</tr>
<tr>
<td align='right'>
Password: <input type='password' size='15' maxlength='25' name='password'>
</td>
</tr>
<tr>
<td align='center'>
<input type="submit" value="Login">
</td>
</tr>
</table>
        </form><br></td>
    </tr>
    <tr>
        <td style="border-style: solid;border-width: 0px;background-color: #DFFFFF;"><form action="<?php echo $_SERVER['PHP_SELF'].'?type=register'?>" method="post" >
<h1>Register</h1>
<table style="border:0px solid #000000;">
<tr>
<td align="right">
Username: <input type="text" size="15" maxlength="25" name="username0">
</td>
</tr>
<tr>
<td align="right">
Password: <input type="password" size="15" maxlength="25" name="password0">
</td>
</tr>
<tr>
<td align="right">
Confirm Password: <input type="password" size="15" maxlength="25" name="cpassword">
</td>
</tr>
<tr>
<td align="right">
Email: <input type="text" size="15" maxlength="25" name="email">
</td>
</tr>
<tr>
<td align="center">
<input type="submit" value="Register">
</td>
</tr>
</table>
        </form><br></td>
    </tr>
    <tr>
        <td style="border-style: solid;border-width: 0px;font-size: 17pt;background-color: #DFDFFF;"><strong>Last member: <?php echo $lastuser?></strong></td>
    </tr>
</table>
<br><font face="Tahoma"><a target="_blank" href="http://www.phpfreecode.com/"><span style="font-size: 8pt; text-decoration: none">PHP Free Code</span></a></font>
</body></html>