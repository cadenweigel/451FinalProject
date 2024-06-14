<?php
include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');
?>

<html>

<head>
  <title>Another Simple PHP-MySQL Program</title>
</head>
  
<body bgcolor="white">
  
<?php 
$state = $_POST['state'];
$state = mysqli_real_escape_string($conn, $state);

$queryCollege = "SELECT final_project_db.Colleges.CollegeName, final_project_db.Colleges.CollegeCity, final_project_db.Colleges.CollegeState
                 FROM final_project_db.Colleges WHERE final_project_db.Colleges.CollegeState = ";
$queryCollege = $queryCollege."'".$state."';";

$queryArena = "SELECT final_project_db.Arenas.ArenaName, final_project_db.Arenas.ArenaCity, final_project_db.Arenas.ArenaState
               FROM final_project_db.Arenas WHERE final_project_db.Arenas.ArenaState = ";
$queryArena = $queryArena."'".$state."';";

?>

<p> The query: <p>
<?php print $query; ?>

<p> Result of query: <p>

<?php
//two queries
$resultArena = mysqli_query($conn, $queryArena)
or die(mysqli_error($conn));
$resultCollege = mysqli_query($conn, $queryCollege)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($resultArena, MYSQLI_BOTH))
  {
    print "\n";
    //These should be columns in the table
    print "$row[ArenaName]  $row[ArenaCity]  $row[ArenaState]";
  }
print "</pre>";

mysqli_free_result($resultArena);

print "<pre>";
while($row = mysqli_fetch_array($resultCollege, MYSQLI_BOTH))
  {
    print "\n";
    //These should be columns in the table
    print "$row[CollegeName]  $row[CollegeCity]  $row[CollegeState]";
  }
print "</pre>";

mysqli_free_result($resultCollege);

mysqli_close($conn);

?>	 
 
</body>
</html>