@extends('layouts.admin.master')

@section('title', __('dashboard.orders.edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">{{ __('dashboard.orders.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('dashboard.orders.edit') }}</li>
@endsection

@section('content')
<section>
    @if($order->status == 'preparing' || $order->status == 'unpaid')
    <prepare-order data="{{ $order }}"></prepare-order>
    @else
    <shipping-order data="{{ $order }}"></shipping-order>
    @endif
</section>
@endsection