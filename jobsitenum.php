<?php
// gotta have a session to see anything
session_start();
if (($_SESSION['loggedin'] != 1) || ($_SESSION['active'] == "f")){
  header("Location: index.php"); 
  exit; 
}

?>

<?php include('header.php'); ?>

<!--content for page -->
  <div class="bodycontainer">
    <section>
        <p class=title>Site List</p>
        <h1>Click on name to view jobs done on the site.</h1>
        <br>
        <?php 
        	include 'config.php';
          
          // This is safe, since $_POST is converted automatically
          $recSites = pg_query($db, 'SELECT * FROM tblsites ORDER BY fldsitename ASC');
          $arraySites = pg_fetch_all($recSites);
            
          $key = "id";
            if ($recSites) {
              foreach ($arraySites as $key => $site) {
                echo'<p><h1><a href= "jobnumbers.php?num=' . $site["id"].'">'. $site["fldsitename"] . '</a></h1></p>';
              }
                unset($site);
            } else {
                echo "<p>There is a problem retrieving the site information.</p>";
            }
          pg_close($db);
        ?>
      </section>
    </div>
  </body>
</html>