@extends('layouts.user.master')

@section('title', __('user.title.shop'))

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li>@lang('user.title.shop')</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<main class="shop">
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
                                        <img src="{{ $parent->category_image }}" alt="{{ $parent->{lang('name')} }}" title="{{ $parent->{lang('name')} }}">
                                        <span>{{ $parent->{lang('name')} }}</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <ul class="category-dropdown-items">
                                    @foreach($parent->childrens as $child)
                                        <li><a href="{{ $child->url }}">{{ $child->{lang('name')} }}</a></li>
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
            <div class="col-lg-3">
                <div class="shop-by">
                    <div class="section-head">
                        <h2>@lang('user.shopby')</h2>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="sort-type">
                                <span class="title">@lang('user.brand')</span>
                                <ul>
                                    @foreach($brands as $brand)
                                    <li>
                                        <label class="d-flex justify-content-between align-items-center">
                                            <span>{{ $brand->{lang('name')} }}</span>
                                            <input type="checkbox" name="brands[]" multiple multiple id="{{ $brand->id }}" value="{{ $brand->id }}">
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="sort-type">
                                <span class="title">@lang('user.color')</span>
                                <ul>
                                    @foreach($colors as $color)
                                    <li>
                                        <label class="d-flex justify-content-between align-items-center">
                                            <span><i class="fa fa-circle-o text-{{ $color->color }}"></i> {{ $color->color }}</span>
                                            <input type="checkbox" name="colors[]" multiple id="{{ $color->color }}" value="{{ $color->color }}">
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Start Serach Bar -->
                <div class="search-bar">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <ul>
                                <li class="viewType {{ request('viewType') == 'grid'? 'active':'' }}">
                                    <label for="grid" title="@lang('user.sort.grid')"><i class="fa fa-th-large"></i> @lang('user.sort.grid')</i></label>
                                    <input class="d-none" {{ request('viewType') == 'grid'? 'checked':'' }} value="grid" type="radio" name="viewType" id="grid">
                                </li>
                                <li class="viewType {{ request('viewType') == 'list'? 'active':'' }}">
                                    <label for="list" title="@lang('user.sort.list')"><i class="fa fa-th-list"></i> @lang('user.sort.list')</label>
                                    <input class="d-none" {{ request('viewType') == 'list'? 'checked':'' }} value="list" type="radio" name="viewType" id="list">
                                </li>
                            </ul>
                            <div class="sort form-inline">
                                <label for="sort">@lang('user.sort.title') </label>
                                <select name="sortType" class="form-control-md">
                                    <option  value="">@lang('user.sort.selectSort')</option>
                                    <option {{ request('sortType') == 'high'? 'selected':'' }} value="high">@lang('user.sort.highToLow')</option>
                                    <option {{ request('sortType') == 'low'? 'selected':'' }} value="low">@lang('user.sort.lowToHight')</option>
                                    <option {{ request('sortType') == 'asc'? 'selected':'' }} value="asc">@lang('user.sort.asc')</option>
                                    <option {{ request('sortType') == 'desc'? 'selected':'' }} value="desc">@lang('user.sort.desc')</option>
                                </select>   
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Serach Bar -->

                <!-- Start category products -->
                <div class="row" id="view"></div>
                <!-- End category products -->

                <!-- Start Pagination-->
                <nav class="d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" id="prevPage">@lang('user.prev')</a>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="javascript:void(0)" id="stats">...</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" id="nextPage">@lang('user.next')</a>
                        </li>
                    </ul>
                </nav>
                <!-- End Pagination-->

            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    const addToCart = '{{ __('user.addtocart') }}'
    const category = ''
</script>
<script src="{{ asset('user/js/shop.js') }}"></script>
@endsection
