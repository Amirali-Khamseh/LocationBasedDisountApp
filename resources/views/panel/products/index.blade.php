@extends('panel.layouts.master')
@section('title', 'List of Products')
@section('css')
<style>
  .img{
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }
</style>
@stop
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of users </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Discounted</th>
      <th scope="col">Owner</th>
      <th scope="col" class="text-center">Category</th>
      <th scope="col">Status</th>
      <th>Setting</th>
    </tr>
  </thead>
  <tbody>
@foreach($data as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td><a href="{{isset($item->image) ? route('image-show') . '?image=' . $item->image->path : asset('/images/no-img.jpg')}}" target="_blank"><img src="{{isset($item->image) ? route('image-show') . '?image=' . $item->image->path : asset('/images/no-img.jpg')}}" class="img" alt=""></a></td>
      <td>{{$item->title}}</td>
      <td>{{$item->price}} HUF @if($item->discount_percent > 0) <span class="badge badge-danger">%{{$item->discount_percent}}</span> @endif</td>
      <td>{{$item->price - ($item->price * ($item->discount_percent/100)) }} HUF</td>
      <td>{{$item->owner->shop_name}}</td>
      <td class="text-center"><span class="badge badge-success" style="font-size: 15px;font-weight:bold">{{$item->category->parent->title}} - {{$item->category->title}}</span></td>
      <!-- @if(isset($item->parent))
      <td><span class="badge badge-success">{{$item->parent->title}}</span></td>
      @else
      <td><span class="badge badge-danger">it's Parent</span></td>
      @endif -->
      @if($item->status==1)
          <td>Active✔ </td>
      @else
          <td>Passive✖</td>
     @endif
     <!-- sending the id of the user to the delete route -->
     <td>
     <div class="btn-group">
        <a class="btn btn-success" href="{{route('products.edit',['product'=> $item->id])  }}">Edit</a>
        <button type="button" class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
          <form action="{{route('products.destroy',['product'=> $item->id])}}" method="post">
            @method('Delete')
            @csrf
              <button class="dropdown-item" type="submit">Delete</button>
          </form>
          <a class=" dropdown-item" href="{{route('products.edit',['product'=> $item->id])  }}">Edit</a>
          <a class="dropdown-item" href={{ route('comments',['id' => $item->id]) }}>Comments</a>
        </div>
      </div>
       
      
    </td>
     <!-- sending the id of the user to the edit route -->
    </tr>
@endforeach

  </tbody>
</table>
</body>
</html>
@stop