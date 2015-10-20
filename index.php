<!DOCTYPE html>

<html>
  <head>
    <title>Climatec Controls</title>
    <h2>Climatec Controls Job Sites and Job Numbers</h2>
  </head>
<?php include_once("controller/Controller.php");  
  
$controller = new Controller();  
$controller->invoke();  
?>
  <body>
    <p><a href="view/jobsites.html">Job numbers listed by site</a></p>
    <p><a href="view/sites.html">Sites</a></p>
    <p><a href="view/jobnums.html">Job numbers</a></p>
    <p><a href="view/oldnames.html">Sites listed by previous names</a></p>
  </body>


</html>
