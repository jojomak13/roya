@extends('layouts.admin.master')

@section('title', __('dashboard.orders.show'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">{{ __('dashboard.orders.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('dashboard.orders.show') }}</li>
@endsection

@section('content')
<section>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('dashboard.orders.product')</th>
                        <th>@lang('dashboard.orders.quantity')</th>
                        <th>@lang('dashboard.orders.price')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->{lang('name')} }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>@money($product->price)</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">السعر الاجمالى</td>
                        <td>@money($order->total_price)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection