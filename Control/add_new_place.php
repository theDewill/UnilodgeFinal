<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" href="../style/error_msg.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>
<?php

//added b type
// fixed reving map cordinates
// updated to store multiple files

include '../db_connection/data_connection.php';

session_start();

$uid = $_SESSION['iduser'];

$bord_name = $_POST['bord_name'];
$bord_address=$_POST['bord_address'];
$bord_number = $_POST['con_num'];
$num_room = $_POST['num_of_room'];
$price = $_POST['price'];    
$facility = $_POST['face_dis'];
$bord_type = $_POST['Boarding'];
$bord_gender = $_POST['gender'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$input_field_keys = ["img1","img2","img3","img4"];
$file_cnt_checker = 0;

//----TESTING----
// $IMG_1 = $_FILES['img1'];
// $IMG_2 = $_FILES['img2'];
// $IMG_3 = $_FILES['img3'];
// $IMG_1 = $_FILES['img4'];

//----NEWLY ADDED ------

    $query = "SELECT username, email FROM user WHERE id = '$uid'";
    $result = mysqli_query($connection, $query);
    $cnt_file_pushes = 0;
    $cnt_image_name_pushes = 0;

    //path for the image construction
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $email = $row['email'];
        $folder_name = $username."_".$email."_"."img"; //-Name Constructor For View Branch --> $username."_".$email."_"."img/".$filename (retrived from DB)
    }

//signal evnt
    

    //inserting the text data to places table to obtain pid and push image data to images table
    $data_insert_query = "INSERT INTO places (pname,address,phone_number,rooms,price,facilities,boarding_type,gender,latitude,longitude,uid) VALUES ('$bord_name','$bord_address',$bord_number,$num_room,$price,'$facility','$bord_type','$bord_gender',$lat,$lng,$uid);"; 
    $data_insert_result = mysqli_query($connection,$data_insert_query);

    
    
    if($data_insert_result){
        //added multiple image store
        $recieve_pid_query = "SELECT id FROM places WHERE pname = '$bord_name' AND address = '$bord_address';";
        $pid_query_result = mysqli_query($connection,$recieve_pid_query);
        $row_pid = mysqli_fetch_assoc($pid_query_result);
        $pid = $row_pid["id"];

        //Got the pid now , proceeding to record data in images

// CODE GOOD----

    foreach($input_field_keys as $key){
             //added later
            $file_name = $_FILES[$key]["name"];
            $temp_name = $_FILES[$key]["tmp_name"];
            $upload_file = move_uploaded_file($temp_name,"../uploads/$folder_name/$file_name");
            if($upload_file == 1) $cnt_file_pushes ++;
            //image name push
            $img_name_query = "INSERT INTO images (pid,path) VALUES ($pid,'$file_name');";
            $img_name_push_result = mysqli_query($connection, $img_name_query);
            if($img_name_push_result){
                $cnt_image_name_pushes++;
            } 
    }

    //deleting empty files
    $dlt_img_query = "DELETE FROM images WHERE path = '';";
    $dlt_result = mysqli_query($connection, $dlt_img_query);


    
    //pushing image names to images [ need pid ] NA
    if($cnt_file_pushes == 4 && $cnt_image_name_pushes==4){
//------Updated Content [END]---------

//added later
        header("location: ../dashboard.php");
    } else if($cnt_file_pushes < 4){
        echo '<div class="responsive-div">
    <div class="alert alert-danger" role="alert">
        <h3>4 Images Required</h3>
        </div>
</div>';
    }else {
        echo '<div class="responsive-div">
    <img src="../images/error_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
    <div class="alert alert-danger" role="alert">
        <h3>Upload Process Disturbed... Try Agin Later..</h3>
        </div>
</div>';
    }
}

    
    
?>   
    
  

    












</body>
</html>