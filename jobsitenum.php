
<!DOCTYPE html>


<?php
// gotta have a session to see anything
session_start();
if ($_SESSION['loggedin'] != 1){
  header("Location: index.php"); 
  exit; 
}
?>

<html>
  <head>
    <title>Climatec Controls-Job Numbers By Site</title>
  </head>
  <body>
    <h3>Job Sites</h3>
<?php
	include 'config.php';

	//$db= pg_connect("host=" . PGHOST . " dbname=" . PGDATABASE . " user=" . PGUSER . " password=" . PGPASSWORD) or die('Could not connect to database server.');
  $db = postg_connect();

  // This is safe, since $_POST is converted automatically
  $recSites = pg_query($db, 'SELECT * FROM tblsites ORDER BY fldsitename ASC');
  $arraySites = pg_fetch_all($recSites);
    
  $key = "id";
    if ($recSites) {
      foreach ($arraySites as $key => $site) {
        print_r($site["fldsitename"]);
        echo "<br/>";
      }
        unset($site);
    } else {
        echo "There is a problem retrieving the site information.\n";
    }

  pg_close($db);

?>

  </body>

</html>