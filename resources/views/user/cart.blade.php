@extends('layouts.user.master')

@section('title', __('user.title.cart'))

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li>@lang('user.title.cart')</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<main class="cart-page">
    <div class="container">

        <div class="header">
            <h1>@lang('user.title.cart')</h1>
        </div>
        <div class="table-responsive">
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="d-none d-sm-table"></th>
                        <th>@lang('user.cart.product')</th>
                        <th>@lang('user.cart.price')</th>
                        <th>@lang('user.cart.quantity')</th>
                        <th>@lang('user.cart.totalPrice')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cart as $product)
                    <tr>
                        <td class="delete">
                            <a href="javascript:void(0)" onclick="this.children[1].submit()" title="@lang('user.cart.delete')">
                                <i class="fa fa-close"></i>
                                <form method="POST" action="{{ route('cart.destroy', $product->id) }}">
                                    @csrf
                                    @method('delete')
                                </form>
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
                        <td>{{ $product->price }} @lang('user.currency')</td>
                        <td>
                            <form class="form-inline" action="{{ route('cart.update', $product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" min="1" name="quantity" value="{{ $product->pivot->quantity }}" class="form-control">
                                <button type="submit" class="btn btn-primary">@lang('user.auth.update')</button>
                            </form>
                        </td>
                        <td>@money($product->price * $product->pivot->quantity) @lang('user.currency')</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6">@lang('user.cart.emptyCart')</td>
                        </tr>
                    @endforelse
                    <tr class="total">
                        <td colspan="2"></td>
                        <td colspan="3">@lang('user.cart.totalPrice')</td>
                        <td colspan="1">@money(auth()->user()->totalPrice()) @lang('user.currency')</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            <div class="form-group">
                <a href="{{ route('cart.checkout') }}" class="btn text-white btn-primary btn-lg">@lang('user.cart.checkout')</a>
            </div>
        </div>
    </div>

</main>

@endsection