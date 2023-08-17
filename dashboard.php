<?php
//start the session 
session_start();

//assing the user id to the session 
$uid = $_SESSION['iduser'];

//import the database connection  
include './db_connection/data_connection.php';

// check weather the session is set, if not then regrate to the login page 
if(isset($_SESSION['iduser'])){

}else{
    header("location:./login.html");
}


//-----php script [1] that captures all the user data , [2] php will capture the data from place register and push it to DB

//---fixes-----

// altered file paths
// queries fixed
// map load issue fixed
// db colomn names
// ui elements fixed
// added displaying live location


//---------------------------------------------

//declearing the variable to assing the data from the database
$db_email="";
$db_use_name ="";
$db_nic="";
$db_pass="";
$db_name="";

//sql query to serch the data base 
$sql="SELECT * FROM user WHERE id=$uid";

//$sql="SELECT * FROM user";

//exhicuting the quary
$result=mysqli_query($connection,$sql);

//rectrivee the data to search that the users with the same user name 
while ($row=mysqli_fetch_array($result)) {
	$db_email=$row['email'];
    $db_use_name = $row['username'];
   // $db_nic = $row['nic'];
    //$db_pass = $row['password'];
  //  $db_name = $row['name'];
    $db_con_num = $row['contact'];
}

//creating the folder name
$folder_name = $db_use_name."_".$db_email."_"."img";




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="module" src="./JS_files/regForDash.js"></script>
    <!--<script src="https://cdn.tailwindcss.com"></script>!-->
    <link rel="stylesheet" href="./style/dashboard.css">
</head>
<body>
    <div class="container">
        <div class="box">
            
            <img src="./images/avatar-2.png" alt="">
            <ul>
                <li><?php echo $db_use_name ; ?></li>
                <li><?php echo $db_email; ?></li>
                <li><?php echo $db_con_num; ?></li>
                <li><i style="font-size:24px" class="fa"></i>
                    <i style="font-size:24px" class="fa"></i>
                    <i style="font-size:24px" class="fa"></i></li>
            </ul>
            <ul>
            <li>
               <i> 
                    <a href="./edit_user_detail.php" class="btnp">Edit Profile</a>
                </i>
                <i>
                        <a href="./Control/log_out.php" class="btnp">Logout</a>
                </i>
            </li>
            
        </ul>
        </div>
        <div class="About">
            <div class="title">New Boarding Registration</div>
            <div class="content">

            <!-- form begins -->
            <!-- ./Control/add_new_place.php -->

            <!-- FIXED encryption type and request methods -->

                <form action="./Control/add_new_place.php" id="cordform" method="post" enctype="multipart/form-data">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Boarding Name</span>
                            <input type="text" placeholder="Enter Boarding name" required name="bord_name">
                        </div>
                        <div class="input-box">
                            <span class="details">Boarding Address</span>
                            <input type="text" placeholder="Enter your Boarding Address" required name="bord_address">
                        </div>
                        <div class="input-box">
                            <span class="details">Phone Number</span>
                            <input type="text" placeholder="Enter Boarding number" required name="con_num">
                        </div>
                        <div class="input-box">
                            <span class="details">Number of Rooms</span>
                            <input type="text" placeholder="Number of Rooms" required name="num_of_room">
                        </div>
                        <div class="input-box">
                            <span class="details">Price (Per month)</span>
                            <input type="text" placeholder="Enter the Price per month" required name="price">
                        </div>
                    </div>
                    <div class="gender-details">
                            <input type="radio" name="gender" id="dot-1" value="male">
                            <input type="radio" name="gender" id="dot-2" value="female">
                            <input type="radio" name="gender" id="dot-3" value="male_fema">
                            <span class="gender-title"><b>Gender:</b></span>
                            <div class="category">
                                <label for="dot-1">
                                    <span class="dot one"></span>
                                    <span id="gender">Male</span>
                                </label>
                                <label for="dot-2">
                                    <span class="dot two"></span>
                                    <span id="gender">Female</span>
                                </label>
                                <label for="dot-3">
                                    <span class="dot three"></span>
                                    <span id="gender">Male or Female</span>
                                </label>
                            </div>
                    </div>
                        
                    <div class="gender-details">
                            <input type="radio" name="Boarding" id="dot-4" value="house">
                            <input type="radio" name="Boarding" id="dot-5" value="apartment">
                            <input type="radio" name="Boarding" id="dot-6" value="rooms">
                            <span class="gender-title"><b>Boarding:</b></span>
                            <div class="category">
                                <label for="dot-4">
                                    <span class="dot four"></span>
                                    <span id="gender">House</span>
                                </label>
                                <label for="dot-5">
                                    <span class="dot five"></span>
                                    <span id="gender">Apartment</span>
                                </label>
                                <label for="dot-6">
                                    <span class="dot six"></span>
                                    <span id="gender">Rooms</span>
                                </label>
                            </div>
                            <div class="text-com">
                                <label class="up-text"><b>Facilities: </b></label>
                                <div class="tcomment">
                                    <textarea class="textinput" placeholder="Enter the Boarding Facilities" name="face_dis" style="border-radius:10px;padding:5px;"></textarea>
                                </div>
                            </div>
                    </div>

                        <!-- map -->

                    <div class="map-1">
                                <label class="up-text"><b>Select the location of Boarding Place: </b></label>
                                <div id="map"  class="map1" style="border-radius:10px; height:350px;" >
                                </div>
                                <div>
                                <!--   Cancel & confirm buttons -->
                                <button id="cancelBtn" type="button"  style="background-color: #ff6262;color: #890000;border-radius: 5px;padding: 3px;font-weight: 600;border:none;cursor:pointer;">Undo Selection</button>
                                <button id="confirmBtn" type="button" style="background-color: #06d300;color: #005903;border-radius: 5px;padding: 3px;font-weight: 600;border:none;cursor:pointer;">Confirm </button>
                                </div>
                    </div>
                                <!-- IIFE Below (only API KEy) -->
                                <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
                                    ({key: "AIzaSyB00xJTicICPDFwtoGDS8BtktScvXiznCI", v: "beta"});</script>
                    <div class="img">
                                <h6 style="margin-top:20px;">Upload Images of the Place: (4 required)</h6>
                                <div class="grid">
                                    <div class="img-element">
                                        <input type="file" id="file-1" accept="image/*" name="img1">
                                        <label for="file-1" id="file-1-preview">
                                          <img src="https://bit.ly/3ubuq5o" alt="">
                                          <div>
                                            <span>+</span>
                                          </div>
                                        </label>
                                    </div>
                                    <div class="img-element">
                                        <input type="file" id="file-2" accept="image/*" name="img2">
                                        <label for="file-2" id="file-2-preview">
                                          <img src="https://bit.ly/3ubuq5o" alt="">
                                          <div>
                                            <span>+</span>
                                          </div>
                                        </label>
                                    </div>
                                    <div class="img-element">
                                        <input type="file" id="file-3" accept="image/*" name="img3">
                                        <label for="file-3" id="file-3-preview">
                                          <img src="https://bit.ly/3ubuq5o" alt="">
                                          <div>
                                            <span>+</span>
                                          </div>
                                        </label>
                                    </div>
					                <div class="img-element">
                                        <input type="file" id="file-4" accept="image/*" name="img4">
                                        <label for="file-4" id="file-4-preview">
                                          <img src="https://bit.ly/3ubuq5o" alt="">
                                          <div>
                                            <span>+</span>
                                          </div>
                                        </label>
                                    </div>
                                </div>
                                </div>
                                  <script>
                                    function previewBeforeUpload(id){
                                        document.querySelector("#"+id).addEventListener("change",function(e){
                                            if(e.target.files.length == 0){
                                                return;
                                            }
                                            let file = e.target.files[0];
                                            let url = URL.createObjectURL(file);
                                            document.querySelector("#"+id+"-preview div").innerText = file.name;
                                            document.querySelector("#"+id+"-preview img").src = url;
                                        });
                                    }
                                    previewBeforeUpload("file-1");
                                    previewBeforeUpload("file-2");
                                    previewBeforeUpload("file-3");
                                    previewBeforeUpload("file-4");
                                  </script>

                        <div class="hiddenC">
                            <input type="hidden" id="latValue" name="lat" value="">
                            <input type="hidden" id="lngValue" name="lng" value="">
                        </div>          
                                    
                        <div class="buttona">
                            <input type="submit" value="Register">
                        </div>
                    </div>    
        
                </form>
        </div>
    </div>

    <ul class="groups">

    

        <!-- display the bording details -->
        <?php

       //-----FIXED DISPLAY Issues ---

        //getting the Boarding places details
        //getting the Boarding places details


            $sql_boding="SELECT * FROM places WHERE uid=$uid";

            //exhicuting the quary
            $boding_result=mysqli_query($connection,$sql_boding);
            
            //--looping through the Set of Boarding Place results--- [MAJOR LOOP]
            while ($row=mysqli_fetch_array($boding_result)) {
                $db__boding_name=$row['pname'];
                $db_boding_address = $row['address'];
                $db_boding_price = $row['price'];
                $db_bording_id = $row['id'];

            //search for the respective images
            $search_image_query="SELECT * FROM images WHERE pid=$db_bording_id";
            $imgname_result=mysqli_query($connection,$search_image_query);

            //rectriving the image names from the database and looping through them
            
            if($imgname_result){
                $row = mysqli_fetch_assoc($imgname_result);
                $file_name = $row['path']; 
                $filePath = "./uploads/$folder_name/$file_name"; 

            
            

            echo '
            <li>
            <div class="card" >
                <div class="image-session">
                    <span class="image" style="background-image: url('.$filePath.');"></span>
                </div>
                <div class="meta-sission" style="margin-left:10px;">
                    <div class="head">
                        <h3 style="color:#794400de;font-weight:600;">Bording Details</h3>
                    </div>
                    <div class="body">
                        <h2 class="title">'.$db__boding_name.'</h2>
                        <p class="desc">'.$db_boding_address.'</p>
                        <p class="desc">'.$db_boding_price.'</p>
                    </div>
                    <div class="footer" style="align-self:flex-end">
                        <a href="./edit_place_view.php?pid='.$db_bording_id.'" class="button">Edit</a>
                    </div>
                    <div class="foot" style="align-self:flex-end">
                        <a href="./Control/delete_place_detail.php?pid='.$db_bording_id.'" class="button">Delete</a>
                    </div>
                </div>
            </div>
        </li>
            ';}
        }
        ?>
    </ul>
    <footer class="row"> 
        <div class="col f-left">
          <p>Copyright © NSBM Students</p>
        </div>
        <div class="col f-right">
          <p>Brewed with ❤️ by NSBM Undergraduates for Fellow Undergraduates</p>
        </div>
      </footer>
</body>
</html>
