<?php
include("../db_connection/data_connection.php");
include '../header/session.php';

//--Fixed Place Ids ----
$place_id=$_GET['pid'];
$uid = $_SESSION['iduser'];
//event loggers
$file_deleted = 0;

$get_user_data_query = "SELECT username,email FROM user WHERE id = $uid";
$result_user = mysqli_query($connection, $get_user_data_query);
while ($row_user=mysqli_fetch_assoc($result_user)){
    $usrnm = $row_user['username'];
    $email = $row_user['email'];
    //getting the folder name 
    $folder_name = $usrnm."_".$email."_"."img"; 
}


$get_img_name_query = "SELECT id,path FROM images WHERE pid = $place_id";
$img_name_result = mysqli_query($connection, $get_img_name_query);

while ($row=mysqli_fetch_assoc($img_name_result)){
    $imgName = $row['path'];
    $img_id = $row['id'];
    unlink("../uploads/$folder_name/$imgName");
    $dlt_img_record_query = "DELETE FROM images WHERE id = $img_id;";
    $dlt_img_record_result = mysqli_query($connection,$dlt_img_record_query);
    $file_deleted++;
}


$delete_place_query="DELETE FROM places WHERE id= $place_id";
$result_dlt_place=mysqli_query($connection,$delete_place_query);

if($result_dlt_place && $file_deleted > 0){
    header("Location:../dashboard.php");
}
else{
    echo "Error:";
}



?>