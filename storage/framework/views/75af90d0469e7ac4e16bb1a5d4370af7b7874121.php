<?php $__env->startSection('title'); ?> Address Detail <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php if(Route::getFacadeRoot()->current()->uri() == 'user/address'): ?>
<?php echo $__env->make('front.user.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php echo $__env->make('front.user.layout.producer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
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
      <?php if(Route::getFacadeRoot()->current()->uri() == 'producer/address'): ?>
      <form action="<?php echo e(route('address_post')); ?>" method="post">
        <?php echo csrf_field(); ?>
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
      <?php endif; ?>
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
<?php if(Route::getFacadeRoot()->current()->uri() == 'producer/address'): ?>
<?php $__env->startSection('js'); ?>
<script>
  
  $(function() {
  
    var lat = <?php echo e($data['address']['lat']); ?>;
    var lng = <?php echo e($data['address']['lng']); ?>;
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
<?php $__env->stopSection(); ?>
<?php else: ?>

<?php $__env->startSection('js'); ?>
<script>
  function addProducers(map, lat = 0, lng = 0,shop_name){
    // add producers
    
    var marker = new L.marker(map._lastCenter, {
        draggable: false,
        icon: L.icon({
          iconUrl: "<?php echo e(asset('front/producer.png')); ?>",

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
<?php $__env->stopSection(); ?>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/front/user/address.blade.php ENDPATH**/ ?>