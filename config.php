<?php 
// DB credentials.
$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "{path to CA cert}", NULL, NULL);
mysqli_real_connect($conn, "bloodserver.mysql.database.azure.com", "bloodbank", "RukkuSreya@2024", "bloodbank", 3306, MYSQLI_CLIENT_SSL);
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
