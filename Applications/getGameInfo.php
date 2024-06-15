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
$query1 = "SELECT 
    final_project_db.Teams.TeamName,
    WinCount.Wins
FROM
    Teams
JOIN
    (SELECT 
         WinnerID AS TeamID,
         COUNT(WinnerID) AS Wins
     FROM 
         final_project_db.Games
     GROUP BY 
         WinnerID
     ORDER BY 
         Wins DESC
     LIMIT 1) WinCount
ON 
    final_project_db.Teams.TeamID = WinCount.TeamID;";

$query2 = "SELECT 
    final_project_db.Teams.TeamName,
    LossCount.Losses
FROM
    Teams
JOIN
    (SELECT 
         LoserID AS TeamID,
         COUNT(LoserID) AS Losses
     FROM 
         final_project_db.Games
     GROUP BY 
         LoserID
     ORDER BY 
         Losses DESC
     LIMIT 1) LossCount
ON 
    final_project_db.Teams.TeamID = LossCount.TeamID;";

$query3 = "SELECT 
    final_project_db.Arenas.ArenaName,
    final_project_db.Teams.TeamName,
    ArenaCount.GameCount
FROM 
    final_project_db.Arenas
JOIN 
    (SELECT 
         ArenaID,
         COUNT(ArenaID) AS GameCount
     FROM 
         Games
     GROUP BY 
         ArenaID
     ORDER BY 
         GameCount DESC
     LIMIT 1) ArenaCount
ON 
    Arenas.ArenaID = ArenaCount.ArenaID
JOIN 
    final_project_db.Teams
ON 
    Arenas.TeamID = Teams.TeamID;";
?>

<p> The querys: <p>
<?php print $query1; print "\n";?>
<?php print $query2; print "\n";?>
<?php print $query3; print "\n";?>

<p> Results of queries: <p>

<?php
$result1 = mysqli_query($conn, $query1)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result1, MYSQLI_BOTH))
  {
    print "\n";
    //These should be columns in the table
    print "Team: $row[TeamName]  Wins: $row[Wins]";
  }
print "</pre>";

$result2 = mysqli_query($conn, $query2)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result2, MYSQLI_BOTH))
  {
    print "\n";
    //These should be columns in the table
    print "Team: $row[TeamName]  Losses: $row[Losses]";
  }
print "</pre>";

$result3 = mysqli_query($conn, $query3)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result3, MYSQLI_BOTH))
  {
    print "\n";
    //These should be columns in the table
    print "Team: $row[TeamName]  Arena: $row[ArenaName]  Home Hames: $row[GameCount]";
  }
print "</pre>";

mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result3);

mysqli_close($conn);

?>	 
 
</body>
</html>