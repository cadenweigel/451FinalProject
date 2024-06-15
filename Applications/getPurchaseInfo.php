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
$query = "SELECT 
        final_project_db.Players.FirstName,
        final_project_db.Players.LastName,
        MostPurchases.TotalCost,
        MostPurchases.MostCommonType
        FROM
        final_project_db.Players
        JOIN
        (SELECT 
         PlayerID,
         SUM(Cost) AS TotalCost,
         JerseyType AS MostCommonType
        FROM 
            (SELECT 
                PlayerID,
                Cost,
                JerseyType,
                RANK() OVER (PARTITION BY PlayerID ORDER BY COUNT(JerseyType) DESC) AS TypeRank
            FROM final_project_db.Purchases
            GROUP BY PlayerID, Cost, JerseyType) TypeRanks
            WHERE TypeRank = 1
            GROUP BY PlayerID, Cost, JerseyType
            ORDER BY COUNT(PlayerID) DESC
            LIMIT 10) MostPurchases
        ON 
        Players.PlayerID = MostPurchases.PlayerID;";
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
    print "Top Best-Selling Jerseys"
    print "Player: $row['FirstName'] $row['LastName']  Jersey Type: $row['MostCommonType]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>	 
 
</body>
</html>