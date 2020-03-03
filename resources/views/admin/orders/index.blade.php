@extends('layouts.admin.master')

@section('title', __('dashboard.orders.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.orders.title') }}</li>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sp-1.0.1/datatables.min.css"/>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus"></i> {{ __('dashboard.orders.create') }}</a>
        <hr>
        {!! $dataTable->table([
            'class' => 'datatable table table-striped table-hover'
        ]) !!}
    </div>
</section>

@endsection

@section('script')
<script src="{{ asset('admin/js/plugins/printjs/print.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/cr-1.5.2/sp-1.0.1/datatables.min.js"></script>
<script src="{{ asset('vendor\datatables\buttons.server-side.js') }}"></script>

{!! $dataTable->scripts() !!}
@endsection