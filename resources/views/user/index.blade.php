@extends('layouts.user.master')

@section('content')

<main>
    <!-- Start Head -->
    <section class="head">
        <div class="container">
            <div class="row">
                <!-- Start Categories -->
                <div class="col-lg-3 col-md-12">
                    <div class="cats card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-bars"></i> @lang('user.categories')</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                            @foreach($categories as $parent)
                                <li class="category-dropdown">
                                    <a href="javascript:void(0)">
                                        <span>{{ $parent->{lang('name')} }}</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="category-dropdown-items">
                                    @foreach($parent->childrens as $child)
                                        <li><a href="#">{{ $child->{lang('name')} }}</a></li>
                                    @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Categories -->

                <!-- Start Slideshow -->
                <div class="col-lg-9 col-md-12">
                    <div class="slideshow">
                        <button class="prev"><i class="fa fa-chevron-left"></i></button>
                        <button class="next"><i class="fa fa-chevron-right"></i></button>
                        <div id="slideshow" class="owl-carousel  owl-theme">
                        @foreach($slideshows as $slide)
                            <div class="item">
                                <img class="owl-lazy" data-src="{{ url('storage/'.$slide->image) }}" class="img-fluid" alt="">
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="options bg-primary d-flex justify-content-between p-3 text-center text-white">
                        <div class="item">
                            <h5>Money Back</h5>
                            <p>30 Days Money Back Guarantee</p>
                        </div>
                        <div class="item">
                            <h5>Free Shiping</h5>
                            <p>Shipping on orders over $99</p>
                        </div>
                        <div class="item">
                            <h5>Special Sale</h5>
                            <p>Extra $5 off on all items</p>
                        </div>
                    </div>
                </div>
                <!-- End Slideshow -->

            </div>
        </div>
    </section>
    <!-- End Head -->

    <div class="container">
        <div class="row">

            <!-- Start Hot Deal -->
            <div class="col-lg-3">
                <section class="hot-deal">
                    <div class="section-head">
                        <h3>{{ __('user.specialOffer') }}</h3>
                    </div>
                    <div id="offers" class="owl-carousel owl-theme">
                    @foreach($hotProducts as $product)
                        <div class="item">
                            <div class="product-card active">
                                <div class="card-head">
                                    <p class="category"><a href="#">{{ $product->category->{lang('name')} }}</a></p>
                                    <h4><a href="{{ $product->url }}">{{  $product->{lang('name')} }}</a></h4>
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
                </section>
            </div>
            <!-- End Hot Deal -->

            <!-- Start New Products -->
            <div class="col-lg-9">
                <section class="new-products">
                    <div class="section-head d-flex justify-content-between">
                        <h3>{{ __('user.newProducts') }}</h3>
                        <div class="carousel-control d-flex align-self-center">
                            <button class="prev btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                            <button class="next btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div id="new-products" class="owl-carousel owl-theme">
                        @foreach($newProducts as $product)
                        <div class="item">
                            <div class="product-card">
                                <div class="card-head">
                                    <p class="category"><a href="#">{{ $product->category->{lang('name')} }}</a></p>
                                    <h4><a href="{{ $product->url }}">{{  $product->{lang('name')}  }}</a></h4>
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
                </section>
            </div>
            <!-- End New Products -->

        </div>
    </div>

    <!-- Start Deals -->
    @foreach($offers as $offer)
        @if(count($offer->products))
        <section class="deals">
            <div class="container">
                <div class="deal-ad">
                    <img src="{{ url('storage/'.$offer->image) }}" class="img-fluid" alt="{{ $offer->{lang('name')} }}" title="{{ $offer->{lang('name')} }}">
                    <div class="mask">
                        <div class="content">
                            <h3>{{ $offer->{lang('name')} }}</h3>
                            <h4>@lang('user.offer') <span class="text-warning">{{ $offer->max_discount }}%</span></h4>
                            <a href="#" class="btn btn-primary">Show More</a>
                        </div>
                    </div>
                </div>
                <div class="deal-products">
                    <div class="row">
                        @foreach($offer->products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product-card">
                                <div class="card-head">
                                    <p class="category"><a href="#">{{ $product->category->{lang('name')} }}</a></p>
                                    <h4><a href="{{  $product->url }}">{{ $product->{lang('name')} }}</a></h4>
                                    @if($product->status)
                                    <span class="tag bg-{{ $product->handled_status[1] }}">{{  $product->handled_status[0]   }}</span>
                                    @endif
                                </div>
                                <div class="image">
                                    <img class="img-fluid owl-lazy" src="{{ url('storage/'.$product->images[0]->url) }}" alt="{{ $product->{lang('name')} }}"
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
        </section>
        @endif
    @endforeach
    <!-- End Deals -->

    <div class="container">
        <div class="row">

            <div class="col-lg-3">
                <div class="news-letter">
                    <div class="section-head">
                        <h3>News Letter</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-2 text-muted">Sign Up for Our Newsletter!</p>
                            <form>
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Your Email" class="form-control">
                                </div>
                                <button type="submit" class="pull-right btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tags">
                    <div class="section-head">
                        <h3>@lang('user.latestCats')</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @foreach($latestCats as $cat)
                            <span class="tag"><a href="">{{ $cat->{lang('name')} }}</a></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Best Seller -->
            <div class="col-lg-9">
                <section class="best-seller new-products">
                    <div class="section-head d-flex justify-content-between">
                        <h3>@lang('user.topRated')</h3>
                        <div class="carousel-control d-flex align-self-center">
                            <button class="prev btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                            <button class="next btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div class="row">
                        <div id="best-seller" class="owl-carousel owl-theme">
                            @foreach($topRated as $product)
                            <div class="item">
                                <div class="product-card">
                                    <div class="card-head">
                                        <p class="category"><a href="#">{{ $product->category->{lang('name')} }}</a></p>
                                        <h4><a href="{{ $product->url }}">{{  $product->{lang('name')}  }}</a></h4>
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
                </section>
            </div>
            <!-- End Best Seller -->

        </div>
    </div>

    <!-- Start Latest Blogs -->
    <section class="latest-blogs">
        <div class="container">
            <div class="section-head d-flex justify-content-between">
                <h3>@lang('user.latestBlogs')</h3>
                <div class="carousel-control d-flex align-self-center">
                    <button class="prev btn btn-primary"><i class="fa fa-arrow-left"></i></button>
                    <button class="next btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
            <div id="latest-blogs" class="owl-carousel owl-theme">
                @foreach($latestBlogs as $blog)
                <div class="item card blog">
                    <div class="card-body">
                        <div class="image">
                            <img class="owl-lazy" data-src="{{ url('storage/'.$blog->image) }}" alt="{{ $blog->{lang('title')} }}"
                                title="{{ $blog->{lang('title')} }}">
                        </div>
                        <h3 class="title"><a href="{{ $blog->url }}">{{ $blog->{lang('title')} }}</a></h3>
                    <p clas="title">
                        <span>
                            <span>@lang('user.blog.by')</span>
                            <a href="#" class="author">{{ $blog->user->first_name }}</a>
                        </span>
                        | {{ $blog->created_at->toFormattedDateString() }}</p>
                        <a href="{{ $blog->url }}" class="btn btn-primary">@lang('user.readmore')</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
<!-- End Latest Blogs -->
</main>
@endsection
