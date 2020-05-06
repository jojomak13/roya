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
        <form id="needs-validation" action="{{ route('cart.procced') }}" method="POST" class="needs-validation payment-form" novalidate>
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-head">
                        <h2>@lang('user.checkout.billDetails')</h2>
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
                        <div class="form-group col-6">
                            <label for="country">@lang('user.auth.country') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <select class="form-control @error('country_id') is-invalid @enderror" id="country" name="country_id">
                                <option value="">@lang('user.profile.select_country')</option>
                                @foreach($countries as $country)
                                <option {{ $user->country->id == $country->id? 'selected':'' }} value="{{ $country->id }}">{{ $country->{lang('name')} }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                            <input type="text" class="form-control" value="{{ $user->city }}" name="city" id="city" @error('city') is-invalid @enderror required>
                            @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 form-group">
                            <label for="postalcode">@lang('user.auth.postalCode') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <input type="text" class="form-control" value="{{ $user->postal_code }}" name="postal_code" id="postalcode" @error('postal_code') is-invalid @enderror required>
                            @error('postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="address">@lang('user.auth.address') <abbr title="@lang('user.checkout.required')">*</abbr></label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" required>{{ $user->address }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-head">
                        <h2>@lang('user.checkout.shipDetails')</h2>
                    </div>
                    <!-- Start Cart Details -->
                    <div class="card cart-details">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('user.checkout.product')</th>
                                        <th>@lang('user.cart.color')</th>
                                        <th>@lang('user.cart.quantity')</th>
                                        <th>@lang('user.checkout.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->cart as $product)
                                        @foreach(unserialize($product->pivot->data) as $color => $quantity)
                                        <tr>
                                            <td>{{ $product->{lang('name')} }}</td>
                                            <td>{{ $color }}</td>
                                            <td>x{{ $quantity }}</td>
                                            <td>@money($product->price * $quantity) @lang('user.currency')</td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                    <tr class="calc">
                                        <td colspan="3">@lang('user.checkout.subtotal')</td>
                                        <td>@money($user->totalPrice()) @lang('user.currency')</td>
                                    </tr>
                                    <tr class="calc">
                                        <td colspan="3">@lang('user.checkout.shipping')</td>
                                        <td>@money(40) @lang('user.currency')</td>
                                    </tr>
                                    <tr class="calc">
                                        <td colspan="3">@lang('user.checkout.total')</td>
                                        <td>@money($user->totalPrice()) @lang('user.currency')</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Cart Details -->

                    <!-- Start Availble Cards -->
                    {{-- @if(sizeof($cards))
                    <ul class="list-group cards-list mt-3">
                        <li><label for="card">@lang('user.checkout.selectCard') <abbr title="@lang('user.checkout.required')">*</abbr></label></li>
                        @foreach($cards as $card)
                        <li class="list-group-item d-flex justify-content-between">
                            <input type="radio" value="{{ $card->token }}" checked class="form-check-input" name="cardToken" id="card" required>
                            <span class="card-number">************{{ $card->lastFourDigits }}</span>   
                            @if($card->brand == 'Visa Card')
                                <span><i class="fa fa-cc-visa"></i></span>
                            @elseif($card->brand == 'MasterCard')
                                <span><i class="fa fa-cc-mastercard"></i></span>
                            @else
                                <span><i class="fa fa-credit-card"></i></span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="mt-3">
                        <h5>@lang('user.auth.noCards')</h5>
                        <a href="{{ route('profile.edit', '#payment-cards') }}" class="btn btn-primary">@lang('user.auth.newCard')</a>
                    </div>
                    @endif --}}
                    <!-- End Availble Cards -->

                    <div class="row">
                        <div class="col-12 form-group mt-3 form-check">
                            <input type="checkbox" class="form-check-input" name="agree" id="agree" required>
                            <label class="form-check-label" for="agree">@lang('user.checkout.agree') <a href="#">@lang('user.checkout.conditions') *</a></label>
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

@section('script')
{{-- <script src="https://atfawry.fawrystaging.com/ECommercePlugin/scripts/FawryPay.js"></script> --}}
{{-- 
<script>
$('form').on('submit', function(e){
    e.preventDefault();

    FawryPay.checkoutJS(chargeRequest, success, function(){
        window.location.reload();
    });   
})


function success(res){
    $.ajax({
        url: `${baseData.url}/${baseData.lang}/procced`,
        method: 'POST',
        data: $('form').serialize() + `&merchantRefNum=${res.merchantRefNum}`,
        success(res){
            // window.location = '/';
            console.log(res)
        }, 
        error(err){
            console.log("Error", err.response)
        }
    })
}


const chargeRequest = {
    language: 'ar-eg',
    merchantCode: '1tSa6uxz2nQwSjk0665RAg==',
    merchantRefNumber: new Date().getTime(),
    customer: {
        name: '',
        mobile: '',
        email: '',
        customerProfileId: ''
    },
    order: {
        description: 'bill inq',
        expiry: '',
        orderItems: []
    }
}

let item = {};
@foreach($user->cart as $product)
        item = {};
        item.productSKU = '{{ $product->{lang('name')} }}';
        item.description ='{{ $product->{lang('name')} }}';
        item.price = '{{ $product->price }}';
        item.quantity ='{{ $product->pivot->quantity }}';
        item.width = '12222';
        item.height = '12222';
        item.length = '12222';
        item.weight = '{{ $product->weight }}';
    chargeRequest.order.orderItems.push(item);
@endforeach
</script> --}}
@endsection