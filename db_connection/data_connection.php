<?php
// ("server" , "username" ,"password","database_name","port number")

$host = "54.90.68.200";
$port = 3306;
$root_user = "root";
$pass = "rootpass";
$DB = "Unilodge";

$connection = mysqli_connect($host,$root_user,$pass,$DB,$port);

//checking for the errors in the database connections
if(mysqli_connect_errno()) {
    echo mysqli_connect_errno();
}
?>
