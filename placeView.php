<?php


include './db_connection/data_connection.php';
//include './header/session.php';
$pid = $_GET['pid'];
//echo $pid;

//declearing the variable to assing the data from the database
$db_tittle="";
$db_cnum="";
$db_price="";
$db_address="";
$db_ge="";
$db_fac="";
$db_nr="";
$db_img= array();


$place_details_query = "SELECT * FROM places WHERE id = $pid";
//exhicuting the quary
$pd_result = mysqli_query($connection,$place_details_query);

//rectrivee the data to search that the users with the same user name 
while ($row=mysqli_fetch_array($pd_result)) {
	  $db_tittle=$row['pname'];
    $db_cnum = $row['phone_number'];
    $db_price = $row['price'];
    $db_address = $row['address'];
    $db_ge = $row['gender'];
    $db_fac= $row['facilities'];
    $db_nr = $row['rooms'];
    
}
// $images_query = "SELECT path FROM images WHERE pid = $pid"
// $img_result = mysqli_query($connection, $images_query);
// while($img_row=mysqli_fetch_array($img_result)){
//   array_push($db_img ,$img_row['path']);
// }

//------FIXES------
$search_image_query="SELECT * FROM images WHERE pid=$pid";
$imgname_result=mysqli_query($connection,$search_image_query);

            //rectriving the image names from the database and looping through them


$search_owner_query = "SELECT uid FROM places WHERE id = $pid";
$search_q_result = mysqli_query($connection,$search_owner_query);
$owner_data = mysqli_fetch_array($search_q_result);
$oid = $owner_data['uid'];

//now grabbing owners username and password

$owner_data_q = mysqli_query($connection,"SELECT * FROM user WHERE id = $oid");
$result_owner_query = mysqli_fetch_array($owner_data_q);

$folder_name = $result_owner_query['username']."_".$result_owner_query['email']."_"."img";



$file_path_list = [];
$new_file_path_list = [];

if($imgname_result){

  while ($row=mysqli_fetch_assoc($imgname_result)) {
    //$row = mysqli_fetch_assoc($imgname_result);
    $file_name = $row['path']; 
    $filePath = "./uploads/$folder_name/$file_name"; 
    array_push($file_path_list, $filePath);
    
    //-----algo-smile --code added
    // $new_file_path_list = $file_path_list;
    // $cnt = count($file_path_list);
    // if(count($file_path_list)<4){
    // for($i=0; $i < count($file_path_list); $i++){
    //   array_push($new_file_path_list, $file_path_list [$i]);
    // }
    // $cnt2 = 0;
    // while ($cnt<4){
    //   array_push($new_file_path_list, $file_path_list [$cnt2]);
    //   $cnt++;
    //   $cnt2++;
    // }}
    

  }

 


}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script type="module" src="./JS_files/placeView.js"></script>
  <!--<script src="https://cdn.tailwindcss.com"></script>!-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="./style/placeView.css">
  <title><?php echo $db_tittle ; ?></title>
</head>
<body>
    <header>
    
    

  <div class="container nav">
    <nav class="navbar sticky-top navbar-expand-md bg-light navbar-light">
      
       <a class="navbar-brand" href="#">
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
  

<div class="container ">
  <div class="box">


    <div class="card1">
      <div class="card-body" style="font-size:1.9rem">
      <b > <?php echo $db_tittle ;?> </b>
      </div>
    </div>

 
    <script type="module" src="./JS_files/placeView.js"></script>


    <div class="row" style="border-radius: 20px;">
      <div class="col-8" >
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="<?php echo $file_path_list[0] ; ?>" class="car-img" alt="No Image">
            </div>
            <div class="carousel-item">
              <img src="<?php echo  $file_path_list[1] ; ?>" class="car-img" alt="No Image">
            </div>
            <div class="carousel-item">
              <img src="<?php echo  $file_path_list[2] ; ?>" class="car-img" alt="No Image">
            </div>
            <div class="carousel-item">
              <img src="<?php echo  $file_path_list[3] ; ?>" class="car-img" alt="No Image">
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      
      
      <div class="card mt-3" style="width: 20rem; height: 487px;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">📞 0<?php echo $db_cnum ; ?></li>
 <!-- MAP PART START          -->


          <div id="map"  class="map1"  >
          </div>


          <?php 

$get_cords = mysqli_query($connection,"SELECT latitude,longitude FROM places WHERE id=$pid");
$cord_rslts = mysqli_fetch_array($get_cords);
$lat_cord = $cord_rslts['latitude'];
$lng_cord = $cord_rslts['longitude'];

?>

         

<div style="display:none;" id="latC" cdata="<?php echo $lat_cord?>"></div> 
<div style="display:none;" id="lngC" cdata="<?php echo $lng_cord?>"></div>
      
    



<!-- MAP PART END -->
          
      </div>
          <!-- IIFE Below (only API KEy) -->
          <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
              ({key: "AIzaSyB00xJTicICPDFwtoGDS8BtktScvXiznCI", v: "beta"});</script>
        </ul>
      
      </div>
    

    <div class="card-showprice">
      <div class="card-body">
        <h4 style="color: rgba(255, 255, 255);font-weight:600;background-color:#5d2100;border-radius:5px;padding:7px;width:fit-content">Rs.<?php echo $db_price ; ?>/=</h4>
      </div>
    </div>


    <div class="card-pr-ad-ge-nr-fa">
      <div class="card-body">
        <label class="ad-ge-nr-fa" >Address:</label>
        <span class="details"><?php echo $db_address ; ?></span>
      </div>
    </div>

    <div class="card-pr-ad-ge-nr-fa">
      <div class="card-body">
        <label class="ad-ge-nr-fa">Gender:</label>
        <span class="details"><?php echo $db_ge ; ?></span>
      </div>
    </div>

    <div class="card-pr-ad-ge-nr-fa">
      <div class="card-body">
        <label class="ad-ge-nr-fa">Rooms:</label>
        <span class="details"><?php echo $db_nr ; ?></span>
      </div>
    </div>


    <div class="card-pr-ad-ge-nr-fa">
      <div class="card-body">
        <label class="ad-ge-nr-fa">Facilities:</label>
        <ul>
          <div class="details">
          <span> <?php echo $db_fac ; ?></span>
          </div>
       </ul>
      </div>
    </div>

  </div>
</div>
  

  <footer>
    <div class="row">
      <div class="col f-left">
        <p>Copyright © NSBM Students</p>
      </div>
      <div class="col f-right">
        <p>Brewed with ❤️ by NSBM Undergraduates for Fellow Undergraduates</p>
      </div>
    </div> 
  </footer>
    </div>
  </div>
</div>  
    </header>
    
</body>
</html>
  



