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
                    <div class="form-group mt-2">
                        <div id="card-element" class="form-control">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <!-- End Cart Details -->
                    <div class="col-12 form-group mt-3 form-check">
                        <input type="checkbox" class="form-check-input" name="agree" id="agree" required>
                        <label class="form-check-label" for="agree">@lang('user.checkout.agree') <a href="#">@lang('user.checkout.conditions') *</a></label>
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
<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('pk_test_vs2mJM5i18UsWUw58nkhYNK6004VW6Y7YE');
const elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
const style = {
  base: {
    fontSize: '16px',
    color: '#32325d',
  },
};

// Create an instance of the card Element.
const card = elements.create('card', {style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Create a token or display an error when the form is submitted.
const form = document.getElementsByClassName('payment-form')[0];
form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const {token, error} = await stripe.createToken(card);

  if (error) {
    // Inform the customer that there was an error.
    const errorElement = document.getElementById('card-errors');
    errorElement.textContent = error.message;
  } else {
    // Send the token to your server.
    stripeTokenHandler(token);
  }
});

const stripeTokenHandler = (token) => {
  // Insert the token ID into the form so it gets submitted to the server
  const form = document.getElementsByClassName('payment-form')[0];
  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection