<?php
// gotta have a session to see anything
session_start();
if (($_SESSION['loggedin'] != 1) || ($_SESSION['active'] == "f")){
	header("Location: index.php");
	if ($_SESSION['message1'] != NULL){
	    echo $_SESSION['message1'];
	}
  exit; 
}
?>
<!DOCTYPE html>
<html>
<?php include('header.php'); ?>
  <head>
    <title>Climatec Controls-Old Job Names</title>
  </head>
  <body>
  	<?php
	    //connect to database
	    include 'config.php';
	    echo "Old Site Names";
      echo "<br>";
        // query for old name info
        $recOldNames = pg_query($db, 'SELECT * FROM tbloldnames *ORDER BY fldoldname ASC');
        $arrayOldNames = pg_fetch_all($recOldNames);
        $key = "id";
        //echo $arrayOldNames[0][id];
        foreach ($arrayOldNames as $key => $oldname) {
        	echo nl2br($oldname["fldoldname"] . "\n");
	        $recSites = pg_query($db, 'SELECT fldsitename FROM tblsites WHERE id =' . $sitenum);
	        $arraySites = pg_fetch_assoc($recSites);
	        //echo'<a href= "jobnumbers.php?num=' . $site["id"].'">'. $site["fldsitename"] . '</a>';
        	//echo nl2br($oldname["fldoldname"] . " -> " . '<a href= "jobnumbers.php?num=' . $oldname["fldcurrentname"].'">'. $oldname["fldcurrentname"] . 
          //  '</a>'$oldname["fldcurrentname"] . "\n");
        }
    ?>
  </body>


</html>