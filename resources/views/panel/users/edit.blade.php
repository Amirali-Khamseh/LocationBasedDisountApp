@extends('panel.layouts.master')
@section('title', 'Edit User')
@section('content')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title text-center">Edit user</h3>
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
    <form method="post" action="{{route('users.update',['user'=> $user->id])}}">
        @csrf
        @method('PUT')
        
        <div class="card-body">
        <div class="row">
                <div class="form-group col-6">
                <label for="role">Role</label><i class="text-danger">*</i>
                <select name="role" class="form-control" id="role">
                    @foreach($roles as $item)
                        <option value="{{$item->id}}" {{$item->id == $user->role_id ? 'selected':''}}>{{$item->title}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Name</label><i class="text-danger">*</i>
                <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                </div>
                <div class="form-group col-6">
                <label for="family">Family</label><i class="text-danger">*</i>
                <input type="text" name="family" class="form-control" id="family" value="{{$user->family}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="mobile">Mobile</label><i class="text-danger">*</i>
                <input type="number" name="mobile" class="form-control" id="mobile" value="{{$user->mobile}}">
                </div>
                <div class="form-group col-6">
                <label for="email">Email</label><i class="text-danger">*</i>
                <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="mobile">Password</label><i class="text-danger">*</i>
                <input type="password" name="password" class="form-control" id="password" placeholder="{{$user->password != null ? 'password exists': 'password is empty'}}">
                </div>
                <div class="form-group col-6">
                <label for="email">Confirm password</label><i class="text-danger">*</i>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>
            </div>
            <div class="form-check">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status"  class="custom-control-input" id="customSwitch1" {{$user->status == 1 ? 'checked':''}}>
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