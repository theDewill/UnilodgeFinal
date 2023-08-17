<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="module" src="./JS_files/regForDash.js"></script>
    <!--<script src="https://cdn.tailwindcss.com"></script>!-->
    <link rel="stylesheet" href="./style/dashboard.css">
</head>
<body >


<?php

    $board_id = $_GET["pid"];
    echo $board_id;
    include './db_connection/data_connection.php';

    $sql="SELECT * FROM places WHERE id=$board_id";
    $resultA=mysqli_query($connection,$sql);
    $row = mysqli_fetch_array($resultA);


?>
<div class="About" >
            <div class="title" style="font-weight:700;color:brown;"> Update the Boarding Place Details..</div>
            <div class="content">

            <!-- form begins -->
            <!-- ./Control/add_new_place.php -->

            <!-- FIXED encryption type and request methods -->

                <form action="./Control/edit_place_det.php" id="cordform" method="post" enctype="multipart/form-data" >
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Boarding Name</span>
                            <input type="text" placeholder="Enter Boarding name" required name="bord_name" value=<?php echo $row['pname']?>>
                        </div>
                        <div class="input-box">
                            <span class="details">Boarding Address</span>
                            <input type="text" placeholder="Enter your Boarding Address" required name="bord_address" value=<?php echo $row['address']?>>
                        </div>
                        <div class="input-box">
                            <span class="details">Phone Number</span>
                            <input type="text" placeholder="Enter Boarding number" required name="con_num" value=<?php echo $row['phone_number']?>>
                        </div>
                        <div class="input-box">
                            <span class="details">Number of Rooms</span>
                            <input type="text" placeholder="Number of Rooms" required name="num_of_room" value=<?php echo $row['rooms']?>>
                        </div>
                        <div class="input-box">
                            <span class="details">Price (Per month)</span>
                            <input type="text" placeholder="Enter the Price per month" required name="price" value=<?php echo $row['price']?>>
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
                                <h6 style="margin-top:20px;">Upload new Images of the Place: (4 Required)(old ones will be Deleted)</h6>
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
                            <input type="hidden" id="bid" name="bid" value=<?php echo $board_id?>>

                        </div>          
                                    
                        <div class="buttona">
                            <input type="submit" value="Update">
                        </div>
                    </div>    
        
                </form>
        </div>
    </div>
</body>
</html>
