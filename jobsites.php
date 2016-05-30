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
        <p class=title>Site Information</p>
        <h1>Click on name to view jobs done on the site.</h1>
        <br>

        <?php 
	       include 'config.php';
          $recSites = pg_query($db, 'SELECT * FROM tblsites ORDER BY fldsitename ASC');
          $arraySites = pg_fetch_all($recSites);
          echo $arraySites["fldsitename"];
            
          $key = "id";
            if ($recSites) {
              foreach ($arraySites as $key => $site) {
                //print_r($site["fldsitename"]);
                echo'<a href= "jobnumbers.php?num=' . $site["id"].'">'. $site["fldsitename"] . '</a>';
                echo "<br/>";
                if (!is_null($site["fldsiteaddress1"])){
                  print_r($site["fldsiteaddress1"]);
                  echo "<br/>";
                }
                if (!is_null($site["fldsiteaddress2"])){
                  print_r($site["fldsiteaddress2"]);
                  echo "<br/>";
                }
                if (!is_null($site["fldlocation"])){
                  $qry = 'SELECT fldcity, fldstate, fldcountry FROM tblcities WHERE id = '.$site["fldlocation"];
                  $recCity = pg_query($db, $qry);
                  $arrayCity = pg_fetch_assoc($recCity);
                  print_r($arrayCity["fldcity"]);
                  echo ", ";
                  print_r($arrayCity["fldstate"]);
                  echo " ";
                }
                print_r($site["fldzipcode"]);

                if (!is_null($site["fldlocation"]) || !is_null($site["fldzipcode"])){
                	echo "<br/>";
                }
                if (!is_null($site["fldphone"])){
                  print_r($site["fldphone"]);
                  echo "<br/>";
                }

                if (!is_null($site["fldsitetype"])){
                  if ($site["fldsitetype"] == "0"){
                    echo "Unknown site type.";
                  } else {
                    $qry = 'SELECT fldsitetype, fldbmsmanufacturer FROM tblsitetypes WHERE id = '. $site["fldsitetype"];
                    $recType = pg_query($db, $qry);
                    $arrayType = pg_fetch_assoc($recType);
                    print_r($arrayType["fldbmsmanufacturer"]);
                    echo " ";
                    print_r($arrayType["fldsitetype"]);
                    if (!is_null($site["fldsoftwarever"])){
                      echo ", version ";
                      print_r($site["fldsoftwarever"]);
                    }            
                  }
                  echo "<br/>";
                }
                /*
                This field isn't currently being used.
                if (!is_null($site["fldglobalcontroller"])){
                  $qry = 'SELECT fldsitetype, fldbmsmanufacturer FROM tblsitetypes WHERE id = '. $site["fldsitetype"];
                  $recType = pg_query($db, $qry);
                  $arrayType = pg_fetch_assoc($recType);
                  print_r($arrayType["fldbmsmanufacturer"]);
                  print_r($site["fldglobalcontroller"]);
                  echo "<br/>";
                }
                */
                if (!is_null($site["fldnotes"])){
                  echo "Notes: ";
                  print_r($site["fldnotes"]);
                  echo "<br/>";
                }

                if (!is_null($site["fldownerdialin"])){
                  echo "Owner dials into site? ";
                  if($site["fldownerdialin"] === "t") {
                    echo "Yes";
                  }else{
                    echo "No";
                  }
                  echo "<br/>";
                }
                  
                if (!is_null($site["fldacctmngrid"])){
                  $qryRole = 'SELECT fldperson FROM tblfunction WHERE id = '. $site["fldacctmngrid"];
                  $recPerson = pg_query($db, $qryRole);
                  $numPerson = pg_fetch_result($recPerson, 0, 0);
                  $qryName = 'SELECT fldfirstname, fldlastname FROM tblpeople WHERE id = '. intval($numPerson);
                  $recAcctMangr = pg_query($db, $qryName);
                  $arrayAcctMangr = pg_fetch_assoc($recAcctMangr);
                  echo "Account Manager: ";
                  print_r($arrayAcctMangr["fldfirstname"]);
                  echo " ";
                  print_r($arrayAcctMangr["fldlastname"]);
                  echo "<br/>";
                }

                if (!is_null($site["fldremote"])){
                  echo "Remote Connection: ";
                  print_r($site["fldremote"]);
                  echo "<br/>";
                }
              	echo "<br/>";


              }
                unset($site);
            } else {
                echo "There is a problem retrieving the site information.\n";
            }

          pg_close($db);

        ?>
      </section>
    </div>

  <?php include('footer.php'); ?>