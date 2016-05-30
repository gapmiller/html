<?php session_start(); ?>
<!doctype html>
<html>

<?php //include('header.php'); ?>

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
                </div>
            </nav>
        </header>

        <section id="hero">
            <div class='container'>
                <?php
                if ($authreg === 'register'){
                    echo '<form class="reg-form" action="auth_register.php" method="POST">
                        <h1>Register</h1>
                        <p>
                            <label for="username">Username</label>
                            <input type="text" name="username" placeholder="Username" required>
                        </p>                
                        <p>
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Password" required> 
                        </p>
                        <p>
                            <label for="password2">Password</label>
                            <input type="password" name="password2" placeholder="Re-enter Password" required> 
                        </p>
                        <p>
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" required>
                        </p>
                        <p>
                            <input type="submit" name="submit" value="Register">
                        </p>
                        <h2>';
                        echo '<a href="auth_junk.php">Login</a>';
                        
                            if ($_SESSION['message2'] != NULL){
                                echo $_SESSION['message2'];
                            }    
                        echo '</h2>';

                }else{
                    echo '<form class="auth-form" action="auth_register.php" method="POST">
                        <h1>Login</h1>
                        <p>
                            <label for="username">Username</label>
                            <input type="text" name="username" placeholder="Username" required>
                        </p>                
                        <p>
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Password" required> 
                        <p>
                            <input type="submit" name="submit" value="Login">
                        </p>
                        <h2>';
                    echo '<a href="auth_junk.php">Register</a>';
                        
                    if ($_SESSION['message1'] != NULL){
                        echo $_SESSION['message1'];
                    }
                    if ($_SESSION['message3'] != NULL){
                        echo $_SESSION['message3'];
                    }
                    echo '</h2>';
                    echo '</form>';
                }
                    ?>
                </form>
            </div>
        </section>
        <div class="container">
            <section>
            </section>
        </div>

  <?php include('footer.php'); ?>