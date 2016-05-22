<?php
// gotta have a session to see anything
session_start();
if (($_SESSION['loggedin'] != 1) || ($_SESSION['active'] == "f")){
  header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>
<?php include('header.php'); ?>
  <head>
    <title>Climatec Controls-Job Numbers</title>
  </head>
  <body>
    <h3>Job Numbers</h3>
<?php
  include 'config.php';

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