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
$playerFirst = $_POST['playerFirst'];
$playerFirst = mysqli_real_escape_string($conn, $playerFirst);
$playerLast = $_POST['playerLast'];
$playerLast = mysqli_real_escape_string($conn, $playerLast);

$query = "SELECT 
    final_project_db.P.FirstName,
    final_project_db.P.LastName,
    final_project_db.T.TeamName,
    final_project_db.C.CollegeName,
    final_project_db.CO.CoachName,
    final_project_db.A.AgentName
FROM 
    final_project_db.Players P
JOIN 
    final_project_db.Teams T ON P.TeamID = T.TeamID
JOIN 
    final_project_db.Colleges C ON P.CollegeID = C.CollegeID
JOIN 
    final_project_db.Coaches CO ON T.CoachID = CO.CoachID
JOIN 
    final_project_db.Agents A ON P.AgentID = A.AgentID
WHERE 
    P.FirstName = ";
    
$query = $query."'".$playerFirst."' AND P.LastName = ";
$query = $query."'". $playerLast."';";

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
    print "Name: $row[FirstName] $row[LastName]  Team: $row[TeamName]  College: $row[CollegeName] Coach: $row[CoachName]  Agent: $row[AgentName]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>	 
 
</body>
</html>