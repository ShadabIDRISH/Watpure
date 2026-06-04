let map;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 20.5937, lng: 78.9629 }, // Centered on India
        zoom: 5,
    });
}

function searchLocation() {
    const locationInput = document.getElementById("location-search").value;
    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({ address: locationInput }, function(results, status) {
        if (status === "OK") {
            map.setCenter(results[0].geometry.location);
            new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
            });
        } else {
            alert("Location not found: " + status);
        }
    });
}
