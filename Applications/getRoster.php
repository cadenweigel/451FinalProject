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
         final_project_db.Players.PlayerID,
         final_project_db.Players.FirstName,
         final_project_db.Players.LastName,
         final_project_db.Players.Salary,
         final_project_db.Teams.TeamName
        FROM 
         final_project_db.Players 
        JOIN 
         final_project_db.Teams ON final_project_db.Players.TeamID = final_project_db.Teams.TeamID
        WHERE 
         final_project_db.Players.TeamID = ";
$query = $query."'".$team."';"; 

$query2 = "SELECT 
            final_project_db.Teams.TeamName,
            AVG(final_project_db.Players.Salary) AS AverageSalary
            FROM 
            final_project_db.Players
            JOIN 
            final_project_db.Teams ON final_project_db.Players.TeamID = final_project_db.Teams.TeamID
            WHERE 
            final_project_db.Players.TeamID = ";
$query = $query."'".$team."' GROUP BY final_project_db.Teams.TeamName;";
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
    print "Name: $row[FirstName] $row[LastName]  Salary: $row[Salary]";
  }
print "</pre>";

$result2 = mysqli_query($conn, $query2)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    //These should be columns in the table
    print "Team: $row[TeamName]  Salary: $row[AverageSalary]";
  }
print "</pre>";

mysqli_free_result($result);
mysqli_free_result($result2);

mysqli_close($conn);

?>	 
 
</body>
</html>