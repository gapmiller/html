<?php

        echo "<table id='jobs'>";
        echo "<tr><th>Job Number</th> <th>Job Name </th><td>Warranty Start </td><td>Warranty End </td>
            <td>Sales Person </td><td>Project Manager </td><td>Programmer </td><td>Lead Installer </td></tr>";

        // query for site jobs
        $qry = "SELECT * FROM tbljobnumbers WHERE fldsiteid = " . $sitenum . ' ORDER BY fldjobnumber ASC';
        $recJobs = pg_query($db, $qry);
        $arrayJobs = pg_fetch_all($recJobs);
        $key = "id";
                
        //echo $arrayJobs;
        // verify there are jobs for site
        if ($recJobs) {
          //print header - use this later I figure out joins

          //check if it has any job information
          foreach ($arrayJobs as $key => $job) {
            echo "<tr>";
            $salesman = Getname ($job["fldsalesman"], $db);
            $projectmanager = Getname ($job["fldprojectmanager"], $db);
            $engineer = Getname ($job["fldengineer"], $db);
            $leadinstaller = Getname ($job["fldleadinstaller"], $db);
            echo "<td>" . $job["fldjobnumber"] . "</td>";

            if ($job["fldjobname"]!= ""){
              echo "<td>" . $job["fldjobname"] .  "</td>";  
            }else{
              echo "<td>" . "no data" . "</td>";
            }

            if ($job["fldwarrstart"]!= ""){
              echo "<td>" . $job["fldwarrstart"] . "</td>";  
            }else{
              echo "<td>" . "no data" . "</td>";
            }

            if ($job["fldwarrend"]!= ""){
              echo "<td>" . $job["fldwarrend"] . "</td>";  
            }else{
              echo "<td>" . "no data" . "</td>";
            }

            echo "<td>" . $salesman . "</td>";
            echo "<td>" . $projectmanager . "</td>";
            echo "<td>" . $engineer . "</td>";
            echo "<td>" . $leadinstaller . "</td>";
            echo "</tr>";
        }
          // if job information exists, print it for each job on site
          unset($recJobs);

        }else{
           //if no job information exists, print message and die
          echo "No job information found for this site.";
        }
      }
      
      echo "</table>";
?>