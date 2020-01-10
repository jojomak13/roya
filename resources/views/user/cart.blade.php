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
        
        <table class="table cart-table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="delete">
                        <a href="#" title="delete product"><i class="fa fa-close"></i></a>
                    </td>
                    <td class="image">
                        <div class="image">
                            <img src="{{ asset('user/images/p-2.jpg') }}" alt="product name" title="product name">
                        </div>
                    </td>
                    <td class="name">
                        <div class="d-flex align-self-center">
                            <a href="#" title="product name">Ultra Wireless S50 Headphones S50 with Bluetooth</a>
                        </div>
                    </td>
                    <td>$1,999.00</td>
                    <td><input type="number" min="1" value="1" class="form-control"></td>
                    <td>$1,999.00</td>
                </tr>
                <tr>
                    <td class="delete">
                        <a href="#" title="delete product"><i class="fa fa-close"></i></a>
                    </td>
                    <td class="image">
                        <div class="image">
                            <img src="{{ asset('user/images/p-1.jpg') }}" alt="product name" title="product name">
                        </div>
                    </td>
                    <td class="name">
                        <div class="d-flex align-self-center">
                            <a href="#" title="product name">Ultra Wireless S50 Headphones S50 with Bluetooth</a>
                        </div>
                    </td>
                    <td>$1,999.00</td>
                    <td><input type="number" min="1" value="1" class="form-control"></td>
                    <td>$1,999.00</td>
                </tr>
                <tr>
                    <td class="delete">
                        <a href="#" title="delete product"><i class="fa fa-close"></i></a>
                    </td>
                    <td class="image">
                        <div class="image">
                            <img src="{{ asset('user/images/p-3.jpg') }}" alt="product name" title="product name">
                        </div>
                    </td>
                    <td class="name">
                        <div class="d-flex align-self-center">
                            <a href="#" title="product name">Ultra Wireless S50 Headphones S50 with Bluetooth</a>
                        </div>
                    </td>
                    <td>$1,999.00</td>
                    <td><input type="number" min="1" value="1" class="form-control"></td>
                    <td>$1,999.00</td>
                </tr>
                <tr class="total">
                    <td colspan="2"></td>
                    <td colspan="3">Total Price</td>
                    <td colspan="1">$1,999.00</td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <div class="form-inline coupon">
                <input type="text" class="form-control">
                <button class="btn btn-primary btn-lg">Apply Coupon</button>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-lg">Proceed To Checkout</button>
            </div>
        </div>
    </div>

</main>

@endsection