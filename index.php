<?php session_start(); ?>
<?php include('header.php'); ?>
    
        <div class="container">
            <section>
                <?php
                    echo '<p class="title">';
                    if ($_SESSION['message1'] != NULL){
                        echo $_SESSION['message1'];
                      }else if ($_SESSION['loggedin'] != 1) {
                        echo '<a href="auth_register_form.php">Must login to see data.</a>';
                      }else{
                        echo "Something went wrong. Try logging in again.";
                      }
                    echo '</p>';
                ?>
            </section>
        </div>
  <?php include('footer.php'); ?>