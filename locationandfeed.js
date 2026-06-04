let map;
let marker;
let geocoder;

// Initialize the Google Map
function initMap() {
    // Initialize geocoder
    geocoder = new google.maps.Geocoder();

    // Set up the map, centered on India
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 20.5937, lng: 78.9629 }, // Centered on India
        zoom: 5,
    });

    // Add a click event listener to place a marker where the user clicks
    map.addListener("click", (event) => {
        placeMarker(event.latLng);
        updateLocationInfo(event.latLng);
    });
}

// Place a marker on the map and center the map on it
function placeMarker(location) {
    // If marker already exists, just move it
    if (marker) {
        marker.setPosition(location);
    } else {
        // Create a new marker if one doesn't exist
        marker = new google.maps.Marker({
            position: location,
            map: map,
        });
    }
    map.panTo(location);
}

// Update the location info text
function updateLocationInfo(location) {
    const lat = location.lat();
    const lng = location.lng();
    
    // Simulate water quality based on location (this can be improved with real data)
    const waterQuality = getWaterQuality(lat, lng);
    
    const locationText = `Location: Latitude: ${lat}, Longitude: ${lng}`;
    const waterText = `Water Quality: ${waterQuality}`;
    
    document.getElementById("locationText").innerHTML = `${locationText}<br>${waterText}`;
}

// Simulate water quality data (this function can be extended for real data)
function getWaterQuality(lat, lng) {
    // Simple simulation based on location (this logic can be replaced)
    if (lat > 20) {
        return "Good";
    } else {
        return "Not Good";
    }
}

// Allow the user to submit feedback on the water quality
function submitFeedback(isGood) {
    const feedback = isGood ? "Good" : "Not Good";
    alert("Thank you for your feedback: " + feedback);
}