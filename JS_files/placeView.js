

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

  position = {lat: document.getElementById("latC").getAttribute('cdata'),lng: document.getElementById("lngC").getAttribute('cdata')};

    const marker = new AdvancedMarkerElement({
        map: map,
        position: position,
        title: mark.label,
        
      });

      

  

  
  
}

initMap();