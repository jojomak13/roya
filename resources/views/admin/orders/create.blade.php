@extends('layouts.admin.master')

@section('title', __('dashboard.orders.create'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">{{ __('dashboard.orders.title') }}</a>
</li>
<li class="breadcrumb-item active">{{ __('dashboard.orders.create') }}</li>
@endsection

@section('content')
    <app-cashier></app-cashier>
@endsection