@extends('panel.layouts.master')
@section('title', 'Update Product')
@section('css')
<style>
    .slider-checked{
        display: none
    }
</style>
@stop
@section('content')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title text-center">Edit Product</h3>
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
    <form method="post" enctype="multipart/form-data" action="{{route('products.update',['product' => $data['data']->id])}}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Category</label><i class="text-danger">*</i>
                <select onchange="parentCategories(this.value)" name="parent_id" class="form-control" id="parent">
                    <!-- <option value="0" selected>parent</option> -->
                    @foreach($data['parent_categories'] as $item)
                        <option value="{{$item->id}}" {{ $data['data']->category->parent_id == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group col-6">
                <label for="parent">Sub-Category</label><i class="text-danger">*</i>
                <select name="childern_id" class="form-control" id="childern">
                        
                </select>
                </div>
               
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Title</label><i class="text-danger">*</i>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" value="{{ $data['data']->title}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Product URL</label><i class="text-danger">*</i>
                <input type="text" name="product_link" class="form-control" id="URL" placeholder="Link goes here " value="{{ $data['data']->product_link}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Price</label><i class="text-danger">*</i>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price" value="{{ $data['data']->price }}">
                </div>
                <div class="form-group col-6">
                <label for="name">Discount Percent</label><i class="text-danger"></i>
                <input type="text" name="discount_percent" class="form-control" id="discount_percent" placeholder="Enter discount_percent" value="{{ $data['data']->discount_percent }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Description</label><i class="text-danger">*</i>
                <textarea name="description" class="form-control" placeholder="product description ..." id="description" cols="30" rows="10">{{$data['data']->description }}</textarea>
                </div>
            </div>
            <div class="row">
 
                <div class="col-md-12">
                    <div class="form-group">
                        @if(isset($data['data']->image))
                            <img src="{{route('image-show') . '?image=' . $data['data']->image->path}}" style="display:block;margin:auto;width: 400px" width="100" alt="">
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
            <div class="form-check">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" {{$data['data']->status == 1 ? 'checked' : ''}} class="custom-control-input" id="status">
                    <label class="custom-control-label" for="status">status</label>
                </div>
            </div>
            <div class="form-check">
                <div class="custom-control custom-switch">
                    <input type="checkbox" id="is_slider" name="is_slider" {{$data['data']->is_slider == 1 ? 'checked' : ''}} class="custom-control-input">
                    <label class="custom-control-label" for="is_slider">slider</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="btn">Submit</button>
        </div>
    </form>
    <form method="post" id="ImageDestroy" action="{{route('products.image-destroy',['id' => $data['data']->id])}}">
        @csrf
    </form>
@section('scripts')
<script>
    function destroyImage(){
        document.getElementById("ImageDestroy").submit();
    }
    $(document).ready(function(){
        loadAndCheckChildrens();
    });
    function loadAndCheckChildrens(){
        $.ajax({url: "/test/" + {{$data['data']->category->parent_id}},
        success: function(result){
            var html = '';
            for (let i = 0; i < result.length; i++) {
                if ({{$data['data']->category->id }} == result[i].id) {
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
@endsection
</div>
@stop