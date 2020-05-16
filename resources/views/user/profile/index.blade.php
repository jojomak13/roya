@extends('layouts.user.master')

@section('title', __('user.title.profile'))

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li><a href="{{ route('profile') }}" title="@lang('user.title.profile')">@lang('user.title.profile')</a></li>
            <li>{{ $user->fullName() }}</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<!-- Start Profile -->
<main class="profile-page">
    <div class="container">
        <div class="header">
            <h1>@lang('user.title.profile')</h1>
        </div>
        <div class="row">
            <!-- Start Profile Image -->
            <div class="col-lg-5">
                <div class="card image">
                    <div class="card-body text-center">
                        <img class="img-fluid" src="{{ $user->imageUrl() }}" alt="{{ $user->fullName() }}" title="{{ $user->fullName() }}">
                        @if($user->email_verified_at)
                        <span class="tag"><i class="fa fa-check"></i> @lang('user.profile.verified')</span>
                        @else
                        <a href="{{ route('verification.notice') }}">
                            <span class="tag"><i class="text-warning fa fa-exclamation-triangle"></i> @lang('user.profile.unVerified')</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Profile Image -->

            <!-- Start user info -->
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-top">
                            <div>
                                <h2>{{ $user->fullname() }}</h2>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div>
                                @if(!auth()->user()->hasVerifiedEmail())
                                <a href="{{ route('verification.notice') }}" class="btn btn-success"><i class="fa fa-check"></i></a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary" alt="@lang('user.profile.editProfile')" title="@lang('user.profile.editProfile')"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                        <ul class="user-info">
                            <li>
                                <span class="title"><i class="fa fa-phone"></i> @lang('user.profile.phone')</span>:
                                <span>{{ $user->phone ?: '...' }}</span>
                            </li>
                            <li>
                                <span><i class="fa fa-undo"></i> @lang('user.profile.memberFrom')</span>:
                                <span>{{ $user->created_at->diffForHumans() }}</span>
                            </li>
                            <li>
                                <span><i class="fa fa-clock-o"></i> @lang('user.profile.lastLogin')</span>:
                                <span>{{ $user->last_login->diffForHumans() }}</span>
                            </li>
                            <li>
                                <span><i class="fa fa-newspaper-o"></i> @lang('user.profile.subscribeNews')</span>:
                                @if($user->news)
                                <span class="subscriber-tag subscribed">@lang('user.profile.subscribed')</span>
                                @else
                                <span class="subscriber-tag un-subscribed">@lang('user.profile.unSubscribed')</span>
                                @endif
                            </li>
                            @if($user->country)
                            <li>
                                <span><i class="fa fa-globe"></i> @lang('user.profile.country')</span>:
                                <span>{{ $user->country->{lang('name')} }}</span>
                            </li>
                            @endif
                            <li>
                                <span><i class="fa fa-map-marker"></i> @lang('user.profile.address')</span>:
                                <span>{{ $user->address }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End user info -->

            <!-- Start Orders -->
            <div class="col-lg-8 mt-3 orders">
                <div class="section-head">
                    <h2>@lang('user.profile.orders')</h2>
                </div>
                <div class="accordion" id="orders">
                    @foreach($user->orders as $order)
                    <div class="card mb-2">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#order_{{ $order->id }}" aria-expanded="true" aria-controls="order_1">
                                    {{ $order->created_at->toFormattedDateString() }}
                                </button>
                            </h2>
                            <span><strong>@money($order->total_price)</strong> @lang('user.currency')</span>
                        </div>
                        <div id="order_{{ $order->id }}" class="collapse" data-parent="#orders">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>@lang('user.cart.product')</th>
                                        <th>@lang('user.cart.color')</th>
                                        <th>@lang('user.cart.price')</th>
                                        <th>@lang('user.cart.totalPrice')</th>
                                    </thead>
                                    <tbody>
                                        @foreach($order->products as $product)
                                            @if(unserialize($product->data))
                                                @foreach(unserialize($product->data) as $color => $quantity)
                                                <tr>
                                                    <td>{{ $product->{lang('name')} }}</td>
                                                    <td>{{ $color }}</td>
                                                    <td>{{ $quantity }}x @money($product->price)</td>
                                                    <td>@money($product->price * $quantity) @lang('user.currency')</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>{{ $product->{lang('name')} }}</td>
                                                    <td>@lang('user.cart.unknown')</td>
                                                    <td>{{ $product->quantity }}x @money($product->price)</td>
                                                    <td>@money($product->price * $product->quantity) @lang('user.currency')</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr class="calc">
                                            <td colspan="3">@lang('user.checkout.shipping')</td>
                                            <td>@money(40) @lang('user.currency')</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End Orders -->

            <!-- Start wishlist -->
            <div class="col-lg-4 mt-3">
                <div class="section-head">
                    <h2>@lang('user.profile.wishlist')</h2>
                </div>
                <div class="card wishlist">
                    <div class="card-body">
                        @foreach($user->favorites as $product)
                        <div class="row product">
                            <div class="col-5">
                                <a href="{{ $product->url }}" title="{{ $product->{lang('name')} }}">
                                    <img src="{{ url('storage/'.$product->firstImage->url) }}" class="img-fluid" alt="{{ $product->{lang('name')} }}" title="{{ $product->{lang('name')} }}">
                                </a>
                            </div>
                            <div class="col-7">
                                <span><a href="{{ $product->category->url }}">{{ $product->category->{lang('name')} }}</a></span>
                                <h5><a href="{{ $product->url }}">{{ $product->{lang('name')} }}</a></h5>
                                <div class="product-review">
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
            <!-- End wishlist -->
        </div>
    </div>
</main>
<!-- End Profile -->
@endsection