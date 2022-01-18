var mMoveHandler;

function initialize() {
    var center = new google.maps.LatLng(47.497913, 19.040236);
    var infoWindow = new google.maps.InfoWindow();
    var mapOptions = {
        center: center,
        zoom: 18,
        draggable: true
    };

    var map = new google.maps.Map(document.getElementById("map"),
        mapOptions);


    google.maps.event.addListener(map, 'mouseup', function(e) {
        google.maps.event.removeListener(mMoveHandler);
    });

    var listenerHandle =
        google.maps.event.addListener(map, 'mousedown', function(e) {

            var latLng = e.latLng;

            marker = new google.maps.Marker({
                position: latLng,
                map: map,
                draggable: true,
                icon: {
                    url: 'http://localhost:8000/front/images/producer.png',
                    scaledSize: new google.maps.Size(50, 50),
                    origin: new google.maps.Point(0, 0), // origin
                },
                title: 'Your Location'
            });
            // to get data about mouse position
            mMoveHandler = google.maps.event.addListener(map, 'mousemove', function(e) {
                marker.setPosition(e.latLng);

            });
            google.maps.event.addListener(marker, 'dragend', function(evt) {
                $("#txtLat").val(evt.latLng.lat().toFixed(6));
                $("#txtLng").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);
            });

            //geo location
            const locationButton = document.createElement("img");
            locationButton.setAttribute('src', 'http://localhost:8000/front/images/current-location.png')
            locationButton.setAttribute('title', 'current location')

            // icon
            const iconBase = 'http://localhost:8000/front/images/user.png';
            const icons = {
                    user: {
                        icon: iconBase + "user.png",
                    },
                    producer: {
                        icon: iconBase + "producer.png",
                    },
                }
                // icon
            locationButton.classList.add("custom-map-control-button");
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
            locationButton.addEventListener("click", () => {
                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };
                            map.panTo(pos)
                            $("#txtLat").val(pos.lat.toFixed(6));
                            $("#txtLng").val(pos.lng.toFixed(6));
                            marker.setPosition(pos);
                            map.setCenter(pos);
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            });
            //geo location 

            map.setCenter(marker.position);
            google.maps.event.removeListener(listenerHandle);
        });
}

google.maps.event.addDomListener(window, 'load', initialize);