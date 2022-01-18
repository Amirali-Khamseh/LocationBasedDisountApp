$(function() {
    
    var curLocation = [0, 0];
    
    var map = L.map('MapLocation').setView(curLocation, 10).locate({ setView: true, maxZoom: 16 });

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: ''
    }).addTo(map);

    map.attributionControl.setPrefix(false);

    setTimeout(function() {
        $("#Latitude").val(map._lastCenter.lat);
        $("#Longitude").val(map._lastCenter.lng).keyup();
        var marker = new L.marker(map._lastCenter, {
            draggable: 'false'
        });
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'false'
            }).bindPopup(position).update();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });
        map.addLayer(marker);

        console.log(map._lastCenter)
    }, 500)




    $("#Latitude, #Longitude").change(function() {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: 'false'
        }).bindPopup(position).update();
        map.panTo(position);
    });
})