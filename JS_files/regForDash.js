// Initialize and add the map
let map;
let formDoc = document.getElementById("cordform");
let cancel = document.getElementById("cancelBtn");
let confirm = document.getElementById("confirmBtn");
//import * as navigator from 'navigator';

async function initMap() {
  
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, pinElement } = await google.maps.importLibrary("marker");

  //load the positions from DB here
  const nsbm = {lat: 6.821808982446021, lng:80.04247860537619} //keep this solid
  //let markerLive;

  // The map, centered at First Position Element
  map = new Map(document.getElementById("map"), {
    zoom: 15,
    center: nsbm,
    mapId: "0002", // 
  });

  // if (navigator.geolocation){
  //   navigator.geolocation.getCurrentPosition((position) =>{
  //      markerLive = new AdvancedMarkerElement({
  //       map: map,
  //       position: position.coords,
  //     });
  //   });
  // }

  let cordinates;
  let conf = 0;
  map.addListener("click", (e) => {
    //markerLive.setMap(null);
    cordinates = e.latLng.toJSON();
    //console.log(cordinates);
    //thos code generates a marker in the selected cordinates
    const marker = new AdvancedMarkerElement({
        map: map,
        position: cordinates,
      });
    cancel.addEventListener("click", () => {
        marker.setMap(null);
        cordinates = null;
    });
    confirm.addEventListener("click", () => {
        //console.log(cordinates);
        confirm.style.backgroundColor = '#048500';
        document.getElementById('latValue').value = cordinates.lat;
        document.getElementById('lngValue').value = cordinates.lng;
    });
  });


  
  // formDoc.addEventListener("submit", (evnt) => {
  //   evnt.preventDefault(); 
  //   const fdata = new FormData(evnt.target);
  //   const dataObj = {}; // js data object to transfer
  //   fdata.forEach((value,key)=>{
  //       dataObj[key] = value;
  //   })
  //   //adding cordinates
  //   dataObj.lat = cordinates.lat;
  //   dataObj.lng = cordinates.lng;
  //   const jsonObj = JSON.stringify(dataObj);

  //   if (conf == 1) {
  //   fetch("../Control/add_new_place.php", {
  //     method: 'POST',
  //     body: jsonObj,
  //     headers:{
  //       "Content-Type":"application/json"
  //     }
  //   }).then(()=>{

  //   })
  // }else {
  //   alert('Please Select The Cordinates');
  // }
  // });

//   //-----Marker Engine----

//   // marker configuration - 
//   //JSON Data Unit --> {label : "place name", : position:{lat: <lat cordinates>, lng: <lng cordinates>}}
//   const dirPath = "./lodges/";
//   const markers = [
//     //example lodges 
//     {label:"Sadev Lodge", position:{lat: 6.824353438381775, lng:80.05162072433872}, page:`${dirPath}sadevLodge.html`},
//     {label:'lotus lodge',position:{lat:6.828064713299053, lng:80.04358554301088}, page:`${dirPath}lotusLodge.html`}
//     ]

//   markers.forEach((mark) => {

//     const marker = new AdvancedMarkerElement({
//         map: map,
//         position: mark.position,
//         title: mark.label,
        
//       });

//       marker.addListener("click", () => {
//         //window.alert("Marker clicked!");
//         window.location.href = mark.page;

//       });

//   });

  
  
}

initMap();