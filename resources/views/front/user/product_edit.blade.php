@section('title') Edit Product  @stop

@extends('front.layouts.master')
@section('content')
@include('front.user.layout.producer-header')
<div class="container">
<form method="post" enctype="multipart/form-data" action="{{route('producer_product.update',['id' => $data['detail']['id']])}}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Parent</label><i class="text-danger">*</i>
                <select onchange="parentCategories(this.value)" name="parent_id" class="form-control" id="parent">
                    @foreach($data['parent_categories'] as $item)
                        <option value="{{$item->id}}" {{ $data['detail']['category_parent_id'] == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                    @endforeach
                </select>
                </div>  
                <div class="form-group col-6">
                <label for="parent">Childrens</label><i class="text-danger">*</i>
                <select name="childern_id" class="form-control" id="childern">
                        
                </select>
                </div>
               
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Title</label><i class="text-danger">*</i>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{ $data['detail']['title']}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Price</label><i class="text-danger">*</i>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price" value="{{ $data['detail']['price'] }}">
                </div>
                <div class="form-group col-6">
                <label for="name">Discount Percent</label><i class="text-danger"></i>
                <input type="text" name="discount_percent" class="form-control" id="discount_percent" placeholder="Enter discount_percent" value="{{ $data['detail']['discount_percent'] }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Product Link</label><i class="text-danger"></i>
                <input type="text" name="product_link" class="form-control" id="product_link" placeholder="Enter product_link" value="{{ $data['detail']['product_link'] }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Description</label><i class="text-danger">*</i>
                <textarea name="description" class="form-control" placeholder="product description ..." id="description" cols="30" rows="10">{{$data['detail']['description'] }}</textarea>
                </div>
            </div>
            <div class="row">
 
                <div class="col-md-12">
                    <div class="form-group">
                        @if($data['detail']['image'] != null)
                            <img src="{{ $data['detail']['image'] }}" style="display:block;margin:auto;width: 400px" width="100" alt="">
                            <button type="button" onclick="destroyImage()" class="btn btn-danger" style="display:block;margin:auto"><span class="fa fa-trash"></span></button>
                        @else
                            <input type="file" name="image" placeholder="Choose image" id="image">
                        @endif
                    @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-block" id="btn">Submit</button>
        </div>
    </form>
    <form method="post" id="ImageDestroy" action="{{route('products.image-destroy',['id' => $data['detail']['id']])}}">
        @csrf
    </form>
</div>
@section('scripts')
<script>
    function destroyImage(){
        document.getElementById("ImageDestroy").submit();
    }
    $(document).ready(function(){
        loadAndCheckChildrens();
    });
    function loadAndCheckChildrens(){
        $.ajax({url: "/test/" + {{$data['detail']['category_parent_id']}},
        success: function(result){
            var html = '';
            for (let i = 0; i < result.length; i++) {
                if ({{$data['detail']['category_id'] }} == result[i].id) {
                    html += `<option value="${result[i].id}" selected>${result[i].title}</option>`;
                }else{
                    html += `<option value="${result[i].id}">${result[i].title}</option>`;
                }
            }
            $('#childern').html(html)
        },
        error: function(err){
            console.log(err)
        }
        });
    }
    function parentCategories(id){
        $.ajax({url: "/test/" + id,
        success: function(result){
            var html = '';
            for (let i = 0; i < result.length; i++) {
                html += `<option value="${result[i].id}">${result[i].title}</option>`;
            }
            $('#childern').html(html)
        },
        error: function(err){
            console.log(err)
        }
        });
    }
</script>
@stop
@stop