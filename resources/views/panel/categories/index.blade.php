@extends('panel.layouts.master')
@section('title', 'List of Users')
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
      <th scope="col">Title</th>
      <th scope="col">Parent</th>
      <th scope="col">Status</th>
      <th>Delete</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
@foreach($data as $item)
    <tr>
      <td>{{$item->title}}</td>
      @if(isset($item->parent))
      <td><span class="badge badge-success">{{$item->parent->title}}</span></td>
      @else
      <td><span class="badge badge-danger">it's Parent</span></td>
      @endif
      @if($item->status==1)
          <td>Active✔ </td>
      @else
          <td>Passive✖</td>
     @endif
     <!-- sending the id of the user to the delete route -->
     <td>
       <form action="{{route('categories.destroy',['category'=> $item->id])}}" method="post">
         @method('Delete')
         @csrf
          <button class="btn btn-danger" type="submit">Delete</button>
      </form>
    </td>
     <!-- sending the id of the user to the edit route -->
     <td><a class="btn btn-warning" href="{{route('categories.edit',['category'=> $item->id])  }}">Edit</a></td>
    </tr>
@endforeach

  </tbody>
</table>
</body>
</html>
@stop