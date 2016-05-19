<?php session_start(); ?>
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
                    <h1 id="brand"></h1>
                    <ul>
                        <li>
                            <a href="jobsitenum.php">Job numbers listed by site</a>
                        </li>
                        <li>
                            <a href="jobsites.php">Sites</a>
                        </li>
                        <li>
                            <a href="jobnums.php">Job numbers</a>
                        </li>
                        <li>
                            <a href="oldnames.php">Sites listed by previous names</a>
                        </li>
                        
                        <?php
                            if ($_SESSION['loggedin'] === 1){
                                echo '<li><form class="logout" action="auth_register.php" method="POST"
                                <p><input type="submit" name="submit" value="Logout"></p></li>';
                                //echo "Logout";
                            }else{
                                //echo"Login";
                                echo '<li><a href="auth_register_form.php">Login or Register</a></li>';
                            }
                        ?>
                    </li>
                    </ul>
                </div>
            </nav>
        </header>

        <section id="hero">
        </section> 
        
        <div>
        <div>
            <?php
                if ($_SESSION['message1'] != NULL){
                      echo $_SESSION['message1'];
                  }
            ?>
        </div>

    </body>
</html>