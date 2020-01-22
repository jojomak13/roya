@extends('layouts.user.master')

@section('content')
<!-- Start breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}" title="@lang('user.title.home')">@lang('user.title.home')</a></li>
            <li>@lang('user.title.checkout')</li>
        </ul>
    </div>
</div>
<!-- End breadcrumb -->

<!-- Start Main -->
<main class="checkout-page">
    <div class="container">
        <div class="header">
            <h1>@lang('user.title.checkout')</h1>
        </div>

        <form id="needs-validation" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-head">
                        <h3>@lang('user.checkout.billDetails')</h3>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="first_name">@lang('user.auth.firstName') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control @error('first_name') is-invalid @enderror" id="first_name" required>
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <label for="last_name">@lang('user.auth.lastName') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control @error('last_name') is-invalid @enderror" id="last_name" required>
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="email">@lang('user.auth.email') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input disabled type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" id="email" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <label for="country">@lang('user.auth.country') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" class="form-control" id="country" required>
                            <div class="invalid-feedback">
                                Country is required
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <label for="phone">@lang('user.auth.phone') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror" id="phone" required>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <label for="city">@lang('user.auth.city') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" class="form-control" id="city" required>
                            <div class="invalid-feedback">
                                City is required
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <label for="postalcode">@lang('user.auth.postalCode') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" class="form-control" id="postalcode" required>
                            <div class="invalid-feedback">
                                Postcode is required
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <label for="address">@lang('user.auth.address') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" class="form-control" id="address" placeholder="Street address" required>
                            <div class="invalid-feedback">
                                Address is required
                            </div>   
                        </div>
                        <div class="form-group col-12">
                            <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-head">
                        <h3>@lang('user.checkout.shipDetails')</h3>
                    </div>
                    <!-- Start Cart Details -->
                    <div class="card cart-details">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('user.checkout.product')</th>
                                        <th></th>
                                        <th>@lang('user.checkout.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Cart::items() as $product)
                                    <tr>
                                        <td>{{ $product[lang('name')] }}</td>
                                        <td>x{{ $product['quantity'] }}</td>
                                        <td>@money($product['price'] * $product['quantity']) @lang('user.currency')</td>
                                    </tr>
                                    @endforeach
                                    <tr class="calc">
                                        <td colspan="2">@lang('user.checkout.subtotal')</td>
                                        <td>@money(\App\Cart::totalPrice()) @lang('user.currency')</td>
                                    </tr>
                                    <tr class="calc">
                                        <td colspan="2">@lang('user.checkout.shipping')</td>
                                        <td>$50</td>
                                    </tr>
                                    <tr class="calc">
                                        <td colspan="2">@lang('user.checkout.total')</td>
                                        <td>$2,575,15</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Cart Details -->
                    <div class="col-12 form-group mt-3 form-check">
                        <input type="checkbox" class="form-check-input" name="agree" id="agree" required>
                        <label class="form-check-label" for="agree">@lang('user.checkout.agree') <a href="#">@lang('user.checkout.conditions') *</a></label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">@lang('user.checkout.placeOrder')</button>
                    </div>
                </div>
            </div>
        </form> 
        
    </div>
</main>
<!-- End Main -->
@endsection