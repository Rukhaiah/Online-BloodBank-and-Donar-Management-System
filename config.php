<?php 
// DB credentials.
$server = "bloodserver.mysql.database.azure.com";
$userid ="bloodbank";
$Password = "RukkuSreya@2024";
$myDB = "bloodbank";
$con = mysqli_connect($server,$userid,$Password,$myDB);
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
