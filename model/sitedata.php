<?php
$PGHOST = "localhost";
$PGPORT = "5432";
$PGDATABASE = "postgres";
$PGUSER = "btg_admin";
$PGPASSWORD= "m9894gapm";
$PGHOSTADDR= "127.0.0.1";

$db= pg_connect("host=$PGHOST dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD");


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
