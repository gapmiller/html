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
    <title>Climatec Controls-Job Numbers</title>
  </head>

  <body>
    <?php

//should use JOIN to get names?
    function Getname ($personid, $db) {
      //include 'config.php'; 
      $recPeople = pg_query($db, 'SELECT fldfirstname, fldlastname FROM tblpeople WHERE id = ' . $personid);
      $arrayPeople = pg_fetch_assoc($recPeople);
      if ($arrayPeople){
        $fullname = " " . $arrayPeople['fldfirstname'] . " ". $arrayPeople["fldlastname"] . " |";  
      }else{
        $fullname = " no data |";
      }
      return $fullname;
    }


      $sitenum = 1068;
      if($sitenum==NULL){
        echo "That is not a valid site request.";
      }else{
        //connect to database
        include 'config.php';
        // query for site info
        $recSites = pg_query($db, 'SELECT * FROM tblsites WHERE id =' . $sitenum);
        $arraySites = pg_fetch_assoc($recSites);
        echo nl2br($arraySites["fldsitename"] . "\n");
        
        if (!is_null($arraySites["fldsiteaddress1"])){
          echo nl2br($arraySites["fldsiteaddress1"] . "\n");
        }

        if (!is_null($arraySites["fldsiteaddress2"])){
          echo nl2br($arraySites["fldsiteaddress2"] . "\n");
        }
         
        if (!is_null($arraySites["fldlocation"])){
          $qry = 'SELECT fldcity, fldstate, fldcountry FROM tblcities WHERE id = '.$arraySites["fldlocation"];
          $recCity = pg_query($db, $qry);
          $arrayCity = pg_fetch_assoc($recCity);
          echo nl2br($arrayCity["fldcity"] . ", " . $arrayCity["fldstate"] . " ");
        }
        print_r($arraySites["fldzipcode"]);

        if (!is_null($arraySites["fldlocation"]) || !is_null($arraySites["fldzipcode"])){
          echo "<br/>";
        }

        if (!is_null($arraySites["fldphone"])){
          echo nl2br($arraySites["fldphone"] . "\n");
        }
        
        if (!is_null($arraySites["fldsitetype"])){
          if ($arraySites["fldsitetype"] == "0"){
            echo "Unknown site type.";
          } else {
            $qry = 'SELECT fldsitetype, fldbmsmanufacturer FROM tblsitetypes WHERE id = '. $arraySites["fldsitetype"];
            $recType = pg_query($db, $qry);
            $arrayType = pg_fetch_assoc($recType);
            echo nl2br($arrayType["fldbmsmanufacturer"] . " " . $arrayType["fldsitetype"]);
            if (!is_null($arraySites["fldsoftwarever"])){
              echo ", version ";
              print_r($arraySites["fldsoftwarever"]);
            }
          }
        }
          echo "<br/>";
        // query for site jobs
        $qry = "SELECT * FROM tbljobnumbers WHERE fldsiteid = " . $sitenum . ' ORDER BY fldjobnumber ASC';
        $recJobs = pg_query($db, $qry);
        $arrayJobs = pg_fetch_all($recJobs);
        $key = "id";
        echo "<br>";
        echo $arrayJobs;
        // verify there are jobs for site
        if ($recJobs) {
          //print header - use this later I figure out joins
          echo "Job Number | Job Name | Warranty Start |Warranty End | Sales Person |  
           Project Manager | Programmer | Lead Installer |<br>";
          //check if it has any job information
          foreach ($arrayJobs as $key => $job) {
            $salesman = Getname ($job["fldsalesman"], $db);
            $projectmanager = Getname ($job["fldprojectmanager"], $db);
            $engineer = Getname ($job["fldengineer"], $db);
            $leadinstaller = Getname ($job["fldleadinstaller"], $db);
            echo $job["fldjobname"];

            if ($job["fldjobname"]!= ""){
              echo $job["fldjobname"] . ' | ';  
            }else{
              echo " no data |";
            }

            if ($job["fldwarrstart"]!= ""){
              echo $job["fldwarrstart"] . ' | ';  
            }else{
              echo " no data |";
            }

            if ($job["fldwarrend"]!= ""){
              echo $job["fldwarrend"] . ' | ';  
            }else{
              echo " no data |";
            }

            echo $salesman;
            echo $projectmanager;
            echo $engineer;
            echo $leadinstaller;
            echo "<br/>";
        }
          // if job information exists, print it for each job on site
          unset($recJobs);

        }else{
           //if no job information exists, print message and die
          echo "No job information found for this site.";
        }
      }
    pg_close($db);


    ?>
  </body>
</html>