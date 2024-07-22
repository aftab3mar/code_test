window.onload = function() {
    // Fetch IP Address
    fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            document.getElementById('ip').value = data.ip;
        });

    // Fetch Geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}
