@extends('panel.layouts.master')
@section('title', "Product's comments")
@section('content')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Comments </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
     <th scope="col">Description</th>
      <th scope="col">Raiting</th>
      <th scope="col">Status</th>
      

    </tr>
  </thead>
  <tbody>
@foreach($data as $item)
    <tr>
        <td>{{$item->id}}</td>
      <td>{{$item->user->name .' '.$item->user->family }}</td>
      <td>{{strlen($item->description)>20 ? substr($item->description , 0,20)."...." : $item->description }} </td>
 
      <td>{{$item->rating}}</td>
      
    
      @if($item->status==1)
          <td><a href="{{route('active',['id'=> $item->id])}}">Active✔</a> </td>
      @else
          <td><a href="{{route('active',['id'=> $item->id])}}">Passive✖</a></td>
     @endif
     <!-- sending the id of the user to the delete route -->
     <td>

    </td>
     <!-- sending the id of the user to the edit route -->
    </tr>
@endforeach

  </tbody>
</table>
</body>
@endsection
