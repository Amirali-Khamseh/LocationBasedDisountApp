@extends('front.layouts.master')
@section('content')
@section('title') Account Detail @stop

@if(Route::getFacadeRoot()->current()->uri() == 'user/account')
@include('front.user.layout.header')
@else
@include('front.user.layout.producer-header')
@endif
<div class="container">
<div class="tab-pane" id="account-details">
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if( session()->get('error') == '0' )
        <div class="alert alert-success alert-dismissible">
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <h3>{{ session()->get('msg') }}</h3>
        </div>
    @endif
    @if(session()->get('error') == '1' )
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>{{ session()->get('msg') }}
        </div>
    @endif

    <form class="form account-details-form" action="{{route('user-account')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">First name *</label>
                    <input type="text" id="name" name="name" placeholder="John" value="{{$data['user']->name}}"
                        class="form-control form-control-md">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="family">Last name *</label>
                    <input type="text" id="family" name="family" placeholder="Doe" value="{{$data['user']->family}}"
                        class="form-control form-control-md">
                </div>
            </div>
        </div>

        <div class="row form-group mb-6">
            @if(Route::getFacadeRoot()->current()->uri() == 'producer/account')
            <div class="col-6">
                <label for="shop_name">Shop Name *</label>
                <input type="shop_name" id="shop_name" name="shop_name" value="{{$data['user']->shop_name}}"
                    class="form-control form-control-md">
            </div>
            @endif
            <div class="col-6">
                <label for="email">Email address *</label>
                <input type="email" id="email" name="email" value="{{$data['user']->email}}"
                    class="form-control form-control-md">
            </div>
        </div>
        <div class="form-group mb-6">
            <label for="mobile">Mobile *</label>
            <input type="number" id="mobile" name="mobile" value="{{$data['user']->mobile}}"
                class="form-control form-control-md">
        </div>
        
        <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
        <div class="form-group">
            <label class="text-dark" for="cur-password">Current Password leave blank to leave unchanged</label>
            <input type="password" class="form-control form-control-md"
                id="cur-password" name="cur_password" value="">
        </div>
        <div class="form-group">
            <label class="text-dark" for="new-password">New Password (leave blank in case you don't want to change)</label>
            <input type="password" class="form-control form-control-md"
                id="new-password" name="password">
        </div>
        <div class="form-group mb-10">
            <label class="text-dark" for="conf-password">Confirm Password</label>
            <input type="password" class="form-control form-control-md"
                id="conf-password" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
    </form>
</div>
</div>
@stop