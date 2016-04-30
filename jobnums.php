
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
    <title>Climatec Controls-Job Numbers</title>
  </head>
  <body>
    <h3>Job Numbers</h3>
<?php
  include 'config.php';

  //$db= pg_connect("host=" . PGHOST . " dbname=" . PGDATABASE . " user=" . PGUSER . " password=" . PGPASSWORD) or die('Could not connect to database server.');
  $db = postg_connect();

  // This is safe, since $_POST is converted automatically
  //$recJobs = pg_query($db, 'SELECT * FROM tbljobnumbers  WHERE fldsiteid = 32 ORDER BY fldjobnumber ASC');
  $recJobs = pg_query($db, 'SELECT * FROM tbljobnumbers ORDER BY fldjobnumber ASC');
  $arrayJobnums = pg_fetch_all($recJobs);
  $counter = 1;
  $key = "id";
    if ($recJobs) {
      foreach ($arrayJobnums as $key => $jobnum) {
        print_r($counter);
        echo ", ";
        print_r($jobnum["fldjobnumber"]);
        echo ", ";

        print_r($jobnum["fldjobname"]);  
        echo "<br/>";
        $counter++;
      }
        unset($jobnum);
    } else {
        echo "There is a problem retrieving the site information.\n";
    }

  pg_close($db);

?>

  </body>

</html>