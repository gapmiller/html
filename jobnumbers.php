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
      $sitenum = filter_input(INPUT_GET, 'num', FILTER_VALIDATE_INT);
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
        // additional queries testing out joins to get names instead of numbers
        /*$qry1 = "SELECT P.*,
            P1.fldfirstname, P1.fldlastname,
            P2.fldfirstname, P1.fldlastname,
            P3.fldfirstname, P1.fldlastname,
            P4.fldfirstname, P1.fldlastname
           FROM tbljobnumbers P
            LEFT JOIN tblpeople P1 on P.fldsalesman = P1.id
            LEFT JOIN tblpeople P2 on P.fldprojectmanager = P2.id
            LEFT JOIN tblpeople P3 on P.fldengineer = P3.id
            LEFT JOIN tblpeople P4 on P.fldleadinstaller = P4.id
        WHERE fldsiteid = " . $sitenum . 
        ' ORDER BY fldjobnumber ASC';
        $qry2 = "SELECT P.*,
            P1.*,
            P2.*,
            P3.*,
            P4.*
           FROM tbljobnumbers P
            LEFT JOIN tblpeople P1 on P.fldsalesman = P1.id
            LEFT JOIN tblpeople P2 on P.fldprojectmanager = P2.id
            LEFT JOIN tblpeople P3 on P.fldengineer = P3.id
            LEFT JOIN tblpeople P4 on P.fldleadinstaller = P4.id
        WHERE fldsiteid = " . $sitenum . 
        ' ORDER BY fldjobnumber ASC';
        $qry3 = "SELECT P.*,
            P1.fldfirstname, P1.fldlastname,
            P2.fldfirstname, P1.fldlastname,
            P3.fldfirstname, P1.fldlastname,
            P4.fldfirstname, P1.fldlastname
           FROM tbljobnumbers P
            LEFT JOIN tblpeople P1 on P1.id = P.fldsalesman
            LEFT JOIN tblpeople P2 on P2.id = P.fldprojectmanager
            LEFT JOIN tblpeople P3 on P3.id = P.fldengineer
            LEFT JOIN tblpeople P4 on P4.id = P.fldleadinstaller
        WHERE fldsiteid = " . $sitenum . 
        ' ORDER BY fldjobnumber ASC';
*/
        $recJobs = pg_query($db, $qry);
        $arrayJobs = pg_fetch_all($recJobs);
        $key = "id";
        echo $arrayJobs["0 ==> fldjobnumber"];
        echo "<br>";
        // verify there are jobs for site
        if ($recJobs) {
          //print header - use this later I figure out joins
          //echo "Job Number | Job Name | Warranty Start |Warranty End | Sales Person |  
          // Project Manager | Programmer | Lead Installer |<br>";
          //print header 
          echo "Job Number | Job Name <br>";
          //check if it has any job information
          foreach ($arrayJobs as $key => $job) {
            // need to figure out how to display the rest of the data with JOINs or other means
            //$salesmanid = $job["fldsalesman"];
            //$recPeople = pg_query($db, 'SELECT fldfirstname, fldlastname FROM tblepeople WHERE = ' . $job["fldsalesman"]);
            //$arrayPeople = pg_fetch_all($recPeople);
            //$salesman = $arrayPeople['fldfirstname'] . " ". $arrayPeople["fldlastname"];
            /*$salesmanid = $job["fldsalesman"];
            $salesman = $job["first"];
            //echo Getname($job["fldsalesman"] . ", " . $salesman . "<br/>";
            echo $job["fldsalesman"] . ", " . $salesmanid . "<br/>";
            //$salesman = "";
            $projectmanager = "";
            $engineer = "";
            $leadinstaller = "";*/
            echo $job["fldjobnumber"] . ' | ' . 
            $job["fldjobname"] . ' | ' .
            
            /*
            Need revise this section to display additional job info
            $job["fldwarrstart"] . ' | ' .
            $job["fldwarrend"] . ' | ' .
            $salesman . ', '. $job["fldsalesman"]. ' | ' .
            //$job["fldsalesman"] . ' | ' .
            $job["fldprojectmanager"] . ' | ' .
            $job["fldengineer"] . ' | ' .
            $job["fldleadinstaller"] */
             "<br/>";
        }
          // if job information exists, print it for each job on site
          unset($recJobs);

        }else{
           //if no job information exists, print message and die
          echo "No job information found for this site.";
        }
      }
    pg_close($db);

    function Getname ($personid) {
      $recPeople = pg_query($db, 'SELECT fldfirstname, fldlastname FROM tblpeople WHERE = ' . $personid);
      $arrayPeople = pg_fetch_all($recPeople);
      echo $job["fldsalesman"] . ", " . $personid . ", " . $arrayPeople . "<br/>";
      return $fullname = $arrayPeople['fldfirstname'] . " ". $arrayPeople["fldlastname"];
    }

    ?>
  </body>
</html>