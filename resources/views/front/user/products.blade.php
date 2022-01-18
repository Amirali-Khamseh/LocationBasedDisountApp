@section('title') Products list @stop

@extends('front.layouts.master')
@section('content')
@include('front.user.layout.producer-header')
<div class="row justify-content-center margin-tb-4">
    <div class="col-3">
        <a href="{{ route('create_product') }}" class="btn btn-primary btn-block">Add Product</a>
    </div>
</div>
<div class="container">
<section class="mb-2 mb-lg-7">
    <div class="row product-wrapper show-code-action">
        @foreach($data['products'] as $item)
        <div class="col-md-3 col-6">
            <div class="product product-image-gap product-simple">
                <figure class="product-media">
                    <a href="{{ $item['status'] == 1 ? route('product_detail', ['id' => $item['id']]) : '#' }}">
                        <img src="{{ $item['image'] }}" alt="Product" width="295"
                            height="335" />
                    </a>
                    <div class="product-label-group">
                        @if($item['status'] == 0)
                        <label class="product-label label-discount">Pending</label>
                        @else
                        <label class="product-label-approved">Approved</label>
                        @endif
                    </div>
                </figure>
                <div class="product-details">
                    <div class="product-cat">
                        <a href="shop-banner-sidebar.html">{{ $item['category']['parent']['title'] .' - '. $item['category']['title'] }}</a>
                    </div>
                    <h4 class="product-name">
                        <a href="{{ $item['status'] == 1 ? route('product_detail', ['id' => $item['id']]) : '#' }}">{{ $item['title'] }}</a>
                    </h4>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: {{ $item['rating'] * 20 }}%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="{{ $item['status'] == 1 ? route('product_detail', ['id' => $item['id']]) : '#' }}" class="rating-reviews">({{ $item['rating_count'] }} reviews)</a>
                    </div>
                    <div class="product-pa-wrapper">
                    @if($item['discount_percent'] > 0)
                    <div class="product-price">
                        {{ $item['price'] - ($item['discount_percent'] / 100) * $item['price'] }} - <del>{{$item['price']}}</del><span class="discount_percent">%{{$item['discount_percent']}}</span>
                    </div>
                    @else
                    <div class="product-price">
                        {{$item['price']}}
                    </div>
                    @endif
                    
                        <div class="product-action" >
                            <form action="{{route('products.destroy', ['product' => $item['id']])}}" method="POST">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="text-danger  btn-cart btn-product btn btn-link btn-underline">Delete</button>
                            </form>
                        </div>
                     
                        <div class="product-action" style="margin-left:50px;">
                        <a href="{{ route('edit_product', ['id' => $item['id']]) }}"  target="_blank" class="btn-cart btn-product btn btn-link btn-underline">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
</div>
@stop