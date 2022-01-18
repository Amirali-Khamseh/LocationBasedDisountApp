@section('title') Address Detail @stop

@extends('front.layouts.master')
@section('content')
@if(Route::getFacadeRoot()->current()->uri() == 'user/address')
@include('front.user.layout.header')
@else
@include('front.user.layout.producer-header')
@endif
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
<div class="container">
    <div class="parent-map">
    <div class="row">
      <section class="col col-12">
        <div id="MapLocation" style="height: 500px"></div>
      </section>
    </div>
    <div class="row">
      @if(Route::getFacadeRoot()->current()->uri() == 'producer/address')
      <form action="{{ route('address_post') }}" method="post">
        @csrf
      <section class="col col-3">
        <label class="input">
          <input type="hidden" id="Latitude" placeholder="Latitude" name="Location.Latitude" />
        </label>
      </section>
      <section class="col col-3">
        <label class="input">
          <input type="hidden" id="Longitude" placeholder="Longitude" name="Location.Longitude" />
        </label>
      </section>
      <section class="col-12">
      <button class="btn btn-primary btn-block">Submit</button>
      </section>
      </form>
      @endif
    </div>
    </div>
</div>
<style>
    .parent-map{
        width: 80%;
        height: 500px;
        margin: 60px auto;
        border-radius: 10px;
        background-color: lightgray
    }
    #map {
        height: 100%;
    }
    .custom-map-control-button{
        height: 40px;
        cursor: pointer;
        border-radius: 2px;
        background: white;
        top: 54% !important;
        right: 1% !important;
        left: unset !important;
        filter: unset;
    }
    .custom-map-control-button:hover{
        filter: revert;
    }
</style>
@if(Route::getFacadeRoot()->current()->uri() == 'producer/address')
@section('js')
<script>
  
  $(function() {
  
    var lat = {{$data['address']['lat']}};
    var lng = {{$data['address']['lng']}};
    var curLocation = [lat, lng];
   
    
    var map = L.map('MapLocation').setView(curLocation, 16);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: ''
    }).addTo(map);

    map.attributionControl.setPrefix(false);

    setTimeout(function() {
        $("#Latitude").val(curLocation[0]);
        $("#Longitude").val(curLocation[1]).keyup();
        var marker = new L.marker(curLocation, {
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
    }, 500)




    $("#Latitude, #Longitude").change(function() {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: 'false'
        }).bindPopup(position).update();
        map.panTo(position);
    });



})
</script>
@stop
@else

@section('js')
<script>
  function addProducers(map, lat = 0, lng = 0,shop_name){
    // add producers
    
    var marker = new L.marker(map._lastCenter, {
        draggable: false,
        icon: L.icon({
          iconUrl: "{{asset('front/producer.png')}}",

          iconSize:     [40, 40], // size of the icon
          iconAnchor:   [40, 40], // point of the icon which will correspond to marker's location
          popupAnchor:  [-20, -20] // point from which the popup should open relative to the iconAnchor
        })
    })
    var position = [lat,lng];
    marker.setLatLng(position, {
        draggable: false,
    }).bindPopup("<div class='pop-up'>" + shop_name + "</div>").openPopup().update();
    map.addLayer(marker);
    // add producers
  }
  function ajaxFunc(map,url,method){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#parent-alert-logedin').addClass('d-none')
    $('#parent-alert-danger-login').addClass('d-none')
    $.ajax({
        type: method,
        url: url,
        data: {},
        success: function(result){
          console.log(map)
          for (let i = 0; i < result.length; i++) {
            addProducers(map, result[i].lat,result[i].lng, result[i].shop_name)
          }
        }
    });
}

    $(function() {
    var url = "get-data";
    var method = 'get';
    


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
            draggable: false
        });
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: false
            }).bindPopup(position).update();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });
        map.addLayer(marker);
        ajaxFunc(map,url,method);
    }, 2000)




    $("#Latitude, #Longitude").change(function() {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: false
        }).bindPopup(position).update();
        map.panTo(position);
    });
})
</script>
@stop

@endif
@stop