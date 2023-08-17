<?php
include './header/session.php';


//-----php script [1] that captures all the user data , [2] php will capture the data from place register and push it to DB

//fixes

// altered file paths
// queries fixed
// map load issue [to do]


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
    $db_use_name = $row['user_name'];
   // $db_nic = $row['nic'];
    //$db_pass = $row['password'];
  //  $db_name = $row['name'];
    $db_con_num = $row['cont_number'];
}

//creating the folder name
$folder_name = $db_use_name."_".$db_email."_"."img";

//getting the Boarding places details
$sql_boding="SELECT * FROM palces WHERE iduser=$uid";

?>


<!-- HTML PART -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="module" src="./Js/reg.js"></script>
    <!--<script src="https://cdn.tailwindcss.com"></script>!-->
    <link rel="stylesheet" href="./style/dashboard.css">
</head>
<body>
    
    <div class="container">
        <div class="box">
            <img src="./images/avatar-2.png" alt="profile picture">
            <ul>
                <li><?php echo $db_use_name ; ?></li>
                <li><?php echo $db_email; ?></li>
                <li><?php echo $db_con_num; ?></li>
                <li><i style="font-size:24px" class="fa"></i>
                    <i style="font-size:24px" class="fa"></i>
                    <i style="font-size:24px" class="fa"></i></li>
            </ul>
        </div>
    
        <div class="About">
            <div class="title">New Boarding Registration</div>
            <div class="content">


            <!-- form begins -->
            <!-- added post -->
                <form action="./Control/add_new_place.php" method="post" id="cordform">
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
                            <span class="details">Nearest town</span>
                            <input type="text" placeholder="Enter Nearest town" required name="con_num">
                        </div>
                        <div class="input-box">
                            <span class="details">Phone Number</span>
                            <input type="text" placeholder="Enter Boarding number" required name="num_of_room">
                        </div>
                        <div class="input-box">
                            <span class="details">Number of Rooms</span>
                            <input type="text" placeholder="Number of Rooms" required name="price">
                        </div>
                        <div class="input-box">
                            <span class="details">Price (Per month)</span>
                            <input type="text" placeholder="Price per month" required name="price">
                        </div>
                    </div>
                        <div class="gender-details">
                            <input type="radio" name="gender" id="dot-1"value="male">
                            <input type="radio" name="gender" id="dot-2"value="female">
                            <input type="radio" name="gender" id="dot-3"value="male_fema">
                            <span class="gender-title">Gender</span>
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
                            <input type="radio" name="Boarding" id="dot-4"value="house">
                            <input type="radio" name="Boarding" id="dot-5"value="apartment">
                            <input type="radio" name="Boarding" id="dot-6"value="room">
                            <span class="gender-title">Boarding</span>
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
                                <label class="up-text">Facilities</label>
                                <div class="tcomment">
                                    <textarea class="textinput" placeholder="Write your bording facilities" name="face_dis"></textarea>
                                </div>
                            </div>
                        </div>
                    
                        
                        
                            <div class="map-1">
                                <label class="up-text">Select the location of Boarding Place </label>
                                <div id="map"  class="map1" style="border-radius:15px;" >
                                    
                                </div>
                                <div>
                                <!--   Cancel & confirm buttons -->
                                <button id="cancelBtn" type="button" class="bg-red-500 text-red-900 rounded-md p-1">Undo Selection</button>
                                <button id="confirmBtn" type="button"class="bg-green-500 text-green-900 rounded-md p-1">Confirm </button>
                                </div>
                            </div>
                               
                                <div class="up-img">
            
                                        <label class="up-text">Upload Your Boarding Images</label>
                                        
                                          <label class="custum-file-upload" for="file">
                                            <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path> </g></svg>
                                            </div>
                                            <div class="text">
                                               <span>Click to upload image</span>
                                               </div>
                                               <input type="file" id="file">
                                            </label>
                                        
                                    
                                    
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
            //rectriving the detail from the databese
        while ($row=mysqli_fetch_array($boding_result)) {
            $db__boding_name=$row['name'];
            $db_boding_address = $row['address'];
            $db_boding_price = $row['price'];
            $db_bording_id = $row['idplaces'];

            //search for the respective images
            $search_image_query="SELECT * FROM images WHERE idplaces=$db_bording_id";
            
            //exhicuting the quary
            $boding_result=mysqli_query($connection,$sql_boding);

            //rectriving the image name form the database
            while ($row = mysqli_fetch_assoc($result)) {
                $file_name = $row['file_name']; 
            }

            echo '
            <li>
            <div class="card">
                <div class="image-session">
                    <span class="image" style="background-image: url("./uploads/'. $folder_name. '/'. $file_name. '");"></span>
                </div>
                <div class="meta-sission">
                    <div class="head">
                        <h3>Bording Detail</h3>
                    </div>
                    <div class="body">
                        <h2 class="title">'.$db__boding_name.'</h2>
                        <p class="desc">'.$db_boding_addressg.'</p>
                        <p class="desc">'.$db_boding_price.'</p>
                    </div>
                    <div class="footer">
                        <a href="#" class="button">Edit</a>
                    </div>
                    <div class="foot">
                        <a href="#" class="button">Delete</a>
                    </div>
                </div>
            </div>
        </li>
            ';
        }
        ?>
    </ul>


     <!-- IIFE Below (only API KEy) -->
     <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
                                    ({key: "AIzaSyB00xJTicICPDFwtoGDS8BtktScvXiznCI", v: "beta"});</script>
</body>
</html>