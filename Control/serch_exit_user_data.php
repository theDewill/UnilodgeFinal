<?php
//import the database connection 
include '../db_connection/data_connection.php';

//declearing the variable to assing the data from the database
$db_email="";
$db_use_name ="";
$db_uid="";
$db_nic="";
$db_pass="";
$db_name="";

//sql query to serch the data base 
$sql="SELECT * FROM user WHERE email='$email' || uname='$use_name'";

//$sql="SELECT * FROM user";

//exhicuting the quary
$result=mysqli_query($connection,$sql);

//rectrivee the data to search that the users with the same user name [which are already in the DB]
while ($row=mysqli_fetch_array($result)) {
	$db_email=$row['email'];
    $db_use_name = $row['username'];
    $db_uid = $row['id'];
    $db_nic = $row['nic'];
    $db_pass = $row['passwd'];
    $db_name = $row['uname'];


}

?>