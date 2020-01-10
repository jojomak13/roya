@extends('layouts.user.master')

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li><a href="#" title="{{ $product->category->{lang('name')} }}">{{ $product->category->{lang('name')} }}</a></li>
            <li>{{ $product->{lang('name')} }}</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<main class="single-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div id="product" class="owl-carousel owl-theme">
                    @foreach($product->images as $image)
                    <div class="item">
                        <img class="owl-lazy" data-src="{{ url('storage/'.$image->url) }}" alt="{{ $product->{lang('name')} }}" title="{{ $product->{lang('name')} }}">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-7">
                <p><a href="#" class="product-category" title="{{ $product->category->{lang('name')} }}">{{  $product->category->{lang('name')} }}</a></p>
                <h1 class="product-title">{{ $product->{lang('name')} }}</h1>
                <div class="product-review">
                    <span><i class="fa fa-star active"></i></span>
                    <span><i class="fa fa-star active"></i></span>
                    <span><i class="fa fa-star active"></i></span>
                    <span><i class="fa fa-star"></i></span>
                    <span><i class="fa fa-star"></i></span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="availablity">@lang('user.available'):
                    @if($product->status == 'outOfStock')
                        <span class="text-danger">@lang('user.outOfStock')</span>
                    @else
                        <span class="text-success">@lang('user.inStock')</span>
                    @endif
                    </p>
                    <a href="#" title="@lang('user.wishlist.title')" class="wishlist"><i class="fa fa-heart"></i> @lang('user.wishlist.name')</a>
                </div>
                <p class="caret"></p>
                <div class="info">
                    {!! $product->{lang('description')} !!}
                </div>
                <div class="price">
                    <ins>@money($product->price) @lang('user.currency')</ins>
                    @if($product->discount)
                    <del>@money($product->sell_price)</del>
                    @endif
                </div>
                <div class="caret product-color">
                    <label for="color">@lang('user.color')</label>
                    <select name="color" id="color">
                        <option value="{{ $product->color }}">{{ $product->color }}</option>
                    </select>
                </div>
                <div class="addtocart-btn">
                    <input type="number" min="1" value="1">
                    <button type="submit"><i class="fa fa-shopping-cart"></i> @lang('user.addtocart')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="related-products mt-5">
        <div class="container">
            <div class="section-head d-flex justify-content-between">
                <h3>@lang('user.relatedProducts')</h3>
                <div class="carousel-control d-flex align-self-center">
                    <button class="prev btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                    <button class="next btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
            <div id="related-products" class="owl-carousel owl-theme">
                @foreach($relatedProducts as $product)
                <div class="item">
                    <div class="product-card">
                        <div class="card-head">
                            <p class="category"><a href="#">{{ $product->category->{lang('name')} }}</a></p>
                            <h4><a href="{{  $product->url }}">{{ $product->{lang('name')} }}</a></h4>
                            @if($product->status)
                            <span class="tag bg-{{ $product->handled_status[1] }}">{{  $product->handled_status[0]   }}</span>
                            @endif
                        </div>
                        <div class="image">
                            <img class="img-fluid owl-lazy" data-src="{{ url('storage/'.$product->images[0]->url) }}" alt="{{ $product->{lang('name')} }}"
                                title="{{ $product->{lang('name')} }}">
                        </div>
                        <div class="info d-flex justify-content-between">
                            <p class="price">
                                <span>@money($product->price) <span>@lang('user.currency')</span></span>
                                @if($product->discount)
                                <del>@money($product->sell_price)</del>
                                @endif
                            </p>
                            <div class="d-flex align-self-center">
                                <a href="#" title="add to cart" class="cart">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="stars">
                            <span class="star"><i class="fa fa-star"></i></span>
                            <span class="star checked"><i class="fa fa-star"></i></span>
                            <span class="star checked"><i class="fa fa-star"></i></span>
                            <span class="star checked"><i class="fa fa-star"></i></span>
                            <span class="star checked"><i class="fa fa-star"></i></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection