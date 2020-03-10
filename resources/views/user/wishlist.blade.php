@extends('layouts.user.master')

@section('title', __('user.title.wishlist'))

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li>@lang('user.title.wishlist')</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<main class="cart-page">
    <div class="container">

        <div class="header">
            <h1>@lang('user.title.wishlist')</h1>
        </div>
        <div class="table-responsive">
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>@lang('user.cart.product')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($wishlist as $product)
                    <tr>
                        <td class="delete">
                            <a href="javascript:void(0)" onclick="toggleWishlist({{ $product->id  }})" title="@lang('user.cart.delete')">
                                <i class="fa fa-close"></i>
                            </a>
                        </td>
                        <td class="image d-none d-sm-block">
                            <div class="image">
                                <img src="{{ url('storage/'.$product->firstImage->url) }}" alt="{{ $product->{lang('name')} }}" title="{{ $product->{lang('name')} }}">
                            </div>
                        </td>
                        <td class="name">
                            <div class="d-flex align-self-center">
                                <a href="{{ $product->url }}" title="{{ $product->{lang('name')} }}">{{ $product->{lang('name')} }}</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</main>

@endsection