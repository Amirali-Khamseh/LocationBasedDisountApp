@extends('panel.layouts.master')
@section('title', 'Update Category')
@section('content')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title text-center">create Category</h3>
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
    <form method="post" action="{{route('categories.update',['category'=> $cat->id])}}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Parent</label><i class="text-danger">*</i>
                <select name="parent_id" class="form-control" id="parent">
                    @foreach($data as $item )
                        <option value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
               </select>
                </div>
                <div class="form-group col-6">
                <label for="name">Title</label><i class="text-danger">*</i>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{$cat->title}}">
                </div>
            </div>
            <div class="form-check">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1" {{$cat->status == 1 ? 'checked':''}}>status</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop