
<!DOCTYPE html>

<html>
  <head>
    <title>Climatec Controls-Job Numbers By Site</title>
  </head>
  <body>
    <p>Job numbers listed by site - not much here yet.</p>
<?php
	include 'config.php';

	$db= pg_connect("host=" . PGHOST . " dbname=" . PGDATABASE . " user=" . PGUSER . " password=" . PGPASSWORD);// or die('Could not connect to database server.');
  
/**
  if ($db) {
	echo "Connection attempt succeeded.<br/>";
  } else {
	echo "Connection attempt failed.<br/>";
  }
**/
//echo $db, "<br/>";
  // This is safe, since $_POST is converted automatically
  $recSites = pg_query($db, 'SELECT * FROM tblsites');
  $recCities = pg_query($db, 'SELECT * FROM tblcities');
  $arraySites = pg_fetch_all($recSites);
  $arrayCities = pg_fetch_all($recCities);
  //print_r($arrayCities);
  /**
  foreach ($arrayCities as $key => $city) {
  	print_r($city["id"]);
  	echo " ";
  	print_r($city["fldcity"]);
  	echo "<br/>";
  }
  **/
$key = "id";
  if ($recSites) {
      echo "Records selected</br>";
      //foreach ($arraySites as $value) {
      foreach ($arraySites as $key => $site) {
      	//echo $site, "<br/>";
      	//echo '$site["fldsitename"]\n';
      	//print_r("Site Name: ",$site["fldsitename"]);
      	echo "Site Name: ";
      	print_r($site["fldsitename"]);
      	echo "<br/>";
      	print_r($site["fldsiteaddress1"]);
      	echo "<br/>";
      	print_r($site["fldsiteaddress2"]);
      	echo "<br/>";
      	print_r($site["fldlocation"]);
      	echo " ";
      	print_r($site["fldzipcode"]);
      	echo "<br/>";
      	print_r($site["fldphone"]);
      	echo "<br/>";
      	echo "<br/><br/>";
      }
      unset($site);
  } else {
      echo "User must have sent wrong inputs\n";
  }

pg_close($db);

?>

  </body>

</html>