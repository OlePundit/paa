<?php 
// DB credentials.
//define('DB_HOST','localhost');
//define('DB_USER','rentersh_administrator');
//define('DB_PASS','BR$SO-&ruzN$');
//define('DB_NAME','rentersh_rentershub');

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','paa');
// Establish database connection.

date_default_timezone_set('Africa/Nairobi');

try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>