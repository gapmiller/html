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

<?php include('header.php'); ?>

    <div class="container">
      <section>
    <?php
    echo "<div class='siteinfo'>";
//should use JOIN to get names?
    function Getname ($personid, $db) {
      //include 'config.php'; 
      $recPeople = pg_query($db, 'SELECT fldfirstname, fldlastname FROM tblpeople WHERE id = ' . $personid);
      $arrayPeople = pg_fetch_assoc($recPeople);
      if ($arrayPeople){
        $fullname = " " . $arrayPeople['fldfirstname'] . " ". $arrayPeople["fldlastname"];  
      }else{
        $fullname = " no data";
      }
      return $fullname;
    }

      $sitenum = filter_input(INPUT_GET, 'num', FILTER_VALIDATE_INT);
      
      if($sitenum==NULL){
        echo "That is not a valid site request.";
      }else{
        //connect to database
        include 'config.php';

        echo "<p>";
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
        echo "</p>";
        echo "</div>";
        
        include ('jobs.php');

    pg_close($db);
    ?>
    </section>
  </div>
  </body>
</html>