@extends('front.layouts.master')
@section('content')
<div class="page-content">
                <div class="container">
                    <div class="login-popup">
                        <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                            <ul class="nav nav-tabs text-uppercase" role="tablist">
                                <li class="nav-item">
                                    <a href="#sign-in" class="nav-link active">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#sign-up" class="nav-link">Sign Up</a>
                                </li>
                            </ul>
                            <div class="col-md-12 mb-4">
                            <div class="alert alert-icon alert-success alert-bg alert-inline show-code-action d-none" id="parent-alert-logedin">
                                <h4 class="alert-title">
                                    <i class="fas fa-check"></i>Done</h4>
                                    <p id="alert-loged-in"></p>
                            </div>
                            <div class="alert alert-icon alert-error alert-bg alert-inline show-code-action d-none" id="parent-alert-danger-login">
                                <h4 class="alert-title">
                                    <i class="w-icon-times-circle"></i>Oh snap!</h4>
                                    <p id="alert-danger-logedin"></p>
                            </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="sign-in">
                                    <div class="form-group">
                                        <label>email address *</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1" required="">
                                        
                                    </div>
                                    <a onclick="auth('login')" class="btn btn-primary">Sign In</a>
                                </div>
                                <div class="tab-pane" id="sign-up">
                                    <div class="form-group">
                                        <label>Your email address *</label>
                                        <input type="text" class="form-control" name="email_1" id="email_1" required>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" name="password_1" id="password_1" required>
                                    </div>
                                    <div class="checkbox-content login-vendor">
                                        <div class="form-group mb-5 d-none" id="shop-el">
                                            <label>Shop Name *</label>
                                            <input type="text" class="form-control" name="shop_name" id="shop_name" required>
                                        </div>
                                        <div class="form-group mb-5">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" name="first-name" id="first-name" required>
                                        </div>
                                        <div class="form-group mb-5">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" name="last-name" id="last-name" required>
                                        </div>
                                        <div class="form-group mb-5">
                                            <label>Phone Number *</label>
                                            <input type="text" class="form-control" name="phone-number" id="phone-number" required>
                                        </div>
                                        <div class="form-group mb-5">
                                            <label>user</label>
                                            <input name="type" value="1" checked onclick="changeType('user')" id="radio-type" type="radio">
                                            <label>producer</label>
                                            <input name="type" value="1" onclick="changeType('producer')" id="radio-type" type="radio">
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" id="register-sign_up" onclick="auth('register')">Sign Up</a>
                                    <a class="btn btn-primary d-none" id="register-sign_up-next" onclick="auth('next')">Next</a>
                                </div>
                                <div class="v-hidden" id="map">
                                <div class="parent-map">
                                    <div class="row">
                                    <section class="col col-12">
                                        <div id="MapLocation" style="height: 500px"></div>
                                    </section>
                                    </div>
                                    <div class="row">
                                    <section class="col col-3">
                                        <label class="input">
                                        <input id="Latitude" type="hidden" placeholder="Latitude" name="Location.Latitude" />
                                        <!-- @Html.TextBoxFor(m => m.Location.Latitude, new {id = "Latitude", placeholder = "Latitude"}) -->
                                        </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="input">
                                        <input id="Longitude" type="hidden" placeholder="Longitude" name="Location.Longitude" />
                                        <!-- @Html.TextBoxFor(m => m.Location.Longitude, new {id = "Longitude", placeholder = "Longitude"}) -->
                                        </label>
                                    </section>
                                    </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <a class="btn btn-primary col-5 mr-2" id="register-sign_up-back" onclick="auth('back')">Back</a>
                                        <a class="btn btn-primary col-5 ml-2" onclick="auth('register-producer')">Sign up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@section('scripts')
<script>
    
    $(function() {
 
    
    var curLocation = [0, 0];
    var map = L.map('MapLocation').setView(curLocation, 10).locate({ setView: true, maxZoom: 16 });
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: ''
    }).addTo(map);
    console.log(map._lastCenter);
    map.attributionControl.setPrefix(false);

    setTimeout(function() {
        $("#Latitude").val(map._lastCenter.lat);
        $("#Longitude").val(map._lastCenter.lng).keyup();
        var marker = new L.marker(map._lastCenter, {
            draggable: 'true'
        });
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });
        map.addLayer(marker);

        
    }, 2000)




    $("#Latitude, #Longitude").change(function() {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
    });
})
$("body").bind("ajaxSend", function(elm, xhr, s){
   if (s.type == "POST") {
      xhr.setRequestHeader('X-CSRF-Token', getCSRFTokenValue());
   }
});
function changeType(type) {
    if(type == 'producer'){
        $('#register-sign_up').addClass('d-none')
        $('#shop-el').removeClass('d-none')
        $('#register-sign_up-next').removeClass('d-none')
    }else{
        $('#register-sign_up-next').addClass('d-none')
        $('#register-sign_up').removeClass('d-none')
        $('#shop-el').addClass('d-none')
    }
}
function auth(type){
        console.log(type)
    if (type == 'register') {
        return registerUser('user')
    }else if(type == 'login'){
        return loginUser()
    }else if(type == 'next'){
        var checkForm = registerUser('user', '1')
        if (checkForm == true) {
            $('#sign-up').addClass('d-none')
            $('#map').removeClass('v-hidden')
        }
    }else if(type == 'back'){
        $('#sign-up').removeClass('d-none')
        $('#map').addClass('v-hidden')
    }else if(type == 'register-producer'){
        return registerUser('producer')
    }
}
function loginUser(){
    $('#password').removeClass('error')
    $('#email').removeClass('error')
    var data = {
        email: $('#email').val(),
        password: $('#password').val()
    }
    if (data.email == '') 
        $('#email').addClass('error')
    if (data.password == '') 
        $('#password').addClass('error')
    else{
        var url = "/user-login";
        var method = "post"
 
        ajaxFunc(url,method,data);
    }
}
function registerUser(type, level = null){

    if (type == 'user') {
        var data = {
            email: $('#email_1').val(),
            password: $('#password_1').val(),
            name: $('#first-name').val(),
            family: $('#last-name').val(),
            mobile: $('#phone-number').val(),
            type: type
        }
    }else{
        var data = {
            email: $('#email_1').val(),
            password: $('#password_1').val(),
            name: $('#first-name').val(),
            family: $('#last-name').val(),
            mobile: $('#phone-number').val(),
            shop_name: $('#shop_name').val(),
            lat: $('#Latitude').val(),
            lng: $('#Longitude').val(),
            type: type
        }
    }
    var count = 0;
    if (data.email == ''){
        $('#email_1').addClass('error')
        count++
    }else{
        $('#email_1').removeClass('error')
    }
    if (data.password == ''){
        $('#password_1').addClass('error')
        count++
    }else{
        $('#password_1').removeClass('error')
    }
    if (data.name == ''){
        $('#first-name').addClass('error')
        count++
    }else{
        $('#first-name').removeClass('error')
    }
        
    if (data.family == ''){
        $('#last-name').addClass('error')
        count++
    }else{
        $('#last-name').removeClass('error')
    }
    if (data.mobile == ''){
        $('#phone-number').addClass('error')
        count++
    }else{
        $('#phone-number').removeClass('error')
    }
    if(count == 0 && level == null){
        var url = "/user-register";
        var method = "post"
        ajaxFunc(url,method,data);
    }
    if (count == 0) {
        return true
    }else{
        return false
    }
        
}
function ajaxFunc(url,method,data){
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
        data: {data: data},
        success: function(result){
            if(result.error == 1){
                $('#parent-alert-danger-login').removeClass('d-none')
                $('#alert-danger-logedin').html(result.msg)
                // alert(result.msg)
            }else{
               
                $('#parent-alert-logedin').removeClass('d-none')
                $('#alert-loged-in').html(result.msg); 
             setTimeout(() => {
                window.location.reload();
             }, 1000);
              
            }
        }
    });
}

</script>
<!-- <script src="{{ asset('front/js/producer_map.js') }}"></script> -->
@stop
@stop