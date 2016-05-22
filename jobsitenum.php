<?php
// gotta have a session to see anything
session_start();
if (($_SESSION['loggedin'] != 1) || ($_SESSION['active'] == "f")){
  header("Location: index.php"); 
  exit; 
}
?>
<!DOCTYPE html>
<html>
<?php include('header.php'); ?>
  <head>
    <title>Climatec Controls-Job Numbers By Site</title>
  </head>
  <body>
    <div>
        <h3>Job Sites</h3>
        <?php
        	include 'config.php';
          
          // This is safe, since $_POST is converted automatically
          $recSites = pg_query($db, 'SELECT * FROM tblsites ORDER BY fldsitename ASC');
          $arraySites = pg_fetch_all($recSites);
            
          $key = "id";
            if ($recSites) {
              foreach ($arraySites as $key => $site) {
                echo'<a href= "jobnumbers.php?num=' . $site["id"].'">'. $site["fldsitename"] . '</a>';
                echo "<br/>";
              }
                unset($site);
            } else {
                echo "There is a problem retrieving the site information.\n";
            }

          pg_close($db);

        ?>
    </div>
  </body>

</html>