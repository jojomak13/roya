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
                <tbody id="view">
                </tbody>
            </table>
        </div>
    </div>

</main>

@endsection

@section('script')
<script src="{{ asset('user/js/wishlist.js') }}"></script>

<script>
let view = document.getElementById('view');
if(wishlist.list().length){
    $.ajax({
        url: baseData.url + '/wishlist/show',
        method: 'GET',
        data: {products: wishlist.list()},
        success(res){
            res.products.forEach(product => {
                view.innerHTML += (`
                <tr>
                    <td class="delete">
                        <a href="javascript:void(0)" onclick="wishlist.toggle(${ product.id });window.location.reload()" title="@lang('user.cart.delete')">
                            <i class="fa fa-close"></i>
                        </a>
                    </td>
                    <td class="image d-none d-sm-block">
                        <div class="image">
                            <img src="${ baseData.url }/storage/${ product.first_image.url }" alt="${ product[lang('name')] }" title="${ product[lang('name')] }">
                        </div>
                    </td>
                    <td class="name">
                        <div class="d-flex align-self-center">
                            <a href="${ product.url }" title="${ product[lang('name')] }">${ product[lang('name')] }</a>
                        </div>
                    </td>
                </tr>
                `)     
            });
            
        } 
    })
}
</script>
@endsection