<?php
include '../header/session.php';

$place = $_POST['bid'];

$uid = $_SESSION['iduser'];

$bord_name = $_POST['bord_name'];
$bord_address=$_POST['bord_address'];
$bord_number = $_POST['con_num'];
$bord_gender = $_POST['gender'];
$num_room = $_POST['num_of_room'];
$price = $_POST['price'];    
$facility = $_POST['face_dis'];
$gender = $_POST['gender'];
$bord_type = $_POST['Boarding'];
$log = $_POST['lng'];
$lat = $_POST['lat'];
$old_file_ids = [];

//------UPDATED FIXES----


//retrieving the username and email for path construction
$query_fold = "SELECT username, email FROM user WHERE id = '$uid'";
$result_fold = mysqli_query($connection, $query_fold);
$row = mysqli_fetch_assoc($result_fold);
$usrnm = $row['username'];
$email = $row['email'];
//Deleting the existing files first-----
$search_image_query="SELECT * FROM images WHERE pid=$place";
$imgname_result=mysqli_query($connection,$search_image_query);
//rectriving the image names from the database and looping through them to delete existing files
while($row = mysqli_fetch_assoc($imgname_result)){
    $file_name = $row['path']; 
    $folder_name = $usrnm."_".$email."_"."img";
    $filePath = "../uploads/$folder_name/$file_name"; 
    unlink($filePath); //deleting the existing images
    $imgid = $row['id'];
    array_push($old_file_ids,$imgid);
};

//storing new images
$cnt = 0;
$cnt_image_name_pushes = 0;
$cnt_file_pushes = 0;
$place_push = 0;

//Logic - if the user got more images than old image count then moves to else....
$input_field_keys = ["img1","img2","img3","img4"];
foreach($input_field_keys as $key){
            $file_name = $_FILES[$key]["name"];
            $temp_name = $_FILES[$key]["tmp_name"];
            $upload_file = move_uploaded_file($temp_name,"../uploads/$folder_name/$file_name");
            if($upload_file == 1) $cnt_file_pushes ++;
            //image name push (update)

            if($cnt < count($old_file_ids)){

                $img_name_update_qry = "UPDATE images SET path ='$file_name' WHERE id=$old_file_ids[$cnt];";
                $img_name_push_result = mysqli_query($connection, $img_name_update_qry);

            }else{

                $insert_new_img = "INSERT INTO images (pid,path) VALUES ($place,'$file_name');";
                $result_insertion = mysqli_query($connection, $insert_new_img);

            }
            $cnt++;

            if($img_name_push_result || $result_insertion){
                $cnt_image_name_pushes++;
                
            } 
}

//removing records with empty paths left in images
$dlt_img_query = "DELETE FROM images WHERE path = '';";
$dlt_result = mysqli_query($connection, $dlt_img_query);

$places_update_query = "UPDATE places SET pname ='$bord_name', address = '$bord_address', phone_number= '$bord_number',rooms = $num_room,price = $price,facilities = '$facility',boarding_type='$bord_type',gender = '$gender',latitude = $lat,longitude = $log WHERE id=$place;";
$place_update_result = mysqli_query($connection, $places_update_query);
if ($place_update_result) $place_push++;

//update data in places table [TODO ]


if ($cnt_image_name_pushes > 2 && $cnt_file_pushes >= 2 && $place_push==1){
    header("location: ../dashboard.php");
}else if($cnt_file_pushes < 2){
    echo '<div class="responsive-div">
    <img src="../images/warning_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
     <div class="alert alert-warning" role="alert">
    <h3>Upload Minimum of 2 Files</h3>
    </div>
     </div>'; 
}else{
    echo '<div class="responsive-div">
    <img src="../images/warning_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
     <div class="alert alert-warning" role="alert">
    <h3>No file was uploaded.</h3>
    </div>
     </div>'; 

}




// $query = "SELECT * FROM user WHERE iduser = '$uid'";
//     $result = mysqli_query($connection, $query);

//     while ($row = mysqli_fetch_assoc($result)) {
//         $username = $row['user_name'];
//         $email = $row['email'];
//         $imag = $row['imag_name'];
//         $folder_name = $username."_".$email."_"."img";
//     }

// if($file_name == $imag){

//     // $query = "INSERT INTO images (file_name) VALUES ('$new_file_name')";
//     // $insert_data = "INSERT INTO place () VALUES ()";
//     // mysqli_query($connection, $query);
//     // mysqli_query($connection, $insert_data);
    

// }else{

//     if(isset($_FILES["filename"])) {

//         //getting the original size of the image
//         list($width, $height) = getimagesize($image_file);
    
//         // Resize the image
//         $new_width = 280;
//         $new_height = 220;
//         $resize_image = imagecreatetruecolor($new_width, $new_height);
//         imagecopyresampled($new_image, $image_file, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        
//         $upload_file = move_uploaded_file($resize_image,"./uploads/$folder_name/$file_name");
//         imagejpeg($resize_image, "./uploads/$folder_name/$file_name", 80);
    
//         if($upload_file == 1){
//             // $query = "INSERT INTO images (file_name) VALUES ('$new_file_name')";
//             // $insert_data = "INSERT INTO place () VALUES ()";
//             // mysqli_query($connection, $query);
//             // mysqli_query($connection, $insert_data);
    
//             header("location: ../dashboard.php");
//         } else {
//             echo '<div class="responsive-div">
//         <img src="../images/error_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
//         <div class="alert alert-danger" role="alert">
//             <h3>Error - File cannot upload</h3>
//             </div>
//     </div>';
//         }
    
//     } else {
//         echo '<div class="responsive-div">
//     <img src="../images/warning_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
//     <div class="alert alert-warning" role="alert">
//     <h3>No file was uploaded.</h3>
//     </div>
//     </div>'; 
//     }

// }

?>