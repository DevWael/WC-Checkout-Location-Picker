let map, map_selector;
let myLatLng = {lat: 24.71212328, lng: 46.67273256}; //saudi arabia
let hiddenInputs = {
    latInput: document.getElementById("wclp_lat"),
    lngInput: document.getElementById("wclp_lng")
}

function wclpInitMap() {
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
            wclpAddMarker(myLatLng);
        }, wclpShowLocationError);
    }
}

function wclpShowLocationError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            wclpAddMarker(myLatLng);
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

// define function to add map marker at given lat & lng
function wclpAddMarker(latLng) {
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
}