 // Initialize the map
    var map = L.map('map').setView([10.3157, 123.8854], 13); // Default: Cebu City
    var marker;

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Function to update hidden input fields
    function updateLatLng(lat, lng) {
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    }

    // Add draggable marker
    marker = L.marker([10.3157, 123.8854], { draggable: true }).addTo(map);
    updateLatLng(10.3157, 123.8854);

    marker.on('dragend', function (e) {
        var latlng = marker.getLatLng();
        updateLatLng(latlng.lat, latlng.lng);
    });

    // Search button click event
    document.getElementById('search-location').addEventListener('click', function () {
        var address = document.getElementById('address').value;
        if (!address) {
            alert('Please enter a location to search.');
            return;
        }

        // Use OpenStreetMap Nominatim API for geocoding
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    var lat = data[0].lat;
                    var lon = data[0].lon;

                    // Move the map and marker
                    map.setView([lat, lon], 16);
                    marker.setLatLng([lat, lon]);
                    updateLatLng(lat, lon);
                } else {
                    alert('Location not found. Try a different address.');
                }
            })
            .catch(error => {
                console.error('Error fetching location:', error);
                alert('Unable to search location right now.');
            });
    });

    