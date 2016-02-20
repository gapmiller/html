<?php
session_start();
if ($_SESSION['loggedin'] != 1){
  header("Location: index.php"); 
  exit; 
}

include 'config.php';

$db= pg_connect("host=" . PGHOST . " dbname=" . PGDATABASE . " user=" . PGUSER . " password=" . PGPASSWORD);// or die('Could not connect to database server.');
  
?>

<?php
  if ($db) {
	echo "Connection attempt succeeded.<br/>";
  } else {
	echo "Connection attempt failed.<br/>";
  }

echo $db, "<br/>";
  // This is safe, since $_POST is converted automatically
  $rec = pg_query($db, 'SELECT * FROM tblsites');
  $myarray = pg_fetch_all($rec);
  print_r($myarray);
print_r($rec);

  if ($rec) {
      echo "Records selected</br>";
      var_dump($rec);
  } else {
      echo "User must have sent wrong inputs\n";
  }

pg_close($db);

?>
