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
$player = $_POST['player'];
$player = mysqli_real_escape_string($conn, $player);

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
    print "$row[FirstName] $row[LastName]  Team: $row[TeamName]  Coach: $row[CoachName]  Agent: $row[AgentName]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>	 
 
</body>
</html>