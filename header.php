<!doctype html>
<html>
    <head>
        <title>Climatec Controls</title>
        <link rel="stylesheet" href="style/reset.css">
        <link rel="stylesheet" href="style/styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" /> <!-- Triggers responsive -->
        <link rel="icon" href="favicon-16x16.png">
    </head>

    <body>
        <header id="masthead">
            <nav>
                <div class="container">
                    <a href="index.php" id="brand">job number and site list</a>
                    <ul>
                        <li><a href="jobsitenum.php">Site List</a></li>
                        <li><a href="jobsites.php">Site Information</a></li>
                        <li><a href="jobnums.php">Job Number List</a></li>
                        <li><a href="oldnames.php">Alternate and Previous Site Names</a></li>
                    </ul>
                    <ul class="authlist">
                        <?php
                            if ($_SESSION['loggedin'] === 1){
                                //echo "Logout";
                                //echo '<li><form class="logout" action="auth_register.php" method="POST"
                                //<p><input type="submit" name="submit" value="Logout"></p></li></form>';

                                //echo '<li><form action="auth_register.php" method="POST">
                                //    <p><button type="submit" class="logout" name="submit" value="Logout">
                                //    <span>Logout</span></button></p></form></li>';
                                echo '<li><form action="auth_register.php" method="POST">
                                    <p><button type="submit" class="navbutton" name="submit" value="Logout">
                                    <span>Logout</span></button></p></form></li>';

                            }else{
                                //echo"Login";
                                echo '<li><form action="auth_register_form.php" method="GET">
                                    <p><button type="submit" class="navbutton" name="authreg" value="login">
                                    <span>Login</span></button></p></form></li>';
                                echo '<li><p>or<p></li>';
                                echo '<li><form action="auth_register_form.php" method="GET">
                                    <p><button type="submit" class="navbutton" name="authreg" value="register">
                                    <span>Register</span></button></p></form></li>';
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>

        <section id="hero">
        </section> 