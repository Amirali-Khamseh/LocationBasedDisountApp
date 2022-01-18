@section('title') Create Product  @stop

@extends('front.layouts.master')
@section('content')
@include('front.user.layout.producer-header')
<div class="container">
@if(session()->has('error') && session()->get('error') == 0)
<div class="alert alert-icon alert-success alert-bg alert-inline show-code-action" id="parent-alert-logedin">
    <h4 class="alert-title">
        <i class="fas fa-check"></i>Done</h4>
        <p id="alert-loged-in">{{ session()->get('msg') }}</p>
</div>
@endif
@if(session()->has('error') && session()->get('error') == 1)
<div class="alert alert-icon alert-error alert-bg alert-inline show-code-action" id="parent-alert-danger-login">
    <h4 class="alert-title">
    <i class="w-icon-times-circle"></i>Oh snap!</h4>
    <p id="alert-danger-logedin">{{ session()->get('msg') }}</p>
</div>
@endif
@if ($errors->any())
<div class="alert alert-icon alert-error alert-bg alert-inline show-code-action" id="parent-alert-danger-login">
    <h4 class="alert-title">
    <i class="w-icon-times-circle"></i>Oh snap!</h4>
    @foreach ($errors->all() as $error)
    <p id="alert-danger-logedin">{{ $error }}</p>
    @endforeach
</div>
@endif
<form autocomplete="off" method="post" enctype="multipart/form-data" action="{{ route('store_product') }}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                <label for="parent">Category</label><i class="text-danger">*</i>
                <select onchange="parentCategories(this.value)" name="parent_id" class="form-control" id="parent">
                    @foreach($data['parent_categories'] as $item)
                        <option value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
                </select>
                </div>  
                <div class="form-group col-6">
                <label for="parent">Sub-category</label><i class="text-danger">*</i>
                <select name="childern_id" class="form-control" id="childern">
                        
                </select>
                </div>
               
            </div>
            <div class="row">
              
                <div class="col-6 parent-search-prducer">
                <div class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper ">
                    <input type="text" name="title" class="form-control" id="searchProducer" placeholder="Search your product name ..." required />
                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                    </button>
                    <div id="parent-producer_search_box" class="d-none">
                        
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                <label for="name">Price</label><i class="text-danger">*</i>
                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price" value="{{ old('price') }}">
                </div>
                <div class="form-group col-6">
                <label for="name">Discount Percentage</label><i class="text-danger"></i>
                <input type="text" name="discount_percent" class="form-control" id="discount_percent" placeholder="Enter Percentage of the discount !!!" value="{{ old('discount_percent') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Product Link</label><i class="text-danger"></i>
                <input type="text" name="product_link" class="form-control" id="product_link" placeholder="Enter your product link if you have ..." value="{{ old('product_link') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label for="name">Description</label><i class="text-danger">*</i>
                <textarea name="description" class="form-control" placeholder="product description ..." id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="row">
 
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
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
</div>
@section('scripts')
<script>
    

    $(document).ready(function(){
        loadAndCheckChildrens();
    });
    function loadAndCheckChildrens(){
        $.ajax({url: "/test/" + {{$data['parent_categories'][0]->id}},
        success: function(result){
            var html = '';
            for (let i = 0; i < result.length; i++) {
                if (i == 0) {
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