@extends('panel.layouts.master')
@section('title', 'Create User')
@section('content')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title text-center">create user</h3>
    </div>

    @if( session()->get('error') == '0' )
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            {{ session()->get('msg') }}
        </div>
    @endif
    @if(session()->get('error') == '1' )
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>{{ session()->get('msg') }}
        </div>
    @endif


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{route('users.store')}}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="role">Role</label><i class="text-danger">*</i>
                <select name="role" class="form-control" id="role">
                    @foreach($roles as $item)
                        <option value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Name</label><i class="text-danger">*</i>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{old('name')}}">
                </div>
                <div class="form-group col-6">
                <label for="family">Family</label><i class="text-danger">*</i>
                <input type="text" name="family" class="form-control" id="family" placeholder="Enter family" value="{{old('family')}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="mobile">Mobile</label><i class="text-danger">*</i>
                <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile" value="{{old('mobile')}}">
                </div>
                <div class="form-group col-6">
                <label for="email">Email</label><i class="text-danger">*</i>
                <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="{{old('email')}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="mobile">Password</label><i class="text-danger">*</i>
                <input type="password" name="password" class="form-control" id="password" >
                </div>
                <div class="form-group col-6">
                <label for="email">Confirm password</label><i class="text-danger">*</i>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>
            </div>
            <div class="form-check">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">status</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop