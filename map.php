<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unilodge</title>

    <!-- Reiquired Imports -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/mapStyles.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  
</head>
<body style="display:flex;flex-direction:colomn;">

<header>

<div class="container nav">
      <nav class="navbar sticky-top navbar-expand-md bg-light navbar-light">
        
         <a class="navbar-brand" href="index.html">
           <img src="./images/nav_bar_logo.png" alt="navbar logo" width="15%">
         </a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
           <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="collapsibleNavbar">
           <ul class="navbar-nav ml-auto">
             <li class="nav-item">
               <a class="nav-link" href="./index.html">Home</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="./about.html">About</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="./contact.html">Contact</a>
             </li>
             <li class="nav-item">
              <a class="nav-link" href="./login.html">Login</a>
             </li>
           </ul>
         </div>
      </nav>
    </div>

<script>
  var markers = new Array();
</script>
<?php
       
       include './db_connection/data_connection.php';

        //collecting parameters via global arrays --
        
        $gender = $_POST['gender'];
        //echo $gender;
        $prc_range = intval($_POST['prcrng']); 
        //echo $prc_range;
        //echo $prc_range;

        //now checking for the above details and then passing the redpective values to API rendering the Lodge
        //if not found, proceeds to render the entire map 
        

        if ($connection -> connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        //example -- query configuration based on 3 choices 
        switch ($prc_range){
            case 1:
                $marker_query = "SELECT id,pname,latitude,longitude from places WHERE gender='$gender' AND price<10000;"; 
                //Query Here - Eg:- SELECT * FROM places WHERE name=<name> AND gender=<gender> AND price=<range>
                break;
            case 2:
                $marker_query = "SELECT id,pname,latitude,longitude from places WHERE gender='$gender' AND price >= 10000 AND price < 25000;"; 
                //Query Here - Eg:- SELECT * FROM places WHERE name=<name> AND gender=<gender> AND price=<range>
                break;
            case 3:
                $marker_query = "SELECT id,pname,latitude,longitude from places WHERE gender='$gender' AND price>=25000;"; 
                //Query Here - Eg:- SELECT * FROM places WHERE name=<name> AND gender=<gender> AND price=<range>
                break;
            default:
                $marker_query = "SELECT id,pname,latitude,longitude from places;"; 
                
        }

        //echo $marker_query;
        

        //analysing phase
        // if ($result->num_rows > 0) {
        //     while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        //       $lat_code = $row["latitude"];
        //       $lng_code = $row["longitude"];  

        //       //------COde good-----
        //       echo $lng_code;
        //       //echo "<script>markers.push({pid: ".$row['id']." , label:". $row["pname"].",position:{lat: ". $lat_code ." , lng: " . $lng_code . "}});</script><p>oh yo mayya</p>";
        //     }
        // } else {
        //     echo "0 results";
        //     //then render all the places
        // }

        // $connection->close();
    ?>

<!-- MARKER INPUT -->
<script>
      // markers.push({pid:12, label:"Sadev Lodge", position:{lat: 6.824353438381775, lng:80.05162072433872}});
      // markers.push({pid:13, label:'lotus lodge',position:{lat:6.828064713299053, lng:80.04358554301088}});

          <?php

//echo $marker_query;
$result = mysqli_query($connection,$marker_query);
if ($result) {
  while($row = mysqli_fetch_assoc($result)) {
    $lat_code = $row["latitude"];
    $lng_code = $row["longitude"];
    $pid = $row["id"];  

    //------COde good-----
    
    echo "markers.push({pid: '".$pid."', label:'". $row["pname"]."',position:{lat: ". $lat_code ." , lng: " . $lng_code . "}});";
  }
} else {
  echo "0 results";
  //then render all the places
}

$connection->close();
          ?>

</script>




<!-- MARKER INPUT END -->

<script type="module" src="./JS_files/mapView.js"></script>



    <!-- navigation bar start ek-->

  


    

      <!-- Instructions -->

      <!-- <div class="ins text-amber-800 mx-auto my-2 font-medium text-center">
        Found <span style="color:red;">[count]</span> results ..
      </div> -->

      <!-- MAP -->
    
    <div id="map"  class="rounded-xl border-amber-700 border-2 mx-auto w-11/12 my-4" style="height:32rem;border-radius:25px;border: 5px solid #8b4d00; margin-left:auto;margin-right:auto;width:75%;margin-top:20px;">
    </div>


  




</div>

    <div class="ins text-amber-800 mx-auto my-2 font-medium text-center" style="color:#552f00; margin-left:auto;margin-right:auto;margin-top:5px;font-size:1.3rem;text-align:center;font-weight:600;">
        Click on a marker to view the details of the property.
      </div>

    <div class="cancelBtn self-center my-2" style="align-self:center;margin-left:47%">
        
        <a href="./index.html" class="rounded-md bg-amber-700 px-2 py-1 text-white font-medium mx-auto" style="text-decoration: none; cursor: pointer;border-radius:10px;background-color:#552f00;padding:4px;font-size:1rem;">
            Go Back
        </a>
        
    </div>
   
    


    <!-- IIFE Below (only API KEy) -->
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyB00xJTicICPDFwtoGDS8BtktScvXiznCI", v: "beta"});</script>

    </header>
</body>
</html>
