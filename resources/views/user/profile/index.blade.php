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
                        <span class="tag"><i class="text-warning fa fa-exclamation-triangle"></i> @lang('user.profile.unVerified')</span>
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
                    <h3>@lang('user.profile.orders')</h3>
                </div>
                <div class="accordion" id="orders">
                    <div class="card mb-2">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    12, March 2019
                                </button>
                            </h2>
                            <span><strong>Total:</strong> $1250,00</span>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#orders">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Wireless Audio System</td>
                                            <td>$250x4</td>
                                            <td>$1000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Orders -->

            <!-- Start wishlist -->
            <div class="col-lg-4 mt-3">
                <div class="section-head">
                    <h3>@lang('user.profile.wishlist')</h3>
                </div>
                <div class="card wishlist">
                    <div class="card-body" id="view"></div>
                </div>
            </div>
            <!-- End wishlist -->
        </div>
    </div>
</main>
<!-- End Profile -->
@endsection

@section('script')
<script src="{{ asset('user/js/wishlist.js') }}"></script>

<script>
    let view = document.getElementById('view');
    $.ajax({
        url: baseData.url + '/wishlist',
        method: 'GET',
        data: {products: wishlist.list()},
        success(res){
            res.products.forEach(product => {
                view.innerHTML += (`
                    <div class="row product">
                        <div class="col-5">
                            <img src="${baseData.url}/storage/${ product.first_image.url }" class="img-fluid" alt="${product[lang('name')]}" title="${product[lang('name')]}">
                        </div>
                        <div class="col-7">
                            <span><a href="${ product.category.url }">${product.category[lang('name')]}</a></span>
                            <h5><a href="${product.url}">${product[lang('name')]}</a></h5>
                            <div class="product-review">
                                ${product.product_rate.join(' ')}
                            </div>
                        </div>
                    </div>
                `)     
            });
            
        } 
    })
</script>
@endsection