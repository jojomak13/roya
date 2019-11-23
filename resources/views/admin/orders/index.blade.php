@extends('layouts.admin.master')

@section('title', __('dashboard.orders.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.orders.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary mr-2 mb-2"><i class="fa fa-plus"></i> {{ __('dashboard.orders.create') }}</a>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('dashboard.orders.status') }}</th>
                    <th>{{ __('dashboard.orders.total_price') }}</th>
                    <th>{{ __('dashboard.orders.created_at') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $key => $order)
                <tr>
                    <th>{{ $key+1 }}</th>
                    <th>{{ $order->status }}</th>
                    <th>@money($order->total_price)</th>
                    <th>{{ $order->created_at->diffForHumans() }}</th>
                    <th>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="2">{{ __('dashboard.no_record') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</section>
@endsection
