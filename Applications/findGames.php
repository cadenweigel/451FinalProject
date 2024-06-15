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
$team = $_POST['team']; //this is the team id!
$team = mysqli_real_escape_string($conn, $team);
$query = "SELECT 
          final_project_db.Teams.TeamID,
          final_project_db.Teams.TeamName,
          COUNT(final_project_db.Games.GameID) AS HomeGames,
          (COUNT(final_project_db.Games.GameID) * final_project_db.Arenas.attendance) AS TotalAttendance
          FROM 
          final_project_db.Teams
          JOIN 
          final_project_db.Arenas ON final_project_db.Teams.ArenaID = final_project_db.Arenas.ArenaID
          JOIN 
          final_project_db.Games ON final_project_db.Arenas.ArenaID = final_project_db.Games.ArenaID
          WHERE 
          final_project_db.Teams.TeamID = ";
 $query = $query."'".$team."' GROUP BY final_project_db.Teams.TeamID, final_project_db.Teams.TeamName, final_project_db.Arenas.attendance;";
?>

<p> The query: <p>
<?php print $query; ?>

<p> Result of query: <p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    //These should be columns in the table
    print "Team: $row[TeamName]  Total Attendance: $row[TotalAttendance]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>	 
 
</body>
</html>