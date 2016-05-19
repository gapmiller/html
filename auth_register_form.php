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
                    <h1 id="brand"></h1>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <section id="hero">

            <form class="auth-form" action="auth_register.php" method="POST">
                <h1>Login</h1>
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                </p>                
                <p>
                    <label for="password">Password</label>
                    <input type="password" name='password' placeholder="Password" required> 
                <p>
                    <input type="submit" name="submit" value="Login">
                </p>
                <h2> 
                <?php
                    if ($_SESSION['message1'] != NULL){
                        echo $_SESSION['message1'];
                    }
                ?>
                </h2>
            </form>
            <form class="reg-form" action="auth_register.php" method="POST">
                <h1>Register</h1>
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                </p>                
                <p>
                    <label for="password">Password</label>
                    <input type="password" name='password' placeholder="Password" required> 
                </p>
                <p>
                    <label for="password2">Password</label>
                    <input type="password" name='password2' placeholder="Re-enter Password" required> 
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </p>
                <p>
                    <input type="submit" name="submit" value="Register">
                </p>
                <h2> 
                <?php
                    if ($_SESSION['message2'] != NULL){
                        echo $_SESSION['message2'];
                    }    
                ?>
                </h2>
            </form>
        <!--
        </section> 
    -->
    </body>
</html>