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
$playerFirst = $_POST['playerFirst'];
$playerFirst = mysqli_real_escape_string($conn, $playerFirst);
$playerLast = $_POST['playerLast'];
$playerLast = mysqli_real_escape_string($conn, $playerLast);
$type = $_POST['type'];
$playerLast = mysqli_real_escape_string($conn, $type);

$cost = 0;
if ($type == "Home"){
    $cost = 100;
}
if ($type == "Away"){
    $cost = 110;
}
if ($type == "Alternate"){
    $cost = 120;
}
if ($type == "Retro"){
    $cost = 130;
}

$idquery = "SELECT final_project_db.Players.PlayerID
FROM final_project_db.Players
WHERE final_project_db.Players.FirstName = ";
$idquery = $idquery."'".$playerFirst."' AND final_project_db.Players.LastName = ";
$idquery = $idquery."'".$playerLast."' ;";
$idresult = mysqli_query($conn, $idquery) or die(mysqli_error($conn));
$row = mysqli_fetch_array($idresult, MYSQLI_BOTH);
$playerID = $row['PlayerID'];

//to get a unique orderID, we need the highest current OrderID (they all increment by 1 each row) and add 1 to it
$orderquery = "SELECT MAX(final_project_db.Purchases.OrderID) AS HighestOrderID FROM final_project_db.Purchases";
$orderresult = mysqli_query($conn, $orderquery) or die(mysqli_error($conn));
$row = mysqli_fetch_array($orderresult, MYSQLI_BOTH);
$orderID = $row['HighestOrderID'] + 1;

print $orderID;
print "     ";
print $playerID;
print "     ";
print $team;
print "     ";
print $cost;
print "     ";
print $type;

$query = "INSERT INTO Purchases (OrderID, PlayerID, TeamID, Cost, JerseyType) VALUES (";
$query = $query.$orderID.",";
$query = $query.$playerID.",";
$query = $query.$team.",";
$query = $query.$cost.",";
$query = $query."'".$type."' );";
print $query;
mysqli_query($conn, $query) or die(mysqli_error($conn));
?>

<p> The query: <p>
<?php print $query; ?>

<p>Purchase Added!</p>

mysqli_close($conn);

</body>
</html>