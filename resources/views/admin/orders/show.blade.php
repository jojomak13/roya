@extends('layouts.admin.master')

@section('title', __('dashboard.orders.show'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">{{ __('dashboard.orders.title') }}</a></li>
    <li class="breadcrumb-item active">{{ __('dashboard.orders.show') }}</li>
@endsection

@section('content')
<section>
    {{-- Start logo --}}
    <div class="card">
        <div class="card-body d-flex align-items-center">
            <div>
                <img style="width:150px" class="img-fluid" src="{{ asset('user/images/logo.png') }}">
            </div>
        </div>
    </div>
    {{-- End logo --}}

    {{-- Start today date --}}
    <div class="card">
        <div class="card-body d-flex justify-content-between">
            <div>
                <strong>@lang('dashboard.orders.code')</strong>
                :
                {{ $order->barcode }}
            </div>
            <div>
                <strong>@lang('dashboard.orders.printTime')</strong>
                :
                {{ Carbon\Carbon::now()->toFormattedDateString() }}
            </div>
        </div>
    </div>
    {{-- End today date --}}
    
    {{-- Start Order Details --}}
    <div class="card">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <span>@lang('dashboard.users.name')</span>
                    : {{ $order->user->fullName() }}
                </li>
                <li class="list-group-item">
                    <span>@lang('dashboard.users.email')</span>
                    : {{ $order->user->email }}
                </li>
                <li class="list-group-item">
                    <span>@lang('dashboard.users.country')</span>
                    :
                    {{ $order->user->country->{lang('name')} }}
                </li>
                <li class="list-group-item">
                    <span>@lang('dashboard.users.city')</span>
                    :
                    {{ $order->user->city }}
                </li>
                <li class="list-group-item">
                    <span>@lang('dashboard.users.address')</span>
                    :
                    {{ $order->user->address }}
                </li>
                <li class="list-group-item">
                    <span>@lang('dashboard.orders.created_at')</span>
                    :
                    {{ $order->created_at }}
                </li>
                <li class="list-group-item">
                    <span>@lang('dashboard.orders.total_price')</span>
                    :
                    @money($order->total_price) @lang('dashboard.currency')
                </li>
            </ul>
        </div>
    </div>
    {{-- End Order Details --}}

    {{-- Start Order products --}}
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
                        <td colspan="3">@lang('dashboard.orders.total_price')</td>
                        <td>@money($order->total_price) @lang('dashboard.currency')</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- End Order products --}}
</section>
@endsection