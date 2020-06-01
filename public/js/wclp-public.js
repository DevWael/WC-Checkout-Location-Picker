let map, map_selector;
let markersArray = [];
let polyline = null;
let myLatLng = {lat: 24.71212328, lng: 46.67273256}; //saudi arabia
let hiddenInputs = {
    latInput: document.getElementById("wclp_lat"),
    lngInput: document.getElementById("wclp_lng")
}

function initMap() {
    map_selector = document.getElementsByClassName('wclp-google-map')[0];
    map = new google.maps.Map(map_selector, {
        center: myLatLng,
        zoom: 15
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            myLatLng = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            }
            map.setCenter(myLatLng);
            addMarker(myLatLng);
        }, showError);
    }
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            addMarker(myLatLng);
            break;
        case error.POSITION_UNAVAILABLE:
            map_selector.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            map_selector.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            map_selector.innerHTML = "An unknown error occurred."
            break;
    }
}

// define function to add marker at given lat & lng
function addMarker(latLng) {
    let marker = new google.maps.Marker({
        map: map,
        position: latLng,
        draggable: true
    });

    hiddenInputs.latInput.value = latLng.lat;
    hiddenInputs.lngInput.value = latLng.lng;

    // add listener to redraw the polyline when markers position change
    marker.addListener('position_changed', function (e) {
        console.log('Lat: ' + marker.getPosition().lat());
        console.log('Lng: ' + marker.getPosition().lng());

        hiddenInputs.latInput.value = marker.getPosition().lat();
        hiddenInputs.lngInput.value = marker.getPosition().lng();
    });

    //store the marker object drawn in global array
    markersArray.push(marker);
}

// define function to draw polyline that connect markers' position
function drawPolyline() {
    let markersPositionArray = [];
    // obtain latlng of all markers on map
    markersArray.forEach(function (e) {
        markersPositionArray.push(e.getPosition());
    });

    // check if there is already polyline drawn on map
    // remove the polyline from map before we draw new one
    if (polyline !== null) {
        polyline.setMap(null);
    }

    // draw new polyline at markers' position
    polyline = new google.maps.Polyline({
        map: map,
        path: markersPositionArray,
        strokeOpacity: 0.4
    });
}