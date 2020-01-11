@extends('layouts.user.master')


@section('title', $product->{lang('name')})
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
    {{-- Start Product Details --}}
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
            <div class="col-lg-7 product-details">
                <p><a href="#" class="product-category" title="{{ $product->category->{lang('name')} }}">{{  $product->category->{lang('name')} }}</a></p>
                <h1 class="product-title">{{ $product->{lang('name')} }}</h1>
                <div class="product-review">
                @foreach($product->product_rate as $rate)
                    {!! $rate !!}
                @endforeach
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
    {{-- End Product Details --}}

    {{-- Start User Reviews --}}
    <div class="container">
        <div class="card reviews">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="title">{{ __('user.reviews.basedon', ['number' => $product->votes->count()]) }}</h5>
                        <div class="head">
                            <h4>{{ $product->total_rate }}</h4>
                            <p>@lang('user.reviews.overall')</p>
                        </div>
                        <div class="reviews">
                            @foreach($productRates as $key => $value)
                            <div class="product-review">
                                <div class="stars">
                                    @for ($i = 0; $i < $key; $i++)
                                        <i class="fa fa-star active"></i>
                                    @endfor
                                    @for ($i = 5 - $key; $i > 0; $i--)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </div>
                                <div class="votes-progress">
                                    <div style="width: {{ $value . '%' }}"></div>
                                </div>
                                <span>{{ $value }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5>@lang('user.reviews.newReview')</h5>
                        @guest
                        <div class="message-not-logged">
                            <p>@lang('user.reviews.notAuth')</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">@lang('user.reviews.login')</a>
                            <a href="{{ route('register') }}" class="btn btn-success">@lang('user.reviews.register')</a>
                        </div>
                        @endguest
                        @auth
                        <form id="needs-validation" novalidate action="{{ route('product.review', $product->id) }}" method="POST" class="add-review" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="review">@lang('user.reviews.rate')</label>
                                <select name="stars" id="review" class="form-control @error('review') is-invalid @enderror" required>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                                @error('review')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="feedback">@lang('user.reviews.feedback')</label>
                                <textarea dir="auto" name="feedback" id="feedback" class="form-control @error('feedback') is-invalid @enderror" required></textarea>
                                @error('feedback')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">@lang('user.reviews.submit')</button>
                            </div>
                        </form>
                        @endauth
                    </div>
                    <div class="col-lg-12">
                        <ul class="user-reviews">
                            @foreach($product->votes as $vote)
                            <li>
                                <div class="info">
                                    <strong>{{ $vote->first_name . ' ' . $vote->last_name }}</strong> - {{ $vote->pivot->created_at->diffForHumans() }}
                                </div>
                                <p>{{ $vote->pivot->feedback }}</p>
                                <div class="product-review">
                                @foreach($vote->pivot->user_review as $review)
                                    {!! $review !!}
                                @endforeach
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End User Reviews --}}
    
    {{-- Start Related Products --}}
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
                            @foreach($product->product_rate as $rate)
                            {!! $rate !!}
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- End Related Products --}}

</main>
@endsection