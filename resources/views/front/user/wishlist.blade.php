@section('title') Wishlist @endsection

@extends('front.layouts.master')
@section('content')
@include('front.user.layout.header')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<div class="page-content">
    <div class="container">
        <h3 class="wishlist-title">My wishlist</h3>
        <table class="shop-table wishlist-table">
            <thead>
                <tr>
                    <th class="product-name"><span>Image</span></th>
                    <th><span>Product</span></th>
                    <th class="product-price"><span>Price</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['wishlist'] as $item)
                <tr id="item-{{$item->id}}">
                    <td class="product-thumbnail">
                        <div class="p-relative">
                            <a href="product-default.html">
                                <figure>
                                    <img src="{{ isset($item->product->image) ? route('image-show') . '?image=' . $item->product->image->path : asset('images/no-img.jpg') }}" alt="product" width="300"
                                        height="338">
                                </figure>
                            </a>
                            <button type="button" onclick="removeFromWishlist({{$item->id}})" class="btn btn-close"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </td>
                    <td class="product-name text-center">
                        <a href="product-default.html">
                            {{$item['product']->title}}
                        </a>
                    </td>
                    <td class="product-price text-center">
                    @if($item->product->discount_percent > 0)
                    <div class="product-price">
                        {{ $item->product->price - ($item->product->discount_percent / 100) * $item->product->price }}  <del>{{$item->product->price}}</del><span class="discount_percent">%{{$item->product->discount_percent}}</span>
                    </div>
                    @else
                    <div class="product-price">
                        {{$item->product->price}}
                    </div>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="parent-map">
        <div class="row">
          <section class="col col-12">
            <div id="MapLocation" style="height: 500px"></div>
          </section>
        </div>
    </div>
</div>

@section('scripts')
<script>
    var data = []
    function addProducers(map, lat = 0, lng = 0,html_data){
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
    
    var html = `<div class='parent-pop_up'>${html_data}</div>`;
    var position = [lat,lng];
    marker.setLatLng(position, {
        draggable: false,
    }).bindPopup(html).openPopup().update();
    map.addLayer(marker);
    // add producers
  }
  function ajaxForProducersList(map,url,method){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: method,
        url: url,
        data: {},
        success: function(result){
            var id = null;
            var p_id = null;
            var data = []
            var arr = [];
            var lat = [];
            var lng = [];
            var count = 0;
            for (let i = 0; i < result.length; i++) {
                if (!arr.includes(result[i].owner_id)) {
                    arr[count] = result[i].owner_id
                    if (result[i].link == false) {
                        data[count] = `<a target="_blank" href='/product-detail/${result[i].product_id}'><div class='pop-up'>${result[i].title}<img src='${result[i].image}' /></div></a>`;
                    }else{
                        data[count] = `<a target="_blank" href='${result[i].link}'><div class='pop-up'>${result[i].title}<img src='${result[i].image}' /></div></a>`;
                    }
                    lat[count] = result[i].lat
                    lng[count] = result[i].lng
                    count += 1;
                }else{
                    if (arr.indexOf(result[i].owner_id) != -1) {
                        if (result[i].link == false) {
                            data[arr.indexOf(result[i].owner_id)] = data[arr.indexOf(result[i].owner_id)] + `<a target="_blank" href='/product-detail/${result[i].product_id}'><div class='pop-up'>${result[i].title}<img src='${result[i].image}' /></div></a>`
                        }else{
                            data[arr.indexOf(result[i].owner_id)] = data[arr.indexOf(result[i].owner_id)] + `<a target="_blank" href='${result[i].link}'><div class='pop-up'>${result[i].title}<img src='${result[i].image}' /></div></a>`
                        }
                    }
                }
            }
            console.log(arr);
            for (let i = 0; i < arr.length; i++) {
                addProducers(map, lat[i],lng[i], data[i])
            }
            return 0;
          for (let i = 0; i < result.length; i++) {
              id = result[i].owner_id
              p_id = result[i].id
              for (let j = 0; j < result.length; j++) {
                if (id == result[j].owner_id && p_id != result[j].id) {
                    data += `<div class='pop-up'>${result[i].title}<img src='${result[i].image}' /></div>`;
                }else if(id == result[j].owner_id && p_id == result[j].id){
                    console.log(p_id)
                }
                if (j == result.length - 1 && i == result.length -1) {
                    console.log(data);
                }
              }
              
            //   addProducers(map, result[i].lat,result[i].lng, data)
            //   var data = ''
          }
          
        }
    });
}

    $(function() {
    var url = "/user/get-wish-data";
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
        ajaxForProducersList(map,url,method);
    }, 2000)




    $("#Latitude, #Longitude").change(function() {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: false
        }).bindPopup(position).update();
        map.panTo(position);
    });
})
    // 
    // 
    // 
function removeFromWishlist(id){
    var url = 'wishlist';
    var method = 'post';
    return ajaxFunc(url,method,id);
}
function ajaxFunc(url,method,id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: method,
        url: url + '/' + id + '/delete',
        success: function(result){
            if(result.error == 1){
                alert(result.msg)
            }else{
                $('#item-' + id).remove()
            }
        }
    });
}
</script>
@stop
@stop