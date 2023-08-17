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

//---Objective - [ Hnadling Image Files ]


include '../db_connection/data_connection.php';

session_start();
$uid = $_SESSION['iduser'];


$bord_name = $_POST['bord_name'];
$bord_address=$_POST['bord_address'];

$input_field_keys = ['img-1','img-2','img-3','img-4'];

    $query = "SELECT username, email FROM user WHERE id = '$uid'";
    $result = mysqli_query($connection, $query);
    $cnt_file_pushes = 0;
    $cnt_image_name_pushes = 0;

    //path for the image construction
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['user_name'];
        $email = $row['email'];
        $folder_name = $username."_".$email."_"."img";
    }

    
        //added multiple image store
        $recieve_pid_query = "SELECT id FROM places WHERE pname = $bord_name AND address = $bord_address;";
        $pid_query_result = mysqli_query($connection,$recieve_pid_query);
        $row_pid = mysqli_fetch_assoc($pid_query_result);
        $pid = $row_pid["id"];

        //Got the pid now , proceeding to record data in images

        foreach($input_field_keys as $key){
            $file_name = $_FILES[$key]["name"];
            $temp_name = $_FILES[$key]["tmp_name"];
            $upload_file = move_uploaded_file($temp_name,"../uploads/$folder_name/$file_name");
            if($upload_file == 1) $cnt_file_pushes ++;
            //image name push
            $img_name_query = "INSERT INTO images (pid,path) VALUES ($pid,$file_name);";
            $img_name_push_result = mysqli_query($connection, $img_name_query);
            if($img_name_push_result){
                $cnt_image_name_pushes++;
            }
            
        }
        //pushing image names to images [ need pid ] NA
    if($cnt_file_pushes == 4 && $cnt_image_name_pushes==4){
        

//------Updated Content [END]---------
        header("location: ../dashboard.php");
    } else {
        echo '<div class="responsive-div">
    <img src="../images/error_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
    <div class="alert alert-danger" role="alert">
        <h3>Error - /$cnt Files cannot upload</h3>
        </div>
</div>';
    }
    

    
    
    
    
    //imagejpeg($temp_name, "./uploads/$folder_name/$file_name", 80);

    









if($db_lat==$lat && $db_log == $log){

    echo '<div class="responsive-div">
    <img src="../images/warning_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
    <div class="alert alert-warning" role="alert">
    <h3>The bording place alredy exit</h3>
    </div>
</div>'; 

}else{

    

}

?>
</body>
</html>