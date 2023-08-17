<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
</style>
<link rel="stylesheet" href="../style/error_msg.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>
<?php

//-----fixed 
    
    // db colomn edited
    // moved proceed logic into else in duplicate logic...
    // error messages fixed
    // [to do] add ui to update success!!
    



//get the user inputs
$nam = $_POST['name'];
$use_name = $_POST['user_name'];
$Opasswd = $_POST['password1'];
$c_pass =$_POST['password2'];
$nic = $_POST['nic'];
$email = $_POST['email'];
$con_num = $_POST['pn'];

include '../header/session.php';

//declearing the variable to assing the data from the database
$db_email="";
$db_use_name ="";
$db_uid="";
$db_nic="";
$db_pass="";
$db_name="";

//sql query to serch the data base 
$sql="SELECT * FROM user WHERE id=$uid";

//exhicuting the quary
$result=mysqli_query($connection,$sql);

//rectrivee the data to search that the users with the same user name 
while ($row=mysqli_fetch_array($result)) {
	$db_email=$row['email'];
    $db_use_name = $row['username'];
    $db_uid = $row['id'];

}

$sql_dup = "SELECT * FROM user WHERE id!=$uid ";
$result_dup=mysqli_query($connection,$sql_dup);

//--update signals---
$dup_cnt = 0;

//looping through all the ohter user data to find wether we have similar mail or username availble
while ($row=mysqli_fetch_array($result_dup)) {
	$db_dup_email=$row['email'];
    $db_dup_use_name = $row['username'];
    
    if($use_name == $db_dup_use_name){
        $dup_cnt++;
        echo '<div class="responsive-div">
            <img src="../images/error_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
            <div class="alert alert-danger" role="alert">
                <h3>This username alredy exists !!</h3>
                ';
    }else if($email==$db_dup_email){
        $dup_cnt++;
        echo '<div class="responsive-div">
        <img src="../images/error_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
        <div class="alert alert-danger" role="alert">
            <h3>This Email is alredy exists !!</h3>
            ';
    }else{
        continue;
    }
}

        //if there are no any duplicates further execution proceeds from here
        // echo "success" ; 
        //checking weather the password and the comfirmed password is same 
    if($dup_cnt==0 && $Opasswd==$c_pass){
            
        //UPDATE PROCESS STARTS---->
        //updating the image names based on the given new data
                //---profile Image Area ----

               $file_path = '../uploads/';
               $rename = $file_path.$use_name."_".$email."_"."img";
               $old_folder_name =$file_path.$db_use_name."_".$db_email."_"."img";
               //if rename the folder then update the data at the database.
               if (rename($old_folder_name,$rename)) {

                   // data update quary
                   $sql="UPDATE user SET uname='$nam',email='$email',nic='$nic',username='$use_name',passwd='$Opasswd'  WHERE id=$uid";
                   
                   // if the detail updating process is fail display the error 
                   if (!mysqli_query($connection,$sql)) {
                       die(mysqli_error($con));
                       //redirecting to login.html
                       header('location:../login.html');
                    }
                   
                    else {
                        //redirecting to dahsboard.php
                        header('location:../dashboard.php');
                    }
       
           }
           //if the folder process not moved as expected comes to this
           else
           {
       
           echo'<div class="responsive-div">
           <img src="../images/warning_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
           <div class="alert alert-warning" role="alert">
           <h3>Cannot Update Profile Folders, Try Another time...</h3>
           </div>
       </div>';
       
       }
  //if the passwords didnt match it will come to this  
}else{

    echo'<div class="responsive-div">
           <img src="../images/warning_msg_img.png" alt="Oh snap! Sorry! There was a problem with your request.">
           <div class="alert alert-warning" role="alert">
           <h3>Passwords Mismatch !!!</h3>
           </div>
       </div>';
}







?>
</body>
</html>
