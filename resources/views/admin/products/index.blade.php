@extends('layouts.admin.master')

@section('title', __('dashboard.products.title'))

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('dashboard.products.title') }}</li>
@endsection

@section('content')
<section class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.index') }}" autocomplete="off" method="GET" class="form-inline">
            <input type="text" class="form-control mb-2 mr-sm-2" name="search">
            <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="fa fa-search"></i> {{ __('dashboard.search') }}</button>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2 mr-2"><i class="fa fa-plus"></i> {{ __('dashboard.products.create') }}</a>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('dashboard.products.name') }}</th>
                    <th>{{ __('dashboard.products.buy_price') }}</th>
                    <th>{{ __('dashboard.products.sell_price') }}</th>
                    <th>{{ __('dashboard.products.owner') }}</th>
                    <th>{{ __('dashboard.products.quantity') }}</th>
                    <th>{{ __('dashboard.products.store') }}</th>
                    <th>{{ __('dashboard.products.category') }}</th>
                    <th>{{ __('dashboard.control') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <th>{{ $product->name }}</th>
                    <th>{{ $product->buy_price }}</th>
                    <th>{{ $product->sell_price }}</th>
                    <th>{{ $product->user->fullName() }}</th>
                    <th>----</th>
                    <th>----</th>
                    <th>{{ $product->category->name }}<th>
                    <th>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" class="delete-btn btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="6">{{ __('dashboard.no_record') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</section>
@endsection