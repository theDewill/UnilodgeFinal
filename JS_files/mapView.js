// Initialize and add the map
let map;


async function initMap() {
  
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, pinElement } = await google.maps.importLibrary("marker");

  //load the positions from DB here
  const nsbm = {lat: 6.821808982446021, lng:80.04247860537619} //keep this solid

  // The map, centered at First Position Element
  map = new Map(document.getElementById("map"), {
    zoom: 15,
    center: nsbm,
    mapId: "0001",
  });


  //-----Marker Engine----


    // markers.push({pid:12, label:"Sadev Lodge", position:{lat: 6.824353438381775, lng:80.05162072433872}});
    // markers.push({pid:13, label:'lotus lodge',position:{lat:6.828064713299053, lng:80.04358554301088}});

  markers.forEach((mark) => {

    const marker = new AdvancedMarkerElement({
        map: map,
        position: mark.position,
        title: mark.label,
        
      });

      marker.addListener("click", (e) => {
        window.location.href = `./placeView.php?pid=${mark.pid}`;

      });

  });

  
  
}

initMap();