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
                            <label for="first-name">@lang('user.auth.firstName') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" class="form-control" id="first-name" required>
                            <div class="invalid-feedback">
                                First Name is required
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <label for="last-name">@lang('user.auth.lastName') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" class="form-control" id="last-name" required>
                            <div class="invalid-feedback">
                                Last Name is required
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <label for="email">@lang('user.auth.email') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="email" class="form-control" id="email" required>
                            <div class="invalid-feedback">
                                Email is required
                            </div>
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
                            <input type="number" class="form-control" id="phone" required>
                            <div class="invalid-feedback">
                                Phone is required
                            </div>
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
                                    <tr>
                                        <td>Lenovo y50 - 64GB</td>
                                        <td>x1</td>
                                        <td>$120,45</td>
                                    </tr>
                                    <tr>
                                        <td>Ultra Wireless S50 Headphones...</td>
                                        <td>x5</td>
                                        <td>$1,225,45</td>
                                    </tr>
                                    <tr>
                                        <td>Lenovo y50 - 64GB</td>
                                        <td>x1</td>
                                        <td>$120,45</td>
                                    </tr>
                                    <tr>
                                        <td>Lenovo y50 - 64GB</td>
                                        <td>x1</td>
                                        <td>$120,45</td>
                                    </tr>
                                    <tr class="calc">
                                        <td colspan="2">@lang('user.checkout.subtotal')</td>
                                        <td>$2,512,45</td>
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