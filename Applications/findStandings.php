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
$standing = $_POST['standings'];
$standing = mysqli_real_escape_string($conn, $state);

//query will be different based on the value of standing
if ($standing == "all"){
    $query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses 
              FROM final_project_db.Teams ORDER BY final_project_db.Teams.Wins DESC";
}
else if ($standing == "west"){
    $query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses
              FROM final_project_db.Teams JOIN final_project_db.Divisions ON final_project_db.Teams.Division = Divisions.Division
              WHERE  final_project_db.Divisions.Conference = "Western" ORDER BY final_project_db.Teams.Wins DESC";
}
else if ($standing == "east"){
    $query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses
              FROM final_project_db.Teams JOIN final_project_db.Divisions ON final_project_db.Teams.Division = Divisions.Division
              WHERE  final_project_db.Divisions.Conference = "Eastern" ORDER BY final_project_db.Teams.Wins DESC";
}
else if ($standing == "central"){
    $query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses 
              FROM final_project_db.Teams WHERE Division = "Central" ORDER BY Wins DESC";
}
else if ($standing == "atlantic"){
  $query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses 
            FROM final_project_db.Teams WHERE Division = "Atlantic" ORDER BY Wins DESC";
}
else if ($standing == "southeast"){
  $query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses 
            FROM final_project_db.Teams WHERE Division = "Southeast" ORDER BY Wins DESC";
}
else if ($standing == "northwest"){
  $query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses 
            FROM final_project_db.Teams WHERE Division = "Northwest" ORDER BY Wins DESC";
}
else if ($standing == "pacific"){
$query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses 
          FROM final_project_db.Teams WHERE Division = "Pacific" ORDER BY Wins DESC";
}
else if ($standing == "southwest"){
$query = "SELECT final_project_db.Teams.TeamName, final_project_db.Teams.Wins, final_project_db.Teams.Losses 
          FROM final_project_db.Teams WHERE Division = "Southwest" ORDER BY Wins DESC";
}
?>

<p> The query: <p>
<?php print $query; ?>

<p> Result of query: <p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
$position = 1;
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    //These should be columns in the table
    print "$position: $row[TeamName]  $row[Wins]  $row[Losses]";
    $position = $position + 1;
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>	 
 
</body>
</html>